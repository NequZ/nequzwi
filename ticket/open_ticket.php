<?php
/******************************* Module Header ******************************\
 * Module Name:  open_ticket.php
 * Project:      NequZWI
 * Copyright (c) NequZ
 *
 * This File contains the the Ticket which is opened by the user in ticket_overview.php
 *
 * GNU GENERAL PUBLIC LICENSE
 * Version 3, 29 June 2007
 *
 * Copyright (C) 2007 Free Software Foundation, Inc. <https://fsf.org/>
 * Everyone is permitted to copy and distribute verbatim copies
 * of this license document, but changing it is not allowed.
 *
 * \***************************************************************************/

include '../config.php';
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header("Location: login.php");
    exit;
}
$id = $_GET['ticket_id'];
$username = $_SESSION['username'];

$stmt = $db->prepare("SELECT * FROM user_ticket WHERE id = :ticket_id AND username = :username");
$stmt->bindParam(':ticket_id', $id);
$stmt->bindParam(':username', $username);
$stmt->execute();
$ticket = $stmt->fetch();

$sql = $db->prepare("SELECT * FROM user_ticket_comments WHERE ticket_id = :ticket_id AND creator = :username");
$sql->bindParam(':ticket_id', $id);
$sql->bindParam(':username', $username);
$sql->execute();
$comments = $sql->fetchAll();

if(isset($_POST['submit']) ) {
    $message = $_POST['comment'];
    $username = $_SESSION['username'];
    $date = date("Y-m-d H:i:s");
    $stmt = $db->prepare("INSERT INTO user_ticket_comments (ticket_id, message, creator, created) VALUES (:ticket_id, :message, :username, :date)");
    $stmt->bindParam(':ticket_id', $id);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':date', $date);
    $stmt->execute();
    header ("Location: open_ticket.php?ticket_id=$id");
    exit;

}

if (isset($_POST['close'])) {
    $stmt = $db->prepare("UPDATE user_ticket SET open = 1 WHERE id = :ticket_id");
    $stmt->bindParam(':ticket_id', $id);
    $stmt->execute();
    $sql = "INSERT INTO user_ticket_comments (ticket_id, message, creator, created) VALUES (:ticket_id, 'Ticket Closed by User', 'System', :date)";
    $stmt = $db->prepare($sql);
    $date = date("Y-m-d H:i:s");
    $stmt->bindParam(':ticket_id', $id);
    $stmt->bindParam(':date', $date);
    $stmt->execute();

    header ("Location: ticket_overview.php");
    exit;

}

if (isset($_POST['open'])) {
    $stmt = $db->prepare("UPDATE user_ticket SET open = 0 WHERE id = :ticket_id");
    $stmt->bindParam(':ticket_id', $id);
    $stmt->execute();
    $sql = "INSERT INTO user_ticket_comments (ticket_id, message, creator, created) VALUES (:ticket_id, 'Ticket Reopened by User', 'System', :date)";
    $stmt = $db->prepare($sql);
    $date = date("Y-m-d H:i:s");
    $stmt->bindParam(':ticket_id', $id);
    $stmt->bindParam(':date', $date);
    $stmt->execute();
    header ("Location: ticket_overview.php");
    exit;
}



?>

<!DOCTYPE html>
<html>

<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../css/fontawesome.css" rel="stylesheet">
    <link href="../css/brands.css" rel="stylesheet">
    <link href="../css/solid.css" rel="stylesheet">
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Ticket #<?php echo $id?></title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700|Raleway:400,700&display=swap" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet" />
    <link href="../css/ticket.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="../css/responsive.css" rel="stylesheet" />
</head>

<?php include '../navbar.php'; ?>
    <div class="container">
        <div class="row justify-content-lg-left">
            <div class="col-md-2">
                <div class="icon-card">
                    <a href="/ticket/createticket.php?username=<?php echo $username; ?>"><i class="fa-solid fa-circle-plus fa-2x"></i></a>
                    <p>Create a New Ticket</p>
                </div>
                <div class="icon-card">
                    <a href="ticket_overview.php"<i class="fa-solid fa-clipboard-list fa-2x"></i></a>
                    <p>Back</p>
                </div>
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3>Ticket #<?php echo $id?></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p>Subject: <?php echo $ticket['subject']?></p>
                                <hr>
                                <p>Created: <?php echo $ticket['date']?></p>
                            </div>
                            <div class="col-md-6">
                                <p>Username: <?php echo $ticket['username']?></p>
                                <hr>
                                <?php if ($ticket['open'] == 0) { ?>
                                    <p>Status: <span class="badge badge-success">Open</span></p>
                                <form method="post">
                                    <input type="submit" name="close" value="Close Ticket" class="btn btn-danger">
                                </form>
                                    <?php } else { ?>
                                <p>Status: <span class="badge badge-danger">Closed</span></p>
                                    <form method="post">
                                        <input type="submit" name="open" value="Open Ticket" class="btn btn-success">
                                    </form>
                                <?php } ?>
                            </div>
                        </div>
                        <hr><hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Message: </h5>
                                <hr>
                                <p><?php echo $ticket['message']?></p>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <hr>



                <?php

$sql = "SELECT * FROM user_ticket_comments WHERE ticket_id = $id ORDER BY created DESC";
$result = $db->query($sql);

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $comment_message = $row['message'];
    $comment_date = $row['created'];
    $comment_username = $row['creator'];
    echo "
<div class='comment-bubble'>
    <p class='comment-message'><i class='fa fa-pencil-square'></i><strong> Comment:</strong> <br><br>$comment_message</p>
    <div class='comment-info'>
        <span class='comment-date'>$comment_date</span><br>
        <i class='fa fa-address-book'></i> From: <span class='comment-username'>$comment_username</span>
    </div>
</div>

    ";
}
?><?php if  ($ticket['open'] == 0) { ?>
                <form method="post">
                    <div class='comment-bubble'>
                        <label for="comment">Comment:</label>
                        <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>


    <?php include '../footer.php'; ?>


