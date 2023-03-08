<?php


function update_offline(){
    require_once "C:\Users\LENOVO\Desktop\PHP Projects/reminder/config.php";
        require APP_ROOT."/database/db.php";
    if ($stmt = $conn->prepare('UPDATE users SET online = 0 WHERE id = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the email is a string so we use "s"
        $stmt->bind_param('i', $_SESSION['id']);
        $stmt->execute();
    
    }
    $stmt->close();
}
update_offline();
session_destroy();
header('Location: /'); 