function showLogin() {
        document.getElementById("lightBox").style.display = "block";
        document.getElementById("lightBox").style.opacity = 1;
        TweenMax.from("#lightBox", 1, { opacity:0, ease: Power1.easeIn });
   
}

function loginForm() {
   

//     if (document.getElementById('memId').value == "mountain" && document.getElementById('memPsw').value == "123456") {

//         // document.getElementById('spanLogin').innerHTML = "登出";
//         // document.getElementById('memName').innerHTML = "張君山";
//         // account.value = "mountain";
//         document.getElementById("memPsw").value = "";
//         document.getElementById("lightBox").style.display = "none";
//     }
//     else {
//         alert("帳號或密碼錯誤，請重新輸入");
//     }
 }

// function logOut(){
//       if( document.getElementById('spanLogin').innerHTML == "登出"){

//       }
// }

function cancelLogin() {
    // document.getElementById("memId").value = "";
    // document.getElementById("memPsw").value = "";
    document.getElementById("lightBox").style.display = "none";
}

function init() {
    var btnLogin = document.getElementById("spanLogin");
    btnLogin.addEventListener("click", showLogin, false);

    // var btnLogOut = document.getElementById("spanLogin");
    // btnLogOut.addEventListener("click", logOut, false);

    var btnSendForm = document.getElementById("btnLogin");
    btnSendForm.addEventListener("click", loginForm, false);


    var btnLogCancel = document.getElementsByClassName("x_x")[0];
    btnLogCancel.addEventListener("click", cancelLogin, false);

    
    // var LoginHere = document.getElementById("LoginHere");
    // LoginHere.addEventListener("click", showLogin, false);

};

window.onload = init;
