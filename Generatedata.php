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

// Function to generate random temperature and gas data
function generateRandomData() {
    $temperature = rand(10, 45); // Random temperature between 10 and 45 degrees Celsius
    $gas = rand(5, 50); // Random gas level between 5 and 50 unit

    return array('temperature' => $temperature, 'gas' => $gas);
}

// Insert data into the database
for ($i = 0; $i < 1000000; $i++) { // Change 100000 to the number of records you want to insert
    $data = generateRandomData();
    $temperature = $data['temperature'];
    $gas = $data['gas'];

    $sql = "INSERT INTO sensor_data (temperature, gas) VALUES ($temperature, $gas)";

    if (mysqli_query($conn, $sql)) {
        echo "Record $i inserted successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>
