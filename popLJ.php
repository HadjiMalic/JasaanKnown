<?php
// Database connection parameters
$servername = "localhost"; // Change this to your database host if it's not localhost
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$database = "jk"; // Change this to your database name

// Create connection
$mysqli = new mysqli($servername, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// SQL query to get population counts based on status column
$sql = "SELECT status, COUNT(*) AS count FROM resident WHERE address LIKE '%Lower Jasaan Misamis Oriental%' GROUP BY status";
$result = $mysqli->query($sql);

// Check if $result is valid
if ($result !== false) {
    // Check if any rows are returned
    if ($result->num_rows > 0) {
        // Output sample population count
        echo '<div class="population-division">';
        echo '<i class="fas fa-users population-icon"></i>';
        echo '</div>';

        // Output table for sub-divisions
        echo '<table class="sub-table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Population</th>';
        echo '<th>Sample Count</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Output each population division and its count
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td class="sub-division" data-division="' . $row["status"] . '">';
            echo '<div class="sub-division-label">' . ucfirst($row["status"]) . '</div>';
            // Icon for each status division (you can customize this based on your preferences)
            if ($row["status"] == "Student") {
                echo '<i class="fas fa-graduation-cap"></i>';
            } elseif ($row["status"] == "Employed") {
                echo '<i class="fas fa-user-tie"></i>';
            } elseif ($row["status"] == "Unemployed") {
                echo '<i class="fas fa-user-slash"></i>';
            } elseif ($row["status"] == "Child") {
                echo '<i class="fas fa-child"></i>';
            } elseif ($row["status"] == "Deceased") {
                echo '<i class="fas fa-user-times"></i>';
            } else {
                echo '<i class="fas fa-user"></i>'; // Default icon
            }
            echo '</td>';
            echo '<td class="sample-count">' . $row["count"] . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo "No data available";
    }
} else {
    echo "Query execution failed";
}

// Close connection
if (isset($mysqli)) {
    $mysqli->close();
}
?>
