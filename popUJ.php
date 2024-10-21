<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Population Count</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: gainsboro;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .result {
            background-color: whitesmoke;
            padding: 50px;
            border-radius: 20px;
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        h1 {
            margin-bottom: 20px;
            color: #333;
        }
        p {
            font-size: 40px;
            font-weight: bold;
            color: red;
        }

        .icon {
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
        }

    </style>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jk";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL query
$sql = "SELECT COUNT(*) AS population FROM resident WHERE address LIKE ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("SQL Error: " . $conn->error);
}

// Bind parameters
$address = '%Upper Jasaan%';
$stmt->bind_param("s", $address);

// Execute query
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<div class='result'>";
    echo "<h1>Population of Upper Jasaan</h1>";
    echo "<p>" . $row["population"] . "</p>";
    echo "</div>";
} else {
    echo "<div class='result'>";
    echo "<h1>No results found</h1>";
    echo "</div>";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>

</body>
</html>
