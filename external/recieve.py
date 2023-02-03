#******************************* Module Header ******************************\
 # Module Name:  recieve.py
 # Project:      NequZWI
 # Copyright (c) NequZ
 #
 # This file contains the code for the server that receives the Informations from another Server
 # and saves it in the Database. You need to run that Script on the MainServer. Where the MainDatabase is / Website is.
 #
 # GNU GENERAL PUBLIC LICENSE
 # Version 3, 29 June 2007
 #
 # Copyright (C) 2007 Free Software Foundation, Inc. <https://fsf.org/>
 # Everyone is permitted to copy and distribute verbatim copies
 # of this license document, but changing it is not allowed.
 #
 # \***************************************************************************/




from flask import Flask, request
import mysql.connector

app = Flask(__name__)

@app.route("/server_info", methods=["POST"])
def receive_server_info():
    server_id = request.form["server_id"]
    cpu_percent = float(request.form["cpu_percent"])
    virtual_memory = float(request.form["virtual_memory"])
    ip = request.form["ip"]

    conn = mysql.connector.connect(
        host="localhost",
        database="nequzwi",
        user="root",
        password="" # Enter your Password here
    )

    cursor = conn.cursor()

    cursor.execute("SELECT id FROM hostsystem WHERE id = %s", (server_id,))
    result = cursor.fetchone()

    if result:
        # Server id exists, update the row
        cursor.execute(
            "UPDATE hostsystem SET ip = %s, memory_usage = %s, cpu_usage = %s WHERE id = %s",
            (ip, virtual_memory, cpu_percent, server_id)
        )
    else:
        # Server id does not exist, insert a new row
        cursor.execute(
            "INSERT INTO hostsystem (id, ip, memory_usage, cpu_usage) VALUES (%s, %s, %s, %s)",
            (server_id, ip, cpu_percent, virtual_memory)
        )

    conn.commit()
    cursor.close()
    conn.close()

    return "OK"




if __name__ == "__main__":
    app.run(host='0.0.0.0') # If you just want to run it on your local machine, you can remove the host='

