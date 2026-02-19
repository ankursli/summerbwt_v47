<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

<!-- Content Header (Page header) -->

<section class="content-header">

  <h1>

	<?php echo $this->lang->line('label_view_store_robot');?>

  </h1>

  <ol class="breadcrumb">

	<li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('label_home');?></a></li>

	<li><a href="<?php echo base_url('admin/storerobot/Viewstore');?>"><?php echo $this->lang->line('label_stores_robot');?></a></li>

	<li class="active"><?php echo $this->lang->line('label_view_store_robot');?></li>

  </ol>

</section>



<!-- Main content -->

<section class="content">

  <div class="row">

	<div class="col-xs-12">

	  <div class="box">

		<div class="box-header">

			<a class="importuser" style="cursor:pointer;"><?php echo $this->lang->line('label_import_store');?></a>

			<div class="showuserfile" style="display:none">

				<?php echo form_open_multipart('admin/storerobot/UploadImportFile');?>

					<table style="margin-top: 20px;">

						<tr>

							<td> <?php echo $this->lang->line('label_choose_your_import_file');?> : </td>

							<td>

								<input type="file" name="storefile" id="storefile"  align="center" style="margin-left: 10px;"/>

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

					<th><?php echo $this->lang->line('label_store_name');?></th>

					<th><?php echo $this->lang->line('label_store_code');?></th>

					<th><?php echo $this->lang->line('label_store_email');?></th>

					<th><?php echo $this->lang->line('label_store_contact');?></th>

					<th><?php echo $this->lang->line('label_store_address');?></th>

					<th><?php echo $this->lang->line('label_store_city');?></th>

					<th><?php echo $this->lang->line('label_store_country');?></th>
					
					<th><?php echo $this->lang->line('label_store_postcode');?></th>

					<th><?php echo $this->lang->line('label_store_handle');?></th>

					<th><?php echo $this->lang->line('label_created_date');?></th>

					<th><?php echo $this->lang->line('label_action');?></th>

				</tr>

			</thead>

			<tbody>

				<?php foreach($stores as $store){
					
				
					
					?>

				<tr>

					<td><?php echo $store['id'];?></td>

					<td><?php echo $store['store_name'];?></td>

					<td><?php echo $store['store_code'];?></td>

					<td><?php echo $store['store_email'];?></td>

					<td><?php echo $store['store_phone'];?> <?php echo ($store['store_mobile']!=0) ? ','.$store['store_mobile']:'';?></td>

					<td><?php echo $store['store_address1'];?> <?php echo ($store['store_address2']!=null) ? ','.$store['store_address2']:'';?></td>

					<td><?php echo $store['store_city'];?></td>

				
					<td><?php echo $store['store_country'];?></td>
					<td><?php echo ($store['store_postcode']!=0) ? $store['store_postcode']:'';?></td>

					<td><?php echo ($store['store_handle']!=0) ? 'Another Store':'';?></td>

					<td><?php echo $store['created_date'];?></td>

					<td>

						<a href="<?php echo base_url('admin/storerobot/edit/'.$store['id']);?>" class="btn btn-primary"><?php echo $this->lang->line('label_edit');?></a>  

						<a href="<?php echo base_url('admin/storerobot/remove/'.$store['id']);?>" class="btn btn-danger"><?php echo $this->lang->line('label_remove');?></a>

					</td>

				</tr>

				<?php } ?>

			</tbody>

				<tfoot>

					<th><?php echo $this->lang->line('label_id');?></th>

					<th><?php echo $this->lang->line('label_store_name');?></th>

					<th><?php echo $this->lang->line('label_store_code');?></th>

					<th><?php echo $this->lang->line('label_store_email');?></th>

					<th><?php echo $this->lang->line('label_store_contact');?></th>

					<th><?php echo $this->lang->line('label_store_address');?></th>

					<th><?php echo $this->lang->line('label_store_city');?></th>

					<th><?php echo $this->lang->line('label_store_country');?></th>

					<th><?php echo $this->lang->line('label_store_postcode');?></th>

					<th><?php echo $this->lang->line('label_store_handle');?></th>

					<th><?php echo $this->lang->line('label_created_date');?></th>

					<th><?php echo $this->lang->line('label_action');?></th>

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

