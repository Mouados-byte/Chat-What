<?php 

$email = "login first";
if (session_status() != 2) {
    session_start();
}

$user = new User();

$user->get_user($user_id);

if($user->id == -1){
    echo "Something different";
    header('Location: /404');

}



require_once "./components/profile.php";