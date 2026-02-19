<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo lang('Label.label_view_block');?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo lang('Label.label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/block/Viewblock');?>"><?php echo lang('Label.label_block');?></a></li>
        <li class="active"><?php echo lang('Label.label_view_block');?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
				<?php if($blockcount < 3 ){?>
				<a href="<?php echo base_url('admin/block/Addblock');?>" style="cursor:pointer;"><?php echo lang('Label.label_add_block');?></a>
				<?php } ?>
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
						<th><?php echo lang('Label.label_id');?></th>
						<th><?php echo lang('Label.label_title');?></th>
						<th><?php echo lang('Label.label_status');?></th>
						<th><?php echo lang('Label.label_block');?></th>
						<th><?php echo lang('Label.label_action');?></th>
					</tr>
                </thead>
                <tbody>
					<?php foreach($block as $bloc){
					?>	
					<tr>
						<td><?php echo $bloc['id'];?></td>
						<td><?php echo $bloc['title'];?></td>
						<td><?php echo $bloc['status'];?></td>
						<td><?php echo $bloc['block'];?></td>
						<td>
							<a href="<?php echo base_url('admin/block/editblock/'.$bloc['id']);?>" class="btn btn-primary"><?php echo lang('Label.label_edit');?></a>  
							<a href="<?php echo base_url('admin/block/removeblock/'.$bloc['id']);?>" class="btn btn-danger"><?php echo lang('Label.label_remove');?></a>
						</td>
					</tr>
					<?php } ?>
                </tbody>
					<tfoot>
						<tr>
						<th><?php echo lang('Label.label_id');?></th>
						<th><?php echo lang('Label.label_title');?></th>
						<th><?php echo lang('Label.label_status');?></th>
						<th><?php echo lang('Label.label_block');?></th>
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