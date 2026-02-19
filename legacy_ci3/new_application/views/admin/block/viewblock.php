<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $this->lang->line('label_view_block');?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/block/Viewblock');?>"><?php echo $this->lang->line('label_block');?></a></li>
        <li class="active"><?php echo $this->lang->line('label_view_block');?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
				<?php if($blockcount < 3 ){?>
				<a href="<?php echo base_url('admin/block/Addblock');?>" style="cursor:pointer;"><?php echo $this->lang->line('label_add_block');?></a>
				<?php } ?>
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
						<th><?php echo $this->lang->line('label_title');?></th>
						<th><?php echo $this->lang->line('label_status');?></th>
						<th><?php echo $this->lang->line('label_block');?></th>
						<th><?php echo $this->lang->line('label_action');?></th>
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
							<a href="<?php echo base_url('admin/block/editblock/'.$bloc['id']);?>" class="btn btn-primary"><?php echo $this->lang->line('label_edit');?></a>  
							<a href="<?php echo base_url('admin/block/removeblock/'.$bloc['id']);?>" class="btn btn-danger"><?php echo $this->lang->line('label_remove');?></a>
						</td>
					</tr>
					<?php } ?>
                </tbody>
					<tfoot>
						<tr>
						<th><?php echo $this->lang->line('label_id');?></th>
						<th><?php echo $this->lang->line('label_title');?></th>
						<th><?php echo $this->lang->line('label_status');?></th>
						<th><?php echo $this->lang->line('label_block');?></th>
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