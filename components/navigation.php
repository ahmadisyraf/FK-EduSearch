<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FK-EduSearch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

    <?php session_start(); ?>


    <?php
    $current = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
    $class = "";

    if ($current == "home.php") {
        $class = "nav-link active";
    } else if ($current == "inbox.php") {
        $class = "nav-link active";
    } else {
        $class = "nav-link";
    }

    if ($_SESSION['logged_out'] == true && basename($_SERVER['PHP_SELF']) !== 'index.php') {
        header('Location: index.php');
        exit(); // Ensure that the script stops executing after the redirect
    } elseif ($_SESSION['logged_out'] == false && basename($_SERVER['PHP_SELF']) === 'index.php') {
        header('Location: home.php');
        exit(); // Ensure that the script stops executing after the redirect
    }
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-3 px-2 fixed-top z-3" style="height: 80px">
        <form class="container-fluid" action="" method="post">

            <?php
            //error_reporting(0);

            echo $_SESSION['logged_out'] ? NULL : '            
            <a class="btn btn-outline-secondary me-3" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
            aria-controls="offcanvasExample">
                <!-- Link with href -->
                <span class="navbar-toggler-icon"></span>
            </a>'
            ?>


            <a class="navbar-brand" href="home.php"><b>FK-EduSearch</b></a>

            <?php

            //$_SESSION["logged_out"];

            if ($_SESSION["logged_out"]) {
                echo '
                <button type="button" class="btn btn-light">
                    Helpdesk
                </button>  
                ';
            } else {
                echo '

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto"> <!-- Added ms-auto class -->
                    '.(($_SESSION['role'] == "admin")? "" : 
                    '<li class="nav-item">
                        <a class="nav-link '.(($current == "home.php")? "active" : "").'" aria-current="page" href="home.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="' . (($current == "inbox.php") ? "nav-link active" : "nav-link") . '" href="inbox.php">Inbox</a>
                    </li>
                    '.(($_SESSION['role'] == "user")? 
                    '<li class="nav-item">
                        <a class="' . (($current == "userProfile.php") ? "nav-link active" : "nav-link") . '" href="userProfile.php">Profile</a>
                    </li>' : '').'

                    ' . (($_SESSION['role'] == "expert") ? '<li class="nav-item"><a class="' . (($current == "experteditprofile.php") ? "nav-link active" : "nav-link") . '" href="experteditprofile.php">Profile</a></li>' : '') . '
                    '
                    ).'
                        <div class="nav-item">
                            <button class="nav-link" type="submit" name="logout">Logout</button>
                        </div>
                    </ul>
                </div>
                ';

                // include "config/autoload.php";

                if (isset($_POST['logout'])) {

                    $userdata = json_decode($_COOKIE['user_data'], true);
                    $uid = $userdata['uid'];

                    if ($_SESSION['role'] == "expert") {
                        $expert = new ExpertController();
                        $expert->updateExpertOnlineStatusController($uid, "Offline");
                    } else if ($_SESSION["role"] == 'user') {
                        $user = new UserController();
                        $user->updateUserOnlineStatusController($uid, "Offline");
                    }

                    $_SESSION['logged_out'] = true;
                    setcookie("user_data", "", time() - 3600);

                    // session_destroy();
            
                    header("Location: index.php");
                }
            }

            ?>
        </form>
    </nav>
    <?php include "sidebar.php" ?>

</body>

</html>