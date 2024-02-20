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

// Check if user is logged in and has a session with id_number
if (isset($_SESSION['ID_NUMBER'])) {
    $idNumber = $_SESSION['ID_NUMBER'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $oldPassword = $_POST['old_password'];
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];

        // Validate the new password
        $errors = array();

// Check if the old password is correct
$checkOldPasswordQuery = "SELECT PASSWORD FROM Staff WHERE id_number = '$idNumber'";
$checkOldPasswordResult = $conn->query($checkOldPasswordQuery);

if ($checkOldPasswordResult) {
    $row = $checkOldPasswordResult->fetch_assoc();
    $storedOldPassword = $row['PASSWORD'];

    // Check if the provided old password matches the stored old password
    if ($oldPassword != $storedOldPassword) {
        $errors[] = "Old password is incorrect";
    }
} else {
    $errors[] = "Error checking old password: " . $conn->error;
}


        

        // Validate the new password format
        if (!preg_match("/^(?=.*[A-Z])(?=.*[0-9!@#\$%\^&\*])(?=.{8,})/", $newPassword)) {
            $errors[] = "New password must be at least 8 characters long and contain at least one uppercase letter, one number, and one special character";
        }

        // Check if the new password is the same as the old password
        if ($oldPassword == $newPassword) {
            $errors[] = "New password cannot be the same as the old password";
        }

        // Check if the new password and confirm password match
        if ($newPassword != $confirmPassword) {
            $errors[] = "New password and confirm password do not match";
        }

        // If there are no errors, update the password
        if (empty($errors)) {
            $updatePasswordQuery = "UPDATE Staff SET PASSWORD = '$newPassword' WHERE id_number = '$idNumber'";

            if ($conn->query($updatePasswordQuery) === TRUE) {
                echo "<script>";
        echo "setTimeout(function() { window.location.href = 'update_password.php'; }, 2000);"; // 2000 milliseconds (2 seconds)
        echo "</script>";
            } else {
                echo "Error updating password: " . $conn->error;
            }
        } else {
            // Display all errors and refresh the page using JavaScript
            echo "<script>";
            echo "var errorMessages = " . json_encode($errors) . ";";
            echo "alert(errorMessages.join('\\n'));";
            echo "window.location.href = 'update_password.php';";
            echo "</script>";
        }
        
        
        
        
    }    

    // Close connection
    $conn->close();
} else {
    // Redirect to login page or handle the case when the user is not logged in
    header("Location: login.php");
    exit();
}
?>
