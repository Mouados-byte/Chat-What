<?php 
    require_once "./database/get_public_messages.php";
    if (session_status() != 2) {
        session_start();
    }
?>
<div class="chat-homepage">

    <?php 
    require_once "./components/chat.php";
    require_once "./components/chatbox.php";
    ?>
</div>