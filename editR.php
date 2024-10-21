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

        input[="submit"] {
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

        #status-dropdown {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 18px;
        appearance: none; /* Remove default arrow */
        background-image: url('data:image/svg+xml;utf8,<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>'); /* Add custom arrow */
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 24px;
    }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Resident</h2>

    <?php
include 'config.php';

// Check if ID parameter is set and not empty
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the resident data for editing
    $sql = "SELECT * FROM resident WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Calculate age based on birthdate
        function calculateAge($birthdate) {
            // Create a DateTime object for the birthdate
            $dob = new DateTime($birthdate);
            // Get the current date
            $now = new DateTime();
            // Calculate the difference between the current date and the birthdate
            $difference = $now->diff($dob);
            // Return the calculated age
            return $difference->y;
        }

        // Display age if birthdate is set
        $age = '';
        if (!empty($row['birth_date'])) {
            $age = calculateAge($row['birth_date']);
        }

        // Handle form submission
        if(isset($_POST['submit'])) {
            if($_POST['submit'] == "Update") {
                // Update resident
                $name = $_POST['name'];
                $address = $_POST['address'];
                $birth_date = $_POST['birth_date'];
                $gender = $_POST['gender'];
                $status = $_POST['status'];

                $update_sql = "UPDATE resident SET name=?, address=?, birth_date=?, gender=?, status=? WHERE id=?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("sssssi", $name, $address, $birth_date, $gender, $status, $id);
                if($update_stmt->execute()) {
                    // Redirect to residents.php after successful update
                    header("Location: residents.php");
                    exit();
                } else {
                    echo "<p style='color: red;'>Error updating resident: " . $conn->error . "</p>";
                }
            } elseif($_POST['submit'] == "Back") {
                // Redirect to residents.php
                header("Location: residents.php");
                exit();
            }
        }

        ?>

        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label>Name:</label><br>
            <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
            <label>Address:</label><br>
            <input type="text" name="address" value="<?php echo $row['address']; ?>"><br>
            <label>Birthday:</label><br>
            <input type="date" name="birth_date" value="<?php echo $row['birth_date']; ?>"><br><br>
            <label>Age:</label><br>
            <input type="text" name="age" value="<?php echo $age; ?>" readonly><br>
            <label>Gender:</label><br>
            <select name="gender" style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; font-size: 18px;">
                <option value="Male" <?php if ($row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if ($row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
            </select><br>
            <label>Address:</label><br>
            <input type="text" name="address" value="<?php echo $row['address']; ?>"><br>
            <label>Status:</label><br>
            <select name="status" id="status-dropdown">
                <option value="" <?php if ($row['status'] == '') echo 'selected'; ?>>None</option>
                <option value="Student" <?php if ($row['status'] == 'Student') echo 'selected'; ?>>Student</option>
                <option value="Employed" <?php if ($row['status'] == 'Employed') echo 'selected'; ?>>Employed</option>
                <option value="Unemployed" <?php if ($row['status'] == 'Unemployed') echo 'selected'; ?>>Unemployed</option>
                <option value="Child" <?php if ($row['status'] == 'Child') echo 'selected'; ?>>Child</option>
                <option value="Deceased" <?php if ($row['status'] == 'Deceased') echo 'selected'; ?>>Deceased</option>
            </select>

            <div class="button-container">
                <input type="submit" name="submit" value="Update">
                <input type="submit" name="submit" value="Back">
            </div>
        </form>

        <?php
    } else {
        // No resident found with the given ID
        echo "<p style='color: red;'>Resident not found.</p>";
    }
} else {
    // ID parameter is not set or empty
    echo "<p style='color: red;'>Invalid request.</p>";
}
?>
</div>

</body>
</html>
