<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smls";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM leave_types";
$result = $conn->query($query);

// Check if the query was successful
if ($result) {
    // Fetch data and display it in the table
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['LEAVE_NAME'] . "</td>";
        echo "<td>" . $row['DESCRIPTION'] . "</td>";
        echo "<td>" . $row['DAYS_ALLOWED'] . "</td>";
        echo "<td><a href='#" . $row['LEAVE_NAME'] . "'><i class='fa fa-pen text-success'></i></a>   <a href='#" . $row['LEAVE_NAME'] . "'><i class='fa fa-trash text-danger'></i></a></td>";
        echo "</tr>";
    }
} else {
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
