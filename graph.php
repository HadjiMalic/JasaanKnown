<?php
$link = mysqli_connect("localhost", "root", ""); // Connect to MySQL server
mysqli_select_db($link, "jk"); // Select the database
// Count residents based on their status
$status_counts = array(
    "Student" => 0,
    "Employed" => 0,
    "Unemployed" => 0,
    "Child" => 0,
    "Deceased" => 0
);
// Count residents based on their voter type
$voter_counts = array(
    "voter_yes" => 0,
    "voter_no" => 0
);
// Count residents based on their address
$address_counts = array();
// Fetch data from the database
$res = mysqli_query($link, "SELECT * FROM resident");
while ($row = mysqli_fetch_array($res)) {
    // Increment the count for the corresponding status
    $status = $row["status"];
    if (array_key_exists($status, $status_counts)) {
        $status_counts[$status]++;
    }
    // Increment the count for the corresponding voter type
    $voter = $row["voter"];
    if ($voter == "yes") {
        $voter_counts["voter_yes"]++;
    } elseif ($voter == "no") {
        $voter_counts["voter_no"]++;
    }
    // Increment the count for the corresponding address
    $address = $row["address"];
    // Get the first two words of the address
    $address_parts = explode(" ", $address);
    $short_address = implode(" ", array_slice($address_parts, 0, 2));
    // Increment the count for the corresponding address
    if (!isset($address_counts[$short_address])) {
        $address_counts[$short_address] = 1;
    } else {
        $address_counts[$short_address]++;
    }
}
mysqli_close($link); // Close the MySQL connection
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css">
    <title>Registered Activities</title>
<style>
    .container {
        width: 45%;
        margin: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: inline-block;
        vertical-align: top;
        background-color: #f9f9f9;
    }
    .chart-container {
        height: 300px; /* Adjust height as needed */
        width: 100%;
    }

    .sidebar .logo .logo-name{
        margin-left: 10px; /* Add space below the logo */
}
</style>
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript">
window.onload = function () {
var status_counts = <?php echo json_encode($status_counts); ?>; // Get PHP array into JavaScript
var voter_counts = <?php echo json_encode($voter_counts); ?>; // Get PHP array into JavaScript
var address_counts = <?php echo json_encode($address_counts); ?>; // Get PHP array into JavaScript
var status_chart = new CanvasJS.Chart("statusChartContainer", {
    theme: "light1",
    animationEnabled: true,
    title:{
        text: "Residents Data by Status"
    },
    data: [{
        type: "column",
        dataPoints: [
            { label: "Student", y: status_counts["Student"] },
            { label: "Employed", y: status_counts["Employed"] },
            { label: "Unemployed", y: status_counts["Unemployed"] },
            { label: "Child", y: status_counts["Child"] },
            { label: "Deceased", y: status_counts["Deceased"] }
        ]
    }]
});
status_chart.render();
var voter_chart = new CanvasJS.Chart("voterChartContainer", {
    theme: "light1",
    animationEnabled: true,
    title:{
        text: "Residents Data by Voter Type"
    },
    data: [{
        type: "column",
        dataPoints: [
            { label: "Voter (Yes)", y: voter_counts["voter_yes"] },
            { label: "Voter (No)", y: voter_counts["voter_no"] }
        ]
    }]
});
voter_chart.render();
var address_chart = new CanvasJS.Chart("addressChartContainer", {
    theme: "light1",
    animationEnabled: true,
    title:{
        text: "Residents Data by Address"
    },
    data: [{
        type: "column",
        dataPoints: <?php echo json_encode(array_map(function($address, $count) {
            return array("label" => $address, "y" => $count);
        }, array_keys($address_counts), $address_counts)); ?>
    }]
});
address_chart.render();
}
</script>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <div class="logo-name"><span>Jasaan</span>Known</div>
        </a>
        <ul class="side-menu">
            <li class="active"><a href="dashboard.php" onclick="redirectTo('dashboard.php')"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li class=""><a href="barangay.php" onclick="redirectTo('barangay.php')"><i class='bx bxs-compass'></i>Barangays</a></li>
            <li class=""><a href="maps.php" onclick="redirectTo('maps.php')"><i class='bx bx-map-alt'></i>Maps</a></li>
            <li class=""><a href="#" onclick="redirectTo('users.php')"><i class='bx bx-group'></i>Users</a></li>
            <li class=""><a href="#" onclick="redirectTo('settings.php')"><i class='bx bx-cog'></i>Settings</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count"></span>
            </a>
            <a href="#" class="profile">
                <img src="images/logo.png">
            </a>
        </nav>
        <!-- End of Navbar -->
        <main>
            <div class="header">
                <div class="left">
                    <ul class="breadcrumb">
                        <li><a href="#"></a></li>
                    </ul>
                </div>
            </div>
            <div class="bottom-data">
<div class="container">
    <div class="chart-container" id="statusChartContainer"></div>
    <h3 style="text-align: center;">Residents Data by Status</h3>
</div>
<div class="container">
    <div class="chart-container" id="voterChartContainer"></div>
    <h3 style="text-align: center;">Residents Data by Voter Type</h3>
</div>
<div class="container">
    <div class="chart-container" id="addressChartContainer"></div>
    <h3 style="text-align: center;">Residents Data by Address</h3>
</div>
<script src="index.js"></script>
</body>
</html>
