




function loginOrNot(){
    console.log(memId.innerText);
    if (memId.innerText == "登入"){
        lightBox.style.display="block";
        lightBox.style.opacity=1;
        TweenMax.from("#lightBox", 1, { opacity:0, ease: Power4.easeInOut });
       
    }else{
        window.location.href = "game.html";
    }
    

}

function init(){
    memId=document.getElementById("loginText");
    loginBox=document.getElementById("lightBox");
    document.getElementsByClassName("getCoupon")[0].onclick=loginOrNot;
}

window.addEventListener("load",init,false);