<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= lang('Label.label_add_profile') ?>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?= base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i><?= lang('Label.label_home') ?></a></li>
        <li><a href="<?= base_url('admin/user/Viewuser') ?>"><?= lang('Label.label_user') ?></a></li>
		<li class="active"><?= lang('Label.label_add_profile') ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?= lang('Label.label_create_profile') ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?= base_url('admin/user/createprofile') ?>">
				<?= csrf_field() ?>
				<div class="box-body">
					<?php if(!empty($success ?? '')): ?>
					<div class="alert alert-success"><?= esc($success) ?></div>
					<?php endif; ?>
					<?php if(!empty($error ?? '')): ?>
					<div class="alert alert-warning"><?= esc($error) ?></div>
					<?php endif; ?>
					<?php if(isset($validation)): ?>
					<div class="alert alert-danger"><?= $validation->listErrors() ?></div>
					<?php endif; ?>

					<div class="form-group">
					  <label><?= lang('Label.label_firstname') ?> <span class="error">*</span></label>
					  <input type="text" class="form-control" name="firstname" placeholder="<?= lang('Label.label_enter_firstname') ?>" value="<?= old('firstname') ?>">
					</div>
					<div class="form-group">
					  <label><?= lang('Label.label_lastname') ?></label>
					  <input type="text" class="form-control" name="lastname" placeholder="<?= lang('Label.label_enter_lastname') ?>" value="<?= old('lastname') ?>">
					</div>
					<div class="form-group">
					  <label><?= lang('Label.label_email_address') ?> <span class="error">*</span></label>
					  <input type="email" class="form-control" name="email" placeholder="<?= lang('Label.label_enter_email') ?>" value="<?= old('email') ?>">
					</div>
					<div class="form-group">
					  <label><?= lang('Label.label_sign_in_password') ?> <span class="error">*</span></label>
					  <input type="password" class="form-control" name="password" placeholder="Password (min 8 chars)">
					</div>
					<div class="form-group">
					  <label><?= lang('Label.label_enter_phone') ?> <span class="error">*</span></label>
					  <div class="row">
						<div class="col-sm-3">
							<input type="number" name="countrycode" class="form-control" placeholder="Code (e.g. 33)" value="<?= old('countrycode') ?>" autocomplete="off">
						</div>
						<div class="col-sm-9">
							<input type="number" name="phone" class="form-control" placeholder="<?= lang('Label.label_enter_phone_number') ?>" value="<?= old('phone') ?>" autocomplete="off">
						</div>
					  </div>
					</div>
					<div class="form-group">
					  <label><?= lang('Label.label_country') ?> <span class="error">*</span></label>
					  <select class="form-control" name="country">
						<option value="FR">FR</option>
					  </select>
					</div>
					<div class="form-group">
					  <label><?= lang('Label.label_city') ?> <span class="error">*</span></label>
					  <input type="text" class="form-control" name="city" placeholder="<?= lang('Label.label_enter_city') ?>" value="<?= old('city') ?>">
					</div>
					<div class="form-group">
					  <label><?= lang('Label.label_address_1') ?> <span class="error">*</span></label>
					  <input type="text" class="form-control" name="address1" placeholder="<?= lang('Label.label_enter_address_1') ?>" value="<?= old('address1') ?>">
					</div>
					<div class="form-group">
					  <label><?= lang('Label.label_address_2') ?></label>
					  <input type="text" class="form-control" name="address2" placeholder="<?= lang('Label.label_enter_address_2') ?>" value="<?= old('address2') ?>">
					</div>
					<div class="form-group">
					  <label><?= lang('Label.label_postcode') ?> <span class="error">*</span></label>
					  <input type="text" class="form-control" name="postcode" placeholder="<?= lang('Label.label_enter_postcode') ?>" value="<?= old('postcode') ?>">
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" class="btn btn-primary"><?= lang('Label.label_add') ?></button>
					<a href="<?= base_url('admin/user/Viewuser') ?>" class="btn btn-default"><?= lang('Label.label_view_user') ?></a>
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