<?php
/******************************* Module Header ******************************\
 * Module Name:  index.php
 * Project:      NequZWI
 * Copyright (c) NequZ
 *
 * This file contains the index page.
 *
 * GNU GENERAL PUBLIC LICENSE
 * Version 3, 29 June 2007
 *
 * Copyright (C) 2007 Free Software Foundation, Inc. <https://fsf.org/>
 * Everyone is permitted to copy and distribute verbatim copies
 * of this license document, but changing it is not allowed.
 *
 * \***************************************************************************/
session_start();



?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Hosts</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700|Raleway:400,700&display=swap" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
</head>

<body>
<div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg custom_nav-container">
                <a class="navbar-brand" href="index.html">
                    <img src="images/logo.png" alt="" />
                    <span>
              Hosts
            </span>
                </a>

                <div class="navbar-collapse" id="">
                    <div class="custom_menu-btn">
                        <button onclick="openNav()">
                            <span class="s-1"> </span>
                            <span class="s-3"> </span>
                        </button>
                    </div>
                    <div id="myNav" class="overlay">
                        <div class="overlay-content">
                            <a href="index.php">HOME</a>
                            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)  { ?>
                            <a href="services.php">Services</a> <?php } ?>
                            <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false)  { ?>
                            <a href="login.php">LOGIN</a> <?php } ?>
                            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)  { ?>
                            <a href="logout.php">LOGOUT</a> <?php } ?>

                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class=" slider_section position-relative">
        <div class="container-fluid">
            <div class="row">
                <div class=" col-md-5 offset-md-1">
                    <div class="detail-box">
                        <h1>
                            Unlimited <br />
                            Web Hosting
                        </h1>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                            do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        </p>

                        <div class="btn-box">
                            <a href="" class="btn-1">
                                Buy now
                            </a>
                            <a href="" class="btn-2">
                                Contact us
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <div class="number_box">
                            <div>
                  <span>
                    01/
                  </span>
                            </div>
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
                                    01
                                </li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1">
                                    02
                                </li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2">
                                    03
                                </li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="3">
                                    04
                                </li>
                            </ol>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="img-box">
                                    <img src="images/slider-img.png" alt="" />
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="img-box">
                                    <img src="images/slider-img.png" alt="" />
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="img-box">
                                    <img src="images/slider-img.png" alt="" />
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="img-box">
                                    <img src="images/slider-img.png" alt="" />
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end slider section -->
</div>

<!-- feature section -->
<section class="feature_section layout_padding">
    <div class="container">
        <div class="heading_container">
            <h2>
                Our Features
            </h2>
        </div>
        <div class="feature_container layout_padding2">
            <div class="box b-1">
                <div class="img-box">
                    <img src="images/f-1.png" alt="" />
                </div>
                <div class="detail-box">
                    <h5>
                        State-of-the-Art Infrastructure
                    </h5>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                        enim
                    </p>
                </div>
            </div>
            <div class="box b-2">
                <div class="img-box">
                    <img src="images/f-2.png" alt="" />
                </div>
                <div class="detail-box">
                    <h5>
                        Professional Email Hosting
                    </h5>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                        enim
                    </p>
                </div>
            </div>
            <div class="box b-3">
                <div class="img-box">
                    <img src="images/f-3.png" alt="" />
                </div>
                <div class="detail-box">
                    <h5>
                        Advanced Programming & Databases
                    </h5>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                        enim
                    </p>
                </div>
            </div>
            <div class="box b-4">
                <div class="img-box">
                    <img src="images/f-4.png" alt="" />
                </div>
                <div class="detail-box">
                    <h5>
                        Easy-to-use cPanel
                    </h5>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                        enim
                    </p>
                </div>
            </div>
        </div>
        <div class="btn-box">
            <a href="">
                Read More
            </a>
        </div>
    </div>
</section>

<!-- end feature section -->

<!-- about section -->
<section class="about_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="img-box">
                    <img src="images/about-img.png" alt="" />
                    <div class="play_btn">
                        <a href="">
                            <img src="images/play-btn.png" alt="" />
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-box">
                    <div class="heading_container">
                        <h2>
                            About Us
                        </h2>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                        enim ad minim veniam, quis nostrud exercitation ullamco laboris
                        nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                        in reprehenderit in voluptate velit
                    </p>
                    <a href="">
                        Read More
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- end about section -->

<!-- price section -->

<section class="price_section">
    <div class="container">
        <div class="heading_container">
            <h2>
                About Us
            </h2>
        </div>
        <div class="price_container layout_padding2">
            <div class="box">
                <div class="detail-box">
                    <h2>$ <span>149</span></h2>
                    <h6>
                        Starter
                    </h6>
                    <p>
                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                        enim ad
                    </p>
                </div>
                <div class="btn-box">
                    <a href="">
                        See More Plans
                    </a>
                </div>
            </div>
            <div class="box">
                <div class="detail-box">
                    <h2>$ <span>149</span></h2>
                    <h6>
                        Hatchling
                    </h6>
                    <p>
                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                        enim ad
                    </p>
                </div>
                <div class="btn-box">
                    <a href="">
                        See More Plans
                    </a>
                </div>
            </div>
            <div class="box">
                <div class="detail-box">
                    <h2>$ <span>149</span></h2>
                    <h6>
                        Starter
                    </h6>
                    <p>
                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                        enim ad
                    </p>
                </div>
                <div class="btn-box">
                    <a href="">
                        See More Plans
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- price section -->

<!-- answer section -->
<section class="answer_section layout_padding">
    <div class="container">
        <div class="heading_container">
            <h2>
                Got a Question? We've the Answer!
            </h2>
        </div>
        <div class="answer_container layout_padding2-top">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h6 class="mb-0">
                            What is Shared Hosting?
                        </h6>
                        <div class="drop_icon">
                            <img src="images/right-angle.png" alt="" />
                        </div>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                            do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <h6 class="mb-0">
                            Is Cloud Hosting better than Shared Hosting?
                        </h6>
                        <div class="drop_icon">
                            <img src="images/right-angle.png" alt="" />
                        </div>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                            do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <h6 class="mb-0">
                            How do I choose between Linux and Windows Shared Hosting?
                        </h6>
                        <div class="drop_icon">
                            <img src="images/right-angle.png" alt="" />
                        </div>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                            do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFour" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <h6 class="mb-0">
                            How can i build my website?
                        </h6>
                        <div class="drop_icon">
                            <img src="images/right-angle.png" alt="" />
                        </div>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                            do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- end answer section -->

<!-- client section -->
<section class="client_section layout_padding-bottom">
    <div class="container">
        <div class="heading_container">
            <h2>
                Testimonial
            </h2>
        </div>
    </div>

    <div class="container">
        <div class="client_container layout_padding2">
            <div class="client_box b-1">
                <div class="client-id">
                    <div class="img-box">
                        <img src="images/client1.png" alt="" />
                    </div>
                    <div class="name">
                        <h5>
                            Magna
                        </h5>
                        <p>
                            Consectetur adipiscing
                        </p>
                    </div>
                </div>
                <div class="detail">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrudLorem ipsum
                    </p>
                    <div>
                        <div class="arrow_img">
                        </div>
                    </div>
                </div>
            </div>
            <div class="client_box b-2">
                <div class="client-id">
                    <div class="img-box">
                        <img src="images/client2.png" alt="" />
                    </div>
                    <div class="name">
                        <h5>
                            Aliqua
                        </h5>
                        <p>
                            Consectetur adipiscing
                        </p>

                    </div>
                </div>
                <div class="detail">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrudLorem ipsum
                    </p>
                    <div>
                        <div class="arrow_img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- end client section -->

<!-- support section -->

<section class="support_section layout_padding-bottom">
    <div class="container">
        <div class="box">
            <div class="img-box">
                <img src="images/support-img.png" alt="">
            </div>
            <div class="detail-box">
                <h2>
                    24/7 Award Winning Support
                </h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                </p>
            </div>
        </div>
    </div>
</section>


<!-- end support section -->

<!-- info section -->
<section class="info_section ">
    <div class="container">
        <div class="info_contact" id="contact">
            <a href="" class="link-1">
                <img src="images/location.png" alt="">
                <span>
            Loram Ipusm hosting web
          </span>
            </a>
            <a href="" class="link-1">
                <img src="images/phone.png" alt="">
                <span>
            +123456789
          </span>
            </a>
            <a href="" class="link-1">
                <img src="images/mail.png" alt="">
                <span>
            demo@gmail.com
          </span>
            </a>
        </div>
    </div>
    <div class="container">
        <div class="info_container">
            <div class="row">
                <div class="col-md-3 col-lg-2">
                    <h6>
                        Useful link
                    </h6>
                    <ul>
                        <li>
                            <a href="index.php">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="about.php">
                                About
                            </a>
                        </li>
                        <li>
                            <a href="feature.php">
                                Features
                            </a>
                        </li>
                        <li>
                            <a href="#contact">
                                Contact Us
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9 col-lg-6">
                    <h6>
                        PRODUCT
                    </h6>
                    <div class="link_box">
                        <ul>
                            <li>
                                <a href="">
                                    Webhosting
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    Wordpress Hosting
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="">
                                    Reseler Hosting
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    Dedicated hosting
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="">
                                    VPS Hosting
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    Windows
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <h6>
                        Newsletter
                    </h6>
                    <form action="">
                        <input type="email" placeholder="Enter you email">
                        <button>
                            Subscribe
                        </button>
                    </form>
                    <div class="social-box">
                        <a href="">
                            <img src="images/fb.png" alt="">
                        </a>
                        <a href="">
                            <img src="images/twitter.png" alt="">
                        </a>
                        <a href="">
                            <img src="images/linkedin.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- end info section -->

<?php include 'footer.php'; ?>

<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>

<script>
    function openNav() {
        document.getElementById("myNav").classList.toggle("menu_width");
        document
            .querySelector(".custom_menu-btn")
            .classList.toggle("menu_btn-style");
    }
</script>

</body>

</html>
