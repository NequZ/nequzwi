#!/bin/bash

# Install required packages
pip install mysql-connector-python
pip install psutil


echo "Welcome to the Nequz-WI Daemon installer! This script will install the daemon on your system."
echo "The daemon will collect data about your system and send it to the Database."
echo "---------------------------------"
echo "Please enter the IP of the MySQL Server:"
echo "If your using the same server, type localhost and press enter."
read ip
echo "Please Enter the Port of the MySQL Server:"
echo "If your using the default port, type 3306 and press enter."
read port
echo "Please enter the password for the MySQL root user:"
read -s password
echo "Thank you! The Installer will now start."
echo "---------------------------------"
echo "Installing the daemon..."
echo "---------------------------------"
echo "Creating directory /opt/nequz-wi-daemon"
echo "---------------------------------"
echo "Enter a Server Allocation for this Hostsystem:"
read allocation
echo "---------------------------------"




if [ ! -d "/opt/nequz-wi-daemon" ]; then
    mkdir /opt/nequz-wi-daemon
    echo "Created directory /opt/nequz-wi-daemon"
fi
cd /opt/nequz-wi-daemon
echo "---------------------------------"
# create file id.txt
echo "Creating file id.txt"
if [ ! -f "id.txt" ]; then
    id=$(($RANDOM % 100000 + 1))
    echo $id > id.txt
    echo "Created file id.txt"

fi

if [ ! -f "allocation.txt" ]; then
    echo "$allocation" > allocation.txt
    echo "Created file allocation.txt"
fi
echo "---------------------------------"

echo "Select the Duration of the Check on the Hostsysem (in seconds):"
read duration
echo "Thank you! The Installer will now continue."

echo "# -*- coding: utf-8 -*-" >> nequz-wi-daemon.py
echo "import psutil" >> nequz-wi-daemon.py
echo "import mysql.connector" >> nequz-wi-daemon.py
echo "import time" >> nequz-wi-daemon.py
echo "import datetime" >> nequz-wi-daemon.py
echo "import random" >> nequz-wi-daemon.py
echo "import subprocess " >> nequz-wi-daemon.py
echo "import os" >> nequz-wi-daemon.py
echo "" >> nequz-wi-daemon.py
echo "# Connect to the database" >> nequz-wi-daemon.py
echo "conn = mysql.connector.connect(" >> nequz-wi-daemon.py
echo "    host='$ip'," >> nequz-wi-daemon.py
echo "    user='root'," >> nequz-wi-daemon.py
echo "    passwd='$password'," >> nequz-wi-daemon.py
echo "    database='nequzwi'," >> nequz-wi-daemon.py
echo "    port='$port'" >> nequz-wi-daemon.py
echo ")" >> nequz-wi-daemon.py
echo "cursor = conn.cursor()" >> nequz-wi-daemon.py
echo "" >> nequz-wi-daemon.py
echo "# Create a new Hostsystem" >> nequz-wi-daemon.py
echo "id=$(cat id.txt)" >> nequz-wi-daemon.py
echo "allocation='$(cat allocation.txt)'" >> nequz-wi-daemon.py
# if id already exists, dont create a new one
echo "cursor.execute(\"SELECT * FROM hostsystem WHERE id=%s AND allocation=%s\", (id, allocation))" >> nequz-wi-daemon.py
echo "if cursor.fetchone() is not None:" >> nequz-wi-daemon.py
echo "    print (\"Hostsystem already exists.\")" >> nequz-wi-daemon.py
echo "else:" >> nequz-wi-daemon.py
echo "    cursor.execute(\"INSERT INTO hostsystem (id, cpu_usage, memory_usage, isonline, laststatus, allocation) VALUES (%s, 0, 0, 0, '00:00:00', %s)\", (id, allocation))" >> nequz-wi-daemon.py
echo "    conn.commit()" >> nequz-wi-daemon.py

echo "while True:" >> nequz-wi-daemon.py
echo "    cpu = psutil.cpu_percent()" >> nequz-wi-daemon.py
echo "    mem = psutil.virtual_memory().percent" >> nequz-wi-daemon.py
echo "    uptime = time.time() - psutil.boot_time()" >> nequz-wi-daemon.py
echo "    laststatus = datetime.datetime.now().time()" >> nequz-wi-daemon.py
echo "    ip = subprocess.run(['ipconfig'], stdout=subprocess.PIPE).stdout.decode('utf-8')" >> nequz-wi-daemon.py
echo "    Enter a Servername for this Hostsystem:"
read servername
echo "    Thank you! The Installer will now continue."

echo "    if uptime > 300:" >> nequz-wi-daemon.py
echo "        cursor.execute(\"UPDATE hostsystem SET isonline=1 WHERE id=%s\", (id,))" >> nequz-wi-daemon.py
echo "        conn.commit()" >> nequz-wi-daemon.py
echo "    else:" >> nequz-wi-daemon.py
echo "        cursor.execute(\"UPDATE hostsystem SET isonline=0 WHERE id=%s\", (id,))" >> nequz-wi-daemon.py
echo "        conn.commit()" >> nequz-wi-daemon.py
echo "" >> nequz-wi-daemon.py

echo "    cursor.execute(\"UPDATE hostsystem SET cpu_usage=%s, memory_usage=%s, laststatus=%s, servername=%s, ip=%s WHERE id=%s\", (cpu, mem, laststatus, '$servername', ip, id))" >> nequz-wi-daemon.py
echo "    conn.commit()" >> nequz-wi-daemon.py
echo "    print (\"CPU: \" + str(cpu) + \"%\")" >> nequz-wi-daemon.py
echo "    print (\"Memory: \" + str(mem) + \"%\")" >> nequz-wi-daemon.py
echo "    print (\"Uptime: \" + str(uptime) + \" seconds\")" >> nequz-wi-daemon.py
echo "    print (\"Last Status: \" + str(laststatus))" >> nequz-wi-daemon.py
echo "    print (\"ID of this Hostsystem: \" + str(id))" >> nequz-wi-daemon.py
echo "    print (\"Server Allocation: \" + str(allocation))" >> nequz-wi-daemon.py
echo "    print (\"---------------------------------\")" >> nequz-wi-daemon.py

echo "

    cursor = conn.cursor()
    cursor.execute(\"SELECT * FROM user_service WHERE active = 0\")
    result = cursor.fetchall()


    if result:
        inactive_ids = [row[0] for row in result]
        print(\"Found inactive entries with IDs:\", inactive_ids)
        cursor.execute(\"SELECT * FROM user_service WHERE hostid = %s AND active = 0\", (id,))
        result = cursor.fetchall()
        if result:
            print(\"Found inactive entries with the same hostid as the current host\")
        else:
            print(\"No inactive entries with the same hostid as the current host found\")
            conn.commit()

    else:
        print(\"No inactive entries found\")
    time.sleep($duration)" >> nequz-wi-daemon.py


# Create the service
echo "[Unit]" >> nequz-wi-daemon.service
echo "Description=Nequz-WI Daemon" >> nequz-wi-daemon.service
echo "After=multi-user.target" >> nequz-wi-daemon.service
echo "" >> nequz-wi-daemon.service
echo "[Service]" >> nequz-wi-daemon.service
echo "Type=idle" >> nequz-wi-daemon.service
echo "ExecStart=/usr/bin/python /opt/nequz-wi-daemon/nequz-wi-daemon.py" >> nequz-wi-daemon.service
echo "" >> nequz-wi-daemon.service
echo "[Install]" >> nequz-wi-daemon.service
echo "WantedBy=multi-user.target" >> nequz-wi-daemon.service

# Move the service to the systemd folder
mv nequz-wi-daemon.service /etc/systemd/system/nequz-wi-daemon.service

# Enable the service
systemctl enable nequz-wi-daemon.service

# Start the service
systemctl start nequz-wi-daemon.service


