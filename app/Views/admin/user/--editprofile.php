<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo lang('Label.label_edit_profile');?>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo lang('Label.label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/user/Viewuser');?>"><?php echo lang('Label.label_user');?></a></li>
		<li class="active"><?php echo lang('Label.label_edit_profile');?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $users[0]['lastname'];?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url('admin/user/updateprofile/'.$users[0]['id']);?>">
				<div class="box-body">
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
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo lang('Label.label_firstname');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="firstname" placeholder="<?php echo lang('Label.label_enter_firstname');?>" value="<?php echo $users[0]['firstname'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo lang('Label.label_lastname');?> </label>
					  <input type="text" class="form-control" name="lastname" placeholder="<?php echo lang('Label.label_enter_lastname');?>" value="<?php echo $users[0]['lastname'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo lang('Label.label_email_address');?> <span class="error"> *</span></label>
					  <input type="email" class="form-control" name="email" placeholder="<?php echo lang('Label.label_enter_email');?>" value="<?php echo $users[0]['email'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo lang('Label.label_enter_phone');?> <span class="error"> *</span></label>
					  <div class="row" >
									<div class="col-sm-3">
									<input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;"  name="countrycode" class="form-control" placeholder="<?php echo lang('Label.label_enter_countrycode');?>" value="<?php echo $users[0]['countrycode']; ?>" autocomplete="off">
								   </div>
								<div class="col-sm-9">
									<input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" name="phone" class="form-control" placeholder="<?php echo lang('Label.label_enter_phone_number');?>" value="<?php echo $users[0]['phone']; ?>" autocomplete="off">
							    </div>
							</div><div class="error"></div>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1"><?php echo lang('Label.label_country');?> <span class="error"> *</span></label>
						<select class="form-control" name="country" >
							<option value="FR" <?php echo ($users[0]['country']=='FR') ? 'selected' : '';?>>FR</option>
						</select>
						<div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo lang('Label.label_city');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="city" placeholder="<?php echo lang('Label.label_enter_city');?>" value="<?php echo $users[0]['city'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo lang('Label.label_address_1');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="address1" placeholder="<?php echo lang('Label.label_enter_address_1');?>" value="<?php echo $users[0]['address1'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo lang('Label.label_address_2');?></label>
					  <input type="text" class="form-control" name="address2" placeholder="<?php echo lang('Label.label_enter_address_2');?>" value="<?php echo $users[0]['address2'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo lang('Label.label_postcode');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="postcode" placeholder="<?php echo lang('Label.label_enter_postcode');?>" value="<?php echo $users[0]['postcode'];?>">
					  <div class="error"></div>
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" class="btn btn-primary"><?php echo lang('Label.label_update');?></button>
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