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
                <a class="nav-link" href="account.php">
                    <i class="fa fa-envelope-o">

                    </i>
                    Account
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
$smt = $db->prepare("SELECT * FROM user_service WHERE username = :username");
$smt->bindParam(':username', $_SESSION['username']);
$smt->execute();
$services = $smt->fetchAll();

// get service name from service_id from the table called service
foreach ($services as $key => $service) {
    $smt = $db->prepare("SELECT * FROM service WHERE service_id = :id");
    $smt->bindParam(':id', $service['service_id']);
    $smt->execute();
    $service = $smt->fetch();
    $services[$key]['service_id'] = $service['service_name'];
}


?>
<!-- Create Table -->
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-md-50">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-dark">
                        <thead>
                        <tr>
                            <th>Service ID</th>
                            <th>Service</th>
                            <th>Register Date</th>
                            <th>Expire Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($services as $service) : ?>
                            <tr>
                                <td><?php echo $service['id']; ?></td>
                                <td><?php echo $service['service_id']; ?></td>
                                <td><?php echo $service['registerdate']; ?></td>
                                <td><?php echo $service['validuntil']; ?></td>
                                <td>
                                    <?php if ($service['validuntil'] < date('Y-m-d')) : ?>
                                        <span class="badge badge-danger">Expired</span>
                                    <?php else : ?>
                                        <span class="badge badge-success">Active</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($service['blocked'] == '1') : ?>
                                        <span class="badge badge-danger">Blocked</span>
                                    <?php else : ?>
                                        <a href="edit.php?id=<?php echo $service['id']; ?>" class="btn btn-primary btn-sm">Manage</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- footer section -->
    <div class="footer_menu">
        <footer class="container-fluid footer_section">
            <p class="text-center">
                Copyright 2022 <a href="https://github.com/NequZ" target="_blank">NequZ / Niclas</a> All rights reserved | This Website is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://github.com/NequZ" target="_blank">Niclas</a>
            </p>
        </footer>
    </div>