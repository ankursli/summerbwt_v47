<?php
$request = service('request');
$uri = $request->getUri();
$lastparam = $uri->getSegment($uri->getTotalSegments());
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>BWT | Admin Panel</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css');?>">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css');?>">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
	<!-- Magnicfic popup style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/magnific-popup.css');?>">
	<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css');?>">
	<!-- Morris chart -->
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/morris.js/morris.css');?>">
	<!-- jvectormap -->
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/jvectormap/jquery-jvectormap.css');?>">
	<!-- Date Picker -->
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');?>">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css');?>">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');?>">
	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<header class="main-header">
			<!-- Logo -->
			<a href="<?php echo base_url('admin/dashboard');?>" class="logo">
			  <!-- mini logo for sidebar mini 50x50 pixels -->
			  <span class="logo-mini"><img src="<?php echo base_url('assets/image/logo.png');?>" alt="Logo" height="30px"></span>
			  <!-- logo for regular state and mobile devices -->
			  <span class="logo-lg"><img src="<?php echo base_url('assets/image/logo.png');?>" alt="Logo" height="30px"></span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
			  <!-- Sidebar toggle button-->
			  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
				<span class="sr-only">Toggle navigation</span>
			  </a>

			  <div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
				  <!-- Messages: style can be found in dropdown.less-->
				   <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<?php 
						if(session()->get('site_lang')){
							if(session()->get('site_lang')=='english'){
								echo 'English';
							}
							if(session()->get('site_lang')=='french'){
								echo 'Français';
							}
						}else{
							echo 'Français';
						} 
						?>
						<span class="caret">
						</span>
					</a>
					<ul class="dropdown-menu" role="menu">
					  <li><a href="<?php echo base_url(); ?>LanguageSwitcher/switchLang/english">English</a></li>
					  <li><a href="<?php echo base_url(); ?>LanguageSwitcher/switchLang/french">Français</a></li>
					</ul>
				  </li>
				  <li class="dropdown messages-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					  <i class="fa fa-envelope-o"></i>
					  <span class="label label-success">4</span>
					</a>
					<ul class="dropdown-menu">
					  <li class="header">You have 4 messages</li>
					  <li>
						<!-- inner menu: contains the actual data -->
						<ul class="menu">
						  <li><!-- start message -->
							<a href="#">
							  <div class="pull-left">
								<img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
							  </div>
							  <h4>
								Support Team
								<small><i class="fa fa-clock-o"></i> 5 mins</small>
							  </h4>
							  <p>Why not buy a new awesome theme?</p>
							</a>
						  </li>
						  <!-- end message -->
						</ul>
					  </li>
					  <li class="footer"><a href="#">See All Messages</a></li>
					</ul>
				  </li>
				  <!-- Notifications: style can be found in dropdown.less -->
				  <li class="dropdown notifications-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					  <i class="fa fa-bell-o"></i>
					  <span class="label label-warning">10</span>
					</a>
					<ul class="dropdown-menu">
					  <li class="header">You have 10 notifications</li>
					  <li>
						<!-- inner menu: contains the actual data -->
						<ul class="menu">
						  <li>
							<a href="#">
							  <i class="fa fa-users text-aqua"></i> 5 new members joined today
							</a>
						  </li>
						</ul>
					  </li>
					  <li class="footer"><a href="#">View all</a></li>
					</ul>
				  </li>
				  <!-- Tasks: style can be found in dropdown.less -->
				  <li class="dropdown tasks-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					  <i class="fa fa-flag-o"></i>
					  <span class="label label-danger">9</span>
					</a>
					<ul class="dropdown-menu">
					  <li class="header">You have 9 tasks</li>
					  <li>
						<!-- inner menu: contains the actual data -->
						<ul class="menu">
						  <li><!-- Task item -->
							<a href="#">
							  <h3>
								Design some buttons
								<small class="pull-right">20%</small>
							  </h3>
							  <div class="progress xs">
								<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
									 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
								  <span class="sr-only">20% Complete</span>
								</div>
							  </div>
							</a>
						  </li>
						  <!-- end task item -->
						</ul>
					  </li>
					  <li class="footer">
						<a href="#">View all tasks</a>
					  </li>
					</ul>
				  </li>
				  <!-- User Account: style can be found in dropdown.less -->
				  <li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					  <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
					  <span class="hidden-xs"><?php echo (session()->get('admin_user')['firstname']) ? session()->get('admin_user')['firstname'] : '';?></span>
					</a>
					<ul class="dropdown-menu">
					  <!-- User image -->
					  <li class="user-header">
						<img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
						<p><?php echo (session()->get('admin_user')['firstname']) ? session()->get('admin_user')['firstname'] : '';?></p>
					  </li>
					  <!-- Menu Footer-->
					  <li class="user-footer">
						<div class="pull-left">
						  <a href="<?php echo base_url('admin/user/viewprofile/'.session()->get('admin_user')['id']);?>" class="btn btn-default btn-flat"><?php echo lang('Label.label_profile');?></a>
						</div>
						<div class="pull-right">
						  <a href="<?php echo base_url('admin/logout');?>" class="btn btn-default btn-flat"><?php echo lang('Label.label_sign_out');?></a>
						</div>
					  </li>
					</ul>
				  </li>
				</ul>
			  </div>
			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
			  <!-- Sidebar user panel -->
			  <div class="user-panel">
				<div class="pull-left image">
					<img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
				</div>
				<div class="pull-left info">
				  <p><?php echo (session()->get('admin_user')['firstname']) ? session()->get('admin_user')['firstname'] : '';?></p>
				  <a href="#"><i class="fa fa-circle text-success"></i> <?php echo lang('Label.label_online');?></a>
				</div>
			  </div>
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header"><?php echo lang('Label.label_main_navigation');?></li>
					<li class="<?php echo ($lastparam=='dashboard') ? 'active':'';?>">
						<a href="<?php echo base_url('admin/dashboard');?>">
							<i class="fa fa-dashboard"></i> <span><?php echo lang('Label.label_dashboard');?></span>
						</a>
					</li>
					<li class="treeview <?php echo ($lastparam=='Viewuser' || $lastparam=='Adduser') ? 'active':'';?>">
						<a href="#">
							<i class="fa fa-users"></i>
							<span><?php echo lang('Label.label_users');?></span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
					<li class="<?php echo ($lastparam=='Viewuser') ? 'active':'';?>"><a href="<?php echo base_url('admin/user/Viewuser');?>"><i class="fa fa-circle-o"></i><?php echo lang('Label.label_view_user');?></a></li>
					<li class="<?php echo ($lastparam=='Adduser') ? 'active':'';?>"><a href="<?php echo base_url('admin/user/Adduser');?>"><i class="fa fa-circle-o"></i><?php echo lang('Label.label_add_user');?></a></li>
				</ul>
			</li>

			<!-- Block -->
			<li class="treeview <?php echo in_array($lastparam, ['Viewblock','Addblock','editblock']) ? 'active':'';?>">
				<a href="#">
					<i class="fa fa-th-large"></i>
					<span><?php echo lang('Label.label_block');?></span>
					<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<li class="<?php echo ($lastparam=='Viewblock') ? 'active':'';?>"><a href="<?php echo base_url('admin/block/Viewblock');?>"><i class="fa fa-circle-o"></i><?php echo lang('Label.label_view_block');?></a></li>
					<li class="<?php echo ($lastparam=='Addblock') ? 'active':'';?>"><a href="<?php echo base_url('admin/block/Addblock');?>"><i class="fa fa-circle-o"></i><?php echo lang('Label.label_add_block');?></a></li>
				</ul>
			</li>

			<!-- Robot -->
			<li class="treeview">
				<a href="#">
					<i class="fa fa-android"></i>
					<span><?php echo lang('Label.label_robot');?></span>
					<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url('admin/robot/Viewrobot');?>"><i class="fa fa-circle-o"></i><?php echo lang('Label.label_view_robot');?></a></li>
					<li><a href="<?php echo base_url('admin/robot/Addrobot');?>"><i class="fa fa-circle-o"></i><?php echo lang('Label.label_add_robot');?></a></li>
				</ul>
			</li>

			<!-- Magasins (Stores) -->
			<li class="treeview">
				<a href="#">
					<i class="fa fa-shopping-cart"></i>
					<span><?php echo lang('Label.label_stores');?></span>
					<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url('admin/store/Viewstore');?>"><i class="fa fa-circle-o"></i><?php echo lang('Label.label_view_store');?></a></li>
					<li><a href="<?php echo base_url('admin/store/Addstore');?>"><i class="fa fa-circle-o"></i><?php echo lang('Label.label_add_store');?></a></li>
				</ul>
			</li>

			<!-- Coupons -->
			<li class="treeview">
				<a href="#">
					<i class="fa fa-ticket"></i>
					<span><?php echo lang('Label.label_coupons');?></span>
					<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url('admin/coupon/Viewcoupon');?>"><i class="fa fa-circle-o"></i><?php echo lang('Label.label_view_coupon');?></a></li>
					<li><a href="<?php echo base_url('admin/coupon/Addcoupon');?>"><i class="fa fa-circle-o"></i><?php echo lang('Label.label_add_coupon');?></a></li>
				</ul>
			</li>

			<!-- Robot Stores -->
			<li class="treeview">
				<a href="#">
					<i class="fa fa-map-marker"></i>
					<span><?php echo lang('Label.label_robot_stores');?></span>
					<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url('admin/storerobot/Viewstore');?>"><i class="fa fa-circle-o"></i><?php echo lang('Label.label_view_store');?></a></li>
					<li><a href="<?php echo base_url('admin/storerobot/Addstore');?>"><i class="fa fa-circle-o"></i><?php echo lang('Label.label_add_store');?></a></li>
				</ul>
			</li>

			<!-- Modele de courrier (Mail Templates) -->
			<li class="treeview">
				<a href="#">
					<i class="fa fa-envelope"></i>
					<span><?php echo lang('Label.label_mail_template');?></span>
					<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url('admin/template/Viewtemplate');?>"><i class="fa fa-circle-o"></i><?php echo lang('Label.label_view_template');?></a></li>
					<li><a href="<?php echo base_url('admin/template/Addtemplate');?>"><i class="fa fa-circle-o"></i><?php echo lang('Label.label_add_template');?></a></li>
				</ul>
			</li>

			<!-- Menus -->
			<li class="<?php echo ($lastparam=='Viewmenu') ? 'active':'';?>">
				<a href="<?php echo base_url('admin/menu/Viewmenu');?>">
					<i class="fa fa-bars"></i> <span><?php echo lang('Label.label_menus');?></span>
				</a>
			</li>

			<!-- Offer Robot (Proof) -->
			<li class="<?php echo ($lastparam=='proof') ? 'active':'';?>">
				<a href="<?php echo base_url('admin/proof');?>">
					<i class="fa fa-star"></i> <span><?php echo lang('Label.label_offer_robot');?></span>
				</a>
			</li>

			<!-- Concours GP Italie (Draw) -->
			<li class="<?php echo ($lastparam=='draw') ? 'active':'';?>">
				<a href="<?php echo base_url('admin/draw');?>">
					<i class="fa fa-trophy"></i> <span><?php echo lang('Label.label_draw');?></span>
				</a>
			</li>

			<!-- Contrat d'Excellence (Refund) -->
			<li class="<?php echo ($lastparam=='refund') ? 'active':'';?>">
				<a href="<?php echo base_url('admin/refund');?>">
					<i class="fa fa-file-text"></i> <span><?php echo lang('Label.label_refund');?></span>
				</a>
			</li>

			<!-- Contactez-nous (Client Support) -->
			<li class="<?php echo ($lastparam=='client_support') ? 'active':'';?>">
				<a href="<?php echo base_url('admin/client_support');?>">
					<i class="fa fa-comments"></i> <span><?php echo lang('Label.label_client_support');?></span>
				</a>
			</li>

			<!-- Pays Restriction (Country) -->
			<li class="<?php echo ($lastparam=='country') ? 'active':'';?>">
				<a href="<?php echo base_url('admin/country');?>">
					<i class="fa fa-globe"></i> <span><?php echo lang('Label.label_country');?></span>
				</a>
			</li>

			<!-- Parametres SMTP (Settings) -->
			<li class="<?php echo ($lastparam=='settings') ? 'active':'';?>">
				<a href="<?php echo base_url('admin/settings');?>">
					<i class="fa fa-cog"></i> <span><?php echo lang('Label.label_settings');?></span>
				</a>
			</li>

			<!-- Modele de page (Page Templates) -->
			<li class="treeview">
				<a href="#">
					<i class="fa fa-file"></i>
					<span><?php echo lang('Label.label_page_template');?></span>
					<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url('admin/pagetemplate/viewpage');?>"><i class="fa fa-circle-o"></i><?php echo lang('Label.label_view_page');?></a></li>
					<li><a href="<?php echo base_url('admin/pagetemplate/Addpage');?>"><i class="fa fa-circle-o"></i><?php echo lang('Label.label_add_page');?></a></li>
				</ul>
			</li>
				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>