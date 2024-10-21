<?php
// Include config.php for database connection
include 'config.php';

// Query to fetch activities data
$sql = "SELECT * FROM activities";
$result = $conn->query($sql);

// Function to sanitize user input
function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}

// Handle delete action
if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    // Prepare and execute delete query
    $delete_sql = "DELETE FROM activities WHERE id=?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $id);
    if($delete_stmt->execute()) {
        // Redirect back to this page after deletion
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        echo "<p style='color: red;'>Error deleting activity: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css">
    <title>Registered Activities</title>
</head>
<style>
        /* Container styles */
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center; /* Center content vertically */
            min-height: 100vh; /* Set minimum height to full viewport height */
            text-align: center;
        }

        .bottom-data {
            width: 60%; /* Adjust width as needed */
            margin-top: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-wrap: wrap;
            justify-content: center; /* Center children horizontally */
        }

        .activity {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ccc;
            display: flex;
            flex-direction: column;
            width: 60%; /* Adjust width as needed */
        }

        .activity:last-child {
            border-bottom: none; /* Remove border for last activity */
        }

        .description {
            height: 450px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 10px;
            flex: 1;
            width: auto; /* Set width to auto */
            padding: 5px; /* Adjust padding as needed */
        }

        .description p {
            margin: 0;
            font-size: 22px;
        }

        .description img {
            max-width: 100%;
            height: auto;
            display: block;
            margin-top: 10px;
        }

        .action-buttons {
            margin-top: 10px; /* Adjust margin as needed */
            padding-top: 10px; /* Add some space between description and buttons */
            border-top: 1px solid #ccc; /* Add a border above buttons */
            display: flex;
            justify-content: flex-end; /* Align buttons to the right */
        }

        .action-buttons a {
            margin-left: 10px; /* Adjust margin between buttons as needed */
            text-decoration: none;
            color: inherit;
            font-size: 24px; /* Adjust font size as needed */
        }

        .action-buttons a:hover {
            color: #4CAF50; /* Change color on hover */
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }
    </style>
<body>
    
<div class="container">
        <h1>Events</h1>
    <!-- Sidebar -->
    
    <!-- End of Sidebar -->


    
    <div class="content">
        <!-- End of Navbar -->
            <div class="bottom-data">
        <?php
        // Check if there are activities
        if ($result->num_rows > 0) {
            // Loop through results and display each activity
            while ($row = $result->fetch_assoc()) {
                echo '<div class="activity">';
                echo "<h3>" . $row["actname"] . "</h3>";
                echo "<p><strong>Barangay:</strong> " . $row["barangay"] . "</p>";
                echo "<p><strong>Date:</strong> " . $row["date"] . "</p>";
                echo "<img src='" . $row["picture"] . "' alt='Activity Picture'>";
                echo '</div>'; // Close activity container

                // Description container
                echo '<div class="description">';
                echo "<p><strong>Description:</strong> " . $row["description"] . "</p>";

                // Add action buttons
                echo '<div class="action-buttons">';
                echo '<a href="editA.php?id=' . $row["id"] . '" class="edit-btn"><i class="bx bx-edit"></i> Edit</a>';

                echo '<a href="?action=delete&id=' . $row["id"] . '" class="delete-btn" onclick="return confirm(\'Are you sure you want to delete this activity?\')"><i class="bx bx-trash"></i> Delete</a>';
                echo '</div>'; // Close action-buttons container
                echo '</div>'; // Close description container
            }
        } else {
            echo "<p>No activities registered yet.</p>";
        }
        ?>
</div>
</div>
</div>
<main>
    <!-- Your other HTML content here -->
</main>
<script src="index.js"></script>
</body>
</html>
