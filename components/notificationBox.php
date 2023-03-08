<div class="notification">
    <img class src="https://s3.amazonaws.com/codecademy-content/projects/2/feedster/bell.svg">
    <ul class="notification-menu hide">


        <?php 
            require_once './database/get_notifications.php';

            if(count($notifications_list) == 0){
                echo "Empty notification box!";
            }else{
                foreach($notifications_list as $notif){
                    require './components/notificationElement.php';
                }
            }
        ?>
    </ul>
</div>