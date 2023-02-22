#include "painlessMesh.h"
#include <Arduino_JSON.h>
#include <DHT.h>
int outputpin= A0;
const int LDR_PIN = 16;   
int ldrValue = 0;  

// MESH Details
#define   MESH_PREFIX     "SKRIPSI_ADE" //name for your MESH
#define   MESH_PASSWORD   "ade1232580" //password for your MESH
#define   MESH_PORT       5555 //default port

#define DHTPIN 12
#define DHTTYPE DHT11

DHT dht(DHTPIN, DHTTYPE);
float h = 0.0;

//Number for this node
int nodeNumber = 1;

//String to send to other nodes with sensor readings
String readings;

Scheduler userScheduler; // to control your personal task
painlessMesh  mesh;

// User stub
void sendMessage() ; // Prototype so PlatformIO doesn't complain
String getReadings(); // Prototype for sending sensor readings

//Create tasks: to send messages and get readings;
Task taskSendMessage(TASK_SECOND * 5 , TASK_FOREVER, &sendMessage);

String getReadings () {
int analogValue = analogRead(outputpin);
float millivolts = (analogValue/1024.0) * 3300;
float celsius = millivolts/1;
ldrValue = analogRead(LDR_PIN); 
  JSONVar jsonReadings;
  jsonReadings["temp1"] = celsius;
  jsonReadings["hum1"] = dht.readHumidity();
  jsonReadings["lux1"] = ldrValue;
  readings = JSON.stringify(jsonReadings);
  Serial.println(readings);
  return readings;
}

void sendMessage () {
  String msg = getReadings();
  mesh.sendBroadcast(msg);
}


// Needed for painless library
void receivedCallback( uint32_t from, String &msg ) {
  JSONVar myObject = JSON.parse(msg.c_str());
}

void newConnectionCallback(uint32_t nodeId) {
  Serial.printf("New Connection, nodeId = %u\n", nodeId);
}

void changedConnectionCallback() {
  Serial.printf("Changed connections\n");
}

void nodeTimeAdjustedCallback(int32_t offset) {
  Serial.printf("Adjusted time %u. Offset = %d\n", mesh.getNodeTime(),offset);
}

void setup() {
  Serial.begin(115200);
  
dht.begin();

  //mesh.setDebugMsgTypes( ERROR | MESH_STATUS | CONNECTION | SYNC | COMMUNICATION | GENERAL | MSG_TYPES | REMOTE ); // all types on
  mesh.setDebugMsgTypes( ERROR | STARTUP );  // set before init() so that you can see startup messages

  mesh.init( MESH_PREFIX, MESH_PASSWORD, &userScheduler, MESH_PORT );
  mesh.onReceive(&receivedCallback);
  mesh.onNewConnection(&newConnectionCallback);
  mesh.onChangedConnections(&changedConnectionCallback);
  mesh.onNodeTimeAdjusted(&nodeTimeAdjustedCallback);

  userScheduler.addTask(taskSendMessage);
  taskSendMessage.enable();
}

void loop() {
  // it will run the user scheduler as well
  mesh.update();
}
