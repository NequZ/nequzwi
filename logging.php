<?php

//include 'config.php';


/*
 * action:
 * 1 - login
 * 2 - logout
 * 3 - edit profile
 * 4 - admin edit profile
 * 5 - admin add profile
 * 6 - admin delete profile
 * 7 - admin add service
 * 8 - admin delete service
 * 9 - ..
 */

function logToDatabase($action, $executing_user_id, $affected_user_id, $actionString = "") {
    require 'config.php';
    $data = [
        'action' => $action,
        'executing_user_id' => $executing_user_id,
        'affected_user_id' => $affected_user_id,
        'actionString' => $actionString
    ];
    $smt = $db->prepare("INSERT INTO `logs` (`action`, `executing_user_id`, `affected_user_id`, `actionString`) VALUES (:action, :executing_user_id, :affected_user_id, :actionString)");
    $smt->execute($data);
}




