<?php
include_once("./functions/addCountry.php");
include_once("./functions/delCountry.php");

include_once("./functions/addCity.php");
include_once("./functions/delCity.php");

include_once("./functions/addHotel.php");
include_once("./functions/delHotel.php");
?>

<div class="container elegant-color-dark shadow-lg rounded-lg my-5 p-5">
    <div class="row justify-content-center">

        <!--   Редактировать страны    -->
        <div class="col-12 elegant-color rounded-lg p-4 mx-2 mb-4">
            <?php
            $mysqli = connect();
            $sel = 'select * from countries order by id';
            $res = $mysqli->query($sel);
            ?>

            <div class="d-flex align-items-center justify-content-between">
                <span class="h2-responsive white-text font-weight-light">Редактировать страны</span>
                <i class="fas fa-flag fa-2x warning-ic"></i>
            </div>
            <hr class="hr-light">

            <form action="index.php?page=2" method="post">
                <div class="table-responsive">
                    <table class="table table-sm table-light table-striped m-0">
                        <thead class="mdb-color white-text">
                            <tr class="p-0">
                                <th class="text-nowrap px-2" scope="col">#</th>
                                <th class="text-nowrap px-2" scope="col">Название страны</th>
                                <th class="text-nowrap text-right px-3" scope="col">Удалить страну</th>
                            </tr>
                        </thead>
                        <tbody class="flex-column align-items-center justify-content-center">
                            <?php
                            while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                                echo '<tr>';
                                echo "<td class='text-nowrap px-2'>$row[0]</td>";
                                echo "<td class='text-nowrap px-2'>$row[1]</td>";
                                echo "<td class='text-nowrap d-flex align-items-center justify-content-end'><i class='fas fa-trash-alt'></i><input type='checkbox' name='countryCheckBox-$row[0]' class='checkbox mx-3'></td>";
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex flex-column mt-2 mb-3">
                    <p class="text-success font-weight-light">Вы можете отмечать несколько стран и удалить их все сразу.</p>
                    <small class="text-default font-weight-light">Удалив страну вы удалите его из сайта, но не файлы с сервера!</small>
                </div>
                <button type="submit" name="delcountrySelect" class="btn btn-sm btn-danger m-0">Удалить выбранные<i class="fas fa-trash-alt pl-2"></i></button>
            </form>

            <form action="index.php?page=2" method="post" enctype="multipart/form-data">
                <div class="form-row align-items-end mt-4">

                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-3">
                        <div class="form-group m-0">
                            <label class="white-text">Название страны</label>
                            <input type="text" name="country" class="form-control" placeholder="Название...">
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-3">
                        <label class="white-text">Выберите фото страны</label>
                        <div class="custom-file m-0">
                            <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                            <input type="file" class="custom-file-input" name="filecountry" required>
                            <label class="custom-file-label text-nowrap">Фото...</label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
                        <div class="form-group m-0">
                            <label class="white-text">Описание страны</label>
                            <textarea name="countryinfo" class="form-control" rows="3" placeholder="Описание..."></textarea>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end">
                        <button type="submit" name="addcountry" class="btn btn-md btn-outline-primary m-0">Добавить</button>
                    </div>
                </div>
            </form>
            <?php
            mysqli_free_result($res);

            /* Добавить страну */
            if (isset($_POST['addcountry'])) {
                if ($_FILES['filecountry']['error'][$k] != 0) {
                    /* Ошибка добавления страны errorAddCountry */
                    include_once("pages/modals/errorAddCountry.html");
                } else {
                    addCountry(
                        trim(htmlspecialchars($_POST['country'])),          /* название страны */
                        trim(htmlspecialchars($_POST['countryinfo'])),      /* описание страны */
                        '../flags/' . $_FILES['filecountry']['name']        /* путь к флагу страны */
                    );
                }
            }
            /* Удалить выбранные страны */
            if (isset($_POST['delcountrySelect'])) {
                delCountry();
            }
            ?>

        </div>

        <!--   Редактировать города   -->
        <div class="col-12 elegant-color rounded-lg p-4 mx-2 mb-4">
            <?php
            $mysqli = connect();
            $sel = 'SELECT ci.id, ci.city, co.country from countries co, cities ci WHERE ci.countryid=co.id order by id';
            $res = $mysqli->query($sel);
            ?>

            <div class="d-flex align-items-center justify-content-between">
                <span class="h2-responsive white-text font-weight-light">Редактировать города</span>
                <i class="fas fa-city fa-2x warning-ic"></i>
            </div>

            <hr class="hr-light">

            <form action="index.php?page=2" method="post">

                <div class="table-responsive">
                    <table class="table table-sm table-light table-striped m-0">
                        <thead class="mdb-color white-text">
                            <tr class="p-0">
                                <th class="text-nowrap px-2" scope="col">#</th>
                                <th class="text-nowrap px-2" scope="col">Название города</th>
                                <th class="text-nowrap px-2" scope="col">Название страны</th>
                                <th class="text-nowrap text-right px-3" scope="col">Удалить страну</th>
                            </tr>
                        </thead>
                        <tbody class="flex-column align-items-center justify-content-center">
                            <?php
                            while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                                echo '<tr>';
                                echo "<td class='text-nowrap px-2'>$row[0]</td>";
                                echo "<td class='text-nowrap px-2'>$row[1]</td>";
                                echo "<td class='text-nowrap px-2'>$row[2]</td>";
                                echo "<td class='text-nowrap d-flex align-items-center justify-content-end'><i class='fas fa-trash-alt'></i><input type='checkbox' name='cityCheckBox-$row[0]' class='checkbox mx-3'></td>";
                                echo '</tr>';
                            }
                            mysqli_free_result($res);
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex flex-column mt-2 mb-3">
                    <p class="text-success font-weight-light">Вы можете отмечать несколько городов и удалить их все сразу.</p>
                    <small class="text-default font-weight-light">Удалив город вы удалите его из сайта, но не файлы с сервера!</small>
                </div>
                <button type="submit" name="delcity" class="btn btn-sm btn-danger m-0">Удалить выбранные<i class="fas fa-trash-alt pl-2"></i></button>
            </form>

            <form action="index.php?page=2" method="post">
                <div class="form-row align-items-end w-100 m-0 mt-4">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4">
                        <div class="form-group m-0">
                            <label class="white-text">Название страны</label>
                            <?php
                            $res = $mysqli->query('select * from countries order by id');
                            echo '<select name="countryid" class="browser-default custom-select">';
                            echo '<option selected>Страна...</option>';
                            while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                                echo "<option value='$row[0]'>$row[1]</option>";
                            }
                            echo '</select>';
                            ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4">
                        <label class="white-text">Название города</label>
                        <input type="text" name="city" class="form-control" placeholder="Город...">
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
                        <div class="form-group m-0">
                            <label class="white-text">Описание города</label>
                            <textarea name="cityinfo" class="form-control" rows="3" placeholder="Описание..."></textarea>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end">
                        <button type="submit" name="addcity" class="btn btn-md btn-outline-primary m-0">Добавить</button>
                    </div>
                </div>
            </form>

            <?php
            /* Добавить город */
            if (isset($_POST['addcity'])) {
                addCity(
                    trim(htmlspecialchars($_POST['city'])),     /* название города */
                    htmlspecialchars($_POST['cityinfo']),       /* описание города */
                    htmlspecialchars($_POST['countryid'])       /* id страны */
                );
            }

            /* Удалить город */
            if (isset($_POST['delcity'])) {
                delCity();
            }
            ?>
        </div>

    </div>

    <div class="row justify-content-center">

        <!--   Редактировать отели   -->
        <div class="col-12 elegant-color rounded-lg p-4 mx-2 mb-4">
            <?php
            $sel = 'SELECT ci.city,ho.id, ho.hotel,ho.stars,ho.cost,co.country from cities ci, hotels ho, countries co WHERE ho.cityid=ci.id and ho.countryid=co.id';
            $res = $mysqli->query($sel);
            ?>

            <div class="d-flex align-items-center justify-content-between">
                <span class="h2-responsive white-text font-weight-light">Редактировать отели</span>
                <i class="fas fa-hotel fa-2x warning-ic"></i>
            </div>

            <hr class="hr-light">

            <form action="index.php?page=2" method="post">
                <div class="table-responsive ">
                    <table class="table table-sm table-light table-striped m-0">
                        <thead class="mdb-color white-text">
                            <tr class="p-0">
                                <th class="text-nowrap px-2" scope="col">#</th>
                                <th class="text-nowrap px-2" scope="col">Город - Страна</th>
                                <th class="text-nowrap px-2" scope="col">Название отеля</th>
                                <th class="text-nowrap text-center px-2" scope="col">Звезды отеля</th>
                                <th class="text-nowrap text-center px-2" scope="col">Стоимость отеля</th>
                                <th class="text-nowrap text-right px-3" scope="col">Удалить отель</th>
                            </tr>
                        </thead>
                        <tbody class="flex-column align-items-center justify-content-center">
                            <?php
                            while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                                echo '<tr>';
                                echo "<td class='text-nowrap px-2'>$row[1]</td>";
                                echo "<td class='text-nowrap px-2'>$row[0]-$row[5]</td>";
                                echo "<td class='text-nowrap px-2'>$row[2]</td>";
                                echo "<td class='text-nowrap text-center px-2'>$row[3]<i class='fas fa-star mx-2'></i></td>";
                                echo "<td class='text-nowrap text-center px-2'>$row[4]<i class='fas green-ic fa-dollar-sign pl-1'></i></td>";
                                echo "<td class='text-nowrap d-flex align-items-center justify-content-end'><i class='fas fa-trash-alt'></i><input type='checkbox' name='hotelCheckBox-$row[1]' class='checkbox mx-3'></td>";
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex flex-column mt-2 mb-3">
                    <p class="text-success font-weight-light">Вы можете отмечать несколько отелей и удалить их все сразу.</p>
                    <small class="text-default font-weight-light">Удалив отель вы удалите его из сайта, но не файлы с сервера!</small>
                </div>
                <button type="submit" name="delhotel" class="btn btn-sm btn-danger m-0">Удалить выбранные<i class="fas fa-trash-alt pl-2"></i></button>
            </form>

            <form action="index.php?page=2" method="post">
                <?php
                mysqli_free_result($res);
                $sel = 'SELECT ci.id, ci.city, co.country, co.id from countries co, cities ci WHERE ci.countryid=co.id';
                $res = $mysqli->query($sel);
                ?>

                <div class="form-row align-items-end w-100 mt-4">

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4">
                        <input type="text" name="hotel" class="form-control" placeholder="Название отеля...">
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4">
                        <div class="input-group m-0">
                            <input type="text" name="cost" class="form-control" placeholder="Цена отеля..." aria-label="Amount (to the nearest dollar)">
                            <div class="input-group-append">
                                <span class="input-group-text">$</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4">
                        <div class="form-group m-0">
                            <label class="white-text">Страна и город отеля</label>
                            <?php
                            echo '<select name="hcity" class="custom-select">';
                            echo '<option selected>Страна - город...</option>';
                            while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                                echo "<option value='$row[3]:$row[2]:$row[0]:$row[1]'>$row[2] - $row[1]</option>";
                            }
                            echo '</select>';
                            mysqli_free_result($res);
                            ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4">
                        <div class="form-group m-0">
                            <div class="d-flex justify-content-center align-items-center">
                                <label class="white-text mr-auto m-0">Количество звезд</label>
                                <span id="value-range" class="d-block h5-responsive text-center font-weight-bold text-primary"></span>
                                <i class='fas primary-ic fa-star ml-2'></i>
                            </div>
                            <input id="slider" name="stars" type="range" class="custom-range" min="1" max="5" value="1">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-4">
                        <label class="white-text">Краткое описание отеля</label>
                        <textarea name="info" class="form-control" aria-label="With textarea" rows="3" placeholder="Описание отеля..."></textarea>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-4">
                        <label class="white-text">Полное описание отеля</label>
                        <textarea name="full_info" class="form-control" aria-label="With textarea" rows="5" placeholder="Описание отеля..."></textarea>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end">
                        <button type="submit" name="addhotel" class="btn btn-md btn-outline-primary m-0">Добавить</button>
                    </div>
                </div>
            </form>

            <?php
            /* Добавление отеля */
            if (isset($_POST['addhotel'])) {
                addHotel(
                    trim(htmlspecialchars($_POST['hotel'])),            /* название отеля */
                    intval(trim(htmlspecialchars($_POST['cost']))),     /* цена отеля */
                    intval($_POST['stars']),                            /* звезды отеля */
                    trim(htmlspecialchars($_POST['info'])),             /* информация отеля */
                    htmlspecialchars($_POST['full_info']),              /* полная информация отеля */
                    $_POST['hcity']                                     /* названия и id страны и города */
                );
            }

            /* Удаление отеля */
            if (isset($_POST['delhotel'])) {
                delHotel();
            }

            /* Динамическое отображение значение звезд в (input range) */
            echo ('
            <script>
            let slider = document.getElementById("slider");
            let valueRange = document.getElementById("value-range");
            valueRange.innerHTML = slider.value;

            slider.oninput = function () {
                valueRange.innerHTML = this.value;
            }
            </script>
            ');
            ?>
        </div>

        <!--   Добавить фото отеля   -->
        <div class="col-12 elegant-color rounded-lg p-4 mx-2 mb-4">

            <div class="d-flex align-items-center justify-content-between">
                <span class="h2-responsive white-text font-weight-light">Добавить фото отеля</span>
                <i class="fas fa-images fa-2x warning-ic"></i>
            </div>
            <hr class="hr-light">

            <?php
            $sel = 'select co.id, co.country, ci.id, ci.city, ho.id, ho.hotel
            from countries co,cities ci, hotels ho
            where co.id=ho.countryid and ci.id=ho.cityid
            order by co.country';
            $res = $mysqli->query($sel);

            // В файле php.ini:
            // post_max_size - максимальный размер post-пакета
            // upload_max_filesize - максимальный допустимый размер одного файла
            // max_file_uploads -  максимальное количество файлов
            ?>

            <form action="index.php?page=2" method="post" enctype="multipart/form-data">

                <div class="form-row align-items-end">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-4">
                        <div class="form-group m-0">
                            <label class="white-text">Страна и город отеля</label>
                            <?php
                            echo '<select name="hotelid" class="browser-default custom-select">';
                            echo '<option selected>Страна - город - отель...</option>';
                            while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                                echo "<option value='$row[0]:$row[1]:$row[2]:$row[3]:$row[4]:$row[5]'>";
                                echo $row[1] . ' ' . $row[3] . ' ' . $row[5] . '</option>';
                            }
                            mysqli_free_result($res);
                            echo '</select>';
                            ?>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-4">
                        <div class="input-group align-items-center">
                            <div class="custom-file overflow-hidden">
                                <input type="file" class="custom-file-input" name="file[]" multiple required>
                                <label class="custom-file-label">Выберите фото...</label>
                            </div>
                            <div class="input-group-append">
                                <button type="submit" name="addimage" class="btn btn-md btn-outline-primary m-0">Добавить</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <?php

            /* Добавление картинок к отелю */
            if (isset($_REQUEST['addimage'])) {
                $str = $_REQUEST['hotelid'];
                list($countryId, $countryName, $cityId, $cityName, $hotelId, $hotelName) = explode(":", $str);

                /**
                 * Если хоть один файл будет с ошибкой ни одно фото сохраненно не будет
                 */
                foreach ($_FILES['file']['name'] as $k => $v) {
                    if ($_FILES['file']['error'][$k] != 0) {
                        /* Ошибка добавления фото отеля errorAddImageHotel */
                        include_once("pages/modals/errorAddImageHotel.html");
                        exit;
                    }
                }

                foreach ($_FILES['file']['name'] as $k => $v) {
                    if (move_uploaded_file($_FILES['file']['tmp_name'][$k], "img/Страны/$countryName/$cityName/$hotelName/$v")) {
                        chmod("img/Страны/$countryName/$cityName/$hotelName/$v", 0750);
                        $ins = "insert into images(hotelid,imagepath) values('$hotelId', 'img/Страны/$countryName/$cityName/$hotelName/$v')";
                        $mysqli->query($ins);

                        /* Успешное добавление фото отеля successAddImageHotel */
                        include_once("pages/modals/successAddImageHotel.html");
                    }
                }
            }
            ?>
        </div>

    </div>
</div>