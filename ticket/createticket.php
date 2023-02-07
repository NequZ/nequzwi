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

include '../config.php';
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

// get all services from user_service table with the username
$stmt = $db->prepare("SELECT * FROM user_service WHERE username = :username");
$stmt->bindParam(':username', $username);
$stmt->execute();
$services = $stmt->fetchAll();

if(isset($_POST['submit']) ) {
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $username = $_SESSION['username'];
    $date = date("Y-m-d H:i:s");
    $open = 0;
    $linked_service_id = $_POST['linked_service_ids'];
    $stmt = $db->prepare("INSERT INTO user_ticket (subject, message, username, date, open, linked_service_id) VALUES (:subject, :message, :username, :date, :open, :linked_service_id)");
    $stmt->bindParam(':subject', $subject);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':open', $open);
    $stmt->bindParam(':linked_service_id', $linked_service_id);
    $stmt->execute();
    echo "<script>alert('Ticket created!')</script>";
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

    <title>Support</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700|Raleway:400,700&display=swap" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="../css/responsive.css" rel="stylesheet" />
</head>

<?php include '../navbar.php'; ?>
<div class="container">
    <div class="row justify-content-lg-left">
        <div class="col-md-2">
            <div class="icon-card">
                <a href="../support.php"><i class="fa-solid fa-circle-plus fa-2x"></i></a>
                <p>Back</p>
            </div>
            <div class="icon-card">
                <a href="/ticket/ticket_overview.php?username=<?php echo $username; ?>"<i class="fa-solid fa-clipboard-list fa-2x"></i></a>
                <p>Ticket Overview</p>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h3>Create Ticket</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <input type="text" name="subject" placeholder="Subject" />
                        <input type="text" name="message" placeholder="Description" />
                        <button type="submit" name="submit">Create Ticket</button>

                    <br>
                    <table style="margin: 0 auto;">
                        <thead>
                        <span>Services</span>
                        <tr>
                            <th></th>
                            <p>Choose the services you want to add to the ticket</p>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($services as $service) { ?>
                            <tr>
                                <td><?php echo $service['service_id']; ?></td>
                                <td><input type="checkbox" name="linked_service_ids[]" value="<?php echo $service['service_id']; ?>"></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>







<?php include '../footer.php'; ?>