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
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body data-url="<?php echo base_url(); ?>">
	<header>
		<div class="wrapInner">
			<h1><a href="/"><i class="ion-android-call logo"></i><span class="headTxt">E-LOADTOPUP</span></a></h1>
		</div>
	</header>
	<section class="loginArea">
		<form class="loginForm">
			<div class="compCardWidth">
				<div class="compCard mb20">
					<div class="compCardHeader">
						<h3>Login</h3>
						<div class="group mb10">      
						    <input type="text" class="email required" required>
						    <span class="highlight"></span>
						    <span class="bar"></span>
						    <label>Email</label>
						</div>
						<div class="group">      
						    <input type="password" class="pass required" required>
						    <span class="highlight"></span>
						    <span class="bar"></span>
						    <label>Password</label>
						</div>
						<div class="input-group signUp">
							<span>Not registered? </span><a href="<?php echo base_url('main/signup'); ?>"> Create an Account</a>
						</div>
						<button type="submit" class="btn btn-primary btn-block btnLogin ripple">Login</button>
					</div>
				</div>
				<div class="alert alert-danger hidden customAlert" role="alert">
				  <i class="ion-alert-circled"></i> Invalid Email or Password
				</div>
			</div>
		</form>
	</section>
<script src="<?php echo base_url('assets/js/jquery-2.2.4.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/ripple.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/common.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/login.js'); ?>"></script>
</body>
</html>