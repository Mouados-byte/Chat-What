function toggleNotif() {
    let menu_drop = document.querySelector('.notification-menu');
    menu_drop.classList.toggle("hide");
    console.log(menu_drop);
};  

document.querySelector('.notification').addEventListener('click' , toggleNotif);