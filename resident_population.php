<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'jk');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize arrays for storing data
$addresses = [];
$genders = [];
$ages = [];
$statuses = [];

// Query to fetch residents
$sql = "SELECT address, gender, age, status FROM resident";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Process address data
        $address = $row['address'];
        if (isset($addresses[$address])) {
            $addresses[$address]++;
        } else {
            $addresses[$address] = 1;
        }

        // Process gender data
        $gender = $row['gender'];
        if (isset($genders[$gender])) {
            $genders[$gender]++;
        } else {
            $genders[$gender] = 1;
        }

        // Process age data
        $age = $row['age'];
        $ages[] = $age;

        // Process status data
        $status = $row['status'];
        if (isset($statuses[$status])) {
            $statuses[$status]++;
        } else {
            $statuses[$status] = 1;
        }
    }
} else {
    echo "0 results";
}
$conn->close();

// Prepare data for JavaScript
$addressLabels = json_encode(array_keys($addresses));
$addressValues = json_encode(array_values($addresses));

$genderLabels = json_encode(array_keys($genders));
$genderValues = json_encode(array_values($genders));

$ageBins = range(0, 100, 10);
$ageLabels = json_encode(array_map(function($bin) { return $bin . '-' . ($bin + 9); }, $ageBins));

$ageCounts = array_fill(0, count($ageBins), 0);
foreach ($ages as $age) {
    $index = floor($age / 10);
    if ($index >= count($ageCounts)) $index = count($ageCounts) - 1;
    $ageCounts[$index]++;
}
$ageValues = json_encode($ageCounts);

$statusLabels = json_encode(array_keys($statuses));
$statusValues = json_encode(array_values($statuses));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="images/jasaanknown.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: azure;
        }

        .sidebar {
            background-color: gainsboro;
            padding: 20px;
        }

        .sidebar .profile img {
            width: 100px;
            border-radius: 50%;
        }

        .sidebar .profile p {
            margin: 10px 0;
        }

        .nav-link {
            color: #000;
        }

        .nav-link.active {
            font-weight: bold;
        }

        .content {
            padding: 20px;
        }

        .chart-container {
            margin-bottom: 30px;
        }

        .chart-container canvas {
            max-width: 100%;
        }

        .sidebar2 {
            width: 300px;
            padding: 20px;
            background-color: #f8f9fa;
            border-left: 1px solid #ddd;
        }

        .sidebar2 h2, .sidebar2 h3 {
            color: #2a2a2a;
        }

        .sidebar2 h2 {
            font-size: 1.5em;
            margin-bottom: 0.5em;
        }

        .sidebar2 h3 {
            font-size: 1.25em;
            margin-bottom: 1em;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 1em;
            padding: 10px;
            background-color: #e9ecef;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .feature-item:hover {
            background-color: gainsboro;
        }

        .icon {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }

        .sidebar .logo {
            font-size: 24px;
            font-weight: 700;
            height: 56px;
            display: flex;
            align-items: center;
            color: var(--danger);
            z-index: 500;
            padding-bottom: 20px;
            box-sizing: content-box;
        }

        .sidebar .logo .logo-name {
            margin-left: 10px;
        }

        .sidebar .logo .logo-name span {
            color: var(--warning);
        }

        .sidebar .logo .bx {
            min-width: 60px;
            display: flex;
            justify-content: center;
            font-size: 2.2rem;
        }

        .container-fluid {
            display: flex;
        }

        .col-md-2.sidebar {
            order: 1;
        }

        .col-md-7.content {
            order: 2;
            flex: 1;
        }

        .col-md-3.sidebar2 {
            order: 3;
        }
    </style>
</head>
<body>

    <div class="container-fluid">
        <div class="col-md-2 sidebar">
            <a href="#" class="logo">
                <div class="logo-name"><span>Jasaan</span>Known</div>
            </a>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="usersdash.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Explore Jasaan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Municipality of Jasaan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Lower Jasaan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Upper Jasaan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Kimaya</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Jampason</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Bobontugan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Solana</a>
                </li>
            </ul>
        </div>

        <div class="col-md-7 content">
            <!-- Address Distribution Chart -->
            <div class="chart-container">
                <h3>Address Distribution</h3>
                <canvas id="addressChart" width="400" height="200"></canvas>
            </div>

            <!-- Gender Distribution Chart -->
            <div class="chart-container">
                <h3>Gender Distribution</h3>
                <canvas id="genderChart" width="400" height="200"></canvas>
            </div>

            <!-- Age Distribution Chart -->
            <div class="chart-container">
                <h3>Age Distribution</h3>
                <canvas id="ageChart" width="400" height="200"></canvas>
            </div>

            <!-- Status Distribution Chart -->
            <div class="chart-container">
                <h3>Status Distribution</h3>
                <canvas id="statusChart" width="400" height="200"></canvas>
            </div>
        </div>

        <div class="col-md-3 sidebar2">
            <h2>Check Informations by Category</h2>
            <a href="resident_population.php" class="feature-item resident-management">
        <i class="icon fas fa-users"></i>
        <span class="text">Resident Population</span>
    </a>
    <a href="household_information.php" class="feature-item household-information">
        <i class="icon fas fa-home"></i>
        <span class="text">Household Information</span>
    </a>
    <a href="Attractions.php" class="feature-item record-keeping">
        <i class="icon fas fa-file-alt"></i>
        <span class="text">Recreation spots</span>
    </a>
    <a href="complaints_feedback.php" class="feature-item complaints-feedback">
        <i class="icon fas fa-comments"></i>
        <span class="text">Complaints and Feedback</span>
    </a>
    <a href="disaster_preparedness.php" class="feature-item disaster-preparedness">
        <i class="icon fas fa-building"></i>
        <span class="text">Establishments</span>
    </a>
    <a href="events_activities.php" class="feature-item security-access">
        <i class="icon fas fa-handshake"></i>
        <span class="text">Events and Activities</span>
    </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Address Distribution Chart
        var ctxAddress = document.getElementById('addressChart').getContext('2d');
        var addressChart = new Chart(ctxAddress, {
            type: 'bar',
            data: {
                labels: <?php echo $addressLabels; ?>,
                datasets: [{
                    label: 'Address Distribution',
                    data: <?php echo $addressValues; ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Gender Distribution Chart
        var ctxGender = document.getElementById('genderChart').getContext('2d');
        var genderChart = new Chart(ctxGender, {
            type: 'pie',
            data: {
                labels: <?php echo $genderLabels; ?>,
                datasets: [{
                    label: 'Gender Distribution',
                    data: <?php echo $genderValues; ?>,
                    backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)'],
                    borderWidth: 1
                }]
            }
        });

        // Age Distribution Chart
        var ctxAge = document.getElementById('ageChart').getContext('2d');
        var ageChart = new Chart(ctxAge, {
            type: 'line',
            data: {
                labels: <?php echo $ageLabels; ?>,
                datasets: [{
                    label: 'Age Distribution',
                    data: <?php echo $ageValues; ?>,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Status Distribution Chart
        var ctxStatus = document.getElementById('statusChart').getContext('2d');
        var statusChart = new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: <?php echo $statusLabels; ?>,
                datasets: [{
                    label: 'Status Distribution',
                    data: <?php echo $statusValues; ?>,
                    backgroundColor: ['rgba(255, 159, 64, 0.2)', 'rgba(255, 205, 86, 0.2)'],
                    borderColor: ['rgba(255, 159, 64, 1)', 'rgba(255, 205, 86, 1)'],
                    borderWidth: 1
                }]
            }
        });
    </script>
</body>
</html>
