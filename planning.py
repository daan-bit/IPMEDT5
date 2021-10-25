
import mysql.connector
import time

import serial
import os
rcv = 0
vak = ""
mydb = mysql.connector.connect(
	host="web0094.zxcs.nl",
 	user="schoolproject_laravel",
  	passwd="kvLXsjsPS",
	database="schoolproject_laravel"
)

port = serial.Serial("/dev/ttyUSB5", baudrate=9600, timeout=3.0)

mycursor = mydb.cursor()
#port.write('a')
print('lets go')
def timerinstellen():
	while True:
		global rcv
		rcv = port.readline().strip()
		if (rcv != ''):
			while True:
				mycursor.execute("SELECT * FROM tijdloopt WHERE active = 1;")
				for x in mycursor:
					if (x[1] == 1):
						mycursor.execute("SELECT * FROM vakken WHERE naam = (%s)",(x[0],))
						for i in mycursor:
							print('vak gevonden')
						if(i[1] < int(float(rcv))+i[2]):
							print('tijd is meer dan benodigde tijd!')
							port.write('b')
						else:
							print('Toegestaan beginnen met tijd')
							port.write('a')
						global vak
						vak = x[0]
						break
				pauzeofeinde()
				break

def pauzeofeinde():
	while True:
		input = port.readline().strip()
		print(input)
		if (input == 'pauze'):
			while True:
				pauzeeind = port.readline().strip()
				if (pauzeeind == 'eindpauze'):
					print('eindpauze')
					break
		if (input == 'timedone'):
			tijdvandatabase()
			break

def tijdvandatabase():
	print(rcv)
	tijd = int(float(rcv))
	mycursor.execute("SELECT * FROM vakken WHERE naam = (%s)",(vak, ))
	for x in mycursor:
		naam = x[0]
		benodigdetijd = x[1]
		gewerktetijd = x[2]
	mingewerktetijd = gewerktetijd + tijd
	print(mingewerktetijd)
	mycursor.execute("UPDATE vakken SET gewerktetijd = (%s) where naam =(%s)", (mingewerktetijd, vak))
	mycursor.execute("UPDATE tijdloopt SET active = 0")
	mydb.commit()

def startupdatabase():
	mydb = mysql.connector.connect(
    	host="web0094.zxcs.nl",
    	user="schoolproject_laravel",
    	passwd="kvLXsjsPS",
    	database="schoolproject_laravel"
	)

	port = serial.Serial("/dev/ttyUSB5", baudrate=9600, timeout=3.0)

	mycursor = mydb.cursor()

mydb.commit()
timerinstellen()
mydb.close()
