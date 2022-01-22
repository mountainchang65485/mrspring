$(document).ready(function(){
	window_width = $(window).width();

});

var lightboxOnTemp = 0;

//開燈箱桌機
var lightboxOnBtn = document.getElementsByClassName("springCard");
lightboxOnBtn[0].addEventListener("click",lightboxOn);
//開燈箱手機
document.getElementById('add_card').addEventListener("click",lightboxOn);

function lightboxOn(){//開燈箱
    var xhrMember = new  XMLHttpRequest();
    xhrMember.onreadystatechange = function(){
        if( xhrMember.readyState == 4){
            if( xhrMember.status == 200 ){
                if(xhrMember.responseText == 1){
                    checkMemberToOpen();
                }else{
                    document.getElementById("smallLightBox_wrapper").style.visibility = "visible";
                    document.querySelector("#smallLightBox_wrapper h3").innerHTML = "還沒登入哦!!!";
                }
            }else{
                alert( xhrMember.status );
            }
        }
    }
    var urlMember = "php/login_or_not.php";
    xhrMember.open("Get", urlMember, true);
    xhrMember.send( null );

    function checkMemberToOpen(){
      // temp_card = "";
      document.getElementById('lightbox_wrapper').style.visibility = "visible";
      //讓畫面無法滑動
      $('body').css({
        "height":"100vh",
        "over-flow":"hidden",
      });

      if(lightboxOnTemp == 0){
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(){
            if( xhr.readyState == 4){
                if( xhr.status == 200 ){
                    cardchange(xhr.responseText);
                }else{
                    alert( xhr.status );
                }
            }
        }

        var url = "php/yt_cardFilter.php?cardFilter=Choice 1";
        xhr.open("Get", url, true);
        xhr.send( null );
        lightboxOnTemp++;
      }

      

      if(window_width <= 768){
        document.querySelector(".chooseCard_d > h2").innerHTML = "選擇湯牌";
        document.querySelector(".chooseCard_d > h2").style.fontSize = "24px";
        document.querySelector(".chooseCard_d > h2").style.marginLeft = "10px";
      }
    }
}






$("select").on("click" , function() {
  
  $(this).parent(".select-box").toggleClass("open");
  
});

$(document).mouseup(function (e){
    var container = $(".select-box");

    if (container.has(e.target).length === 0)
    {
        container.removeClass("open");
    }
});


$("select").on("change" , function() {
  
  var selection = $(this).find("option:selected").text(),
      labelFor = $(this).attr("id"),
      label = $("[for='" + labelFor + "']");
    
  label.find(".label-desc").html(selection);
    
});

$('.responsive').slick({
  dots: false,
  prevArrow: $('.prev'),
  nextArrow: $('.next'),
  infinite: false,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 3,
  responsive: [
    {
      breakpoint: 1100,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 780,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      }
    }
  ]
});




//房間照片slider
$('.roomPicSlider_d').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 1,
  slidesToScroll: 1,
});