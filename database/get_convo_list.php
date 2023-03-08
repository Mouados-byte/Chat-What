<?php
if (session_status() != 2) {
    session_start();
}


$users_list = array(); 

function  check_if_online($userid , $servername, $username, $passwd, $dbname){

    // Create connection
$conne = new mysqli($servername, $username, $passwd, $dbname);
// Check connection
if ($conne->connect_error) {
    die("Connection failed: " . $conne->connect_error);
}
if ($stmt = $conne->prepare('SELECT online FROM users where id = ? ')) {
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the email is a string so we use "s"
    $stmt->bind_param('i', $userid);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($online);
        $stmt->fetch();
        if ($online == 1) {
            return true;
        }
    }

    $stmt->close();
    return false;
}
}


require_once "C:\Users\LENOVO\Desktop\PHP Projects/reminder/config.php";
require_once APP_ROOT."/database/db.php";
require_once APP_ROOT."/classes/message.class.php";
require_once APP_ROOT."/classes/user.class.php";

if (!isset($search_user)) {
    $search_user = '%';
}else{
    $search_user = $search_user . '%';
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.

if (isset($_POST['userList'])) {
    $users_list = $_POST['userList'];
}

if ($stmt = $conn->prepare('SELECT pm.id, pm.sent_from, pm.sent_to, pm.message, pm.sent_at
FROM private_messages AS pm
JOIN users AS u ON pm.sent_from = ? OR pm.sent_to = ?
WHERE u.username LIKE ?
GROUP BY LEAST(pm.sent_from, pm.sent_to), GREATEST(pm.sent_from, pm.sent_to)
ORDER BY pm.sent_at DESC')) {
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the email is a string so we use "s"
    $stmt->bind_param('iis', $_SESSION['id'] , $_SESSION['id'] , $search_user);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id , $sent_from,$sent_to, $message , $sent_at);
        while($stmt->fetch()){
            $messagei = new Message();
            $messagei->id = $id;
            $messagei->sent_from = $sent_from;
            $messagei->sent_to = $sent_to;
            $this_user = new User();
            $messagei->username = $this_user->get_user($sent_from == $_SESSION['id'] ? $sent_to : $sent_from)->username;
            $messagei->message = $message;
            $messagei->sent_at = $sent_at;
            $messagei->online = check_if_online($sent_to, $servername, $username, $passwd, $dbname);
            array_push($users_list , $messagei);
        }
    }

    $stmt->close();
}

if (isset($_POST['userList'])) {
    $users_list = $_POST['userList'];
}

// Return the result as JSON
return json_encode($users_list);