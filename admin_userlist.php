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

<?php include 'navbar.php'; ?>

<?php
    $smt = $db->prepare("SELECT * FROM `user` RIGHT JOIN `user_informations` USING (`username`)");
    $smt->execute();
    $users = $smt->fetchAll();
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
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Login E-Mail</th>
                            <th>Password</th>
                            <th>Status</th>
                            <th>Rank</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Delivery E-Mail</th>
                            <th>ZIP-Code</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Address</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td><?php echo $user['id']; ?></td>
                                <td><?php echo $user['username']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo $user['password']; ?></td>
                                <td>
                                    <?php if ($user['logedin']) : ?>
                                        <span class="badge badge-danger"><?php echo $user['lastlogin']; ?></span>
                                    <?php else : ?>
                                        <span class="badge badge-success"><?php echo $user['lastlogin']; ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $user['rank']; ?></td>
                                <td><?php echo $user['firstname']; ?></td>
                                <td><?php echo $user['lastname']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo $user['zip_code']; ?></td>
                                <td><?php echo $user['city']; ?></td>
                                <td><?php echo $user['county']; ?></td>
                                <td><?php echo $user['adress']; ?></td>

                                <td><a href="#" class="btn btn-primary btn-sm">Manage</a></td>
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