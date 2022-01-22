

function rand(min,max){
	var a=Math.floor( Math.random()*(max-min-1)+min);
	return a;
}
$(document).ready(function(){
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
	
	
});