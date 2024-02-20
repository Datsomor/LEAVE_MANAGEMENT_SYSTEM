<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smls";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM users";
$result = $conn->query($query);

// Check if the query was successful
if ($result) {
    // Fetch data and display it in the table
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['FULL_NAME'] . "</td>";
        echo "<td>" . $row['CONTACT'] . "</td>";
        echo "<td>" . $row['USER_CATEGORY'] . "</td>";
        echo "<td><a href='#" . $row['FULL_NAME'] . "'><i class='fa fa-pen text-success'></i></a>   <a href='#" . $row['FULL_NAME'] . "'><i class='fa fa-trash text-danger'></i></a></td>";
        echo "</tr>";
    }
} else {
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
