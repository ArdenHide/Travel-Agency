<div class="container elegant-color-dark shadow-lg rounded-lg my-5 p-5">
    <div class="row d-flex justify-content-center">
        <div class="col-12 elegant-color rounded p-4 mb-4">

            <div class="d-flex align-items-center justify-content-between">
                <span class="h2-responsive white-text font-weight-light">Добавить администратора</span>
                <i class="fas fa-user-plus fa-2x warning-ic"></i>
            </div>
            <hr class="hr-light">

            <?php
            $mysqli = connect();
            $sel = 'select * from users where roleid = 2 order by login';
            $res = $mysqli->query($sel);
            ?>
            <form action="index.php?page=3" method="post" enctype="multipart/form-data">
                <div class="form-row align-items-end">

                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-4">
                        <div class="form-group m-0">
                            <label class="white-text">Выберите пользователя из списка</label>
                            <?php
                            echo '<select name="userid" class="browser-default custom-select">';
                            echo '<option selected>Пользователи...</option>';
                            while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                                echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                            }
                            mysqli_free_result($res);
                            echo '</select>';
                            ?>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-4">
                        <div class="input-group align-items-center">
                            <div class="custom-file overflow-hidden">
                                <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                                <input type="file" class="custom-file-input" name="file" accept="img/*" required>
                                <label class="custom-file-label">Выберите фото...</label>
                            </div>
                            <div class="input-group-append">
                                <button type="submit" name="addadmin" class="btn btn-md btn-block btn-outline-primary m-0">Добавить</button>
                            </div>
                        </div>
                    </div>

                </div>

            </form>
        </div>
        <!-- Добавить администратора -->
        <?php
        if (isset($_POST['addadmin'])) {
            $userid = $_POST['userid'];
            $fn = $_FILES['file']['tmp_name'];
            $file = fopen($fn, 'rb');
            $img = fread($file, filesize($fn));
            fclose($file);
            $img = addslashes($img);
            $upd = 'update users set avatar="' . $img . '", roleid=1 where id =' . $userid;
            $mysqli->query($upd);
            if ($mysqli->errno) {
                /* Ошибка добавления администратора errorAddAdmin */
                include_once("pages/modals/errorAddAdmin.html");
            }

            /* Успешное добавление администратора successAddAdmin */
            include_once("pages/modals/successAddAdmin.html");
        }
        ?>

        <div class="col-12 elegant-color rounded p-4 mb-4">

            <div class="d-flex align-items-center justify-content-between">
                <span class="h2-responsive white-text font-weight-light">Удалить администратора</span>
                <i class="fas fa-user-minus fa-2x warning-ic"></i>
            </div>
            <hr class="hr-light">

            <?php
            $mysqli = connect();
            $sel = 'select * from users where roleid = 1 order by login';
            $res = $mysqli->query($sel);
            ?>
            <form action="index.php?page=3" method="post" enctype="multipart/form-data">
                <div class="form-row align-items-end">

                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 mb-4">
                        <div class="form-group m-0">
                            <label class="white-text">Выберите администратора из списка</label>
                            <?php
                            echo '<select name="adminid" class="browser-default custom-select">';
                            echo '<option selected>Администраторы...</option>';
                            while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                                echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                            }
                            mysqli_free_result($res);
                            echo '</select>';
                            ?>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 mb-4">
                        <button type="submit" name="deladmin" class="btn btn-md btn-block btn-outline-primary m-0">Удалить</button>
                    </div>

                </div>
            </form>
        </div>
        <!-- Удалить администратора -->
        <?php
        if (isset($_POST['deladmin'])) {
            $adminid = $_POST['adminid'];
            $upd = 'update users set roleid=2 where id =' . $adminid;
            $mysqli->query($upd);
            if ($mysqli->errno) {
                /* Ошибка удаления администратора errorDelAdmin */
                include_once("pages/modals/errorDelAdmin.html");
            }

            /* Успешное удаление администратора successDelAdmin */
            include_once("pages/modals/successDelAdmin.html");
            mysqli_free_result($res);
        }
        ?>

        <div class="col-12 elegant-color rounded p-4 mb-4">

            <div class="d-flex align-items-center justify-content-between">
                <span class="h2-responsive white-text font-weight-light">Список администраторов</span>
                <i class="fas fa-users fa-2x warning-ic"></i>
            </div>
            <hr class="hr-light">

            <?php
            $sel = 'select * from users where roleid = 1 order by login';
            $res = $mysqli->query($sel);
            ?>

            <div class="table-responsive">
                <table class="table table-light table-striped">
                    <thead class="mdb-color white-text">
                        <tr class="p-0">
                            <th scope="col">#</th>
                            <th scope="col">Логин</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Фото</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                            echo '<tr>';
                            echo '<td>' . $row[0] . '</td>';
                            echo '<td>' . $row[1] . '</td>';
                            echo '<td>' . $row[3] . '</td>';
                            $img = base64_encode($row[5]);
                            echo '<td><img width="25px" height="25px" src="data:img/jpeg; base64,' . $img . '"/></td>';
                            echo '</tr>';
                        }
                        mysqli_free_result($res);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>