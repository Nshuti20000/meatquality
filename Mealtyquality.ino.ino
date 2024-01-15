#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>

#define SCREEN_WIDTH 128 // OLED display width,  in pixels
#define SCREEN_HEIGHT 64 // OLED display height, in pixels

// declare an SSD1306 display object connected to I2C
Adafruit_SSD1306 oled(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, -1);

void setup() {
  Serial.begin(9600);
  pinMode(A0, INPUT); // Set A0 as input for temperature
  pinMode(A1, INPUT); // Set A1 as input for gas
  pinMode(2, OUTPUT); // Set the D2 pin to output mode
 
}

void loop() {
  // Generate a random temperature between 10 and 30 degrees
  float temperature = random(10, 31);
  int rawGasValue = analogRead(A1);
  float gas = (rawGasValue / 1000.0) * 100.0;  // Convert to percentage
//Serial.println("Meat quality detector");
  // Display on Serial Monitor
  Serial.print("{");
  Serial.print("\"Temperature\": ");
  Serial.print(temperature);
  Serial.print(", \"Gas\": ");
  Serial.print(gas);
  Serial.println("}");

  delay(1000); // Adjust the delay based on your application needs
}
