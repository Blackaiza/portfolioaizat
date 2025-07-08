#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include <TinyGPS++.h>
#include <SoftwareSerial.h>

// OLED settings
#define SCREEN_WIDTH 128
#define SCREEN_HEIGHT 64
#define OLED_RESET    -1
Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, OLED_RESET);

// GPS on SoftwareSerial
SoftwareSerial gpsSerial(4, 3); // TX, RX
TinyGPSPlus gps;

// View switch timer
unsigned long lastSwitch = 0;
const unsigned long viewDuration = 5000;
int currentView = 0; // 0 = Info, 1 = Coordinates

// ==== Icons (8x8) ====
const unsigned char gps_icon [] PROGMEM = {
  0x18, 0x3C, 0x66, 0xFF, 0x81, 0xFF, 0x42, 0x3C
};

const unsigned char speed_icon [] PROGMEM = {
  0x3C, 0x42, 0xA9, 0x85, 0x91, 0xA9, 0x42, 0x3C
};

const unsigned char clock_icon [] PROGMEM = {
  0x3C, 0x42, 0x81, 0x85, 0x89, 0x91, 0x42, 0x3C
};

const unsigned char sat_icon [] PROGMEM = {
  0x00, 0x66, 0x99, 0x81, 0x81, 0x99, 0x66, 0x00
};

void setup() {
  Serial.begin(9600);
  gpsSerial.begin(9600);

  if (!display.begin(SSD1306_SWITCHCAPVCC, 0x3C)) {
    Serial.println(F("OLED init failed"));
    while (true);
  }

  display.clearDisplay();
  display.setTextColor(SSD1306_WHITE);
  display.setTextSize(1);
  display.setCursor(0, 0);
  display.println(F("Waiting for GPS..."));
  display.display();
}

void loop() {
  while (gpsSerial.available()) {
    gps.encode(gpsSerial.read());
  }

  if (millis() - lastSwitch > viewDuration) {
    currentView = (currentView + 1) % 2;
    lastSwitch = millis();
  }

  display.clearDisplay();

  if (!gps.location.isValid()) {
    display.setCursor(0, 0);
    display.println(F("No GPS Signal"));
    display.display();
    return;
  }

  // Print to Serial Monitor
  Serial.print(F("Speed (km/h): "));
  Serial.println(gps.speed.kmph());

  Serial.print(F("Latitude: "));
  Serial.println(gps.location.lat(), 6);

  Serial.print(F("Longitude: "));
  Serial.println(gps.location.lng(), 6);

  Serial.print(F("Satellites: "));
  Serial.println(gps.satellites.isValid() ? gps.satellites.value() : -1);

  Serial.print(F("UTC Time: "));
  if (gps.time.isValid()) {
    int hourMY = (gps.time.hour() + 8) % 24;
    if (hourMY < 10) Serial.print('0');
    Serial.print(hourMY); Serial.print(':');
    if (gps.time.minute() < 10) Serial.print('0');
    Serial.print(gps.time.minute()); Serial.print(':');
    if (gps.time.second() < 10) Serial.print('0');
    Serial.println(gps.time.second());
  } else {
    Serial.println(F("--:--:--"));
  }

  // === Display ===
  if (currentView == 0) {
    // --- View 0: GPS Info ---
    display.drawBitmap(0, 0, gps_icon, 8, 8, WHITE);
    display.setCursor(12, 0);
    display.println(F("GPS Info"));

    display.drawBitmap(0, 16, speed_icon, 8, 8, WHITE);
    display.setCursor(12, 16);
    display.print(F("Speed: "));
    display.print(gps.speed.kmph(), 1);
    display.println(F(" km/h"));

    display.drawBitmap(0, 32, clock_icon, 8, 8, WHITE);
    display.setCursor(12, 32);
    display.print(F("Time: "));
    if (gps.time.isValid()) {
      int hourMY = (gps.time.hour() + 8) % 24;
      if (hourMY < 10) display.print('0');
      display.print(hourMY); display.print(':');
      if (gps.time.minute() < 10) display.print('0');
      display.print(gps.time.minute()); display.print(':');
      if (gps.time.second() < 10) display.print('0');
      display.print(gps.time.second());
    } else {
      display.print(F("--:--:--"));
    }

    display.drawBitmap(0, 48, sat_icon, 8, 8, WHITE);
    display.setCursor(12, 48);
    display.print(F("Satellites: "));
    if (gps.satellites.isValid()) {
      display.print(gps.satellites.value());
    } else {
      display.print(F("--"));
    }

  } else {
    // --- View 1: Coordinates ---
    display.setCursor(0, 0);
    display.println(F("Coordinates"));

    display.setCursor(0, 16);
    display.print(F("Lat: "));
    display.println(gps.location.lat(), 6);

    display.setCursor(0, 32);
    display.print(F("Lng: "));
    display.println(gps.location.lng(), 6);
  }

  display.display();
  delay(200);
}
