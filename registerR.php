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
    if (isset($_POST['back'])) {
        // Redirect to residents.php
        header("Location: residents.php");
        exit();
    } else {
        // Prepare data for insertion
        $name = $_POST['name'];
        $address = $_POST['address'];
        $birth_date = $_POST['birth_date']; // New parameter for birth date
        $gender = $_POST['gender'];
        $status = $_POST['status'];
        $voter = $_POST['voter'];

        // Calculate age based on birth date
        $dob = new DateTime($birth_date);
        $now = new DateTime();
        $age = $now->diff($dob)->y;

        // Insert data into the database
        $sql = "INSERT INTO resident (name, address, birth_date, age, gender, status, voter) 
        VALUES ('$name', '$address', '$birth_date', '$age', '$gender', '$status', '$voter')";
        if ($conn->query($sql) === TRUE) {
            // Redirect to prevent form resubmission
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Registration</title>
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
        .button-container {
            display: flex;
            justify-content: space-between;
        }

        .button-container input[type="submit"] {
            flex: 1;
            margin-right: 5px;
        }

        .button-container form {
            flex: 1;
        }

        input[name="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
        }

        input[name="back"] {
            padding: 10px 20px;
            background-color: gainsboro;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Resident Registration</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address">
            </div>
            <div class="form-group">
                <label for="birth_date">Birth Date:</label>
                <input type="date" id="birth_date" name="birth_date">
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender">
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="">Select</option>
                    <option value="student">Student</option>
                    <option value="employed">Employed</option>
                    <option value="unemployed">Unemployed</option>
                    <option value="Child">Child</option>
                    <option value="Deceased">Deceased</option>
                </select>
            </div>
            <div class="form-group">
                <label for="voter">Voter:</label>
                <select id="voter" name="voter">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
            <div class="button-container">
                <input type="submit" name="submit" value="Submit">
                <input type="submit" name="back" value="Back">
            </div>
        </form>
    </div>
</body>
</html>
