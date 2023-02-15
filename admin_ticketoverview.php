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


// get all open tickets from database
$stmt = $db->prepare("SELECT * FROM `user_ticket` WHERE `open` = 0");
$stmt->execute();
$ticket = $stmt->fetchAll();




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

        <title>Admin Ticketoverview</title>

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

    <div class="container">
            <div class="col-md-10">
                <h5>There are <b><?php echo count($ticket); ?></b> Tickets open</h5>
                <hr>
                <table class="table table-striped table-bordered table-dark">
                    <thead>
                    <tr>
                        <th>Creator</th>
                        <th>TicketID</th>
                        <th>Subject</th>
                        <th>Creation Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($ticket as $ticket): ?>
                        <tr>
                            <td><?php echo $ticket['username']; ?></td>
                            <td><?php echo $ticket['id']; ?></td>
                            <td><?php echo $ticket['subject']; ?></td>
                            <td><?php echo $ticket['date']; ?></td>
                            <td><?php if ($ticket['open'] == 0) { echo "<span class='badge badge-success'>Open</span>"; } else { echo "<span class='badge badge-danger'>Closed</span>";} ?></td>
                            <td>
                                <a href="admin_ticket_open.php?ticket_id=<?php echo $ticket['id']; ?>" class="btn btn-primary">Open</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

