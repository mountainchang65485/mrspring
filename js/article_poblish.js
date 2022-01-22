$(document).ready(function(){
	window_width = $(window).width();

});

//開燈箱桌機
var lightboxOnBtn = document.getElementsByClassName("springCard");
lightboxOnBtn[0].addEventListener("click",lightboxOn);
//開燈箱手機
document.getElementById('add_card').addEventListener("click",lightboxOn);
temp_card="";
title="";
text="";
if($('.bg').hasClass('edit_publish_bg')){
  // lightboxOn();
  for(var i=0;i<$('.card').length;i++){
    if($('.card').eq(i).attr("cardno")==$('.publish_l').attr('cardno')){
      $('.card').eq(i).addClass('card_selected');
      temp_card = $('.card').eq(i).parent().html();
      $('#add_card').html($('.card').eq(i).parent().html());
      $('.selected_card_data').html(temp_card);
      $('.selected_card_data').addClass('change_card');
      $('.change_card').click(lightboxOn);
      $('.springCard').css('display','none');
    }
  }
  
}
function lightboxOn(){//開燈箱
    document.getElementById('lightbox_wrapper').style.visibility = "visible";
    //讓畫面無法滑動
    $('body').css({
    	"height":"100vh",
      "over-flow":"hidden",
    });

    //點選到的牌子給class 使其變色
    $('.card').click(function(){
      $(".card").removeClass("card_selected");
      $(this).addClass("card_selected");
      temp_card = $(this).parent('.cards').html();//將點選到的牌子寫入temp
      if (window_width<=1200) {//手機時

        $("#lightbox_radar_btn").css("display","block");//當card被點選 會開啟雷達btn
  
        $("#lightbox_radar_btn").click(function(){
          $("#lightbox_radar").css("display","block");//雷達btn被點選開啟雷達圖
        });
        
        $("#lightbox_radar_close").click(function(){
          $("#lightbox_radar").css("display","none");//點選關閉將雷達圖關閉
        });
  
        // for(var i=0;i<$('.card').length;i++){
        //   if($('.card').eq(i).hasClass('card_selected')){
           
        //   }
        // }
        
      }
    });
    


    $('#nextStep').click(function(){
      $('#add_card').html(temp_card);
      $('.springCard').css('display','none');
      
      if (window_width<=768) {
        $('.selected_card_data').html(temp_card);
        $('.selected_card_data').addClass('change_card');
        $('.selected_card_data').css('margin-bottom','0px');
        $('.forum_wrap .article_publish').css('padding-top','10px');
        $('.change_card').click(lightboxOn);
        $("#lightbox_radar").css("display","none");
      }
      
      
    });

		$('#nextStep').click(function(){
      if (temp_card=="") {
        $('#alert p').text('請選取一張湯牌');
        $('#alert_wrap').css({
          "display":"block",
        });
        $('#alert_wrap .btn_s').click(function(){
          $('#alert_wrap').css({
            "display":"none",
          });
        });
      }else{
        $("#lightbox_wrapper").css("visibility","hidden");
        $('body').css({//畫面恢復可滾動
          "height":"auto",
        });
      }
      
      
    });
		
		
    

}

$('#addArtBtn').click(function(){
    if(temp_card==""){
      $('#alert p').text('請選取一張湯牌');
      $('#alert_wrap').css({
        "display":"block",
      });
      $('#alert_wrap .btn_s').click(function(){
        $('#alert_wrap').css({
          "display":"none",
        });
      });
    }else if ($("#addArt input:eq(0)").val()<1) {
      $('#alert p').text('尚未輸入文章標題');
      $('#alert_wrap').css({
        "display":"block",
      });
      $('#alert_wrap .btn_s').click(function(){
        $('#alert_wrap').css({
          "display":"none",
        });
      });
    }else if ($("#addArt textarea").val()<1) {
      $('#alert p').text('尚未輸入文章內容');
      $('#alert_wrap').css({
        "display":"block",
      });
      $('#alert_wrap .btn_s').click(function(){
        $('#alert_wrap').css({
          "display":"none",
        });
      });
    }else{
      $('#addArt').submit();
    }
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


