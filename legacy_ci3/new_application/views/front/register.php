 <div class="container-fluid register-bg"  style="padding-top: 190px;">
 	<div class="register-box">
	<div class="box-header with-border">
		<h4 class="box-title"><?php echo $this->lang->line('label_create_an_account_title');?></h4>
	</div>
	<form role="form" method="post" action="<?php echo base_url('front/createprofile');?>">
		<div class="box-body">
			<?php 
			$success=$this->session->flashdata('success');
			$error=$this->session->flashdata('error');
			if(!empty($success)) { ?>
			<div class="alert alert-success">
			<?php echo $this->session->flashdata('success'); ?>
			</div>
			<?php } ?>
			<?php if(!empty($error)) { ?>
			<div class="alert alert-warning">
			<?php echo $this->session->flashdata('error');?>
			</div>
			<?php } ?>
			<div class="row" >
				<div class="col-sm-6">
					<div class="form-group">
					  <label for="exampleInputFName"><?php echo $this->lang->line('label_firstname');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="firstname" placeholder="<?php echo $this->lang->line('label_enter_firstname');?>" value="<?php echo (isset($_POST['firstname'])) ? $_POST['firstname'] : '';?>">
					  <input type="hidden"  value="<?php echo $_SESSION['site_lang'];?>" id="langcurrent" name="langcurrent">	
					  <div class="error"><?php echo form_error('firstname'); ?></div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
					  <label for="exampleInputLName"><?php echo $this->lang->line('label_lastname');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="lastname" placeholder="<?php echo $this->lang->line('label_enter_lastname');?>" value="<?php echo (isset($_POST['lastname'])) ? $_POST['lastname'] : '';?>">
					  <div class="error"><?php echo form_error('lastname'); ?></div>
					</div>
				</div>
			</div>
			<div class="row" >
				<div class="col-sm-6">
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_email_address');?> <span class="error"> *</span></label>
					  <input type="email" class="form-control" name="email" placeholder="<?php echo $this->lang->line('label_enter_email');?>" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : '';?>">
					  <div class="error"><?php echo form_error('email'); ?></div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
					  <label for="exampleInputPassword"><?php echo $this->lang->line('label_sign_in_password');?> <span class="error"> *</span></label>
					  <input type="password" class="form-control" name="password" placeholder="<?php echo $this->lang->line('label_enter_password');?>" value="<?php echo (isset($_POST['password'])) ? $_POST['password'] : '';?>">
					  <div class="error"><?php echo form_error('password'); ?></div>
					</div>
				</div>
			</div>
			<div class="row" >
				<div class="col-sm-6">
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_enter_phone');?> <span class="error"> *</span></label>
					  <input type="number" id="telephonenumbr" pattern="/^-?\d+\.?\d*$/" maxlength="10" onKeyPress="if(this.value.length==10) return false;" name="phone" class="form-control" placeholder="<?php echo $this->lang->line('label_enter_phone_number');?>" value="<?php echo (isset($_POST['phone'])) ? $_POST['phone'] : '';?>" autocomplete="off">
					 <div class="error"><?php echo form_error('phone'); ?></div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_country');?> <span class="error"> *</span></label>
					  	<select class="form-control" name="country" >
						<option value="FR" <?php if(isset($_POST['country']) && $_POST['country'] == "FR"){ echo 'selected="selected"';}?>>FR</option>
						<option value="BE" <?php if(isset($_POST['country']) && $_POST['country'] == "BE"){ echo 'selected="selected"';}?>>BE</option>
						<option value="NL" <?php if(isset($_POST['country']) && $_POST['country'] == "NL"){ echo 'selected="selected"';}?>>NL</option>
						<option value="LU" <?php if(isset($_POST['country']) && $_POST['country'] == "LU"){ echo 'selected="selected"';}?>>LU</option>
						</select>
					  <div class="error"><?php echo form_error('country'); ?></div>
					</div>
				</div>
			</div>
			<div class="row" >
				<div class="col-sm-6">
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_city');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="city" id="city_register" placeholder="<?php echo $this->lang->line('label_enter_city');?>" value="<?php echo (isset($_POST['city'])) ? $_POST['city'] : '';?>">
					  <div class="error"><?php echo form_error('city'); ?></div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_address_1');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="address1" placeholder="<?php echo $this->lang->line('label_enter_address_1');?>" value="<?php echo (isset($_POST['address1'])) ? $_POST['address1'] : '';?>">
					  <div class="error"><?php echo form_error('address1'); ?></div>
					</div>
				</div>
			</div>
			<div class="row" >
				<div class="col-sm-6">
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_address_2');?></label>
					  <input type="text" class="form-control" name="address2" placeholder="<?php echo $this->lang->line('label_enter_address_2');?>" value="<?php echo (isset($_POST['address2'])) ? $_POST['address2'] : '';?>">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
					<label for="exampleInputEmail1"><?php echo $this->lang->line('label_postcode');?> <span class="error"> *</span></label>
					  <input type="number" pattern="[0-9]{5}"  data-inputmask="'mask': '********'"  maxlength="5" onKeyPress="if(this.value.length==5) return false;" class="psotcoder form-control" name="postcode" placeholder="<?php echo $this->lang->line('label_enter_postcode');?>" value="<?php echo (isset($_POST['postcode'])) ? $_POST['postcode'] : '';?>">
					  <div class="error"><?php echo form_error('postcode'); ?></div>
					</div>
				</div>
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('label_create_an_account_title');?></button>
		</div>
	</form>
	</div>
</div>