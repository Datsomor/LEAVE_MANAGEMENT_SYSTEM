<?php
// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smls";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $leaveName = $_POST["leave_name"];
    $description = $_POST["description"];
    $DaysAllowed = $_POST["days_allowed"];

    // Insert data into the employees table
    $sql = "INSERT INTO leave_types (leave_name, description, days_allowed )
            VALUES (' $leaveName','$description', '$DaysAllowed')";

if ($conn->query($sql) === TRUE) {
    echo "<script>";
    echo "alert('Leave type added successfully');";
    echo "window.location.href = 'add_leave_type.html';";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert('Form not submitted');";
    echo "window.location.href = 'add_leave_type.html';";
    echo "</script>";
}
}


// Close the database connection
$conn->close();
?>
