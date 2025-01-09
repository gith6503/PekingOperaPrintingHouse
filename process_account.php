<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "peking_printing";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture POST data using null coalescing operator to avoid undefined warnings
$name = $_POST['newName'] ?? null;
$dob = $_POST['newDOB'] ?? null;
$sex = $_POST['newSex'] ?? null; // Add this field if you missed it in HTML
$address = $_POST['newAddress'] ?? null;
$ic = $_POST['newIC'] ?? null;
$workplace = $_POST['newWorkplace'] ?? null;
$religion = $_POST['newReligion'] ?? null;
$telNo = $_POST['newTelNo'] ?? null;
$email = $_POST['newEmail'] ?? null;
$occupation = $_POST['newOccupation'] ?? null;

// Prepare and bind the SQL query
$stmt = $conn->prepare("UPDATE accounts SET 
    name = ?, 
    dob = ?, 
    sex = ?, 
    address = ?, 
    ic = ?, 
    workplace = ?, 
    religion = ?, 
    telNo = ?, 
    email = ?, 
    occupation = ? 
    WHERE id = 1");

if (!$stmt) {
    die("Statement preparation failed: " . $conn->error);
}

// Bind parameters (s = string, i = integer, d = double)
$stmt->bind_param(
    "ssssssssss", 
    $name, $dob, $sex, $address, $ic, $workplace, $religion, $telNo, $email, $occupation
);

// Execute the statement
if ($stmt->execute()) {
    echo "Account updated successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

