<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Leaves Application</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

    <script defer src="assets/fontawesome/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

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
                     <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                        <i class="fa fa-building text-success"></i>
                        <span>Directorate</span>
                        </a>
                        <ul class="submenu ">
                           <li>
                              <a href="add_department.html">Add Directorate</a>
                           </li>
                           <li>
                              <a href="manage_department.php">Manage Directorate</a>
                           </li>
                        </ul>
                     </li>
                     <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                        <i class="fa fa-table text-success"></i>
                        <span>Designation</span>
                        </a>
                        <ul class="submenu ">
                           <li>
                              <a href="add_designation.html">Add Grade</a>
                           </li>
                           <li>
                              <a href="manage_designation.php">Manage Grade</a>
                           </li>
                        </ul>
                     </li>
                     <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                        <i class="fa fa-users text-success"></i>
                        <span>Staff</span>
                        </a>
                        <ul class="submenu ">
                           <li>
                              <a href="add_employee.html">Add Staff</a>
                           </li>
                           <li>
                              <a href="manage_employee.php">Manage Staff</a>
                           </li>
                        </ul>
                     </li>
                     <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                        <i class="fa fa-table text-success"></i>
                        <span>Leave Type</span>
                        </a>
                        <ul class="submenu ">
                           <li>
                              <a href="add_leave_type.html">Add Leave Type</a>
                           </li>
                           <li>
                              <a href="manage_leave_type.php">Manage Leave Type</a>
                           </li>
                        </ul>
                     </li>
                     <li class="sidebar-item active has-sub">
                        <a href="#" class='sidebar-link'>
                        <i class="fa fa-table text-success"></i>
                        <span>Leave Management</span>
                        </a>
                        <ul class="submenu ">
                           <li>
                              <a href="all_leave.html">All Leaves</a>
                           </li>
                           <li>
                              <a href="pending_leave.html">Pending Leaves</a>
                           </li>
                           <li>
                              <a href="approve_leave.php">Approve Leaves</a>
                           </li>
                           <li>
                              <a href="not_approve_leave.html">Not Approve Leaves</a>
                           </li>
                        </ul>
                     </li>
                     <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                        <i class="fa fa-user text-success"></i>
                        <span>Users</span>
                        </a>
                        <ul class="submenu ">
                           <li>
                              <a href="add_user.html">Add User</a>
                           </li>
                           <li>
                              <a href="manage_user.php">Manage Users</a>
                           </li>
                        </ul>
                     </li>
                     <li class="sidebar-item ">
                        <a href="reports.html" class='sidebar-link'>
                        <i class="fa fa-chart-bar text-success"></i>
                        <span>Reports</span>
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
                                    <i data-feather="bell"></i><span class="badge bg-info">2</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-large">
                                <h6 class='py-2 px-4'>Notifications</h6>
                                <ul class="list-group rounded-none">
                                    <li class="list-group-item border-0 align-items-start">
                                    <div class="row mb-2">
                                    <div class="col-md-12 notif">
                                            <a href="leave_details.html"><h6 class='text-bold'>John Doe</h6>
                                            <p class='text-xs'>
                                                applied for leave at 05-21-2021
                                            </p></a>
                                        </div>
                                    <div class="col-md-12 notif">
                                            <a href="leave_details.html"><h6 class='text-bold'>Jane Doe</h6>
                                            <p class='text-xs'>
                                                applied for leave at 05-21-2021
                                            </p></a>
                                        </div>
                                      </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                     <li class="dropdown">
                        <a href="#" data-bs-toggle="dropdown"
                           class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                           <div class="avatar me-1">
                              <img src="assets/images/admin.png" alt="" srcset="">
                           </div>
                           <div class="d-none d-md-block d-lg-inline-block">Hi, Admin</div>
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
                                    <li><button id="printButton" class="btn btn-success">Print as PDF</button></li>

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
                                        <th>submission Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                 include('all_leavedata.php');
                                      ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function () {
        // Attach a click event to the print button
        $('#printButton').on('click', function () {
            // Create a print-friendly version of the table
            var printContent = $('#table1').clone();

            // Hide elements not needed for printing
            printContent.find('thead tr th:last-child, tbody tr td:last-child').remove();
            printContent.find('.dataTables_paginate, .dataTables_info').remove();
            printContent.find('.sorting, .sorting_asc, .sorting_desc').removeClass('sorting sorting_asc sorting_desc');

            // Create a new window for printing
            var printWindow = window.open('', '_self');

            // Append the print-friendly content to the new window
            printWindow.document.body.innerHTML = '<h2>Leave Application List</h2>' +
                '<table border="1" cellspacing="0" cellpadding="5" style="border-collapse: collapse; width: 100%">' +
                printContent.html() +
                '</table>';

            // Trigger the print function in the new window
            printWindow.print();

            // Poll for changes in the window.matchMedia state
            var mediaQueryList = window.matchMedia('print');
            var checkMediaState = function () {
                if (!mediaQueryList.matches) {
                    // Reload the current page after the print dialog is closed
                    location.reload();
                }
            };

            // Check the media state immediately and then add a listener for future changes
            checkMediaState();
            mediaQueryList.addListener(checkMediaState);

            // Close the window after printing
            printWindow.onafterprint = function () {
                printWindow.close();
            };
        });
    });
</script>





    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="assets/js/vendors.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>