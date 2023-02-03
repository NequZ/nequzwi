#!/bin/bash

# Install required packages
pip3 install mysql-connector-python
pip3 install psutil


echo "Welcome to the Nequz-WI Daemon installer! This script will install the daemon on your system."


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

