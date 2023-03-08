<?php
if (session_status() != 2) {
    session_start();
}

if (isset($_SESSION["loggedin"])) {
    $logged = "logout";
    $sign = "users/".$_SESSION['id'];
    $profile = "Profile";
} else {
    $logged = "login";
    $sign = "register";
    $profile = ucwords($sign);
}
?>


<link rel="stylesheet" href="/assets/css/navbar.css">

<div class="nav">
    </style>
    <a class="nav-header" href="/">
        <div class="nav-title">
            Pridfo
        </div>
    </a>

    <div class="nav-btn">
        <label for="nav-check">
            <span></span>
            <span></span>
            <span></span>
        </label>
    </div>

    <div class="nav-links">

        <?php 
        if (isset($_SESSION["id"])) {
            require_once './components/notificationBox.php';
        }
    ?>

        <a href="/<?= $logged ?>"><?= ucwords($logged) ?></a>
        <a href="/<?= $sign ?>"><?= $profile ?></a>
    </div>
</div>
<script>
<?=include 'assets/js/navbar.js';?>
</script>