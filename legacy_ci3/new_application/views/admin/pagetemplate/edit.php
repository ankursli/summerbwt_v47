<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $this->lang->line('label_edit_page');?>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/PageTemplate/Viewpage');?>"><?php echo $this->lang->line('label_page_template');?></a></li>
		<li class="active"><?php echo $this->lang->line('label_edit_page');?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $this->lang->line('label_update_template');?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url('admin/PageTemplate/update/'.$view);?>" enctype="application/x-www-form-urlencoded">
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
						<label for="exampleInputTemplate"><?php echo $this->lang->line('label_filename');?> <span class="error"> *</span></label></br>
						<input type="text" readonly name="filename" class="form-control" value="<?php echo $filename; ?>">
					</div>
					<div class="form-group">
					  <label for="exampleInputTemplate"><?php echo $this->lang->line('label_template');?> <span class="error"> *</span></label></br>
					  <textarea name="template" id="editor1" rows="15" cols="140"><?php echo $html; ?></textarea>
					  <div class="error"><?php echo form_error('template'); ?></div>
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