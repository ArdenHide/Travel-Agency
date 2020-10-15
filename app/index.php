<?php
session_start();

/** Добавляю все нужные функции */
include_once("functions/connect.php");
include_once("functions/login.php");
include_once("functions/register.php");

if (isset($_GET['page'])) { $page = $_GET['page']; } else { $page = "home"; }
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Travel Agency</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Icon -->
    <link rel="icon" href="img/ah-favicon.ico" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Google Fonts Roboto, Revalia -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Revalia&display=swap">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="css/mdb.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-menu.css">
</head>

<body class="" style="background-image: url(img/overlays/bg-pattern.png);">
    <header id="header">
        <?php
        include_once('pages/menu.php');
        ?>
    </header>

    <main id="main" class="mt-5">
        <?php
        if (isset($_GET['page'])) {
            if ($page == "home") include_once("pages/home.php");
            if ($page == 1) include_once("pages/tours.php");
            if ($page == 2 && isset($_SESSION['radmin'])) include_once("pages/admin.php");
            if ($page == 3 && isset($_SESSION['radmin'])) include_once("pages/private.php");
        }
        ?>
    </main>

    <!-- <footer class="fdb-block footer-large bg-dark">
        <div class="container">
            <div class="row align-items-top text-center text-md-left">
                <div class="col-12 col-sm-6 col-md-4">
                    <h3><strong>Country A</strong></h3>
                    <p>Street Address 52<br>Contact Name</p>
                    <p>+44 827 312 5002</p>
                    <p><a href="https://www.froala.com">countrya@amazing.com</a></p>
                </div>

                <div class="col-12 col-sm-6 col-md-4 mt-4 mt-sm-0">
                    <h3><strong>Country B</strong></h3>
                    <p>Street Address 100<br>Contact Name</p>
                    <p>+13 827 312 5002</p>
                    <p><a href="https://www.froala.com">countryb@amazing.com</a></p>
                </div>

                <div class="col-12 col-md-4 mt-5 mt-md-0 text-md-left">
                    <h3><strong>About Us</strong></h3>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col text-center">
                    © 2018 Froala. All Rights Reserved
                </div>
            </div>
        </div>
    </footer> -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- jQuery -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Your custom scripts (optional) -->
    <script type="text/javascript" src="js/script.js"></script>

    <script>
        $(document).ready(function() {
            $('.collapse').on('show.bs.collapse', function() {
                $(this).parent().find('.fa-chevron-down').removeClass('fa-chevron-down').addClass('fa-chevron-up');
            }).on('hidden.bs.collapse', function() {
                $(this).parent().find('.fa-chevron-up').removeClass('fa-chevron-up').addClass('fa-chevron-down');
            })

            $('.collapse').on('show.bs.collapse', function() {
                $(this).parent().find('.hamburger').removeClass('fa-bars').addClass('fa-times');
            }).on('hidden.bs.collapse', function() {
                $(this).parent().find('.hamburger').removeClass('fa-times').addClass('fa-bars');
            })

            $('.collapse').on('show.bs.collapse', function() {
                $(this).parent().find('.navbar-brand').addClass('mr-auto');
            }).on('hidden.bs.collapse', function() {
                $(this).parent().find('.navbar-brand').removeClass('mr-auto');
            })

            /** WOW */
            new WOW().init();
        });
    </script>
</body>

</html>