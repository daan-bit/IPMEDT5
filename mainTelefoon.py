import serial
import os
import mysql.connector
import time

mydb = mysql.connector.connect(
    host="185.104.29.34",
    user="schoolproject_laravel",
    passwd="kvLXsjsPS",
    database="schoolproject_laravel"
)

port = serial.Serial("/dev/ttyUSB0", 9600, timeout=3.0)

mycursor = mydb.cursor()

while True:
    mycursor.execute("SELECT * FROM noodgeval;")
    for x in mycursor:
        print(x[1])
    if x[1] == 'aan':
        print(x[1])
        port.write("s1")
    else:
        port.write("s0")

    rcv = port.readline().strip()
    if(rcv == 'A'):
        print("wel")
        os.system("python updateWel.py")
    elif(rcv == 'N'):
        print("niet")
        os.system("python updateNiet.py")

    time.sleep(1)
    mydb.commit()

mydb.close()