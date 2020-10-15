<?php
function login($name,$pass) 
{
    $name=trim(htmlspecialchars($name));
    $pass=trim(htmlspecialchars($pass));

    /* Отсувствуют значения errorNotValue */
    if ($name=="" || $pass=="")  
    {
        /* errorNotValue */
        include_once("pages/modals/errorNotValue.html");
        return false; 
    }

    /* Ошибочная длинна пароля errorLength */
    if (strlen($name)<6 || strlen($name)>30 || strlen($pass)<6 || strlen($pass)>30) 
    {
        /* errorLength */
        include_once("pages/modals/errorLength.html");
        return false;
    }

    $mysqli = connect(); 
    $sel='select * from users where login="'.$name.'" and pass="'.md5($pass).'"';
    $res=$mysqli->query($sel);

    /* Успешная авторизация successLogin */
    if($row=mysqli_fetch_array($res, MYSQLI_NUM))
    {  
        $_SESSION['ruser'] = $name;
        if($row[4]==1)
        {
            $_SESSION['radmin'] = $name;
        } 
        /* successLogin */
        include_once("pages/modals/successLogin.html");
        mysqli_free_result($res);
    }

    /* Пользователь не существует errorNonExistentUser */
    else
    {
        /* errorNonExistentUser */
        include_once("pages/modals/errorNonExistentUser.html");
        mysqli_free_result($res);
        return false;
    }
}
?>