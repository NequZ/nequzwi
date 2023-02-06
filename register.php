<?php
/******************************* Module Header ******************************\
 * Module Name:  register.php
 * Project:      NequZWI
 * Copyright (c) NequZ
 *
 * This file contains the registration form.
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

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $rank = 1;
    $lastlogin = "0000-00-00 00:00:00";
    $logedin = 0;
    $blocked = 1;

    // check if username is already taken
    $stmt = $db->prepare("SELECT * FROM user WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user) {
        echo "Username already taken";
        echo "<br><br>";
        echo "<a href='register.php'>Back</a>";
        exit;
    }


    $stmt = $db->prepare("INSERT INTO user (username, password, email, rank, lastlogin, logedin, blocked) VALUES (:username, :password, :email, :rank, :lastlogin, :logedin, :blocked)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':rank', $rank);
    $stmt->bindParam(':lastlogin', $lastlogin);
    $stmt->bindParam(':logedin', $logedin);
    $stmt->bindParam(':blocked', $blocked);
    $stmt->execute();

    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['rank'] = $rank;

    header("Location: registerinformation.php");
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
            <input type="text" name="username" placeholder="Username" required />
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <input type="password" name="password2" placeholder="Confirm Password" required />
            <input type="checkbox" name="terms" value="1" required><a href="terms.php">Terms of Service</a>
            <button type="submit" id="signUpButton">Sign Up</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <h1>Welcome</h1>
                <p>You have a Account already?</p>
                <a href="login.php" id="loginLink">
                    <button class="ghost">Login</button>
                </a>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/login.js"></script>
</body>
</html>
