<?php
function connect($host='localhost', $user='root', $pass='stas2526', $dbname='travel')
{
    $mysqli = @new mysqli($host, $user, $pass, $dbname);
    if ($mysqli->connect_errno) 
    {
        die('Error connection: ' . $mysqli->connect_errno);
    }
    $mysqli->query("set names 'utf8'"); 
    return $mysqli;
}
?>