<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo lang('Label.label_view_robot');?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo lang('Label.label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/coupon/Viewcoupon');?>"><?php echo lang('Label.label_robot');?></a></li>
        <li class="active"><?php echo lang('Label.label_view_robot');?></li>
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
						<th><?php echo lang('Label.label_name');?></th>
						<th><?php echo lang('Label.label_code');?></th>
						<th><?php echo lang('Label.label_image');?></th>
						<th><?php echo lang('Label.label_price');?></th>
						<th><?php echo lang('Label.label_validity_date');?></th>
						<th><?php echo lang('Label.label_created_date');?></th>
						<th><?php echo lang('Label.label_action');?></th>
					</tr>
                </thead>
                <tbody>
					<?php foreach($coupons as $coupon){?>
					<tr>
						<td><?php echo $coupon['id'];?></td>
						<td><?php echo $coupon['coupon_name'];?></td>
						
						<td><img src="<?php echo base_url('upload').'/'.$coupon['coupon_image'];?>" alt="<?php echo $coupon['coupon_name'];?>" width="50" height="50"/></td>
						<td><?php echo $coupon['coupon_price'];?> €</td>
						<td><?php echo $coupon['validity_date'];?></td>
						<td><?php echo $coupon['created_date'];?></td>
						<td>
							<a href="<?php echo base_url('admin/coupon/edit/'.$coupon['id']);?>" class="btn btn-primary"><?php echo lang('Label.label_edit');?></a>  
							<a href="<?php echo base_url('admin/coupon/remove/'.$coupon['id']);?>" class="btn btn-danger"><?php echo lang('Label.label_remove');?></a>
						</td>
					</tr>
					<?php } ?>
                </tbody>
					<tfoot>
						<tr>
							<th><?php echo lang('Label.label_id');?></th>
							<th><?php echo lang('Label.label_name');?></th>
							<th><?php echo lang('Label.label_code');?></th>
							<th><?php echo lang('Label.label_image');?></th>
							<th><?php echo lang('Label.label_price');?></th>
							<th><?php echo lang('Label.label_validity_date');?></th>
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
  