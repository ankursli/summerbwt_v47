<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= lang('Label.label_view_user');?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?= lang('Label.label_home');?></a></li>
        <li><a href="<?= base_url('admin/user/Viewuser');?>"><?= lang('Label.label_user');?></a></li>
        <li class="active"><?= lang('Label.label_view_user');?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
				<a class="importuser" style="cursor:pointer;"><?= lang('Label.label_import_user');?></a>
				<div class="showuserfile" style="display:none">
					<?= form_open_multipart('admin/user/UploadImportFile');?>
						<table style="margin-top: 20px;">
							<tr>
								<td> <?= lang('Label.label_choose_your_import_file');?> : </td>
								<td>
									<input type="file" name="userfile" id="userfile"  align="center" style="margin-left: 10px;"/>
								</td>
								<td>
									<div class="col-lg-offset-3 col-lg-9">
										<button type="submit" name="submit" class="btn btn-primary"><?= lang('Label.label_import');?></button>
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
				$success = session()->getFlashdata('success');
				$error = session()->getFlashdata('error');
				if(!empty($success)) { ?>
				<div class="alert alert-success">
				<?= session()->getFlashdata('success'); ?>
				</div>
				<?php } ?>
				<?php if(!empty($error)) { ?>
				<div class="alert alert-warning">
				<?= session()->getFlashdata('error');?>
				</div>
				<?php } ?>
				<?= \Config\Services::validation()->listErrors(); ?>
              <table id="viewuser" class="table table-bordered table-striped">
                <thead>
					<tr>
						<th><?= lang('Label.label_id');?></th>
						<th><?= lang('Label.label_fullname');?></th>
						<th><?= lang('Label.label_sign_in_email');?></th>
						<th><?= lang('Label.label_enter_phone');?></th>
						<th><?= lang('Label.label_country');?></th>
						<th><?= lang('Label.label_city');?></th>
						<th><?= lang('Label.label_address');?></th>
						<th><?= lang('Label.label_postcode');?></th>
						<th><?= lang('Label.label_date_of_subscription');?></th>
						<th><?= lang('Label.label_action');?></th>
					</tr>
                </thead>
                <tbody>
					<?php if(!empty($users)): ?>
					<?php foreach($users as $user){
					$countrycode =  $user['countrycode'];
					if($countrycode!=''){
						$phone="+".$countrycode."". $user['phone'];
					}else{
						$phone= $user['phone'];
					}
					?>	
					<tr>
						<td><?= $user['id'];?></td>
						<td><?= $user['firstname'];?> <?= $user['lastname'];?></td>
						<td><?= $user['email'];?></td>
						<td><?= $phone;?></td>
						<td><?= $user['country'];?></td>
						<td><?= $user['city'];?></td>
						<td><?= $user['address1'];?> <?= $user['address2'];?></td>
						<td><?= $user['postcode'];?></td>
						<td><?= $user['created_date'];?></td>
						<td>
							<a href="<?= base_url('admin/user/viewprofile/'.$user['id']);?>" class="btn btn-info"><?= lang('Label.label_view');?></a> 
							<a href="<?= base_url('admin/user/editprofile/'.$user['id']);?>" class="btn btn-primary"><?= lang('Label.label_edit');?></a>  
							<a href="<?= base_url('admin/user/removeprofile/'.$user['id']);?>" class="btn btn-danger"><?= lang('Label.label_remove');?></a>
						</td>
					</tr>
					<?php } ?>
					<?php endif; ?>
                </tbody>
					<tfoot>
						<tr>
							<th><?= lang('Label.label_id');?></th>
							<th><?= lang('Label.label_fullname');?></th>
							<th><?= lang('Label.label_sign_in_email');?></th>
							<th><?= lang('Label.label_enter_phone');?></th>
							<th><?= lang('Label.label_country');?></th>
							<th><?= lang('Label.label_city');?></th>
							<th><?= lang('Label.label_address');?></th>
							<th><?= lang('Label.label_postcode');?></th>
							<th><?= lang('Label.label_date_of_subscription');?></th>
							<th><?= lang('Label.label_action');?></th>
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