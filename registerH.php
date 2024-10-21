<?php
// Database connection parameters
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "JK"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare data for insertion
    $household_leader = $_POST['household_leader'];
    $name_of_family_members = $_POST['number'];
    $address = $_POST['address'];
    $social_status = $_POST['social_status'];

    // Prepare and bind SQL statement using prepared statement
    $sql = "INSERT INTO household (household_leader, number, address, social_status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $household_leader, $name_of_family_members, $address, $social_status);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to prevent form resubmission
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Household</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
        }
        input[type="text"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        .error {
            color: red;
        }
        .btn-submit {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-submit:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register Household</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="household_leader">Household Leader:</label>
                <input type="text" id="household_leader" name="household_leader">
            </div>
            <div class="form-group">
                <label for="number">Name of Family Members:</label>
                <input type="text" id="number" name="number">
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address">
            </div>
            <div class="form-group">
                <label for="social_status">Social Status:</label>
                <select id="social_status" name="social_status">
                    <option value="">Select</option>
                    <option value="indigent">Indigent</option>
                    <option value="average">Average</option>
                    <option value="above_average">Above Average</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn-submit" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>
