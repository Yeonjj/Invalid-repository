---
---

function MainMenu(parent, menutag){
	this.arry = $(parent).children();
	this.target = [];
	this.create = function(){
	    	var mlocation = $(menutag).offset().top;
		arry = this.arry;
		target = this.target;
	    	$(menutag).mouseover(function () {
			console.log(target);
			for (var i = 4; i >= 0; i--) {
	            		$(target[i])
					.animate({
	                			top: '0',
	                			opacity: '0'
	            			}, 100)
			}

			
	    	    	var distance = 27;
	        	for (var i = 1; i < 5; i++) {
	            		$(arry[i]).animate({
	                		top: mlocation+distance,
	                		opacity: '1'
	            		}, 200)
				.mouseover(function(){
					$(this).css('background-color','red');
	
				})	
				.mouseleave(function(){
					$(this).css('background-color','white');
				});

	            		distance += 22;
	        	}

	    	});
	
	    	$(parent).mouseleave(function () {
			setTimeout(function(){
				for (var i = 4; i >= 1; i--) {
		            		$(arry[i]).animate({
		                		top: 27,
	        	        		opacity: '0'
		            		})
		        	}
			},300);
	        });
	};
}





$(document).ready(function () {
     	var menu = new MainMenu("div.nav","div.menu");
	menu.create();

	var submenu = {
		arry: [],
		create: function (parent) {
			submenu.arry = $(parent).children().children();
	
	
			$(parent).mouseover(function () {
		        	var distance = 0;
		        	for (var i = 0; i < 3; i++) {
					$(submenu.arry[i]).css('top', $(parent).position().top);
					$(parent).children().css({'top': $(parent).position().top-10,'right':'125px'});
					if($(parent).offset().top > 70){
						//$(sub)				
		            			$(submenu.arry[i])
							.animate({
								right: '103px',
		                				top: $(parent).position().top+distance,
		                				opacity: '1'
		            				},200)
							.mouseover(function(){
								$(this).css('background-color','red');
							});
	
		            			distance += 22;
		        		}
				}
		    	});
		
		    	$(parent).children().mouseleave(function () {
		        	for (var i = 3; i >= 0; i--) {
		            		$(submenu.arry[i])
						.animate({
							top: $(parent).position().top,
		                			opacity: '0'
		            			}, 50)
						.mouseleave(function(){
							$(this).css('background-color','white');
						});	
				}
		    	});
			return this;
		},
		sendMesg: function(reciver){
			reciver.target = submenu.arry;
		}
	}

	submenu.create("div.portfolio").sendMesg(menu);

});

