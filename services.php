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
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header("Location: login.php");
    exit;
}

// get user data from database
$stmt = $db->prepare("SELECT * FROM user WHERE username = :username");
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->execute();
$user = $stmt->fetch();

// get services data from database
$stmt = $db->prepare("SELECT * FROM user_service");
$stmt->execute();
$services = $stmt->fetchAll();

//count services
$stmt = $db->prepare("SELECT COUNT(*) FROM user_service");
$stmt->execute();
$servicescount = $stmt->fetchColumn();


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


<div class="card text-center">
    <div class="card-header">
        <i class="fa-sharp fa-solid fa-circle-info"></i>
    </div>
    <div class="card-body">
        <p class="card-text" style="font-size: 1em;">You have currently <?php echo $servicescount; ?> Services</p>
    </div>
    <div class="card-body">
        <p class="card-text" style="font-size: 1em;">There are currently  <?php echo $servicescount; ?> Tickets</p> <!-- Need to adjusted later -->
    </div>

</div>



<?php include 'footer.php'; ?>