<!DOCTYPE html>
<html>
<head>
	<title>e-loadtopup</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dataTables.bootstrap4.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/reset.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/ionicons.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body data-url="<?php echo base_url(); ?>" class="adminBody">
	<header>
		<div class="posRel">
			<h1><a href="/"><i class="ion-android-call logo"></i><span class="headTxt">E-LOADTOPUP</span></a></h1>

			<a class="nav-link dropdown-toggle mobileMenu hidden" id="sidebarCollapse" href="#" role="button"><i class="ion-navicon-round"></i></a>
			<div class="rightHead">
				<p>Hello, <span><?php echo ucfirst(stripslashes($this->session->userdata('firstname'))).' '.ucfirst(stripslashes($this->session->userdata('lastname'))); ?></span> | <a href="#" class="logout">Logout</a></p>
			</div>
		</div>
	</header>