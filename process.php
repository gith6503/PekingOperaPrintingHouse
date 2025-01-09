<?php
$servername = "localhost";
$username = "root";
$password = ""; // Default password
$dbname = "peking_printing";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = $_FILES['file']['name']; // Uploaded file
    $color = $_POST['color'];
    $amount = $_POST['amount'];

    // Insert into database
    $sql = "INSERT INTO print_jobs (file_name, print_type, quantity) VALUES ('$file', '$color', '$amount')";

    if ($conn->query($sql) === TRUE) {
        echo "Print job submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

