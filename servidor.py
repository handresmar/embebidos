import serial
import time
#Serial setup
ser_sigfox = serial.Serial(port='/dev/ttyUSB0', baudrate=9600,timeout=0)
ser_sam = serial.Serial(port='/dev/ttySP0', baudrate=115200, timeout=0)
#Serial write
#x = "0000,1"
#ser_sigfox.write("AT$RC\r")
#ser_sigfox.write("AT$SF=")
#ser_sigfox.write(x)
#ser_sigfox.write("\r")
#ans="answer is: "+ser_sigfox.read(ser_sigfox.inWaiting())+" sigfox"           $
#print ans
while 1:
        sam = ser_sam.readline()
        if (sam.find("VAL=N")==0 or sam.find("LAT=040518")==0):
        	print "Sin satelites"
        elif (sam.find("VAL=A")==0):
         	if (sam.find("LAT=")==0):
        		LAT_tem = float(sam[4:])
                DD = int(LAT_tem/100)
                SS = float(LAT_tem) - DD * 100 
                LAT = DD + SS/60
                print "LAT=" + str(LAT)
pass	