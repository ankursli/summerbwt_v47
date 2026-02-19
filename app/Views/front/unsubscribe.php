<div class="container-fluid login-bg"  style="padding-top: 190px;">

	<div class="login-box-body">

		<div class="row">

			<div class="col-sm-12">

				<h4 class="login-box-msg" style="text-align: center;" ><?php echo lang('Label.label_unsubcribe');?></h4>

			</div>

		</div>

		<form action="<?php echo base_url('front/check_unsubcribe');?>" method="post">

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

						<input type="text" class="form-control is_Unsubscribe" name="is_Unsubscribe" placeholder="<?php echo lang('Label.label_email_or_username');?>">

						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>

						<div class="error"><?php echo session()->getFlashdata('error_is_Unsubscribe') ?? ''; ?></div>

					</div>

				</div>

			</div>

			<div class="row">

				<div class="col-sm-6" style="margin:0 auto;" >

					<button type="submit" class="btn btn-primary btn-block btn-flat"  onclick="return clicked();">
						<?php echo lang('Label.label_unsubcribe_btn');?>
					</button>

				</div>

			</div>
		</form>
	</div>
</div>