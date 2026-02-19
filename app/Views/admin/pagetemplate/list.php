<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo lang('Label.label_view_page');?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo lang('Label.label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/PageTemplate/Viewpage');?>"><?php echo lang('Label.label_page_template');?></a></li>
        <li class="active"><?php echo lang('Label.label_view_page');?></li>
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
				<?php // validation_errors removed - CI4 uses validation service ?>
				<table id="viewuser" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th><?php echo lang('Label.label_page');?></th>
							<th><?php echo lang('Label.label_filename');?></th>
							<th><?php echo lang('Label.label_section');?></th>
							<th>lien</th>
							<th><?php echo lang('Label.label_action');?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($pages as $page){?>
						<tr>
							<td><?php echo $page['view'];?></td>
							<td><?php echo $page['filename'];?></td>
							<td><?php echo $page['html'];?></td>
							<td><a href="<?php echo base_url().'page/'.$page['view'];?>" target="_blank"><?php echo base_url().'page/'.$page['view'];?></a></td>
							<td>
								<a href="<?php echo base_url('admin/PageTemplate/edit/'.$page['view']);?>" class="btn btn-primary"><?php echo lang('Label.label_edit');?></a>  
								<a href="<?php echo base_url('admin/PageTemplate/remove/'.$page['view']);?>" class="btn btn-danger"><?php echo lang('Label.label_remove');?></a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<th><?php echo lang('Label.label_page');?></th>
							<th><?php echo lang('Label.label_filename');?></th>
							<th><?php echo lang('Label.label_section');?></th>
							<th>lien</th>
							<th><?php echo lang('Label.label_action');?></th>
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