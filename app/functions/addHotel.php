<?php
function addHotel($hotel, $cost, $stars, $info, $full_info, $userCountryCity) {
    if ($hotel != "" && $cost != "" && $stars != "" && $info != "" && $full_info != "") {
        list($countryId, $countryName, $cityId, $cityName) = explode(":", $userCountryCity);

        /**
         * Создаю папку города и ее описание
         * Вторым параметром указываются права на папку
         * 0777 - администратор
         */
        if (!is_dir("../hotel src/$countryName/$cityName/$hotel")) {
            mkdir("../hotel src/$countryName/$cityName/$hotel", 0777);
            
            $fd = fopen("../hotel src/$countryName/$cityName/$hotel/Краткое описание.txt", 'w+') or die(include_once("./pages/modals/errorAddHotel.html"));
            fwrite($fd, $info);
            fclose($fd);
            $hotelInfoPath = "../hotel src/$countryName/$cityName/$hotel/Краткое описание.txt";

            $fi = fopen("../hotel src/$countryName/$cityName/$hotel/Полное описание.txt", 'w+') or die(include_once("./pages/modals/errorAddHotel.html"));
            fwrite($fi, $full_info);
            fclose($fi);
            $hotelFullInfoPath = "../hotel src/$countryName/$cityName/$hotel/Полное описание.txt";
        }
        $mysqli = connect();
        $ins =  "insert into hotels (hotel,cityid,countryid,stars,cost,info,full_info) values('$hotel', '$cityId', '$countryId', '$stars', '$cost', '$hotelInfoPath', '$hotelFullInfoPath')";
        $mysqli->query($ins);
        if ($mysqli->errno) {
            /* Ошибка добавления отеля errorAddHotel */
            include_once("./pages/modals/errorAddHotel.html");
        }

        /* Успешное добавление отеля successAddHotel */
        include_once("./pages/modals/successAddHotel.html");
    } else {
        /* Ошибка добавления отеля errorAddHotel */
        include_once("./pages/modals/errorAddHotel.html");
    }
}
?>