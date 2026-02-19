<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $this->lang->line('label_add_block');?>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/block/Viewblock');?>"><?php echo $this->lang->line('label_block');?></a></li>
		<li class="active"><?php echo $this->lang->line('label_add_block');?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      	<div class="row">
		<form role="form" method="post" action="<?php echo base_url('admin/block/createblock');?>">
			<div class="col-md-12">
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
			</div>
			<div class="col-md-6">
			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header with-border">
				<h3 class="box-title">French</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
					<div class="box-body">
						
						<?php // echo validation_errors('<div class="error">', '</div>'); ?>
						<div class="form-group">
						<label for="exampleInputTitle"><?php echo $this->lang->line('label_title');?> <span class="error"> *</span></label>
						<input type="text" class="form-control" name="fr_title" placeholder="<?php echo $this->lang->line('label_enter_title');?>" value="<?php echo (isset($_POST['title'])) ? $_POST['title'] : '';?>">
						<div class="error"><?php echo form_error('title'); ?></div>
						</div>
						<div class="form-group">
							<label for="exampleInputDate"><?php echo $this->lang->line('label_enter_date');?> <span class="error"> *</span></label>
							<input type="text" name="fr_date" class="form-control" placeholder="<?php echo $this->lang->line('label_enter_date');?>" value="<?php echo (isset($_POST['date'])) ? $_POST['date'] : '';?>">
							<div class="error"><?php echo form_error('date'); ?></div>
						</div>
						<div class="form-group">
						<label for="exampleInputmiddle_content"><?php echo $this->lang->line('label_middle_content');?><span class="error"> *</span> </label>
						<input type="text" class="form-control" name="fr_middle_content" placeholder="<?php echo $this->lang->line('label_enter_middle_content');?>" value="<?php echo (isset($_POST['middle_content'])) ? $_POST['middle_content'] : '';?>">
						<div class="error"><?php echo form_error('middle_content'); ?></div>
						</div>
						<div class="form-group">
						<label for="exampleInputbottom_content"><?php echo $this->lang->line('label_bottom_content');?> <span class="error"> *</span></label>
						<input type="text" class="form-control" name="fr_bottom_content" placeholder="<?php echo $this->lang->line('label_enter_bottom_content');?>" value="<?php echo (isset($_POST['bottom_content'])) ? $_POST['bottom_content'] : '';?>">
						<div class="error"><?php echo form_error('bottom_content'); ?></div>
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
				<h3 class="box-title">English</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				
					<div class="box-body">
						
						<?php // echo validation_errors('<div class="error">', '</div>'); ?>
						<div class="form-group">
						<label for="exampleInputTitle"><?php echo $this->lang->line('label_title');?> <span class="error"> *</span></label>
						<input type="text" class="form-control" name="en_title" placeholder="<?php echo $this->lang->line('label_enter_title');?>" value="<?php echo (isset($_POST['title'])) ? $_POST['title'] : '';?>">
						<div class="error"><?php echo form_error('title'); ?></div>
						</div>
						<div class="form-group">
							<label for="exampleInputDate"><?php echo $this->lang->line('label_enter_date');?> <span class="error"> *</span></label>
							<input type="text" name="en_date" class="form-control" placeholder="<?php echo $this->lang->line('label_enter_date');?>" value="<?php echo (isset($_POST['date'])) ? $_POST['date'] : '';?>">
							<div class="error"><?php echo form_error('date'); ?></div>
						</div>
						<div class="form-group">
						<label for="exampleInputmiddle_content"><?php echo $this->lang->line('label_middle_content');?><span class="error"> *</span> </label>
						<input type="text" class="form-control" name="en_middle_content" placeholder="<?php echo $this->lang->line('label_enter_middle_content');?>" value="<?php echo (isset($_POST['middle_content'])) ? $_POST['middle_content'] : '';?>">
						<div class="error"><?php echo form_error('middle_content'); ?></div>
						</div>
						<div class="form-group">
						<label for="exampleInputbottom_content"><?php echo $this->lang->line('label_bottom_content');?> <span class="error"> *</span></label>
						<input type="text" class="form-control" name="en_bottom_content" placeholder="<?php echo $this->lang->line('label_enter_bottom_content');?>" value="<?php echo (isset($_POST['bottom_content'])) ? $_POST['bottom_content'] : '';?>">
						<div class="error"><?php echo form_error('bottom_content'); ?></div>
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
								<label for="exampleInputBg_color"><?php echo $this->lang->line('label_enter_bg_color');?> <span class="error"> *</span></label>
								<input type="color" name="bg_color" class="form-control" placeholder="<?php echo $this->lang->line('label_enter_bg_color');?>" value="<?php echo (isset($_POST['bg_color'])) ? $_POST['bg_color'] : '';?>">
								<div class="error"><?php echo form_error('bg_color'); ?></div>
							</div>
							<div class="col-sm-4">
								<label for="exampleInputBg_color"><?php echo $this->lang->line('label_enter_opacity');?>Opacity <span class="error"> *</span></label>
								<input type="number" name="opacity" class="form-control" min="0" max="1" step="0.01" value="<?php echo (isset($_POST['opacity'])) ? $_POST['opacity'] : '';?>" />
								<!-- <input type="range" id="vol" name="vol" min="0" max="1" step="0.1"> -->
								<div class="error"><?php echo form_error('status'); ?></div>
							</div>
							<div class="col-sm-4">
								<label for="exampleInputBlock"><?php echo $this->lang->line('label_block');?> <span class="error"> *</span></label>
								<select class="form-control" name="block" >
									<?php foreach($blocks as $bloc){ ?>
									<option value="<?php echo $bloc; ?>"><?php echo $bloc; ?></option>
									<?php } ?>
								</select>
								<div class="error"><?php echo form_error('block'); ?></div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<label for="exampleInputStatus"><?php echo $this->lang->line('label_status');?> <span class="error"> *</span></label>
								<select class="form-control" name="status" >
									<option value="active">Active</option>
									<option value="inactive">inactive</option>
								</select>
								<div class="error"><?php echo form_error('status'); ?></div>
							</div>
							<div class="col-sm-8">
								<label for="exampleInputLink"><?php echo $this->lang->line('label_link');?> <span class="error"> *</span></label>
								<input type="text" name="link" class="form-control" value="<?php echo (isset($_POST['link'])) ? $_POST['link'] : '';?>" />
								<div class="error"><?php echo form_error('link'); ?></div>
							</div>
						</div>	
					</div>
					<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('label_add');?></button>
				</div>
				</form>
			</div>
			<!-- /.col -->
		</div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>