<?php
// Database connection details
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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'];
    $location = $_POST['location'];
    $type = $_POST['type'];
    $description = $_POST['description'];

    // Insert attraction data into the database
    $sql = "INSERT INTO Attractions (Name, Location, Type, Description) VALUES ('$name', '$location', '$type', '$description')";
    if ($conn->query($sql) === TRUE) {
        $attractionID = $conn->insert_id; // Get the last inserted ID

        // Handle file uploads
        if (isset($_FILES['pictures']) && $_FILES['pictures']['error'][0] != UPLOAD_ERR_NO_FILE) {
            $files = $_FILES['pictures'];
            $uploadDirectory = 'images/';

            for ($i = 0; $i < count($files['name']); $i++) {
                if ($files['error'][$i] === UPLOAD_ERR_OK) {
                    $fileTmpPath = $files['tmp_name'][$i];
                    $fileName = basename($files['name'][$i]);
                    $filePath = $uploadDirectory . uniqid() . '-' . $fileName;

                    // Validate file type (e.g., allow only images)
                    $fileType = mime_content_type($fileTmpPath);
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

                    if (in_array($fileType, $allowedTypes)) {
                        if (move_uploaded_file($fileTmpPath, $filePath)) {
                            // Insert picture info into Pictures table
                            $sql = "INSERT INTO Pictures (AttractionID, PictureURL) VALUES ('$attractionID', '$filePath')";
                            $conn->query($sql);
                        } else {
                            echo "Error moving the file: " . $fileName . "<br>";
                        }
                    } else {
                        echo "File type not allowed: " . $fileName . "<br>";
                    }
                } else {
                    echo "Error uploading file: " . $files['name'][$i] . "<br>";
                }
            }
        }

        echo "New attraction record created successfully with ID: " . $attractionID;
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
    <title>Enter Attraction Details</title>
</head>
<body>
    <h1>Enter Attraction Details</h1>
    <form action="Attractionsform.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br><br>

        <label for="type">Type:</label>
        <input type="text" id="type" name="type" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>

        <label for="pictures">Upload Pictures:</label><br>
        <input type="file" id="pictures" name="pictures[]" multiple required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
