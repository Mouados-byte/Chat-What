<link rel="stylesheet" href="/assets/css/profile.css">



<script>
let bio = document.querySelector(".bio");

if (bio) {
    let oldText = "";
    const bioMore = document.querySelector("#see-more-bio");
    const bioLength = bio.innerText.length;

    function bioText() {
        oldText = bio.innerText;

        bio.innerText = bio.innerText.substring(0, 100) + "...";
        bio.innerHTML += `<span onclick='addLength()' id='see-more-bio'>See More</span>`;
    }

    bioText();

    function addLength() {
        bio.innerText = oldText;
        bio.innerHTML +=
            "&nbsp;" + `<span onclick='bioText()' id='see-less-bio'>See Less</span>`;
        document.getElementById("see-less-bio").addEventListener("click", () => {
            document.getElementById("see-less-bio").style.display = "none";
        });
    }


}

var loadFile = function(event) {
    var image = document.getElementById("output");
    image.src = URL.createObjectURL(event.target.files[0]);
};

document.getElementById("profile_pic_id").addEventListener("change", function() {
    document.getElementById("change_profile_pic").submit();
});
</script>

<div class="container">
    <div class="profile-header">
        <form class="profile-pic" method="post" action="change_profile_pic.php" enctype="multipart/form-data"
            id="change_profile_pic">
            <?php 
                if ($user->id == $_SESSION['id']) {
                    echo '<label class="-label" for="file">
                    <span class="glyphicon glyphicon-camera"></span>
                    <span>Change Image</span>
                </label>
                <input id="file" type="file" onchange="loadFile(event)" id="profile_pic_id" />';
                }
            ?>
            <img src=<?= " /assets/images/" . $user->image_path ?> width="200" alt="Profile Image" id="output">
        </form>
        <div class="profile-nav-info">
            <h3 class="user-name <?= $user->online ? "online" : "" ?>""><?=$user->last_name?> <?=$user->first_name?> (<?=$user->username?>)</h3>
            <div class=" address">
                <p id="state" class="state"><?=$user->city?>.</p>
                <span id="country" class="country"><?=$user->country?></span>
        </div>

    </div>
    <div class="profile-option">
        <!-- TODO : add options  -->
    </div>
</div>

<div class="main-bd">
    <div class="left-side">
        <div class="profile-side">
            <p class="mobile-no"><i class="fa fa-phone"></i> <?=$user->phone_number?></p>
            <p class="user-mail"><i class="fa fa-envelope"></i> <?=$user->email?></p>
            <div class="user-bio">
                <h3>Bio</h3>
                <p class="bio">
                    <?=$user->bio?>
                </p>
            </div>
            <div class="user-bio">
                <h3>Gender</h3>
                <p class="bio">
                    <?=$user->gender?>
                </p>
            </div>
            <div class="profile-btn">
                <button class="chatbtn" id="chatBtn"><i class="fa fa-comment"></i> Chat</button>
                <button class="createbtn" id="Create-post"><i class="fa fa-plus"></i> Create</button>
            </div>

        </div>
    </div>
    <?php
            if ($_SERVER['REQUEST_URI'] != '/users/' . $_SESSION['id']) {
                echo '<div class="right-side">';
                require_once "./database/get_private_messages.php";
                require_once "./components/chat.php";
                echo '</div>';
    }
    ?>

</div>

</div>
</div>
</div>