<?php
if (isset($_SESSION['ruser'])) {?>

    <form class="form-inline order-4 ml-auto" method="post"
    action="index.php <?php if (isset($_GET['page'])) { echo '?page='.$_GET['page']; } ?> ">
        <i class='fas fa-2x dark-ic mr-2 fa-user'></i>
        <span class='white-text'><?php echo $_SESSION['ruser']; ?></span>
        <button type="submit" value="Logout" id="ex" name="ex" class="btn btn-outline-warning btn-sm ">
            Выход
        </button>
    </form>
    <?php
    if (isset($_POST['ex'])) {
        unset($_SESSION['ruser']);
        unset($_SESSION['radmin']);
        echo '<script>window.location.reload()</script>';
    }
} else {

    echo '<div class="btn-group ml-auto">';
    /* Авторизация */
    if (isset($_POST['btnPressLogin'])) {
        login($_POST['loginUser'], $_POST['passUser']);
    } else {?>
        <button class="btn btn-outline-warning btn-sm mr-1" data-toggle="modal" data-target="#modalLogin">
            Войти
        </button>

        <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form class="input-group input-group-sm" method="post"
                action="index.php <?php if(isset($_GET['page'])){echo '?page='.$_GET['page'];}?>">
                    <div class="modal-content">
                        <div class="modal-header mdb-color">
                            <h4 class="modal-title white-text font-weight-bold">Авторизация</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" tabindex="-1">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body mx-3">
                            <div class="md-form d-flex mb-5">
                                <i class="fas fa-user prefix warning-ic"></i>
                                <input type="text" name="loginUser" size="30" id="loginUser" class="form-control m-0 ml-5 validate">
                                <label class="ml-5" data-error="wrong" data-success="right" for="loginUser">Ваш логин</label>
                            </div>

                            <div class="md-form d-flex glyphicon-align-center mb-4">
                                <i class="fas fa-lock prefix warning-ic"></i>
                                <input type="password" name="passUser" size="30" id="passUser" class="form-control m-0 ml-5 validate">
                                <label class="ml-5" data-error="wrong" data-success="right" for="passUser">Ваш пароль</label>
                            </div>

                        </div>
                        <div class="modal-footer d-flex justify-content-end mx-3">
                            <button type="submit" class="btn btn-outline-primary rounded-pill btn-block" name="btnPressLogin">Вход</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php
    }

    /* Регистрация */
    if (isset($_POST['btnPressReg'])) {
        register($_POST['loginReg'], $_POST['pass1Reg'], $_POST['pass2Reg'], $_POST['emailReg']);
    } else {?>
        <button class="btn btn-outline-warning btn-sm ml-1" data-toggle="modal" data-target="#modalReg">
            Регистрация
        </button>
        <div class="modal fade" id="modalReg" tabindex="-1" role="dialog" aria-labelledby="modalReg" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form class="input-group input-group-sm" method="post"
                action="index.php <?php if (isset($_GET['page'])){echo '?page='.$_GET['page'];}?>">
                    <div class="modal-content">
                        <div class="modal-header mdb-color">
                            <h4 class="modal-title white-text font-weight-bold">Регистрация</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" tabindex="-1">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body flex-column align-items-center pr-5">
                            <div class="md-form">
                                <i class="fas fa-user prefix warning-ic mx-2"></i>
                                <input type="text" name="loginReg" id="loginReg" size="30" class="form-control m-0 ml-5 validate">
                                <label class="ml-5" for="loginReg" data-error="wrong" data-success="right">Ваш логин</label>
                            </div>

                            <div class="form-row">
                                <div class="col-12 col-lg-6">
                                    <div class="md-form">
                                        <i class="fas fa-lock prefix warning-ic mx-2"></i>
                                        <input type="password" name="pass1Reg" id="pass1Reg" size="30" class="form-control m-0 ml-5 validate">
                                        <label class="ml-5" for="pass1Reg" data-error="wrong" data-success="right">Ваш пароль</label>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="md-form">
                                        <i class="fas fa-lock prefix warning-ic mx-2"></i>
                                        <input type="password" name="pass2Reg" id="pass2Reg" size="30" class="form-control m-0 ml-5 validate">
                                        <label class="ml-5" for="pass2Reg" data-error="wrong" data-success="right">Подтвердите пароль</label>
                                    </div>
                                </div>
                            </div>

                            <div class="md-form">
                                <i class="fas fa-envelope prefix warning-ic mx-2"></i>
                                <input type="email" name="emailReg" id="emailReg" size="30" class="form-control m-0 ml-5 validate">
                                <label class="ml-5" for="emailReg" data-error="wrong" data-success="right">Ваш e-mail</label>
                            </div>

                            <button type="submit" class="btn btn-outline-primary rounded-pill btn-block m-0 mx-3" name="btnPressReg">Регистрация</button>

                        </div>
                        <div class="modal-footer"></div>
                    </div>
                </form>
            </div>
        </div>
    <?php
    }

    echo '
        </div>
    ';
}
