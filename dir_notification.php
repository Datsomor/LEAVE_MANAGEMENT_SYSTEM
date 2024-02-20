<?php
session_start();

// Assuming the connection is already established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smls";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch notifications for the director's panel
$directorUsername = $_SESSION['USERNAME'];
$directorQuery = "SELECT Directorate FROM users WHERE username = '$directorUsername'";
$directorResult = $conn->query($directorQuery);

if ($directorResult->num_rows > 0) {
    $directorRow = $directorResult->fetch_assoc();
    $directorDirectorate = $directorRow['Directorate'];

    // Fetch notifications ordered by submission date in descending order
    $notificationsQuery = "SELECT * FROM leave_application
                           WHERE leave_application.directorate = '$directorDirectorate'
                           ORDER BY SUBMISSION_DATE DESC";

    $notificationsResult = $conn->query($notificationsQuery);

    if ($notificationsResult) {
        // Send notifications as JSON
        $notifications = $notificationsResult->fetch_all(MYSQLI_ASSOC);
        echo json_encode($notifications);
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Error fetching director's directorate.";
}

// Close connection
$conn->close();
?>
