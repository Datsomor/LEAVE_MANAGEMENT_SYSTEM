<?php

// update_leave_status.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "smls";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $leaveId = $_POST["leaveId"];
    $status = $_POST["status"];
    $reason = isset($_POST["reason"]) ? $_POST["reason"] : null;

    // Update the leave status and rejection reason in the leave_application table
    $updateQuery = "UPDATE leave_application SET STATUS = '$status', REJECTION_REASON = NULL WHERE LEAVE_ID = '$leaveId'";

    if ($status == 'HR Rejected' && !is_null($reason)) {
        // If rejected, also save the rejection reason
        $updateQuery = "UPDATE leave_application SET STATUS = '$status', REJECTION_REASON = '$reason' WHERE LEAVE_ID = '$leaveId'";
    }

    $result = $conn->query($updateQuery);

    if ($result) {
        echo "Leave status updated successfully!";
    } else {
        echo "Error updating leave status: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request!";
}

?>
