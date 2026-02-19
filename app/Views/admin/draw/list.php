<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo lang('Label.label_view_draw');?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo lang('Label.label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/draw');?>"><?php echo lang('Label.label_draw');?></a></li>
        <li class="active"><?php echo lang('Label.label_view_draw');?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
				<a class="btn btn-primary" style="float:right;" href="<?php echo base_url('admin/draw/export_draw');?>">Export Robot</a>
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
						<th><?php echo lang('Label.label_robot');?></th>
						<th><?php echo lang('Label.label_stores');?></th>
						<th><?php echo lang('Label.label_another_store');?></th>
						<th><?php echo lang('Label.label_upload_draw');?></th>
						<th><?php echo lang('Label.label_draw_date');?></th>
						<th>client Type</th>
						<th><?php echo lang('Label.label_status');?></th>
					
						<th><?php echo lang('Label.label_action');?></th>
					</tr>
                </thead>
                <tbody>
					<?php 
					foreach($draws as $draw){
						$name = $draw['store_name'] ?? '';
					?>
					<tr>
						<td><?php echo $draw['draw_id'];?></td>
						<td><?php echo $draw['email'];?></td>
						<td><?php echo $draw['coupon_name'];?></td>
						<td><?php echo $draw['store_name'];?></td>
						<td><?php echo $name;?>
						<?php if($name == 'AUTRE'){ ?>
						<br/><b><?php echo strtoupper($draw['store_name_additional']);?></b>
						<br/><b>Address :</b><?php echo $draw['address']."&nbsp;".$draw['addition_address'];?> <br/>,<?php echo $draw['zipcode'].",".$draw['city'];?> <br/>			

						 <?php } ?>
						</td>
						<td>
						<?php 
						$namedoc=$draw['upload_draw'];
						$explodename=explode('.',$namedoc);
						$extesnsion=$explodename[1];
						if($extesnsion == 'pdf'){ ?>
							<a class="cimage-popup-fit-width" target="_blank" href="<?php echo base_url('upload').'/draw/'.$draw['upload_draw'];?>"><i class="fa fa-file-pdf-o" style="font-weight:bold;font-size:22px;color:#000;"></i>&nbsp; <?php echo $draw['upload_draw'];?>
							</a>
						<?php }else{ ?>
							<a class="image-popup-fit-width" href="<?php echo base_url('upload').'/draw/'.$draw['upload_draw'];?>">
								<img src="<?php echo base_url('upload').'/draw/'.$draw['upload_draw'];?>" alt="<?php echo $draw['upload_draw'];?>" width="75" height="75"/>
							</a>
							
						<?php } ?>
							
						</td>
						<td><?php echo $draw['upload_draw_date'];?></td>
						<td><?php $clienttype=''; if($draw['clienttype'] == 'particulier'){ $clienttype='Particulier'; }  else if($draw['clienttype'] == 'pro'){ $clienttype='Professionnal';  } else { $clienttype='NULL'; } echo $clienttype; ?></td>
						<td><?php if($draw['status']==1){
								echo '<span style="color:green;">Approved</span>';
							}elseif($draw['status']==2){
								echo '<span style="color:red;">Rejected</span>';
							}else{
								echo '<span style="color:blue;">Pending</span>';
							}?>
						</td>
					
						<td>
							<?php //if($draw['status']==0) {?>
							<a href="<?php echo base_url('admin/draw/edit/'.$draw['draw_id']);?>" class="btn btn-primary"><?php echo lang('Label.label_edit');?></a>  
							<?php //} ?>
							<a href="<?php echo base_url('admin/draw/remove/'.$draw['draw_id']);?>" class="btn btn-danger"><?php echo lang('Label.label_remove');?></a>
						</td>
					</tr>
					<?php } ?>
                </tbody>
					<tfoot>
						<tr>
							<th><?php echo lang('Label.label_id');?></th>
							<th><?php echo lang('Label.label_username');?></th>
							<th><?php echo lang('Label.label_robot');?></th>
							<th><?php echo lang('Label.label_stores');?></th>
							<th><?php echo lang('Label.label_another_store');?></th>
							<th><?php echo lang('Label.label_upload_draw');?></th>
							<th><?php echo lang('Label.label_draw_date');?></th>
							<th>client Type</th>
							<th><?php echo lang('Label.label_status');?></th>
						
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
  