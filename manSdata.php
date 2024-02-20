<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smls";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM Staff";
$result = $conn->query($query);

// Check if the query was successful
if ($result) {
    // Fetch data and display it in the table
    while ($row = $result->fetch_assoc()) {
        $staffName = $row['FIRST_NAME'] . " " . $row['LAST_NAME'];
        echo "<tr>";
        echo "<td>" . $row['ID_NUMBER'] . "</td>";
        echo "<td>" . $staffName . "</td>";
        echo "<td>" . $row['DEPARTMENT'] . "</td>";
        echo "<td>" . $row['EMAIL'] . "</td>";
        echo "<td>" . $row['CONTACT'] . "</td>";
        echo "<td>" . $row['IN_CHARGE'] . "</td>";
        echo "<td>" . $row['GENDER'] . "</td>";
        echo "<td>
        <button class='delete-button' data-id='" . $row['ID_NUMBER'] . "'><i class='fa fa-trash text-danger'></i></button>
      </td>";
echo "</tr>";
    }
} else {
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
