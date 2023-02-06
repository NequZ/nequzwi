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
$db = new PDO('mysql:host=134.255.227.185;dbname=nequzwi', 'nequzwi', '22e*7TwEi&Ws@Rh4Uhsps&W#A88&#&NJ%sKQ7YNac*o*sD78p98XKcm$6x9B5!PT!5W6mwD!rB5c!U@Jo&$eFF#Ui!ugj!DqsZ9FKLCK7z$jviZH93e^4eaF#%S2SE&6'); // Main Database String

// Modules
$loglogin = true; // Log login attempts