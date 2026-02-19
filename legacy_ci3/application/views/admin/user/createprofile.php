<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $this->lang->line('label_add_profile');?>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/user/Viewuser');?>"><?php echo $this->lang->line('label_user');?></a></li>
		<li class="active"><?php echo $this->lang->line('label_add_profile');?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $this->lang->line('label_create_profile');?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url('admin/user/createprofile');?>">
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
					<?php // echo validation_errors('<div class="error">', '</div>'); ?>
					<div class="form-group">
					  <label for="exampleInputFName"><?php echo $this->lang->line('label_firstname');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="firstname" placeholder="<?php echo $this->lang->line('label_enter_firstname');?>" value="<?php echo (isset($_POST['firstname'])) ? $_POST['firstname'] : '';?>">
					  <div class="error"><?php echo form_error('firstname'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputLName"><?php echo $this->lang->line('label_lastname');?> </label>
					  <input type="text" class="form-control" name="lastname" placeholder="<?php echo $this->lang->line('label_enter_lastname');?>" value="<?php echo (isset($_POST['lastname'])) ? $_POST['lastname'] : '';?>">
					  <div class="error"><?php echo form_error('lastname'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_email_address');?> <span class="error"> *</span></label>
					  <input type="email" class="form-control" name="email" placeholder="<?php echo $this->lang->line('label_enter_email');?>" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : '';?>">
					  <div class="error"><?php echo form_error('email'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputPassword"><?php echo $this->lang->line('label_sign_in_password');?> <span class="error"> *</span></label>
					  <input type="password" class="form-control" name="password" placeholder="<?php echo $this->lang->line('label_enter_password');?>" value="<?php echo (isset($_POST['password'])) ? $_POST['password'] : '';?>">
					  <div class="error"><?php echo form_error('password'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_enter_phone');?> <span class="error"> *</span></label>
					  <div class="row" >
									<div class="col-sm-3">
									<input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;"  name="countrycode" class="form-control" placeholder="<?php echo $this->lang->line('label_enter_countrycode');?>" value="<?php echo (isset($_POST['countrycode'])) ? $_POST['countrycode'] : '';?>" autocomplete="off">
								   </div>
								<div class="col-sm-9">
									<input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" name="phone" class="form-control" placeholder="<?php echo $this->lang->line('label_enter_phone_number');?>" value="<?php echo (isset($_POST['phone'])) ? $_POST['phone'] : '';?>" autocomplete="off">
							    </div>
							</div> <div class="error"><?php echo form_error('phone'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_country');?> <span class="error"> *</span></label>
					  <select class="form-control" name="country" >
						<option value="FR">FR</option>
					  </select>
					  <div class="error"><?php echo form_error('country'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_city');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="city" placeholder="<?php echo $this->lang->line('label_enter_city');?>" value="<?php echo (isset($_POST['city'])) ? $_POST['city'] : '';?>">
					  <div class="error"><?php echo form_error('city'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_address_1');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="address1" placeholder="<?php echo $this->lang->line('label_enter_address_1');?>" value="<?php echo (isset($_POST['address1'])) ? $_POST['address1'] : '';?>">
					  <div class="error"><?php echo form_error('address1'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_address_2');?></label>
					  <input type="text" class="form-control" name="address2" placeholder="<?php echo $this->lang->line('label_enter_address_2');?>" value="<?php echo (isset($_POST['address2'])) ? $_POST['address2'] : '';?>">
					  <div class="error"><?php echo form_error('address2'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_postcode');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="postcode" placeholder="<?php echo $this->lang->line('label_enter_postcode');?>" value="<?php echo (isset($_POST['postcode'])) ? $_POST['postcode'] : '';?>">
					  <div class="error"><?php echo form_error('postcode'); ?></div>
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('label_add');?></button>
				</div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>