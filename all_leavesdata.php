<?php

if (isset($_SESSION['USERNAME'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "smls";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $directorUsername = $_SESSION['USERNAME'];

    // Fetch the director's directorate
    $directorQuery = "SELECT Directorate FROM users WHERE username = '$directorUsername'";
    $directorResult = $conn->query($directorQuery);

    if ($directorResult->num_rows > 0) {
        $directorRow = $directorResult->fetch_assoc();
        $directorDirectorate = $directorRow['Directorate'];

        // Fetch leave applications from the same directorate, ordered by submission date in descending order
        $query = "SELECT * FROM leave_application
                  WHERE leave_application.directorate = '$directorDirectorate'
                  ORDER BY SUBMISSION_DATE DESC";

        $result = $conn->query($query);

        // Check if the query was successful
        if ($result) {
            // Fetch data and display it in the table
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['FULL_NAME'] . "</td>";
                echo "<td>" . $row['LEAVE_TYPE'] . "</td>";
                echo "<td>" . $row['SUBMISSION_DATE'] . "</td>";
                echo "<td>" . $row['STATUS'] . "</td>";
                echo "<td>";
                echo "<button class='btn btn-sm btn-success' onclick='approveLeave(" . $row['LEAVE_ID'] . ")'>Approve</button>";
                echo "<button class='btn btn-sm btn-danger' onclick='rejectLeave(" . $row['LEAVE_ID'] . ")'>Reject</button>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error fetching director's directorate.";
    }

    $conn->close();
} else {
    echo "Session not set. User not logged in.";
}
?>
