var baseUrl = $("body").attr("data-url");

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

$(".email").blur(function() {
	if(!validateEmail($(this).val())) {
		$(this).addClass('bBotRed');
	}
});

$(".email, .required").focus(function() {
	$(this).removeClass('bBotRed');
});


$(".required").blur(function() {
	if($(this).val() == '') {
		$(this).addClass('bBotRed');
	}
});

$(".backBtn").click(function() {
	history.back();
});

$('.ripple').yarp({
  colors: ['#5aaaff'],
  duration: 1000
});

$(".logout").click(function() {
	$.ajax({
		type: 'POST',
		url: baseUrl + 'Main/logout',
		data: {},
		success: function(data) {
			if(data.success == 1) {
				window.location.href = '/';
			}
		}
	});
});

$(function() {
	if($(window).width() > 767) {
		$toastWidth = $(window).width() / 4;
		var css = `
			<style>
				.jq-toast-wrap {
					width: ${$toastWidth}px
				}
			</style>
		`;
		$("section").append(css);
	}else {
		$("section").find("style").remove();
	}
});