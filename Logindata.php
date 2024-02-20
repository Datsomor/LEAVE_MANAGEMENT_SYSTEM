<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smls";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check director users
    $directorQuery = "SELECT * FROM users WHERE username='$username' AND password='$password' AND user_category='Director'";
    $directorResult = $conn->query($directorQuery);

    if ($directorResult->num_rows > 0) {
        // Director login successful
        $directorUser = $directorResult->fetch_assoc();
        $_SESSION["user_type"] = "director";
        $_SESSION["USERNAME"] = $username; // Assuming the ID column is named ID_NUMBER
        $_SESSION["department"] = $directorUser["department"]; // Assuming the department column is named department
        header("Location: all_leaves.php"); // Redirect to all_leaves page for directors
        exit();
    }


    $directorQuery = "SELECT * FROM users WHERE username='$username' AND password='$password' AND user_category='HR'";
    $directorResult = $conn->query($directorQuery);

    if ($directorResult->num_rows > 0) {
        // HR login successful
        $directorUser = $directorResult->fetch_assoc();
        $_SESSION["user_type"] = "HR";
        $_SESSION["USERNAME"] = $username; // Assuming the ID column is named ID_NUMBER
        header("Location: HR_leaves.php"); // Redirect to all_leaves page for directors
        exit();
    }

    // Check other users (Admin, Staff)
    $otherUsersQuery = "SELECT * FROM users WHERE username='$username' AND password='$password' AND user_category IN ('Admin', 'Staff')";
    $otherUsersResult = $conn->query($otherUsersQuery);

    if ($otherUsersResult->num_rows > 0) {
        // Admin/Staff login successful
        $otherUser = $otherUsersResult->fetch_assoc();
        $_SESSION["user_type"] = "other";
        $_SESSION["ID_NUMBER"] = $otherUser["ID_NUMBER"]; // Assuming the ID column is named ID_NUMBER
        header("Location: index.php"); // Redirect to employee dashboard
        exit();
    }


    $staffQuery = "SELECT * FROM staff WHERE username='$username' AND password='$password'";
    $staffResult = $conn->query($staffQuery);

    if ($staffResult->num_rows > 0) {
        // Staff login successful
        $staffUser = $staffResult->fetch_assoc();
        $_SESSION["user_type"] = "staff";
        $_SESSION["ID_NUMBER"] = $staffUser["ID_NUMBER"]; // Assuming the ID column is named ID_NUMBER
        header("Location: employee.php"); // Redirect to staff dashboard
        exit();
    }

    // Invalid login
    echo "<script>
            alert('Invalid username or password');
            window.location.href = 'login.php';
          </script>";
}

$conn->close();
?>
