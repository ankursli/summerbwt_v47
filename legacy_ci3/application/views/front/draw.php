<section class="treatment-section1 inner-page">

	<div class="container-fluid ">

		<div class="wrap-container">

			<div class="row">

				<div class="col-sm-12 col-md-6">

					<div class="inner-header">

						<div class="block-number">01</div>

						<h3><?php //echo $this->lang->line('label_to_win');?></h3>

						<h2><?php echo $this->lang->line('label_offer_water_treatment_inline');?></h2>

					</div>

				</div>

				<div class="col-sm-12 col-md-6">

				</div>

			</div>

		</div>

	</div>

</section>
<section class="treatment-section2">
	<div class="container-fluid">
		<div class="wrap-container">
			<div class="row">
			<div class="col-sm-12 col-md-6 offer-left-section">

<div class="offer-content-inner clearfix">

	<div class="date-box">

		<p><?php echo $this->lang->line('label_from_april_july_inline_drea');?> </p>
		<p><?php echo $this->lang->line('label_to_win_in_your_store');?> </p>

	</div>

	<div class="offer-text tedraw">

		<h1><?php echo $this->lang->line('label_for_the_f1_french_inner');?></h1>

	</div>

	<div class="more-text padding10">

		<p style="padding:0px;"><?php echo $this->lang->line('label_for_the_f1_french_inner2');?></p>
	</div>
	<div class="more-text">

		<p style="padding:0px;"><span style="font-size: 22px;font-weight: 400;display: inline-block;line-height: 22px;"><?php echo $this->lang->line('label_and_gifts_from_2');?></span><br>
		<span style="font-size: 22px;font-weight: 400;display: inline-block;line-height: 22px;"><?php echo $this->lang->line('label_for_the_f1_french_inner3');?></span></p>
		</div>
	
	<div class="btn-condition">
	<?php 	if(!empty($_SESSION['site_lang'])){
				if($_SESSION['site_lang']=='english'){ ?>
				<a target="_blank" href="<?php echo base_url();?>assets/legal/BWT-Reglement.pdf" class="btn  btn-block" style="color:#e5006b;background-color:#fff;border-color: #fff;"><?php echo $this->lang->line('button_regl_jeu_page_draw');?></a>

			<?php	} else {  ?>
				<a target="_blank" href="<?php echo base_url();?>assets/legal/BWT-Reglement.pdf" class="btn  btn-block" style="color:#e5006b;background-color:#fff;border-color: #fff;"><?php echo $this->lang->line('button_regl_jeu_page_draw');?></a>

		<?php	} } else { ?> 
			<a target="_blank" href="<?php echo base_url();?>assets/legal/BWT-Reglement.pdf" class="btn  btn-block" style="color:#e5006b;background-color:#fff;border-color: #fff;"><?php echo $this->lang->line('button_regl_jeu_page_draw');?></a>
  <?php } ?>
		</div>


</div>

<div class="offer-form-inner mobilebgcolodrawdiv clearfix">

	<div class="form-title">

		<h2><?php echo $this->lang->line('label_to_participate_in_the_draw');?>&nbsp;:</h2>

	</div>

	<div class="form-main">

	<form class="form-in" role="form" method="post" action="<?php echo base_url('front/create_draw');?>" enctype="multipart/form-data">

		<div class="row">

			<div class="col-sm-10" style="margin:0 auto;" >

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

        <div class="form-group">
			<label for="inputGroupFile01"><?php echo $this->lang->line('who_are_you'); ?></label>
				<div class="radioms" style="color:#000;">
					<input type="radio" id="clienttype" <?php if($clienttype == 'particulier'){ echo 'checked'; } ?>
 								    name="contact" value="particulier" checked="checked" style="transform:scale(1.5);margin-top:7px;margin-right: 10px;">
  								 <label for="clienttype"  class="radiobtt"  style="margin-right:15px;"><span style="font-size:18px;font-weight:400;">Particulier</span></label>
  								
  							   <input type="radio"  <?php if($clienttype == 'pro'){ echo 'checked'; } ?>  id="clienttype" name="contact" value="pro" style="transform:scale(1.5);margin-top: 7px;margin-right: 10px;">
  								 <label for="clienttype"  class="radiobtt" ><span style="font-size:18px;font-weight:400;">Professionnel</span></label>
							</div>
								 
							
		</div>
<!-- 
		<div class="form-group field-second">

								<label for="selectrobot"><?php echo $this->lang->line('label_select'); ?> <span>
									<?php echo $this->lang->line('label_the_model_of_the_robot'); ?></span></label>

								<select class="custom-select" id="selectrobot" name="coupon_id" required >
									<option selected value="none"><?php echo $this->lang->line('label_to_choose'); ?></option>
									<?php foreach ($getcoupons as $getcoupon){ ?>
										<option value="<?php echo $getcoupon['id']; ?>" <?php if($getcoupon['id'] == $coupon_id){ echo 'selected';} ?>><?php echo $getcoupon['coupon_name']; ?></option>
									<?php  } ?>
								</select>
					            <div class="error"><?php echo form_error('coupon_id'); ?></div>
	
		</div>
 -->
		<div class="form-group" id="siret_div" style="display:none;<?php if('pro' == $clienttype){ echo 'display:none;';} ?>">
								<label for="inputGroupFile01"><?php echo $this->lang->line('label_siret'); ?></label>
								<input type="text" class="form-control siret" name="siret"  id="siret" 
								 placeholder="<?php echo $this->lang->line('label_siret'); ?>" value="<?php echo (isset($siret)) ? $siret : ''; ?>">
		</div>	
		<div class="form-group">

		<label for="inputGroupFile01"><?php echo $this->lang->line('label_download');?> <span><?php echo $this->lang->line('label_your_proof_of_purchase');?></span></label>

		<div class="custom-file">

			<input type="file" class="custom-file-input upload_proof" id="files" name="upload_draw" aria-describedby="inputGroupFileAddon01">
				<?php if($upload_draw!='') { ?>
									<span class="pip"><img class="imageThumb" src="<?php echo base_url('upload').'/draw/'. $upload_draw; ?>" title="<?php echo $upload_draw; ?>"><br><span class="remove">supprimer l'image</span></span>
									<?php } ?>
			<label class="custom-file-label" for="inputGroupFile01"></label>

		</div>

		<small id="emailHelp" class="form-text text-muted"><?php echo $this->lang->line('label_format_3mo_maximum');?></small>
		<div class="error"><?php echo form_error('upload_draw'); ?></div>
		<input type="hidden"  value="<?php echo $_SESSION['site_lang'];?>" id="langcurrent" name="langcurrent">	
	  </div>                                  
	  <input type="hidden" value="<?php echo $upload_draw; ?>" name="uplodehidenfile" id="uplodehidenfile">
	  <input type="hidden" value="<?php echo $filesizeinfo; ?>" name="filesizeinfo" id="filesizeinfo">
	  <div class="form-group field-second another-handle">

		<!-- <label for="selectrobotcountry"><?php echo $this->lang->line('label_select');?> <span><?php echo $this->lang->line('label_the_place_of_purchase');?></span></label>
		<select name="store_country" class="custom-select store_country" id="selectrobotcountry">
				<option selected value="none"><?php echo $this->lang->line('label_choose_country');?></option>
				<?php 
					$country=$this->Mdl_Country->GetRecord(array('is_allow'=>'1'));	
					foreach($country as $getcountry){ if($getcountry['country_name'] == 'Netherland'){
							?>
							<option value="<?php echo $getcountry['country_code'];?>" <?php if($getcountry['country_code'] == $store_country){ echo 'selected';} ?>><?php echo $this->lang->line('ntname');?></option>
							<?php
							
						}
						else{
						?>
							<option value="<?php echo $getcountry['country_code'];?>" <?php if($getcountry['country_code'] == $store_country){ echo 'selected';} ?>><?php echo $getcountry['country_name'];?></option>
						<?php }  } ?>
		</select> -->
		<input type="hidden" value="FR" id="selectrobotcountry" name="store_country" >
		<input type="hidden" value="FR" id="sotrycountry" >
		
		<input type="hidden" value="<?php echo $store_id;?>" id="sotreidvalue">
		<input type="hidden" value="2" id="storeidp" class="storeidp">
		<div class="error"><?php echo form_error('store_country'); ?></div>
		<?php //print_r($store_id); ?>
		<lable>&nbsp;</lable>
						<select name="store_id" class="custom-select store_id" id="selectpurchase">
							<option selected value="none"><?php echo $this->lang->line('product_shop');?></option>
							<option value="AUTRE" handle="autre" <?php if('AUTRE' == $store_id){ echo 'selected';} ?> ><?php echo $this->lang->line('autre'); ?></option>
						</select>
						<div class="error"><?php echo form_error('store_id'); ?></div>

	  </div> 

	  <div class="form-group field-third another-store-handle" style="display:none;<?php if('AUTRE' == $store_id){ echo 'display:block;';} ?>">
								<label for="selectproduct"><span><?php echo $this->lang->line('label_point_of_sale_distributing'); ?></span></label>
								  <input type="text" class="form-control nom_address" name="nomstoreadditional"  id="nomstoreadditional"  placeholder="<?php echo $this->lang->line('nomstoreadditional'); ?>" value="<?php echo (isset($nomstoreadditional)) ? $nomstoreadditional : ''; ?>">
							       <div class="error"><?php echo form_error('nomstoreadditional'); ?></div><br/>
								  <input type="text" class="form-control nom_address" name="nom_address"  id="nom_address"  placeholder="<?php echo $this->lang->line('nomaddress'); ?>" value="<?php echo (isset($nom_address)) ? $nom_address : ''; ?>">
							       <div class="error"><?php echo form_error('nom_address'); ?></div><br/>
								   <input type="text" class="form-control postalcode" id="postalcodep" name="postalcode"   placeholder="<?php echo $this->lang->line('postalcodep'); ?>" value="<?php echo (isset($postalcode)) ? $postalcode : ''; ?>">
							       <div class="error"><?php echo form_error('postalcode'); ?></div><br/>
								   <input type="text" class="form-control vile" name="vile" id="vilep"  placeholder="<?php echo $this->lang->line('vilep'); ?>" value="<?php echo (isset($vile)) ? $vile : ''; ?>">
							       <div class="error"><?php echo form_error('vile'); ?></div><br/>
								   <input type="text" class="form-control complementad" name="complementad"   placeholder="<?php echo $this->lang->line('complementadp'); ?>" value="<?php echo (isset($complementad)) ? $complementad : ''; ?>">
							       <div class="error"><?php echo form_error('complementad'); ?></div><br/>			
	  </div>
	                             <button type="button" class="btn btn-primary triggerDrawcheckp"><?php echo $this->lang->line('label_to_confirm'); ?></button>
								<button type="submit" class="btn btn-primary triggerDrawp btn-block" style="display:none"><?php echo $this->lang->line('label_to_confirm'); ?></button>
							
	  

	</form>

	</div>

	<!-- 
<div class="imgcardee displayhideendiv clearfix"> 
		<div class="img_cardetouree"> 
			<img class="d-block pearlw" src="<?php echo base_url(); ?>/assets/image/Robot-P400.png" alt="Pearl Water Manager">
		</div>
	</div>
 -->

</div>

</div>

<div class="col-sm-12 col-md-6 ">     
<div class="offer-right-section clearfix"></div>			

 </div>
			</div>	

			<div class="row">
				 <div class="col-sm-12 col-md-6 offer-left-section"></div>
				 <div class="col-sm-12 col-md-6 sildersectinright">
								
						<!-- 
<div class="bottom-image text-center hidemobile" id="silderroboto">
						   	<div id="carouselExampleControls" class="carousel slide opsilder2" data-ride="carousel">
							  	<div class="carousel-inner">
									<div class="carousel-item active">
										<img class="d-block " src="<?php echo base_url(); ?>/assets/image/Robot-P500.png" alt="Produit">
									</div>
									<div class="carousel-item">
										<img class="d-block " src="<?php echo base_url(); ?>/assets/image/Robot-P600.png" alt="Produit">
									</div>
									<!~~ <div class="carousel-item">
										<img class="d-block " src="<?php echo base_url(); ?>/assets/image/Produit3-op2.png" alt="Produit">
									</div>
									<div class="carousel-item">
										<img class="d-block " src="<?php echo base_url(); ?>/assets/image/Produit4-op2.png" alt="Produit">
									</div> ~~>
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
						    
						   
						    <!~~ <img  src="<?php echo base_url(); ?>/assets/image/Robot-P600.png" alt="Produits Chimie"> ~~>
						
							<!~~ </div> ~~>
					 
 -->
 
 </div>
				 </div>
			</div>	


		</div>
	</div>
</section>


