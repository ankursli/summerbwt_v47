<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo lang('Label.label_view_refund');?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo lang('Label.label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/refund');?>"><?php echo lang('Label.label_refund');?></a></li>
        <li class="active"><?php echo lang('Label.label_view_refund');?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
		  <div class="box-header">
				<a class="btn btn-primary" style="float:right;" href="<?php echo base_url('admin/refund/export_refund');?>">Export CSV</a>
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
					    <th>Id</th>
						<th><?php echo lang('Label.label_username');?></th>
						<th><?php echo lang('Label.label_modal');?></th>
						
						<th>Roboto Infomation<?php //echo lang('Label.label_store_of_purchase');?></th>
						<th><?php echo lang('Label.label_stores');?></th>
						<th><?php echo lang('Label.label_date_of_purchase');?></th>
						<th><?php echo lang('Label.label_upload_proof');?></th>
						<th><?php echo lang('Label.label_messages');?></th>
						<th><?php echo lang('Label.label_bank_details');?></th>
						<th>client Type</th>
						<th><?php echo lang('Label.label_created_date');?></th>
						<th><?php echo lang('Label.label_action');?></th>
					</tr>
                </thead>
                <tbody>
					<?php foreach($refunds as $refund){
						$name = $refund['store_name'] ?? '';
					?>
					<tr>
						<td><?php echo $refund['refund_id'];?></td>
						<td><a href="https://www.summerbwt.fr/admin/user/viewprofile/<?php echo $refund['user_id'];?>" alt=""><?php echo $refund['email'];?></a></td>
						<td><?php echo $refund['coupon_name'];?></td>
						<td><b>Serial no :</b><?php echo $refund['roboto_serial_no'];?> <br/><b>Robot Purches Date:</b><?php echo $refund['date_of_purchase'];?> <br/></td>
						<td><?php echo $name;?>
						<?php if($name == 'AUTRE'){ ?>
						<br/><b><?php echo strtoupper($refund['store_name_additional']);?></b>
						<br/><b>Address :</b><?php echo $refund['address']."&nbsp;".$refund['addition_address'];?> <br/>,<?php echo $refund['postcode'].",".$refund['city'];?> <br/>			

						 <?php } ?>
						</td>
						<td><?php echo $refund['date_of_purchase'];?></td>
						
						<td>
						<?php 
						$namedoc=$refund['upload_proof'];
						$explodename=explode('.',$namedoc);
						$extesnsion=$explodename[1];
						if($extesnsion == 'pdf'){ ?>
							<a class="cimage-popup-fit-width" target="_blank" href="<?php echo base_url('upload').'/*op3/'.$refund['upload_proof'];?>"><i class="fa fa-file-pdf-o" style="font-weight:bold;font-size:22px;color:#000;"></i>&nbsp; <?php echo $refund['upload_proof'];?>
							</a>
						<?php }else{ ?>
							<a class="image-popup-fit-width" href="<?php echo base_url('upload').'/*op3/'.$refund['upload_proof'];?>">
								<img src="<?php echo base_url('upload').'/*op3/'.$refund['upload_proof'];?>" alt="<?php echo $refund['upload_proof'];?>" width="75" height="75"/>
							</a>
							
						<?php } ?>
							
						</td>
						<td style="word-break: break-all;"><?php echo $refund['messages'];?></td>
						<td><b>BIC :</b>
						<?php echo $refund['bank_bic'];?> <br/><b>IBAN :</b><?php echo $refund['bank_iban'];?></td>
						<td><?php $clienttype=''; if($refund['clienttype'] == 'particulier'){ $clienttype='Particulier'; }  else if($refund['clienttype'] == 'pro'){ $clienttype='Professionnal';  } else { $clienttype='NULL'; } echo $clienttype; ?></td>
						<td><?php echo $refund['created_date'];?></td>
						<td>  
							<a href="<?php echo base_url('admin/Refund/remove/'.$refund['refund_id']);?>" class="btn btn-danger"><?php echo lang('Label.label_remove');?></a>
						</td>
					</tr>
					<?php } ?>
                </tbody>
					<tfoot>
						<tr>
						<th>Id</th>
							<th><?php echo lang('Label.label_username');?></th>
						<th><?php echo lang('Label.label_modal');?></th>
						
						<th>Roboto Infomation<?php //echo lang('Label.label_store_of_purchase');?></th>
						<th><?php echo lang('Label.label_stores');?></th>
							<!--th><?php echo lang('Label.label_store_of_purchase');?></th-->
							<th><?php echo lang('Label.label_upload_proof');?></th>
							<th><?php echo lang('Label.label_messages');?></th>
							<th><?php echo lang('Label.label_bank_details');?></th>
							<th>client Type</th>
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
  