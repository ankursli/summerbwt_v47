 <div class="container-fluid register-bg"  style="padding-top: 190px;">
 	<div class="register-box">
	<div class="box-header with-border">
		<h4 class="box-title"><?php echo $this->lang->line('label_edit_profile');?></h4>
	</div>
	<form role="form" method="post" action="<?php echo base_url('front/updateprofile');?>">
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
			<?php // echo "<pre>"; print_r($_SESSION['front_user']); ?>
			<div class="row" >
				<div class="col-sm-6">
					<div class="form-group">
					  <label for="exampleInputFName"><?php echo $this->lang->line('label_firstname');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="firstname" placeholder="<?php echo $this->lang->line('label_enter_firstname');?>" value="<?php echo $userdata['firstname']; ?>">
					  <div class="error"><?php echo form_error('firstname'); ?></div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
					  <label for="exampleInputLName"><?php echo $this->lang->line('label_lastname');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="lastname" placeholder="<?php echo $this->lang->line('label_enter_lastname');?>" value="<?php echo $userdata['lastname']; ?>">
					  <div class="error"><?php echo form_error('lastname'); ?></div>
					</div>
				</div>
			</div>
			<div class="row" >
				<div class="col-sm-12">
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_email_address');?> <span class="error"> *</span></label>
					  <input type="email" class="form-control" readonly name="email" placeholder="<?php echo $this->lang->line('label_enter_email');?>" value="<?php echo $userdata['email']; ?>">
					  <div class="error"><?php echo form_error('email'); ?></div>
					</div>
				</div>
				<!-- div class="col-sm-6">
					<div class="form-group">
					  <label for="exampleInputPassword"><?php echo $this->lang->line('label_sign_in_password');?> <span class="error"> *</span></label>
					  <input type="password" class="form-control" name="password" placeholder="<?php echo $this->lang->line('label_enter_password');?>" value="<?php echo $userdata['password']; ?>">
					  <div class="error"><?php echo form_error('password'); ?></div>
					</div>
				</div -->
			</div>
			<div class="row" >
				<div class="col-sm-6">
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_enter_phone');?> <span class="error"> *</span></label>
					  <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" name="phone" class="form-control" placeholder="<?php echo $this->lang->line('label_enter_phone_number');?>" value="<?php echo $userdata['phone']; ?>" autocomplete="off">
					  <div class="error"><?php echo form_error('phone'); ?></div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_country');?> <span class="error"> *</span></label>
					  <select class="form-control" name="country" >
						<option value="FR" <?php echo ($userdata['country']=='FR') ? 'selected' : '';?>>FR</option>
						<option value="BE" <?php echo ($userdata['country']=='BE') ? 'selected' : '';?>>BE</option>
						<option value="NL" <?php echo ($userdata['country']=='NL') ? 'selected' : '';?>>NL</option>
						<option value="LU" <?php echo ($userdata['country']=='LU') ? 'selected' : '';?>>LU</option>
					  </select>
					  <div class="error"><?php echo form_error('country'); ?></div>
					</div>
				</div>
			</div>
			<div class="row" >
				<div class="col-sm-6">
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_city');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="city" placeholder="<?php echo $this->lang->line('label_enter_city');?>" value="<?php echo $userdata['city']; ?>">
					  <div class="error"><?php echo form_error('city'); ?></div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_address_1');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="address1" placeholder="<?php echo $this->lang->line('label_enter_address_1');?>" value="<?php echo $userdata['address1']; ?>">
					  <div class="error"><?php echo form_error('address1'); ?></div>
					</div>
				</div>
			</div>
			<div class="row" >
				<div class="col-sm-6">
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_address_2');?></label>
					  <input type="text" class="form-control" name="address2" placeholder="<?php echo $this->lang->line('label_enter_address_2');?>" value="<?php echo $userdata['address2']; ?>">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_postcode');?> <span class="error"> *</span></label>
					  <input type="number" class="form-control"  pattern="[0-9]{5}" maxlength="5" onKeyPress="if(this.value.length==5) return false;"  id="postcode"  name="postcode" placeholder="<?php echo $this->lang->line('label_enter_postcode');?>" value="<?php echo $userdata['postcode']; ?>">
					  <div class="error"><?php echo form_error('postcode'); ?></div>
					</div>
				</div>
			</div>
			<div class="row" >
				<div class="col-sm-6">
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('usr_lang');?></label>
					  <select class="form-control" name="usr_lang">
					  	<option <?php if($userdata['usr_lang'] == 'french') {echo "selected";} ?> value="french">Français</option>
					  	<option <?php if($userdata['usr_lang'] == 'english') {echo "selected";} ?> value="english">English</option>
					  </select>
					</div>
				</div>
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('label_update');?></button>
		</div>
	</form>
	</div>
</div>