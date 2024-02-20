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
    $grade = $_POST["grade_name"];
    

    // Insert data into the employees table
    $sql = "INSERT INTO designations (grade_name)
            VALUES ('$grade')";

if ($conn->query($sql) === TRUE) {
    echo "<script>";
    echo "alert('Grade added successfully');";
    echo "window.location.href = 'add_designation.html';";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert('Form not submitted');";
    echo "window.location.href = 'add_designation.html';";
    echo "</script>";
}
}


// Close the database connection
$conn->close();
?>
