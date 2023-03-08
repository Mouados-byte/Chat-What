<?php

class User{
    public $id;
    public $username;
    public $first_name;
    public $last_name;
    public $email;
    public $bio;
    public $country;
    public $city;
    public $phone_number;
    public $gender;
    public $online;
    public $image_path;
    private $password;


    public function user($id , $first_name, $last_name, $username, $email, $gender, $bio, $country, $city, $phone_number , $image_filename , $online) {
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->username = $username;
            $this->email = $email;
            $this->gender = $gender;
            $this->bio = $bio;
            $this->country = $country;
            $this->city = $city;
            $this->phone_number = $phone_number;
            $this->id = $id;
            $this->image_path = $image_filename;
            $this->online = $online;
    }

    public function get_image($image_id){
        require_once "C:\Users\LENOVO\Desktop\PHP Projects/reminder/config.php";
        require APP_ROOT."/database/db.php";

        if ($stmt = $conn->prepare('SELECT i.filename FROM users AS u JOIN images as i ON i.id = u.image_id WHERE i.id = ?')) {
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the email is a string so we use "s"
            $stmt->bind_param('i', $image_id);
            $stmt->execute();
            // Store the result so we can check if the account exists in the database.
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result( $filename);
                $stmt->fetch();
                return $filename;
            }
            $stmt->close();
        }
    }

    public function get_user($userid){
        require_once "C:\Users\LENOVO\Desktop\PHP Projects/reminder/config.php";
        require APP_ROOT."/database/db.php";

        if ($stmt = $conn->prepare('SELECT id , first_name, last_name, username, email, gender, bio, country, city, phone_number , image_id , password FROM users where id = ? ')) {
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the email is a string so we use "s"
            $stmt->bind_param('i', $userid);
            $stmt->execute();
            // Store the result so we can check if the account exists in the database.
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id , $first_name, $last_name, $username, $email, $gender, $bio, $country, $city, $phone_number , $image_id , $password );
                $stmt->fetch();
                $this->user($id , $first_name, $last_name, $username, $email, $gender, $bio, $country, $city, $phone_number , $this->get_image($image_id) , 1 );
            }
            $stmt->close();
        }

        return $this;
    }
    

    public function get_private_messages($userid){
        
        $messages_list = array(); 

        require_once "C:\Users\LENOVO\Desktop\PHP Projects/reminder/config.php";
        require APP_ROOT."/database/db.php";

        // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
        if ($stmt = $conn->prepare('SELECT  id , sent_from , sent_to , message , sent_at FROM private_messages WHERE sent_from = ? and sent_to = ?  or sent_from = ? and sent_to = ? ')) {
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the email is a string so we use "s"
            $stmt->bind_param('iiii', $userid, $this->id, $this->id, $userid);
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
                    $user = new User();
                    $messagei->username = $user->get_user($sent_from)->username;
                    $messagei->message = $message;
                    $messagei->sent_at = $sent_at;
                    $messages_list[$id] = $messagei;
                }
            }

            $stmt->close();
            }

            return $messages_list;

    }

        
    public function get_notifications(){
        
        $notification_list = array(); 

        require_once "C:\Users\LENOVO\Desktop\PHP Projects/reminder/config.php";
        require APP_ROOT."/database/db.php";
        require  APP_ROOT."/classes/message.class.php";


        // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
        if ($stmt = $conn->prepare('SELECT  notif.id , notif.messageid , m.sent_from ,  m.sent_to , m.message , m.sent_at FROM notifications AS notif JOIN private_messages AS m ON notif.messageid = m.id AND m.sent_to = ? ')) {
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the email is a string so we use "s"
            $stmt->bind_param('i', $this->id);
            $stmt->execute();
            // Store the result so we can check if the account exists in the database.
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id , $messageid ,  $sent_from,$sent_to, $message , $sent_at);
                while($stmt->fetch()){
                    $messagei = new Message();
                    $messagei->id = $messageid;
                    $messagei->sent_from = $sent_from;
                    $messagei->sent_to = $sent_to;
                    $user = new User();
                    $messagei->username = $user->get_user($sent_from)->username;
                    $messagei->message = $message;
                    $messagei->sent_at = $sent_at;
                    $notification_list[$id] = $messagei;
                }
            }

            $stmt->close();
            }
            return $notification_list;

    }
}

function get_user_by_auth($email , $passwd1){
    require_once "C:\Users\LENOVO\Desktop\PHP Projects/reminder/config.php";
        require APP_ROOT."/database/db.php";
    $user = new User();
    if ($stmt = $conn->prepare('SELECT id , first_name, last_name, username, email, gender, bio, country, city, phone_number , image_id , password FROM users WHERE email = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the email is a string so we use "s"
        $stmt->bind_param('s', $email);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id , $first_name, $last_name, $username, $email, $gender, $bio, $country, $city, $phone_number  , $image_id, $password );
            $stmt->fetch();
            if (password_verify($passwd1, $password)) {
                $user->user($id , $first_name, $last_name, $username, $email, $gender, $bio, $country, $city, $phone_number , $user->get_image($image_id) , 1 );
            }else{
                $user->id = -1;
            }
        }else{
            $user->id = -1;
        }
    }
    $stmt->close();
    return $user;
}