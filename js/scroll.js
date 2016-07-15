$(document).ready(function(){
	$(window).scroll(function(){
		var currentPos = $(this).scrollTop();
		$('h3').text(currentPos);			
	});
});

