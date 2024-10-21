<?php
// Include config.php for database connection
include 'config.php';

// Function to sanitize user input
function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}

// Check if ID parameter is set and not empty
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the activity data for editing
    $sql = "SELECT * FROM activities WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Handle form submission
        if(isset($_POST['submit'])) {
            if($_POST['submit'] == "Update") {
                // Update activity
                $actname = sanitizeInput($_POST['actname']);
                $barangay = sanitizeInput($_POST['barangay']);
                $date = sanitizeInput($_POST['date']);
                $description = sanitizeInput($_POST['description']);
                $picture = sanitizeInput($_POST['picture']);

                $update_sql = "UPDATE activities SET actname=?, barangay=?, date=?, description=?, picture=? WHERE id=?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("sssssi", $actname, $barangay, $date, $description, $picture, $id);
                if($update_stmt->execute()) {
                    // Redirect to activities.php after successful update
                    header("Location: activities.php");
                    exit();
                } else {
                    echo "<p style='color: red;'>Error updating activity: " . $conn->error . "</p>";
                }
            } elseif($_POST['submit'] == "Delete") {
                // Confirm deletion
                if(isset($_POST['confirm_delete']) && $_POST['confirm_delete'] == "yes") {
                    // Delete activity
                    $delete_sql = "DELETE FROM activities WHERE id=?";
                    $delete_stmt = $conn->prepare($delete_sql);
                    $delete_stmt->bind_param("i", $id);
                    if($delete_stmt->execute()) {
                        // Redirect to activities.php after successful deletion
                        header("Location: activities.php");
                        exit();
                    } else {
                        echo "<p style='color: red;'>Error deleting activity: " . $conn->error . "</p>";
                    }
                } else {
                    echo "<p style='color: red;'>Please confirm deletion.</p>";
                }
            }
        }
        ?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Activity</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: gainsboro;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
        }

        label {
            font-weight: bold;
            font-size: 20px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 18px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
        }


        .delete-btn {
            background-color: #f44336;
        }

        .delete-btn:hover {
            background-color: #d32f2f;
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

        h2 {
            text-align: center;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
<h2><img src="images/official.png" alt="Logo" style="height: 50px; vertical-align: middle;"> Edit Activity</h2>

    <?php
    // Include config.php for database connection
    include 'config.php';

    // Check if ID parameter is set and not empty
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];

        // Fetch the activity data for editing
        $sql = "SELECT * FROM activities WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Handle form submission
            if(isset($_POST['submit'])) {
                if($_POST['submit'] == "Update") {
                    // Update activity
                    $actname = $_POST['actname'];
                    $barangay = $_POST['barangay'];
                    $date = $_POST['date'];
                    $description = $_POST['description'];
                    $picture = $_POST['picture'];

                    $update_sql = "UPDATE activities SET actname=?, barangay=?, date=?, description=?, picture=? WHERE id=?";
                    $update_stmt = $conn->prepare($update_sql);
                    $update_stmt->bind_param("sssssi", $actname, $barangay, $date, $description, $picture, $id);
                    if($update_stmt->execute()) {
                        // Redirect to activities.php after successful update
                        header("Location: activities.php");
                        exit();
                    } else {
                        echo "<p style='color: red;'>Error updating activity: " . $conn->error . "</p>";
                    }
                } elseif($_POST['submit'] == "Back") {
                    // Delete activity
                     
                        // Redirect to activities.php after successful deletion
                        header("Location: activities.php");
                        exit();
                    
                }
            }
            ?>
            <form method="post" action="">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <label>Activity Name:</label><br>
                <input type="text" name="actname" value="<?php echo $row['actname']; ?>"><br>
                <label>Barangay:</label><br>
                <input type="text" name="barangay" value="<?php echo $row['barangay']; ?>"><br>
                <label>Date:</label><br>
                <input type="text" name="date" value="<?php echo $row['date']; ?>"><br>
                <label>Description:</label><br>
                <textarea name="description"><?php echo $row['description']; ?></textarea><br>
                <label>Picture:</label><br>
                <input type="text" name="picture" value="<?php echo $row['picture']; ?>"><br>
                <div class="button-container">
                    <input type="submit" name="submit" value="Update">
                    <!-- Back Button -->
                    <form method="post" action="">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="submit" name="submit" value="Back">
                    </form>
                </div>
            </form>
            <?php
        } else {
            // No activity found with the given ID
            echo "<p style='color: red;'>Activity not found.</p>";
        }
    } else {
        // ID parameter is not set or empty
        echo "<p style='color: red;'>Invalid request.</p>";
    }
    ?>
</div>

</body>
</html>


<?php
    } else {
        // No activity found with the given ID
        echo "Activity not found.";
    }
} else {
    // ID parameter is not set or empty
    echo "Invalid request.";
}
?>
