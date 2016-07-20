---
---
var animatedMenuBar = {
	arry: [],
	addChildTo: function(val, parent){
	    $(parent).children().each(function () {
	        val.push($(this));
	    });	
	}
	create: function (parent, menutag) {
	    addChildTo(animatedMenuBar.arry, parent);
	    
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


