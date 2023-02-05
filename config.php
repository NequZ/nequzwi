<?php
/******************************* Module Header ******************************\
 * Module Name:  config.php
 * Project:      NequZWI
 * Copyright (c) NequZ
 *
 * This file contains the configuration for the website.
 *
 * GNU GENERAL PUBLIC LICENSE
 * Version 3, 29 June 2007
 *
 * Copyright (C) 2007 Free Software Foundation, Inc. <https://fsf.org/>
 * Everyone is permitted to copy and distribute verbatim copies
 * of this license document, but changing it is not allowed.
 *
 * \***************************************************************************/

// Database configuration
$db = new PDO('mysql:host=134.255.227.185;dbname=nequzwi', 'nequzwi', 'eKZyMQCnbQydAWpd75@8q^JmirqU#P6rw45896@ZpPn%fNtdAnQsv5b6tHg4YZg87@*RGA64o8cxbib#fnE#Su6n$Fo5jv!%5NPS8C!!k^5B^FdDaLF$KeG4MvQGP%'); // Main Database String

// Modules
$loglogin = true; // Log login attempts