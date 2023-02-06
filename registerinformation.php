<?php
/******************************* Module Header ******************************\
 * Module Name:  registerinformation.php
 * Project:      NequZWI
 * Copyright (c) NequZ
 *
 * This file contains the information about the registration.
 *
 * GNU GENERAL PUBLIC LICENSE
 * Version 3, 29 June 2007
 *
 * Copyright (C) 2007 Free Software Foundation, Inc. <https://fsf.org/>
 * Everyone is permitted to copy and distribute verbatim copies
 * of this license document, but changing it is not allowed.
 *
 * \***************************************************************************/

session_start();
include 'config.php';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header("Location: dashboard.php");
    exit;
}

if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['zip']) && isset($_POST['city']) && isset($_POST['county']) && isset($_POST['adress'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $zip_code = $_POST['zip'];
    $city = $_POST['city'];
    $county = $_POST['county'];
    $adress = $_POST['adress'];
    $username = $_SESSION['username'];
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


    header("Location: dashboard.php");
    exit;
}

?>

<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Registration</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="login/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700|Raleway:400,700&display=swap" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/login.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
    <link href="/css/fontawesome.css" rel="stylesheet">
    <link href="/css/brands.css" rel="stylesheet">
    <link href="/css/solid.css" rel="stylesheet">

</head>
<body>

<html>
<head>
</head>
<body>

<div class="container" id="container">
    <div class="form-container sign-in-container">
        <form action="" method="post">
            <h1>Create Account</h1>
            <input type="text" name="firstname" placeholder="Firstname" required />
            <input type="text" name="lastname" placeholder="Lastname" required />
            <input type="text" name="zip" placeholder="ZIP Code" required />
            <input type="text" name="city" placeholder="City" required />
            <input type="text" name="county" placeholder="County" required />
            <input type="text" name="adress" placeholder="Address" required />
            <button type="submit" id="confirmbutton">Confirm</button>
        </form>
    </div>
</div>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/login.js"></script>
</body>
</html>
