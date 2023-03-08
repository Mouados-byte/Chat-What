<?php
if (session_status() != 2) {
    session_start();
}

require_once './classes/user.class.php';


$user = new User();
$notifications_list = array();

if(isset($_SESSION['id'])){
    $notifications_list = $user->get_user($_SESSION['id'])->get_notifications();

}