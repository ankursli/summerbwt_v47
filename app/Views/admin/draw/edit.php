<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo lang('Label.label_edit_draw');?>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo lang('Label.label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/draw');?>"><?php echo lang('Label.label_draw');?></a></li>
		<li class="active"><?php echo lang('Label.label_edit_draw');?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $draws[0]['email'];?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url('admin/draw/finalupdate?draw='.$draws[0]['draw_id']);?>" enctype="multipart/form-data">
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
					<div class="form-group">
						<label><?php echo lang('Label.label_upload_proof');?> </label><br>
						<a class="image-popup-fit-width" href="<?php echo base_url('upload').'/draw/'.$draws[0]['upload_draw'];?>">
							<img src="<?php echo base_url('upload').'/draw/'.$draws[0]['upload_draw'];?>" alt="<?php echo $draws[0]['upload_draw'];?>" width="75" height="75"/>
						</a>
					</div>
					<!--div class="form-group">
						<label><?php echo lang('Label.label_username');?> :</label>
						<span><?php echo $draws[0]['email'];?></span>
					</div-->
					<div class="form-group">
						<label><?php echo lang('Label.label_store');?> :</label>
						<span><?php echo $draws[0]['store_name'];?></span>
					</div>
					<?php 
					if($draws[0]['another_store_handle']!=0){
						$anothergetstores = $this->Mdl_Store->GetRecordUsers(array('id'=>$draws[0]['another_store_handle']));
						$name = $anothergetstores[0]['store_name'];
						?>
						<div class="form-group">
							<label><?php echo lang('Label.label_another_store');?> :</label>
							<span><?php echo $name;?></span>
						</div>
						<?php 
					}
					?>
					<?php if(!empty($draws[0]['coupon_list_code'])){?>
					<div class="form-group">
						<label><?php echo lang('Label.label_coupon');?> :</label>
						<span><?php echo $draws[0]['coupon_list_code'];?></span>
					</div>
					<?php } ?>
					<div class="form-group">
						<label><?php echo lang('Label.label_status');?> :</label>
							<?php if($draws[0]['status']==1){
								echo '<span style="color:green;">'.lang('Label.label_approved').'</span>';
							}elseif($draws[0]['status']==2){
								echo '<span style="color:red;">'.lang('Label.label_rejected').'</span>';
							}else{
								echo '<span style="color:blue;">'.lang('Label.label_pending').'</span>';
							}?>
					</div>
					<div class="form-group">
						<label><?php echo lang('Label.label_applied_date');?> :</label>
						<span><?php echo $draws[0]['coupon_status_date'];?></span>
					</div>
					<div class="form-group" style="display:none;">
						<select name="coupon">
							<?php 
							foreach($couponcodes as $couponcode){
								if($draws[0]['coupon_list_code']==$couponcode['coupon_code']){
									$selected = "selected='selected'";
								}else{
									$selected="";
								}
							?>
							<option value="<?php echo $couponcode['coupon_code'];?>" <?php echo $selected;?>><?php echo $couponcode['coupon_code'];?></option>
							<?php } ?>
						</select>
					</div>
					<?php if($draws[0]['status']==0){?>
					<input type="submit" value="<?php echo lang('Label.label_approved');?>" name="Approved" class="btn btn-primary">
					<!--input type="submit" value="<?php echo lang('Label.label_rejected');?>" name="<?php echo lang('Label.label_rejected');?>" class="btn btn-danger"-->
					<a class="btn btn-danger" data-toggle="modal" data-target="#rejectmodal-<?php echo $draws[0]['draw_id'];?>"><?php echo lang('Label.label_rejected');?></a>
					<?php } ?>
				</div>
			</form>
			<!-- Modal -->
					<div id="rejectmodal-<?php echo $draws[0]['draw_id'];?>" class="modal fade" role="dialog">
					  <div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><?php echo lang('Label.label_coupon_code_reject_request');?></h4>
						  </div>
						<form method="post" action="<?php echo base_url('admin/draw/rejectdraw');?>" enctype="multipart/form-data">
							<div class="modal-body">
								<div class="box-body">
									<input type="hidden" value="<?php echo $draws[0]['draw_id'];?>" name="draw">
									<input type="hidden" value="2" name="status">
									<div class="form-group">
									  <label for="editor1"><?php echo lang('Label.label_send_mail_template');?> <span class="error"> *</span></label></br>
									  <textarea name="template" id="editor1" rows="10" cols="80" required>Votre coupon actuel est rejeté. Pour plus de coupon, veuillez demander au vendeur en magasin les coupons de 15 € à l'achat de 150 € ou plus.</textarea>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" name="Rejected" value="Rejected" class="btn btn-primary"><?php echo lang('Label.label_send_mail');?></button>
							</div>
						</form>
						</div>
					  </div>
					</div>
					<?php /*
					<table id="viewuser" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th><?php echo lang('Label.label_id');?></th>
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
								//echo '<pre>';print_r($couponcode);
								$coupons=$this->Mdl_Coupon->GetRecordUsers(array('id'=>$couponcode['coupon_id']));
								$stores=$this->Mdl_Store->GetRecordUsers(array('id'=>$couponcode['store_id']));
								if($couponcode['used_coupon']==1){
									$color = '#d4edda';
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
								<td><?php echo $couponcode['coupon_code'];?></td>
								<td><?php echo $stores[0]['store_name'];?></td>
								<td><?php echo $coupons[0]['coupon_name'];?></td>
								<td><?php echo $couponcode['created_date'];?></td>
								<td> 
									<?php if($couponcode['used_coupon']==0){?>
									<a href="<?php echo base_url('admin/draw/update?purchase='.$draws[0]['draw_id'].'&status=1&coupon='.$couponcode['coupon_code']);?>" class="btn btn-primary"><?php echo lang('Label.label_approved');?></a>
									<a class="btn btn-danger" data-toggle="modal" data-target="#rejectmodal-<?php echo $couponcode['coupon_list_id'];?>"><?php echo lang('Label.label_rejected');?></a>
									<?php } ?>
									<?php if($couponcode['used_coupon']==1){?>
									<a class="btn btn-danger" data-toggle="modal" data-target="#rejectmodal-<?php echo $couponcode['coupon_list_id'];?>"><?php echo lang('Label.label_rejected');?></a>
									<?php } ?>
									<?php if($couponcode['used_coupon']==2){ ?>
									<a href="<?php echo base_url('admin/draw/update?purchase='.$draws[0]['draw_id'].'&status=1&coupon='.$couponcode['coupon_code']);?>" class="btn btn-primary"><?php echo lang('Label.label_approved');?></a>
									<?php } ?>
									<!-- Modal -->
									<div id="rejectmodal-<?php echo $couponcode['coupon_list_id'];?>" class="modal fade" role="dialog">
									  <div class="modal-dialog">
										<!-- Modal content-->
										<div class="modal-content">
										  <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title"><?php echo lang('Label.label_coupon_code_reject_request');?> - <?php echo $couponcode['coupon_code'];?></h4>
										  </div>
										<form method="post" action="<?php echo base_url('admin/draw/update');?>" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="box-body">
													<input type="hidden" value="<?php echo $draws[0]['draw_id'];?>" name="purchase">
													<input type="hidden" value="<?php echo $couponcode['coupon_code'];?>" name="coupon">
													<input type="hidden" value="2" name="status">
													<div class="form-group">
													  <label for="exampleInputTemplate"><?php echo lang('Label.label_send_mail_template');?> <span class="error"> *</span></label></br>
													  <textarea name="template" rows="8" cols="70" required></textarea>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="submit" class="btn btn-primary"><?php echo lang('Label.label_send_mail');?></button>
											</div>
										</form>
										</div>
									  </div>
									</div>
								</td>
							</tr>
							<?php } ?>
						</tbody>
						<tfoot>
							<th><?php echo lang('Label.label_id');?></th>
							<th><?php echo lang('Label.label_coupon_code');?></th>
							<th><?php echo lang('Label.label_store_name');?></th>
							<th><?php echo lang('Label.label_robot_name');?></th>
							<th><?php echo lang('Label.label_created_date');?></th>
							<th><?php echo lang('Label.label_action');?></th>
						</tfoot>
					 </table>*/?>
			</div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
    