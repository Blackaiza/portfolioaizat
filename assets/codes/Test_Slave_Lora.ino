#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>

#define SCREEN_WIDTH 128
#define SCREEN_HEIGHT 64
#define OLED_RESET    -1
Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, OLED_RESET);

#define RXD2 16
#define TXD2 17
#define M0 26
#define M1 27

int packetCount = 0;

void setup() {
  Serial.begin(115200);
  Serial2.begin(9600, SERIAL_8N1, RXD2, TXD2);
  Wire.begin(21, 22);

  pinMode(M0, OUTPUT);
  pinMode(M1, OUTPUT);
  digitalWrite(M0, LOW);
  digitalWrite(M1, LOW); // Normal mode

  if (!display.begin(SSD1306_SWITCHCAPVCC, 0x3C)) {
    Serial.println(F("OLED failed"));
    for (;;);
  }

  display.clearDisplay();
  display.setTextColor(SSD1306_WHITE);
  display.setTextSize(1);
  display.setCursor(0, 0);
  display.print("Listening...");
  display.display();

  delay(500);
}

void loop() {
  if (Serial2.available()) {
    String msg = "";
    while (Serial2.available()) {
      char c = Serial2.read();
      msg += c;
      delay(2);  // wait for next byte
    }

    if (msg.length() > 1) {
      packetCount++;
      int rssiValue = (unsigned char)msg[msg.length() - 1];
      msg.remove(msg.length() - 1);
      int rssiDbm = -(256 - rssiValue);

      Serial.print("Received: ");
      Serial.println(msg);
      Serial.print("RSSI: ");
      Serial.print(rssiDbm);
      Serial.println(" dBm");

      display.clearDisplay();
      display.setCursor(0, 0);
      display.print("Msg: ");
      display.println(msg);
      display.print("RSSI: ");
      display.print(rssiDbm);
      display.println(" dBm");
      display.print("Pkt #: ");
      display.println(packetCount);
      display.display();
    }
  }
}
