<?php
/******************************* Module Header ******************************\
 * Module Name:  edit.php
 * Project:      NequZWI
 * Copyright (c) NequZ
 *
 * This file contains the edit script for editing the Service on the Customer side.
 *
 * GNU GENERAL PUBLIC LICENSE
 * Version 3, 29 June 2007
 *
 * Copyright (C) 2007 Free Software Foundation, Inc. <https://fsf.org/>
 * Everyone is permitted to copy and distribute verbatim copies
 * of this license document, but changing it is not allowed.
 *
 * \***************************************************************************/

include 'config.php';
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header("Location: login.php");
    exit;
}
$id = $_GET['id'];
// check if id is in the database and if its in the same column as the session username
$stmt = $db->prepare("SELECT * FROM user_service WHERE id = :id AND username = :username");
$stmt->bindParam(':id', $id);
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->execute();
$service = $stmt->fetch();
if (!$service) {
    header("Location: servicedashboard.php");
    exit;
}


?>

<!DOCTYPE html>
<html>

<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="/css/fontawesome.css" rel="stylesheet">
    <link href="/css/brands.css" rel="stylesheet">
    <link href="/css/solid.css" rel="stylesheet">
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Services</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700|Raleway:400,700&display=swap" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
</head>

<nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Account Management</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="services.php">
                    <i class="fa fa-home"></i>
                    Home
                    <span class="sr-only">(current)</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="servicedashboard.php">
                    <i class="fa fa-envelope-o">

                    </i>
                    Services
                </a>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">
                    <i class="fa fa-envelope-o">
                        <span class="badge badge-warning">X</span>
                    </i>
                    WIP
                </a>
            </li>
        </ul>
        <div class="navbar-text mx-auto">
            Welcome Back <?php echo $_SESSION['username']; ?>
        </div>
        <ul class="navbar-nav ">
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fa fa-bell">

                    </i>
                    Shop Page
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fa fa-globe">
                    </i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</nav>
<br>

<?php
// get the service from the database
$stmt = $db->prepare("SELECT * FROM user_service WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$service = $stmt->fetch();

// get the service from the database
$ip = $service['ip'];
$status = $service['isonline'];

$status = $service['isonline'];
if ($status == 1) {
    $status = '<span class="badge badge-success">Online</span>';
} else {
    $status = '<span class="badge badge-danger">Offline</span>';
}
?>

<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="servicedashboard.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Manage</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="support.php">Support</a>
            </li>
        </ul>
    </div>
</nav>
<!-- End of Navbar -->

<!-- Table -->
<div class="container mt-3">
    <h1>Service Details ID #<?php echo $service['id']; ?></h1>
    <table class="table table-info">
        <thead>
        <tr>
            <th>IP Adress</th>
            <th>Booked CPU</th>
            <th>Booked Memory</th>
            <th>Operatingsystem</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $service['ip']; ?></td>
            <td><?php echo $service['cpu_cores']; ?> Core/s</td>
            <td><?php echo $service['memory']; ?> GB</td>
            <td><?php echo $service['software']; ?></td>
            <td><?php echo $status;?></td>
        </tr>
        </tbody>
    </table>
    <div class="row mt-6">
        <div class="col-md-6 text-center">
            <canvas id="cpuUsageCircle" class="mx-auto"></canvas>
            <p class="text-center"><i class="fa-sharp fa-solid fa-microchip"></i> CPU Usage</p>
        </div>
        <div class="col-md-6 text-center">
            <canvas id="memoryUsageCircle" class="mx-auto"></canvas>
            <p class="text-center"><i class="fa-sharp fa-solid fa-memory"></i> Memory Usage: </p>
        </div>
    </div>
</div>

<script>
    // Get the canvas elements
    const cpuUsageCircle = document.getElementById("cpuUsageCircle");
    const memoryUsageCircle = document.getElementById("memoryUsageCircle");

    // Set the canvas size
    cpuUsageCircle.width = 200;
    cpuUsageCircle.height = 200;
    memoryUsageCircle.width = 200;
    memoryUsageCircle.height = 200;

    // Get the context
    const cpuContext = cpuUsageCircle.getContext("2d");
    const memoryContext = memoryUsageCircle.getContext("2d");

    // Draw the CPU usage circle
    cpuContext.beginPath();
    cpuContext.arc(100, 100, 80, 0, 2 * Math.PI * <?php echo $service['currentusage_cpu'] / 100; ?>);
    cpuContext.strokeStyle = "#28a745";
    cpuContext.lineWidth = 20;
    cpuContext.stroke();
    cpuContext.fillStyle = "#28a745";
    cpuContext.font = "20px Arial";
    cpuContext.textAlign = "center";
    cpuContext.textBaseline = "middle";
    cpuContext.fillText("<?php echo $service['currentusage_cpu']; ?>%", 100, 100);


    // Draw the memory usage circle
    memoryContext.beginPath();
    memoryContext.arc(100, 100, 80, 0, 2 * Math.PI * <?php echo $service['currentusage_memory'] / 100; ?>);
    memoryContext.strokeStyle = "#007bff";
    memoryContext.lineWidth = 20;
    memoryContext.stroke();
    memoryContext.fillStyle = "#007bff";
    memoryContext.font = "20px Arial";
    memoryContext.textAlign = "center";
    memoryContext.textBaseline = "middle";
    memoryContext.fillText("<?php echo $service['currentusage_memory']; ?>%", 100, 100);
</script>
</div>

