<?php
if (session_status() != 2) {
    session_start();
}


require_once "../classes/user.class.php";
require "./db.php";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

function update_online(){

    require_once "C:\Users\LENOVO\Desktop\PHP Projects/reminder/config.php";
        require APP_ROOT."/database/db.php";

    if ($stmt = $conn->prepare('UPDATE users SET online = 1 WHERE id = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the email is a string so we use "s"
        $stmt->bind_param('i', $_SESSION['id']);
        $stmt->execute();
    
    }
    $stmt->close();
}

$email1 = test_input($_POST['email']);
$password1 = $_POST['password'];

if (!isset($email1, $password1)) {
    // Could not get the data that should have been sent.
    exit('Please fill both the email and password fields!');
}

$user = get_user_by_auth($email1 ,$password1);

if($user->id > 0){
    session_regenerate_id();
    $_SESSION['user'] = $user;
    $_SESSION['first_name'] = $user->first_name;
    $_SESSION['last_name'] = $user->last_name;
    $_SESSION['username'] = $user->username;
    $_SESSION['email'] = $user->email;
    $_SESSION['gender'] = $user->gender;
    $_SESSION['bio'] = $user->bio;
    $_SESSION['country'] = $user->country;
    $_SESSION['city'] = $user->city;
    $_SESSION['phone_number'] = $user->phone_number;
    $_SESSION['id'] = $user->id;
    $_SESSION['loggedin'] = true;
    update_online();
    header('Location: /');
}else{
    echo "INCORRECT EMAIL OR PASSWORD";
}
            


    