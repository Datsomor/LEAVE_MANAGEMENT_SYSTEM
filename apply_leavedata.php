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

// Check if user is logged in and has a session with id_number
if (isset($_SESSION['ID_NUMBER'])) {
    $idNumber = $_SESSION['ID_NUMBER'];
    $userQuery = "SELECT * FROM staff WHERE id_number = '$idNumber'";
    $userResult = $conn->query($userQuery);

    if ($userResult->num_rows > 0) {
        $userRow = $userResult->fetch_assoc();
        $fullName = $userRow['FIRST_NAME'] . ' ' . $userRow['MIDDLE_NAME'] . ' ' . $userRow['LAST_NAME'];

        // Set FULL_NAME in the session
        $_SESSION['FULL_NAME'] = $fullName;

        $directorate = $userRow['DEPARTMENT'];
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect other form data
        $leaveType = $_POST["leave_type"];
        $fromDate = $_POST["from_date"];
        $toDate = $_POST["to_date"];

        // Insert leave application
        $insertQuery = "INSERT INTO leave_application (leave_type, full_name, id_number, from_date, to_date, Directorate, status)
                        VALUES ('$leaveType', '$fullName', '$idNumber', '$fromDate', '$toDate', '$directorate', 'Pending')";

        if ($conn->query($insertQuery) === TRUE) {
            // After processing the form data, fetch the relevant information for the director's notification panel
            $userName = $_SESSION['FULL_NAME'];
            $submissionDate = date("Y-m-d");

            // Insert the notification into the database
            $notificationQuery = "INSERT INTO notifications (FULL_NAME, leave_type, submission_date) 
                                    VALUES ('$userName', '$leaveType', '$submissionDate')";

            if ($conn->query($notificationQuery) === TRUE) {
                // Notification inserted successfully
                echo "<script>
                    alert('Application successful.');
                    window.location.href = 'apply_leave.php';
                  </script>";
            } else {
                // Error inserting notification
                echo "Error adding notification: " . $conn->error;
            }
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    }
}

    // Fetch user information from the database based on id_number
    $userQuery = "SELECT * FROM staff WHERE id_number = '$idNumber'";
    $userResult = $conn->query($userQuery);

    if ($userResult->num_rows > 0) {
        $userRow = $userResult->fetch_assoc();
        $fullName = $userRow['FIRST_NAME'] . ' ' . $userRow['MIDDLE_NAME'] . ' ' . $userRow['LAST_NAME'];

        // Set FULL_NAME in the session
        $_SESSION['FULL_NAME'] = $fullName;

        $directorate = $userRow['DEPARTMENT']; // Fetch department information

        // Fetch notifications for the director's panel
        $directorQuery = "SELECT * FROM notifications WHERE id = '$idNumber' AND viewed = 0";
        $directorResult = $conn->query($directorQuery);

        if ($directorResult->num_rows > 0) {
            // Update notifications as viewed
            $updateViewedQuery = "UPDATE notifications SET viewed = 1 WHERE id = '$idNumber' AND viewed = 0";
            $conn->query($updateViewedQuery);

            $notifications = $directorResult->fetch_all(MYSQLI_ASSOC);
            echo json_encode($notifications);
        } else {
            echo "No notifications found.";
        }
    } else {
        // Handle the case when user information is not found
        echo "User information not found.";
    }
} else {
    // Redirect to login page or handle the case when the user is not logged in
    ob_start(); // Start output buffering
    echo '<script>window.location.href = "login.php";</script>';
    ob_end_flush(); // Flush the output buffer and turn off output buffering
    exit();
}

// Close connection
$conn->close();
?>
