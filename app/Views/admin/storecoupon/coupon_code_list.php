<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo lang('Label.label_view_coupon_code');?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo lang('Label.label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/storecoupon/Viewstorecoupon');?>"><?php echo lang('Label.label_store_coupon_details');?></a></li>
        <li class="active"><?php echo lang('Label.label_view_coupon_code');?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
				<a class="importuser" style="cursor:pointer;">Import Coupon</a>
				<div class="showuserfile" style="display:none">
					<?php echo form_open_multipart('admin/storecoupon/UploadImportFile');?>
						<table style="margin-top: 20px;">
							<tr>
								<td> <?php echo lang('Label.label_choose_your_import_file');?> : </td>
								<td>
									<input type="hidden" name="store_coupon_id" id="store_coupon_id"  align="center" style="margin-left: 10px;" value="<?php echo $couponcodes[0]['store_coupon_id'];?>"/>
									<input type="file" name="couponfile" id="couponfile"  align="center" style="margin-left: 10px;"/>
								</td>
								<td>
									<div class="col-lg-offset-3 col-lg-9">
										<button type="submit" name="submit" class="btn btn-primary"><?php echo lang('Label.label_import');?></button>
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
						<!--th>Store Coupon ID</th-->
						<th><?php echo lang('Label.label_coupon_code');?></th>
						<th><?php echo lang('Label.label_store_name');?></th>
						<th><?php echo lang('Label.label_robot_name');?></th>
						<th><?php echo lang('Label.label_created_date');?></th>
						<th><?php echo lang('Label.label_action');?></th>
					</tr>
                </thead>
                <tbody>
					<?php
					foreach($couponcodes as $couponcode){
						//echo '<pre>';print_r($couponcode);die;
						$coupons=$this->Mdl_Coupon->GetRecordUsers(array('id'=>$couponcode['coupon_id']));
						$stores=$this->Mdl_Store->GetRecordUsers(array('id'=>$couponcode['store_id']));
						if($couponcode['used_coupon']==1){
							$color = '#c2bfed';
						}
						if($couponcode['used_coupon']==2){
							$color = '#f5a8a8';
						}
						if($couponcode['used_coupon']==0){
							$color = '#fff';
						}
					?>
					<tr style="background-color:<?php echo $color;?>">
						<td><?php echo $couponcode['coupon_list_id'];?></td>
						<!--td><?php echo $couponcode['store_coupon_id'];?></td-->
						<td><?php echo $couponcode['coupon_code'];?></td>
						<td><?php echo $stores[0]['store_name'];?></td>
						<td><?php echo $coupons[0]['coupon_name'];?></td>
						<td><?php echo $couponcode['created_date'];?></td>
						<td> 
							<a href="<?php echo base_url('admin/storecoupon/remove_coupon/'.$couponcode['coupon_list_id']);?>" class="btn btn-danger"><?php echo lang('Label.label_remove');?></a>
						</td>
					</tr>
					<?php } ?>
                </tbody>
					<tfoot>
						<th><?php echo lang('Label.label_id');?></th>
						<!--th>Store Coupon ID</th-->
						<th><?php echo lang('Label.label_coupon_code');?></th>
						<th><?php echo lang('Label.label_store_name');?></th>
						<th><?php echo lang('Label.label_robot_name');?></th>
						<th><?php echo lang('Label.label_created_date');?></th>
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
  