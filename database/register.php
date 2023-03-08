<?php
session_start();


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


require_once "C:\Users\LENOVO\Desktop\PHP Projects/reminder/config.php";
require APP_ROOT."/database/db.php";

$email = test_input($_POST['email']);
$username = test_input($_POST['username']);
$first_name = test_input($_POST['first_name']);
$last_name = test_input($_POST['last_name']);
$bio = test_input($_POST['bio']);
$country = test_input($_POST['country']);
$city = test_input($_POST['city']);
$phone_number = test_input($_POST['phone_number']);

if (!isset($email, $_POST['password'] , $username, $first_name, $last_name, $_POST['gender'], $bio , $country, $city, $phone_number)) {
    exit('Please fill all fields!');
}

if($_POST['password'] == $_POST['Cpassword']){
    $hashed_password = password_hash($_POST['password'] , PASSWORD_BCRYPT);
    require_once "C:\Users\LENOVO\Desktop\PHP Projects/reminder/config.php";
    require APP_ROOT."/database/upload_images.php";
    $sql = "INSERT INTO users( first_name, last_name, username, email, gender, bio, country, city, phone_number ,password , image_id) VALUES ( '" . $first_name . "','" . $last_name . "','" . $username . "', '" . $email . "' ,  '" . $_POST['gender'] . "' , '" . $bio . "','" . $country . "','" . $city . "','" . $phone_number . "','" . $hashed_password . "','" . $image_id . "')";

    if (mysqli_query($conn, $sql)) {
        echo "Records inserted successfully.";
        header("Location: /login");
    } else {
        header("Location: /register");
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
}else{
    exit('Different passwords!');
}