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
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header("Location: login.php");
    exit;
}
$user_id = $_GET['id'];
$username = $_SESSION['username'];

$stmt = $db->prepare("SELECT * FROM user_invoices WHERE user_id = :id AND username = :username");
$stmt->bindParam(':id', $user_id);
$stmt->bindParam(':username', $username);
$stmt->execute();
$invoices = $stmt->fetch();


if (!$invoices) {
    header("Location: account.php");
    exit;
}


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

        <title>Services</title>

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
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="icon-card">
                <a href="account.php"><i class="fas fa-user-circle fa-2x"></i></a>
                <p>Account Information</p>
            </div>
            <div class="icon-card">

                <i class="fa-sharp fa-solid fa-file-invoice fa-2x"></i>
                <p>Invoices</p>
            </div>
            <div class="icon-card">
                <a href="support.php"><i class="fa-solid fa-ticket fa-2x"></i></a>
                <p>Support</p>
            </div>
        </div>
        <div class="col-md-4">
            <table class="table table-striped table-bordered table-dark">
<!-- get all invoices from the user -->
                <thead>
                    <tr>
                        <th scope="col">Invoice ID</th>
                        <th scope="col">Creation Date</th>
                        <th scope="col">Full Amount</th>
                        <th scope="col">Payed at</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $db->prepare("SELECT * FROM user_invoices WHERE user_id = :id AND username = :username");
                    $stmt->bindParam(':id', $user_id);
                    $stmt->bindParam(':username', $username);
                    $stmt->execute();
                    $invoices = $stmt->fetchAll();
                    foreach ($invoices as $invoice) {
                        echo "<tr>";
                        echo "<td>" . $invoice['invoicenumber'] . "</td>";
                        echo "<td>" . $invoice['created_at'] . "</td>";
                        echo "<td>" . $invoice['amount'] . " €</td>";
                        echo "<td>" . $invoice['payed_at'] . "</td>";
                        ?> <td> <?php
                            if ($invoice['payed'] == 0) {
                               echo "<span class='badge badge-danger'>Not Payed</span>" ;
                               echo "<a href='pay.php?id=" . $invoice['id'] . "' class='btn btn-primary'>Pay</a>";
                            } else {
                                echo "<span class='badge badge-success'>Payed</span>" ;
                            }
                            ?>
                        </td>
                        <?php
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>









    <?php include 'footer.php'; ?>