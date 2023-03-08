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

  require_once "./db.php";
if (!isset($_SESSION['id'])) {
    // Could not get the data that should have been sent.
    header("Location: /");
    echo ("Log in before sending messages!");
}

// TODO: check if "          " is invalid 

$message = test_input($_POST['message']);

if(isset($message) && ($message != "" && !ctype_space($message))){
    $datenow = date("Y-m-d H:i:s");
    //send public message
    $sql = "INSERT INTO public_messages(  message , userid , sent_at) VALUES ( '" . $message . "', '" . $_SESSION['id'] . "','" . $datenow . "')";
    
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