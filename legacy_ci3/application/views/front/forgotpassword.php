<!-- Main content -->
    <div class="container-fluid forgetpassword-bg"  style="padding-top: 190px;">
    	<div class="forget-box">	
      <div class="row ">
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h4 class="box-title" style="text-align: center;"><?php echo $this->lang->line('label_forgot_password');?></h4>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             <form role="form" method="post" action="<?php echo base_url('front/check_email');?>" enctype="multipart/form-data">
				<div class="box-body">
					<div class="row" >
						<div class="col-sm-6" style="margin:0 auto;" >
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
						</div>
					</div>
					<div class="row" >
						<div class="col-sm-6" style="margin:0 auto;" >
							<div class="form-group">
								<label for="exampleInputLName"><?php echo $this->lang->line('label_sign_in_email');?> : <span class="error"> *</span></label>
								<input type="email" name="forgotemail" class="form-control" value="" placeholder="<?php echo $this->lang->line('label_enter_your_email');?>" >
								<input type="hidden"  value="<?php echo $_SESSION['site_lang'];?>" id="langcurrent" name="langcurrent">	
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6" style="margin:0 auto;" >
						<button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo $this->lang->line('label_reset_password_title');?></button>
					</div>
				</div>
            </form>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
  		</div>
    </div>
    <!-- /.content -->