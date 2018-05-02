import serial
import time
#Serial setup
ser_sigfox = serial.Serial(port='/dev/ttyUSB0', baudrate=9600, timeout=0)
ser_sam = serial.Serial(port='/dev/ttySP0', baudrate=115200, timeout=0)
#Serial write
ser_sigfox.write("AT$RC\r\n")
ser_sigfox.write("AT$SF=32140000000E808000000011\r\n")

while 1:
	ser_sam.write("1");
	time.sleep(2)
	ser_sam.write("2");
	time.sleep(2)
	pass