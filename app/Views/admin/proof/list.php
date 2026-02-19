<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo lang('Label.label_view_proof_of_purchase');?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo lang('Label.label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/proof');?>"><?php echo lang('Label.label_proof_of_purchase');?></a></li>
        <li class="active"><?php echo lang('Label.label_view_proof_of_purchase');?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
				<a class="btn btn-primary" style="float:right;" href="<?php echo base_url('admin/proof/export_proof');?>">Export Robot</a>
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
				<?php if(!empty($debug_msg)) { ?>
				<div class="alert alert-info">
				<?php echo $debug_msg; ?>
				</div>
				<?php } ?>
				<?php // validation_errors removed - CI4 uses validation service ?>
             <table id="viewuser" class="table table-bordered table-striped">
                <thead>
					<tr>
						<th><?php echo lang('Label.label_id');?></th>
						<th><?php echo lang('Label.label_username');?></th>
						<th><?php echo lang('Label.label_robot');?></th>
						<th>Roboto Infomation</th>
						<th><?php echo lang('Label.label_stores');?></th>
						<th><?php echo lang('Label.label_upload_proof');?></th>
						<th><?php echo lang('Label.label_proof_date');?></th>
						<th>Date of purchase the robot</th>
						<th><?php echo lang('Label.label_status');?></th>
						<th><?php echo lang('Label.label_bank_details');?></th>
						<th>client Type</th>
					
						<th><?php echo lang('Label.label_action');?></th>
					</tr>
                </thead>
                <tbody>
					<?php 
					foreach($proofs as $proof){
						$name = $proof['store_name'] ?? '';
					?>
					<tr>
						<td><?php echo $proof['purchase_id'];?></td>
						<td><?php echo $proof['email'];?></td>
						<td><?php echo $proof['robot_name'];?></td>
						<td><b>Serial no :</b><?php echo $proof['robot_serial_no'];?> <br/><b>Robot Date:</b><?php echo $proof['robot_purchase_date'];?> <br/></td>
						
						
						<td><?php echo $name;
						if($name == 'AUTRE'){ ?>
						<br/><b><?php echo strtoupper($proof['store_name_additional']);?></b>
						<br/><b>Address :</b><?php echo $proof['address']."&nbsp;".$proof['addition_address'];?> <br/>,<?php echo $proof['zipcode'].",".$proof['city'];?> <br/>			

						 <?php } ?>

					    </td>
					
						<td>
						<?php 
						$namedoc=$proof['upload_proof'];
						$explodename=explode('.',$namedoc);
						$extesnsion=$explodename[1];
						if($extesnsion == 'pdf'){ ?>
							<a class="cimage-popup-fit-width" target="_blank" href="<?php echo base_url('upload').'/op3/'.$proof['upload_proof'];?>"><i class="fa fa-file-pdf-o" style="font-weight:bold;font-size:22px;color:#000;"></i>&nbsp; <?php echo $proof['upload_proof'];?>
							</a>
						<?php }else{ ?>
							<a class="image-popup-fit-width" href="<?php echo base_url('upload').'/op3/'.$proof['upload_proof'];?>">
								<img src="<?php echo base_url('upload').'/op3/'.$proof['upload_proof'];?>" alt="<?php echo $proof['upload_proof'];?>" width="75" height="75"/>
							</a>
							
						<?php } ?>
							
						</td>
						<td><?php echo $proof['upload_proof_date'];?></td>
						<td><?php echo $proof['robot_purchase_date'];?></td>
						<td><?php if($proof['status']==1){
								echo '<span style="color:green;">Approved</span>';
							}elseif($proof['status']==2){
								echo '<span style="color:red;">Rejected</span>';
							}else{
								echo '<span style="color:blue;">Pending</span>';
							}?>
						</td>
						<td><b>BIC :</b><?php echo $proof['bic'];?> <br/><b>IBAN :</b><?php echo $proof['iban'];?></td>
						<td><?php $clienttype=''; if($proof['clienttype'] == 'particulier'){ $clienttype='Particulier'; }  else if($proof['clienttype'] == 'pro'){ $clienttype='Professionnal';  } else { $clienttype='NULL'; } echo $clienttype;?>
					
						</td>
						
						<td>
							<?php //if($proof['status']==0) {?>
							<a href="<?php echo base_url('admin/proof/edit/'.$proof['purchase_id']);?>" class="btn btn-primary"><?php echo lang('Label.label_edit');?></a>  
							<?php //} ?>
							<a href="<?php echo base_url('admin/proof/remove/'.$proof['purchase_id']);?>" class="btn btn-danger"><?php echo lang('Label.label_remove');?></a>
						</td>
					</tr>
					<?php } ?>
                </tbody>
					<tfoot>
						<tr>
						<th><?php echo lang('Label.label_id');?></th>
						<th><?php echo lang('Label.label_username');?></th>
						<th><?php echo lang('Label.label_robot');?></th>
						<th>Roboto Infomation</th>
						<th><?php echo lang('Label.label_stores');?></th>
						<th><?php echo lang('Label.label_upload_proof');?></th>
						<th><?php echo lang('Label.label_proof_date');?></th>
						<th>Date of purchase the robot</th>
						<th><?php echo lang('Label.label_status');?></th>
						<th><?php echo lang('Label.label_bank_details');?></th>
						<th>client Type</th>
						
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
  