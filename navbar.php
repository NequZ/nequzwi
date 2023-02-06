<?php
    require_once 'config.php';
?>

<link href="/css/fontawesome.css" rel="stylesheet">
<link href="/css/brands.css" rel="stylesheet">
<link href="/css/solid.css" rel="stylesheet">
<nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Account Management</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="services.php">
                    <i class="fa-solid fa-house"></i>
                    Home
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="servicedashboard.php">
                    <i class="fa-solid fa-server"></i>

                    </i>
                    Services
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="account.php">
                    <i class="fa-solid fa-address-book"></i>

                    </i>
                    Account
                </a>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">
                    <i class="fa-solid fa-question"></i>

                    </i>
                    WIP
                </a>
            </li>
            <?php
            $smt = $db->prepare("SELECT `rank` FROM `user` WHERE username = :username");
            $smt->bindParam(':username', $_SESSION['username']);
            $smt->execute();
            $adminRank = $smt->fetchColumn();

            if(intval($adminRank) > 1): ?>
                <li class="nav-item">
                    <a class="nav-link" href="admin.php">
                        <i class="fa fa-envelope-o">

                        </i>
                        Administration
                    </a>
                </li>
            <?php endif; ?>

        </ul>
        <div class="navbar-text mx-auto">
            Welcome Back <?php echo $_SESSION['username']; ?>
        </div>
        <ul class="navbar-nav ">
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fa-solid fa-shop"></i>

                    </i>
                    Shop Page
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    </i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</nav>