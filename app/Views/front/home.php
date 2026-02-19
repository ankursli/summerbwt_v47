<div class="full-page-wrap11" id="homebg">
	<section class="three-block"  id="homesectionf">
		<div class="container containerhom">
			<div class="row">
				<?php foreach($block as $bloc){ ?>
					<?php if($bloc['block'] == "block-1"){ ?>
				<div class="col-sm-12 <?php echo $blockoffset1; ?> col-lg-4 col-md-6 bloc1">
					
					<div class="first-block single-block" >
						<div class="block-number">01</div>
						
						<div class="block-pre-text"><?php echo $bloc['title'];?></div>
						<div class="block-wrap equalheightdiv" style="background-color: <?php echo $bloc['bg_color'];?>; opacity: <?php echo $bloc['opacity'];?>;">
						<!-- <a href="<?php echo base_url('offre-robot');?>"> -->
						<a href="<?php echo (strpos($bloc['link'], 'http') === 0) ? $bloc['link'] : base_url(ltrim($bloc['link'], '/'));?>">
							<div class="block-wrap-content">
								<div class="matchfirsttext">
									<p class="p1"><?php echo $bloc['date'];?></p>
									
								</div>
								<hr>
								<div class="descblockhome">
										<h3 class="matchh3"><span class="thiredcenter"><?php echo $bloc['middle_content'];?></span></h3>
								</div>
								<hr>
								<div class="matchlasttext">
									<p class="p2"><?php echo $bloc['bottom_content'];?></p>
								</div>
							</div>
							<div class="block-wrap-button text-center">
								<a href="<?php echo (strpos($bloc['link'], 'http') === 0) ? $bloc['link'] : base_url(ltrim($bloc['link'], '/'));?>" class="block-button btn"><?php echo lang('Label.label_take_advantage');?></a>
							</div>
						</a>
						</div>
					</div>
				</div>
					<?php } } ?>
				<?php foreach($block as $bloc){ ?>
					<?php if($bloc['block'] == "block-2"){ ?>
				<div class="col-sm-12 <?php echo $blockoffset2; ?> col-lg-4 col-md-6 bloc2">
					<div class="second-block single-block">
						<div class="block-number">02</div>
						<div class="block-pre-text"><?php  echo $bloc['title'];?></div>
						<div class="block-wrap equalheightdiv" style="background-color: <?php echo $bloc['bg_color'];?>;  opacity: <?php echo $bloc['opacity'];?>;">
						<!-- <a href="<?php echo base_url('gpcastellet');?>"> -->
						<a href="<?php echo (strpos($bloc['link'], 'http') === 0) ? $bloc['link'] : base_url(ltrim($bloc['link'], '/'));?>">
							<div class="block-wrap-content">
								<div class="matchfirsttext">
									<p class="p1"><?php echo $bloc['date'];?></p>
								</div>
								<hr>
								<div class="descblockhome">
									<h3 class="matchh3"><span class="thiredcenter"><?php echo $bloc['middle_content'];?></span></h3>
								</div>	
								<hr>
								<div class="matchlasttext">
								
									<p class="p2"><?php echo $bloc['bottom_content'];?></p>
								</div>
							</div>
							<div class="block-wrap-button text-center">
								<a href="<?php echo (strpos($bloc['link'], 'http') === 0) ? $bloc['link'] : base_url(ltrim($bloc['link'], '/'));?>" class="block-button btn"><?php echo lang('Label.label_try_your_luck');?></a>
							</div>
						</a>
						</div>
					</div>	
				</div>
				<?php } } ?>
				<?php foreach($block as $bloc){ ?>
					<?php if($bloc['block'] == "block-3"){ ?>
				<div class="col-sm-12 <?php echo $blockoffset3; ?> col-lg-4 col-md-6 col33 bloc3">
				
					<div class="third-block single-block">
						<div class="block-number">03</div>
						<div class="block-pre-text"><?php echo $bloc['title'];?></div>
						<div class="block-wrap equalheightdiv" style="background-color: <?php echo $bloc['bg_color'];?>;  opacity:<?php echo $bloc['opacity'];?>;">
						<!-- <a href="<?php echo base_url('contrat-dexcellence');?>"> -->
						<a href="<?php echo (strpos($bloc['link'], 'http') === 0) ? $bloc['link'] : base_url(ltrim($bloc['link'], '/'));?>">
							<div class="block-wrap-content">
								<div class="matchfirsttext">
									<p class="p1"><?php echo $bloc['date'];?></p>
								</div>
								<hr>
								<div class="descblockhome">
									<h3 class="matchh3"><span class="thiredcenter"><?php echo $bloc['middle_content'];?></span></h3>
								</div>	
								<hr>
								<div class="matchlasttext">
									<p class="p2"><?php echo $bloc['bottom_content'];?></p>
								</div>
							</div>
							<div class="block-wrap-button text-center">
								<a href="<?php echo (strpos($bloc['link'], 'http') === 0) ? $bloc['link'] : base_url(ltrim($bloc['link'], '/'));?>" class="block-button btn"><?php echo lang('Label.label_read_more');?></a>
							</div>
						</a>	
						</div>
					</div>
				</div>
				<?php } } ?>	
			</div>              
		</div>
	</section>
</div>
