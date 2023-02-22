<!DOCTYPE html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "skripsi";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM skripsi ORDER BY Waktu DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
} else {
  echo "0 results";
}
$conn->close();
?>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<head>
  <script>
    $(document).ready(function()
    {
      setInterval(function(){
        $("#nilai").load("#nilai");
      },1000);
    });
  </script>
  <title>Skripsi Ade Kurniawan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="icon" href="data:,">
  <style>
    html {font-family: Arial; display: inline-block; text-align: center;}
    h1 {  font-size: 2rem;}
    body {  margin: 0;}
    .topnav { overflow: hidden; background-color: #2f4468; color: white; font-size: 1.7rem; }
    .content { padding: 20px; }
    .card { background-color: white; box-shadow: 2px 2px 12px 1px rgba(140,140,140,.5); }
    .cards { max-width: 700px; margin: 0 auto; display: grid; grid-gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); }
    .reading { font-size: 2.8rem; }
    .timestamp { color: #bebebe; font-size: 1rem; }
    .card-title{ font-size: 1.2rem; font-weight : bold; }
    .card.temperature { color: #B10F2E; }
    .card.humidity { color: #50B8B4; }
    .card.lux{ color: aquamarine;}
  </style>
</head>
<body id="nilai">
  <div class="topnav">
    <h1>Node 1</h1>
  </div>
  <div class="content">
    <div class="cards">
      <div class="card temperature">
        <p class="card-title"><i class="fas fa-thermometer-half"></i> TEMPERATURE</p><p><span class="reading"><span id="temp"><?php echo $row["temp1"];?></span> &deg;C</span></p><p class="timestamp">Last Reading: <?php echo $row["Waktu"];?><span id="rt1"></span></p>
      </div>
      <div class="card humidity">
        <p class="card-title"><i class="fas fa-tint"></i> HUMIDITY</p><p><span class="reading"><span id="hum"><?php echo $row["hum1"];?></span> &percnt;</span></p><p class="timestamp">Last Reading: <?php echo $row["Waktu"];?><span id="rh1"></span></p>
      </div>
      <div class="card lux">
        <p class="card-title"><i class="fas fa-thermometer-half"></i> INTENSITAS CAHAYA</p><p><span class="reading"><span id="lux"><?php echo $row["lux1"];?></span> Lux
        </span></p><p class="timestamp">Last Reading: <?php echo $row["Waktu"];?><span id="rt2"></span></p>
    </div>
  </div>
  <span><p></p></span>
  <div class="topnav">
    <h1>Node 2</h1>
  </div>
  <div class="content">
    <div class="cards">
      <div class="card temperature">
        <p class="card-title"><i class="fas fa-thermometer-half"></i> TEMPERATURE</p><p><span class="reading"><span id="temp"><?php echo $row["temp2"];?></span> &deg;C</span></p><p class="timestamp">Last Reading: <?php echo $row["Waktu"];?><span id="rt1"></span></p>
      </div>
      <div class="card humidity">
        <p class="card-title"><i class="fas fa-tint"></i> HUMIDITY</p><p><span class="reading"><span id="hum"><?php echo $row["hum2"];?></span> &percnt;</span></p><p class="timestamp">Last Reading: <?php echo $row["Waktu"];?><span id="rh1"></span></p>
      </div>
      <div class="card lux" >
        <p class="card-title"><i class="fas fa-thermometer-half"></i> INTENSITAS CAHAYA</p><p><span class="reading"><span id="lux"><?php echo $row["lux2"];?></span> Lux
        </span></p><p class="timestamp">Last Reading: <?php echo $row["Waktu"];?><span id="rt2"></span></p>
    </div>
  </div>
  <span><p></p></span>
  <div class="topnav">
    <h1>Node 3</h1>
  </div>
  <div class="content">
    <div class="cards">
      <div class="card temperature">
        <p class="card-title"><i class="fas fa-thermometer-half"></i> TEMPERATURE</p><p><span class="reading"><span id="temp"><?php echo $row["temp3"];?></span> &deg;C</span></p><p class="timestamp">Last Reading: <span id="rt1"></span></p>
      </div>
      <div class="card humidity">
        <p class="card-title"><i class="fas fa-tint"></i> HUMIDITY</p><p><span class="reading"><span id="hum"><?php echo $row["hum3"];?></span> &percnt;</span></p><p class="timestamp">Last Reading: <span id="rh1"></span></p>
      </div>
      <div class="card lux" >
        <p class="card-title"><i class="fas fa-thermometer-half"></i> INTENSITAS CAHAYA</p><p><span class="reading"><span id="lux"><?php echo $row["lux3"];?></span> Lux
        </span></p><p class="timestamp">Last Reading: <span id="rt2"></span></p>
    </div>
  </div>
  </body>
</html>
<center id="ade">
    <h1>Export Data ke Excel</h1>
  <form action="data.php" method="post">
      <label for="start-date">Start Date:</label>
      <input type="datetime-local" id="start-date" name="start-date">
      <br><br>
      <label for="end-date">End Date:</label>
      <input type="datetime-local" id="end-date" name="end-date">
      <br><br>
      <input href="data.php" type="submit" value="Export">
    </form>
  <p><a href="semua_data.php"><button>Export semua Data ke Excel</button></a></p>
  </center>