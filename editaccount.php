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
$id = $_GET['id'];
if (isset($_GET['id']) && $_GET['id'] == $_SESSION['id']) {
    $id = $_GET['id'];
} else {
    header("Location: account.php");
    exit;
}

// get data from user_informations table
$stmt = $db->prepare("SELECT * FROM user_informations WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$user = $stmt->fetch();




// check if form is submitted and update user_informations table

if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['adress']) && isset($_POST['city']) && isset($_POST['county']) && isset($_POST['zip_code'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $adress = $_POST['adress'];
    $city = $_POST['city'];
    $county = $_POST['county'];
    $zip_code = $_POST['zip_code'];
    $stmt = $db->prepare("UPDATE user_informations SET firstname = :firstname, lastname = :lastname, email = :email, adress = :adress, city = :city, county = :county, zip_code = :zip_code WHERE id = :id");
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':adress', $adress);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':county', $county);
    $stmt->bindParam(':zip_code', $zip_code);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
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

<?php
echo '<div class="container" id="container">
    <div class="form-container sign-in-container">
        <form action="" method="post">
            <h1>Edit Account</h1>
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" name="firstname" id="firstname" value="' . $user['firstname'] . '" placeholder="First Name" />
            </div>
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" name="lastname" id="lastname" value="' . $user['lastname'] . '" placeholder="Last Name" />
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" value="' . $user['email'] . '" placeholder="Email" />
            </div>
            <div class="form-group">
                <label for="zip_code">ZIP</label>
                <input type="text" class="form-control" name="zip_code" id="zip_code" value="' . $user['zip_code'] . '" placeholder="ZIP" />
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" name="city" id="city" value="' . $user['city'] . '" placeholder="City" />
            </div>
            <div class="form-group">
                <label for="adress">Address</label>
                <input type="text" class="form-control" name="adress" id="adress" value="' . $user['adress'] . '" placeholder="Address" />
            </div>
            <div class="form-group">
                <label for="county">County</label>
                <input type="text" class="form-control" name="county" id="county" value="' . $user['county'] . '" placeholder="County" />
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form> 
    </div>
</div>';
?>





