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



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST["full_name"];
    $contact = $_POST["contact"];
    $email = $_POST["email"];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userCategory = $_POST['user_category'];
    $Directorate = $_POST['Directorate'];

    $sql = "INSERT INTO users (full_name,  email, contact, username, user_category, Directorate, password)
    VALUES ('$fullName',   '$email', '$contact', '$username', '$userCategory', '$Directorate', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        // User added successfully, display success message
        echo "<script>
                alert('User added successfully');
                window.location.href = 'add_user.html'; // Redirect back to the same page
              </script>";
    } else {
        // User not added, display error message
        echo "<script>
                alert('User not added');
                window.location.href = 'add_user.html'; // Redirect back to the same page
              </script>";
    }
}

$conn->close();
?>