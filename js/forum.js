

$(document).ready(function(){
	
	/*---hot_forum_zoom-----*/
	$('.hot_forum_box1 .card').addClass('zoom_in');
	$('.hot_forum_box1 .card').removeClass('zoom_out');
	/*-----湯牌去圖------*/
	
	/*-----hot_forum fall*/
	$('.hot_forum_box1 .hot_forum_hidden').css({
		"max-width":"0",
	});
	$('.hot_forum_box1 .hot_forum_hidden').delay(800).animate({
		"max-width":"1000",
	});


	function rand(min,max){
		var a=Math.floor( Math.random()*(max-min-1)+min);
		return a;
	}


	$(".card .knot").before("<div class='rope'></div>");
	$('.rope').append("<img src='images/rope.png'><img src='images/rope.png'><img src='images/rope.png'><img src='images/rope.png'><img src='images/rope.png'><img src='images/rope.png'><img src='images/rope.png'><img src='images/rope.png'><img src='images/rope.png'>")
	


	$('.hot_forum_box').css("top","-800px");
	
	$('.hot_forum_box1').animate({
		"top": '50',
	},rand(200,500),);
	$('.hot_forum_box1').animate({
		"top": '-50',
	},rand(200,500),);
	$('.hot_forum_box1').animate({
		"top": '20',
	},rand(200,500),);
	$('.hot_forum_box1').animate({
		"top": '0',
	},rand(200,500),);

	$('.hot_forum_box2').animate({
		"top": '50',
	},rand(200,500),);
	$('.hot_forum_box2').animate({
		"top": '-50',
	},rand(200,500),);
	$('.hot_forum_box2').animate({
		"top": '20',
	},rand(200,500),);
	$('.hot_forum_box2').animate({
		"top": '0',
	},rand(200,500),);

	$('.hot_forum_box3').animate({
		"top": '50',
	},rand(200,500),);
	$('.hot_forum_box3').animate({
		"top": '-50',
	},rand(200,500),);
	$('.hot_forum_box3').animate({
		"top": '20',
	},rand(200,500),);
	$('.hot_forum_box3').animate({
		"top": '0',
	},rand(200,500),);
	


	/*-----hot_forum_slide--------*/
	var sequence = 1; 
	var screen = $(window).width();
	$("#prev").click(function(){
		if (sequence==1) {
			sequence = 3;
			$(".hot_forum_box1 .hot_forum").css({
				left:-2000,
				opacity: 0,
			});
			$(".hot_forum_box2 .hot_forum").css({
				left:-2000,
				opacity: 0,
			});
			$(".hot_forum_box3 .hot_forum").css({
				left:0,
				opacity: 1,
			});
			$(".hot_forum_box1").css('z-index',"11");
			$(".hot_forum_box3").css('z-index',"999");
			$(".hot_forum_box2").css('z-index',"10");
			if (screen >= 1200) {
				
				$(".hot_forum_box1").stop(false,true).animate({
					'left':10,
				});
				
				$(".hot_forum_box3").stop(false,true).animate({
					'left':100,
				});
				$(".hot_forum_box2").stop(false,true).animate({
					'left':966,
				});
			}else if(screen >=768 && screen<1200){
				$(".hot_forum_box1").stop(false,true).animate({
					'left':10,
				});
				
				$(".hot_forum_box3").stop(false,true).animate({
					'left':screen*0.95*0.14,
				});
				$(".hot_forum_box2").stop(false,true).animate({
					'left':screen*0.95-224,
				});
			}else{
				$(".hot_forum_box1").stop(false,true).animate({
					'left':10,
				});
				
				$(".hot_forum_box3").stop(false,true).animate({
					'left':screen*0.95*0.5-112,
				});
				$(".hot_forum_box2").stop(false,true).animate({
					'left':screen*0.95-224,
				});
			}
			
			

			$(".hot_forum_box1 .card").addClass('zoom_out');
			$(".hot_forum_box2 .card").addClass('zoom_out');
			$(".hot_forum_box3 .card").addClass('zoom_in');
			$(".hot_forum_box3 .card").removeClass('zoom_out');
		}else if(sequence==2){
			sequence = 1;
			
			$(".hot_forum_box1 .hot_forum").css({
				left:0,
				opacity: 1,
			});
			$(".hot_forum_box2 .hot_forum").css({
				left:-2000,
				opacity: 0,
			});
			$(".hot_forum_box3 .hot_forum").css({
				left:-2000,
				opacity: 0,
			});
			$(".hot_forum_box1").css('z-index',"999");
			$(".hot_forum_box3").css('z-index',"10");
			$(".hot_forum_box2").css('z-index',"11");
			if (screen>=1200) {
				$(".hot_forum_box1").stop(false,true).animate({
					'left':100,
				});
				$(".hot_forum_box2").stop(false,true).animate({
					'left':10,
				});
				$(".hot_forum_box3").stop(false,true).animate({
					'left':966,
				});
			}else if(screen>=768 && screen < 1200){
				$(".hot_forum_box1").stop(false,true).animate({
					'left':screen*0.95*0.14,
				});
				$(".hot_forum_box2").stop(false,true).animate({
					'left':10,
				});
				$(".hot_forum_box3").stop(false,true).animate({
					'left':screen*0.95-224,
				});
			}else{
				$(".hot_forum_box1").stop(false,true).animate({
					'left':screen*0.95*0.5-112,
				});
				$(".hot_forum_box2").stop(false,true).animate({
					'left':10,
				});
				$(".hot_forum_box3").stop(false,true).animate({
					'left':screen*0.95-224,
					
				});
			}
			
			

			$(".hot_forum_box1 .card").addClass('zoom_in');
			$(".hot_forum_box2 .card").addClass('zoom_out');
			$(".hot_forum_box3 .card").addClass('zoom_out');
			$(".hot_forum_box1 .card").removeClass('zoom_out');
		}else{
			sequence = 2;
			$(".hot_forum_box1 .hot_forum").css({
				left:-2000,
				opacity: 0,
			});
			$(".hot_forum_box2 .hot_forum").css({
				left:0,
				opacity: 1,
			});
			$(".hot_forum_box3 .hot_forum").css({
				left:-2000,
				opacity: 0,
			});
			$(".hot_forum_box1").css('z-index',"10");
			$(".hot_forum_box3").css('z-index',"11");
			$(".hot_forum_box2").css('z-index',"999");
			if (screen>=1200) {
				$(".hot_forum_box1").stop(false,true).animate({
					'left':966,
					'z-index':11,
				});
				$(".hot_forum_box2").stop(false,true).animate({
					'left':100,
					'z-index':999,
				});
				$(".hot_forum_box3").stop(false,true).animate({
					'left':10,
					'z-index':10,
				});
			}else if(screen>=768 && screen<1200){
				$(".hot_forum_box1").stop(false,true).animate({
					'left':screen*0.95-224,
					'z-index':10,
				});
				$(".hot_forum_box2").stop(false,true).animate({
					'left':screen*0.95*0.14,
					'z-index':999,
				});
				$(".hot_forum_box3").stop(false,true).animate({
					'left':10,
					'z-index':11,
				});
			}else if(screen<768){
				$(".hot_forum_box1").stop(false,true).animate({
					'left':screen*0.95-224,
					'z-index':10,
				});
				$(".hot_forum_box2").stop(false,true).animate({
					'left':screen*0.95*0.5-112,
					'z-index':999,
				});
				$(".hot_forum_box3").stop(false,true).animate({
					'left':10,
					'z-index':11,
				});
			}
			
			

			$(".hot_forum_box1 .card").addClass('zoom_out');
			$(".hot_forum_box2 .card").addClass('zoom_in');
			$(".hot_forum_box3 .card").addClass('zoom_out');
			$(".hot_forum_box2 .card").removeClass('zoom_out');
		}
		
	});
	$("#next").click(function(){
		if (sequence==1) {
			sequence = 2;
			$(".hot_forum_box1 .hot_forum").css({
				left:-2000,
				opacity: 0,
			});
			$(".hot_forum_box3 .hot_forum").css({
				left:-2000,
				opacity: 0,
			});
			$(".hot_forum_box2 .hot_forum").css({
				left:0,
				opacity: 1,
			});

			$(".hot_forum_box1").css('z-index',"11");
			$(".hot_forum_box3").css('z-index',"10");
			$(".hot_forum_box2").css('z-index',"999");
			if(screen>=1200){
				$(".hot_forum_box2").stop(false,true).animate({
					'left':100,
				});
				$(".hot_forum_box3").stop(false,true).animate({
					'left':10,
				});
				$(".hot_forum_box1").stop(false,true).animate({
					'left':966,
				});
			}else if(screen>=768 && screen<1200) {
				$(".hot_forum_box2").stop(false,true).animate({
					'left':screen*0.95*0.14,
				});
				$(".hot_forum_box3").stop(false,true).animate({
					'left':10,
				});
				$(".hot_forum_box1").stop(false,true).animate({
					'left':screen*0.95-224,
				});
			}else if(screen<768) {
				$(".hot_forum_box2").stop(false,true).animate({
					'left':screen*0.95*0.5-112,
				});
				$(".hot_forum_box3").stop(false,true).animate({
					'left':10,
				});
				$(".hot_forum_box1").stop(false,true).animate({
					'left':screen*0.95-224,
				});
			}
			
			
			
			$(".hot_forum_box2 .card").addClass('zoom_in');
			$(".hot_forum_box1 .card").addClass('zoom_out');
			$(".hot_forum_box3 .card").addClass('zoom_out');
			
			$(".hot_forum_box2 .card").removeClass('zoom_out');
		}else if(sequence==2){
			sequence = 3;
			
			$(".hot_forum_box3 .hot_forum").css({
				left:0,
				opacity: 1,
			});
			$(".hot_forum_box2 .hot_forum").css({
				left:-2000,
				opacity: 0,
			});
			$(".hot_forum_box1 .hot_forum").css({
				left:-2000,
				opacity: 0,
			});

			$(".hot_forum_box1").css('z-index',"10");
			$(".hot_forum_box3").css('z-index',"999");
			$(".hot_forum_box2").css('z-index',"11");
			if(screen>=1200){
				$(".hot_forum_box3").stop(false,true).animate({
					'left':100,
				});
				$(".hot_forum_box1").stop(false,true).animate({
					'left':10,
				});
				$(".hot_forum_box2").stop(false,true).animate({
					'left':966,
				});
			}else if(screen>=768 && screen<1200) {
				$(".hot_forum_box3").stop(false,true).animate({
					'left':screen*0.95*0.14,
				});
				$(".hot_forum_box1").stop(false,true).animate({					
					'left':10,
				});
				$(".hot_forum_box2").stop(false,true).animate({
					'left':screen*0.95-224,
				});
			}else if(screen<768) {
				$(".hot_forum_box3").stop(false,true).animate({
					'left':screen*0.95*0.5-112,
				});
				$(".hot_forum_box1").stop(false,true).animate({					
					'left':10,
				});
				$(".hot_forum_box2").stop(false,true).animate({
					'left':screen*0.95-224,
				});
			}
			
			

			$(".hot_forum_box3 .card").addClass('zoom_in');
			$(".hot_forum_box2 .card").addClass('zoom_out');
			$(".hot_forum_box1 .card").addClass('zoom_out');
			$(".hot_forum_box3 .card").removeClass('zoom_out');
		}else{
			sequence = 1;
			$(".hot_forum_box2 .hot_forum").css({
				left:-2000,
				opacity: 0,
			});
			$(".hot_forum_box1 .hot_forum").css({
				left:0,
				opacity: 1,
			});
			$(".hot_forum_box3 .hot_forum").css({
				left:-2000,
				opacity: 0,
			});


			$(".hot_forum_box1").css('z-index',"999");
			$(".hot_forum_box3").css('z-index',"11");
			$(".hot_forum_box2").css('z-index',"10");
			if(screen>=1200){
				$(".hot_forum_box1").stop(false,true).animate({
				'left':100,
				});
				$(".hot_forum_box2").stop(false,true).animate({
					'left':10,
				});
				$(".hot_forum_box3").stop(false,true).animate({
					'left':966,
				});
			}else if(screen>=768 && screen<1200) {
				$(".hot_forum_box1").stop(false,true).animate({
					'left':screen*0.95*0.14,
				});
				$(".hot_forum_box2").stop(false,true).animate({					
					'left':10,
				});
				$(".hot_forum_box3").stop(false,true).animate({
					'left':screen*0.95-224,
				});
			}else if(screen<768) {
				$(".hot_forum_box1").stop(false,true).animate({
					'left':screen*0.95*0.5-112,
				});
				$(".hot_forum_box2").stop(false,true).animate({					
					'left':10,
				});
				$(".hot_forum_box3").stop(false,true).animate({
					'left':screen*0.95-224,
				});
			}
			
			

			$(".hot_forum_box2 .card").addClass('zoom_out');
			$(".hot_forum_box1 .card").addClass('zoom_in');
			$(".hot_forum_box3 .card").addClass('zoom_out');
			$(".hot_forum_box1 .card").removeClass('zoom_out');
		}
	});
	/*--card link--*/
	if ($(window).width()<=768) {
		$(".card").bind('click',function (){
			$(this).siblings(".readMore").submit();
			event.stopPropagation(); 
		});
	}
	
	/*   forum link   */
	$(".forum_content").off('click').click(function (){
		$(this).children(".readMore").submit();
	});

	/*---mobile filter---*/




	$(document).ready(function(){

		if ($(window).width()<=768) {
			$(document).scroll(function(){
				var scroll_h = $(document).scrollTop();
				// console.log(scroll_h);
				if(scroll_h >= 750){
					$("#filter_wrap").css('display','flex');
					$("#mobile_filter").css('display','flex');
				}else if(scroll_h < 750){
					$("#filter_wrap").css('display','none');
					$("#mobile_filter").css('display','none');
				}
			});
			$("#filter_btn").click(function() {
				$('.filter_kind').addClass('filter_open');
				$('.filter_item').addClass('filter_open');
				$('#mobile_filter_mask').css('display','block');
			});
			$("#sort_btn").click(function() {
				$('.sort_wrap').addClass('filter_open');
				$('#mobile_filter_mask').css('display','block');
			});
	/* 被選到打勾  */
			var kindarr=[];
			$(".filter_kind li").click(function() {
				let checked = $(this).children('img').hasClass('checked');
				if(checked){
					$(this).children('img').removeClass('checked');
					kindarr[0]="";
				}else{
					$(".filter_kind li").children('img').removeClass('checked');
					$(this).children('img').addClass('checked');
					kindarr[0] = $(this).children('span').attr('class');
				}
				$('.forum').css("display",'none');
				for(var i=0;i<$('.forum').length;i++){
					if ($('.forum').eq(i).hasClass(kindarr[0])) {
						$('.forum').eq(i).css("display",'block');
					}
				}
				// console.log(kindarr);
				if(kindarr[0]==""){
					$('.forum').css("display",'block');
				}
			});
			var itemNum = 0;
			$(".filter_item li").click(function() {
				let checked = $(this).children('img').hasClass('checked');
				if(checked){
					
						$(this).children('img').removeClass('checked');
						itemNum--;
					
					
				}else{
					if(itemNum<=3){
						$(this).children('img').addClass('checked');
						itemNum++;
					}
				}
			});
			$('.sort_wrap li').click(function(){
				$('.sort_wrap li img').removeClass('checked');
				$(this).children('img').addClass('checked');
			});
	/*filter_mask*/
			$('#mobile_filter_mask').click(function(){
				$('.filter_kind').removeClass('filter_open');
				$('.filter_item').removeClass('filter_open');
				$('.sort_wrap').removeClass('filter_open');
				$('#mobile_filter_mask').css("display","none");
			});
		}
		
	});		



	/*----1200 filter*/

	count1=0;
	count2=0;
	$("#kind_of_forum_box li:eq(0)").click(function(){
		if ($(this).parent().hasClass("open")) {
			$(this).parent().removeClass('open');
			$("#item_of_forum_box").removeClass('open');
			$('.forum_filter .mask').css("display","none");
		}else{
			$(this).parent().addClass('open');
			$('.forum_filter .mask').css("display","block");
			$("#item_of_forum_box").removeClass('open');
		}
		
		
	});
	$("#item_of_forum_box li:eq(0)").click(function(){
		if ($(this).parent().hasClass("open")) {
			$(this).parent().removeClass('open');
			$("#kind_of_forum_box").removeClass('open');
			$('.forum_filter .mask').css("display","none");
		}else{
			$(this).parent().addClass('open');
			$('.forum_filter .mask').css("display","block");
			$("#kind_of_forum_box").removeClass('open');
		}
	});
	
	$('.forum_filter .mask').click(function(){
		$("#kind_of_forum_box").removeClass('open');
		$("#item_of_forum_box").removeClass('open');
	});






	var arr=[];
	$('.kind_of_forum li label').click(function(){
		var type = $(this).attr('class');
		if($(this).siblings('img').hasClass('check')){
			$(".kind_of_forum li label").siblings('img').removeClass('check');
			arr.splice(0,1,"");
			// console.log(arr);

		}else{
			$(".kind_of_forum li label").siblings('img').removeClass('check');
			$(this).siblings('img').addClass('check');
			arr[0]=type;
			// console.log(arr);
		}
		filter();
	});

	var itemNum = 0;
	$('.item_of_forum li label').click(function(){
		if($(this).siblings('img').hasClass('check')){
			$(this).siblings('img').removeClass('check');
			count2--;
			itemNum--;
			// console.log(arr);
		}else{
			if(itemNum<4){
				$(this).siblings('img').addClass('check');
				count2++;
				itemNum++;
			}

			// console.log(arr);
		}
		// $(this).parent().parent().siblings(".count").text(count2);
	});

	function filter(){
		$('.forum').css('display','none');
		if(arr.length==1 && arr[0]==""){
			$('.forum').css('display','block');
		}else{
			for(var i=0;i<$('.forum').length;i++){
				if ($('.forum').eq(i).hasClass(arr[0])) {
					$('.forum').eq(i).css("display",'block');
				}
				// for(var j=1;j<arr.length;j++){
				// 	if ($('.forum').eq(j).hasClass(arr[j])) {
				// 		$('.forum').eq(j).css("display",'block');
				// 	}else{
				// 		$('.forum').eq(j).css("display",'none');
				// 	}
				// }
			}
		}
	}
	/*-----keep_card------- */
	$('.card_btn_box .keep_btn').click(function(){
	});
	/*---tag----*/
	$(".forum .forum_item span").click(function(){
		var temp = $(this).text();
		// console.log($(this));
		$(".forum_search input").val(temp);
		$(".forum_search input").focus();
		
	});

	

	/*----methods----*/
	var i=0;
	$(".forum_methods").click(function(){
		i++;
		if (i%2==1) {
			$(this).siblings(".forum_methods_menu").css({
				"max-height": 1000,
			});
			$(this).siblings(".mask").css({
				"display":"block",
			});
		}else{
			$(this).siblings(".forum_methods_menu").css({
				"max-height": 0,
			});
			$(this).siblings(".mask").css({
				"display":"none",
			});
		}
		
		
	});

	$(".mask").click(function(){
		i++;
		$(".forum_methods_menu").css("max-height","0");
		$(".mask").css("display","none");
	});



	$(".msg_box .forum_methods_menu .editbtn").click(function(){
		var msg_edit=$(this).parent().siblings(".msg_r").children("p").text();
		var mesNo = $(this).parent().siblings(".msg_r").attr('mesNo');
		var artNo = $(this).parent().siblings(".msg_r").attr('artNo');
		$(this).parent().siblings(".msg_r").children("p").html(`<form action="./php/update_mes.php"><input type="hidden" value="${artNo}" name="artNo"><input type="hidden" value="${mesNo}" name="mesNo"><textarea  name="mesText" style="width:100%; padding-left:5px; resize : none;outline:solid 1px #ddd;">${msg_edit}</textarea><input value="修改" type="submit"></form>`);
		
		
	});
	$(".msg_box .forum_methods_menu .deletebtn").click(function(){
		var artNo = $(this).parent().siblings(".msg_r").attr('artNo');
		var mesNo = $(this).parent().siblings(".msg_r").attr('mesNo');
		var del = confirm("確定刪除嗎?")
		if(del){
			window.location=`php/delete_mes.php?artNo=${artNo}&mesNo=${mesNo}`;
		}
		
	});
	/*----like-----*/



	/*--- mes ----*/
	/*----article_info----*/
	$('.article_info_btn').click(function(){
		
		$('.article_hot_forum_box .article_info').css('display','block');

	});
	$('#info_close').click(function(){
		$('.article_hot_forum_box .article_info').css('display','none');

	});
	/*addMes*/
	$(".publish_msg_r input[name='submit']").click(function(){
		if ($("#addMes textarea").val().length>=1) {
			$("#addMes").submit();
		}
		


	});
});


