<!-- save_changes.php -->
<?php
require_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = sanitize($_POST['id']);
    $name = sanitize($_POST['name']);
    $age = sanitize($_POST['age']);
    $address = sanitize($_POST['address']);
    $gender = sanitize($_POST['gender']);
    $status = sanitize($_POST['status']);

    // Update the record in the database
    $sql = "UPDATE resident SET name='$name', age='$age', address='$address', gender='$gender', status='$status' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
