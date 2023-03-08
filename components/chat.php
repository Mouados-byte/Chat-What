<ol class="chat" id="chat-list">

    <style>
    <?=include 'assets/css/chat.css';
    ?>
    </style>

    <?php
    $index = 0;
        foreach($messages_list as $messagei){
            $last_message = ($index == $messages_list);
            include './components/message.php';
            $index++;
        }
        

        if (count($messages_list) == 0) {
            echo '<div class="no_convo"><br>Empty Conversation? <br><br>
                Feel free to start a conversation now!
            </div>';
        }
    ?>

</ol>
<div class="typezone">

    <?php 
            if ($_SERVER['REQUEST_URI'] === "/") {
                echo '<form method="post" action="/database/send_pub_message.php">';
            } else {
                echo '<form method="post" action="/database/send_priv_message.php">';
            }
            
            if(isset($user->id)){
                echo '<input type="hidden" name="sent_to" value="'.$user->id .'">';
    }
    ?>
    <textarea name="message" type="text" placeholder="Say something"></textarea>
    <button type="submit" class="send"><b>Send</b></button>
    </form>
</div>
<script>
window.scrollTo(0, document.body.scrollHeight);
</script>