<div class="content-wrapper" style="min-height: 1126px;">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        <?php echo $this->lang->line('label_add_store');?>

      </h1>

	  <ol class="breadcrumb">

        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('label_home');?></a></li>

        <li><a href="<?php echo base_url('admin/storeCover/Viewstorecover');?>"><?php echo $this->lang->line('label_cover_stores');?></a></li>

		<li class="active"><?php echo $this->lang->line('label_add_store');?></li>

      </ol>

    </section>



    <!-- Main content -->

    <section class="content">

      <div class="row">

		<div class="col-md-12">

          <!-- general form elements -->

          <div class="box box-primary">

            <div class="box-header with-border">

              <h3 class="box-title"><?php echo $this->lang->line('label_create_store');?></h3>

            </div>

            <!-- /.box-header -->

            <!-- form start -->

            <form role="form" method="post" action="<?php echo base_url('admin/storeCover/create');?>" enctype="multipart/form-data">

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

					<div class="form-group">

					  <label for="exampleInputFName"><?php echo $this->lang->line('label_store_name');?> <span class="error"> *</span></label>

					  <input type="text" class="form-control" name="store_name" placeholder="<?php echo $this->lang->line('label_enter_store_name');?>" value="<?php echo (isset($_POST['store_name'])) ? $_POST['store_name']:'';?>">

					  <div class="error"><?php echo form_error('store_name'); ?></div>

					</div>

					<div class="form-group">

					  <label for="exampleInputcode"><?php echo $this->lang->line('label_store_code');?> <span class="error"> *</span></label>

					  <input type="text" class="form-control" name="store_code" placeholder="<?php echo $this->lang->line('label_enter_store_code');?>" value="<?php echo (isset($_POST['store_code'])) ? $_POST['store_code']:'';?>">

					  <div class="error"><?php echo form_error('store_code'); ?></div>

					</div>

					<div class="form-group">

					  <label for="exampleInputFName"><?php echo $this->lang->line('label_store_email');?> <span class="error"> *</span></label>

					  <input type="email" class="form-control" name="store_email" placeholder="<?php echo $this->lang->line('label_enter_store_email');?>" value="<?php echo (isset($_POST['store_email'])) ? $_POST['store_email']:'';?>">

					  <div class="error"><?php echo form_error('store_email'); ?></div>

					</div>

					<div class="form-group">

					  <label for="exampleInputFName"><?php echo $this->lang->line('label_store_phone');?> <span class="error"> *</span></label>

					  <input type="number" class="form-control" name="store_phone" placeholder="<?php echo $this->lang->line('label_enter_store_phone');?>" value="<?php echo (isset($_POST['store_phone'])) ? $_POST['store_phone']:'';?>">

					  <div class="error"><?php echo form_error('store_phone'); ?></div>

					</div>

					<div class="form-group">

					  <label for="exampleInputFName"><?php echo $this->lang->line('label_store_mobile');?></label>

					  <input type="number" class="form-control" name="store_mobile" placeholder="<?php echo $this->lang->line('label_enter_store_mobile');?>" value="<?php echo (isset($_POST['store_mobile'])) ? $_POST['store_mobile']:'';?>">

					  <div class="error"><?php echo form_error('store_mobile'); ?></div>

					</div>

					<div class="form-group">

					  <label for="exampleInputFName"><?php echo $this->lang->line('label_store_address_1');?></label>

					  <input type="text" class="form-control" name="store_address1" placeholder="<?php echo $this->lang->line('label_enter_store_address');?>" value="<?php echo (isset($_POST['store_address1'])) ? $_POST['store_address1']:'';?>">

					  <div class="error"><?php echo form_error('store_address1'); ?></div>

					</div>

					<div class="form-group">

					  <label for="exampleInputFName"><?php echo $this->lang->line('label_store_address_2');?></label>

					  <input type="text" class="form-control" name="store_address2" placeholder="<?php echo $this->lang->line('label_enter_store_address');?>" value="<?php echo (isset($_POST['store_address2'])) ? $_POST['store_address2']:'';?>">

					  <div class="error"><?php echo form_error('store_address2'); ?></div>

					</div>

					<div class="form-group">

					  <label for="exampleInputFName"><?php echo $this->lang->line('label_store_postcode');?></label>

					  <input type="number" class="form-control" name="store_postcode" placeholder="<?php echo $this->lang->line('label_enter_store_postcode');?>" value="<?php echo (isset($_POST['store_postcode'])) ? $_POST['store_postcode']:'';?>">

					  <div class="error"><?php echo form_error('store_postcode'); ?></div>

					</div>

					<div class="form-group">

					  <label for="exampleInputFName"><?php echo $this->lang->line('label_store_city');?></label>

					  <input type="text" class="form-control" name="store_city" placeholder="<?php echo $this->lang->line('label_enter_store_city');?>" value="<?php echo (isset($_POST['store_city'])) ? $_POST['store_city']:'';?>">

					  <div class="error"><?php echo form_error('store_city'); ?></div>

					</div>

					<div class="form-group">

					  <label for="exampleInputFName"><?php echo $this->lang->line('label_store_country');?></label>
					 	 <select class="form-control" id="store_country" name="store_country" required>
								<option selected=""><?php echo $this->lang->line('label_choose_country');?></option>
									<?php foreach($countries as $getcountry){
										$option = isset($_POST['store_country']) ? $_POST['store_country'] : false;
										if($option == $getcountry['country_code']){ $selected="selected";}
										?>
										<option value="<?php echo $getcountry['country_code'];?>"  <?php echo $selected; ?>><?php echo $getcountry['country_name'];?></option>

									<?php } ?>
						</select>
					  <div class="error"><?php echo form_error('store_country'); ?></div>

					</div>

					<div class="form-group">

					  <label for="exampleInputFName"><?php echo $this->lang->line('label_store_handle');?></label>

					  <input type="checkbox" name="store_handle" value="1">

					  <div class="error"><?php echo form_error('store_handle'); ?></div>

					</div>

				</div>

				<!-- /.box-body -->

				<div class="box-footer">

					<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('label_add');?></button>

				</div>

            </form>

          </div>

          <!-- /.box -->

        </div>

        <!-- /.col -->

      </div>

      <!-- /.row -->

    </section>

    <!-- /.content -->

  </div>