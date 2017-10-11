<!DOCTYPE html>
<html>
<head>
	<title>e-loadtopup</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/reset.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/ionicons.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery.toast.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body data-url="<?php echo base_url(); ?>">
	<header>
		<div class="wrapInner posRel">
			<i class="ion-android-system-back hidden backBtn ripple"></i>
			<h1><a href="/"><i class="ion-android-call logo"></i><span class="headTxt">E-LOADTOPUP</span></a></h1>
		</div>
	</header>
	<section class="signUpArea">
		<form class="signUpForm">
			<div class="compCardWidth">
				<div class="compCard mb20">
					<div class="compCardHeader">
						<h3>Sign Up</h3>
						<div class="row">
							<div class="col-md-6">
								<div class="group mb10">      
								    <input type="text" class="email required" required>
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>Email</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="group">      
								    <input type="text" class="mobile required" onkeypress="return checkNumeric()" required>
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>Mobile number (ex. 09123456789)</label>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="group">      
								    <input type="password" class="pass required" required>
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>Password</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="group">      
								    <input type="password" class="repass required" required>
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>Re-enter Password</label>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="group">      
								    <input type="text" class="fname required" required>
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>First name</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="group">      
								    <input type="text" class="lname required" required>
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>Last name</label>
								</div>
							</div>
						</div>
				
						<div class="row">
							<div class="col-md-12">
								<div class="group">      
								    <input type="text" class="address required" required>
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>Address</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="input-group signUp">
									<span>Already have an account? </span><a href="<?php echo base_url('main/'); ?>"> Login</a>
								</div>
								<button type="submit" class="btn btn-primary btn-block btnSignUp ripple" disabled>Sign Up</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
<script src="<?php echo base_url('assets/js/jquery-2.2.4.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/ripple.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/common.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.toast.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/signup.js'); ?>"></script>
</body>
</html>