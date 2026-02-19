<!-- Main content -->
    <div class="container-fluid support-bg"  style="padding-top: 150px;">
    	<div class="support-box">
      <div class="row">
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h4 class="box-title" style="text-align: center;" ><?php echo $this->lang->line('label_client_support');?></h4>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url('front/create_support');?>" enctype="multipart/form-data" >
				<div class="box-body">
					<div class="row" >
						<div class="col-sm-12">
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
						</div>
					</div>
					<div class="row" >
						<div class="col-sm-6">
							<div class="form-group">
								<label for="First Name"><?php echo $this->lang->line('label_firstname');?> <span class="error"> *</span></label>
								<input type="text" name="firstname" class="form-control" placeholder="<?php echo $this->lang->line('label_enter_firstname');?>" value="<?php echo (isset($_POST['firstname'])) ? $_POST['firstname'] : '';?>" autocomplete="off">
								<div class="error"><?php echo form_error('firstname'); ?></div>
							</div>
						</div>
						<div class="col-sm-6" >
							<div class="form-group">
								<label for="Last Name"><?php echo $this->lang->line('label_lastname');?> <span class="error"> *</span></label>
								<input type="text" name="lastname" class="form-control" placeholder="<?php echo $this->lang->line('label_enter_lastname');?>" value="<?php echo (isset($_POST['lastname'])) ? $_POST['lastname'] : '';?>" autocomplete="off">
								<div class="error"><?php echo form_error('lastname'); ?></div>
							</div>
						</div>
					</div>
					
					<div class="row" >
						<div class="col-sm-6" >
							<div class="form-group">
								<label for="Email"><?php echo $this->lang->line('label_sign_in_email');?> <span class="error"> *</span></label>
								<input type="email" name="email" class="form-control" placeholder="<?php echo $this->lang->line('label_enter_email');?>" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : '';?>" autocomplete="off">
								<div class="error"><?php echo form_error('email'); ?></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="Phone No."><?php echo $this->lang->line('label_enter_phone');?> <span class="error"> *</span></label>
								<input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" name="phone" class="form-control" placeholder="<?php echo $this->lang->line('label_enter_phone_number');?>" value="<?php echo (isset($_POST['phone'])) ? $_POST['phone'] : '';?>" autocomplete="off">
							   <div class="error"><?php echo form_error('phone'); ?></div>
							</div>
						</div>
					</div>					
					<div class="row" >
						<div class="col-sm-6" >
							<div class="form-group">
								<label for="Address 1"><?php echo $this->lang->line('label_address_1');?> <span class="error"> *</span></label>
								<input type="text" name="address1" class="form-control" placeholder="<?php echo $this->lang->line('label_enter_address_1');?>" value="<?php echo (isset($_POST['address1'])) ? $_POST['address1'] : '';?>" autocomplete="off">
								<div class="error"><?php echo form_error('address1'); ?></div>
							</div>
						</div>
						<div class="col-sm-6" >
							<div class="form-group">
								<label for="Address 2"><?php echo $this->lang->line('label_address_2');?> </label>
								<input type="text" name="address2" class="form-control" placeholder="<?php echo $this->lang->line('label_enter_address_2');?>" value="<?php echo (isset($_POST['address2'])) ? $_POST['address2'] : '';?>" autocomplete="off">
								<div class="error"><?php echo form_error('address2'); ?></div>
							</div>
						</div>
					</div>					
					<div class="row" >
						<div class="col-sm-6" >
							<div class="form-group">
								<label for="Postcode"><?php echo $this->lang->line('label_postcode');?> <span class="error"> *</span></label>
								<input type="text"  pattern="[0-9]{5}" maxlength="5" onKeyPress="if(this.value.length==5) return false;"  id="postcode" name="postcode" class="form-control" placeholder="<?php echo $this->lang->line('label_enter_postcode');?>" value="<?php echo (isset($_POST['postcode'])) ? $_POST['postcode'] : '';?>" autocomplete="off">
								<div class="error"><?php echo form_error('postcode'); ?></div>
							</div>
						</div>
						<div class="col-sm-6" >
							<div class="form-group">
								<label for="City"><?php echo $this->lang->line('label_city');?> <span class="error"> *</span></label>
								<input type="text" name="city" class="form-control" placeholder="<?php echo $this->lang->line('label_enter_city');?>" value="<?php echo (isset($_POST['city'])) ? $_POST['city'] : '';?>" autocomplete="off">
								<div class="error"><?php echo form_error('city'); ?></div>
							</div>
						</div>
					</div>					
					<div class="row" >
						<div class="col-sm-6" >													<div class="form-group">								<label for="your_request"><?php echo $this->lang->line('label_your_request');?> <span class="error"> *</span></label>								<input type="text" name="your_request" class="form-control" placeholder="<?php echo $this->lang->line('label_enter_your_request');?>" value="<?php echo (isset($_POST['your_request'])) ? $_POST['your_request'] : '';?>" autocomplete="off">								<div class="error"><?php echo form_error('your_request'); ?></div>							</div>
						
						</div>
						<div class="col-sm-6" >													<div class="form-group">								<label for="Country"><?php echo $this->lang->line('label_country');?> <span class="error"> *</span></label>								<select class="form-control" name="country" >									<?php if(isset($_POST['country'])){ $selected = 'selected="selected"';}else{$selected='';}?>									<option value="" <?php echo $selected;?> ><?php echo $this->lang->line('label_select_country');?></option>									<option value="FR" <?php echo $selected;?> >FR</option>									<option value="BE" <?php echo $selected;?> >BE</option>									<option value="NL" <?php echo $selected;?> >NL</option>									<option value="LU" <?php echo $selected;?> >LU</option>								</select>								<div class="error"><?php echo form_error('country'); ?></div>							</div>
							<button type="submit" class="btn support-btn btn-primary btn-block btn-flat"><?php echo $this->lang->line('label_apply_for_support');?></button>
						</div>
					</div>
				</div>				
            </form>
          </div>
          <!-- /.box -->
		  <?php if(!empty($getsupports)){?>
		  <div class="col-sm-12">
			<table id="viewuser" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th><?php echo $this->lang->line('label_total');?></th>
						<th><?php echo $this->lang->line('label_fullname');?></th>
						<th><?php echo $this->lang->line('label_sign_in_email');?></th>
						<th><?php echo $this->lang->line('label_enter_phone');?></th>
						<th><?php echo $this->lang->line('label_address');?></th>
						<th><?php echo $this->lang->line('label_postcode');?></th>
						<th><?php echo $this->lang->line('label_city');?></th>
						<th><?php echo $this->lang->line('label_country');?></th>
						<th><?php echo $this->lang->line('label_create_date');?></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$count = 1;
					foreach($getsupports as $getsupport){
						$phone=$getsupport['phone'];
						
						?>
						<tr>
							<td><?php echo $count++; ?></td>
							<td><?php echo $getsupport['firstname'];?> <?php echo $getsupport['lastname'];?></td>
							<td><?php echo $getsupport['email'];?></td>
							<td><?php echo $phone;?></td>
							<td><?php echo $getsupport['address1'];?> <?php echo $getsupport['address2'];?></td>
							<td><?php echo $getsupport['postcode'];?></td>
							<td><?php echo $getsupport['city'];?></td>
							<td><?php echo $getsupport['country'];?></td>
							<td><?php echo $getsupport['created_date'];?></td>
						</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<th><?php echo $this->lang->line('label_total');?></th>
						<th><?php echo $this->lang->line('label_fullname');?></th>
						<th><?php echo $this->lang->line('label_sign_in_email');?></th>
						<th><?php echo $this->lang->line('label_enter_phone');?></th>
						<th><?php echo $this->lang->line('label_address');?></th>
						<th><?php echo $this->lang->line('label_postcode');?></th>
						<th><?php echo $this->lang->line('label_city');?></th>
						<th><?php echo $this->lang->line('label_country');?></th>
						<th><?php echo $this->lang->line('label_create_date');?></th>
					</tr>
				</tfoot>
			</table>
		  </div>
		  <?php } ?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
  		</div>
    </div>
    <!-- /.content -->