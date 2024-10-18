<?php

$host = 'localhost';
$dbName = 'studyhub';  
$username = 'root'; 
$password = '';     

$conn = mysqli_connect($host, $username, $password, $dbName);

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Registration Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        form {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="email"], input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $stmt = $conn->prepare("UPDATE courseregistration SET studentName=?, email=?, phone=?, birthDate=?, gender=?, address=?, country=?, postalCode=?, faculty=?, course=? WHERE id=?");
    $stmt->bind_param("ssssssssssi", $studentName, $email, $phone, $birthDate, $gender, $address, $country, $postalCode, $faculty, $course, $id);
    $studentName = $_POST['studentName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $birthDate = $_POST['birthDate'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $postalCode = $_POST['postalCode'];
    $faculty = $_POST['faculty'];
    $course = $_POST['course'];
    $id = $_POST['id'];

    if ($stmt->execute()) {
        echo "<p style='color: green; text-align: center;'>Record updated successfully!</p>";
    } else {
        echo "<p style='color: red; text-align: center;'>Error updating record: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $stmt = $conn->prepare("DELETE FROM courseregistration WHERE id=?");
    $stmt->bind_param("i", $id);
    $id = $_POST['id'];
    if ($stmt->execute()) {
        echo "<p style='color: green; text-align: center;'>Record deleted successfully!</p>";
    } else {
        echo "<p style='color: red; text-align: center;'>Error deleting record: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

echo "<h1>Course Registration Data</h1>";

$sql = "SELECT * FROM courseregistration";
if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Student Name</th>";
        echo "<th>Email</th>";
        echo "<th>Phone</th>";
        echo "<th>Birth Date</th>";
        echo "<th>Gender</th>";
        echo "<th>Address</th>";
        echo "<th>Country</th>";
        echo "<th>Postal Code</th>";
        echo "<th>Faculty</th>";
        echo "<th>Course</th>";
        echo "<th>Registration Date</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['studentName'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['birthDate'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . $row['country'] . "</td>";
            echo "<td>" . $row['postalCode'] . "</td>";
            echo "<td>" . $row['faculty'] . "</td>";
            echo "<td>" . $row['course'] . "</td>";
            echo "<td>" . $row['registrationDate'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        mysqli_free_result($result);
    } else {
        echo "<p style='text-align: center;'>No records found.</p>";
    }
} else {
    echo "<p style='text-align: center; color: red;'>ERROR: Could not execute $sql. " . mysqli_error($conn) . "</p>";
}

mysqli_close($conn);

echo '<h2>Update a Record</h2>
<form method="post" action="">
    <label for="id">ID of the Record to Update:</label>
    <input type="text" name="id" id="id" required><br><br>

    <label for="studentName">Student Name:</label>
    <input type="text" name="studentName" id="studentName" required><br><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br><br>

    <label for="phone">Phone Number:</label>
    <input type="text" name="phone" id="phone" required><br><br>

    <label for="birthDate">Birth Date:</label>
    <input type="date" name="birthDate" id="birthDate" required><br><br>

    <label for="gender">Gender:</label>
    <input type="text" name="gender" id="gender" required><br><br>

    <label for="address">Address:</label>
    <input type="text" name="address" id="address" required><br><br>

    <label for="country">Country:</label>
    <input type="text" name="country" id="country" required><br><br>

    <label for="postalCode">Postal Code:</label>
    <input type="text" name="postalCode" id="postalCode" required><br><br>

    <label for="faculty">Faculty:</label>
    <input type="text" name="faculty" id="faculty" required><br><br>

    <label for="course">Course:</label>
    <input type="text" name="course" id="course" required><br><br>

    <button type="submit" name="update">Update Record</button>
</form>

<h2>Delete a Record</h2>
<form method="post" action="">
    <label for="id">ID of the Record to Delete:</label>
    <input type="text" name="id" id="id" required><br><br>

    <button type="submit" name="delete">Delete Record</button>
</form>

</body>
</html>';
?>
