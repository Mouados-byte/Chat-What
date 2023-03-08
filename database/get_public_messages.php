<?php
if (session_status() != 2) {
    session_start();
}


$messages_list = array(); 

require_once "C:\Users\LENOVO\Desktop\PHP Projects/reminder/config.php";
require APP_ROOT."/database/db.php";
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $conn->prepare('SELECT id , userid, message , sent_at FROM public_messages ')) {
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the email is a string so we use "s"
    // $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id , $userid, $message , $sent_at);
        while($stmt->fetch()){
            $messagei = new Message();
            $messagei->id = $id;
            $messagei->sent_from = $userid;
            $this_user = new User();
            $messagei->username = $this_user->get_user($userid)->username;
            $messagei->message = $message;
            $messagei->sent_at = $sent_at;
            $messages_list[$id] = $messagei;
        }
    }

    $stmt->close();
}