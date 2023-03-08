<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/07937f0ea7.js" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
    body {
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #e3d7d7;
    }
    </style>
</head>

<body>

    <?php 



function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  require_once "./components/navbar.php";
  require_once "./classes/message.class.php";
  require_once "./classes/user.class.php";
    ?>
    <?php 
        if (session_status() != 2) {
            session_start();
        }
        


        $curPage = $_SERVER['REQUEST_URI'];

        if($curPage == "/login" || $curPage == "/register"){

            require_once "./views/acc.views.php";

        }else {
            if(!isset($_SESSION['email'])) {
                header('Location: /login');
            }
            if($curPage == "/" ){

                
                require_once "./views/home.views.php";
    
            }else if(preg_match("/^\/users\/(\d+)$/" , $curPage , $matches)){

                $user_id = $matches[1];
                require_once "./views/profile.views.php";
                
    
    
            }else if($curPage == "/logout"){
                require_once('./database/logout.php');
                
    
            }else {
    
                require_once "./views/404.views.php";
            
            }
        }
    ?>
</body>

</html>