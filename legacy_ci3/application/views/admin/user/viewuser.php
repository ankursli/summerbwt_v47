<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $this->lang->line('label_view_user');?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/user/Viewuser');?>"><?php echo $this->lang->line('label_user');?></a></li>
        <li class="active"><?php echo $this->lang->line('label_view_user');?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
				<a class="importuser" style="cursor:pointer;"><?php echo $this->lang->line('label_import_user');?></a>
				<div class="showuserfile" style="display:none">
					<?php echo form_open_multipart('admin/user/UploadImportFile');?>
						<table style="margin-top: 20px;">
							<tr>
								<td> <?php echo $this->lang->line('label_choose_your_import_file');?> : </td>
								<td>
									<input type="file" name="userfile" id="userfile"  align="center" style="margin-left: 10px;"/>
								</td>
								<td>
									<div class="col-lg-offset-3 col-lg-9">
										<button type="submit" name="submit" class="btn btn-primary"><?php echo $this->lang->line('label_import');?></button>
									</div>
								</td>
							</tr>
						</table>
					</form>
				</div>
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
						<th><?php echo $this->lang->line('label_fullname');?></th>
						<th><?php echo $this->lang->line('label_sign_in_email');?></th>
						<th><?php echo $this->lang->line('label_enter_phone');?></th>
						<th><?php echo $this->lang->line('label_country');?></th>
						<th><?php echo $this->lang->line('label_city');?></th>
						<th><?php echo $this->lang->line('label_address');?></th>
						<th><?php echo $this->lang->line('label_postcode');?></th>
						<th><?php echo $this->lang->line('label_date_of_subscription');?></th>
						<th><?php echo $this->lang->line('label_action');?></th>
					</tr>
                </thead>
                <tbody>
					<?php foreach($users as $user){
					$countrycode=  $user['countrycode'];
					if($countrycode!=''){
						$phone="+".$countrycode."". $user['phone'];
					}else{
						$phone= $user['phone'];
					}
					?>	
					<tr>
						<td><?php echo $user['id'];?></td>
						<td><?php echo $user['firstname'];?> <?php echo $user['lastname'];?></td>
						<td><?php echo $user['email'];?></td>
						<td><?php echo $phone;?></td>
						<td><?php echo $user['country'];?></td>
						<td><?php echo $user['city'];?></td>
						<td><?php echo $user['address1'];?> <?php echo $user['address2'];?></td>
						<td><?php echo $user['postcode'];?></td>
						<td><?php echo $user['created_date'];?></td>
						<td>
							<a href="<?php echo base_url('admin/user/viewprofile/'.$user['id']);?>" class="btn btn-info"><?php echo $this->lang->line('label_view');?></a> 
							<a href="<?php echo base_url('admin/user/editprofile/'.$user['id']);?>" class="btn btn-primary"><?php echo $this->lang->line('label_edit');?></a>  
							<a href="<?php echo base_url('admin/user/removeprofile/'.$user['id']);?>" class="btn btn-danger"><?php echo $this->lang->line('label_remove');?></a>
						</td>
					</tr>
					<?php } ?>
                </tbody>
					<tfoot>
						<tr>
							<th><?php echo $this->lang->line('label_id');?></th>
							<th><?php echo $this->lang->line('label_fullname');?></th>
							<th><?php echo $this->lang->line('label_sign_in_email');?></th>
							<th><?php echo $this->lang->line('label_enter_phone');?></th>
							<th><?php echo $this->lang->line('label_country');?></th>
							<th><?php echo $this->lang->line('label_city');?></th>
							<th><?php echo $this->lang->line('label_address');?></th>
							<th><?php echo $this->lang->line('label_postcode');?></th>
							<th><?php echo $this->lang->line('label_date_of_subscription');?></th>
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