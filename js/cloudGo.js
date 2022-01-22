var monkeyWrap = document.getElementById("monkey_wrap");
var x = document.getElementById("content_frame");
var colorsepia = document.getElementsByClassName("sepia_cross")[0];
var colorsepia02 = document.getElementsByClassName("sepia_cross")[1];
var colorsepia03 = document.getElementsByClassName("sepia_cross")[2];
var herbWrap = document.getElementsByClassName("herb")[0];
var monkey =  document.getElementById("mr_spring_for_firstpage");

var slogon01 = document.getElementById("slogon01");
var slogon02 = document.getElementById("slogon02");

//switch content=================================================================

var title = document.getElementById("spring_name");
var paragrah01 = document.getElementsByClassName("paragraph")[0];
var paragrah02 = document.getElementsByClassName("paragraph")[1];

var smallPic01 = document.getElementsByClassName("intro_pic_small")[0];
var smallPic02 = document.getElementsByClassName("intro_pic_small")[1];
var smallPic03 = document.getElementsByClassName("intro_pic_small")[2];

var waterColor = document.getElementById("water_color_change");
 var oriColors = {top:"#ff9f9f", bottom:"#fff09b"};

//animation=================================================================

var ZZZ = document.getElementsByClassName("note")[0];
var smoke01 = document.getElementsByClassName("sk_wrap")[0];
var smoke02 = document.getElementsByClassName("sk_wrap02")[0];
var monkeyFace = document.getElementById("monkeyFace");
var monkeyEyes = document.getElementById("monkeyEyes");
var wave01 = document.getElementById("wave01");
var wave02 = document.getElementById("wave02");


//first page Show Herb=================================================================

function getCoupon(){
    document.getElementById("peach").src="./images/getCoupon_red.svg";
}
function cleanCoupon(){
  document.getElementById("peach").src="./images/getCoupon2.svg";
}
 

function ShowHerb01() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
      if( xhr.readyState == 4){
        if( xhr.status == 200 ){

          var herb = JSON.parse(xhr.responseText);
          if (x.style.opacity == 0) {
            title.innerHTML = `${herb[0].effectTypeName}湯`;
            paragrah01.innerHTML = herb[0].effectTypeText;
            paragrah02.innerHTML = `【配方】${herb[0].itemName}、${herb[1].itemName}、${herb[2].itemName}。`;
            smallPic01.src = `${herb[0].itemImg2Url}`;
            smallPic02.src = `${herb[1].itemImg2Url}`;
            smallPic03.src = `${herb[2].itemImg2Url}`; 
          
            colorsepia.style.opacity = 0;
            colorsepia02.style.opacity = 1;
            colorsepia03.style.opacity = 1;
            x.style.opacity = 1;
            ZZZ.style.opacity = 0;
            monkeyFace.style.opacity = 0;
            monkeyEyes.style.opacity = 0;
            slogon01.style.opacity = 0;
            slogon02.style.opacity = 0;

            monkey.src="./images/monkey02.svg";
            monkey.style.marginBottom="30px";
            waterColor.style.backgroundColor = "#ff9f9f";
            herbWrap.style.marginTop="-25%";
            TweenMax.from("#content_frame", 2, { opacity: 0, ease: Power4.easeIn });
              
        
            if($(window).width()<=768 && $(window).width()>400){
              herbWrap.style.marginTop="-80%";
              monkeyWrap.style.opacity = 0;
              TweenMax.fromTo("#monkey_wrap", 2, {
                y: 0,
                repeat: 0,
                ease: Power1.easeInOut
              }, {
                  y:100,
                  repeat: 0,
                  ease: Power1.easeInOut,
                  // yoyo: true
                });
            }
            else if($(window).width()==768 && $(window).height()==1024){
              
              herbWrap.style.marginTop="-40%";
              TweenMax.fromTo("#monkey_wrap", 2, {
                x: 0,
                repeat: 0,
                ease: Power1.easeInOut
              }, {
                  x: -150,
                  repeat: 0,
                  ease: Power1.easeInOut,
                  yoyo: true
                });
        
            }
            else if($(window).width()<400 && $(window).height()<768){
              
              herbWrap.style.marginTop="-95%";
              
              monkeyWrap.style.opacity = 0;
        
            }
            else if($(window).width()<400 && $(window).height()<900){
              
              herbWrap.style.marginTop="-95%";
              TweenMax.fromTo("#monkey_wrap", 2, {
                y: 0,
                repeat: 0,
                ease: Power1.easeInOut
              }, {
                  y: 100,
                  repeat: 0,
                  ease: Power1.easeInOut,
                  yoyo: true
                });
        
            }
            else if($(window).width()>=400 && $(window).height()<=900){
              
              herbWrap.style.marginTop="-30%";
              monkeyWrap.style.opacity = 0;
              TweenMax.fromTo("#monkey_wrap", 2, {
                y: 0,
                repeat: 0,
                ease: Power1.easeInOut
              }, {
                  y: 100,
                  repeat: 0,
                  ease: Power1.easeInOut,
                  yoyo: true
                });
        
            }
            else if($(window).width()<=1024 && $(window).height()==1366 ){
              TweenMax.fromTo("#monkey_wrap", 2, {
                x: 0,
                repeat: 0,
                ease: Power1.easeInOut
              }, {
                  x: 0,
                  repeat: 0,
                  ease: Power1.easeInOut,
                  yoyo: true
                });
        
            }
            else{
              TweenMax.fromTo("#monkey_wrap", 2, {
                x: 0,
                repeat: 0,
                ease: Power1.easeInOut
              }, {
                  x: -300,
                  repeat: 0,
                  ease: Power1.easeInOut,
                  yoyo: true
                });
            }
           
          } 
          else {
            title.innerHTML = `${herb[0].effectTypeName}湯`;
            paragrah01.innerHTML = herb[0].effectTypeText;
            paragrah02.innerHTML = `【配方】${herb[0].itemName}、${herb[1].itemName}、${herb[2].itemName}。`;
            smallPic01.src = `${herb[0].itemImg2Url}`;
            smallPic02.src = `${herb[1].itemImg2Url}`;
            smallPic03.src = `${herb[2].itemImg2Url}`; 
        
            colorsepia.style.opacity = 0;
            colorsepia02.style.opacity = 1;
            colorsepia03.style.opacity = 1;
            ZZZ.style.opacity = 0;
            monkeyFace.style.opacity = 0;
            monkeyEyes.style.opacity = 0;
            slogon01.style.opacity = 0;
            slogon02.style.opacity = 0;
            // herbWrap.style.marginTop="-30%";
            monkey.src="./images/monkey02.svg";
            monkey.style.marginBottom="30px";
            waterColor.style.backgroundColor = "#ff9f9f";
            TweenMax.from("#spring_name", 1, { opacity: 0, ease: Power3.easeIn });
            TweenMax.from(".paragraph", 1, { opacity: 0, ease: Power3.easeIn });
            TweenMax.from(".intro_pic_small", 1, { opacity: 0, ease: Power1.easeIn });
          }
          
        }else{
          alert( xhr.status );
        }
      }
  }

  var url = "php/mt_getHerb.php";
  xhr.open("Get", url, true);
  xhr.send( null );
}


function ShowHerb02() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
      if( xhr.readyState == 4){
        if( xhr.status == 200 ){

          var herb = JSON.parse(xhr.responseText);
          if (x.style.opacity == 0) {
    
            title.innerHTML = `${herb[3].effectTypeName}湯`;
            paragrah01.innerHTML = herb[3].effectTypeText;
            paragrah02.innerHTML = `【配方】${herb[3].itemName}、${herb[4].itemName}、${herb[5].itemName}。`;
            smallPic01.src = `${herb[3].itemImg2Url}`;
            smallPic02.src = `${herb[4].itemImg2Url}`;
            smallPic03.src = `${herb[5].itemImg2Url}`; 
        
            colorsepia.style.opacity = 1;
            colorsepia02.style.opacity = 0;
            colorsepia03.style.opacity = 1;
            ZZZ.style.opacity = 1;
            monkeyFace.style.opacity = 0;
            monkeyEyes.style.opacity = 0;
            slogon01.style.opacity = 0;
            slogon02.style.opacity = 0;
            herbWrap.style.marginTop="-25%";
            
            monkey.src="./images/monkey01.svg";
            waterColor.style.backgroundColor = " #f6ae54";
            x.style.opacity = 1;
            TweenMax.from("#content_frame", 2, { opacity: 0, ease: Power4.easeIn });
           
            if($(window).width()<768 && $(window).width()>400){
              herbWrap.style.marginTop="-80%";
              monkeyWrap.style.opacity = 0;
              TweenMax.fromTo("#monkey_wrap", 2, {
                y: 0,
                repeat: 0,
                ease: Power1.easeInOut
              }, {
                  y:100,
                  repeat: 0,
                  ease: Power1.easeInOut,
                  // yoyo: true
                });
            }
            else if($(window).width()==768 && $(window).height()==1024){
              
              herbWrap.style.marginTop="-40%";
              TweenMax.fromTo("#monkey_wrap", 2, {
                x: 0,
                repeat: 0,
                ease: Power1.easeInOut
              }, {
                  x: -150,
                  repeat: 0,
                  ease: Power1.easeInOut,
                  yoyo: true
                });
        
            }
            else if($(window).width()<400 && $(window).height()<768){
              
              herbWrap.style.marginTop="-95%";
              
              monkeyWrap.style.opacity = 0;
        
            }
            else if($(window).width()<400 && $(window).height()<900){
              
              herbWrap.style.marginTop="-95%";
              TweenMax.fromTo("#monkey_wrap", 2, {
                y: 0,
                repeat: 0,
                ease: Power1.easeInOut
              }, {
                  y: 100,
                  repeat: 0,
                  ease: Power1.easeInOut,
                  yoyo: true
                });
        
            }
            else if($(window).width()>=400 && $(window).height()<=900){
              
              herbWrap.style.marginTop="-30%";
              monkeyWrap.style.opacity = 0;
              TweenMax.fromTo("#monkey_wrap", 2, {
                y: 0,
                repeat: 0,
                ease: Power1.easeInOut
              }, {
                  y: 100,
                  repeat: 0,
                  ease: Power1.easeInOut,
                  yoyo: true
                });
        
            }
            // else if($(window).width()<=320){
            //   herbWrap.style.bottom="200%";
        
            // }
            else if($(window).width()<=1024 && $(window).height()==1366 ){
              TweenMax.fromTo("#monkey_wrap", 2, {
                x: 0,
                repeat: 0,
                ease: Power1.easeInOut
              }, {
                  x: 0,
                  repeat: 0,
                  ease: Power1.easeInOut,
                  yoyo: true
                });
        
            }else{
              TweenMax.fromTo("#monkey_wrap", 2, {
                x: 0,
                repeat: 0,
                ease: Power1.easeInOut
              }, {
                  x: -300,
                  repeat: 0,
                  ease: Power1.easeInOut,
                  yoyo: true
                });
            
            }
            
          } else {
            
            title.innerHTML = `${herb[3].effectTypeName}湯`;
            paragrah01.innerHTML = herb[3].effectTypeText;
            paragrah02.innerHTML = `【配方】${herb[3].itemName}、${herb[4].itemName}、${herb[5].itemName}。`;
            smallPic01.src = `${herb[3].itemImg2Url}`;
            smallPic02.src = `${herb[4].itemImg2Url}`;
            smallPic03.src = `${herb[5].itemImg2Url}`; 
        
            colorsepia.style.opacity = 1;
            colorsepia02.style.opacity = 0;
            colorsepia03.style.opacity = 1;
            ZZZ.style.opacity = 1;
            monkeyFace.style.opacity = 0;
            monkeyEyes.style.opacity = 0;
            slogon01.style.opacity = 0;
            slogon02.style.opacity = 0;
            waterColor.style.backgroundColor = " #f6ae54";
            // herbWrap.style.marginTop="-30%";
            monkey.src="./images/monkey01.svg";
            TweenMax.from("#spring_name", 1, { opacity: 0, ease: Power1.easeIn });
            TweenMax.from(".paragraph", 1, { opacity: 0, ease: Power1.easeIn });
            TweenMax.from(".intro_pic_small", 1, { opacity: 0, ease: Power1.easeIn });
            // monkeyWrap.style.left="0";
            
          }
          
        }else{
          alert( xhr.status );
        }
      }
  }

  var url = "php/mt_getHerb.php";
  xhr.open("Get", url, true);
  xhr.send( null );
}




function ShowHerb03() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
      if( xhr.readyState == 4){
        if( xhr.status == 200 ){

          var herb = JSON.parse(xhr.responseText);
          if (x.style.opacity == 0) {
            title.innerHTML = `${herb[6].effectTypeName}湯`;
            paragrah01.innerHTML = herb[6].effectTypeText;
            paragrah02.innerHTML = `【配方】${herb[6].itemName}、${herb[7].itemName}、${herb[8].itemName}。`;
            smallPic01.src = `${herb[6].itemImg2Url}`;
            smallPic02.src = `${herb[7].itemImg2Url}`;
            smallPic03.src = `${herb[8].itemImg2Url}`; 
            
            monkey.src="./images/monkey01.svg";
            colorsepia.style.opacity = 1;
            colorsepia02.style.opacity = 1;
            colorsepia03.style.opacity = 0;
            ZZZ.style.opacity = 0;
            monkeyFace.style.opacity = 1;
            monkeyEyes.style.opacity = 1;
            slogon01.style.opacity = 0;
            slogon02.style.opacity = 0;
            herbWrap.style.marginTop="-25%";
            waterColor.style.backgroundColor = "#00e5be";
            x.style.opacity = 1;
            TweenMax.from("#content_frame", 2, { opacity: 0, ease: Power4.easeIn });  
            TweenMax.from("#monkeyFace", 2, { opacity: 0, ease: Power4.easeIn });
            TweenMax.from("#monkeyEyes", 2, { opacity: 0, ease: Power4.easeIn });
            
            
            if($(window).width()<=768 && $(window).width()>400){
              herbWrap.style.marginTop="-80%";
              monkeyWrap.style.opacity = 0;
              TweenMax.fromTo("#monkey_wrap", 2, {
                y: 0,
                repeat: 0,
                ease: Power1.easeInOut
              }, {
                  y:100,
                  repeat: 0,
                  ease: Power1.easeInOut,
                  // yoyo: true
                });
            }
            else if($(window).width()==768 && $(window).height()==1024){
              
              herbWrap.style.marginTop="-40%";
              TweenMax.fromTo("#monkey_wrap", 2, {
                x: 0,
                repeat: 0,
                ease: Power1.easeInOut
              }, {
                  x: -150,
                  repeat: 0,
                  ease: Power1.easeInOut,
                  yoyo: true
                });
        
            }
            else if($(window).width()<400 && $(window).height()<768){
              
              herbWrap.style.marginTop="-95%";
              
              monkeyWrap.style.opacity = 0;
        
            }
            else if($(window).width()<400 && $(window).height()<900){
              
              herbWrap.style.marginTop="-95%";
              TweenMax.fromTo("#monkey_wrap", 2, {
                y: 0,
                repeat: 0,
                ease: Power1.easeInOut
              }, {
                  y: 100,
                  repeat: 0,
                  ease: Power1.easeInOut,
                  yoyo: true
                });
        
            }
            else if($(window).width()>=400 && $(window).height()<=900){
              
              herbWrap.style.marginTop="-30%";
              monkeyWrap.style.opacity = 0;
              TweenMax.fromTo("#monkey_wrap", 2, {
                y: 0,
                repeat: 0,
                ease: Power1.easeInOut
              }, {
                  y: 100,
                  repeat: 0,
                  ease: Power1.easeInOut,
                  yoyo: true
                });
        
            }
            else if($(window).width()<=1024 && $(window).height()==1366 ){
              TweenMax.fromTo("#monkey_wrap", 2, {
                x: 0,
                repeat: 0,
                ease: Power1.easeInOut
              }, {
                  x: 0,
                  repeat: 0,
                  ease: Power1.easeInOut,
                  yoyo: true
                });
        
            }else{
              TweenMax.fromTo("#monkey_wrap", 2, {
                x: 0,
                repeat: 0,
                ease: Power1.easeInOut
              }, {
                  x: -300,
                  repeat: 0,
                  ease: Power1.easeInOut,
                  yoyo: true
                });
            }
        
            
          } else {
            title.innerHTML = `${herb[6].effectTypeName}湯`;
            paragrah01.innerHTML = herb[6].effectTypeText;
            paragrah02.innerHTML = `【配方】${herb[6].itemName}、${herb[7].itemName}、${herb[8].itemName}。`;
            smallPic01.src = `${herb[6].itemImg2Url}`;
            smallPic02.src = `${herb[7].itemImg2Url}`;
            smallPic03.src = `${herb[8].itemImg2Url}`; 
            
            monkey.src="./images/monkey01.svg";
            colorsepia.style.opacity = 1;
            colorsepia02.style.opacity = 1;
            colorsepia03.style.opacity = 0;
            ZZZ.style.opacity = 0;
            monkeyFace.style.opacity = 1;
            monkeyEyes.style.opacity = 1;
            slogon01.style.opacity = 0;
            slogon02.style.opacity = 0;
            // herbWrap.style.marginTop="-30%";
            waterColor.style.backgroundColor = "#00e5be";
            TweenMax.from("#monkeyFace", 1, { opacity: 0, ease: Power1.easeIn });
            TweenMax.from("#monkeyEyes", 1, { opacity: 0, ease: Power1.easeIn });
            TweenMax.from("#spring_name", 1, { opacity: 0, ease: Power1.easeIn });
            TweenMax.from(".paragraph", 1, { opacity: 0, ease: Power1.easeIn });
            TweenMax.from(".intro_pic_small", 1, { opacity: 0, ease: Power1.easeIn });
            
          }
          
        }else{
          alert( xhr.status );
        }
      }
  }

  var url = "php/mt_getHerb.php";
  xhr.open("Get", url, true);
  xhr.send( null );
}


// var slogon=document.getElementById("slogon01");
//   function showSlogon(){
    
//   }
// TweenMax.from("#slogon01", 2, { opacity: 0, ease: Power4.easeIn }); 


function showDiv() {
  document.getElementsByClassName("herb_cross")[0].onclick = ShowHerb01;
  document.getElementById("herb_cross2").onclick = ShowHerb02;
  document.getElementsByClassName("herb_cross")[1].onclick = ShowHerb03;
  document.getElementsByClassName("getCoupon")[0].onmouseover=getCoupon;
  document.getElementsByClassName("getCoupon")[0].onmouseleave=cleanCoupon;
}

window.addEventListener("load", showDiv, false);

//animation=================================================================

TweenMax.fromTo(".herb_cross", 2, {
  y: 10,
  repeat: -1,
  ease: Power1.easeInOut
}, {
    y: 40,
    repeat: -1,
    ease: Power1.easeInOut,
    yoyo: true
  });

TweenMax.fromTo("#herb_cross2", 2, {
  y: 40,
  repeat: -1,
  ease: Power1.easeInOut
}, {
    y: 10,
    repeat: -1,
    ease: Power1.easeInOut,
    yoyo: true
  });

  
TweenMax.fromTo("#monkey_wrap", 2, {
  y: 10,
  repeat: -1,
  ease: Power1.easeInOut
}, {
    y: 20,
    repeat: -1,
    ease: Power1.easeInOut,
    yoyo: true

  });


TweenMax.fromTo("#wave01", 2, { opacity: 0, ease: Power4.easeIn }, { opacity: 0.8, ease: Power4.easeOut });

TweenMax.fromTo("#wave02", 2, { opacity: 0, ease: Power4.easeIn }, { opacity: 0.8, ease: Power4.easeOut });

