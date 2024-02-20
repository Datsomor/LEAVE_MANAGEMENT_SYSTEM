
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smls";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch leave application data
$sql = "SELECT status, COUNT(*) AS count FROM leave_application GROUP BY status";
$result = $conn->query($sql);

// Initialize arrays for chart data
$labels = [];
$data = [];

// Process result set
while ($row = $result->fetch_assoc()) {
    $labels[] = $row['status'];
    $data[] = $row['count'];
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
      <script defer src="assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
      <style type="text/css">
        .notif:hover{
          background-color: rgba(0,0,0,0.1);
                  }
      </style>
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
                     <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                        <i class="fa fa-table text-success"></i>
                        <span>Grade</span>
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
                     <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                        <i class="fa fa-users text-success"></i>
                        <span>Staff</span>
                        </a>
                        <ul class="submenu ">
                           <li>
                              <a href="add_employee.html">Add Staff</a>
                           </li>
                           <li>
                              <a href="manage_employee.html">Manage Staff</a>
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
                              <a href="manage_leave_type.html">Manage Leave Type</a>
                           </li>
                        </ul>
                     </li>
                     <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                        <i class="fa fa-table text-success"></i>
                        <span>Leave Management</span>
                        </a>
                        <ul class="submenu ">
                           <li>
                              <a href="all_leave.php">All Leaves</a>
                           </li>
                           <li>
                              <a href="pending_leave.php">Pending Leaves</a>
                           </li>
                           <li>
                              <a href="approve_leave.php">Approve Leaves</a>
                           </li>
                           <li>
                              <a href="rejected_leave.php">Not Approve Leaves</a>
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
                     <li class="sidebar-item active">
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
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                <h3>Reports</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="text-success">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Reports</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>


    <div class="btn-group" role="group" aria-label="Chart Switch">
    <button type="button" class="btn btn-primary" id="switchToPie">Pie Chart</button>
    <button type="button" class="btn btn-primary" id="switchToBar">Bar Chart</button>
</div>

<!-- Button to Print Report -->
<button type="button" class="btn btn-success" id="printReport">Print Report</button>

<!-- Pie Chart -->
<section id="pie-chart-section">
    <div class="row match-height">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="chart chart-lg">
                            <canvas id="chartjs-pie"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Bar Chart (Initially hidden) -->
<section id="bar-chart-section" style="display: none;">
    <div class="row match-height">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="chart chart-lg">
                            <canvas id="chartjs-bar"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- // Basic Vertical form layout section end -->
</div>
        </div>
    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script src="assets/js/main.js"></script>
  <script src="assets/js/chart.js"></script>
  <script>
   // Pie chart
   new Chart(document.getElementById("chartjs-pie"), {
       type: "pie",
       data: {
           labels: <?php echo json_encode($labels); ?>,
           datasets: [{
               data: <?php echo json_encode($data); ?>,
               backgroundColor: [
                   window.theme.primary,
                   window.theme.warning,
                   window.theme.danger,
                   window.theme.info,
               ],
               borderColor: "transparent"
           }]
       },
       options: {
           maintainAspectRatio: true,
           legend: {
               display: true
           }
       }
   });

   // Bar chart
   new Chart(document.getElementById("chartjs-bar"), {
       type: "bar",
       data: {
           labels: <?php echo json_encode($labels); ?>,
           datasets: [{
               label: "Number of Leaves",
               data: <?php echo json_encode($data); ?>,
               backgroundColor: [
                   window.theme.primary,
                   window.theme.warning,
                   window.theme.danger,
                   window.theme.info,
               ],
               borderColor: "transparent"
           }]
       },
       options: {
           maintainAspectRatio: true,
           legend: {
               display: false
           },
           scales: {
               xAxes: [{
                   barPercentage: 0.4
               }],
               yAxes: [{
                   ticks: {
                       beginAtZero: true
                   }
               }]
           }
       }
   });
   document.getElementById('switchToPie').addEventListener('click', function () {
        document.getElementById('pie-chart-section').style.display = 'block';
        document.getElementById('bar-chart-section').style.display = 'none';
    });

    document.getElementById('switchToBar').addEventListener('click', function () {
        document.getElementById('pie-chart-section').style.display = 'none';
        document.getElementById('bar-chart-section').style.display = 'block';
    });


       document.getElementById('printReport').addEventListener('click', function () {
        var currentChartType = document.getElementById('pie-chart-section').style.display === 'block' ? 'pie' : 'bar';

        // Create a temporary chart to get the legend and data
        var tempChart = new Chart(document.createElement('canvas'), {
            type: currentChartType,
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: [
                        window.theme.primary,
                        window.theme.warning,
                        window.theme.danger,
                        window.theme.info,
                    ],
                    borderColor: "transparent"
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                },
            },
        });

        // Print the report
        window.print();

        // Destroy temporary chart
        tempChart.destroy();
    });
   


</script>
</body>
</html>
