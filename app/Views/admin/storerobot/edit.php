<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo lang('Label.label_edit_store');?>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo lang('Label.label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/storerobot/Viewstore');?>"><?php echo lang('Label.label_stores');?></a></li>
		<li class="active"><?php echo lang('Label.label_edit_store');?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo lang('Label.label_update_store');?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url('admin/storerobot/update/'.$stores[0]['id']);?>" enctype="multipart/form-data">
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
					  <label for="exampleInputFName"><?php echo lang('Label.label_store_name');?> <span class="error"> *</span></label>
					  <input type="text" class="form-control" name="store_name" placeholder="<?php echo lang('Label.label_enter_store_name');?>" value="<?php echo $stores[0]['store_name'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputFName"><?php echo lang('Label.label_store_email');?> <span class="error"> *</span></label>
					  <input type="email" class="form-control" name="store_email" placeholder="<?php echo lang('Label.label_enter_store_email');?>" value="<?php echo $stores[0]['store_email'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputFName"><?php echo lang('Label.label_store_phone');?> <span class="error"> *</span></label>
					  <input type="number" class="form-control" name="store_phone" placeholder="<?php echo lang('Label.label_enter_store_phone');?>" value="<?php echo $stores[0]['store_phone'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputFName"><?php echo lang('Label.label_store_mobile');?></label>
					  <input type="number" class="form-control" name="store_mobile" placeholder="<?php echo lang('Label.label_enter_store_mobile');?>" value="<?php echo $stores[0]['store_mobile'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputFName"><?php echo lang('Label.label_store_address_1');?></label>
					  <input type="text" class="form-control" name="store_address1" placeholder="<?php echo lang('Label.label_enter_store_address');?>" value="<?php echo $stores[0]['store_address1'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputFName"><?php echo lang('Label.label_store_address_2');?></label>
					  <input type="text" class="form-control" name="store_address2" placeholder="<?php echo lang('Label.label_enter_store_address');?>" value="<?php echo $stores[0]['store_address2'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputFName"><?php echo lang('Label.label_store_postcode');?></label>
					  <input type="number" class="form-control" name="store_postcode" placeholder="<?php echo lang('Label.label_enter_store_postcode');?>" value="<?php echo $stores[0]['store_postcode'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputFName"><?php echo lang('Label.label_store_city');?></label>
					  <input type="text" class="form-control" name="store_city" placeholder="<?php echo lang('Label.label_enter_store_city');?>" value="<?php echo $stores[0]['store_city'];?>">
					  <div class="error"></div>
					</div>
					<div class="form-group">
					  <label for="exampleInputFName"><?php echo lang('Label.label_store_country');?></label>
					  <select class="form-control" id="store_country" name="store_country" required>
						<option value=""><?php echo lang('Label.label_choose_country');?></option>
						<?php foreach($countries as $getcountry){
							$selected = ($stores[0]['store_country'] == $getcountry['country_code']) ? "selected" : "";
							?>
							<option value="<?php echo $getcountry['country_code'];?>" <?php echo $selected; ?>><?php echo $getcountry['country_name'];?></option>
						<?php } ?>
					  </select>
					  <div class="error"></div>
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" class="btn btn-primary"><?php echo lang('Label.label_update');?></button>
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