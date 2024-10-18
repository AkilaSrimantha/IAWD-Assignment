<?php
// Database configuration
$host = 'localhost'; // Change if your database is hosted elsewhere
$dbName = 'studyhub';
$username = 'your_username'; // Your MySQL username
$password = 'your_password'; // Your MySQL password

// Create a connection
$conn = new mysqli($host, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO examregistration (studentName, indexNumber, subject, subjectCode, email, phone, gender) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $studentName, $indexNumber, $subject, $subjectCode, $email, $phone, $gender);

    // Get the values from the form
    $studentName = $_POST['studentName'];
    $indexNumber = $_POST['indexNumber'];
    $subject = $_POST['subject'];
    $subjectCode = $_POST['subjectCode'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
