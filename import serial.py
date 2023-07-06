import serial
import time
import Adafruit_DHT

# Setup DHT sensor.
dht_pin = 7
dht_sensor = Adafruit_DHT.DHT11

# Setup serial communication with XBee.
serial_port = '/dev/ttyS0'  # change this to the appropriate serial port on your computer
baud_rate = 9600
ser = serial.Serial(serial_port, baud_rate)

while True:
    # Read temperature and humidity from DHT sensor.
    humidity, temperature = Adafruit_DHT.read_retry(dht_sensor, dht_pin)

    # Convert temperature and humidity to strings.
    temperature_str = '{:.2f}'.format(temperature)
    humidity_str = '{:.2f}'.format(humidity)

    # Concatenate temperature and humidity strings.
    data_str = humidity_str + '||' + temperature_str + '\n'

    # Send data to XBee.
    ser.write(data_str.encode())

    # Print data to console.
    print(data_str)

    # Wait for 3 minutes before repeating.
    time.sleep(180)
