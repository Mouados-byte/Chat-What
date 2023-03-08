<li class="<?= ($messagei->sent_from == $_SESSION['id'])? "self" : "other" ?>">

    <div class="msg">
        <a href="/users/<?= $messagei->sent_from?>" class="user"><?= $messagei->username ?></a>
        <p>
            <?= $messagei->message ?>
        </p>
        <div class="time"><?= $messagei->sent_at ?></div>
    </div>
</li>