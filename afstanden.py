import mysql.connector
import time
import serial
import os



mydb= mysql.connector.connect(
    host ="web0094.zxcs.nl",
    user="schoolproject_laravel",
    passwd="kvLXsjsPS",
    database="schoolproject_laravel"
)

port = serial.Serial("/dev/ttyUSB0", baudrate=115200, timeout=3.0)
mycursor=mydb.cursor()

while True:
    #mycursor.execute("SELECT * FROM screen_distance;")
    #for x in mycursor:
    #    print(x[2])
    #if x[1]== '10':
    #    print(x[2])
    #    print("hhhhh")
    #    port.write("l1")
    #else:
    #    port.write("l0")


    
    rcv = port.readline().strip()
    time.sleep(0.2)
    rcv = port.readline().strip()
    stukken = rcv.split("\t")
    afstand = stukken[1]
    sensor = stukken[0]
    if "Huidige sensor: 1" in rcv:   
        print("Sensor 1")
        print("De volgende waarde word nu in de database gestopt: " + afstand)
        mycursor.execute("DELETE FROM screen_height_distance LIMIT 1;")
        mycursor.execute("INSERT INTO screen_height_distance (Afstand) VALUES (%s)", (int(afstand),))      

      
        
     
    if "Huidige sensor: 2" in rcv:
        print("Sensor 2")
        print("De volgende waarde word nu in de database gestopt: " + afstand)
        mycursor.execute("DELETE FROM screen_distance LIMIT 1;")
        mycursor.execute("INSERT INTO screen_distance (Afstand) VALUES (%s)", (int(afstand),))        

        
           
    
    elif "Huidige sensor: 3" in rcv:
        print("Sensor 3")
        print("De volgende waarde word nu in de database gestopt: " + afstand)
        mycursor.execute("DELETE FROM desk_distance LIMIT 1;")
        mycursor.execute("INSERT INTO desk_distance (Afstand) VALUES (%s)", (int(afstand),))        




    time.sleep(0.2)
    mydb.commit()
mydb.close()