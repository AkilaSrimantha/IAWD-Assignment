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

echo "<h1 align= 'center';>Exam Registration Data</h1>"; // Title for the table

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
        echo "No records matching your query were found.";
    }

} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
