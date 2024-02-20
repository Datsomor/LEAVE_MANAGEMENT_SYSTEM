
<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smls";

$conn = new mysqli($servername, $username, $password, $dbname);

// Rest of the code...
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Leaves Application</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

    <script defer src="assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
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
                            <a href="index.php" class='sidebar-link'>
                                <i class="fa fa-home text-success"></i>
                                <span>Dashboard</span>
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
                      <li class="dropdown nav-icon">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link  dropdown-toggle nav-link-lg nav-link-user">
                                <div class="d-lg-inline-block">
                                    <i data-feather="bell"></i><span id="unread-count" style="display: none;"></span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-large">
                                <h6 class='py-2 px-4'>Notifications</h6>
                                <!-- Add this div where you want to display notifications -->
                                <div id="director-notification-panel"></div>

                            </div>
                        
                     <li class="dropdown">
                        <a href="#" data-bs-toggle="dropdown"
                           class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                           <div class="avatar me-1">
                              <img src="assets/images/admin.png" alt="" srcset="">
                           </div>
                           <div class="d-none d-md-block d-lg-inline-block">Hi, Director</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                           <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                           <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>
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
                            <h3>Leave Application</h3>
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
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <table class='table' id="table1">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Leave Type</th>
                                        <th>Submission Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include('all_leavesdata.php');
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
    <script>
        function approveLeave(leaveId) {
            updateLeaveStatus(leaveId, 'Director Approved');
        }

        function rejectLeave(leaveId) {
            var reason = prompt("Enter reason for rejection:");
            if (reason !== null && reason !== "") {
                updateLeaveStatus(leaveId, 'Director Rejected', reason);
            }
        }

        function updateLeaveStatus(leaveId, status, reason = null) {
            // Send an AJAX request to update leave status on the server
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_leave_status.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Handle the response (if needed)
                    alert(xhr.responseText); // You can remove this or handle it as per your needs
                }
            };
            var params = "leaveId=" + leaveId + "&status=" + status + "&reason=" + reason;
            xhr.send(params);
        }

       // Function to fetch notifications and update the director's panel
function fetchNotifications() {
    console.log("Fetch Notifications");
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "dir_notification.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Update the director's notification panel with fetched notifications
            var notifications = JSON.parse(xhr.responseText);
            updateNotificationPanel(notifications);
        }
    };
    xhr.send();
}

// Function to update the director's notification panel
// Function to update the director's notification panel
function updateNotificationPanel(notifications) {
    var notificationPanel = document.getElementById("director-notification-panel");

    // Clear existing notifications
    notificationPanel.innerHTML = "";

    // Append new notifications
    notifications.forEach(function (notification) {
        var notificationItem = document.createElement("div");
        notificationItem.innerHTML = `
            <div class="notification-item">
                <a href="all_leaves.php" onclick="markNotificationAsViewed(${notification.id})">
                    <h6 class='text-bold'>${notification.FULL_NAME}</h6>
                    <p class='text-xs'>
                        applied for ${notification.LEAVE_TYPE} leave on ${notification.SUBMISSION_DATE}
                    </p>
                </a>
                <button class="btn btn-sm btn-danger" onclick="clearNotification(${notification.id})">Clear</button>
            </div>
        `;
        notificationPanel.appendChild(notificationItem);
    });
}

// Function to clear a notification
function clearNotification(notificationId) {
    console.log("Clearing notification with ID: " + notificationId);
    
    // Send an AJAX request to clear the notification on the server
    fetch("clear_notification.php", {
        method: "POST",
        headers: {
            "Content-type": "application/x-www-form-urlencoded",
        },
        body: "notificationId=" + notificationId, // Use the same parameter name
    })
    .then(response => response.text())
    .then(data => {
        console.log("Response from server:", data);
        // After clearing the notification, fetch notifications again
        fetchNotifications();
    })
    .catch(error => {
        console.error("Error clearing notification:", error);
    });
}



// Fetch notifications on page load
fetchNotifications();

    </script>

</body>

</html>