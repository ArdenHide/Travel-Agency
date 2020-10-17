<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    session_start();
    /** Добавляю все нужные функции */
    include_once("functions/connect.php");
    // include_once("functions/login.php");
    // include_once("functions/register.php");

    if (isset($_GET['hotel'])) {
        $hotel = $_GET['hotel'];
        $mysqli = connect();
        $sel = 'select * from hotels where id=' . $hotel;
        $res = $mysqli->query($sel);
        $row = mysqli_fetch_array($res, MYSQLI_NUM);
        $hname = $row[1];
        $hstars = $row[4];
        $hcost = $row[5];
        $hinfo = $row[7];
        mysqli_free_result($res);
    }
    ?>
    <meta charset="UTF-8">
    <title>Отель - <?php echo "$hname"; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- MDB icon -->
    <!-- <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="../css/mdb.min.css">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="../css/style-hotelinfo.css">
    <style>
        .pointer:hover {
            cursor: pointer !important;
        }
    </style>
</head>

<body id="body" class='elegant-color'>

    <div class="container elegant-color-dark shadow-lg rounded-lg my-5 p-5">
        <div class="row justify-content-center">
            <p class='h1-responsive white-text'>Отель - <?php echo $hname; ?></p>
        </div>
        <div class="row justify-content-center mb-3">
            <?php
            for ($i = 0; $i < $hstars; $i++) {
                echo "<i class='fas warning-ic fa-star'></i>";
            }
            ?>
        </div>
        <hr class='hr-light'>

        <div class="row elegant-color justify-content-center rounded flex-lg-wrap-reverse mb-4">
            <div class="col-12 col-md-10 my-4">
                <p class='text-center lead white-text'><?php echo $hinfo; ?></p>
            </div>
            <div class="col-12 mb-4">
                <div id='carousel' class='carousel slide carousel-fade mt-5' data-ride='carousel'>
                    <?php
                    if (isset($_GET['hotel'])) {
                        echo "<ol class='carousel-indicators'>";
                        $mysqli = connect();
                        $sel = 'select * from images where hotelid=' . $hotel;
                        $res = $mysqli->query($sel);

                        $indicator = 0;
                        while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                            echo "<li class='bg-dark' data-target='#carousel' data-slide-to='$indicator'></li>";
                            $indicator++;
                        }
                        mysqli_free_result($res);
                        echo "</ol>";

                        echo " <div class='carousel-inner' role='listbox'>";
                        $mysqli = connect();
                        $sel = 'select * from images where hotelid=' . $hotel;
                        $res = $mysqli->query($sel);
                        $active = true;
                        while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                            if ($active == true) { ?>
                                <div class='carousel-item d-flex justify-content-center active' data-toggle='modal' data-target='#modal-img-<?php echo "$row[0]" ?>'>
                                    <div class='view pointer'>
                                        <div class='row d-flex justify-content-center'>
                                            <div class='col-12'>
                                                <img class='img-fluid' src='../<?php echo "$row[1]" ?>' alt='slide'>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class='modal modal-static cascading-modal fade' id='modal-img-<?php echo "$row[0]" ?>' tabindex='-1' role='dialog' aria-hidden='true'>
                                    <div class='modal-dialog modal-fluid' role='document'>
                                        <div class='modal-content'>
                                            <div class='modal-header mdb-color'>
                                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                    <i class="fas fa-times mx-3"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body p-0">
                                                <img class='d-block w-100' src='../<?php echo "$row[1]" ?>'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                $active = false;
                            } else { ?>
                                <div class='carousel-item d-flex justify-content-center' data-toggle='modal' data-target='#modal-img-<?php echo "$row[0]" ?>'>
                                    <div class='view pointer'>
                                        <div class='row d-flex justify-content-center'>
                                            <div class='col-12'>
                                                <img class='img-fluid' src='../<?php echo "$row[1]" ?>' alt='slide'>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class='modal modal-static cascading-modal fade' id='modal-img-<?php echo "$row[0]" ?>' tabindex='-1' role='dialog' aria-hidden='true'>
                                    <div class='modal-dialog modal-fluid' role='document'>
                                        <div class='modal-content'>
                                            <div class='modal-header mdb-color'>
                                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                    <i class="fas fa-times mx-3"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body p-0">
                                                <img class='d-block w-100' src='../<?php echo "$row[1]" ?>'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                        echo "
                        <a class='carousel-control-prev d-none d-lg-flex grey' href='#carousel' role='button' data-slide='prev'>
                            <i class='fas fa-chevron-circle-left fa-2x' aria-hidden='true'></i>
                        </a>
                        <a class='carousel-control-next d-none d-lg-flex grey' href='#carousel' role='button' data-slide='next'>
                            <i class='fas fa-chevron-circle-right fa-2x' aria-hidden='true'></i>
                        </a>
                        </div>";
                    }
                    mysqli_free_result($res);
                    ?>
                </div>
            </div>
        </div>

        <div id="request" class="row elegant-color flex-wrap justify-content-center rounded mb-4">

            <div class="col-12 col-lg-6 text-center mt-auto mb-auto py-4">
                <i class="fas fa-money-check-alt fa-10x green-ic"></i>
                <p class="white-text lead">Цена отеля: <?php echo $hcost; ?><i class='fas green-ic fa-dollar-sign pl-1'></i></p>
            </div>
            
            <div class="col-12 col-lg-6 py-4">
                <p class="h2-responsive white-text text-center mb-3">Оставить заявку</p>
                <form>

                    <div class="md-form mt-auto mb-auto ">
                        <i class="fas fa-envelope prefix warning-ic"></i>
                        <input id="requestEmail" type="email" class="form-control white-text mb-4">
                        <label class="white-text" for="requestEmail" data-error="wrong" data-success="right">Ваш e-mail.</label>
                    </div>

                    <div class="md-form mt-auto mb-auto ">
                        <i class="fas fa-phone-alt prefix warning-ic"></i>
                        <input id="requestPhone" type="email" class="form-control white-text mb-4">
                        <label class="white-text" for="requestPhone" data-error="wrong" data-success="right">Ваш телефон.</label>
                    </div>

                    <div class="md-form mt-auto mb-auto ">
                        <i class="fas fa-user prefix warning-ic"></i>
                        <input id="requestName" type="email" class="form-control white-text mb-4">
                        <label class="white-text" for="requestName" data-error="wrong" data-success="right">Ваше имя.</label>
                    </div>

                    <div class="md-form mt-auto mb-auto ">
                        <i class="fas fa-pencil-alt prefix warning-ic"></i>
                        <textarea id="requestMsg" class="md-textarea form-control white-text mb-4" rows="3"></textarea>
                        <label class="white-text" for="requestMsg">Оставьте свое сообщение.</label>
                    </div>

                    <div class="form-row">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-md btn-outline-primary">Отправить</button>
                        </div>
                    </div>

                </form>
            </div>

        </div>

        <?php if (isset($_SESSION['radmin']) || isset($_SESSION['ruser'])) {?>
            <div class="row elegant-color justify-content-center rounded p-4 mb-4">

                <div class="col-12 col-lg-8 mb-4">
                    <p class="h2-responsive white-text text-center">Оставить комментарий</p>

                    <form  method="POST" class="d-flex flex-column justify-content-center">

                        <div class="form-group mb-4">
                            <label class="white-text label">Оставьте комментарий</label>
                            <textarea name="commentMsg" class="form-control" rows="6" placeholder="Комментарий..."></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label class="white-text label">Введите ваше имя</label>
                            <input name="commentName" type="text" id="defaultContactFormName" class="form-control mb-4" placeholder="Имя...">
                        </div>

                        <div class="text-center">
                            <button name='newComment' class="btn btn-outline-primary btn-md m-0" type="submit">Отправить комментарий</button>
                        </div>

                    </form>

                    <?php
                    if (isset($_POST['newComment'])) {
                        $commentMsg = htmlspecialchars($_POST['commentMsg']);
                        $commentName = trim(htmlspecialchars($_POST['commentName']));

                        if ($commentName != "" && $commentMsg != "") {
                            $commentPuttime = date('Y.m.d') . ' в ' . date('H:i:s');

                            if (isset($_SESSION['ruser'])) {
                                $commentLogin = $_SESSION['ruser'];
                            }
                            if (isset($_SESSION['radmin'])) {
                                $commentLogin = $_SESSION['radmin'];
                            }

                            $mysqli = connect();
                            $sel = "select * from users where login='$commentLogin'";
                            $res = $mysqli->query($sel);
                            while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                                $commentLoginId = $row[0];
                            }
                            mysqli_free_result($res);
                            
                            $ins = "insert into comments (hotel_id, name, puttime, msg, user_id) values('$hotel', '$commentName', '$commentPuttime', '$commentMsg', '$commentLoginId')";
                            $mysqli->query($ins);
                            if ($mysqli->errno) {
                                /* Ошибка добавления комментария errorAddComment */
                                include_once("../pages/modals/errorAddComment.html");
                            }

                            /* Успешное добавление комментария successAddComment */
                            include_once("../pages/modals/successAddComment.html");
                        } else {
                            /* Ошибка добавления комментария errorAddCommentNotValue */
                            include_once("../pages/modals/errorAddCommentNotValue.html");
                        }
                    }
                    ?>
                </div>

                <div class="col-12">
                    <p class="h3-responsive white-text text-center">Комментарии</p>
                    <hr class="hr-light mb-4">

                    <?php
                    $mysqli = connect();
                    $sel = "select com.*, us.login, us.id
                    from comments com, users us
                    where com.hotel_id=$hotel and com.user_id=us.id";
                    $res = $mysqli->query($sel);
                    
                    while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                        if ($row[5] == 'hide' && !isset($_SESSION['radmin'])) {
                            continue;
                        } else {
                        ?>
                        <div class="card bg-transparent border-white mb-4">
                            <div class="card-header d-flex justify-content-between flex-wrap-reverse border-white pb-1">
                                <div class="mr-auto mt-auto">
                                    <span class="d-block h6-responsive white-text"><?php echo $row[2]?></span>
                                    <span class="d-block small white-text">Оставил комментарий<i class="fas fa-comment-alt ml-1"></i></span>
                                </div>
                                <?php
                                if (isset($_SESSION['radmin'])) {
                                    $commentLogin = $_SESSION['radmin'];?>

                                <div class='ml-auto'>

                                    <!-- Показывать комментарий -->
                                    <?php
                                    if ($row[5] == 'show') {
                                    } else {
                                        echo "
                                        <a data-toggle='modal' data-target='#modalShowComment-$row[0]' data-toggle='tooltip' data-placement='bottom'
                                        title='Вы можете показывать этот комментарий.'>
                                            <i class='far fa-eye success-ic lead'></i>
                                        </a>
                                        <div class='modal fade' data-backdrop='static' id='modalShowComment-$row[0]' tabindex='-1' role='dialog' aria-hidden='true'>
                                            <div class='modal-dialog modal-frame modal-top' role='document'>
                                                <form method='POST'>
                                                    <div class='modal-content text-center'>
                                                        <div class='modal-header d-flex align-items-center'>
                                                            
                                                            <p class='h3 modal-title'>Показывать комментарий</p>
                                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                                <i class='fas fa-times'></i>
                                                            </button>
                                                        </div>
                                                        <div class='modal-body'>
                                                            <p class='lead'>Вы действительно хотите снова показывать этот комментарий?</p>
                                                            <button type='button' class='btn btn-md btn-default' data-dismiss='modal'>Отменить</button>
                                                            <button name='btnShow-$row[0]' type='submit' class='btn btn-md btn-danger'>Отображать</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        ";
                                        if (isset($_POST['btnShow-'.$row[0]])) {
                                            $updShow = "UPDATE comments SET hide = 'show' WHERE id_msg = $row[0]";
                                            $mysqli->query($updShow);
                                            if ($mysqli->errno) {
                                                /* Ошибка удаления страны errorDelCountry */
                                                include_once("../pages/modals/errorDelCountry.html");
                                            }
                                            echo "
                                            <script>
                                                window.location = document.URL;
                                            </script>
                                            ";
                                        }
                                    }
                                    ?>

                                    <!-- Скрыть комментарий -->
                                    <?php
                                    if ($row[5] == 'hide') {
                                    } else {
                                        echo "
                                        <a data-toggle='modal' data-target='#modalHideComment-$row[0]' data-toggle='tooltip' data-placement='bottom'
                                        title='Вы можете скрыть этот комментарий.'>
                                            <i class='far fa-eye-slash warning-ic lead'></i>
                                        </a>
                                        <div class='modal fade' data-backdrop='static' id='modalHideComment-$row[0]' tabindex='-1' role='dialog' aria-hidden='true'>
                                            <div class='modal-dialog modal-frame modal-top' role='document'>
                                                <form method='POST'>
                                                    <div class='modal-content text-center'>
                                                        <div class='modal-header d-flex align-items-center'>
                                                            <p class='h3 modal-title'>Скрыть комментарий</p>
                                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                                <i class='fas fa-times'></i>
                                                            </button>
                                                        </div>
                                                        <div class='modal-body'>
                                                            <p class='lead'>Вы действительно хотите скрыть этот комментарий?</p>
                                                            <button type='button' class='btn btn-md btn-default' data-dismiss='modal'>Отменить</button>
                                                            <button name='btnHide-$row[0]' type='submit' class='btn btn-md btn-danger'>Скрыть</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        ";
                                        if (isset($_POST['btnHide-'.$row[0]])) {
                                            $updHide = "UPDATE comments SET hide = 'hide' WHERE id_msg = $row[0]";
                                            $mysqli->query($updHide);
                                            if ($mysqli->errno) {
                                                /* Ошибка удаления страны errorDelCountry */
                                                include_once("../pages/modals/errorDelCountry.html");
                                            }
                                            echo "
                                            <script>
                                                window.location = document.URL;
                                            </script>
                                            ";
                                        }
                                    }
                                    ?>

                                    <!-- Удалить комментарий -->
                                    <?php
                                    echo "
                                    <a data-toggle='modal' data-target='#modalDelComment-$row[0]' data-toggle='tooltip' data-placement='bottom'
                                    title='Вы можете удалить этот комментарий.'>
                                        <i class='far fa-times-circle danger-ic lead ml-2'></i>
                                    </a>
                                    <div class='modal fade' data-backdrop='static' id='modalDelComment-$row[0]' tabindex='-1' role='dialog' aria-hidden='true'>
                                        <div class='modal-dialog modal-frame modal-top' role='document'>
                                            <form method='POST'>
                                                <div class='modal-content text-center'>
                                                    <div class='modal-header d-flex align-items-center'>
                                                        <p class='h3 modal-title'>Удалить комментарий</p>
                                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                            <i class='fas fa-times'></i>
                                                        </button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <p class='lead'>Вы действительно хотите удалить этот комментарий?</p>
                                                        <button type='button' class='btn btn-md btn-default' data-dismiss='modal'>Отменить</button>
                                                        <button name='btnDel-$row[0]' type='submit' class='btn btn-md btn-danger'>Удалить</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    ";

                                    if (isset($_POST['btnDel-'.$row[0]])) {
                                        $del = 'delete from comments where id_msg=' . $row[0];
                                        $mysqli->query($del);
                                        if ($mysqli->errno) {
                                            /* Ошибка удаления страны errorDelCountry */
                                            include_once("pages/modals/errorDelCountry.html");
                                        }
                                        echo "
                                        <script>
                                            window.location = document.URL;
                                        </script>
                                        ";
                                    }
                                    ?>

                                </div>

                                <?php
                                }
                                ?>
                            </div>
                            <div class="card-body">
                                <span class="white-text"><?php echo $row[4]?></span>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-end border-white py-1">
                                <span class="small text-default">Отправленно: <?php echo $row[3]?> <i class="fas fa-clock"></i></span>
                                <span class="small white-text"><?php echo $row[7]?><i class="fas fa-user warning-ic ml-2"></i></span>
                            </div>
                        </div>

                        <?php
                        }
                    }?>

                </div>

            </div>
        <?php
        } else {
            echo "<p class='h4-responsive text-center white-text'>Для возможности оставлять и просматривать комментарии войдите в свой аккаунт или зарегестрируйтесь.</p>";
        }?>

        <div class="row d-flex align-items-start justify-content-center px-3 mb-4">

            <div class="col-12 col-lg my-4 mx-2">
                <p class="text-center white-text font-italic h4-responsive">Наши телефоны:</p>
                <hr class="hr-light">
                <p class="text-center white-text text-nowrap m-0"><i class="fas fa-phone warning-ic"></i> +380 68 123 752</p>
                <p class="text-center white-text text-nowrap m-0"><i class="fas fa-phone warning-ic"></i> +380 66 321 257</p>
            </div>

            <div class="col-12 col-lg my-4 mx-2">
                <p class="text-center white-text font-italic h4-responsive">Где мы находимся:</p>
                <hr class="hr-light">
                <p class="text-center white-text text-nowrap m-0"><i class="fas fa-map-marked warning-ic"></i> г. Одесса улица Гоголя 9</p>
            </div>

            <div class="col-12 col-lg my-4 mx-2">
                <p class="text-center white-text font-italic h4-responsive">Наша почта:</p>
                <hr class="hr-light">
                <p class="text-center white-text text-nowrap m-0"><i class="fas fa-envelope warning-ic"></i> support@website.com</p>
                <p class="text-center white-text text-nowrap m-0"><i class="fas fa-envelope warning-ic"></i> support_24@website.com</p>
            </div>

            <div class="col-12 mb-4 text-center">
                <a href="#request" class="mx-2">
                    <i class="fab mdb-color-ic fa-facebook fa-2x"></i>
                </a>
                <a href="#request" class="mx-2">
                    <i class="fab mdb-color-ic fa-twitter fa-2x"></i>
                </a>
                <a href="#request" class="mx-2">
                    <i class="fab mdb-color-ic fa-instagram fa-2x"></i>
                </a>
                <a href="#request" class="mx-2">
                    <i class="fab mdb-color-ic fa-google fa-2x"></i>
                </a>
                <a href="#request" class="mx-2">
                    <i class="fab mdb-color-ic fa-pinterest fa-2x"></i>
                </a>
            </div>

        </div>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- jQuery -->
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>
    <!-- Your custom scripts (optional) -->
    <script type="text/javascript" src="../js/script.js"></script>

    <script>
        /** Инициализация подсказок */
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({ })
        })
    </script>
</body>

</html>