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

// Check if user is logged in and has a session with id_number
if (isset($_SESSION['ID_NUMBER'])) {
    $idNumber = $_SESSION['ID_NUMBER'];

    // Fetch user information from the database based on id_number
    $userQuery = "SELECT * FROM staff WHERE id_number = '$idNumber'";
    $userResult = $conn->query($userQuery);

    // Check if the query was successful and has rows
    if ($userResult && $userResult->num_rows > 0) {
        $userRow = $userResult->fetch_assoc();
        $fullName = $userRow['FIRST_NAME'] . ' ' . $userRow['MIDDLE_NAME'] . ' ' . $userRow['LAST_NAME'];
        $directorate = $userRow['DEPARTMENT']; // Fetch department information
        $userName = $userRow['LAST_NAME']; // Adjust the column name based on your database
    } else {
        // Handle the case when user information is not found
        echo "User information not found.";
        exit();
    }
} else {
    // Redirect to login page or handle the case when the user is not logged in
    ob_start(); // Start output buffering
    echo '<script>window.location.href = "login.html";</script>';
    ob_end_flush(); // Flush the output buffer and turn off output buffering
    exit();
}

// Close connection (we close it here to make sure it's closed before the HTML starts)

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Leave</title>
    
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
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
                     <li class="sidebar-item ">
                        <a href="employee.html" class='sidebar-link'>
                        <i class="fa fa-home text-success"></i>
                        <span>Dashboard</span>
                        </a>
                     </li>
                     <li class="sidebar-item active">
                        <a href="apply_leave.html" class='sidebar-link'>
                        <i class="fa fa-plane text-success"></i>
                        <span>Apply Leave</span>
                        </a>
                     </li>
                     <li class="sidebar-item ">
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
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                <h3>Apply for Leave</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="text-success">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Leave Application</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>


    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="apply_leavedata.php" method="POST">
                                <div class="row">
            <div class="col-md-6 col-12">
            <div class="form-group has-icon-left">
                <label for="first-name-icon">Id Number</label>
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="id number" id="first-name-icon" name="id_number"  value="<?php echo $idNumber; ?>" readonly>
                    <div class="form-control-icon">
                        <i class="fa fa-user"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="leave-type-icon">Leave Type</label>
        <div class="position-relative">
            <input type="text" class="form-control" id="leave-type-icon" name="leave_type" placeholder="Type or select your leave type" <?php echo (calculateLeaveRemaining($conn, $idNumber) == "Out of Leaves") ? 'disabled' : ''; ?>>
        </div>
    </div>
</div>


                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">From Date</label>
                                            <div class="position-relative">
                                                <input type="date" class="form-control" placeholder="first name" id="first-name-icon" name="from_date" <?php echo (calculateLeaveRemaining($conn, $idNumber) == "Out of Leaves") ? 'disabled' : ''; ?>>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="first-name-icon">To Date</label>
                                            <div class="position-relative">
                                                <input type="date" class="form-control" placeholder="first name" id="first-name-icon" name="to_date" <?php echo (calculateLeaveRemaining($conn, $idNumber) == "Out of Leaves") ? 'disabled' : ''; ?>>
                                                <div class="form-control-icon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
            
            <div class="col-md-6 col-12">
            <div class="form-group has-icon-left">
                <label for="first-name-icon">Directorate</label>
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="directorate" id="first-name-icon" name="directorate"  value="<?php echo $directorate; ?>" readonly>
                    <div class="form-control-icon">
                        <i class="fa fa-user"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group has-icon-left">
                <label for="first-name-icon">LEAVE ENTITLED TO</label>
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="leave_days" id="first-name-icon" name="leavedays"  value="<?php echo calculateLeaveRemaining($conn, $idNumber); ?>" readonly>
                    <div class="form-control-icon">
                        <i class="fa fa-user"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-end">
        <button type="submit" class="btn btn-primary me-1 mb-1" <?php echo (calculateLeaveRemaining($conn, $idNumber) == "Out of Leaves") ? 'disabled' : ''; ?>>Submit</button>
    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>

        </div>
    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script src="assets/js/main.js"></script>
</body>
</html>
<?php
function calculateLeaveRemaining($conn, $idNumber) {
    // Fetch user's leave entitlement
    $entitlementQuery = "SELECT leave_days_entitlement FROM staff WHERE id_number = '$idNumber'";
    $entitlementResult = $conn->query($entitlementQuery);

    if ($entitlementResult->num_rows > 0) {
        $entitlementRow = $entitlementResult->fetch_assoc();
        $leaveDaysEntitlement = $entitlementRow['leave_days_entitlement'];
    } else {
        return "Error fetching leave entitlement.";
    }

    // Fetch user's approved leave days
    $approvedLeaveQuery = "SELECT SUM(DATEDIFF(to_date, from_date) + 1) AS total_leave_days FROM leave_application WHERE id_number = '$idNumber' AND status = 'Approved'";
    $approvedLeaveResult = $conn->query($approvedLeaveQuery);

    if ($approvedLeaveResult->num_rows > 0) {
        $approvedLeaveRow = $approvedLeaveResult->fetch_assoc();
        $approvedLeaveDays = $approvedLeaveRow['total_leave_days'];
    } else {
        $approvedLeaveDays = 0;
    }

    // Calculate remaining leave days
    $remainingLeaveDays = $leaveDaysEntitlement - $approvedLeaveDays;

    // Display "Out of Leaves" if remaining leave days are zero
    return ($remainingLeaveDays > 0) ? $remainingLeaveDays : "Out of Leaves";
}

$conn->close();
?>