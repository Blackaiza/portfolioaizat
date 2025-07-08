#define RXD2 16  // ESP32 RX pin connected to GPS TX
#define TXD2 17  // ESP32 TX pin connected to GPS RX
#define GPS_BAUD 9600

#include <HardwareSerial.h>

HardwareSerial gpsSerial(2);  // Use UART2

void setup() {
  Serial.begin(115200);  // Initialize serial monitor
  gpsSerial.begin(GPS_BAUD, SERIAL_8N1, RXD2, TXD2);  // Initialize GPS serial
  Serial.println("GPS serial started at 9600 baud");
}

void loop() {
  while (gpsSerial.available()) {
    char c = gpsSerial.read();
    Serial.print(c);  // Output raw NMEA data
  }
}
