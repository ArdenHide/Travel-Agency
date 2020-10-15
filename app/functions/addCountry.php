<?php
function addCountry($country, $countryInfo, $imgPath) {
    if ($country != "" && $countryInfo != "") {
        /**
         * Создаю папку страны и ее описание
         * Вторым параметром указываются права на папку
         * 0777 - администратор
         */
        if (!is_dir("../hotel src/$country")) {
            mkdir("../hotel src/$country", 0777);
            
            $fd = fopen("../hotel src/$country/Описание.txt", 'w+') or die(include_once("./pages/modals/errorAddCountry.html"));
            fwrite($fd, $countryInfo);
            fclose($fd);

            $countryInfoPath = "../hotel src/$country/Описание.txt";
        }

        $ins = "insert into countries(`country`, `country_img`, `country_info`) values('$country', '$imgPath', '$countryInfoPath')";
        $mysqli->query($ins);

        /* Успешное добавление страны successAddCountry */
        include_once("./pages/modals/successAddCountry.html");
    } else {
        /* Ошибка добавления страны errorAddCountry */
        include_once("./pages/modals/errorAddCountry.html");
    }
}
?>