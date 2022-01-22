var roomvalue = "";
var clockvalue = "";
var stepCount = 0;

//選擇分店
var store = document.getElementsByClassName("branch");
var storeSlider = document.getElementsByClassName("branchTextContainer");
var roomImg = document.querySelectorAll(".roomImg_d img");
var storeIconColor =  document.querySelectorAll(".branch_container img");
var roomPrice = document.getElementById("roomPriceText");
// var store01 = document.getElementsByClassName(".branch .firstBranch_d");
// var store02 = document.getElementsByClassName(".branch .secondBranch_d");
// var store03 = document.getElementsByClassName(".branch .thirdBranch_d");

for(var i = 0;i < store.length;i++){
    store[i].addEventListener("click",storeSlide);
}

function storeSlide(){
    // console.log(this);
    clockvalue = "";//每次篩選初始化以防選到被訂走的
    document.getElementsByClassName("clockTextContainer")[0].style.transform = "translateY(0)";//每次篩選初始化clockSlider

    roomvalue = this.childNodes[1].childNodes[1].innerHTML;
    roomPrice.innerText = this.getAttribute("roomPrice");

    //篩選結果
    for(var j = 0;j < document.getElementsByClassName("clock").length;j++){
        document.getElementsByClassName("clock")[j].style.filter = "brightness(1)";
        document.getElementsByClassName("clock")[j].addEventListener("click",clockSlide);
        document.getElementsByClassName("clock")[j].classList.add("nav-control");
    }

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if( xhr.readyState == 4){
            if( xhr.status == 200 ){
                clockSelect(xhr.responseText);
            }else{
                alert( xhr.status );
            }
        }
    }

    var url = "php/clockResult.php?roomvalue=" + roomvalue + "店" + "&datevalue=" + datevalue;
    xhr.open("Get", url, true);
    xhr.send( null );

    function clockSelect(jsonStr){
        var result = JSON.parse(jsonStr);
        var reserMorningCount = 0;
        var reserAfternoonCount = 0;
        var reserNightCount = 0;
        // console.log(result);

        stepCount = 0;
        
        for(var i = 0;i < result.length;i++){
            if(result[i].reserMorning == "1"){
                reserMorningCount++;
                if(reserMorningCount == 3){
                    document.getElementsByClassName("clock")[0].style.filter = "brightness(.5)";
                    document.getElementsByClassName("clock")[0].removeEventListener("click",clockSlide);
                    document.getElementsByClassName("clock")[0].classList.remove("nav-control");
                }
            }else if(result[i].reserAfternoon == "1"){
                reserAfternoonCount++;
                if(reserAfternoonCount == 3){
                    document.getElementsByClassName("clock")[1].style.filter = "brightness(.5)";
                    document.getElementsByClassName("clock")[1].removeEventListener("click",clockSlide);
                    document.getElementsByClassName("clock")[1].classList.remove("nav-control");
                }
            }else if(result[i].reserNight == "1"){
                reserNightCount++;
                if(reserNightCount == 3){
                    document.getElementsByClassName("clock")[2].style.filter = "brightness(.5)";
                    document.getElementsByClassName("clock")[2].removeEventListener("click",clockSlide);
                    document.getElementsByClassName("clock")[2].classList.remove("nav-control");
                }
            }
        }
        

        //時段限定篩選時段
        // console.log(cardTimeItemValue);
        if(cardTimeItemValue == 1){
            document.getElementsByClassName("clock")[1].style.filter = "brightness(.5)";
            document.getElementsByClassName("clock")[1].removeEventListener("click",clockSlide);
            document.getElementsByClassName("clock")[1].classList.remove("nav-control");
            document.getElementsByClassName("clock")[2].style.filter = "brightness(.5)";
            document.getElementsByClassName("clock")[2].removeEventListener("click",clockSlide);
            document.getElementsByClassName("clock")[2].classList.remove("nav-control");
        }else if(cardTimeItemValue == 2){
            document.getElementsByClassName("clock")[0].style.filter = "brightness(.5)";
            document.getElementsByClassName("clock")[0].removeEventListener("click",clockSlide);
            document.getElementsByClassName("clock")[0].classList.remove("nav-control");
            document.getElementsByClassName("clock")[2].style.filter = "brightness(.5)";
            document.getElementsByClassName("clock")[2].removeEventListener("click",clockSlide);
            document.getElementsByClassName("clock")[2].classList.remove("nav-control");
        }else if(cardTimeItemValue == 3){
            document.getElementsByClassName("clock")[0].style.filter = "brightness(.5)";
            document.getElementsByClassName("clock")[0].removeEventListener("click",clockSlide);
            document.getElementsByClassName("clock")[0].classList.remove("nav-control");
            document.getElementsByClassName("clock")[1].style.filter = "brightness(.5)";
            document.getElementsByClassName("clock")[1].removeEventListener("click",clockSlide);
            document.getElementsByClassName("clock")[1].classList.remove("nav-control");
        } 
    }

    
    
    // console.log(this.getAttribute("roomPrice"));
    // console.log(this.childNodes[1].childNodes[1].innerHTML);
    for(var i = 0;i < store.length;i++){
        if(this == store[i]){
            temp = i;
        }
    }

    if(temp == 0){
        storeSlider[0].style.transform = "translateY(-70px)";
        roomImg[0].style.opacity = "1";
        roomImg[1].style.opacity = "0";
        roomImg[2].style.opacity = "0";

        storeIconColor[0].style.filter = "brightness(1.4)";
        storeIconColor[1].style.filter = "brightness(1)";
        storeIconColor[2].style.filter = "brightness(1)";
        
        storeIconColor[0].style.opacity = "1";
        storeIconColor[1].style.opacity = "0.5";
        storeIconColor[2].style.opacity = "0.5";
        
        store[0].style.backgroundColor="#009c8c";
        store[1].style.backgroundColor="#f9c8b9";
        store[2].style.backgroundColor="#7fd1de";
        //store01.style.backgroundColor="#009c8c";
        //store02.style.backgroundColor="#f9c8b9";
        //store03.style.backgroundColor="#7fd1de";
        // console.log("中央店");
    }else if(temp == 1){
        storeSlider[0].style.transform = "translateY(-140px)";
        roomImg[0].style.opacity = "0";
        roomImg[1].style.opacity = "1";
        roomImg[2].style.opacity = "0";

        storeIconColor[0].style.filter = "brightness(1)";
        storeIconColor[1].style.filter = "brightness(1.4)";
        storeIconColor[2].style.filter = "brightness(1)";

        storeIconColor[0].style.opacity = "0.5";
        storeIconColor[1].style.opacity = "1";
        storeIconColor[2].style.opacity = "0.5";
        
        store[0].style.backgroundColor="#00d1bc";
        store[1].style.backgroundColor="#ef8575";
        store[2].style.backgroundColor="#7fd1de";
        //store01.style.backgroundColor="#00d1bc";
        //store02.style.backgroundColor="#ef8575";
        //store03.style.backgroundColor="#7fd1de";
        // console.log("桃園店");
    }else if(temp == 2){
        storeSlider[0].style.transform = "translateY(-210px)";
        roomImg[0].style.opacity = "0";
        roomImg[1].style.opacity = "0";
        roomImg[2].style.opacity = "1";

        storeIconColor[0].style.filter = "brightness(1)";
        storeIconColor[1].style.filter = "brightness(1)";
        storeIconColor[2].style.filter = "brightness(1.4)";

        storeIconColor[0].style.opacity = "0.5";
        storeIconColor[1].style.opacity = "0.5";
        storeIconColor[2].style.opacity = "1";
        
        store[0].style.backgroundColor="#00d1bc";
        store[1].style.backgroundColor="#f9c8b9";
        store[2].style.backgroundColor="#00b7ee";
        //store01.style.backgroundColor="#00d1bc";
        //store02.style.backgroundColor="#f9c8b9";
        //store03.style.backgroundColor="#00b7ee";
        // console.log("北投店")
    }
}


//選擇時段
var clock = document.getElementsByClassName("clock");
var clockSlider = document.getElementsByClassName("clockTextContainer");

for(var i = 0;i < clock.length;i++){
    clock[i].addEventListener("click",clockSlide);
    clock[i].addEventListener("click",clockCheck);
}

function clockSlide(){
    // clockvalueTempIndex = this.childNodes[1].childNodes[1].childNodes[1].src.split("/").length;
    // console.log(clockvalueTempIndex);
    // clockvalue = this.childNodes[1].childNodes[1].childNodes[1].src.split("/")[clockvalueTempIndex-1].split(".")[0];
    // console.log(this.childNodes[1].childNodes[1].childNodes[1].src.split("/")[4].split(".")[0]);
    // console.log(clockvalue);
    for(var i = 0;i < clock.length;i++){
        if(this == clock[i]){
            temp = i;
        }
    }

    if(temp == 0){
        clockSlider[0].style.transform = "translateY(-70px)";
        roomImg[0].style.filter = "brightness(1.2)";
        roomImg[1].style.filter = "brightness(1.2)";
        roomImg[2].style.filter = "brightness(1.2)";
        clockvalue = "morning";
    }else if(temp == 1){
        clockSlider[0].style.transform = "translateY(-140px)";
        roomImg[0].style.filter = "brightness(1)";
        roomImg[1].style.filter = "brightness(1)";
        roomImg[2].style.filter = "brightness(1)";
        clockvalue = "afternoon";
    }else if(temp == 2){
        clockSlider[0].style.transform = "translateY(-210px)";
        roomImg[0].style.filter = "brightness(0.8)";
        roomImg[1].style.filter = "brightness(0.8)";
        roomImg[2].style.filter = "brightness(0.8)";
        clockvalue = "night";
    }
    // console.log(clockvalue);
}

//選擇湯牌提示燈箱
function clockCheck(){
    if(roomvalue == ""){
        document.getElementById("smallLightBox_wrapper").style.visibility = "visible";
        document.querySelector("#smallLightBox_wrapper h3").innerHTML = "請先選擇分店哦!!!"
        // console.log(this.style.filter);
    }else if(this.style.filter == "brightness(0.5)"){
        document.getElementById("smallLightBox_wrapper").style.visibility = "visible";
        document.querySelector("#smallLightBox_wrapper h3").innerHTML = "此時段無法預約哦!!!"
    }
}

//選擇湯牌燈箱開關
// var lightboxOnBtn = document.getElementsByClassName("springCard");
// var lightboxOffBtn = document.getElementById("lightboxToggle");

// lightboxOnBtn[0].addEventListener("click",lightboxOn);
// lightboxOffBtn.addEventListener("click",lightboxOff);

function lightboxOn(){
    document.getElementById('lightbox_wrapper').style.visibility = "visible";
}

function lightboxOff(){
    document.getElementById('lightbox_wrapper').style.visibility = "hidden";
}

//提示燈箱開關
var smallLightboxOffBtn = document.querySelector("#smallLightBox_wrapper .nextStepBtn_d");

smallLightboxOffBtn.addEventListener("click",smallLightboxOff);

function smallLightboxOff(){
    document.getElementById('smallLightBox_wrapper').style.visibility = "hidden";
}