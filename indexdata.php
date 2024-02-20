<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smls";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get the count from a specific table
function getCount($conn, $staff)
{
    $sql = "SELECT COUNT(*) AS count FROM $staff";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['count'];
    } else {
        return 0;
    }
}

// Get counts for each category
$staffCount = getCount($conn, 'staff');
$leaveCount = getCount($conn, 'leave_application');
$approvedCount = getCount($conn, 'leave_application WHERE status = "Approved"');
$pendingCount = getCount($conn, 'leave_application WHERE status = "Pending"');
$cancelledCount = getCount($conn, 'leave_application WHERE status = "Not Approved"');

$conn->close();
?>
