$(document).ready(function(){
	var posts = $("ul.all-posts > li").size();
	$(".navigate")
		.mouseover(function(){
			$("ul.all-posts >li").css('display','');	
		});
		.mouseleave(function(){
			$("ul.all-posts >li").css('display','none');	
		});	
});


