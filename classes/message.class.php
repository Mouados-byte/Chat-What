<?php

class Message{
    public $id;
    public $sent_from;
    public $sent_to;
    public $username;
    public $message;
    public $sent_at;
    public $online;

    public function get_message($id , $sent_from,$sent_to, $message , $sent_at)
    {
        require_once './classes/user.class.php';
            $this->id = $id;
            $this->sent_from = $sent_from;
            $this->sent_to = $sent_to;
            $user = new User();
            $this->username = $user->get_user($sent_from)->username;
            $this->message = $message;
            $this->sent_at = $sent_at;
        }
        
        public function get_priv_message($message_id){
            
            require_once "C:\Users\LENOVO\Desktop\PHP Projects/reminder/config.php";
        require APP_ROOT."/database/db.php";
            
            require_once './classes/user.class.php';
        
        // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
        if ($stmt = $conn->prepare('SELECT  id , sent_from , sent_to , message , sent_at FROM private_messages WHERE id = ?')) {
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the email is a string so we use "s"
            $stmt->bind_param('i', $message_id);
            $stmt->execute();
            // Store the result so we can check if the account exists in the database.
            $stmt->store_result();
    
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id , $sent_from,$sent_to, $message , $sent_at);
                $stmt->fetch();
                $this->id = $id;
                $this->sent_from = $sent_from;
                $this->sent_to = $sent_to;
                $user = new User();
                $this->username = $user->get_user($sent_from)->username;
                $this->message = $message;
                $this->sent_at = $sent_at;
            }
        }
    
        $stmt->close();
        return $message;
    }
    
}