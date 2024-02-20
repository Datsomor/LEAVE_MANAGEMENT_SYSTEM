<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smls";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch approved leaves
$sql = "SELECT * FROM leave_application WHERE status = 'Director Rejected' OR 'HR Rejected'";
$result = $conn->query($sql);


    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $status = $row["STATUS"];
        $badgeColor = ($status == 'Approved') ? 'success' : 'danger';

        echo "<tr>
                <td>" . $row["FULL_NAME"] . "</td>
                <td>" . $row["LEAVE_TYPE"] . "</td>
                <td>" . $row["SUBMISSION_DATE"] . "</td>
                <td>" . $row["FROM_DATE"] . "</td>
                <td>" . $row["TO_DATE"] . "</td>
                <td><span class='badge bg-$badgeColor'>$status</span></td>
               
            </tr>";
    }
    echo "</table>";


// Close connection
$conn->close();
?>
