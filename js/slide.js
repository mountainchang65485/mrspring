// document.getElementsByClassName('rommtypeIcon01')[0].onclick = function(){

    
//     document.getElementsByClassName('an_roompic')[0].src ='images/01.PNG';
//     document.getElementsByClassName('text')[0].innerHTML ='中央店-煎餅房';
//     document.getElementsByClassName('an_roompic')[1].src = 'images/01.PNG';
//     document.getElementsByClassName('text')[1].innerHTML ='中央店-君山房';

//     }
// 幻燈片
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
        // slides[i].style.display = "block";
        // slides[i].style.visibility = "hidden";
        // slides[i].style.top = -400*i+"px";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    // slides[slideIndex - 1].style.visibility = "visible";
    dots[slideIndex - 1].className += " active";
}
// 自動撥放
// var slideIndex = 0;
// showSlides();
// function showSlides(){
// 	var slides = document.getElementsByClassName("mySlides");//獲取每組圖片
// var i;
// for( i=0; i < slides.length; i++){  //循環每組圖片隱藏
// 	slides[i].style.display="none";
// }
// slideIndex++;
// if( slideIndex > slides.length){ slideIndex=1} //判断slideIndex 顯示圖片
// slides[slideIndex-1].style.display="block";
// 	setTimeout(showSlides,2000)
// }
