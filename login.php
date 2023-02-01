<?php
/******************************* Module Header ******************************\
 * Module Name:  <File Name>
 * Project:      NequZWI
 * Copyright (c) NequZ
 *
 * <Description of the file>
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
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header("Location: dashboard.php");
    exit;
}

include 'config.php';

// check if form is submitted and if username and password is set
if (isset($_POST['username']) && isset($_POST['password'])) {
    // get username and password from form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // check if username and password is correct
    $stmt = $db->prepare("SELECT * FROM user WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $user = $stmt->fetch();

    // if user is found
    if ($user) {
        // set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $user['id'];
        $_SESSION['rank'] = $user['rank'];

        $smt = $db->prepare("UPDATE user SET lastlogin = NOW(), logedin = 1 WHERE username = :username");

        $smt->bindParam(':username', $username);
        $smt->execute();


        // redirect to dashboard
        header("Location: services.php");

        exit;
    } else {
        // if username or password is incorrect
        echo "Username or password is incorrect";
    }
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

    <title>Login</title>

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


<div class="container" id="container">
    <div class="form-container sign-in-container">
        <form action="login.php" method="post">
            <h1>Login</h1>
            <input type="text" name="username"  placeholder="Username" />
            <input type="password" name="password" placeholder="Password" />
            <a href="#">Forgot your password?</a>
              <input class="login" type="submit" value=Login>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <h1>Want to create a new Account?</h1>
                <p>Enter your personal details and start journey with us</p>
                <a href="register.php" id="signUp">
                    <button class="ghost">Sign Up</button>
                </a>

            </div>
        </div>
    </div>
</div>
</body>
<!-- footer section -->
<footer class="container-fluid footer_section">
    <p>
        Copyright 2022 <a href="https://github.com/NequZ" target="_blank">NequZ / Niclas</a> All rights reserved | This Website is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://github.com/NequZ" target="_blank">Niclas</a>
    </p>
</footer>
<!-- footer section -->


