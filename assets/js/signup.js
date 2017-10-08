$(function() {
	$(".signUpForm").submit(function(e) {
		e.preventDefault();
		var email = $(".email").val();
		var pass = $(".pass").val();
		var fname = $(".fname").val();
		var lname = $(".lname").val();
		var mobile = $(".mobile").val();
		var address = $(".address").val();
		
		$.ajax({
			type: 'POST',
			url: baseUrl+'Main/signupUser',
			crossDomain:true, 
			data: {'email': email, 'pass': pass, 'fname': fname, 'lname': lname, 'mobile': mobile, 'address': address},
			beforeSend: function(){
				$(".btnSignUp").attr('disabled', true);
			},
			success : function(data) {
				$(".btnSignUp").attr('disabled', false);
				if(pass.length >= 5) {
					if(data.success == 0) {
						$.toast({
						    heading: 'Error',
						    text: 'Email address was already taken',
						    icon: 'error',
						    loader: false,        
						});
					}else {
						$.toast({
						    heading: 'Success',
						    text: 'Account has been registered',
						    icon: 'success',
						    loader: false,        
						});

						setTimeout(function() {
							window.location.href = '/';
						}, 3000);
					}
				}else {
					$.toast({
					    heading: 'Error',
					    text: 'Password length must be 5 characters and above',
					    icon: 'error',
					    loader: false,        
					});
				}
			}
		});
	});

	$(".signUpForm input").keyup(function() {
		var signBtnIsDisabled = 1;
		$(".signUpForm input").each(function(index, value) {
			if($(this).val() == '') {
				signBtnIsDisabled = 1;
			}else {
				signBtnIsDisabled = 0;
			}
		});

		if($(".signUpForm input").hasClass('bBotRed')) {
			signBtnIsDisabled = 1;
		}

		if(signBtnIsDisabled == 1) {
			$(".btnSignUp").attr('disabled', true);
		}else {
			$(".btnSignUp").attr('disabled', false);
		}
	});
});
