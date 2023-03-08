<?php
if (session_status() != 2) {
    session_start();
}

require_once './classes/user.class.php';

$user_in_profile = new User();
$user_in_profile->get_user($_SESSION['id']);

$messages_list = $user_in_profile->get_private_messages($user->id);