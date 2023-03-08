<a href="/users/<?= $messenger->sent_to?>" class="chat-message clearfix">

    <img src="/assets/images/default.jpg" alt="" width="32" height="32">

    <div class="chat-message-content clearfix">

        <span class="chat-time"><?=$messenger->sent_at ?></span>

        <h5 class="<?= $messenger->online ? "online" : "" ?> messenger_user"><?=$messenger->username ?></h5>

    </div> <!-- end chat-message-content -->

</a> <!-- end chat-message -->