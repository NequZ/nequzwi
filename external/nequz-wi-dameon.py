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

# Function to insert the data into the database
def insert_data(cpu_usage):
    sql = "INSERT INTO cpu_usage (usage) VALUES (%s)"
    cursor.execute(sql, (cpu_usage,))
    conn.commit()

# Continuously check the CPU usage and insert the data into the database
while True:
    cpu_usage = psutil.cpu_percent()
    insert_data(cpu_usage)
    time.sleep(180) # wait for 60 seconds before checking again