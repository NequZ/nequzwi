#!/bin/bash

# Install required packages
pip install mysql-connector-python
pip install psutil


echo "Welcome to the Nequz-WI Daemon installer! This script will install the daemon on your system."
echo "The daemon will collect data about your system and send it to the Database."
echo "Please enter the password for the MySQL root user:"
read -s password
echo "Thank you! The Installer will now start."
echo "---------------------------------"
echo "Installing the daemon..."
echo "---------------------------------"
echo "Creating directory /opt/nequz-wi-daemon"




if [ ! -d "/opt/nequz-wi-daemon" ]; then
    mkdir /opt/nequz-wi-daemon
    echo "Created directory /opt/nequz-wi-daemon"
fi
cd /opt/nequz-wi-daemon

echo "Select the Duration of the Check on the Hostsysem (in seconds):"
read duration
echo "Thank you! The Installer will now continue."

echo "# -*- coding: utf-8 -*-" >> nequz-wi-daemon.py
echo "import psutil" >> nequz-wi-daemon.py
echo "import mysql.connector" >> nequz-wi-daemon.py
echo "import time" >> nequz-wi-daemon.py
echo "import random" >> nequz-wi-daemon.py
echo "" >> nequz-wi-daemon.py
echo "# Connect to the database" >> nequz-wi-daemon.py
echo "conn = mysql.connector.connect(" >> nequz-wi-daemon.py
echo "    host='localhost'," >> nequz-wi-daemon.py
echo "    user='root'," >> nequz-wi-daemon.py
echo "    passwd='$password'," >> nequz-wi-daemon.py
echo "    database='nequzwi'" >> nequz-wi-daemon.py
echo ")" >> nequz-wi-daemon.py
echo "cursor = conn.cursor()" >> nequz-wi-daemon.py
echo "" >> nequz-wi-daemon.py
echo "id = random.randint(1, 100000)" >> nequz-wi-daemon.py
echo "cursor.execute(\"INSERT INTO hostsystem (id, cpu_usage, memory_usage, isonline) VALUES (%s, 0, 0, 0)\", (id,))" >> nequz-wi-daemon.py
echo "conn.commit()" >> nequz-wi-daemon.py
echo "" >> nequz-wi-daemon.py
echo "while True:" >> nequz-wi-daemon.py
echo "    cpu = psutil.cpu_percent()" >> nequz-wi-daemon.py
echo "    mem = psutil.virtual_memory().percent" >> nequz-wi-daemon.py
echo "    uptime = time.time() - psutil.boot_time()" >> nequz-wi-daemon.py
echo "    if uptime > 300:" >> nequz-wi-daemon.py
echo "        cursor.execute(\"UPDATE hostsystem SET isonline=1 WHERE id=%s\", (id,))" >> nequz-wi-daemon.py
echo "        conn.commit()" >> nequz-wi-daemon.py
echo "    else:" >> nequz-wi-daemon.py
echo "        cursor.execute(\"UPDATE hostsystem SET isonline=0 WHERE id=%s\", (id,))" >> nequz-wi-daemon.py
echo "        conn.commit()" >> nequz-wi-daemon.py
echo "" >> nequz-wi-daemon.py
echo "    cursor.execute(\"UPDATE hostsystem SET cpu_usage=%s, memory_usage=%s WHERE id=%s\", (cpu, mem, id))" >> nequz-wi-daemon.py
echo "    conn.commit()" >> nequz-wi-daemon.py
echo "    print (\"CPU: \" + str(cpu) + \"%\")" >> nequz-wi-daemon.py
echo "    print (\"Memory: \" + str(mem) + \"%\")" >> nequz-wi-daemon.py
echo "    print (\"Uptime: \" + str(uptime) + \" seconds\")" >> nequz-wi-daemon.py
echo "    print (\"---------------------------------\")" >> nequz-wi-daemon.py
echo "    time.sleep($duration)" >> nequz-wi-daemon.py

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


