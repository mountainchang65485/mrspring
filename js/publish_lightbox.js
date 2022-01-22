var lightboxOnBtn = document.getElementsByClassName("springCard");
var lightboxOffBtn = document.getElementById("lightboxToggle");


lightboxOnBtn[0].addEventListener("click",lightboxOn);
lightboxOffBtn.addEventListener("click",lightboxOff);
document.getElementById('add_card').addEventListener("click",lightboxOn);
function lightboxOn(){
    document.getElementById('lightbox_wrapper').style.visibility = "visible";
    $(".card").click(function(){
      $('#nextStep').click(function(){
        $("#lightbox_wrapper").css("visibility","hidden");
      });
      /*選到的卡給class*/
      $(".card").removeClass("card_selected");
      $(this).addClass("card_selected");
    });
}

function lightboxOff(){
    document.getElementById('lightbox_wrapper').style.visibility = "hidden";

}




/*----------*/
$(document).ready(function(){
  /*點確定關閉燈箱*/
  
});

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
