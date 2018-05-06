import serial
import time
#Serial setup
ser_sigfox = serial.Serial(port='/dev/ttyUSB0', baudrate=9600,timeout=0)
ser_sam = serial.Serial(port='/dev/ttySP0', baudrate=115200, timeout=0)
#x = "0000,1"
#ser_sigfox.write("AT$RC\r")
#ser_sigfox.write("AT$SF=")
#ser_sigfox.write(x)
#ser_sigfox.write("\r")
#ans="answer is: "+ser_sigfox.read(ser_sigfox.inWaiting())+" sigfox"           $
#print ans
while 1:
	 	if (ser_sam.inWaiting()>0):
                	sam = ser_sam.readline()
                	Values = sam.split(";")
                	if(Values[0]=="LAT=040518" or Values[5]=="VAL=V"):
                        	print "Sin sateliles"
               		if(Values[5]=="VAL=A"):
                        	LAT_tem = float(Values[0][4:])                          
                        	DD = int(LAT_tem/100)
                        	SS = float(LAT_tem) - DD * 100
                        	LAT = DD + SS/60
                        	if(Values[0]=="CLAT=S"):
                        		LAT = -LAT                          
                       		LON_tem = float(Values[2][4:])                          
                        	DD = int(LON_tem/100)
                        	SS = float(LON_tem) - DD * 100                          
                        	LON = DD + SS/60
                        	if (Values[3]=="CLON=W"):
					LON = -LON
				Vel_Km = float(Values[4][3:]) * 1.852
                        	print "LAT=" + str(round(LAT,6)) + " LON=" + str(round(LON,6)) + " Vel=" + str(round(Vel_Km,2))  + " " + Values[6][0:5]
pass
