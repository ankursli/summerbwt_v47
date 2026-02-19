<?php
$base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .  $_SERVER['HTTP_HOST'];
$url = $base_url . $_SERVER["REQUEST_URI"];
$parts = explode("/", $url);
$lastparam = end($parts);
?>
<!DOCTYPE html>
<html lang="<?php if(!empty($_SESSION['site_lang'])){
	if($_SESSION['site_lang']=='english'){
		echo 'en-UK';
	}
	if($_SESSION['site_lang']=='french'){
		echo 'fr-FR';
	}
	
}else{
	echo 'fr-FR';
} 
?>">
<head>
<!-- Global site tag (gtag.js) - Google Analytics --> 
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-69695752-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-69695752-3');
</script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>BWT </title>
    <link rel="icon" href="<?php echo base_url();?>assets/image/icon.png">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/font/font-awesome/fontawesome-all.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.fullpage.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/stylesheet.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/fonts.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/font-awesome/fontawesome-all.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css//bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<style>
	.error{
		color:red;
	}
	</style>
</head>

<body class="<?php echo $this->router->fetch_method(); ?> <?php if(!empty($_SESSION['site_lang'])){
						if($_SESSION['site_lang']=='english'){
							echo 'English';
						}
						if($_SESSION['site_lang']=='french'){
							echo 'French';
						}
					
					}else{
						echo 'French';
					} 
					?>">
	<style>
		.waiting-wrapper {background: rgb(40,102,147,0.9);position: fixed;z-index: 5;left: 0;right: 0;height: 100vh;padding: 15px;display: table;width: 100%;}
		.waiting-wrapper .row{display: table-cell; vertical-align: middle}
		.waiting-overlay-logo{max-width: 200px;margin: 0 auto}
		.waiting-wrapper .home-text {font-size: 100px;line-height: 100px;padding-bottom:50px}
		.waiting-overlay-p{font-size: 50px;color:#fff;font-weight: 500}
		.empty-spacer{padding: 25px 0px}
		@media screen and (max-width: 767px){
			.waiting-overlay-logo{max-width: 120px;}
			.waiting-wrapper .home-text {font-size: 50px;line-height: 50px;padding-bottom: 20px;}
			.waiting-overlay-p {font-size: 30px;}
		}
	</style>
    <div class="waiting-wrapper" style="display:none">
		<div class="row">
			<div class="col-md-12 text-center">
				<img class="waiting-overlay-logo" src="<?php echo base_url();?>assets/image/logo.png" alt="">
			</div>
			<div class="empty-spacer"></div>
			<div class="col-md-12 text-center logomobile">
				<h2 class="home-text"><?php echo lang('Label.home_header_text'); ?></h2>
			</div>
			<div class="col-md-12 text-center waiting-overlay-p">
				<p>En raison de l'actualité les offres Summer<br>reviennent en mai 2020.</p>
			</div>
			<div class="empty-spacer"></div>
			<div class="col-md-12 text-center waiting-overlay-p">
				<p>A très vite</p>
			</div>
			<div class="empty-spacer"></div>
			<div class="col-md-12 text-center waiting-overlay-p">
				<p>La team BWT</p>
			</div>
		</div>
	</div>
    <div class="wrapper">
		<header class="header-area" id="header-area">
			<div class="dope-nav-container left breakpoint-on">
				<div class="container-fluid">
					<div class="row">
						<!-- dope Menu -->
						<nav class="dope-navbar justify-content-between" id="dopeNav">

							<!-- Logo -->
							<div class="col-md-3 text-right">
								<a class="nav-brand white" href="<?php echo base_url();?>">
									<img src="<?php echo base_url();?>assets/image/logo.png" alt="">
								</a>
								<a class="nav-brand blue" href="<?php echo base_url();?>">
									<img src="<?php echo base_url();?>assets/image/logo2.png" alt="">
								</a>
							</div>

							<div class="col-md-7 text-center hiddenmobile">
								<h2 class="home-text"><?php echo lang('Label.home_header_text'); ?></h2>
							</div>

							<div class="col-md-2">
								<!-- Navbar Toggler -->
								<div class="left-header">
								<div class="dope-navbar-toggler">
									<span class="navbarToggler">
										<span></span>
										<span></span>
										<span></span>
									</span>                            
								</div>
							</div>
							<div class="dropdown language-dropdown show">
								<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<?php 
									if(!empty($_SESSION['site_lang'])){
										if($_SESSION['site_lang']=='english'){
											echo 'English';
											$selected = 'english';
										}
										if($_SESSION['site_lang']=='french'){
											echo 'Français';
											$selected = 'french';
										}
									
									}else{
										echo 'Français';
									} 
									?>
								</a>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									<a class="dropdown-item" href="<?php echo base_url(); ?>LanguageSwitcher/switchLang/french">Français</a>
									<a class="dropdown-item" href="<?php echo base_url(); ?>LanguageSwitcher/switchLang/english">English</a>
									</div>
							</div>
						
							<!-- Menu -->
							<div class="dope-menu">

								<!-- close btn -->
								<div class="dopecloseIcon">
									<div class="cross-wrap">
										<span class="top"></span>
										<span class="bottom"></span>
									</div>
								</div>

								<!-- Nav Start -->
								<div class="dopenav">
									<ul id="nav">
										
										<li class="<?php echo ($lastparam=='') ? 'active':'';?>">
											<a href="<?php echo base_url();?>"><?php echo lang('Label.label_home'); ?></a>
										</li>
										
<!-- REMOVE MENU ROBOT>
										<li class="<?php echo ($lastparam=='offre-robot') ? 'active menu2':'';?>">
											<a href="<?php echo base_url('offre-robot');?>">
											<?php 
											if(!empty($_SESSION['site_lang'])){
												if($_SESSION['site_lang']=='english'){
													echo 'ROBOTIC POOL CLEANER OFFER';
												}
												
												if($_SESSION['site_lang']=='french'){
													echo 'OFFRE ROBOTS ';
												}
											}else{
												echo 'OFFRE ROBOTS ';
											} 
											?>
											</a>
										</li>
< menu robot end -->
<!-- REMOVE MENU TRAITEMENT EAU>
                                        <li class="<?php echo ($lastparam=='gpcastellet') ? 'active':'';?> menu1">
											<a href="<?php echo base_url('gpcastellet');?>">
											<?php 
											if(!empty($_SESSION['site_lang'])){
												if($_SESSION['site_lang']=='english'){
													echo 'WATER TREATMENT OFFER';
												}
												if($_SESSION['site_lang']=='french'){
													echo "OFFRE TRAITEMENT DE L’EAU";
												}
											}else{
												echo "OFFRE TRAITEMENT DE L’EAU";
											} 
											?>
											</a>
										</li> 
< menu traitement end -->

<!-- REMOVE MENU contrat d'excellence>		<li class="<?php echo ($lastparam=='contrat-dexcellence') ? 'active':'';?> menu1">
											<a href="<?php echo base_url('contrat-dexcellence');?>">
											<?php 
											if(!empty($_SESSION['site_lang'])){
												if($_SESSION['site_lang']=='english'){
													echo 'CONTRACT OF EXCELLENCE';
												}
												if($_SESSION['site_lang']=='netherland'){
													echo lang('Label.label_refund');
												}
												if($_SESSION['site_lang']=='french'){
													echo 'CONTRAT D’EXCELLENCE';
												}
											}else{
												echo "CONTRAT D’EXCELLENCE";
											} 
											?>
											</a>
										</li>
										
						FIN		-->
										
										<li class="<?php echo ($lastparam=='support') ? 'active':'';?> menu2">
											<a href="<?php echo base_url('support');?>"><?php echo lang('Label.label_client_support'); ?></a>
										</li>
										<li class="<?php echo ($lastparam=='modifier-mon-profil') ? 'active':'';?>">
											<a href="<?php echo base_url('modifier-mon-profil');?>">
											<?php 
											if(!empty($_SESSION['site_lang'])){
												if($_SESSION['site_lang']=='english'){
													echo lang('Label.label_edit_profile');
												}
												if($_SESSION['site_lang']=='french'){
													echo 'Modifier mon profil';
												}
											}else{
												echo 'Modifier mon profil ';
											} 
											?>
											</a>
										</li>
										<?php if(empty($_SESSION['front_user']['id'])){ ?>
										
										<li class="<?php echo ($lastparam=='login') ? 'active':'';?>">
											<a href="<?php echo base_url('login');?>" class="active"><?php echo lang('Label.label_login_btn'); ?></a>
										</li>
										<?php }else{ ?>
										<li class="<?php echo ($lastparam=='logout') ? 'active':'';?>">
											<a href="<?php echo base_url('logout');?>"><?php echo lang('Label.label_logout'); ?></a>
										</li>
										
										<?php } ?>
										
									</ul>
								</div>
								<!-- Nav End -->
							</div>
						</nav>

						<div class="mobileshowlogo">
							<div class="col-md-12 text-center logomobile">
								<h2 class="home-text"><?php echo lang('Label.home_header_text'); ?></h2>
							</div>
						</div>

						
					</div>
				</div>
			</div>
		</header>
