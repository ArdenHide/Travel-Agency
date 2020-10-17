<?php
function delCountry() {
    foreach ($_POST as $k => $v) {
        if (substr($k, 0, 16) == "countryCheckBox-") {
            $idc = substr($k, 16);
            $del = 'delete from countries where id=' . $idc;
            $mysqli = connect();
            $mysqli->query($del);
            if ($mysqli->errno) {
                /* Ошибка удаления страны errorDelCountry */
                include_once("pages/modals/errorDelCountry.html");
            }
        }
    }
    
    /* Успешное удаление страны successDelCountry */
    include_once("pages/modals/successDelCountry.html");
}
?>