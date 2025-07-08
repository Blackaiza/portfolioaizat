#define RXD2 16
#define TXD2 17
#define M0 26
#define M1 27

void setup() {
  Serial.begin(115200);
  Serial2.begin(9600, SERIAL_8N1, RXD2, TXD2);

  pinMode(M0, OUTPUT);
  pinMode(M1, OUTPUT);
  digitalWrite(M0, LOW);
  digitalWrite(M1, LOW); // Normal mode

  delay(500);
  Serial.println("Master Ready");
}

void loop() {
  String msg = "Hello from Master!";
  Serial2.print(msg);          // Send main message
  Serial2.write((char)220);    // Fake RSSI byte for test

  Serial.print("Sent: ");
  Serial.println(msg);

  delay(3000);
}
