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
    $smt = $db->prepare("SELECT * FROM `user_service`");
    $smt->execute();
    $services = $smt->fetchAll();


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
                            <th>ID</th>
                            <th>Service ID</th>
                            <th>Service Category</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th>Register-Date</th>
                            <th>End-Date</th>
                            <th>Blocked</th>
                            <th>IP</th>
                            <th>CPU-Cores</th>
                            <th>Memory</th>
                            <th>Gameserver</th>
                            <th>Software</th>
                            <th>Online</th>
                            <th>CPU-Usage</th>
                            <th>RAM-Usage</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($services as $service) : ?>
                            <tr>
                                <td><?php echo $service['id']; ?></td>
                                <td><?php echo $service['service_id']; ?></td>
                                <td><?php echo $service['service_category']; ?></td>
                                <td><?php echo $service['username']; ?></td>
                                <td>
                                    <?php if ($service['active']) : ?>
                                        <span class="badge badge-success">true</span>
                                    <?php else : ?>
                                        <span class="badge badge-danger">false</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $service['registerdate']; ?></td>
                                <td><?php echo $service['validuntil']; ?></td>
                                <td><?php echo $service['blocked']; ?></td>
                                <td><?php echo $service['ip']; ?></td>
                                <td><?php echo $service['cpu_cores']; ?></td>
                                <td><?php echo $service['memory']; ?></td>
                                <td><?php echo $service['isgameserver']; ?></td>
                                <td><?php echo $service['software']; ?></td>
                                <td>
                                    <?php if ($service['isonline']) : ?>
                                        <span class="badge badge-success">true</span>
                                    <?php else : ?>
                                        <span class="badge badge-danger">false</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $service['currentusage_cpu']; ?></td>
                                <td><?php echo $service['currentusage_memory']; ?></td>

                                <td><a href="#" class="btn btn-primary btn-sm">Manage</a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <?php include 'footer.php'; ?>