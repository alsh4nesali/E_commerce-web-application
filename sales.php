<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bookhaven";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

$result = mysqli_query($conn,"SELECT todayDate, COUNT(*) as count FROM tbl_orders GROUP BY todayDate");
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = ['label' => $row['todayDate'], 'value' => $row['count']];
}

// Format the data as JSON
$data_json = json_encode($data);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Donut Chart Example</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>
    <div style="margin: 2%;">
       <canvas id="donutChart" width="20" height="100"></canvas>
    </div>
   

    <script>
        // Get the data from PHP
        var data = <?php echo $data_json; ?>;

        // Create the donut chart
        var ctx = document.getElementById('donutChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: data.map(item => item.label),
                datasets: [{
                    data: data.map(item => item.value),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                cutoutPercentage: 30 // Adjust as needed, this will control the size of the hole in the middle of the doughnut chart
            }
        });
    </script>
</body>
</html>


