<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $this->lang->line('label_view_template');?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/template/Viewtemplate');?>"><?php echo $this->lang->line('label_mail_template');?></a></li>
        <li class="active"><?php echo $this->lang->line('label_view_template');?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
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
				<?php echo validation_errors('<div class="error">', '</div>'); ?>
				<table id="viewuser" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th><?php echo $this->lang->line('label_id');?></th>
							<th><?php echo $this->lang->line('label_name');?></th>
							<th><?php echo $this->lang->line('label_subject');?></th>
							<th><?php echo $this->lang->line('label_template');?></th>
							<th><?php echo $this->lang->line('label_template_lang');?></th>
							<th><?php echo $this->lang->line('label_created_date');?></th>
							<th><?php echo $this->lang->line('label_action');?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($templates as $template){?>
						<tr>
							<td><?php echo $template['id'];?></td>
							<td><?php echo $template['template_name'];?></td>
							<td><?php echo $template['template_subject'];?></td>
							<td><?php echo $template['template'];?></td>
							<td><?php echo $template['language'];?></td>
							<td><?php echo $template['created_date'];?></td>
							<td>
								<a href="<?php echo base_url('admin/template/edit/'.$template['id']);?>" class="btn btn-primary"><?php echo $this->lang->line('label_edit');?></a>  
								<a href="<?php echo base_url('admin/template/remove/'.$template['id']);?>" class="btn btn-danger"><?php echo $this->lang->line('label_remove');?></a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<th><?php echo $this->lang->line('label_id');?></th>
							<th><?php echo $this->lang->line('label_name');?></th>
							<th><?php echo $this->lang->line('label_subject');?></th>
							<th><?php echo $this->lang->line('label_template');?></th>
							<th><?php echo $this->lang->line('label_template_lang');?></th>
							<th><?php echo $this->lang->line('label_created_date');?></th>
							<th><?php echo $this->lang->line('label_action');?></th>
						</tr>
					</tfoot>
				</table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->