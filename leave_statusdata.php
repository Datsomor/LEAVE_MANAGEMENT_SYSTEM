<?php


// ... (your existing code) ...

if (isset($_SESSION['ID_NUMBER'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "smls";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $idNumber = $_SESSION['ID_NUMBER'];

    // Fetch leave applications for the logged-in user
    $query = "SELECT * FROM leave_application WHERE id_number = '$idNumber'";

    $result = $conn->query($query);

    // Check if the query was successful
    if ($result) {
        // Fetch data and display it in the table
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['LEAVE_TYPE'] . "</td>";
            echo "<td>" . $row['FROM_DATE'] . "</td>";
            echo "<td>" . $row['TO_DATE'] . "</td>";
            echo "<td>" . $row['SUBMISSION_DATE'] . "</td>";
            echo "<td>" . $row['REJECTION_REASON'] . "</td>";
            echo "<td><span class='badge bg-info'>" . $row['STATUS'] . "</span></td>";
            echo "</tr>";
        }
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Session not set. User not logged in.";
}
?>
