<?php
// Start the session
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smls";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
error_reporting(E_ALL);
// Check if user is logged in and has a session with id_number
if (isset($_SESSION['ID_NUMBER'])) {
    $idNumber = $_SESSION['ID_NUMBER'];

    // Handle form submission to clear notification
    // Handle form submission to clear notification
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    $notificationId = $_POST['notificationId']; // Use the same parameter name

    // Debugging: Log the received ID
    error_log("Received ID: " . $notificationId);

    // Clear the notification in the database
    $clearQuery = "DELETE FROM notifications WHERE ID = '$notificationId'";
    if ($conn->query($clearQuery)) {
        // Debugging: Log success message
        error_log("Notification cleared successfully");
        // Return a response (you can customize the response as needed)
        echo "Notification cleared successfully";
    } else {
        // Debugging: Log error message
        error_log("Error clearing notification: " . $conn->error);
        echo "Error clearing notification";
    }
} else {
    // Handle the case when notification_id is not provided
    echo "Error: Notification ID not provided";
}

} else {
    // Handle the case when the user is not logged in
    echo "Error: User not logged in";
}

// Close connection
$conn->close();
?>
