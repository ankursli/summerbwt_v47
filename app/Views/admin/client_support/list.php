<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo lang('Label.label_view_client_support');?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo lang('Label.label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/client_support');?>"><?php echo lang('Label.label_client_support');?></a></li>
        <li class="active"><?php echo lang('Label.label_view_client_support');?></li>
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
						<th><?php echo lang('Label.label_id');?></th>
						<th><?php echo lang('Label.label_username');?></th>
						<th><?php echo lang('Label.label_fullname');?></th>
						<th><?php echo lang('Label.label_sign_in_email');?></th>
						<th><?php echo lang('Label.label_enter_phone');?></th>
						<th><?php echo lang('Label.label_country');?></th>
						<th><?php echo lang('Label.label_city');?></th>
						<th><?php echo lang('Label.label_address');?></th>
						<th><?php echo lang('Label.label_postcode');?></th>
						<th><?php echo lang('Label.label_created_date');?></th>
						<th><?php echo lang('Label.label_action');?></th>
					</tr>
                </thead>
                <tbody>
					<?php foreach($supports as $client){
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
							<a href="<?php echo base_url('admin/client_support/remove/'.$client['id']);?>" class="btn btn-danger"><?php echo lang('Label.label_remove');?></a>
						</td>
					</tr>
					<?php } ?>
                </tbody>
					<tfoot>
						<tr>
							<th><?php echo lang('Label.label_id');?></th>
							<th><?php echo lang('Label.label_username');?></th>
							<th><?php echo lang('Label.label_fullname');?></th>
							<th><?php echo lang('Label.label_sign_in_email');?></th>
							<th><?php echo lang('Label.label_enter_phone');?></th>
							<th><?php echo lang('Label.label_country');?></th>
							<th><?php echo lang('Label.label_city');?></th>
							<th><?php echo lang('Label.label_address');?></th>
							<th><?php echo lang('Label.label_postcode');?></th>
							<th><?php echo lang('Label.label_created_date');?></th>
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
  