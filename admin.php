<?php
/******************************* Module Header ******************************\
 * Module Name:  services.php
 * Project:      NequZWI
 * Copyright (c) NequZ
 *
 * This file contains the services page.
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
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || !isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$smt = $db->prepare("SELECT `rank` FROM `user` WHERE username = :username");
$smt->bindParam(':username', $_SESSION['username']);
$smt->execute();
$adminRank = $smt->fetchColumn();

if ($adminRank <= 1) {
    header("Location: login.php");
    exit;
}

$stmt = $db->prepare("SELECT COUNT(*) FROM `user_ticket` WHERE `open` = 0");
$stmt->execute();
$count = $stmt->fetchColumn();

$stmt = $db->prepare("SELECT COUNT(*) FROM `user_service`");
$stmt->execute();
$countServices = $stmt->fetchColumn();



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

<?php include 'navbar.php'; ?>
<!-- Create Table -->
    <div class="container">
    <div class="row justify-content-lg-left">
    <div class="col-md-2">
        <div class="icon-card">
            <a href="admin_userlist.php"><i class="fa-solid fa-users fa-2x"></i></a>
            <p>Userlist</p>
        </div>
        <div class="icon-card">
            <a href="admin_servicelist.php"<i class="fa-solid fa-server fa-2x"></i></a>
            <p>Servicelist</p>
        </div>
        <div class="icon-card">
            <a href="admin_ticketoverview.php"<i class="fa-solid fa-ticket fa-2x"></i></a>
            <p>Ticketoverview</p>
        </div>
        <style>
            p {
                margin-top: 20px;
            }
        </style>
    </div>
        <p><i class="fa-solid fa-circle-info"></i>&nbsp;&nbsp;&nbsp;&nbsp;There are <?php echo $count ?> open Tickets at the Moment </p> <hr>

        <p><i class="fa-solid fa-circle-info"></i>&nbsp;&nbsp;&nbsp;&nbsp;There are <?php echo $countServices ?> Servies at the Moment </p>
    </div>


    </div>
    </div>




    <?php include 'footer.php'; ?>