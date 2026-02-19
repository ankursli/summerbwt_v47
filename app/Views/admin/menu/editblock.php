<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo lang('Label.label_edit_block');?>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo lang('Label.label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/block/Viewblock');?>"><?php echo lang('Label.label_block');?></a></li>
		<li class="active"><?php echo lang('Label.label_edit_block');?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
	  	<form role="form" method="post" action="<?php echo base_url('admin/block/updateblock/'.$block[0]['id']);?>">
		<div class="col-md-12">
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
		<div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">french</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
				<div class="box-body">
					
					<div class="form-group">
					  <label for="exampleInputTitle"><?php echo lang('Label.label_title');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="fr_title" placeholder="<?php echo lang('Label.label_enter_title');?>" value="<?php echo $frblock[0]['title'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputDate"><?php echo lang('Label.label_enter_date');?>  <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="fr_date" placeholder="<?php echo lang('Label.label_enter_date');?>" value="<?php echo $frblock[0]['date'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputmiddle_content"><?php echo lang('Label.label_middle_content');?><span class="error"> *</span> </label>
					  <input type="text" class="form-control" name="fr_middle_content" placeholder="<?php echo lang('Label.label_enter_middle_content');?>" value="<?php echo $frblock[0]['middle_content'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputbottom_content"><?php echo lang('Label.label_bottom_content');?><span class="error"> *</span> </label>
					  <input type="text" class="form-control" name="fr_bottom_content" placeholder="<?php echo lang('Label.label_enter_botttom_content');?>" value="<?php echo $frblock[0]['bottom_content'];?>">
					  <div class="error"></div>
					</div>
				</div>
				<!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
		<div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">english</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
				<div class="box-body">
					
					<div class="form-group">
					  <label for="exampleInputTitle"><?php echo lang('Label.label_title');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="en_title" placeholder="<?php echo lang('Label.label_enter_title');?>" value="<?php echo $enblock[0]['title'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputDate"><?php echo lang('Label.label_enter_date');?>  <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="en_date" placeholder="<?php echo lang('Label.label_enter_date');?>" value="<?php echo $enblock[0]['date'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputmiddle_content"><?php echo lang('Label.label_middle_content');?><span class="error"> *</span> </label>
					  <input type="text" class="form-control" name="en_middle_content" placeholder="<?php echo lang('Label.label_enter_middle_content');?>" value="<?php echo $enblock[0]['middle_content'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputbottom_content"><?php echo lang('Label.label_bottom_content');?><span class="error"> *</span> </label>
					  <input type="text" class="form-control" name="en_bottom_content" placeholder="<?php echo lang('Label.label_enter_botttom_content');?>" value="<?php echo $enblock[0]['bottom_content'];?>">
					  <div class="error"></div>
					</div>
				</div>
				<!-- /.box-body -->

            
          </div>
          <!-- /.box -->
        </div>
		<div class="col-md-12">
			<div class="box-footer">
				<div class="form-group">
					<div class="row" >
						<div class="col-sm-4">
							<label for="exampleInputBg_color"><?php echo lang('Label.label_enter_bg_color');?> <span class="error"> *</span></label>
							<input type="color" name="bg_color" class="form-control" placeholder="<?php echo lang('Label.label_enter_bg_color');?>" value="<?php echo $block[0]['bg_color'];?>">
							<div class="error"></div>
						</div>
						<div class="col-sm-4">
							<label for="exampleInputStatus"><?php echo lang('Label.label_status');?> <span class="error"> *</span></label>
							<select class="form-control" name="status" >
								<option <?php echo $block[0]['status']=="active"? 'selected': ''; ?> value="active">Active</option>
								<option <?php echo $block[0]['status']=="inactive"? 'selected': ''; ?> value="inactive">inactive</option>
							</select>
							<div class="error"></div>
						</div>
						<div class="col-sm-4">
							<label for="exampleInputBlock"><?php echo lang('Label.label_block');?> <span class="error"> *</span></label>
							<select class="form-control" name="block" >
								<option <?php echo $block[0]['block']=="block-1"? 'selected': ''; ?> value="block-1">Block-1</option>
								<option <?php echo $block[0]['block']=="block-2"? 'selected': ''; ?> value="block-2">Block-2</option>
								<option <?php echo $block[0]['block']=="block-3"? 'selected': ''; ?> value="block-3">Block-3</option>
							</select>
							<div class="error"></div>
						</div>
					</div>	
				</div>
				<button type="submit" class="btn btn-primary"><?php echo lang('Label.label_update');?></button>
			</div>
		</div>
        <!-- /.col -->
		</form>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>