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
		<div class="wrapInner posRel">
			<i class="ion-android-system-back hidden backBtn userBack dashNav"></i>
			<h1><a href="/"><i class="ion-android-call logo"></i><span class="headTxt">E-LOADTOPUP</span></a></h1>

			<a class="nav-link dropdown-toggle mobileMenu hidden" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="ion-navicon-round"></i></a>
			    <div class="dropdown-menu">
			    <p class="menuUserName"><?php echo ucfirst(stripslashes($this->session->userdata('firstname'))).' '.ucfirst(stripslashes($this->session->userdata('lastname'))); ?></p>
			      <div class="dropdown-divider"></div>
			      <a class="dropdown-item logout" href="#">Logout</a>
			    </div>

			<div class="rightHead">
				<p>Hello, <span><?php echo ucfirst(stripslashes($this->session->userdata('firstname'))).' '.ucfirst(stripslashes($this->session->userdata('lastname'))); ?></span> | <a href="#" class="logout">Logout</a></p>
			</div>
		</div>
	</header>