<?php
function delHotel() {
    foreach ($_POST as $k => $v) {
        if (substr($k, 0, 2) == "hb") {
            $idc = substr($k, 2);
            $del = 'delete from hotels where id=' . $idc;
            $mysqli =connect();
            $mysqli->query($del);
            if ($mysqli->errno) {
                /* Ошибка удаления отеля errorDelHotel */
                include_once("./pages/modals/errorDelHotel.html");
            }
        }
    }
    /* Успешное удаление отеля successDelHotel */
    include_once("./pages/modals/successDelHotel.html");
}
?>