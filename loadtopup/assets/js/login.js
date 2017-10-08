$(function() {
	$(".loginForm").submit(function(e) {
		e.preventDefault();
		var email = $(".email").val();
		var pass = $(".pass").val();

		$.ajax({
			type: 'POST',
			url: baseUrl+'Main/login', 
			crossDomain:true, 
			data: {'email': email, 'pass': pass},
			beforeSend: function(){
				$(".btnLogin").attr('disabled', true);
			},
			success : function(data) {
				$(".btnLogin").attr('disabled', false);
				if(data.success == 1) {
					window.location.href = '/Main/dashboard';
				}else {
					$(".loginForm .alert").fadeIn();

					setTimeout(function() {
						$(".loginForm .alert").fadeOut();
					}, 5000);
				}
			}
		});
	});
});
