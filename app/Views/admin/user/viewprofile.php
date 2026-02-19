<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= lang('Label.label_user_profile') ?>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?= base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i><?= lang('Label.label_home') ?></a></li>
        <li><a href="<?= base_url('admin/user/Viewuser') ?>"><?= lang('Label.label_user') ?></a></li>
		<li class="active"><?= lang('Label.label_user_profile') ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
				<?php if(!empty($users)): $u = $users[0]; ?>
				<img class="profile-user-img img-responsive img-circle" src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" alt="User profile picture">
				<h3 class="profile-username text-center"><?= esc($u['firstname']) ?> <?= esc($u['lastname']) ?></h3>
				<p class="text-muted text-center"><?= esc($u['email']) ?></p>
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
					<?php
					$countrycode = $u['countrycode'] ?? '';
					$phone = ($countrycode !== '') ? '+'.$countrycode.' '.$u['phone'] : $u['phone'];
					?>
					  <b><?= lang('Label.label_enter_phone') ?></b> <a class="pull-right"><?= esc($phone) ?></a>
					</li>
					<li class="list-group-item">
					  <b><?= lang('Label.label_country') ?></b> <a class="pull-right"><?= esc($u['country']) ?></a>
					</li>
					<li class="list-group-item">
					  <b><?= lang('Label.label_city') ?></b> <a class="pull-right"><?= esc($u['city']) ?></a>
					</li>
					<li class="list-group-item">
					  <b><?= lang('Label.label_address_1') ?></b> <a class="pull-right"><?= esc($u['address1']) ?></a>
					</li>
					<li class="list-group-item">
					  <b><?= lang('Label.label_address_2') ?></b> <a class="pull-right"><?= esc($u['address2'] ?? '') ?></a>
					</li>
					<li class="list-group-item">
					  <b><?= lang('Label.label_postcode') ?></b> <a class="pull-right"><?= esc($u['postcode']) ?></a>
					</li>
				</ul>
				<div class="text-center" style="margin-top:15px;">
					<a href="<?= base_url('admin/user/editprofile/'.$u['id']) ?>" class="btn btn-primary"><?= lang('Label.label_edit') ?></a>
					<a href="<?= base_url('admin/user/Viewuser') ?>" class="btn btn-default"><?= lang('Label.label_view_user') ?></a>
				</div>
				<?php else: ?>
				<p class="text-center">User not found.</p>
				<?php endif; ?>
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