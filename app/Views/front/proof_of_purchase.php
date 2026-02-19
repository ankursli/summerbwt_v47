<section class="offer-section1 inner-page">

	<div class="container-fluid ">

		<div class="wrap-container">

			<div class="row">

				<div class="col-sm-12 col-md-6">

					<div class="inner-header">

						<div class="block-number">02</div>

						<h3><?php echo lang('Label.label_robot_offer_reduction'); ?></h3>

						<h2><?php echo lang('Label.label_robot_offer_inner'); ?></h2>

					</div>

				</div>

				<div class="col-sm-12 col-md-6">

				</div>

			</div>

		</div>

	</div>

</section>
<section class="offer-section2">
	<div class="container-fluid">
		<div class="wrap-container">
			<div>
				<?php
				if (isset($_GET['error']) && $_GET['error'] === 'invalid_postcode') {
					$error_message = session()->getFlashdata('error');
					if ($error_message) {
						echo '<p>' . htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8') . '</p>';
					}
				}
				?>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-6 offer-left-section">
					<div class="offer-content-inner clearfix">

						<div class="date-box">

							<p><?php echo lang('Label.label_from_may_july_inline'); ?> </p>

						</div>

						<div class="offer-text m-font-40">

							<h1><?php echo lang('Label.label_up_to_discountp'); ?></h1>

						</div>

						<div class="more-text">

							<p><?php echo lang('Label.label_valid_on_page_robot'); ?> </p>

						</div>

						<div class="price-odr">

							<p><?php echo lang('Label.label_Pour_lachat_dun_robot'); ?>

							<p><?php echo lang('Label.label_for_the_purchase_of_the_ref_p600'); ?> :
								<span class="m-font-30"><?php echo lang('Label.label_150_€_discount'); ?></span>
							</p>

							<p><?php echo lang('Label.label_for_the_purchase_of_the_ref_p500'); ?> :
								<span class="m-font-30"><?php echo lang('Label.label_100_€_discount'); ?></span>
							</p>

							<p><?php echo lang('Label.label_for_the_purchase_of_the_ref_p400'); ?> :
								<span class="m-font-30"><?php echo lang('Label.label_50_€_discount'); ?></span>
							</p>

							<p><?php echo lang('Label.label_for_the_purchase_of_the_ref_250_cosmy'); ?> :
								<span class="m-font-30"><?php echo lang('Label.label_60_€_discount'); ?></span>
							</p>

							<p><?php echo lang('Label.label_for_the_purchase_of_the_ref_200_cosmy'); ?> :
								<span class="m-font-30"><?php echo lang('Label.label_50_€_discount'); ?></span>
							</p>

							<p><?php echo lang('Label.label_for_the_purchase_of_the_ref_150_cosmy'); ?> :
								<span class="m-font-30"><?php echo lang('Label.label_40_€_discount'); ?></span>
							</p>

							<!--	<p><?php echo lang('Label.label_for_the_purchase_of_the_ref_100_cosmy'); ?> : 
							<span class="m-font-30"><?php echo lang('Label.label_30_€_discount'); ?></span></p> -->

						</div>



						<div class="btn-condition">
							<?php if (!empty($_SESSION['site_lang'])) {
								if ($_SESSION['site_lang'] == 'english') { ?>
									<a target="_blank" href="<?php echo base_url(); ?>assets/legal/BWT-Offre-Robots-EN.pdf" class="btn  btn-block" style="color:#F5B5CA;background-color:#fff;border-color: #fff;"><?php echo lang('Label.label_reglementlink_data'); ?></a>

								<?php	} else {  ?>
									<a target="_blank" href="<?php echo base_url(); ?>assets/legal/BWT-Offre-Robots-FR.pdf" class="btn btn-primary btn-block"><?php echo lang('Label.check_btn'); ?></a>

								<?php	}
							} else { ?>
								<a target="_blank" href="<?php echo base_url(); ?>assets/legal/BWT-Offre-Robots-FR.pdf" class="btn btn-primary btn-block"><?php echo lang('Label.check_btn'); ?></a>
							<?php } ?>
						</div>

					</div>
					<div class="offer-form-inner mobilebgcoloproofdiv clearfix">
						<div class="form-title">

							<h2><?php echo lang('Label.label_to_get_your_robot'); ?> :</h2>

						</div>
						<div class="form-main">
							<form class="form-in" role="form" method="post" action="<?php echo base_url('front/create_proof_of_purchase_new'); ?>" enctype="multipart/form-data">
								<div class="row">

									<div class="col-sm-10" style="margin:0 auto;">

										<?php

										$success = session()->getFlashdata('success');
										$error = session()->getFlashdata('error');

										if (!empty($success)) { ?>

											<div class="alert alert-success">

												<?php echo session()->getFlashdata('success'); ?>

											</div>

										<?php
										} ?>

										<?php if (!empty($error)) { ?>

											<div class="alert alert-warning">

												<?php echo session()->getFlashdata('error'); ?>

											</div>

										<?php
										} ?>


										<?php if (isset($validation)) { foreach ($validation->getErrors() as $error) { ?>
									<div class="error"><?php echo esc($error); ?></div>
								<?php } } ?>

									</div>

								</div>
								<div class="form-group">
									<label for="inputGroupFile01"><?php echo lang('Label.who_are_you'); ?></label>
									<div class="radioms" style="color:#000;">
										<input type="radio" id="clienttype"
											name="contact" value="particulier" <?php if ($clienttype == 'particulier') {
																					echo 'checked';
																				} ?> checked="checked" style="transform:scale(1.5);margin-top: 7px;margin-right: 10px;">
										<label for="clienttype" class="radiobtt" style="margin-right:15px;"><span style="font-size:18px;font-weight:400;">Particulier</span></label>
										<input type="radio" id="clienttype"
											name="contact" value="pro" <?php if ($clienttype == 'pro') {
																			echo 'checked';
																		} ?> style="transform:scale(1.5);margin-top: 7px;margin-right: 10px;">
										<label for="clienttype" class="radiobtt"><span style="font-size:18px;font-weight:400;">Professionnel</span></label>
									</div>
								</div>
								<div class="form-group" id="siret_div" style="display:none;<?php if ('pro' == $clienttype) {
																								echo 'display:none;';
																							} ?>">
									<label for="inputGroupFile01"><?php echo lang('Label.label_siret'); ?></label>
									<input type="text" class="form-control siret" name="siret" id="siret"
										placeholder="<?php echo lang('Label.label_siret'); ?>" value="<?php echo (isset($siret)) ? $siret : ''; ?>">
								</div>
								<div class="form-group">
									<label for="inputGroupFile01"><?php echo lang('Label.label_download'); ?> <span>
											<?php echo lang('Label.label_your_proof_of_purchase'); ?></span></label>
									<div class="custom-file">
										<input type="file" class="custom-file-input upload_proof" name="upload_proof" id="files" aria-describedby="inputGroupFileAddon01">
										<?php if ($upload_proof != '') { ?>
											<span class="pip"><img class="imageThumb" src="<?php echo base_url('upload') . '/op3/' . $upload_proof; ?>" title="<?php echo $upload_proof; ?>"><br><span class="remove">supprimer l'image</span></span>
										<?php } ?>
										<label class="custom-file-label" for="inputGroupFile01"></label>
									</div>
									<input type="hidden" value="<?php echo $upload_proof; ?>" name="uplodehidenfile" id="uplodehidenfile">
									<input type="hidden" value="<?php echo $filesizeinfo; ?>" name="filesizeinfo" id="filesizeinfo">
									<input type="hidden" value="<?php echo $_SESSION['site_lang']; ?>" id="langcurrent" name="langcurrent">
									<small id="emailHelp" class="form-text text-muted"><?php echo lang('Label.label_format_3mo_maximum'); ?></small>
									<div class="error"><?php echo session()->getFlashdata('error_upload_proof') ?? ''; ?></div>
								</div>
								<div class="form-group field-second">
									<label for="selectrobot"><?php echo lang('Label.label_select'); ?> <span>
											<?php echo lang('Label.label_the_model_of_the_robot'); ?></span></label>
									<select class="custom-select" id="selectrobot" name="robot_id" required>
										<option selected value="none"><?php echo lang('Label.label_to_choose'); ?></option>
										<?php foreach ($getrobots as $getrobot) { ?>
											<option value="<?php echo $getrobot['id']; ?>" <?php if ($getrobot['id'] == $robot_id) {
																								echo 'selected';
																							} ?>><?php echo $getrobot['robot_name']; ?></option>
										<?php  } ?>
									</select>
									<div class="error"><?php echo session()->getFlashdata('error_robot_id') ?? ''; ?></div>
									<label for="selectpurchase"><span><?php echo lang('Label.robot_serial_no'); ?></span><a href="#" data-toggle="tooltip" class="tip-bottom-robotc" title='<img src="<?php echo base_url(); ?>assets/image/eba2G2CQ.png" alt="">' />?</a></label>
									<input type="text" class="roboto_serial_no form-control" name="roboto_serial_no" id="roboto_serial_no" placeholder="<?php echo lang('Label.label_to_serianpc'); ?>" value="<?php echo (isset($roboto_serial_no)) ? $roboto_serial_no : ''; ?>">
									<div class="error"><?php echo session()->getFlashdata('error_roboto_serial_no') ?? ''; ?></div>
								</div>
								<div class="form-group datesectiondiv">
									<label for="inputGroupFile01"><?php echo lang('Label.dateroboto_label'); ?> </label>
									<input class="date-picker form-control" name="date_of_purchase" id="datepicker_pi" data-date-format="mm/dd/yyyy" value="<?php echo (isset($date_of_purchase)) ? $date_of_purchase : ''; ?>">
									<div class="error"><?php echo session()->getFlashdata('error_date_of_purchase') ?? ''; ?></div>
								</div>
								<div class="form-group field-third another-handle">

									<input type="hidden" value="FR" id="selectrobotcountry" name="store_country">
									<input type="hidden" value="FR" id="sotrycountry">
									<input type="hidden" value="<?php echo $store_id; ?>" id="sotreidvalue">
									<input type="hidden" value="3" id="storeidp" class="storeidp">
									<div class="error"><?php echo session()->getFlashdata('error_store_country') ?? ''; ?></div><br />
									<label for="selectrobotcountry"> <span><?php echo lang('Label.label_the_roboto_magasin'); ?></span></label>

									<select name="store_id" class="custom-select store_id" id="selectpurchase">

										<option selected value="none"><?php echo lang('Label.product_shop'); ?></option>
										<option value="AUTRE" handle="autre" <?php if ('AUTRE' == $store_id) {
																					echo 'selected';
																				} ?>><?php echo lang('Label.autre'); ?></option>
									</select>
									<div id="store_iderror"></div>
									<div class="error"><?php echo session()->getFlashdata('error_store_id') ?? ''; ?></div>
								</div>
								<div class="form-group field-fourth another-store-handle" style="display:none;<?php if ('AUTRE' == $store_id) {
																													echo 'display:block;';
																												} ?>">
									<label for="selectproduct"><span><?php echo lang('Label.label_point_of_sale_distributing'); ?></span></label>
									<input type="text" class="form-control nom_address" name="nomstoreadditional" id="nomstoreadditional" placeholder="<?php echo lang('Label.nomstoreadditional'); ?>" value="<?php echo (isset($nomstoreadditional)) ? $nomstoreadditional : ''; ?>">
									<div class="error"><?php echo session()->getFlashdata('error_nomstoreadditional') ?? ''; ?></div><br />
									<input type="text" class="form-control nom_address" name="nom_address" id="nom_address" placeholder="<?php echo lang('Label.nomaddress'); ?>" value="<?php echo (isset($nom_address)) ? $nom_address : ''; ?>">
									<div class="error"><?php echo session()->getFlashdata('error_nom_address') ?? ''; ?></div><br />
									<input type="text" class="form-control postalcode" id="postalcodep" name="postalcode" placeholder="<?php echo lang('Label.postalcodep'); ?>" value="<?php echo (isset($postalcode)) ? $postalcode : ''; ?>">
									<div class="error"><?php echo session()->getFlashdata('error_postalcode') ?? ''; ?></div><br />
									<input type="text" class="form-control vile" name="vile" id="vilep" placeholder="<?php echo lang('Label.vilep'); ?>" value="<?php echo (isset($vile)) ? $vile : ''; ?>">
									<div class="error"><?php echo session()->getFlashdata('error_vile') ?? ''; ?></div><br />
									<input type="text" class="form-control complementad" name="complementad" placeholder="<?php echo lang('Label.complementadp'); ?>" value="<?php echo (isset($complementad)) ? $complementad : ''; ?>">
									<div class="error"><?php echo session()->getFlashdata('error_complementad') ?? ''; ?></div><br />
								</div>
								<div class="form-group field-ibanno bankdetails">
									<label for="selectrobot"><span><?php echo lang('Label.bankdetailslabel'); ?></span></label>
									<input type="text" class="form-control bank_iban" name="bank_iban" id="IBAN" placeholder="AA 11 22222 33333 11111111111 44" data-inputmask="'mask': 'aa 99 99999 99999 99999999999 99'" value="<?php echo (isset($bank_iban)) ? $bank_iban : ''; ?>">
									<div class="error"><?php echo session()->getFlashdata('error_bank_iban') ?? ''; ?></div>
								</div>
								<button type="button" class="btn btn-primary triggerDrawcheckproof"><?php echo lang('Label.label_to_confirm'); ?></button>
								<button type="submit" class="btn btn-primary triggerDraw btn-block" style="display:none"><?php echo lang('Label.label_to_confirm'); ?></button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 ">
					<div class="offer-right-section robot-right-section clearfix"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-6 offer-left-section"></div>
				<div class="col-sm-12 col-md-6 sildersectinright">
					<div class="logotopsilder ">
						<div class="sildelogotplusxaward">
							<img class="plusXawardlogo" src="<?php echo base_url(); ?>/assets/image/Logo-PlusXAward.png" alt="Logo-PlusXAward">
						</div>
					</div>
					<div class="bottom-image text-center hidemobile" id="silderroboto">
						<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="carousel-item active">
									<img class="d-block " src="<?php echo base_url(); ?>/assets/image/robots/1_F1_R.png" alt="F1 R">
								</div>
								<div class="carousel-item">
									<img class="d-block " src="<?php echo base_url(); ?>/assets/image/robots/2_F1_RXT.png" alt="F1 RXT">
								</div>
								<div class="carousel-item">
									<img class="d-block " src="<?php echo base_url(); ?>/assets/image/robots/3_F1_RX_.png" alt="F1 RX">
								</div>
								<div class="carousel-item">
									<img class="d-block " src="<?php echo base_url(); ?>/assets/image/robots/4_F1_Sonic Pro_.png" alt="F1 Socnic Pro">
								</div>
								<div class="carousel-item">
									<img class="d-block " src="<?php echo base_url(); ?>/assets/image/robots/Aquabot_Wave_2025.png" alt="Aquabot Wave">
								</div>
								<div class="carousel-item">
									<img class="d-block " src="<?php echo base_url(); ?>/assets/image/robots/Aquabot_Wave_Pro_2025.png" alt="Aquabot Wave Pro">
								</div>
							</div>
							<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>