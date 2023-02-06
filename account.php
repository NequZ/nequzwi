<?php
/******************************* Module Header ******************************\
 * Module Name:  account.php
 * Project:      NequZWI
 * Copyright (c) NequZ
 *
 * This file contains the account management page.
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
$smt = $db->prepare("SELECT * FROM user_informations WHERE username = :username");
$smt->bindParam(':username', $_SESSION['username']);
$smt->execute();
$services = $smt->fetchAll();
?>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="icon-card">
                <i class="fas fa-user-circle fa-2x"></i>
                <p>Account Information</p>
            </div>
            <div class="icon-card">
                <a href="user_invoice.php"><i class="fa-sharp fa-solid fa-file-invoice fa-2x"></i></a>
                <p>Invoices</p>
            </div>
            <div class="icon-card">
                <a href="support.php"><i class="fa-solid fa-ticket fa-2x"></i></a>
                <p>Support</p>
            </div>
        </div>
        <?php foreach ($services as $service) : ?>
            <div class="col-md-4">
                <table class="table table-striped table-bordered table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Account Information</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><b>Username:</b> <?php echo $service['username']; ?></td>
                    </tr>
                    <tr>
                        <td><b>First Name:</b> <?php echo $service['firstname']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Last Name:</b> <?php echo $service['lastname']; ?></td>
                    </tr>
                    <tr>
                        <td><b>ZIP Code:</b> <?php echo $service['zip_code']; ?></td>
                    </tr>
                    <tr>
                        <td><b>City:</b> <?php echo $service['city']; ?></td>
                    </tr>
                    <tr>
                        <td><b>County:</b> <?php echo $service['county']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Address:</b> <?php echo $service['adress']; ?></td>
                    </tr>
                    </tbody>
                </table>
                <a href="editaccount.php?id=<?php echo $service['id']; ?>" class="btn btn-primary btn-sm">Edit Account Informations</a>
            </div>

        <?php endforeach; ?>
    </div>

</div>


    <?php include 'footer.php'; ?>