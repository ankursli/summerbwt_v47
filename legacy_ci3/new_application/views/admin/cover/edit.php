<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $this->lang->line('label_edit_cover');?>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/Cover/Viewcover');?>"><?php echo $this->lang->line('label_cover');?></a></li>
		<li class="active"><?php echo $this->lang->line('label_edit_cover');?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $covers[0]['cover_name'];?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url('admin/cover/update/'.$covers[0]['id']);?>" enctype="multipart/form-data">
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
					  <label for="exampleInputFName"><?php echo $this->lang->line('label_name');?> <span class="error">*</span></label>
					  <input type="text" class="form-control" name="cover_name" value="<?php echo $covers[0]['cover_name'];?>">
					  <div class="error"><?php echo form_error('cover_name'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputcode"><?php echo $this->lang->line('label_code');?> <span class="error">*</span></label>
					  <input type="text" class="form-control" name="cover_code" value="<?php echo $covers[0]['cover_code'];?>">
					  <div class="error"><?php echo form_error('cover_code'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputLName"><?php echo $this->lang->line('label_image');?></label>
					  <input type="file" class="form-control" name="cover_image">
					  <div class="error"><?php echo form_error('cover_image'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_price');?> <span class="error">*</span></label>
					  <input type="number" class="form-control" name="cover_price" value="<?php echo $covers[0]['cover_price'];?>">
					  <div class="error"><?php echo form_error('cover_price'); ?></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo $this->lang->line('label_validity_date');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control pull-right" id="date" name="validity_date" value="<?php echo $covers[0]['validity_date'];?>">
					  <div class="error"><?php echo form_error('validity_date'); ?></div>
					</div>
					<div class="form-group">
						<img src="<?php echo base_url('upload').'/'.$covers[0]['cover_image'];?>" alt="<?php echo $covers[0]['cover_name'];?>" width="50" height="50"/>
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