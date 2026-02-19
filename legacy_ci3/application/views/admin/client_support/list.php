<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $this->lang->line('label_view_client_support');?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/client_support');?>"><?php echo $this->lang->line('label_client_support');?></a></li>
        <li class="active"><?php echo $this->lang->line('label_view_client_support');?></li>
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
						<th><?php echo $this->lang->line('label_username');?></th>
						<th><?php echo $this->lang->line('label_fullname');?></th>
						<th><?php echo $this->lang->line('label_sign_in_email');?></th>
						<th><?php echo $this->lang->line('label_enter_phone');?></th>
						<th><?php echo $this->lang->line('label_country');?></th>
						<th><?php echo $this->lang->line('label_city');?></th>
						<th><?php echo $this->lang->line('label_address');?></th>
						<th><?php echo $this->lang->line('label_postcode');?></th>
						<th><?php echo $this->lang->line('label_created_date');?></th>
						<th><?php echo $this->lang->line('label_action');?></th>
					</tr>
                </thead>
                <tbody>
					<?php foreach($clients as $client){
						$countrycode= $client['countrycode'];
						if($countrycode!=''){
							$phone="+".$countrycode."".$client['phone'];
						}else{
							$phone=$client['phone'];
						}
						
						
					?>
					<tr>
						<td><?php echo $client['id'];?></td>
						<td><?php echo $client['useremail'];?></td>
						<td><?php echo $client['firstname'];?> <?php echo $client['lastname'];?></td>
						<td><?php echo $client['email'];?></td>
						<td><?php echo $phone;?></td>
						<td><?php echo $client['country'];?></td>
						<td><?php echo $client['city'];?></td>
						<td><?php echo $client['address1'];?> <?php echo $client['address2'];?></td>
						<td><?php echo $client['postcode'];?></td>
						<td><?php echo $client['created_date'];?></td>
						<td>  
							<a href="<?php echo base_url('admin/client_support/remove/'.$client['id']);?>" class="btn btn-danger"><?php echo $this->lang->line('label_remove');?></a>
						</td>
					</tr>
					<?php } ?>
                </tbody>
					<tfoot>
						<tr>
							<th><?php echo $this->lang->line('label_id');?></th>
							<th><?php echo $this->lang->line('label_username');?></th>
							<th><?php echo $this->lang->line('label_fullname');?></th>
							<th><?php echo $this->lang->line('label_sign_in_email');?></th>
							<th><?php echo $this->lang->line('label_enter_phone');?></th>
							<th><?php echo $this->lang->line('label_country');?></th>
							<th><?php echo $this->lang->line('label_city');?></th>
							<th><?php echo $this->lang->line('label_address');?></th>
							<th><?php echo $this->lang->line('label_postcode');?></th>
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
  