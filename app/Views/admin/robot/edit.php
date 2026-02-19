<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo lang('Label.label_edit_robot');?>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo lang('Label.label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/robot/Viewrobot');?>"><?php echo lang('Label.label_robot');?></a></li>
		<li class="active"><?php echo lang('Label.label_edit_robot');?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $robots[0]['robot_name'];?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url('admin/robot/update/'.$robots[0]['id']);?>" enctype="multipart/form-data">
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
					  <label for="exampleInputFName"><?php echo lang('Label.label_name');?> <span class="error">*</span></label>
					  <input type="text" class="form-control" name="robot_name" value="<?php echo $robots[0]['robot_name'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputcode"><?php echo lang('Label.label_code');?> <span class="error">*</span></label>
					  <input type="text" class="form-control" name="robot_code" value="<?php echo $robots[0]['robot_code'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputLName"><?php echo lang('Label.label_image');?></label>
					  <input type="file" class="form-control" name="robot_image">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo lang('Label.label_price');?> <span class="error">*</span></label>
					  <input type="number" class="form-control" name="robot_price" value="<?php echo $robots[0]['robot_price'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php echo lang('Label.label_validity_date');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control pull-right" id="date" name="validity_date" value="<?php echo $robots[0]['validity_date'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
						<img src="<?php echo base_url('upload').'/'.$robots[0]['robot_image'];?>" alt="<?php echo $robots[0]['robot_name'];?>" width="50" height="50"/>
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