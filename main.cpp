/**
    Purpose: Sets the main logic of IEDD project

    @author Alexis Cuero Losada
    @version 1.1 18/01/10
*/

#define _GLIBCXX_USE_CXX11_ABI 0

#include "board.h"
#include "ch.h"
#include "chprintf.h"
#include "hal.h"
#include "pio.h"
#include "pmc.h"
#include "string.h"
#include "atmel_twid.h"
#include "pio.h"
#include "atmel_twi.h"
#include "./i2c.h"


static WORKING_AREA(waThread1, 128);

static msg_t Thread1(void *arg) {
  (void)arg;

  while (TRUE) {
    palClearPad(IOPORT3, BOARD_LED);
    chThdSleepMilliseconds(1000);
    palSetPad(IOPORT3, BOARD_LED);
    chThdSleepMilliseconds(1);
  }

  return(0);
}

static WORKING_AREA(AreaGPS, 1024);

static msg_t GPSThread(void *arg) {
  (void)arg;

    char UartBuffer[100];
    uint32_t UartBufferPtr = 0;
    char *GPGGA[16];
    char *GPRMC[16];
    uint8_t MPUbuffer[2];
    int16_t x;
    while(true) {
      int i=0;
      int j=0;
      int MPUStatus;
      char byte_u8 = sdGet(&SD1); 
        if (UartBufferPtr >= 100){
          UartBufferPtr = 0;
        }
        if (byte_u8 == '\r' || byte_u8 == '\n'){
          UartBuffer[UartBufferPtr++] = '\0';
          UartBufferPtr = 0;
          char *GPRMC_c = strstr(UartBuffer, "$GPRMC");
          if (GPRMC_c != NULL){
            char *pt2;
            pt2 = strtok (UartBuffer,",");
            while (pt2 != NULL) {
              GPRMC[j]=pt2;
              pt2 = strtok (NULL, ",");
              j++;
            }
            I2CWriteBytes(0x68,0x6B,0); //Wake up MPU
            I2CReadBytes(0x68,0x3B,MPUbuffer,2);
            x = (((uint16_t)MPUbuffer[0] <<8) | MPUbuffer[1]);
            if(x>30000 || x<-30000){
              MPUStatus = 1;
            }else{
              MPUStatus = 0;
            }
            chprintf((BaseChannel *) &SD2, "LAT=");
            chprintf((BaseChannel *) &SD2, GPRMC[3]);
            chprintf((BaseChannel *) &SD2, ";");
            chprintf((BaseChannel *) &SD2, "CLAT=");
            chprintf((BaseChannel *) &SD2, GPRMC[4]);
            chprintf((BaseChannel *) &SD2, ";");
            chprintf((BaseChannel *) &SD2, "LON=");
            chprintf((BaseChannel *) &SD2, GPRMC[5]);
            chprintf((BaseChannel *) &SD2, ";");
            chprintf((BaseChannel *) &SD2, "CLON=");
            chprintf((BaseChannel *) &SD2, GPRMC[6]);
            chprintf((BaseChannel *) &SD2, ";");
            chprintf((BaseChannel *) &SD2, "SP=");
            chprintf((BaseChannel *) &SD2, GPRMC[7]);
            chprintf((BaseChannel *) &SD2, ";");
            chprintf((BaseChannel *) &SD2, "VAL=");
            chprintf((BaseChannel *) &SD2, GPRMC[2]);
            chprintf((BaseChannel *) &SD2, ";");
            chprintf((BaseChannel *) &SD2, "MPU=");
            chprintf((BaseChannel *)&SD2,"%0d", MPUStatus);
            chprintf((BaseChannel *) &SD2, "\r\n");
            chThdSleepMilliseconds(40000);
          }
        }
        else if (byte_u8 >= ' ' && byte_u8 <= '~'){
          UartBuffer[UartBufferPtr++] = byte_u8;
        }
      }
      return(0);
}


/*
* Application entry point.
*/
int main(void) {
  // Initialize ChibiOS HAL
  halInit();
  chSysInit();

  //Start Serial.
  sdStart(&SD2, NULL);
  sdStart(&SD1, NULL);
  //Start I2C
  I2CInit();
  // Creates threads
  chThdCreateStatic(waThread1, sizeof(waThread1), NORMALPRIO, Thread1, NULL);
  chThdCreateStatic(AreaGPS, sizeof(AreaGPS), ABSPRIO, GPSThread, NULL);

  

  return(0);
}
