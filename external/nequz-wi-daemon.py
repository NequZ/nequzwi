#******************************* Module Header ******************************\
 # Module Name:  nequz-wi-daemon.py
 # Project:      NequZWI
 # Copyright (c) NequZ
 #
 # This file contains the code for the daemon that sends the Informations to the Mainserver. You need to run that Script on the Hostsystems
 # you want to monitor and use.
 #
 # GNU GENERAL PUBLIC LICENSE
 # Version 3, 29 June 2007
 #
 # Copyright (C) 2007 Free Software Foundation, Inc. <https://fsf.org/>
 # Everyone is permitted to copy and distribute verbatim copies
 # of this license document, but changing it is not allowed.
 #
 # \***************************************************************************/


import requests
import os
import psutil



vm = psutil.virtual_memory()
def send_server_info():
    url = "http://YOURIP:5000/server_info" #Enter the IP from the Hostsystem here.
    cpu_percent = psutil.cpu_percent()
    virtual_memory = (vm.total - vm.available) / vm.total * 100


    # Get the server_id from a text file
    with open("id.txt", "r") as file:
        server_id = int(file.read().strip())

    public_ip = requests.get("https://api.ipify.org").text
    data = {
        "server_id": server_id,
        "cpu_percent": cpu_percent,
        "virtual_memory": virtual_memory,
        "ip": public_ip

    }

    requests.post(url, data=data)

if __name__ == "__main__":
    send_server_info()
    print("Server info sent")
