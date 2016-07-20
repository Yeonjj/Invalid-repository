---
---
function ChildManager(){
	
}


$(document).ready(function () {
	
	/*var childElem = {
		arry : {[]};
		getChild : function(DOMelement){
			var arry = this.arry;
			$(DOMelement).children().each(function(){
				arry.push($(this));
			})
		};
	}
	childElem.getChild("div.menu");

	function ChildElem(){
		this.alchild = [];
	}
	
	ChildElem.prototype = {
		getChild : function (element){
			$(element).children().each(function(elemt){
				this.childArry.push(elemt);	
			});
		}
	
	};
	

	var childarry = new ChildElem();
	childarry.getChild("div.nav");
	*/
	

	var json;	
	
	$.getJSON('{{site.baseurl}}/js/data/menus.json', function(data){
		json = $parseJSON(data);
	});

	var childElem = [];

	$("div.nav").children().each(function () {
		childElem.push($(this));
	});

	$("div.menu").mouseover(function () {
		var distance = 27;
		for (var i = 1; i < 5; i++) {
			$(childElem[i]).animate({
				top: distance,
				opacity: '1'
			}, 200);
			distance += 22;
		}
		
	});
	$("div.nav").mouseleave(function () {
		for (var i = 4; i >= 1; i--) {
			$(childElem[i]).animate({
				top: 27,
				opacity: '0'
			}, 200);
		}
	});
});


