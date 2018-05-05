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


Twid twid_;
/** TWI clock frequency in Hz. */
#define TWCK 400000

#define BOARD_MCK 64000000

static const Pin pins[] = {PIN_TWD0, PIN_TWCK0};


void I2CInit() {
  /* Configure TWI */
  chSysLock();
  PIO_Configure(pins, PIO_LISTSIZE(pins));
  PMC->PMC_WPMR = 0x504D4300; /* Disable write protect */
  PMC->PMC_PCER0 = 1 << ID_TWI0;
  PMC->PMC_WPMR = 0x504D4301; /* Enable write protect */
  TWI_ConfigureMaster(TWI0, TWCK, BOARD_MCK);
  TWID_Initialize(&twid_, TWI0);
  chSysUnlock();
}

uint8_t I2CReadByte_sub(uint8_t address, uint8_t subAddress) {
  // TODO (andres.calderon): Handle timeouts, handle errors
  chSysLock();
  uint8_t ret;
  uint8_t data;

  if (TWID_Read(&twid_, address, subAddress, 1, &data, 1, 0) == 0) ret = data;
  chSysUnlock();
  return ret;
}

void I2CWriteByte(uint8_t address, uint8_t data) {
  // TODO (andres.calderon): Handle timeouts, handle errors
  chSysLock();
  TWID_Write(&twid_, address, 0, 0, &data, 1, 0);
  chSysUnlock();
}

uint8_t I2CReadByte(uint8_t address) {
  // TODO (andres.calderon): Handle timeouts, handle errors
  chSysLock();
  uint8_t ret;
  uint8_t data;

  if (TWID_Read(&twid_, address, 0, 0, &data, 1, 0) == 0) ret = data;
  chSysUnlock();
  return ret;
}

void I2CWriteBytes(uint8_t address, uint8_t subAddress, uint8_t data) {
  // TODO (andres.calderon): Handle timeouts, handle errors
  chSysLock();
  TWID_Write(&twid_, address, subAddress, 1, &data, 1, 0);
  chSysUnlock();
}
static WORKING_AREA(waThread1, 128);

uint8_t I2CReadBytes(uint8_t address, uint8_t subAddress, uint8_t* dest,
                       uint8_t count) {
  chSysLock();
  uint8_t ret = 0;
  // TODO (andres.calderon): Handle timeouts, handle errors
  if (TWID_Read(&twid_, address, subAddress, 1, dest, count, 0) == 0) {
    ret = count;
  }
  chSysUnlock();
  return ret;
}

static msg_t Thread1(void *arg) {
  (void)arg;

  while (TRUE) {
    uint8_t MPUbuffer[14];
    int16_t x;
    //palClearPad(IOPORT3, BOARD_LED);
    //chThdSleepMilliseconds(1000);
    //palSetPad(IOPORT3, BOARD_LED);
    //chThdSleepMilliseconds(1);
    I2CWriteBytes(0x68,0x6B,0);
    //uint8_t x = I2CReadByte_sub(0x68,0x3B);
    I2CReadBytes(0x68,0x3B,MPUbuffer,2);
    x = (((uint16_t)MPUbuffer[0] <<8) | MPUbuffer[1]);
    if(x>30000 || x<-30000){
      chprintf((BaseChannel *) &SD2, "Perreo intenso\r\n");

    }
    chprintf((BaseChannel *)&SD2, "x: %5d\t\r\n",x);
    //chprintf((BaseSequentialStream *)&SD2, "Y: %5d\t\r\n",y);
    //chprintf((BaseSequentialStream *)&SD2, "Z: %5d\t\r\n",z);
    //I2CWriteByte(8,100);
    //chThdSleepMilliseconds(1000);
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
    while(true) {
      int i=0;
      int j=0;
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
            //chprintf((BaseChannel *) &SD2, "\r\n");
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
  //chThdCreateStatic(AreaGPS, sizeof(AreaGPS), ABSPRIO, GPSThread, NULL);

  

  return(0);
}
