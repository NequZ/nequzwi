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