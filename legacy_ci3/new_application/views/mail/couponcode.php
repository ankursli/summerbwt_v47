<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>BWT</title>
</head>
<body>
    <div class="wrapper">
    	<section class="div-block">
        	<h1 style="font-size: 31px;line-height: 40px;padding:0 10px;">
				Congratulation <?php echo $proof['firstname'].' '.$proof['lastname'].' ('.$proof['email'].')'?>
			</h1>
			<p style="font-size: 14px; line-height: 19px;padding: 0 10px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
			<div class="detail-box" style="width:100%;float: left;padding: 30px 0;">
				<div class="coupon-main" style="display: block;float: left;width: 100%;padding: 10px 0;">
					<div class="coupon-right" style="display: inline-block;float: left;">
						<h4 style="font-size: 19px;line-height: 22px;margin: 0;">Your Unique Coupon ID is</h4>
					</div>
					<div class="coupon-left" style="display: inline-block;float: left;padding-left: 20px;">
						<p style="font-size: 19px;line-height: 22px;margin: 0;"><?php echo $proof['coupon_list_code'];?></p>
					</div>
				</div>
				<div class="coupon-main" style="display: block;float: left;width: 100%;padding: 10px 0;">
					<div class="coupon-right" style="display: inline-block;float: left;">
						<h4 style="font-size: 19px;line-height: 22px;margin: 0;">Your Coupon Worth is</h4>
					</div>
					<div class="coupon-left" style="display: inline-block;float: left;padding-left: 20px;">
						<p style="font-size: 19px;line-height: 22px;margin: 0;"><?php echo $proof['coupon_name'];?>(€<?php echo $proof['coupon_price'];?>)</p>
					</div>
				</div>
				<div class="coupon-main" style="display: block;float: left;width: 100%; padding: 10px 0;">
					<div class="coupon-right" style="display: inline-block;float: left;">
						<h4 style="font-size: 19px;line-height: 22px;margin: 0;">Your Piscine Click Coupon is</h4>
					</div>
					<div class="coupon-left" style="display: inline-block;float: left;padding-left: 20px;">
						<p style="font-size: 19px;line-height: 22px;margin: 0;"><?php echo $proof['coupon_list_code'];?></p>
					</div>
				</div>
				<div class="coupon-main" style="display: block;float: left;width: 100%; padding: 10px 0;">
					<div class="coupon-right" style="display: inline-block;float: left;">
						<h4 style="font-size: 19px;line-height: 22px;margin: 0;">Store In Which  You Can Use This Coupon</h4>
					</div>
					<div class="coupon-left" style="display: inline-block;float: left;padding-left: 20px;">
						<p style="font-size: 19px;line-height: 22px;margin: 0;">Store : <?php echo $proof['store_name'];?> <br/> Address : <?php echo $proof['store_address1'];?> <br/> Post Code / city : <?php echo $proof['store_postcode'];?>, <?php echo $proof['store_city'];?></p>
					</div>
				</div>
			</div>
			<div class="tandc" style="width: 100%;float: left;padding-top: 30px;">
				<p style="font-size: 14px;line-height: 19px;">* Detail & Condition Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
				</p>
			</div>
        </section>		
    </div>
</body>
</html>
