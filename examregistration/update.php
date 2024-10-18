<?php
// Database configuration
$host = 'localhost';
$dbName = 'studyhub';
$username = 'root'; // Assuming default MySQL root username
$password = '';     // Assuming no password for root

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbName);

// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Handle update request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Prepare the SQL UPDATE query
    $stmt = $conn->prepare("UPDATE examregistration SET studentName=?, indexNumber=?, subject=?, subjectCode=?, email=?, phone=?, gender=? WHERE id=?");

    // Bind the new values from the form
    $stmt->bind_param("sssssssi", $studentName, $indexNumber, $subject, $subjectCode, $email, $phone, $gender, $id);

    // Get values from POST form
    $studentName = $_POST['studentName'];
    $indexNumber = $_POST['indexNumber'];
    $subject = $_POST['subject'];
    $subjectCode = $_POST['subjectCode'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $id = $_POST['id']; // The record ID to be updated

    // Execute the update query
    if ($stmt->execute()) {
        echo "<p>Record updated successfully!</p>";
    } else {
        echo "<p>Error updating record: " . $stmt->error . "</p>";
    }

    // Close the prepared statement
    $stmt->close();
}

// Handle delete request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Prepare the SQL DELETE query
    $stmt = $conn->prepare("DELETE FROM examregistration WHERE id=?");

    // Bind the ID to delete
    $stmt->bind_param("i", $id);

    // Get the ID from the form
    $id = $_POST['id']; // The record ID to be deleted

    // Execute the delete query
    if ($stmt->execute()) {
        echo "<p>Record deleted successfully!</p>";
    } else {
        echo "<p>Error deleting record: " . $stmt->error . "</p>";
    }

    // Close the prepared statement
    $stmt->close();
}

// Display current records from the database
echo "<h1>Exam Registration Data</h1>";

// SQL query to select all records from the examregistration table
$sql = "SELECT * FROM examregistration";
if ($result = mysqli_query($conn, $sql)) {

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Student Name</th>";
        echo "<th>Index Number</th>";
        echo "<th>Subject</th>";
        echo "<th>Subject Code</th>";
        echo "<th>Email</th>";
        echo "<th>Phone</th>";
        echo "<th>Gender</th>";
        echo "<th>Registration Date</th>";
        echo "</tr>";

        // Fetching each row from the result set and displaying it in a table
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['studentName'] . "</td>";
            echo "<td>" . $row['indexNumber'] . "</td>";
            echo "<td>" . $row['subject'] . "</td>";
            echo "<td>" . $row['subjectCode'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['registrationDate'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";

        // Free result set
        mysqli_free_result($result);
    } else {
        echo "<p>No records found.</p>";
    }

} else {
    echo "<p>ERROR: Could not execute $sql. " . mysqli_error($conn) . "</p>";
}

// Close connection
mysqli_close($conn);
?>

<!-- HTML form to update the record -->
<h2>Update a Record</h2>
<form method="post" action="">
    <label for="id">ID of the Record to Update:</label>
    <input type="text" name="id" id="id" required><br><br>

    <label for="studentName">Student Name:</label>
    <input type="text" name="studentName" id="studentName" required><br><br>

    <label for="indexNumber">Index Number:</label>
    <input type="text" name="indexNumber" id="indexNumber" required><br><br>

    <label for="subject">Subject:</label>
    <input type="text" name="subject" id="subject" required><br><br>

    <label for="subjectCode">Subject Code:</label>
    <input type="text" name="subjectCode" id="subjectCode" required><br><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br><br>

    <label for="phone">Phone Number:</label>
    <input type="text" name="phone" id="phone" required><br><br>

    <label for="gender">Gender:</label>
    <input type="text" name="gender" id="gender" required><br><br>

    <button type="submit" name="update">Update Record</button>
</form>

<!-- HTML form to delete the record -->
<h2>Delete a Record</h2>
<form method="post" action="">
    <label for="id">ID of the Record to Delete:</label>
    <input type="text" name="id" id="id" required><br><br>

    <button type="submit" name="delete">Delete Record</button>
</form>
