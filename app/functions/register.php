<?php
function register($name,$pass,$pass2,$email)
{
    $name=trim(htmlspecialchars($name));
    $pass=trim(htmlspecialchars($pass));
    $pass2=trim(htmlspecialchars($pass2));
    $email=trim(htmlspecialchars($email));

    /* Отсувствуют значения errorNotValue */
    if ($name=="" || $pass=="" || $pass2=="" || $email=="") 
    {
        /* errorNotValue */
        include_once("pages/modals/errorNotValue.html");
        return false;
    }

    /* Ошибочная длинна пароля или логина errorLength */
    if (strlen($name)<6 || strlen($name)>30 ||
        strlen($pass)<6 || strlen($pass)>30) 
    {
        /* errorLength */
        include_once("pages/modals/errorLength.html");
        return false;
    }

    /* Не совпадают пароли errorPassNoMath */
    if ($pass != $pass2)
    {
        /* errorPassNoMath */
        include_once("pages/modals/errorPassNoMath.html");
        return false;
    }

    $ins='insert into users (login,pass,email,roleid) values("'.$name.'","'. md5($pass).'","'.$email.'",2)'; 
    $mysqli = connect(); 
    
    if (!$mysqli->query($ins)) 
    {
        /* Логин уже занят errorLoginBusy */
        if($mysqli->errno==1062) {
            /* errorLoginBusy */
            include_once("pages/modals/errorLoginBusy.html");
            return false;
        }
        else {
            echo "<h3/><span style='color:red;'> Error code:" . $mysqli->errno . "!</ span><h3/>";
            return false;
        }
    }
    /* Регистрация успешна successRegistration */
    include_once("pages/modals/successRegistration.html");
    return true;
}
?>