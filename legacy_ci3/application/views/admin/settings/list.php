<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SMTP Settings
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('label_home');?></a></li>
		<li class="active">SMTP Settings</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url('admin/settings/update');?>" enctype="multipart/form-data">
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
					<input type="hidden" class="form-control" name="id" value="<?php echo $settings[0]['id'];?>">
					<div class="form-group">
					  <label for="exampleInputFName">From Email <span class="error">*</span></label>
					  <input type="text" class="form-control" name="from_email" value="<?php echo $settings[0]['from_email'];?>" required>
					  <div class="error"><?php echo form_error('from_email'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputLName">Service Provider <span class="error">*</span></label>
					  <input type="text" class="form-control" name="smtp_name" value="<?php echo $settings[0]['smtp_name'];?>" required>
					  <div class="error"><?php echo form_error('smtp_name'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1">SMTP HOST <span class="error">*</span></label>
					  <input type="text" class="form-control" name="host" value="<?php echo $settings[0]['host'];?>" required>
					  <div class="error"><?php echo form_error('host'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1">PORT <span class="error"> *</span></label>
					  <input type="number" class="form-control" name="port" value="<?php echo $settings[0]['port'];?>" required>
					  <div class="error"><?php echo form_error('port'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1">USERNAME/API <span class="error">*</span></label>
					  <input type="text" class="form-control" name="username" value="<?php echo $settings[0]['username'];?>" required>
					  <div class="error"><?php echo form_error('username'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1">PASSWORD/Secret KEY <span class="error">*</span></label>
					  <input type="text" class="form-control" name="password" value="<?php echo $settings[0]['password'];?>" required>
					  <div class="error"><?php echo form_error('password'); ?></div>
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('label_update');?></button>
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