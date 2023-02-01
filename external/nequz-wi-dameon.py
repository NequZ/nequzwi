######################### Module Header #*******************************
 # Module Name:  edit.php
 # Project:      NequZWI
 # Copyright (c) NequZ
 #
 # This file contains the edit script for editing the Service on the Customer side.

 # GNU GENERAL PUBLIC LICENSE
 # Version 3, 29 June 2007

 # Copyright (C) 2007 Free Software Foundation, Inc. <https://fsf.org/>
 # Everyone is permitted to copy and distribute verbatim copies
 # of this license document, but changing it is not allowed.
 #
 #***************************************************************************/



 # Information:
 # This is the main daemon for the hostsystems to update the Database with the current CPU and Memory usage. You NEED to install it on the hostsystem you want to monitor. And then add an Entry
 # in the Database Table "hostsystem"
 
import psutil
import mysql.connector
import time

# Connect to the database
conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="nequzwi"
)
cursor = conn.cursor()

while True:
    cpu = psutil.cpu_percent()
    mem = psutil.virtual_memory().percent
    cursor.execute("UPDATE hostsystem SET cpu_usage=%s, memory_usage=%s WHERE id=0", (cpu, mem))  # Here you need to change the ID to the ID of the hostsystem you want to update
    conn.commit()
    print ("Hostsysteminfos.. CPU: " + str(cpu) + "%" + " Memory: " + str(mem) + "%")
    time.sleep(180) # 3 minutes delay between each update

