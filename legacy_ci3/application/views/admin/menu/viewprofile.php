<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $this->lang->line('label_user_profile');?>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('label_home');?></a></li>
        <li><a href="<?php echo base_url('admin/user/Viewuser');?>"><?php echo $this->lang->line('label_user');?></a></li>
		<li class="active"><?php echo $this->lang->line('label_user_profile');?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
				<img class="profile-user-img img-responsive img-circle" src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" alt="User profile picture">
				<h3 class="profile-username text-center"><?php echo $users[0]['firstname'].' '.$users[0]['lastname'];?></h3>
				<p class="text-muted text-center"><?php echo $users[0]['email'];?></p>
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
					<?php
					$countrycode=  $users[0]['countrycode'];
					if($countrycode!=''){
						$phone="+".$countrycode."". $users[0]['phone'];
					}else{
						$phone= $users[0]['phone'];
					}
					?>	


					  <b><?php echo $this->lang->line('label_enter_phone');?></b> <a class="pull-right"><?php echo $phone;?></a>
					</li>
					<li class="list-group-item">
					  <b><?php echo $this->lang->line('label_country');?></b> <a class="pull-right"><?php echo $users[0]['country'];?></a>
					</li>
					<li class="list-group-item">
					  <b><?php echo $this->lang->line('label_city');?></b> <a class="pull-right"><?php echo $users[0]['city'];?></a>
					</li>
					<li class="list-group-item">
					  <b><?php echo $this->lang->line('label_address_1');?></b> <a class="pull-right"><?php echo $users[0]['address1'];?></a>
					</li>
					<li class="list-group-item">
					  <b><?php echo $this->lang->line('label_address_2');?></b> <a class="pull-right"><?php echo $users[0]['address2'];?></a>
					</li>
					<li class="list-group-item">
					  <b><?php echo $this->lang->line('label_postcode');?></b> <a class="pull-right"><?php echo $users[0]['postcode'];?></a>
					</li>
					
				</ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		</div>
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>