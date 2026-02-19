<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<title>Coupon</title>
<link rel="icon" href="http://bwt.webstorm.fr/dev/assets/image/icon.png">
<link rel="stylesheet" href="http://bwt.webstorm.fr/dev/assets/font/fonts.css">
</head>

<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
<div class="wrapper">
<table width="100%" class="ticket-box" style="padding:150px 50px;width: 100%;display: block;float: left;">
<tbody width="100%" align="center" style="width: 100%;float: left;">
<tr width="100%" align="center" style="width: 100%;float: left;">
<td width="100%" align="center" style="width: 100%;float: left;">
<table width="100%" class="ticketbox-in" style="width: 100%;height: 100%;display: block;float: left;border: 5px solid #235f8e;" align="center"> 
<tbody width="100%" style="width: 100%;float: left;"> 
<tr width="100%" class="coupon-top" style="display: block;position: relative;padding: 0 30px 0px 30px;">
<td>
<table width="100%">
	<tbody width="100%">
	<tr width="100%">
		<td width="50%" class="ticket-logo" style="width:50%;text-align: center;margin-top: -65px;padding-bottom: 30px;" align="left">
		<img class="logo" style="width: 400px;float:left;height: auto;text-align:left;background-color: #fff;padding: 0 15px;" src="assets/image/logo.png" alt="logo">	
		</td>
		<td width="50%" class="satisfied-logo" style="width:50%;padding-bottom: 30px;" align="right"> 
		<img class="summer" style="width: auto;float:right;height: auto; text-align:right; background-color: #fff;padding: 0 15px;" src="assets/image/summer.png" alt="summer">
		</td>
	</tr>
	</tbody>
</table>
</td>
</tr > 
<tr align="left" width="100%" class="coupon-top" style="width:100%;text-align:left; display: block;padding: 0 30px 0px 30px;">
<td width="100%" class="congratulation-main" style="width: 100%;height: 100%;display: block;padding: 10px 30px;text-align:left;">
<h2 style="font-size: 35px;color: #235f8e;padding-bottom: 5px;width: 100%;display: block;">Toutes nos félicitations</h2>
<p class="name" style="display: inline-block;padding-right: 5px;color: #235f8e;text-align:left;"><?php echo $proof['firstname'];?> <?php echo $proof['lastname'];?> <?php echo $proof['email'];?></p>
</td>
</tr>
<tr align="left" width="100%" class="coupon-top" style="width:100%; display: block;text-align:left;float:left;padding: 0 30px 0px 30px;">
<td class="purchase-main" style="width: 100%;height: 100%;display: block;padding: 10px 30px;text-align:left;">
<h3 style="font-size: 24px;color: #235f8e;padding-bottom: 5px;width: 100%;text-align:left;display: block;">Votre achat a été effectué chez : </h3>
<p class="name" style="display: block;text-align:left;padding-right: 5px;color: #235f8e;"><?php echo $proof['coupon_name'];?></p> 
</td>
</tr>
<tr align="center" width="100%" class="coupon-top" style="width:100%; display: block;float:left;padding: 0 30px 20px 30px;">
<td class="coupon-price" style="display: block;width: 100%;height: 100%;text-align: center;padding: 15px 0;">
<h1 class="coupon-rs" style="display: block;font-size: 50px;color: #235f8e;padding-bottom: 10px;width: 100%;"><?php echo $proof['coupon_price'];?> €</h1>
<br/>
<p class="unique-no-title" style="width: 100%;font-size: 20px;color: #235f8e;padding-bottom: 5px;font-weight: bold;">le numéro unique de votre bon :</p> 
<p class="id-coupon" style="width: 100%;font-size: 20px;color: #235f8e;padding-bottom: 5px;"><?php echo $proof['coupon_list_code'];?></p>
<br/>
<h3 class="voucher-valid-title" style="display: block;color: #235f8e;width: 100%;height: 100%;text-align: center;padding: 15px 0;font-weight: bold;margin-top:15px;">Votre bon est valable (uniquement) dans votre magasin :</h3> 
<p class="voucher-store-address" style="width: 100%;font-size: 20px;color: #235f8e;padding-bottom: 5px;"><?php echo $proof['store_name'];?></p>
<p class="store-address" style="width: 100%;font-size: 20px;color: #235f8e;padding-bottom: 5px;" ><?php echo $proof['store_address1'];?></p>
<p class="store-address" style="width: 100%;font-size: 20px;color: #235f8e;padding-bottom: 5px;"><?php echo $proof['store_postcode'];?></p>
<p class="store-address" style="width: 100%;font-size: 20px;color: #235f8e;padding-bottom: 5px;"><?php echo $proof['store_city'];?></p>
</td>
</tr>

</tbody> 
</table>
<table width="100%" class="coupon-privacy-main" style="width: 100%;height: 100%;display: block;float: left;padding: 30px 0 10px 0;border: 5px solid #235f8e;" align="center">
<tbody>
<tr align="center" width="100%" class="coupon-top" style="width:100%; display: block;float:left;padding: 20px 30px 20px 30px;border-top: 5px solid #235f8e;">
<td class="good-text"  style="padding-bottom:30px; color: #235f8e;text-align: center;font-size: 20px;font-weight: bold;">
Bon utilisable jusqu'au <span class="good-code" style="font-weight:noraml;"><?php echo $proof['coupon_list_code'];?></span>
</td>
</tr>
</tbody>
</table>
<table width="100%" class="coupon-privacy-main" style="width: 100%;height: 100%;display: block;float: left;padding: 30px 0 10px 0;" align="left"> 
<tbody width="100%" style="width: 100%;float: left;">
<tr align="left" width="100%" style="width:100%; text-align:left;">
<td align="left" style="text-align:left;color: #235f8e;">
<h3 style="font-size: 22px;padding-bottom: 15px; text-align:left; color: #235f8e;font-weight: bold;">Modalités d'utilisation du bon pour le client</h3>
<p style="color: #235f8e;padding-bottom: 15px;text-align:left;">Officturem eture non pratiori ad eturis adi dolutatur accatur sus, sit omnihitam ex el invent magniam invene aligendande aribus exped ma non repere con nihit laccateste imagniet molore litatium is ea vendi repeliciis sa ernatus doluptur sumque dolorem volecea quatur aut apis vite nis ad etum quam quatecto qui officiisto et od et quosti restrum, sum a que volupis qoluptur sumque dolorem volecea quatur aut apis vite nis ad etum quam quatecto qui officiisto et od et quosti restrum, sum a que volupis quae sum quo quiscillabor molupti ossinvent.</p><br/>
<h3 style="font-size: 22px;padding-bottom: 15px;text-align:left;color: #235f8e;font-weight: bold;">Modalités d'utilisation du bon pour le magasin</h3>
<p style="color: #235f8e;padding-bottom: 15px;text-align:left;">Officturem eture non pratiori ad eturis adi dolutatur accatur sus, sit omnihitam ex el invent magniam invene aligendande aribus exped ma non repere con nihit laccateste imagniet molore litatium is ea vendi repeliciis sa ernatus doluptur sumque dolorem volecea quatur aut apis vite nis ad etum quam quatecto qui officiisto et od et quosti restrum, sum a que volupis qoluptur sumque dolorem volecea quatur aut apis vite nis ad etum quam quatecto qui officiisto et od et quosti restrum, sum a que volupis quae sum quo quiscillabor molupti ossinvent.
</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</body>
</html>