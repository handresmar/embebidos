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
  while(true) {
    chThdSleepMilliseconds(100);
    int c = sdGet(&SD2);
    if((char)sdGet(&SD2) == '1'){
      /*chprintf((BaseChannel *) &SD2, "Lo que envio fue: ");
      sdPut(&SD2, c);
      chprintf((BaseChannel *) &SD2, "\r\n");
      */
      palSetPad(IOPORT3, BOARD_LED);
    }else if((char)sdGet(&SD2) == '2'){
      palClearPad(IOPORT3, BOARD_LED);
    }
    
  }

  // Creates blink thread
  chThdCreateStatic(waThread1, sizeof(waThread1), NORMALPRIO, Thread1, NULL);

  return(0);
}
