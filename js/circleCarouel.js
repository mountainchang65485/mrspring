

//	create by nasir farhadi
//	email : nasirfarhadi92@gmail.com
//	Github : nasirfarhadi92



	let i=2;

	
	$(document).ready(function(){
		var radius = 200;
		var fields = $('#wikiNav');
		var container = $('#wikiInfo');
		var width = container.width();
		radius = width/2.5;
 
		 var height = container.height();
		var angle = 0, step = (2*Math.PI) / fields.length;
		fields.each(function() {
			var x = Math.round(width/2 + radius * Math.cos(angle) - $(this).width()/2);
			var y = Math.round(height/2 + radius * Math.sin(angle) - $(this).height()/2);
			if(window.console) {
				console.log($(this).text(), x, y);
			}
			
			$(this).css({
				left: x + 'px',
				top: y + 'px'
			});
			angle += step;
		});
		
		
		$('#wikiNav').click(function(){
			
			var dataTab= $(this).data("tab");
			$('#wikiNav').removeClass('active');
			$(this).addClass('active');
			$('.CirItem').removeClass('active');
			$( '.CirItem'+ dataTab).addClass('active');
			i=dataTab;
			
			$('#wikiInfo').css({
				"transform":"rotate("+(360-(i-1)*(360/fields.length))+"deg)",
				"transition":"2s"
			});
			$('#wikiNav').css({
				"transform":"rotate("+((i-1)*(360/fields.length))+"deg)",
				"transition":"1s"
			});
			
			
		});
		
		setInterval(function(){
			var dataTab= $('#wikiNav.active').data("tab");
			if(dataTab>12||i>12){
			dataTab=1;
			i=1;
			}
			$('#wikiNav').removeClass('active');
			$('[data-tab="'+i+'"]').addClass('active');
			$('.CirItem').removeClass('active');
			$( '.CirItem'+i).addClass('active');
			i++;
			
			
			$('#wikiInfo').css({
				"transform":"rotate("+(360-(i-2)*(360/fields.length))+"deg)",
				"transition":"2s"
			});
			$('#wikiNav').css({
				"transform":"rotate("+((i-2)*(360/fields.length))+"deg)",
				"transition":"1s"
			});
			
			}, 5000);
		
	});



