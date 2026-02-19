<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $this->lang->line('label_add_cover');?>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/cover/Viewcover');?>"><?php echo $this->lang->line('label_cover');?></a></li>
		<li class="active"><?php echo $this->lang->line('label_add_cover');?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $this->lang->line('label_create_cover');?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url('admin/cover/create');?>" enctype="multipart/form-data">
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
					<div class="form-group">
					  <label for="exampleInputFName"><?php echo $this->lang->line('label_name');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="cover_name" placeholder="<?php echo $this->lang->line('label_enter_cover_name');?>" value="<?php echo (isset($_POST['cover_name'])) ? $_POST['cover_name']:'';?>">
					  <div class="error"><?php echo form_error('cover_name'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputFName"><?php echo $this->lang->line('label_code');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="cover_code" placeholder="<?php echo $this->lang->line('label_enter_cover_code');?>" value="<?php echo (isset($_POST['cover_code'])) ? $_POST['cover_code']:'';?>">
					  <div class="error"><?php echo form_error('cover_code'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputimage"><?php echo $this->lang->line('label_image');?> </label>
					  <input type="file" class="form-control" name="cover_image">
					  <div class="error"><?php echo form_error('cover_image'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_price');?> <span class="error"> *</span></label>
					  <input type="number" class="form-control" name="cover_price" placeholder="<?php echo $this->lang->line('label_enter_cover_price');?>" value="<?php echo (isset($_POST['cover_price'])) ? $_POST['cover_price']:'';?>">
					  <div class="error"><?php echo form_error('cover_price'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_validity_date');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control pull-right" id="date" name="validity_date">
					  <div class="error"><?php echo form_error('validity_date'); ?></div>
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