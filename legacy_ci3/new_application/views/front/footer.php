	<?php 
	$base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .  $_SERVER['HTTP_HOST'];
	
	
	if(!empty($_SESSION['site_lang'])){
						if($_SESSION['site_lang']=='english'){
							$clink= $base_url.'/page/Conditions_de_participation';
							$reules= $base_url.'/page/reglement_en';
							$privacy_policy=$base_url.'/page/privacy_policy';
							$legal_notice=$base_url.'/page/legal-notices';
							$cookie_link=$base_url.'/page/policy-cookies';
						}
						if($_SESSION['site_lang']=='french'){
						//$clink= $base_url.'/yyy';
							$clink= $base_url.'/page/modalites';
						    $reules= $base_url.'/page/reglement';
							$privacy_policy=$base_url.'/page/politique-de-confidentialite';
							$legal_notice=$base_url.'/page/mentions-legales';
							$cookie_link=$base_url.'/page/politique-cookies';
						}
					
					}
					else{
						//$clink= $base_url.'/xxx';
						$clink= $base_url.'/page/modalites';
						$reules= $base_url.'/page/reglement';
						$privacy_policy=$base_url.'/page/politique-de-confidentialite';
						$legal_notice=$base_url.'/page/mentions-legales';
						$cookie_link=$base_url.'/page/politique-cookies';
					} 
					
					
	?>
	
	<footer class="footer" id="footerr">
		<div class="container">
			<div class="row">
				<div class="col-sm">
					<div class="footer-link">
						<ul>
						
						

							<li class="showinmobile"><a href="<?php echo base_url();?>" target="_blank" title="<?php echo $this->lang->line('label_the_bwt_group');?>" target="_blank">
							<img src="<?php echo base_url();?>assets/image/logo2.png" alt="">
							</a></li>
							<?php 
											$json_decode = json_decode($footermenu['menu_items'], true);
											foreach($json_decode as $menu){ ?>
							<li><a target="_blank"  href="<?php echo $menu['link'];?>"><?php echo $menu['label'];?></a></li>
							<?php } ?>
							<!-- <li><a target="_blank"  href="https://www.bwt.fr/fr/Pages/default.aspx"><?php echo $this->lang->line('label_the_bwt_group');?></a></li>
							<li><a target="_blank" href="<?php echo $clink;?>"><?php echo $this->lang->line('label_conditions_of_participation');?></a></li>
							<li><a target="_blank" href="<?php echo $reules; ?>"><?php echo $this->lang->line('label_reglementlink_data');?></a></li>
							<li><a target="_blank" href="<?php echo $privacy_policy ;?>"><?php echo $this->lang->line('label_pravicy_policy_menu');?></a></li>
							<li><a target="_blank" href="<?php echo $cookie_link;?>"><?php echo $this->lang->line('label_cookies');?></a></li>
							<li><a target="_blank" href="<?php echo $legal_notice;?>"><?php echo $this->lang->line('label_legal_notice');?></a></li> -->
							
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<div id="cookieChoiceInfo" style="position: fixed; width: 100%; background-color: #00649a; margin: 0px; left: 0px; bottom: 0px; padding: 4px; z-index: 1000; text-align: center;color:#fff;">
		<div id="cookiecontent">
			<span>
            Les cookies sont importants pour le bon fonctionnement d’un site. Dans le but d’améliorer votre navigation, BWT utilise des cookies pour garder en mémoire vos informations de connexion et vous permettre de vous connecter en toute sécurité, pour recueillir des statistiques afin d’optimiser la fonctionnalité du site et pour vous offrir du contenu personnalisé selon vos centres d’intérêt. 
Cliquez sur ‘accepter’ pour continuer à utiliser le site, ou cliquez sur « Cliquez ici pour en savoir plus sur les paramètres des cookies. » pour consulter en détail les descriptions des types de cookies que nous utilisons lorsque vous visitez le site.</span><br>
			<a href="<?php echo base_url();?>page/politique-cookies" target="_blank" rel="noopener" style="margin-left: 8px;">
                Cliquez ici pour en savoir plus sur les paramètres des cookies.
			</a>
			<br>
			<a id="cookieChoiceDismiss" href="#" style="margin-left: 24px;">J'accepte</a>
		</div>
	</div>
</div>
<style>
.tooltip-inner {
    min-width: 300px;
    max-width: 40%; 
}
a.tip-bottom-robotc {
    background: #ccc;
    width: 35px;
    height: 35px;
    border-radius: 50%;
 color: red;
  display: inline-block;
    text-align: center;
    margin: 10px 0px 4px 15px;
}
input[type="file"] {
  display: block;
}
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
#cookieChoiceInfo a {
    color: #1ec1df;
}
.cookieclass footer.footer {
    margin-bottom: 80px;
}
.cookie-main p {
    padding-bottom: 10px;
}
.cookie-main {
    padding: 10rem 7rem;
    background-color: #79c2de;
    color: #fff;
}
.cookie-main h2 {
    text-align: center;
    padding-bottom: 10px;
}
a.tip-bottom-robotcc {
  
    color: red;
}
.robototpp p{    float: left;}
button.btn.btn-primary.triggerDrawcheckproof  ,button.btn.btn-primary.triggerDrawcheckp{
    width: 100% !important;position: relative;
}
@media screen and (max-width: 767px) {
.displayhideendiv {
  
    display: block !important;
    position: relative !important;
    clear: both;
}
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/jquery.magnific-popup.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url();?>assets/js/dopeNav.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/jquery.fullpage.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/jquery.matchHeight.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/script.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.fr.min.js" charset="UTF-8"></script>
<script src="<?php echo base_url();?>assets/dist/js/jquery.inputmask.bundle.js"></script>
<script>
function validateIBAN(iban) {
  var newIban = iban.toUpperCase(),
    modulo = function(divident, divisor) {
      var cDivident = '';
      var cRest = '';
      for (var i in divident) {
        var cChar = divident[i];
        var cOperator = cRest + '' + cDivident + '' + cChar;
        if (cOperator < parseInt(divisor)) {
          cDivident += '' + cChar;
        } else {
          cRest = cOperator % divisor;
          if (cRest == 0) {
            cRest = '';
          }
          cDivident = '';
        }
      }
      cRest += '' + cDivident;
      if (cRest == '') {
        cRest = 0;
      }
      return cRest;
    };
  if (newIban.search(/^[A-Z]{2}/gi) < 0) {
    return false;
  }
  newIban = newIban.substring(4) + newIban.substring(0, 4);
  newIban = newIban.replace(/[A-Z]/g, function(match) {
    return match.charCodeAt(0) - 55;
  });
  return parseInt(modulo(newIban, 97), 10) === 1;
}

function simplevalidateIBAN(iban) {
	console.log(iban.length)
	let returnCheck = 0;
	if(iban.length == 0){
		return false;
	}
	if(iban.length > 27){
		return false;
	}
	prefix = iban[0]+iban[1];
	if(prefix != "FR"){
		return false;
	}
	text = iban.substr(2);
	var letterNumber = /^[0-9a-zA-Z]+$/;
	if(text.match(letterNumber)) {
		return true;
	}else{ 
		return false;
	}
}
</script>

<script>
$(document).on('keypress keyup blur', '#city_register,#vilep', function (event) {
    var regex = new RegExp("^[a-zA-Z ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});
$("#postalcodep").on("keypress keyup blur",function (event) {    
           $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
               // $(".error").css("display", "inline");
                event.preventDefault();
				 return false;
            }else{
				var mobNumx = $(this).val();
				if(mobNumx.length == 5){
						
						return false;
					}
					else{
						return true;
					}
            }
        });
$(".allow-numeric").on("keypress keyup blur",function (event) {    
           $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
               // $(".error").css("display", "inline");
                event.preventDefault();
				 return false;
            }else{
				var mobNumx = $(this).val();
				if(mobNumx.length == 5){
						
						return false;
					}
					else{
						return true;
					}
            }
        });
		
$("#mobNum").on("keypress keyup blur",function (event) {    
  $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
               // $(".error").css("display", "inline");
                event.preventDefault();
				 return false;
            }else{
				var mobNum = $(this).val();
				var filter = /^\d*(?:\.\d{1,2})?$/;

				 
					if(mobNum.length == 10){
						
						return false;
					}
					else{
						return true;
					}
				  
				
				
            	//$(".error").css("display", "none");
            }

});		
		
		 
		
		
</script>
<?php 




		if(!empty($_SESSION['site_lang'])){
						if($_SESSION['site_lang']=='english'){						
							?>
							<script>
								$(document).ready(function() {
									var url      = window.location.href;    
									var origin   = window.location.origin;
									
									var condition = origin+'/page/Conditions_de_participation';
									var reules = origin+'/page/reglement_en';
									var privacy_policy = origin+'/page/privacy_policy';
									var legal_notice = origin+'/page/legal-notices';
									var cookie_link = origin+'/page/policy-cookies';
									
									var conditionfr = origin+'/page/modalites';
									var reulesfr = origin+'/page/reglement';
									var privacy_policyfr = origin+'/page/politique-de-confidentialite';
									var legal_noticefr = origin+'/page/mentions-legales';
									var cookie_linkfr = origin+'/page/politique-cookies';
									
									if(url === conditionfr){
										location.replace(condition);
									}
									if(url === reulesfr){
										location.replace(reules);
									}
									if(url === privacy_policyfr){
										location.replace(privacy_policy);
									}
									if(url === legal_noticefr){
										location.replace(legal_notice);
									}
									if(url === cookie_linkfr){
										location.replace(cookie_link);
									}
									
								});


								</script>
							
							
							<?php
							
							
						}
						if($_SESSION['site_lang']=='french'){
							?>
							<script>
							$(document).ready(function() {
								
								
								
								setTimeout(function(){ 
								var error=$("#errormsgtext p").html();

								if(error =='The messages field must be at least 1000 characters in length.'){
									
									$("#errormsgtext p").html('Le champ du message doit contenir au moins 1000 caractères.');
								}
								},500);
								 
									var url      = window.location.href;    
									var origin   = window.location.origin;
									
									var condition = origin+'/page/Conditions_de_participation';
									var reules = origin+'/page/reglement_en';
									var privacy_policy = origin+'/page/privacy_policy';
									var legal_notice = origin+'/page/legal-notices';
									var cookie_link = origin+'/page/policy-cookies';
									
									var conditionfr = origin+'/page/modalites';
									var reulesfr = origin+'/page/reglement';
									var privacy_policyfr = origin+'/page/politique-de-confidentialite';
									var legal_noticefr = origin+'/page/mentions-legales';
									var cookie_linkfr = origin+'/page/politique-cookies';
									
									if(url === condition){
										location.replace(conditionfr);
									}
									if(url === reules){
										location.replace(reulesfr);
									}
									if(url === privacy_policy){
										location.replace(privacy_policyfr);
									}
									if(url === legal_notice){
										location.replace(legal_noticefr);
									}
									if(url === cookie_link){
										location.replace(cookie_linkfr);
									}
								
							});


							</script>
							<?php
						}
					
					}else{
					?>
						<script>
							$(document).ready(function() {
								
								
								var error=$("#errormsgtext p").html();
								
								if(error =='The messages field must be at least 1000 characters in length.'){
									$("#errormsgtext p").html('Le champ du message doit contenir au moins 1000 caractères.');
								}
								
								
								
									var url      = window.location.href;    
									var origin   = window.location.origin;
									
									var condition = origin+'/page/Conditions_de_participation';
									var reules = origin+'/page/reglement_en';
									var privacy_policy = origin+'/page/privacy_policy';
									var legal_notice = origin+'/page/legal-notices';
									var cookie_link = origin+'/page/policy-cookies';
									
									var conditionfr = origin+'/page/modalites';
									var reulesfr = origin+'/page/reglement';
									var privacy_policyfr = origin+'/page/politique-de-confidentialite';
									var legal_noticefr = origin+'/page/mentions-legales';
									var cookie_linkfr = origin+'/page/politique-cookies';
									
									if(url === condition){
										location.replace(conditionfr);
									}
									if(url === reules){
										location.replace(reulesfr);
									}
									if(url === privacy_policy){
										location.replace(privacy_policyfr);
									}
									if(url === legal_notice){
										location.replace(legal_noticefr);
									}
									if(url === cookie_link){
										location.replace(cookie_linkfr);
									}	
							});


							</script>
						<?php
					} 
					

?>



<script>
	$(document).ready(function(){
		
		$("a.tip-bottom-robotcc").hide();
		setTimeout(function(){ 
if ($("#dferrorc p").length > 0){
		$(".tip-bottom-robotcc").show();
		
	}
	else{
		$(".tip-bottom-robotcc").hide();
		
	}
	
		}, 500);
		
		
	});
$(document).ready(function() {
	if(localStorage.getItem('cookie_accept') == null && localStorage.getItem('cookie_accept')!='summerbwtaccept' ){
		$('#cookieChoiceInfo').show();
		$('body').addClass('cookieclass');
		$('#footerr').addClass('cookieclass');
	}else{
		$('#cookieChoiceInfo').hide();
	}
	$("#cookieChoiceDismiss").click(function(){
		localStorage.setItem('cookie_accept', 'summerbwtaccept');
		$('#cookieChoiceInfo').remove();
		$('body').removeClass('cookieclass');
		$('#footerr').removeClass('cookieclass');
	});
	$("#cookieChoiceDismissIcon").click(function(){
		localStorage.setItem('cookie_reject', 'summerbwtreject');
		$('#cookieChoiceInfo').remove();
		$('body').removeClass('cookieclass');
		$('#footerr').removeClass('cookieclass');
	});
	/*$('#check_unsubcribe').submit(){
		var is_Unsubscribe = $('#is_Unsubscribe').val();
		alert(is_Unsubscribe);
	});*/
});


$(document).ready(function(){
	
    // Select and loop the container element of the elements you want to equalise
    $('.containerhom').each(function(){  
      
      // Cache the highest
      var highestBox = 0;
      
      // Select and loop the elements you want to equalise
      $('.equalheightdiv', this).each(function(){
        
        // If this box is higher than the cached highest then store it
        if($(this).height() > highestBox) {
          highestBox = $(this).height(); 
        }
      
      });  
            
      // Set the height of all those children to whichever was highest 
      $('.equalheightdiv',this).height(highestBox);
                    
    }); 

});

</script>
<script type="text/javascript">
    function clicked() {
		var is_Unsubscribe = $('.is_Unsubscribe').val();
		if(is_Unsubscribe != ''){	
			if (confirm('Êtes-vous sûr de vouloir vous désabonner?')) {
			   yourformelement.submit();
			} else {
			   return false;
			}
		}
    }

</script>
<style>
.result {
        margin-top: 0.8rem;
        padding: 0.8rem;
        border: solid 1px;
      }

      .valid {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
      }

      .invalid {
        color: #856404;
        background-color: #fff3cd;
        border-color: #ffeeba;
      }
</style>
<script>
$.fn.datepicker.dates['fr'] = {
    days:["dimanche","lundi","mardi","mercredi","jeudi","vendredi","samedi"],
    daysShort:["dim.","lun.","mar.","mer.","jeu.","ven.","sam."],
    daysMin: ["Di","Lu", "Ma", "Me", "Je", "Ve", "Sa"],
   // dayNames: [ "dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi" ],
	//dayNamesShort: [ "dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam." ],
	//dayNamesMin: [ "D","L","M","M","J","V","S" ],
	//weekHeader: "Sem.",
    months:["janvier","février","mars","avril","mai","juin","juillet","août","septembre","octobre","novembre","décembre"],
    monthsShort:["janv.","févr.","mars","avril","mai","juin","juil.","août","sept.","oct.","nov.","déc."],
    today:"Aujourd'hui",
    clear:"Effacer",
    format: "yyyy-mm-dd",
    titleFormat: "MM yyyy",
    weekStart: 0
};
//Date picker
 if ($(window).width() < 768) { $('.date-picker').datepicker({format: "dd-mm-yyyy" }); $('.date-picker22').datepicker({format: "dd-mm-yyyy" }); }

<?php 
if(!empty($_SESSION['site_lang'])){
						if($_SESSION['site_lang']=='english'){

?>
$('.date-picker').datepicker({
	autoclose: true,format: "dd-mm-yyyy" 

});
$('.date-picker2').datepicker();

<?php							
					
						}						if($_SESSION['site_lang']=='french'){
							?>
								$('.date-picker').datepicker({
	autoclose: true,
	language:'fr',
	locale:'fr',
	format: "dd-mm-yyyy" ,
});
							
							<?php
							
							
						}
}
else{
	?>
	$('.date-picker').datepicker({
	autoclose: true,
	language:'fr',
	locale:'fr',
	format: "dd-mm-yyyy" 
});
	 
	<?php
}
?>

 
  $(".tip-bottom-robotc").tooltip({
        animated: 'fade',
    placement: 'bottom',
    html: true
    });

	
	$(".psotcoder").inputmask();
      $(".bank_bic").inputmask();
	  //$(".bank_iban").inputmask();
	
  $(".tip-bottom-robotcc").tooltip({
        animated: 'fade',
    placement: 'bottom',
    html: true
    });	

	$(".tip-bottom-robotc").click(function(event){
		event.preventDefault();
	}
		)
	
$(".store_id").change(function(){
	var handle = $('option:selected', this).attr('handle');
	if(handle=='autre'){
		$('.another-store-handle').show();
		$('#selectproduct').prop("required", "true");
	}else{
		$('.another-store-handle').hide();
	//	$('#selectproduct').removeAttr('required');
	}
}); 

$(document).on('paste', '.bank_iban', function(e) {
  e.preventDefault();
  withoutSpaces = e.originalEvent.clipboardData.getData('Text');
  withoutSpaces = withoutSpaces.replace(/\s+/g, '');
  console.log("1"+withoutSpaces)
  $(this).val(withoutSpaces);
});

$("#checkvalidationiban").hide();$("#IBANextra").hide();
$(document).on('keypress keyup blur paste', '.bank_iban', function (event) {
	console.log("2"+$(".bank_iban").val())
	var checkibano = simplevalidateIBAN($(".bank_iban").val());
	console.log("3"+$(".bank_iban").val())
	$(".error-keyup-4").remove();
	console.log(checkibano);
	if(checkibano != true){
		$(".bank_iban").after('<span class="error error-keyup-4">IBAN Incorrect</span>');
	
	}
	else{
		$(".error-keyup-4").remove();
	}

});
$(document).on('keypress keyup blur paste', '.bank_bic', function (event) {
	var bankbic = $(".bank_bic").val().replace("_", "");
	$(".error-keyup-3").remove();
	flag = 0;
	if(bankbic.length != 8){
		flag = 1;
		$(".bank_bic").after('<span class="error error-keyup-3"> BIC incorrect</span>');
	}else{
		$(".error-keyup-3").remove();
	}

});
$(".triggerDrawcheck").click(function(e){
	$('span.error-keyup-3').remove();
	$('span.error-keyup-4').remove();
	$('span.error-keyup-5').remove();
	$(".error-keyup-datepicker").remove();
	$(".error-keyup-roboto").remove();
	$(".error-keyup-message").remove();
	$(".error-keyup-proofimg").remove();
	$(".error-keyup-serialno").remove();
	$(".error-keyup-stroreerro").remove();
	$(".error-keyup-nomstroe").remove();
	$(".error-keyup-vile").remove();
	$(".error-keyup-postcode").remove();
	$(".error-keyup-nomaddress").remove();
	flag = 0;
	
	inputVal = $(".bank_bic").val().replace("_", "");
	if(inputVal.length != 8){
		flag = 1;
		$(".bank_bic").after('<span class="error error-keyup-3"> BIC incorrect</span>');
	}
	var ibnaval = $(".bank_iban").val();
	
	
	var checkibano = simplevalidateIBAN($(".bank_iban").val());
	
	
	if(checkibano != true){
		flag = 1;
		$(".bank_iban").after('<span class="error error-keyup-4">IBAN Incorrect</span>');
	}else{
		$(".error-keyup-4").remove();
	}
	var selectrobot = $("#selectrobot").val();
	var roboto_serial_no = $("#roboto_serial_no").val();
	var datepicker_pi = $("#datepicker_pi").val();
	var selectpurchase = $("#selectpurchase").val();
	var upload_proof = $(".upload_proof").val();
	var message= $("#exampleFormControlTextarea1").val();
	//AUTRE

	console.log(selectrobot+'---'+datepicker_pi);
	if(datepicker_pi == ''){
		flag = 1;
		$("#datepicker_pi").next('.error').append('<span class="error error-keyup-datepicker">Le champ Date d`achat est obligatoire</span>');
	}else{
		$(".error-keyup-datepicker").remove();
	}
	if(selectrobot == 'none' ){
		flag = 1;
		$("#selectrobot").next('.error').append('<span class="error error-keyup-roboto">Le champ robot est obligatoire.</span>');
	}else{
		$(".error-keyup-roboto").remove();
	}
	if(message == ''){
		flag = 1;
		$("#errormsgtext").append('<span class="error error-keyup-message">Le champ du message doit contenir au moins 1000 caractères.</span>');
	}else{
		$(".error-keyup-message").remove();
	}

	if(upload_proof == ''){
		flag = 1;
		$("#emailHelp").next('.error').append('<span class="error error-keyup-proofimg">Veuillez télécharger la preuve.</span>');
	}else{
		$(".error-keyup-proofimg").remove();
	}

	if(roboto_serial_no == ''){
		flag = 1;
		$("#roboto_serial_no").next('.error').append('<span class="error error-keyup-serialno">Le champ modèle du robot est obligatoire.</span>');
	}else{
		$(".error-keyup-serialno").remove();
	}

	if(selectpurchase == 'none'){
		flag = 1;
		$("#store_iderror").append('<span class="error error-keyup-stroreerro">Le champ  le numéro de série du robot est obligatoire.</span>');
	}else{
		$(".error-keyup-stroreerro").remove();
	}
	if(selectpurchase == 'AUTRE'){
		var nomstoreadditional = $("#nomstoreadditional").val();
		var nom_address = $("#nom_address").val();
		var postalcode = $("#postalcodep").val();
		var vile = $("#vilep").val();
		
		if(nomstoreadditional == ''){
		flag = 1;
			$("#nomstoreadditional").next('.error').append("<span class='error error-keyup-nomstroe'>Nom de l'enseigne.</span>");
		}else{
				$(".error-keyup-nomstroe").remove();
		}

		if(nom_address == ''){
		flag = 1;
			$("#nom_address").next('.error').append('<span class="error error-keyup-nomaddress">Le champ  l’adresse est obligatoire.</span>');
		}else{
				$(".error-keyup-nomaddress").remove();
		}


		if(postalcode == ''){
		flag = 1;
			$("#postalcodep").next('.error').append('<span class="error error-keyup-postcode">Le champ  Postal Code est obligatoire.</span>');
		}else{
				$(".error-keyup-postcode").remove();
		}


		if(vile == ''){
		flag = 1;
			$("#vilep").next('.error').append('<span class="error error-keyup-vile">Le champ  Vile est obligatoire.</span>');
		}else{
				$(".error-keyup-vile").remove();
		}

	}




	if(flag == 0){
		$(".triggerDraw").trigger("click");
	}
});





$(".triggerDrawcheckproof").click(function(e){
	$('span.error-keyup-3').remove();
	$('span.error-keyup-4').remove();
	$('span.error-keyup-5').remove();
	$(".error-keyup-datepicker").remove();
	$(".error-keyup-roboto").remove();
	$(".error-keyup-message").remove();
	$(".error-keyup-proofimg").remove();
	$(".error-keyup-serialno").remove();
	$(".error-keyup-stroreerro").remove();
	$(".error-keyup-nomstroe").remove();
	$(".error-keyup-vile").remove();
	$(".error-keyup-postcode").remove();
	$(".error-keyup-nomaddress").remove();
	flag = 0;
	
	inputVal = $(".bank_bic").val().replace("_", "");
	if(inputVal.length != 8){
		flag = 1;
		$(".bank_bic").after('<span class="error error-keyup-3"> BIC incorrect</span>');
	}
	var ibnaval = $(".bank_iban").val();
	
	
	var checkibano = simplevalidateIBAN($(".bank_iban").val());
	
	
	if(checkibano != true){
		flag = 1;
		$(".bank_iban").after('<span class="error error-keyup-4">IBAN Incorrect</span>');
	}else{
		$(".error-keyup-4").remove();
	}
	var selectrobot = $("#selectrobot").val();
	var roboto_serial_no = $("#roboto_serial_no").val();
	var datepicker_pi = $("#datepicker_pi").val();
	var selectpurchase = $("#selectpurchase").val();
	var upload_proof = $(".upload_proof").val();
	
	//AUTRE

	
	if(datepicker_pi == ''){
		flag = 1;
		$("#datepicker_pi").next('.error').append('<span class="error error-keyup-datepicker">Le champ Date d`achat est obligatoire</span>');
	}else{
		$(".error-keyup-datepicker").remove();
	}
	if(selectrobot == 'none' ){
		flag = 1;
		$("#selectrobot").next('.error').append('<span class="error error-keyup-roboto">Le champ robot est obligatoire.</span>');
	}else{
		$(".error-keyup-roboto").remove();
	}
	
	if(upload_proof == ''){
		flag = 1;
		$("#emailHelp").next('.error').append('<span class="error error-keyup-proofimg">Veuillez télécharger la preuve.</span>');
	}else{
		$(".error-keyup-proofimg").remove();
	}

	if(roboto_serial_no == ''){
		flag = 1;
		$("#roboto_serial_no").next('.error').append('<span class="error error-keyup-serialno">Le champ modèle du robot est obligatoire.</span>');
	}else{
		$(".error-keyup-serialno").remove();
	}

	if(selectpurchase == 'none'){
		flag = 1;
		$("#store_iderror").append('<span class="error error-keyup-stroreerro">Le champ  le numéro de série du robot est obligatoire.</span>');
	}else{
		$(".error-keyup-stroreerro").remove();
	}
	if(selectpurchase == 'AUTRE'){
		var nomstoreadditional = $("#nomstoreadditional").val();
		var nom_address = $("#nom_address").val();
		var postalcode = $("#postalcodep").val();
		var vile = $("#vilep").val();
		
		if(nomstoreadditional == ''){
		flag = 1;
			$("#nomstoreadditional").next('.error').append("<span class='error error-keyup-nomstroe'>Nom de l'enseigne.</span>");
		}else{
				$(".error-keyup-nomstroe").remove();
		}

		if(nom_address == ''){
		flag = 1;
			$("#nom_address").next('.error').append('<span class="error error-keyup-nomaddress">Le champ  l’adresse est obligatoire.</span>');
		}else{
				$(".error-keyup-nomaddress").remove();
		}


		if(postalcode == ''){
		flag = 1;
			$("#postalcodep").next('.error').append('<span class="error error-keyup-postcode">Le champ  Postal Code est obligatoire.</span>');
		}else{
				$(".error-keyup-postcode").remove();
		}


		if(vile == ''){
		flag = 1;
			$("#vilep").next('.error').append('<span class="error error-keyup-vile">Le champ  Vile est obligatoire.</span>');
		}else{
				$(".error-keyup-vile").remove();
		}

	}


	if(flag == 0){
		$(".triggerDraw").trigger("click");
	}
});


$(".triggerDrawcheckp").click(function(e){
	$('span.error-keyup-3').remove();
	$('span.error-keyup-4').remove();
	$('span.error-keyup-5').remove();
	
	$(".error-keyup-proofimg").remove();
	$(".error-keyup-serialno").remove();
	$(".error-keyup-stroreerro").remove();
	$(".error-keyup-nomstroe").remove();
	$(".error-keyup-vile").remove();
	$(".error-keyup-postcode").remove();
	$(".error-keyup-nomaddress").remove();
	flag = 0;
	

	
	var selectpurchase = $("#selectpurchase").val();
	var upload_proof = $(".upload_proof").val();
	
	if(upload_proof == ''){
		flag = 1;
		$("#emailHelp").next('.error').append('<span class="error error-keyup-proofimg">Veuillez télécharger la preuve.</span>');
	}else{
		$(".error-keyup-proofimg").remove();
	}


	if(selectpurchase == 'none'){
		flag = 1;
		$("#selectpurchase").next('.error').append('<span class="error error-keyup-stroreerro">Le champ  le numéro de série du robot est obligatoire.</span>');
	}else{
		$(".error-keyup-stroreerro").remove();
	}
	if(selectpurchase == 'AUTRE'){
		var nomstoreadditional = $("#nomstoreadditional").val();
		var nom_address = $("#nom_address").val();
		var postalcode = $("#postalcodep").val();
		var vile = $("#vilep").val();
		
		if(nomstoreadditional == ''){
		flag = 1;
			$("#nomstoreadditional").next('.error').append("<span class='error error-keyup-nomstroe'>Nom de l'enseigne.</span>");
		}else{
				$(".error-keyup-nomstroe").remove();
		}

		if(nom_address == ''){
		flag = 1;
			$("#nom_address").next('.error').append('<span class="error error-keyup-nomaddress">Le champ  l’adresse est obligatoire.</span>');
		}else{
				$(".error-keyup-nomaddress").remove();
		}


		if(postalcode == ''){
		flag = 1;
			$("#postalcodep").next('.error').append('<span class="error error-keyup-postcode">Le champ  Postal Code est obligatoire.</span>');
		}else{
				$(".error-keyup-postcode").remove();
		}


		if(vile == ''){
		flag = 1;
			$("#vilep").next('.error').append('<span class="error error-keyup-vile">Le champ  Vile est obligatoire.</span>');
		}else{
				$(".error-keyup-vile").remove();
		}

	}


	if(flag == 0){
		$(".triggerDrawp").trigger("click");
	}
});



$(".triggerDrawcheckmb").click(function(e){
	$('span.error-keyup-3').remove();
	$('span.error-keyup-4').remove();
	$('span.error-keyup-5').remove();
	flag = 0;
	
	inputVal = $(".bank_bic").val().replace("_", "");
	if(inputVal.length != 8){
		flag = 1;
		$(".bank_bic").after('<span class="error error-keyup-3"> BIC incorrect</span>');
	}
	inputVal = $(".bank_iban").val().replace("_", "");
	
	if(inputVal.length != 32){
		flag = 1;
		$(".bank_iban").after('<span class="error error-keyup-4">IBAN Incorrect</span>');
	}

	
	if(flag == 0){
		$(".triggerDrawmb").trigger("click");
	}
});




$(function() {
	//$("#siret_div").hide();
    $("input[name='contact']").click(function() {
		var inputValue = $(this).attr("value");
      if (inputValue == 'pro') {
        $("#siret_div").hide();
      } else {
        $("#siret_div").hide();
		$("#siret").val('');
      }
    });
  });



  $(window).resize(function() {
        var bodyheight = $('#cookieChoiceInfo').height();
		$("#footerr.cookieclass.footer").css("margin-bottom", bodyheight);
      //  $("#footerr.cookieclass.footer").height(bodyheight);
    }).resize();

$('#exampleFormControlTextarea1').keyup(function () {
  var min = 1000;
  var len = $(this).val().length;
  if (len > min) {
    $('.form-group.reason-box .error').text('');
  } else {
    var char = min - len;
	<?php  if(!empty($_SESSION['site_lang'])){
								if($_SESSION['site_lang']=='english'){?>
	 $('.form-group.reason-box .error').text(char + ' characters left');
	 
	<?php }  else { ?>
		
		 $('.form-group.reason-box .error').text(char + ' caractères restants');
		
	<?php }
	
	} ?>

	}
   
  });

			$('#selectrobotcountry').change(function(){ 
                var id=$(this).val();
				var storeidp=$('#storeidp').val();
                $.ajax({
                    url : "<?php echo base_url('front/get_country_store_handle');?>",
                    method : "POST",
                    data : {id: id, storeid: storeidp },
                    async : true,
                    dataType : 'json',
                    success: function(response){
                         
						$('#selectpurchase').find('option').not(':first').remove();

												
						$.each(response,function(index,data){
							$('#selectpurchase').append('<option value="'+data['id']+'"  handle="'+data['store_handle']+'">'+data['store_name']+'</option>');
						});
						$('#selectpurchase').append('<option value="AUTRE" handle="autre" >AUTRE</option>');
                      
 
                    }
                });
                return false;
			}); 

			if($('#sotrycountry').val()!=''){
				debugger;
				var storcount=$('#sotrycountry').val();
				var id=$('#selectrobotcountry').val();
				var sotrename=$('#sotreidvalue').val();
				console.log(sotrename);
				var storeidp=$('#storeidp').val();
                $.ajax({
                    url : "<?php echo base_url('front/get_country_store_handle');?>",
                    method : "POST",
                    data : {id: id, storeid: storeidp },
                    async : true,
                    dataType : 'json',
                    success: function(response){
                         
						$('#selectpurchase').find('option').not(':first').remove();

												
						$.each(response,function(index,data){
							if(sotrename!=''){
								if(sotrename == data['id']){
									$('#selectpurchase').append('<option selected value="'+data['id']+'"  handle="'+data['store_handle']+'">'+data['store_name']+'</option>');
									
								}else{
									$('#selectpurchase').append('<option value="'+data['id']+'"  handle="'+data['store_handle']+'">'+data['store_name']+'</option>');
									
								}
								
							}
							else{
								
								$('#selectpurchase').append('<option value="'+data['id']+'"  handle="'+data['store_handle']+'">'+data['store_name']+'</option>');
							}
							
						});
						if(sotrename!=''){
							if(sotrename == 'AUTRE'){
								$('#selectpurchase').append('<option value="AUTRE" selected  handle="autre" >AUTRE</option>');
							}else{
								$('#selectpurchase').append('<option value="AUTRE"   handle="autre" >AUTRE</option>');
							}
							
						}else{
							$('#selectpurchase').append('<option value="AUTRE"   handle="autre" >AUTRE</option>');
						}
						
                      
 
                    }
                });
                //return false;
	
			}

			$('#selectcovercountry').change(function(){ 
                var id=$(this).val();
				var storeidp=$('#storeidp').val();
                $.ajax({
                    url : "<?php echo base_url('front/get_country_cover_store_handle');?>",
                    method : "POST",
                    data : {id: id, storeid: storeidp },
                    async : true,
                    dataType : 'json',
                    success: function(response){
                         
						$('#selectpurchase').find('option').not(':first').remove();

												
						$.each(response,function(index,data){
							$('#selectpurchase').append('<option value="'+data['id']+'"  handle="'+data['store_handle']+'">'+data['store_name']+'</option>');
						});
						$('#selectpurchase').append('<option value="AUTRE" handle="autre" >AUTRE</option>');
                      
 
                    }
                });
                return false;
			}); 

			if($('#coversotrycountry').val()!=''){
			
				var storcount=$('#coversotrycountry').val();
				var id=$('#selectcovercountry').val();
				var sotrename=$('#sotreidvalue').val();
				console.log(sotrename);
				var storeidp=$('#storeidp').val();
                $.ajax({
                    url : "<?php echo base_url('front/get_country_cover_store_handle');?>",
                    method : "POST",
                    data : {id: id, storeid: storeidp },
                    async : true,
                    dataType : 'json',
                    success: function(response){
                         
						$('#selectpurchase').find('option').not(':first').remove();

												
						$.each(response,function(index,data){
							if(sotrename!=''){
								if(sotrename == data['id']){
									$('#selectpurchase').append('<option selected value="'+data['id']+'"  handle="'+data['store_handle']+'">'+data['store_name']+'</option>');
									
								}else{
									$('#selectpurchase').append('<option value="'+data['id']+'"  handle="'+data['store_handle']+'">'+data['store_name']+'</option>');
									
								}
								
							}
							else{
								
								$('#selectpurchase').append('<option value="'+data['id']+'"  handle="'+data['store_handle']+'">'+data['store_name']+'</option>');
							}
							
						});
						if(sotrename!=''){
							if(sotrename == 'AUTRE'){
								$('#selectpurchase').append('<option value="AUTRE" selected  handle="autre" >AUTRE</option>');
							}else{
								$('#selectpurchase').append('<option value="AUTRE"   handle="autre" >AUTRE</option>');
							}
							
						}else{
							$('#selectpurchase').append('<option value="AUTRE"   handle="autre" >AUTRE</option>');
						}
						
                      
 
                    }
                });
                //return false;
	
			}

			$('#selectrobotcountryrefund').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo base_url('front/get_country_store');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(response){
                         
						$('#selectsale').find('option').not(':first').remove();

												
						$.each(response,function(index,data){
							$('#selectsale').append('<option value="'+data['id']+'"  handle="'+data['store_handle']+'">'+data['store_name']+'</option>');
						});

                      
 
                    }
                });
                return false;
			}); 		

			$('#selectrobotcountryoffer').change(function(){ 
				var id=$(this).val();
				 $.ajax({
                    url : "<?php echo base_url('front/get_country_store_handle');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(response){
						$('#selectproduct').find('option').not(':first').remove();

                        
						$.each(response,function(index,data){
            				 $('#selectproduct').append('<option value="'+data['id']+'"  handle="'+data['store_handle']+'">'+data['store_name']+'</option>');
         				 });
                      
 
                    }
                });
                return false;
			}); 


			

</script>
<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
<?php

?>
<script type="text/javascript">
$(document).ready(function() {
	$(document).on('click', '.remove' ,function (e) {
		e.preventDefault();
		$(".upload_proof").val('');
		
	  
						$(this).parent(".pip").remove();
					  });

  if (window.File && window.FileList && window.FileReader) {
    $(".upload_proof").on("change", function(e) {
		e.preventDefault();
		 if(this.files[0].size > 3000000) {
       alert("Merci de télécharger des pièces de 3Mo maximum");
       $(this).val('');
     }else {
		
		if (this.files && this.files[0] && this.files[0].name.match(/\.(jpg|jpeg|png|pdf)$/) ) {
			if($( ".pip" ).length==0){
				var files = e.target.files;
				filesLength = files.length;
				var data = files[0].name;
				var arr = data.split('.');
				var extentionmane=arr[1];
				//console.log(data);
				for (var i = 0; i < filesLength; i++) {
					var f = files[i];
					var fileReader = new FileReader();
					fileReader.onload = (function(e) {
					  var file = e.target;
					  <?php 
					  if(!empty($_SESSION['site_lang'])){
								if($_SESSION['site_lang']=='english'){
								?>
								if(extentionmane == 'pdf'){
									$("<span class=\"pip\">" +
									"<img class=\"imageThumb\" src=\"https://promos-bwt.com/assets/image/pdf.png\" title=\"" + data + "\"/>" +
									"<br/>" +  data + "<span class=\"remove\">Remove PDF</span>" +
									"</span>").insertAfter("#files");
									$(".remove").click(function(){
										$(this).parent(".pip").remove();
									});
								}
								else{
									 $("<span class=\"pip\">" +
									"<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
									"<br/><span class=\"remove\">Remove image</span>" +
									"</span>").insertAfter("#files");
								}
								
								
								<?php	
								}
								if($_SESSION['site_lang']=='french'){
									?>
									if(extentionmane == 'pdf'){
									$("<span class=\"pip\">" +
									"<img class=\"imageThumb\" src=\"https://promos-bwt.com/assets/image/pdf.png\" title=\"" + data + "\"/>" +
									"<br/>" +  data + "<span class=\"remove\">Supprimer le fichier</span>" +
									"</span>").insertAfter("#files");
									$(".remove").click(function(){
										$(this).parent(".pip").remove();
									});
								}
								else{
									 $("<span class=\"pip\">" +
						"<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
						"<br/><span class=\"remove\">supprimer l'image</span>" +
						"</span>").insertAfter("#files");
								}
									
									
									
									
								
								
								<?php
								}
	
						}else{
							?>
							if(extentionmane == 'pdf'){
								$("<span class=\"pip\">" +
									"<img class=\"imageThumb\" src=\"https://promos-bwt.com/assets/image/pdf.png\" title=\"" +data + "\"/>" +
									"<br/>" +  data + "<span class=\"remove\">Supprimer le fichier</span>" +
									"</span>").insertAfter("#files");
									$(".remove").click(function(){
										$(this).parent(".pip").remove();
									});
								
							}
							else{
								 $("<span class=\"pip\">" +
						"<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
						"<br/><span class=\"remove\">supprimer l'image</span>" +
						"</span>").insertAfter("#files");	
								
							}
							
								
						<?php
						} 
											  
					  ?>
					  
					 
					  $(".remove").click(function(){
						$(this).parent(".pip").remove();
					  });
					  
					  // Old code here
					  /*$("<img></img>", {
						class: "imageThumb",
						src: e.target.result,
						title: file.name + " | Click to remove"
					  }).insertAfter("#files").click(function(){$(this).remove();});*/
					  
					});
					fileReader.readAsDataURL(f);
				}
			}else{
				alert('please select only one image');
			}
		} else {
			alert('merci de ‘renvoyer que des fichiers image ou pdf - Format .png .jpeg/.jpg .pdf ');
		}
    
	
	}
	});
  } else {
    alert("Your browser doesn't support to File API")
  }
});

$(document).ready(function() {
	$('.image-popup-vertical-fit').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		mainClass: 'mfp-img-mobile',
		image: {
			verticalFit: true
		}
	});
	$('.image-popup-fit-width').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		image: {
			verticalFit: false
		}
	});
	$('.image-popup-no-margins').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		fixedContentPos: true,
		mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 300 // don't foget to change the duration also in CSS
		}
	});
});
</script>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId: '255367465347306',
      cookie: true, 
      version: 'v2.2'
    });
  };
  (function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
  
	function facebook_login() 
	{
		FB.login(function (response) {
            if (response.authResponse) 
			{
                console.log('Welcome!  Fetching your information.... ');
                 
                FB.api('/me', { fields: 'first_name,last_name,email' } , function (response) {				
				
                    $.post("<?php echo base_url("front/loginwithfb"); ?>",
					{
						"first_name": response.first_name,
						"last_name": response.last_name,
						"fbid":response.id,
						"email" : response.email,
                    },
					function(data)
					{
						var r = confirm(data);
						if (r == true) {
							if(data=="Facebook Login successfully!")
							{
								window.top.location.href = "<?php echo base_url().'dashboard'; ?>";
							}
							else
							{
								window.top.location.href = "<?php echo base_url(); ?>";
							}
						}else{
							window.top.location.href = "<?php echo base_url(); ?>";
						}
					});
                });
            } 
			else
			{
                console.log('User cancelled login or did not fully authorize.');
            }
        });
    }
</script>
</body>
</html>