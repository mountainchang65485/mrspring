var xhr = new  XMLHttpRequest();

xhr.onreadystatechange=function (){
    if( xhr.readyState == 4){
        if( xhr.status == 200 ){
            if(xhr.responseText==1){
                memberLoginYet();
            }else{
                document.getElementById("LoginHere").src = "images/account.svg";
                document.getElementById("loginText").innerText = "登入";
                document.getElementById("LoginHere").style.width = "100%";
            }
        }else{
        alert( xhr.status );
        }
    }
}
var url = "php/login_or_not.php";

xhr.open("Get", url, true);
xhr.send( null );

function memberLoginYet(){
    var xhr4 = new XMLHttpRequest();
    xhr4.onreadystatechange = function(){
        if( xhr4.readyState == 4){
            if( xhr4.status == 200 ){
                showMemberInfo(xhr4.responseText);
            }else{
                alert( xhr4.status );
            }
        }
    }

    var url4 = "php/mt_memberInfo.php";
    xhr4.open("Get", url4, true);
    xhr4.send( null );

    function showMemberInfo(jsonStr){
        var memberInfo = JSON.parse(jsonStr);
        // console.log(memberInfo);
        document.getElementById("LoginHere").src = memberInfo.memImgUrl;
        document.getElementById("loginText").innerText = "登出";
        document.getElementById("LoginHere").style.width = "100%";
    }
    
}