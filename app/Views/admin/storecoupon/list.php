<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo lang('Label.label_view_store_coupon_details');?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo lang('Label.label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/storecoupon/Viewstorecoupon');?>"><?php echo lang('Label.label_store_coupon_details');?></a></li>
        <li class="active"><?php echo lang('Label.label_view_store_coupon_details');?></li>
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
						<th><?php echo lang('Label.label_store_name');?></th>
						<th><?php echo lang('Label.label_store_robot_list');?></th>
						<th><?php echo lang('Label.label_used_limit');?></th>
						<th><?php echo lang('Label.label_created_date');?></th>
						<th><?php echo lang('Label.label_coupon');?></th>
						<th><?php echo lang('Label.label_action');?></th>
					</tr>
                </thead>
                <tbody>
					<?php 
						foreach($storecoupons as $storecoupon){
							$coupons=$this->Mdl_Coupon->GetRecordUsers(array('id'=>$storecoupon['coupon_id']));
							$stores=$this->Mdl_Store->GetRecordUsers(array('id'=>$storecoupon['store_id']));
					?>
					<tr>
						<td><?php echo $storecoupon['id'];?></td>
						<td><?php echo $stores[0]['store_name'];?></td>
						<td><?php echo $coupons[0]['coupon_name'];?></td>
						<td><?php echo $storecoupon['used_limit'];?></td>
						<td><?php echo $storecoupon['created_date'];?></td>
						<td> 
							<a href="<?php echo base_url('admin/storecoupon/coupon_code_list/'.$storecoupon['id']);?>" class="btn btn-primary"><?php echo lang('Label.label_coupon_code_list');?></a>
						</td>
						<td> 
							<a href="<?php echo base_url('admin/storecoupon/remove/'.$storecoupon['id']);?>" class="btn btn-danger"><?php echo lang('Label.label_remove');?></a>
						</td>
					</tr>
					<?php } ?>
                </tbody>
					<tfoot>
						<th><?php echo lang('Label.label_id');?></th>
						<th><?php echo lang('Label.label_store_name');?></th>
						<th><?php echo lang('Label.label_store_robot_list');?></th>
						<th><?php echo lang('Label.label_used_limit');?></th>
						<th><?php echo lang('Label.label_created_date');?></th>
						<th><?php echo lang('Label.label_coupon');?></th>
						<th><?php echo lang('Label.label_action');?></th>
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
  