<?php
function addCity($city, $cityInfo, $countryid) {
    if ($city != "") {
        /**
         * Создаю папку города и ее описание
         * Вторым параметром указываются права на папку
         * 0777 - администратор
         */
        $mysqli = connect();
        $res = $mysqli->query("select country from countries where id='$countryid'");
        $row = mysqli_fetch_array($res, MYSQLI_NUM);
        $countryname = $row[0];

        $cityInfoPath = "../hotel src/$countryname/$city/Описание.txt";
        if (!is_dir("../hotel src/$countryname/$city")) {
            mkdir("../hotel src/$countryname/$city", 0777);
            
            $fd = fopen("../hotel src/$countryname/$city/Описание.txt", 'w+') or die(include_once("./pages/modals/errorAddCity.html"));
            fwrite($fd, $cityInfo);
            fclose($fd);
        }

        $ins = "insert into cities(city, countryid, cities_info) values('$city', '$countryid', '$cityInfoPath')";
        $mysqli->query($ins);
        if ($mysqli->errno) {
            /* Ошибка добавления города errorAddCity */
            include_once("./pages/modals/errorAddCity.html");
        }

        /* Успешное добавление города successAddCity */
        include_once("./pages/modals/successAddCity.html");
    } else {
        /* Ошибка добавления страны errorAddCity */
        include_once("./pages/modals/errorAddCity.html");
    }
}
?>