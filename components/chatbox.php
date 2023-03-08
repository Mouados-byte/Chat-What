<style>
<?=include 'assets/css/chatbox.css';
?>
</style>

<div id="live-chat">

    <header class="clearfix">

        <a href="#" class="chat-close">x</a>

        <h4>Messenger</h4>
        <!-- 
        <span class="chat-message-counter">3</span> -->

    </header>

    <div class="chatbox" style="display: none;">

        <div class="chat-history">

            <?php 
            require_once "./database/get_convo_list.php";

            

            if(count($users_list) >0){
                foreach ($users_list as $messenger) {
                    
                    require "./components/userMessenger.php";
                    echo '<hr>';
                }
            }else{
                echo "No conversation found";
            }
        ?>

        </div> <!-- end chat-history -->

        <form>

            <fieldset>

                <input type="text" placeholder="Search for user" autofocus id="search_user">
                <input type="hidden">

            </fieldset>

        </form>

    </div> <!-- end chat -->

</div> <!-- end live-chat -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script>
(function() {

    $('#live-chat header').on('click', function() {

        $('.chatbox').slideToggle(300, 'swing');
        $('.chat-message-counter').fadeToggle(300, 'swing');

    });

    $('.chat-close').on('click', function(e) {

        e.preventDefault();
        $('#live-chat').fadeOut(300);

    });

})();


$("#search_user").keyup(function() {
    var searchVal = $(this).val().toLowerCase();
    $(".chat-message").each(function() {
        $(".messenger_user").each(function() {
            var textVal = $(this).text().toLowerCase();
            console.log($(this).parentsUntil(".chat-message"));
            if (textVal.indexOf(searchVal) === 0) {
                $(this).parent().parent().show();
            } else {
                $(this).parent().parent().hide();
            }
        })
    });
});
</script>