$(document).ready(function(){
	
	$(".admin_nav ul li:eq(0)").click(function(){
		$(".admin_content").css({
			display: 'none',
		});
		$(".admin_content_order").css({
			display: 'flex',
		});
		
		$(".admin_nav ul li").css({
			'background-color':"#fff",
			color : '#000',
		});

		$(this).css({
			'background-color':"#4d2000",
			color : '#fff',
		});
	});

	$(".admin_robot_item p:eq(0)").click(function(){
		$(".admin_content").css({
			display: 'none',
		});
		$(".admin_content_robot_msg").css({
			display: 'flex',
		});
		$(".admin_nav ul li").css({
			'background-color':"#fff",
			color : '#000',
		});

		$(".admin_nav ul li:eq(4)").css({
			'background-color':"#4d2000",
			color : '#fff',
		});

	});
	$(".admin_robot_item p:eq(1)").click(function(){
		$(".admin_content").css({
			display: 'none',
		});
		$(".admin_content_robot_qna").css({
			display: 'flex',
		});
		$(".admin_nav ul li").css({
			'background-color':"#fff",
			color : '#000',
		});

		$(".admin_nav ul li:eq(4)").css({
			'background-color':"#4d2000",
			color : '#fff',
		});
	});

	$(".admin_nav ul li:eq(2)").click(function(){
		$(".admin_content").css({
			display: 'none',
		});
		$(".admin_content_member").css({
			display: 'flex',
		});
		$(".admin_nav ul li").css({
			'background-color':"#fff",
			color : '#000',
		});
		$(this).css({
			'background-color':"#4d2000",
			color : '#fff',
		});
	});

	$(".admin_nav ul li:eq(3)").click(function(){
		$(".admin_content").css({
			display: 'none',
		});
		$(".admin_content_item").css({
			display: 'flex',
		});
		$(".admin_nav ul li").css({
			'background-color':"#fff",
			color : '#000',
		});

		$(this).css({
			"background-color":"#4d2000",
			color : '#fff',
		});
	});

	$(".admin_nav ul li:eq(5)").click(function(){
		$(".admin_content").css({
			display: 'none',
		});
		$(".admin_content_forum").css({
			display: 'flex',
		});
		$(".admin_nav ul li").css({
			'background-color':"#fff",
			color : '#000',
		});

		$(this).css({
			"background-color":"#4d2000",
			color : '#fff',
		});
	});


	$(".admin_service_item p:eq(0)").click(function(){
		$(".admin_content").css({
			display: 'none',
		});
		$(".admin_content_shop").css({
			display: 'flex',
		});
		$(".admin_nav ul li").css({
			'background-color':"#fff",
			color : '#000',
		});

		$(".admin_nav ul li:eq(1)").css({
			'background-color':"#4d2000",
			color : '#fff',
		});
	});


	$(".admin_service_item p:eq(1)").click(function(){
		$(".admin_content").css({
			display: 'none',
		});
		$(".admin_content_room").css({
			display: 'flex',
		});
		$(".admin_nav ul li").css({
			'background-color':"#fff",
			color : '#000',
		});

		$(".admin_nav ul li:eq(1)").css({
			'background-color':"#4d2000",
			color : '#fff',
		});
	});


	$(".admin_service_item p:eq(2)").click(function(){
		$(".admin_content").css({
			display: 'none',
		});
		$(".admin_content_room_shut").css({
			display: 'flex',
		});
	});

	$(".admin_nav ul li:eq(6)").click(function(){
		$(".admin_content").css({
			display: 'none',
		});
		$(".admin_content_advisory").css({
			display: 'flex',
		});
		$(".admin_nav ul li").css({
			'background-color':"#fff",
			color : '#000',
		});

		$(this).css({
			"background-color":"#4d2000",
			color : '#fff',
		});
	});

	$(".admin_nav ul li:eq(7)").click(function(){
		$(".admin_content").css({
			display: 'none',
		});
		$(".admin_content_coupon").css({
			display: 'flex',
		});
		$(".admin_nav ul li").css({
			'background-color':"#fff",
			color : '#000',
		});

		$(this).css({
			"background-color":"#4d2000",
			color : '#fff',
		});
	});
});