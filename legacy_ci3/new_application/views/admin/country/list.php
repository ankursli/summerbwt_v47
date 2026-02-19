<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $this->lang->line('label_view_country');?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/country');?>"><?php echo $this->lang->line('label_country');?></a></li>
        <li class="active"><?php echo $this->lang->line('label_view_country');?></li>
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
						<th><?php echo $this->lang->line('label_country_code');?></th>
						<th><?php echo $this->lang->line('label_country_name');?></th>
						<!--th>Allow</th-->
					</tr>
                </thead>
                <tbody>
					<?php foreach($countries1 as $country1){?>
					<tr>
						<td><?php echo $country1['id'];?></td>
						<td><?php echo $country1['country_code'];?></td>
						<td><?php echo $country1['country_name'];?></td>
						<!--td><?php echo $country1['is_allow'];?></td-->
					</tr>
					<?php } ?>
                </tbody>
					<tfoot>
						<tr>
							<th><?php echo $this->lang->line('label_id');?></th>
							<th><?php echo $this->lang->line('label_country_code');?></th>
							<th><?php echo $this->lang->line('label_country_name');?></th>
							<!--th>Allow</th-->
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
	
	<section class="content">
      <div class="row">
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url('admin/country/update');?>">
				<div class="box-body">
					<?php foreach($countries as $country){?>
					<div class="col-md-3 form-group" <?php if($country['is_allow']==1){echo 'style="color:red"';}?>>
					  <input type="checkbox" <?php echo ($country['is_allow']==1) ? 'checked' : '';?> name="country_code[]" value="<?php echo $country['id'];?>" /> <?php echo $country['country_name'];?>(<?php echo $country['country_code'];?>)
					</div>
					<?php } ?>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('label_allow_restriction');?></button>
				</div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  </div>
  <!-- /.content-wrapper -->
  