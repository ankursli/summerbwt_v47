<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $this->lang->line('label_view_proof_of_purchase');?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/proof');?>"><?php echo $this->lang->line('label_proof_of_purchase');?></a></li>
        <li class="active"><?php echo $this->lang->line('label_view_proof_of_purchase');?></li>
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
						<th><?php echo $this->lang->line('label_robot');?></th>
						<th>Roboto Infomation</th>
						<th><?php echo $this->lang->line('label_stores');?></th>
						<th><?php echo $this->lang->line('label_upload_proof');?></th>
						<th><?php echo $this->lang->line('label_proof_date');?></th>
						<th>Date of purchase the robot</th>
						<th><?php echo $this->lang->line('label_status');?></th>
						<th><?php echo $this->lang->line('label_bank_details');?></th>
						<th>client Type</th>
					
						<th><?php echo $this->lang->line('label_action');?></th>
					</tr>
                </thead>
                <tbody>
					<?php 
					foreach($proofs as $proof){
						if($proof['store_id']!=0){
							$anothergetstores = $this->Mdl_Storerobot->GetRecordUsers(array('id'=>$proof['store_id']));
							$name = $anothergetstores[0]['store_name'];
						}else{
							$name = '';
						}
						$robot = $this->Mdl_Robot->GetRecordUsers(array('id'=>$proof['robot_id']));
					?>
					<tr>
						<td><?php echo $proof['purchase_id'];?></td>
						<td><?php echo $proof['email'];?></td>
						<td><?php echo $robot[0]['robot_name'];?></td>
						<td><b>Serial no :</b><?php echo $proof['robot_serial_no'];?> <br/><b>Robot Date:</b><?php echo $proof['coupon_list_code'];?> <br/></td>
						
						
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
							<a href="<?php echo base_url('admin/proof/edit/'.$proof['purchase_id']);?>" class="btn btn-primary"><?php echo $this->lang->line('label_edit');?></a>  
							<?php //} ?>
							<a href="<?php echo base_url('admin/proof/remove/'.$proof['purchase_id']);?>" class="btn btn-danger"><?php echo $this->lang->line('label_remove');?></a>
						</td>
					</tr>
					<?php } ?>
                </tbody>
					<tfoot>
						<tr>
						<th><?php echo $this->lang->line('label_id');?></th>
						<th><?php echo $this->lang->line('label_username');?></th>
						<th><?php echo $this->lang->line('label_robot');?></th>
						<th>Roboto Infomation</th>
						<th><?php echo $this->lang->line('label_stores');?></th>
						<th><?php echo $this->lang->line('label_upload_proof');?></th>
						<th><?php echo $this->lang->line('label_proof_date');?></th>
						<th>Date of purchase the robot</th>
						<th><?php echo $this->lang->line('label_status');?></th>
						<th><?php echo $this->lang->line('label_bank_details');?></th>
						<th>client Type</th>
						
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
  