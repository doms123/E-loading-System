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