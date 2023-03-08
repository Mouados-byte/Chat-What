<?php

if (session_status() != 2) {
    session_start();
}
    $curPageName = $_SERVER['REQUEST_URI'];
    $curPageName = substr($curPageName , 1 , strlen($curPageName));
    $task = ($curPageName == '') ?"login" : $curPageName;
    include "./components/login.php"
?>