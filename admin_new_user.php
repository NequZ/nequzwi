<?php
/******************************* Module Header ******************************\
 * Module Name:  admin_userlist.php
 * Project:      NequZWI
 * Copyright (c) NequZ
 *
 * This file contains the admin userlist page.
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


if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $rank = $_POST['rank'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $lastlogin = "0000-00-00 00:00:00";
    $logedin = 0;
    $blocked = 1;
    $stmt = $db->prepare("INSERT INTO user (username, password, email, rank, lastlogin, logedin, blocked) VALUES (:username, :password, :email, :rank, :lastlogin, :logedin, :blocked)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':rank', $rank);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':lastlogin', $lastlogin);
    $stmt->bindParam(':logedin', $logedin);
    $stmt->bindParam(':blocked', $blocked);
    $stmt->execute();

    $firstname = "PLACEHOLDER";
    $lastname = "PLACEHOLDER";
    $zip_code = "000";
    $city = "PLACEHOLDER";
    $county = "PLACEHOLDER";
    $adress = "PLACEHOLDER";
    $username = $_POST['username'];
    $blocked = 0;

    $stmt = $db->prepare("UPDATE user SET blocked = :blocked WHERE username = :username");
    $stmt->bindParam(':blocked', $blocked);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $stmt = $db->prepare("INSERT INTO user_informations (username, firstname, lastname, zip_code, city, county, adress) VALUES (:username, :firstname, :lastname, :zip_code, :city, :county, :adress)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':zip_code', $zip_code);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':county', $county);
    $stmt->bindParam(':adress', $adress);
    $stmt->execute();

    header("Location: admin_userlist.php");
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

    <title>Usercreation</title>

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

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Create New User</h2>
            <form action="" method="post">
            <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="rank">Rank</label>
                    <input type="text" class="form-control" id="rank" name="rank" placeholder="Enter rank">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>