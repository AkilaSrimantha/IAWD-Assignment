<?php

$host = 'localhost';
$dbName = 'studyhub';
$username = 'root'; 
$password = '';     


$conn = mysqli_connect($host, $username, $password, $dbName);


if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $birthDate = mysqli_real_escape_string($conn, $_POST['birthDate']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $postalCode = mysqli_real_escape_string($conn, $_POST['postalCode']);
    $faculty = mysqli_real_escape_string($conn, $_POST['faculty']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);

    
    $sql = "INSERT INTO courseregistration (studentName, email, phone, birthDate, gender, address, country, postalCode, faculty, course)
            VALUES ('$fullName', '$email', '$mobile', '$birthDate', '$gender', '$address', '$country', '$postalCode', '$faculty', '$course')";

    if (mysqli_query($conn, $sql)) {
        echo "<h1>Registration Successful</h1>";
        echo "<p>Thank you for registering, $fullName. Your registration details have been saved.</p>";
    } else {
        echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
    }
}


mysqli_close($conn);
?>
