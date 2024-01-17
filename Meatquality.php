<?php
// Step 1: Connect to the Database
$connection = mysqli_connect("localhost", "root", "", "meatquality");

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Continue with the query
$query = "SELECT * FROM sensor_data";
$result = mysqli_query($connection, $query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}

// Step 3: Process Data
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data['temperature'][] = $row['temperature'];
    $data['gas'][] = $row['gas'];
    $data['timestamp'][] = $row['timestamp'];
}

// Step 4-6: Choose a Graphing Library, Include Library, Create Container
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sensor_data Graph</title>
    <!-- Step 5: Include the Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Step 6: Create Containers -->
    <div style="width: 80%; margin: auto;">
        <!-- Container for Temperature Chart -->
        <canvas id="temperatureChart"></canvas>
    </div>

    <div style="width: 80%; margin: auto;">
        <!-- Container for Gas Chart -->
        <canvas id="gasChart"></canvas>
    </div>

    <!-- Step 7: Write JavaScript Code -->
    <script>
        // Temperature Chart
        var temperatureCtx = document.getElementById('temperatureChart').getContext('2d');
        var temperatureChart = new Chart(temperatureCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($data['timestamp']); ?>,
                datasets: [{
                    label: 'TEMPERATURE Dataset',
                    data: <?php echo json_encode($data['temperature']); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                // Customize chart options as needed
            }
        });

        // Gas Chart
        var gasCtx = document.getElementById('gasChart').getContext('2d');
        var gasChart = new Chart(gasCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($data['timestamp']); ?>,
                datasets: [{
                    label: 'GAS Dataset',
                    data: <?php echo json_encode($data['gas']); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                // Customize chart options as needed
            }
        });
    </script>
</body>
</html>

<?php
// Close the database connection
mysqli_close($connection);
?>

