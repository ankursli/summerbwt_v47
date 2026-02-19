<div class="content-wrapper" style="min-height: 1126px;">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        <?php echo $this->lang->line('label_add_template');?>

      </h1>

	  <ol class="breadcrumb">

        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('label_home');?></a></li>

        <li><a href="<?php echo base_url('admin/template/Viewtemplate');?>"><?php echo $this->lang->line('label_mail_template');?></a></li>

		<li class="active"><?php echo $this->lang->line('label_add_template');?></li>

      </ol>

    </section>



    <!-- Main content -->

    <section class="content">

      <div class="row">

		<div class="col-md-12">

          <!-- general form elements -->

          <div class="box box-primary">

            <div class="box-header with-border">

              <h3 class="box-title"><?php echo $this->lang->line('label_create_template');?></h3>

            </div>

            <!-- /.box-header -->

            <!-- form start -->

            <form role="form" method="post" action="<?php echo base_url('admin/template/create');?>" enctype="multipart/form-data">

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

					  <label for="exampleInputTemplate"><?php echo $this->lang->line('label_name');?> <span class="error"> *</span></label></br>

					  <input type="text" name="template_name" class="form-control">

					  <div class="error"><?php echo form_error('template_name'); ?></div>

					</div>

					<div class="form-group">

					  <label for="exampleInputTemplate"><?php echo $this->lang->line('label_subject');?> <span class="error"> *</span></label></br>

					  <input type="text" name="template_subject" class="form-control">

					  <div class="error"><?php echo form_error('template_subject'); ?></div>

					</div>

					<div class="form-group">

					  <label for="exampleInputTemplate"><?php echo $this->lang->line('label_template_lang');?> <span class="error"> *</span></label></br>

					  <select name="template_language" class="form-control">

						  <option <?php if($templates[0]['template_language'] == "FR"){echo "selected"; }?> value="FR">Français</option>

						  <option <?php if($templates[0]['template_language'] == "EN"){echo "selected"; }?> value="EN">English</option>

						  <option <?php if($templates[0]['template_language'] == "NL"){echo "selected"; }?> value="NL">Netherland</option>

					  </select>

					  <div class="error"><?php echo form_error('template_language'); ?></div>

					</div>

					<div class="form-group">

					  <label for="exampleInputTemplate"><?php echo $this->lang->line('label_template_type');?></label></br>

					  <select name="template_type" class="form-control">

					  		<option value="0">Select Option</option>
						  <option <?php if($templates[0]['template_type'] == "welcome"){echo "selected"; }?> value="welcome">Welcome</option>

						  <option <?php if($templates[0]['template_type'] == "forgotpassword"){echo "selected"; }?> value="forgotpassword">Forgot Password</option>

						  <option <?php if($templates[0]['template_type'] == "offerrobot"){echo "selected"; }?> value="offerrobot">Offer Robot</option>

						  <option <?php if($templates[0]['template_type'] == "watertreatment"){echo "selected"; }?> value="watertreatment">Water Treatment</option>

						  <option <?php if($templates[0]['template_type'] == "contract"){echo "selected"; }?> value="contract">Contract</option>

					  </select>

					</div>

					<div class="form-group">

					  <label for="exampleInputTemplate"><?php echo $this->lang->line('label_template');?> <span class="error"> *</span></label></br>

					  <textarea name="template" id="editor1" rows="15" cols="140"></textarea>

					  <div class="error"><?php echo form_error('template'); ?></div>

					  <!--textarea id="editor1" name="template" rows="10" cols="80"></textarea-->

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