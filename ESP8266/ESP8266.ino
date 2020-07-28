#include <SoftwareSerial.h>
SoftwareSerial ARD_ESP(14,12);
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <Arduino_JSON.h>
#include <ESP8266WiFiMulti.h>
ESP8266WiFiMulti WiFiMulti;
const char* ssid = "ThemNguyen";
const char* password = "themnguyen";
IPAddress gateway(192, 168, 43, 1); 
IPAddress subnet(255, 255, 255, 0); 
String host = "http://themvn.icu/bao-loi/";
//int  reportid[3] = {1,2,3};
//IPAddress ip(192, 168, 43, 141);
int  reportid[3] = {4,5,6};
IPAddress ip(192, 168, 43, 142);
int ledPin = 2;
WiFiServer server(80);
 
void setup() {
    Serial.begin(9600);
    ARD_ESP.begin(9600);
    pinMode(ledPin, OUTPUT);
    digitalWrite(ledPin, LOW);    
    // Kết nỗi với wifi
    Serial.println();
    Serial.println();
    Serial.print("Connecting to ");
//    WiFi.config(ip, gateway, subnet);
    Serial.println(ssid);     
    WiFi.begin(ssid, password);     
    while (WiFi.status() != WL_CONNECTED) {
      delay(500);
      Serial.print(".");
    }
    Serial.println("");
    Serial.println("WiFi connected");
    server.begin();
    Serial.println("Server started");
    // In địa chỉ IP 
    Serial.print("Use this URL to connect: ");
    Serial.print("http://");
    Serial.print(WiFi.localIP());
    Serial.println("/");
}
String inData;
int ID;
bool incom=false;
String serverName = " ";
// Update interval time set to 5 seconds
const long interval = 5000;
unsigned long previousMillis = 0;

String outputsState; 
bool error_lora_TTL=false;
char buff[100],id_char[20],level_char[20];
char A[5];
bool Ngung_connect=false;
void loop() {
  // Đọc data
  read_arduino(); 
  if ((WiFiMulti.run() == WL_CONNECTED)&& error_lora_TTL==true && ID!=0) {
      outputsState = httpGETRequest(serverName);
      error_lora_TTL=false;
      Serial.println(serverName);
  }
  ID=1000;
  
  // Kiểm tra xem đã connect chưa
  WiFiClient client = server.available();
  if (client)
  {
    String request = client.readStringUntil('\r');
    client.flush();
    
    //GET /?ledid=0001&level=00; 
    request.toCharArray(buff, 90);
    if(request.indexOf("ledid=") != -1) { 
      strncpy(id_char,buff+request.indexOf("ledid=")+6,4);
    }
    if(request.indexOf("level=") != -1) { 
      strncpy(level_char,buff+request.indexOf("level=")+6,2);
    }
    String id_string(id_char);
    //int ID=id_string.toInt();
    String level_string(level_char);
    //int DATA=level_string.toInt();
    ARD_ESP.println(level_string+id_string);
    Serial.println(level_string+id_string);
    client.println("HTTP/1.1 200 OK");
    client.println("Content-Type: application/json");
    client.println(""); // do not forget this one
    if(Ngung_connect!=true){
      client.print("OK");
    }else{
      client.print("Busy");
    }
  }
}
//------------------------------------------------------------------------
void read_arduino(){
 while (ARD_ESP.available() > 0)
    {
        char recieved = ARD_ESP.read();
        inData += recieved; 
        if (recieved == '\n')
        {
            Serial.print("Arduino Received: ");
            Serial.print(inData);
            if(inData=="I am busy"){
              Ngung_connect=true;
            }else {
              Ngung_connect=false;
            }
            ID=inData.toInt();
            if(inData == "+++\n"){
              Serial.println("OK. Press h for help.");
            }   
            inData = "";
        }
        incom=true;
  }
  if(incom==true){
    switch(ID){
      case 40:
         //send to server faile
         error_lora_TTL=true;
         serverName=host+String(reportid[0]);
      break;
      case 50:
         //send to server faile
         error_lora_TTL=true;
         serverName=host+String(reportid[1]);
      break;
      case 60:
         //send to server faile
         error_lora_TTL=true;
         serverName=host+String(reportid[2]);
      break;
    }
  }
}
String httpGETRequest(String serverName) {
  WiFiClient client;
  HTTPClient http;
  // Your IP address with path or Domain name with URL path 
  http.begin(client, serverName);
  // Send HTTP POST request
  int httpResponseCode = http.GET();
  String payload = "{}"; 
  if (httpResponseCode>0) {
    Serial.print("HTTP Response code: ");
    Serial.println(httpResponseCode);
    payload = http.getString();
  }
  else {
    Serial.print("Error code: ");
    Serial.println(httpResponseCode);
  }
  // Free resources
  http.end();
  return payload;
}
