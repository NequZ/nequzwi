<?php
/******************************* Module Header ******************************\
 * Module Name:  logout.php
 * Project:      NequZWI
 * Copyright (c) NequZ
 *
 * This file contains the logout script.
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
session_destroy();
header("Refresh:3; url='login.php'");
echo '<div class="btn-info">Logout Successful</div>';


$username = $_SESSION['username'];
$smt = $db->prepare("UPDATE user SET logedin = 0 WHERE username = :username");
$smt->bindParam(':username', $username);
$smt->execute();

?>