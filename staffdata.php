<?php
// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smls";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $idNumber = $_POST["id_number"];
    $gender = $_POST["gender"];
    $firstName = $_POST["first_name"];
    $middleName = $_POST["middle_name"];
    $lastName = $_POST["last_name"];
    $inCharge = $_POST["in_charge"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $profileImage = $_POST["profile"];  // Note: You may need additional logic to handle file uploads
    $department = $_POST["department"];
    $unit = $_POST["unit"];
    $grade = $_POST["grade"];
    $username = $_POST["username"];
    $password = $_POST["password"];  // Hash the password for security
    $staffType = $_POST["staff_type"];

    // Calculate leave days based on staff type
    $leaveDaysEntitlement = ($staffType == "SENIOR STAFF") ? 30 : 20;

    // Insert data into the employees table
    $sql = "INSERT INTO STAFF (id_number, gender, first_name, middle_name, last_name, IN_CHARGE, email, contact, profile_image, department, unit, grade, username, password, leave_days_entitlement)
            VALUES ('$idNumber', '$gender', '$firstName', '$middleName', '$lastName', '$inCharge', '$email', '$contact', '$profileImage', '$department', '$unit', '$grade', '$username', '$password', '$leaveDaysEntitlement')";

if ($conn->query($sql) === TRUE) {
    // Get the last inserted staff ID
    $idNumber = $conn->insert_id;

    // Insert leave record for the current year
    $currentYear = date("Y");
    $sqlLeaveRecord = "INSERT INTO leave_statistics (id_number, leave_year, leave_days_taken, LEAVE_DAYS_ENTITLEMENT)
                       VALUES ('$idNumber', '$currentYear', 0, '$leaveDaysEntitlement')";
    $conn->query($sqlLeaveRecord);

    echo "<script>";
    echo "alert('Staff added successfully');";
    echo "window.location.href = 'your_page.php';";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert('Form not submitted');";
    echo "window.location.href = 'your_page.php';";
    echo "</script>";
}

}

// Close the database connection
$conn->close();
?>
