
window.onscroll = function(){navFunction()};

function navFunction(){
    var nav = document.getElementById("navbar_top");
    var sticky = nav.offsetTop; 
    var topper = document.getElementById("topper");
    if(window.pageYOffset >= sticky){
        nav.classList.add("nav-shadow");
        topper.style.display = "block";
    } else {
        topper.style.display = "none";
    }
}