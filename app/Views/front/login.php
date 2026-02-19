<div class="container-fluid login-bg"  style="padding-top: 190px;">

	<div class="login-box-body">

		<div class="row">

			<div class="col-sm-12">

				<h4 class="login-box-msg" style="text-align: center;" ><?php echo lang('Label.label_login');?></h4>

			</div>

		</div>

		<form action="<?php echo base_url('front/checkLogin');?>" method="post">

			<div class="row" >

				<div class="col-sm-6" style="margin:0 auto;" >

					<?php 

					$success=session()->getFlashdata('success');

					$error=session()->getFlashdata('error');

					if(!empty($success)) { ?>

					<div class="alert alert-success">

					<?php echo session()->getFlashdata('success'); ?>

					</div>

					<?php } ?>

					<?php if(!empty($error)) { ?>

					<div class="alert alert-warning">

					<?php echo session()->getFlashdata('error');?>

					</div>

					<?php } ?>

				</div>

			</div>

			<div class="row" >

				<div class="col-sm-6" style="margin:0 auto;" >

					<div class="form-group has-feedback">

						<input type="text" class="form-control" name="email" placeholder="<?php echo lang('Label.label_email_or_username');?>">

						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>

						<div class="error"><?php echo session()->getFlashdata('error_email') ?? ''; ?></div>

					</div>

				</div>

			</div>

			<div class="row" >

				<div class="col-sm-6" style="margin:0 auto;" >

					<div class="form-group has-feedback">

						<input type="password" class="form-control" name="password" placeholder="<?php echo lang('Label.label_sign_in_password');?>">

						<span class="glyphicon glyphicon-lock form-control-feedback"></span>

						<div class="error"><?php echo session()->getFlashdata('error_password') ?? ''; ?></div>

					</div>

				</div>

			</div>

			<div class="row">

				<div class="col-sm-6" style="margin:0 auto;" >

					<button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo lang('Label.label_login_btn');?></button>

				</div>

			</div>

			

			<!--div class="row">

				<div class="col-sm-6" style="margin:0 auto;" >

					<div class="text-center add"><span>OR</span></div> 

				</div>

			</div>

	

			<div class="row">

				<div class="col-sm-6" style="margin:0 auto;" >

					<a href="javascript:void(0);" onClick="facebook_login()" scope="public_profile,email" class="btn btn-primary btn-block btn-flat full-width">

						<i class="fa fa-facebook" aria-hidden="true"></i> Connect with Facebook

					</a>

				</div>

			</div-->

		</form>

		

		<div class="row" >

			<!--div class="col-sm-6" style="margin:0 auto;" >

				<a href="<?php echo base_url('register');?>" >Recover Password ?</a>

			</div-->

			<div class="col-sm-6" style="margin:0 auto;" >

				<a href="<?php echo base_url('forgotpassword');?>" style="float: left;"  ><?php echo lang('Label.label_reset_password');?></a>

				<a href="<?php echo base_url('register');?>" style="float: right;" ><?php echo lang('Label.label_create_an_account');?></a>

			</div>

		</div>

	</div>

</div>