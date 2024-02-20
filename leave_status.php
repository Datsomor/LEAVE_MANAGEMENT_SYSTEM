
<?php
// Start the session
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smls";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize $userName
$userName = "";

// Check if user is logged in and has a session with id_number
if (isset($_SESSION['ID_NUMBER'])) {
    $idNumber = $_SESSION['ID_NUMBER'];

    // Fetch user information from the database based on id_number
    $userQuery = "SELECT * FROM leave_application WHERE id_number = '$idNumber'";
    $userResult = $conn->query($userQuery);

    // Check if the query was successful
    if ($userResult && $userResult->num_rows > 0) {
        $userRow = $userResult->fetch_assoc();
        $userName = $userRow['FULL_NAME']; // Adjust the column name based on your database
} 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Status</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

    <script defer src="assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
<div class="sidebar-header" style="height: 50px;margin-top: -30px">
                      <i class="fa fa-users text-success me-4"></i>
                        <span>MOFAD</span>
                </div>
               <div class="sidebar-menu">
                  <ul class="menu">
                     <li class="sidebar-item  ">
                        <a href="employee.html" class='sidebar-link'>
                        <i class="fa fa-home text-success"></i>
                        <span>Dashboard</span>
                        </a>
                     </li>
                     <li class="sidebar-item ">
                        <a href="apply_leave.php" class='sidebar-link'>
                        <i class="fa fa-plane text-success"></i>
                        <span>Apply Leave</span>
                        </a>
                     </li>
                     <li class="sidebar-item active">
                        <a href="leave_status.php" class='sidebar-link'>
                        <i class="fa fa-plane text-success"></i>
                        <span>Leave Status</span>
                        </a>
                     </li>
                  </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                      
                     <li class="dropdown">
                        <a href="#" data-bs-toggle="dropdown"
                           class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                           <div class="avatar me-1">
                              <img src="assets/images/admin.png" alt="" srcset="">
                           </div>
                           <div class="d-none d-md-block d-lg-inline-block">Hi, <?php echo $userName; ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                           <a class="dropdown-item" href="update.html"><i data-feather="user"></i> Account</a>
                           <a class="dropdown-item" href="update_password.html"><i data-feather="settings"></i> Settings</a>
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item" href="login.php"><i data-feather="log-out"></i> Logout</a>
                        </div>
                     </li>
                  </ul>
                </div>
            </nav>

            <div class="main-content container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Leave Status</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php" class="text-success">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Manage Leave Status</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <table class='table' id="table1">
                                <thead>
                                    <tr>
                                        <th>Leave Type</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Subnission Date</th>
                                        <th>Rejection Reason</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include('leave_statusdata.php');
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="assets/js/vendors.js"></script>

    <script src="assets/js/main.js"></script>
    </body>

    </html>
    <?php
}else {
    // Redirect to login page or handle the case when the user is not logged in
    ob_start(); // Start output buffering
    echo '<script>window.location.href = "login.php";</script>';
    ob_end_flush(); // Flush the output buffer and turn off output buffering
    exit();
}

// Close connection (we close it here to make sure it's closed before the HTML starts)
$conn->close();
?>