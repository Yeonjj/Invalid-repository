---
---
var animatedMenuBar = {
	arry: [],
	create: function (parent, menutag) {
	    $(parent).children().each(function () {
	        animatedMenuBar.arry.push($(this));
	    });
	    
	    $(menutag).mouseover(function () {
	        var distance = 27;
	        for (var i = 1; i < 5; i++) {
	            $(animatedMenuBar.arry[i]).animate({
	                top: distance,
	                opacity: '1'
	            }, 200);
	            distance += 22;
	        }
	    });
	
	    $(parent).mouseleave(function () {
	        for (var i = 4; i >= 1; i--) {
	            $(animatedMenuBar.arry[i]).animate({
	                top: 27,
	                opacity: '0'
	            }, 200);
	        }
	    });
	}
}

$(document).ready(function () {
     animatedMenuBar.create("div.nav","div.menu");
});
