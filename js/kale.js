
var circle0 = document.getElementsByClassName("circle0");
var circle1 = document.getElementsByClassName("circle1");
var circle2 = document.getElementsByClassName("circle2");
var circle3 = document.getElementsByClassName("circle3");
var circle4 = document.getElementsByClassName("circle4");
var circle5 = document.getElementsByClassName("circle5");

//湯牌名稱
function changeCardName(){
    document.querySelector(".card .card_name").innerText = this.value;
}

//文字輸入變動處理+小色塊開關
function kale_type(){
    //文字長度不足時把後面的文字清空
    if(input_kale.value.length==6){        
        document.getElementById('colourpicker_1').style.display = "block";
        document.getElementById('colourpicker_2').style.display = "block";
        document.getElementById('colourpicker_3').style.display = "block";
        document.getElementById('colourpicker_4').style.display = "block";
        document.getElementById('colourpicker_5').style.display = "block";
        document.getElementById('colourpicker_6').style.display = "block";
    }

    if(input_kale.value.length==5){
        circles5Arr = document.querySelectorAll(".circle5 p");
        for(i = 0 ;i < circles5Arr.length;i++){
            circles5Arr[i].innerText = "";
        }
        
        document.getElementById('colourpicker_1').style.display = "block";
        document.getElementById('colourpicker_2').style.display = "block";
        document.getElementById('colourpicker_3').style.display = "block";
        document.getElementById('colourpicker_4').style.display = "block";
        document.getElementById('colourpicker_5').style.display = "block";
        document.getElementById('colourpicker_6').style.display = "none";
    }
    
    if(input_kale.value.length==4){
        circles4Arr = document.querySelectorAll(".circle4 p");
        for(i = 0 ;i < circles4Arr.length;i++){
            circles4Arr[i].innerText = "";
        }
        
        document.getElementById('colourpicker_1').style.display = "block";
        document.getElementById('colourpicker_2').style.display = "block";
        document.getElementById('colourpicker_3').style.display = "block";
        document.getElementById('colourpicker_4').style.display = "block";
        document.getElementById('colourpicker_5').style.display = "none";
        document.getElementById('colourpicker_6').style.display = "none";
    }
    
    if(input_kale.value.length==3){
        circles3Arr = document.querySelectorAll(".circle3 p");
        for(i = 0 ;i < circles3Arr.length;i++){
            circles3Arr[i].innerText = "";
        }
        
        document.getElementById('colourpicker_1').style.display = "block";
        document.getElementById('colourpicker_2').style.display = "block";
        document.getElementById('colourpicker_3').style.display = "block";
        document.getElementById('colourpicker_4').style.display = "none";
        document.getElementById('colourpicker_5').style.display = "none";
        document.getElementById('colourpicker_6').style.display = "none";
    }
    
    if(input_kale.value.length==2){
        circles2Arr = document.querySelectorAll(".circle2 p");
        for(i = 0 ;i < circles2Arr.length;i++){
            circles2Arr[i].innerText = "";
        }

        document.getElementById('colourpicker_1').style.display = "block";
        document.getElementById('colourpicker_2').style.display = "block";
        document.getElementById('colourpicker_3').style.display = "none";
        document.getElementById('colourpicker_4').style.display = "none";
        document.getElementById('colourpicker_5').style.display = "none";
        document.getElementById('colourpicker_6').style.display = "none";
    }
    
    if(input_kale.value.length==1){
        circles1Arr = document.querySelectorAll(".circle1 p");
        for(i = 0 ;i < circles1Arr.length;i++){
            circles1Arr[i].innerText = "";
        }

        document.getElementById('colourpicker_1').style.display = "block";
        document.getElementById('colourpicker_2').style.display = "none";
        document.getElementById('colourpicker_3').style.display = "none";
        document.getElementById('colourpicker_4').style.display = "none";
        document.getElementById('colourpicker_5').style.display = "none";
        document.getElementById('colourpicker_6').style.display = "none";
    }
    
    if(input_kale.value.length==0){
        circles0Arr = document.querySelectorAll(".circle0 p");
        for(i = 0 ;i < circles0Arr.length;i++){
            circles0Arr[i].innerText = "";
        }
        document.getElementById('colourpicker_1').style.display = "none";
        document.getElementById('colourpicker_2').style.display = "none";
        document.getElementById('colourpicker_3').style.display = "none";
        document.getElementById('colourpicker_4').style.display = "none";
        document.getElementById('colourpicker_5').style.display = "none";
        document.getElementById('colourpicker_6').style.display = "none";
    }

    //輸入時把文字放進去
    if(input_kale.value.length==0){
        circle0Arr = document.querySelectorAll(".circle0  p");
        for(i = 0 ;i < circle0Arr.length;i++){
            circle0Arr[i].innerText = '';
        }
        circle1Arr = document.querySelectorAll(".circle1  p");
        for(i = 0 ;i < circle1Arr.length;i++){
            circle1Arr[i].innerText = '';            
        }
        circle2Arr = document.querySelectorAll(".circle2  p");
        for(i = 0 ;i < circle2Arr.length;i++){
            circle2Arr[i].innerText = '';
        }
        circle3Arr = document.querySelectorAll(".circle3  p");
        for(i = 0 ;i < circle3Arr.length;i++){
            circle3Arr[i].innerText = '';
        }
        circle4Arr = document.querySelectorAll(".circle4  p");
        for(i = 0 ;i < circle4Arr.length;i++){
            circle4Arr[i].innerText = '';
        }
        circle5Arr = document.querySelectorAll(".circle5 p");
        for(i = 0 ;i < circle5Arr.length;i++){
            circle5Arr[i].innerText = '';
        }
    }
    if(input_kale.value.length>0){
        circle0Arr = document.querySelectorAll(".circle0  p");
        for(i = 0 ;i < circle0Arr.length;i++){
            circle0Arr[i].innerText = input_kale.value.charAt(0);
        }
        circle1Arr = document.querySelectorAll(".circle1  p");
        for(i = 0 ;i < circle1Arr.length;i++){
            circle1Arr[i].innerText = input_kale.value.charAt(1);  
        }
        circle2Arr = document.querySelectorAll(".circle2  p");
        for(i = 0 ;i < circle2Arr.length;i++){
            circle2Arr[i].innerText = input_kale.value.charAt(2);
        }
        circle3Arr = document.querySelectorAll(".circle3  p");
        for(i = 0 ;i < circle3Arr.length;i++){
            circle3Arr[i].innerText = input_kale.value.charAt(3);
        }
        circle4Arr = document.querySelectorAll(".circle4  p");
        for(i = 0 ;i < circle4Arr.length;i++){
            circle4Arr[i].innerText = input_kale.value.charAt(4);
        }
        circle5Arr = document.querySelectorAll(".circle5 p");
        for(i = 0 ;i < circle5Arr.length;i++){
            circle5Arr[i].innerText = input_kale.value.charAt(5);
        }
    }

    if(input_kale.value.length>1){
        circle1Arr = document.querySelectorAll(".circle1  p");
        for(i = 0 ;i < circle1Arr.length;i++){
            circle1Arr[i].innerText = input_kale.value.charAt(1);            
        }
        circle2Arr = document.querySelectorAll(".circle2  p");
        for(i = 0 ;i < circle2Arr.length;i++){
            circle2Arr[i].innerText = input_kale.value.charAt(2);
        }
        circle3Arr = document.querySelectorAll(".circle3  p");
        for(i = 0 ;i < circle3Arr.length;i++){
            circle3Arr[i].innerText = input_kale.value.charAt(3);
        }
        circle4Arr = document.querySelectorAll(".circle4  p");
        for(i = 0 ;i < circle4Arr.length;i++){
            circle4Arr[i].innerText = input_kale.value.charAt(4);
        }
        circle5Arr = document.querySelectorAll(".circle5 p");
        for(i = 0 ;i < circle5Arr.length;i++){
            circle5Arr[i].innerText = input_kale.value.charAt(5);
        }
    }

    if(input_kale.value.length>2){
        circle2Arr = document.querySelectorAll(".circle2  p");
        for(i = 0 ;i < circle2Arr.length;i++){
            circle2Arr[i].innerText = input_kale.value.charAt(2);
        }
        circle3Arr = document.querySelectorAll(".circle3  p");
        for(i = 0 ;i < circle3Arr.length;i++){
            circle3Arr[i].innerText = input_kale.value.charAt(3);
        }
        circle4Arr = document.querySelectorAll(".circle4  p");
        for(i = 0 ;i < circle4Arr.length;i++){
            circle4Arr[i].innerText = input_kale.value.charAt(4);
        }
        circle5Arr = document.querySelectorAll(".circle5 p");
        for(i = 0 ;i < circle5Arr.length;i++){
            circle5Arr[i].innerText = input_kale.value.charAt(5);
        }
    }

    if(input_kale.value.length>3){
        circle3Arr = document.querySelectorAll(".circle3  p");
        for(i = 0 ;i < circle3Arr.length;i++){
            circle3Arr[i].innerText = input_kale.value.charAt(3);
        }
        circle4Arr = document.querySelectorAll(".circle4  p");
        for(i = 0 ;i < circle4Arr.length;i++){
            circle4Arr[i].innerText = input_kale.value.charAt(4);
        }
        circle5Arr = document.querySelectorAll(".circle5 p");
        for(i = 0 ;i < circle5Arr.length;i++){
            circle5Arr[i].innerText = input_kale.value.charAt(5);
        }
    }

    if(input_kale.value.length>4){
        circle4Arr = document.querySelectorAll(".circle4 p");
        for(i = 0 ;i < circle4Arr.length;i++){
            circle4Arr[i].innerText = input_kale.value.charAt(4);
        }
        circle5Arr = document.querySelectorAll(".circle5 p");
        for(i = 0 ;i < circle5Arr.length;i++){
            circle5Arr[i].innerText = input_kale.value.charAt(5);
        }
    }

    if(input_kale.value.length>5){
        circle5Arr = document.querySelectorAll(".circle5 p");
        for(i = 0 ;i < circle5Arr.length;i++){
            circle5Arr[i].innerText = input_kale.value.charAt(5);
        }
    } 

}


//文字字體改變
function kale_font(){    
    for(i=0; i<document.querySelectorAll(".circle p").length; i++){
        document.querySelectorAll(".circle p")[i].style.fontFamily = `${font_select_kale.value}`;
    }
}

input_kale = document.getElementById("cardTextInput");
input_kale.addEventListener( "input" , kale_type );   

font_select_kale = document.getElementById("cardFontSelect");
font_select_kale.addEventListener("change" , kale_font );

document.getElementById('cardTitleInput').addEventListener('input',changeCardName);

$("#colourpicker_1").on("change",function(){
    $(".circle0").css("color",$("#colourpicker_1").colourPicker('val'));
}).change();
$("#colourpicker_2").on("change",function(){
    $(".circle1").css("color",$("#colourpicker_2").colourPicker('val'));
}).change();
$("#colourpicker_3").on("change",function(){
    $(".circle2").css("color",$("#colourpicker_3").colourPicker('val'));
}).change();
$("#colourpicker_4").on("change",function(){
    $(".circle3").css("color",$("#colourpicker_4").colourPicker('val'));
}).change();
$("#colourpicker_5").on("change",function(){
    $(".circle4").css("color",$("#colourpicker_5").colourPicker('val'));
}).change();
$("#colourpicker_6").on("change",function(){
    $(".circle5").css("color",$("#colourpicker_6").colourPicker('val'));
}).change();