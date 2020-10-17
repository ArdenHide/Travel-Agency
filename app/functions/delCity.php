<?php
function delCity() {
    foreach ($_POST as $k => $v) {
        if (substr($k, 0, 13) == "cityCheckBox-") {
            $idc = substr($k, 13);
            $del = 'delete from cities where id=' . $idc;
            $mysqli = connect();
            $mysqli->query($del);
            if ($mysqli->errno) {
                /* Ошибка удаления города errorDelCity */
                include_once("./pages/modals/errorDelCity.html");
            }
        }
    }

    /* Успешное удаление города successDelCity */
    include_once("./pages/modals/successDelCity.html");
}
?>