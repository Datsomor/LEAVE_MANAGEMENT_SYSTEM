<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smls";

// Get staff ID from the AJAX request
$staffId = $_POST['id'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the deletion query
$query = "DELETE FROM Staff WHERE ID_NUMBER = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $staffId);
$stmt->execute();

// Check if the deletion was successful
if ($stmt->affected_rows > 0) {
    echo "Staff deleted successfully";
} else {
    echo "Error deleting staff: " . $stmt->error;
}

// Close the database connection
$stmt->close();
$conn->close();
?>
