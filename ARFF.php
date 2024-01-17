<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "meatquality";
$port = 3306; // Change this if your MySQL server is running on a different port

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database, $port);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the database
$query = "SELECT temperature, gas FROM sensor_data";
$result = mysqli_query($conn, $query);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Generate ARFF content
$arffContent = "@relation sensor_data\n\n";
$arffContent .= "@attribute temperature numeric\n";
$arffContent .= "@attribute gas numeric\n\n";
$arffContent .= "@data\n";

foreach ($data as $row) {
    $arffContent .= $row['temperature'] . ',' . $row['gas'] . "\n";
}

// Close connection
mysqli_close($conn);

// Provide the ARFF file for download
header('Content-type: application/octet-stream');
header('Content-Disposition: attachment; filename="data.arff"');
echo $arffContent;
?>
