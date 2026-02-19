<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $this->lang->line('label_add_store_coupon_details');?>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/storecoupon/Viewstorecoupon');?>"><?php echo $this->lang->line('label_store_coupon_details');?></a></li>
		<li class="active"><?php echo $this->lang->line('label_add_store_coupon_details');?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $this->lang->line('label_create_store_coupon_details');?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url('admin/storecoupon/create');?>" enctype="multipart/form-data">
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
					  <label for="exampleInputFName"><?php echo $this->lang->line('label_store_name');?> <span class="error"> *</span></label>
					  <select class="form-control" name="store_id">
						<?php foreach($stores as $store){?>
							<option value="<?php echo $store['id'];?>"><?php echo $store['store_name'];?></option>
						<?php } ?>
					  </select>
					  <div class="error"><?php echo form_error('store_id'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputFName"><?php echo $this->lang->line('label_robot');?> <span class="error"> *</span></label>
					  <select class="form-control" name="coupon_id">
						<?php foreach($coupons as $coupon){?>
							<option value="<?php echo $coupon['id'];?>"><?php echo $coupon['coupon_name'];?></option>
						<?php } ?>
					  </select>
					  <div class="error"><?php echo form_error('coupon_id'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_used_limit');?></label>
					  <input type="number" class="form-control" name="used_limit" value="<?php echo (isset($_POST['used_limit'])) ? $_POST['used_limit']:'';?>">
					  <div class="error"><?php echo form_error('used_limit'); ?></div>
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