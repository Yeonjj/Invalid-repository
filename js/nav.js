$(document).ready(function(){
	$("div.navigate")
		.mouseover(function(){
			$("ul.all-posts").css('display','inherit');
		})
		.mouseleave(function(){
			$("ul.all-posts").css('display','none');	
		});	
});


