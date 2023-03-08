<?php
if (session_status() != 2) {
    session_start();
}


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
require_once "C:\Users\LENOVO\Desktop\PHP Projects/reminder/config.php";
require APP_ROOT."/database/db.php";
if (!isset($_SESSION['id'])) {
    // Could not get the data that should have been sent.
    header("Location: /");
    echo ("Log in before sending messages!");
}

// TODO: check if "          " is invalid 

$message = test_input($_POST['message']);

if(isset($message) && ($message != "")){
    $datenow = date("Y-m-d H:i:s");
    //send private messages
    $sql = "INSERT INTO private_messages(  message , sent_from , sent_to , sent_at) VALUES ( '" . $message . "', '" . $_SESSION['id'] . "', '" . $_POST['sent_to'] . "', '" . $datenow . "')";
    
    if (!mysqli_query($conn, $sql)) {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }else{
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    $new_id = $conn->insert_id;

    //assert message to notifications table
    $sql = "INSERT INTO notifications(  messageid ) VALUES ( '" . $new_id . "')";
    
    if (!mysqli_query($conn, $sql)) {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }else{
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}else{
     // Could not get the data that should have been sent.
     header("Location: /");
     echo ('Please fill all fields!');
}