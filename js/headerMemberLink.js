
document.getElementById("headerMemberLink").addEventListener("click",function(){
    var xhr = new  XMLHttpRequest();

    xhr.onreadystatechange=function (){
        if( xhr.readyState == 4){
            if( xhr.status == 200 ){
                if(xhr.responseText==0){
                    memberLoginNotYet();
                }else{
                    location.href = "member.php";
                }
            }else{
            alert( xhr.status );
            }
        }
    }
    var url = "php/login_or_not.php";

    xhr.open("Get", url, true);
    xhr.send( null );
});

function memberLoginNotYet(){
    document.getElementById("lightBox").style.display = "block";
}


document.getElementById("MobileHeaderMemberLink").addEventListener("click",function(){
    var xhr = new  XMLHttpRequest();

    xhr.onreadystatechange=function (){
        if( xhr.readyState == 4){
            if( xhr.status == 200 ){
                if(xhr.responseText==0){
                    memberLoginNotYet();
                    document.getElementById("overlay").classList.remove("open");
                    document.getElementById("toggle").classList.remove("action");
                }else{
                    location.href = "member.php";
                }
            }else{
            alert( xhr.status );
            }
        }
    }
    var url = "php/login_or_not.php";

    xhr.open("Get", url, true);
    xhr.send( null );
});