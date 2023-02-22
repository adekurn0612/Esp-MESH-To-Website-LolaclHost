<?php
  
  // Connect to MySQL database
  $db_connection = mysqli_connect("localhost", "root", "", "skripsi");
  
  // Check the connection
  if (!$db_connection) {
      die("Connection failed: " . mysqli_connect_error());
  }
  
  $start_date = $_POST["start-date"];
  $end_date = $_POST["end-date"];

  // Select the data to be exported
  $sql = "SELECT * FROM skripsi WHERE Waktu BETWEEN '$start_date' AND '$end_date'";
  $result = mysqli_query($db_connection, $sql);
  
  // Check the result
  if (!$result) {
      die("Query failed: " . mysqli_error($db_connection));
  }
  
  // Headers for the Excel file
  date_default_timezone_set("Asia/Jakarta");
  header("Content-Type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=data monitoring dari " . $start_date . "_sampai_" . $end_date . " diexport pada:" . date("d-m-Y_H:i:s") . " .xls");
  
  // Write the data to the file
  echo "<table style='border: 1px solid black; border-collapse: collapse; text-align: center;'>";
  echo "<tr style='border: 1px solid black;'>";
  echo "<th style='border: 1px solid black;'>waktu</th>";
  echo "<th style='border: 1px solid black;'>Temperature node 1</th>";
  echo "<th style='border: 1px solid black;'>Humidity Node 1</th>";
  echo "<th style='border: 1px solid black;'>Intensitas Cahaya Node 1</th>";
  echo "<th style='border: 1px solid black;'>Temperature node 2</th>";
  echo "<th style='border: 1px solid black;'>Humidity Node 2</th>";
  echo "<th style='border: 1px solid black;'>Intensitas Cahaya Node 2</th>";
  echo "<th style='border: 1px solid black;'>Temperature node 3</th>";
  echo "<th style='border: 1px solid black;'>Humidity Node 3</th>";
  echo "<th style='border: 1px solid black;'>Intensitas Cahaya Node 3</th>";
  echo "</tr>";
  // echo "<table><tr><th>Waktu</th><th>Temperature node 1</th><th>Humidity Node 1</th><th>Intensitas Cahaya Node 1</th><th>Temperature node 2</th><th>Humidity Node 2</th><th>Intensitas Cahaya Node 2</th><th>Temperature node 3</th><th>Humidity Node 3</th><th>Intensitas Cahaya Node 3</th></tr>";
  while($row = mysqli_fetch_array($result)) {
      echo "<tr style='border: 1px solid black; text-align: center;'>";
      echo "<td style='border: 1px solid black;'>" . $row['Waktu'] . "</td>";
      echo "<td style='border: 1px solid black;'>" . $row['temp1'] . "</td>";
      echo "<td style='border: 1px solid black;'>" . $row['hum1'] . "</td>";
      echo "<td style='border: 1px solid black;'>" . $row['lux1'] . "</td>";
      echo "<td style='border: 1px solid black;'>" . $row['temp2'] . "</td>";
      echo "<td style='border: 1px solid black;'>" . $row['hum2'] . "</td>";
      echo "<td style='border: 1px solid black;'>" . $row['lux2'] . "</td>";
      echo "<td style='border: 1px solid black;'>" . $row['temp3'] . "</td>";
      echo "<td style='border: 1px solid black;'>" . $row['hum3'] . "</td>";
      echo "<td style='border: 1px solid black;'>" . $row['lux3'] . "</td>";
      echo "</tr>";


  }
  echo "</table>";
  
  // Close the connection
  mysqli_close($db_connection);
  
?>
