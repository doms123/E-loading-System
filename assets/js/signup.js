$(function() {
	$(".signUpForm").submit(function(e) {
		e.preventDefault();
		var email = $(".email").val();
		var pass = $(".pass").val();
		var repass = $(".repass").val();
		var fname = $(".fname").val();
		var lname = $(".lname").val();
		var mobile = $(".mobile").val();
		var address = $(".address").val();
		var isPassValid = 0;
		if(pass == repass) {
			isPassValid = 1;
		}

		if(pass.length >= 5) {
			if(isPassValid == 1) {
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
							    text: 'Account has been registered, redirecting to the login page . . .',
							    icon: 'success',
							    loader: false,        
							});

							setTimeout(function() {
								window.location.href = '/';
							}, 3000);
						}
					}
				});
			}else {
				$.toast({
				    heading: 'Error',
				    text: 'Password doesn\'t match',
				    icon: 'error',
				    loader: false,        
				});
			}
		}else {
			$.toast({
			    heading: 'Error',
			    text: 'Password length must be 5 characters and above',
			    icon: 'error',
			    loader: false,        
			});
		}
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

	$(".mobile").keyup(function() {
		var mobileNo = $(this).val();
		if($(this).val().length > 11) {
			var result = mobileNo.substring(0, 11);
			$(this).val(result);
		}
	});
});
