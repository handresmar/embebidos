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

static WORKING_AREA(waThread1, 128);

static msg_t Thread1(void *arg) {
  (void)arg;

  while (TRUE) {
    palClearPad(IOPORT3, BOARD_LED);
    chThdSleepMilliseconds(200);
    palSetPad(IOPORT3, BOARD_LED);
    chThdSleepMilliseconds(200);
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
  char UartBuffer[100];
  uint32_t UartBufferPtr = 0;

  while(true) {
    char byte_u8 = sdGet(&SD1);
    if (UartBufferPtr >= 100)
    {
        UartBufferPtr = 0;
    }

    if (byte_u8 == '\r' || byte_u8 == '\n')
    {
        UartBuffer[UartBufferPtr++] = '\0'; // null character manually added
        UartBufferPtr = 0;
        char *FAIL = strstr(UartBuffer, "FAIL");
         if(FAIL != NULL){
            chprintf((BaseChannel *) &SD2, "Lo que envio por SD1 fue: ");
            chprintf((BaseChannel *) &SD2, UartBuffer);
            chprintf((BaseChannel *) &SD2, "\r\n");
         }
    }
    else if (byte_u8 >= ' ' && byte_u8 <= '~')
    {
        UartBuffer[UartBufferPtr++] = byte_u8;
    }
  }

  // Creates blink thread
  chThdCreateStatic(waThread1, sizeof(waThread1), NORMALPRIO, Thread1, NULL);

  return(0);
}
