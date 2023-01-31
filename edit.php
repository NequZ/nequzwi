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
?>


<div class="server-overview">
    <h2>Server Overview</h2>
    <div class="left-nav">
        <ul>
            <li><a href="#server-info">Server Information</a></li>
            <li><a href="#server-settings">Server Settings</a></li>
            <li><a href="#server-status">Server Status</a></li>
        </ul>
    </div>
    <div class="right-content">
        <div id="server-info">
            <h3>Server Information</h3>
            <ul>
                <li>
                    <span class="label">Server Name:</span>
                    <span class="value"><?php echo $_SERVER['SERVER_NAME']; ?></span>
                </li>
                <li>
                    <span class="label">Server Address:</span>
                    <span class="value"><?php echo $_SERVER['SERVER_ADDR']; ?></span>
                </li>
                <li>
                    <span class="label">Server Software:</span>
                    <span class="value"><?php echo $_SERVER['SERVER_SOFTWARE']; ?></span>
                </li>
                <li>
                    <span class="label">PHP Version:</span>
                    <span class="value"><?php echo phpversion(); ?></span>
                </li>
                <li>
                    <span class="label">Document Root:</span>
                    <span class="value"><?php echo $_SERVER['DOCUMENT_ROOT']; ?></span>
                </li>
            </ul>
        </div>
        <div id="server-settings">
            <h3>Server Settings</h3>
            <!-- Add server settings information here -->
        </div>
        <div id="server-status">
            <h3>Server Status</h3>
            <!-- Add server status information here -->
        </div>
    </div>
</div>