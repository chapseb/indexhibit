/*	Expanding Menus for Indexhibituses jquery
 *
 *	Baixat de la web del Ross Cairns Mar
*/


function expandingMenu(num) {
	var speed = 600;
	
	var item_title = $("#menu ul").eq(num).children(":first");
	var items = $("#menu ul").eq(num).children().filter(function (index) { return index > 0; });
	
	if (items.is(".active") == false) {
		items.hide();
	}

	item_title.css({cursor:"pointer"}).toggle(
		function () {
			items.show(speed);
		}, function () {
			items.hide(speed);
		}
	)
}