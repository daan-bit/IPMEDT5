import serial
import mysql.connector
from datetime import datetime

gekeurde_tijden = [10, 20, 30, 40, 50]
gekeurde_uur = "00"
gestuurd = False



arduino = serial.Serial("/dev/ttyUSB0", baudrate=115200, timeout=.1)
mydb = mysql.connector.connect(
    host="web0094.zxcs.nl",
    user="schoolproject_laravel",
    passwd="kvLXsjsPS",
    database="schoolproject_laravel"
    )


def sendToDb(data):
    global gestuurd
    data = data.split(" ")
    print("temperature: " + data[0] + " humidity: " + data[1])
    now = datetime.now()
    dt_string = now.strftime("%Y/%m/%d %H:%M")
    now_check = now.strftime("%M")
    now_check = int(now_check)
    now_checkUur = str(now_check) + "0"
    print("date/time" + dt_string)
    mycursor = mydb.cursor()

    insert_data = (
        "INSERT INTO templucht (temperature, humidity, created_at)" 
        "VALUES (%s, %s, %s);"
    )
    values = (data[0], data[1], dt_string)
    temphum = (data[0], data[1])

    print("already send to DB: " + str(gestuurd))
    for x in gekeurde_tijden:
        if x == now_check or gekeurde_uur == now_checkUur:
            if gestuurd == False:
                mycursor.execute("DELETE FROM templucht LIMIT 1;")
                mycursor.execute(insert_data, values)
                mydb.commit()
                print("Succesfully send to DB!")
                gestuurd = True
                break
        elif gestuurd == True:
            gestuurd = False
            

    


def diftempcheck(dif):
    if dif >= -1 and dif <= 1:
        tempdif = 3
    elif dif == 2:
        tempdif = 4
    elif dif == -2:
        tempdif = 2
    elif dif >= 3:
        tempdif = 5
    elif dif <= -3:
        tempdif = 1
    return tempdif

def difhumcheck(dif):
    if dif >= -4 and dif <= 4:
        humdif = 3
    elif dif >= 5 and dif < 10:
        humdif = 4
    elif dif <= -5 and dif > -10:
        humdif = 2
    elif dif >= 10:
        humdif = 5
    elif dif <= -10:
        humdif = 1
    return humdif

def makeCode(data):
    print("making code...")
    data = data.split(" ")
    mycursor = mydb.cursor()
    mycursor.execute("SELECT gewensttemp, gewensthum FROM userpreferences;")
    for x in mycursor:    
        temperature = x[0]
        humidity = x[1]
    
    tempdif = int(data[0]) - int(temperature)
    temperaturedif = diftempcheck(tempdif)
    humdif = int(data[1]) - int(humidity)
    humiditydif = difhumcheck(humdif)
    
    code = "t" + str(temperaturedif) + "h" + str(humiditydif)
    print code
    print("sending the code...")
    arduino.write(code)
    mydb.commit()


while True:
    data = arduino.readline()[:-2] #the last bit gets rid of the new-line chars
    if data:
        sendToDb(data)
        makeCode(data)
        
        
    

    

