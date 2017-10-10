$(function() {
	var navToggle = false;
	$("#sidebarCollapse").click(function() {
		navToggle = !navToggle;

		if(navToggle == true) { // close btn
			$(this).find("i").attr('class', 'ion-close-round');
		}else {
			$(this).find("i").attr('class', 'ion-navicon-round');
		}
	});
});


