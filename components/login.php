<script>
<?=include 'assets/js/login.js';?>
</script>
<div class="preloader"></div>
<div class="container">
    <style>
    <?=include 'assets/css/login.css';
    ?>
    </style>
    <img class="imagelogin" src="https://upload.wikimedia.org/wikipedia/commons/b/b9/Arrow-right-small.svg" />
    <h1><?= ucfirst($task)  ?></h1>
    <form method="post" action="<?= $task == 'login' ? 'database/auth.php' : 'database/register.php' ?>"
        enctype="multipart/form-data">
        <input type="email" name="email" placeholder="Email address">
        <?php 
            if($task == "register"){
                echo '<input type="text" name="username" placeholder="Username">';
                echo '<input type="text" name="first_name" placeholder="First name">';
                echo '<input type="text" name="last_name" placeholder="Last name">';
                echo '<input type="text" name="country" placeholder="Country">';
                echo '<input type="text" name="city" placeholder="city">';
                echo '<input type="tel" name="phone_number" placeholder="Phone Number">';
                echo '<input type="radio" name="gender" id="male" value="male">
                <label for="male">Male</label>
                <input type="radio" name="gender" id="female" value="female">
                <label for="female">Female</label>';
                echo '<textarea name="bio" placeholder="Bio"></textarea>';
                echo '<input type="file" name="profile_pic">';
            }
        ?>

        <input type="password" name="password" placeholder="Password">
        <?php 
            if($task == "register"){
                echo '<input type="password" name="Cpassword" placeholder="Confirm password">';
            }
        ?>

        <button type="submit"><?=ucfirst($task) ?></button>
    </form>
</div>