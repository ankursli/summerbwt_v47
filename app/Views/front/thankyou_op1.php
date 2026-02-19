<section class="offer-section1 op1thanks inner-page">

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

			<div class="row">

				<div class="col-sm-12 col-md-12 col-centered offer-left-section22">

					<div class="offer-content-inner clearfix">
						<div class="offer-text">

							<h1 class="thankyouhtitle"><?php echo lang('Label.thankyou_page1'); ?></h1>
							<?php if (!empty($api_status_msg)): ?>
								<div class="alert <?php echo (strpos($api_status_msg, 'SUCCESS') !== false) ? 'alert-success' : 'alert-warning'; ?>" style="margin-top: 20px; font-weight: bold;">
									<?php echo $api_status_msg; ?>
								</div>
							<?php endif; ?>

						</div>
						
					</div>

					
				</div>

			</div>
				<div class="height50"></div><div class="height25"></div>
			
				<div class="row">
					<div class="col-sm-12 col-md-12 center offer-left-section22">
					     <p class="blocka centers"><a class="centervtretun" href="<?php echo base_url();?>" target="_blank"><?php echo lang('Label.thankspagebtn'); ?></a></p>
					</div>
				
				</div>
		</div>
	</div>	

</section>

