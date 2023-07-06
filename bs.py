import serial
import base64
import time, os, fnmatch, shutil
import datetime
ser=serial.Serial(port='/dev/ttyUSB0',baudrate=9600,parity=serial.PARITY_NONE,
stopbits=serial.STOPBITS_ONE, bytesize=serial.EIGHTBITS,timeout=None)
count=1
while True:
ser.flush()
#timestr = time.strftime("%Y%m%d-%H%M%S")
t = time.localtime()
timestamp = time.strftime('3332||%b-%d-%Y||%H:%M:%S||',t)
line = timestamp + ' ' + ser.readline()
#timestr = time.strftime('%Y%m%d-%H%M%S)
today = datetime.date.today()
f = '/home/pi/'
f += str(today)
f += ".txt"
#f += ".xml"
f = open('/home/pi/%s.txt' % today, 'a')
#f = open('/home/pi/%s.xml' % today, 'a')
f.writelines(line)
print (line + "\n")
f.flush()
f.close()
ser.close