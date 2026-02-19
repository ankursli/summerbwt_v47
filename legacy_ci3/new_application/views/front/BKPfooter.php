	<?php 
	$base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .  $_SERVER['HTTP_HOST'];
	
	
	if(!empty($_SESSION['site_lang'])){
						if($_SESSION['site_lang']=='english'){
							$clink= $base_url.'/bwt/summer20/page/Conditions_de_participation';
							$reules= $base_url.'/bwt/summer20/page/reglement_en';
							$privacy_policy=$base_url.'/bwt/summer20/page/privacy_policy';
							$legal_notice=$base_url.'/bwt/summer20/page/legal-notices';
							$cookie_link=$base_url.'/bwt/summer20/page/policy-cookies';
						}
						if($_SESSION['site_lang']=='french'){
							$clink= $base_url.'/bwt/summer20/page/modalites';
						    $reules= $base_url.'/bwt/summer20/page/reglement';
							$privacy_policy=$base_url.'/bwt/summer20/page/politique-de-confidentialite';
							$legal_notice=$base_url.'/bwt/summer20/page/mentions-legales';
							$cookie_link=$base_url.'/bwt/summer20/page/politique-cookies';
						}
					
					}else{
						$clink= $base_url.'/bwt/summer20/page/modalites';
						$reules= $base_url.'/bwt/summer20/page/reglement';
						$privacy_policy=$base_url.'/bwt/summer20/page/politique-de-confidentialite';
						$legal_notice=$base_url.'/bwt/summer20/page/mentions-legales';
						$cookie_link=$base_url.'/bwt/summer20/page/politique-cookies';
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
							<li><a target="_blank"  href="https://www.bwt.fr/fr/Pages/default.aspx"><?php echo $this->lang->line('label_the_bwt_group');?></a></li>
							<li><a target="_blank" href="<?php echo $clink;?>"><?php echo $this->lang->line('label_conditions_of_participation');?></a></li>
							<li><a target="_blank" href="<?php echo $reules; ?>"><?php echo $this->lang->line('label_reglementlink_data');?></a></li>
							<li><a target="_blank" href="<?php echo $privacy_policy ;?>"><?php echo $this->lang->line('label_pravicy_policy_menu');?></a></li>
							<li><a target="_blank" href="<?php echo $cookie_link;?>"><?php echo $this->lang->line('label_cookies');?></a></li>
							<li><a target="_blank" href="<?php echo $legal_notice;?>"><?php echo $this->lang->line('label_legal_notice');?></a></li>
							
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
<?php 

		if(!empty($_SESSION['site_lang'])){
						if($_SESSION['site_lang']=='english'){						
							?>
							<script>
								$(document).ready(function() {
									var url      = window.location.href;    
									var origin   = window.location.origin;
									
									var condition = origin+'/bwt/summer20/page/Conditions_de_participation';
									var reules = origin+'/bwt/summer20/page/reglement_en';
									var privacy_policy = origin+'/bwt/summer20/page/privacy_policy';
									var legal_notice = origin+'/bwt/summer20/page/legal-notices';
									var cookie_link = origin+'/bwt/summer20/page/policy-cookies';
									
									var conditionfr = origin+'/bwt/summer20/page/modalites';
									var reulesfr = origin+'/bwt/summer20/page/reglement';
									var privacy_policyfr = origin+'/bwt/summer20/page/politique-de-confidentialite';
									var legal_noticefr = origin+'/bwt/summer20/page/mentions-legales';
									var cookie_linkfr = origin+'/bwt/summer20/page/politique-cookies';
									
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
									
									var condition = origin+'/bwt/summer20/page/Conditions_de_participation';
									var reules = origin+'/bwt/summer20/page/reglement_en';
									var privacy_policy = origin+'/bwt/summer20/page/privacy_policy';
									var legal_notice = origin+'/bwt/summer20/page/legal-notices';
									var cookie_link = origin+'/bwt/summer20/page/policy-cookies';
									
									var conditionfr = origin+'/bwt/summer20/page/modalites';
									var reulesfr = origin+'/bwt/summer20/page/reglement';
									var privacy_policyfr = origin+'/bwt/summer20/page/politique-de-confidentialite';
									var legal_noticefr = origin+'/bwt/summer20/page/mentions-legales';
									var cookie_linkfr = origin+'/bwt/summer20/page/politique-cookies';
									
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
									
									var condition = origin+'/bwt/summer20/page/Conditions_de_participation';
									var reules = origin+'/bwt/summer20/page/reglement_en';
									var privacy_policy = origin+'/bwt/summer20/page/privacy_policy';
									var legal_notice = origin+'/bwt/summer20/page/legal-notices';
									var cookie_link = origin+'/bwt/summer20/page/policy-cookies';
									
									var conditionfr = origin+'/bwt/summer20/page/modalites';
									var reulesfr = origin+'/bwt/summer20/page/reglement';
									var privacy_policyfr = origin+'/bwt/summer20/page/politique-de-confidentialite';
									var legal_noticefr = origin+'/bwt/summer20/page/mentions-legales';
									var cookie_linkfr = origin+'/bwt/summer20/page/politique-cookies';
									
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
<script>
$.fn.datepicker.dates['fr'] = {
    days:["dimanche","lundi","mardi","mercredi","jeudi","vendredi","samedi"],
    daysShort:["dim.","lun.","mar.","mer.","jeu.","ven.","sam."],
    daysMin: ["Lu", "Ma", "Me", "Je", "Ve", "Sa", "Di"],
    months:["janvier","février","mars","avril","mai","juin","juillet","août","septembre","octobre","novembre","décembre"],
    monthsShort:["janv.","févr.","mars","avril","mai","juin","juil.","août","sept.","oct.","nov.","déc."],
    today:"Aujourd'hui",
    clear:"Effacer",
    format: "yyyy-mm-dd",
    titleFormat: "MM yyyy",
    weekStart: 0
};
//Date picker
 if ($(window).width() < 768) { $('#date-picker').datepicker(); $('.date-picker22').datepicker(); }

<?php 
if(!empty($_SESSION['site_lang'])){
						if($_SESSION['site_lang']=='english'){

?>
$('#date-picker').datepicker({
	autoclose: true,

});
$('#date-picker2').datepicker();

<?php							
					
						}						if($_SESSION['site_lang']=='french'){
							?>
								$('#date-picker').datepicker({
	autoclose: true,
	language:'fr',
	locale:'fr'
});
							
							<?php
							
							
						}
}
else{
	?>
	$('#date-picker').datepicker({
	autoclose: true,
	language:'fr',
	locale:'fr'
});
	 
	<?php
}
?>

 (function(e){function t(){var e=document.createElement("input"),t="onpaste";return e.setAttribute(t,""),"function"==typeof e[t]?"paste":"input"}var n,a=t()+".mask",r=navigator.userAgent,i=/iphone/i.test(r),o=/android/i.test(r);e.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},dataName:"rawMaskFn",placeholder:"_"},e.fn.extend({caret:function(e,t){var n;if(0!==this.length&&!this.is(":hidden"))return"number"==typeof e?(t="number"==typeof t?t:e,this.each(function(){this.setSelectionRange?this.setSelectionRange(e,t):this.createTextRange&&(n=this.createTextRange(),n.collapse(!0),n.moveEnd("character",t),n.moveStart("character",e),n.select())})):(this[0].setSelectionRange?(e=this[0].selectionStart,t=this[0].selectionEnd):document.selection&&document.selection.createRange&&(n=document.selection.createRange(),e=0-n.duplicate().moveStart("character",-1e5),t=e+n.text.length),{begin:e,end:t})},unmask:function(){return this.trigger("unmask")},mask:function(t,r){var c,l,s,u,f,h;return!t&&this.length>0?(c=e(this[0]),c.data(e.mask.dataName)()):(r=e.extend({placeholder:e.mask.placeholder,completed:null},r),l=e.mask.definitions,s=[],u=h=t.length,f=null,e.each(t.split(""),function(e,t){"?"==t?(h--,u=e):l[t]?(s.push(RegExp(l[t])),null===f&&(f=s.length-1)):s.push(null)}),this.trigger("unmask").each(function(){function c(e){for(;h>++e&&!s[e];);return e}function d(e){for(;--e>=0&&!s[e];);return e}function m(e,t){var n,a;if(!(0>e)){for(n=e,a=c(t);h>n;n++)if(s[n]){if(!(h>a&&s[n].test(R[a])))break;R[n]=R[a],R[a]=r.placeholder,a=c(a)}b(),x.caret(Math.max(f,e))}}function p(e){var t,n,a,i;for(t=e,n=r.placeholder;h>t;t++)if(s[t]){if(a=c(t),i=R[t],R[t]=n,!(h>a&&s[a].test(i)))break;n=i}}function g(e){var t,n,a,r=e.which;8===r||46===r||i&&127===r?(t=x.caret(),n=t.begin,a=t.end,0===a-n&&(n=46!==r?d(n):a=c(n-1),a=46===r?c(a):a),k(n,a),m(n,a-1),e.preventDefault()):27==r&&(x.val(S),x.caret(0,y()),e.preventDefault())}function v(t){var n,a,i,l=t.which,u=x.caret();t.ctrlKey||t.altKey||t.metaKey||32>l||l&&(0!==u.end-u.begin&&(k(u.begin,u.end),m(u.begin,u.end-1)),n=c(u.begin-1),h>n&&(a=String.fromCharCode(l),s[n].test(a)&&(p(n),R[n]=a,b(),i=c(n),o?setTimeout(e.proxy(e.fn.caret,x,i),0):x.caret(i),r.completed&&i>=h&&r.completed.call(x))),t.preventDefault())}function k(e,t){var n;for(n=e;t>n&&h>n;n++)s[n]&&(R[n]=r.placeholder)}function b(){x.val(R.join(""))}function y(e){var t,n,a=x.val(),i=-1;for(t=0,pos=0;h>t;t++)if(s[t]){for(R[t]=r.placeholder;pos++<a.length;)if(n=a.charAt(pos-1),s[t].test(n)){R[t]=n,i=t;break}if(pos>a.length)break}else R[t]===a.charAt(pos)&&t!==u&&(pos++,i=t);return e?b():u>i+1?(x.val(""),k(0,h)):(b(),x.val(x.val().substring(0,i+1))),u?t:f}var x=e(this),R=e.map(t.split(""),function(e){return"?"!=e?l[e]?r.placeholder:e:void 0}),S=x.val();x.data(e.mask.dataName,function(){return e.map(R,function(e,t){return s[t]&&e!=r.placeholder?e:null}).join("")}),x.attr("readonly")||x.one("unmask",function(){x.unbind(".mask").removeData(e.mask.dataName)}).bind("focus.mask",function(){clearTimeout(n);var e;S=x.val(),e=y(),n=setTimeout(function(){b(),e==t.length?x.caret(0,e):x.caret(e)},10)}).bind("blur.mask",function(){y(),x.val()!=S&&x.change()}).bind("keydown.mask",g).bind("keypress.mask",v).bind(a,function(){setTimeout(function(){var e=y(!0);x.caret(e),r.completed&&e==x.val().length&&r.completed.call(x)},0)}),y()}))}})})(jQuery);

//$('#IBAN').mask('aa99 9999 9999 9999 9999 99');
  $(".tip-bottom-robotc").tooltip({
        animated: 'fade',
    placement: 'bottom',
    html: true
    });

	
	
	
  $(".tip-bottom-robotcc").tooltip({
        animated: 'fade',
    placement: 'bottom',
    html: true
    });	
	
$(".store_id").change(function(){
	var handle = $('option:selected', this).attr('handle');
	if(handle==1){
		$('.another-store-handle').show();
		$('#selectproduct').prop("required", "true");
	}else{
		$('.another-store-handle').hide();
		$('#selectproduct').removeAttr('required');
	}
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
	 $('.form-group.reason-box .error').text(char + ' caractères restants');

	}
   
  });

$('#selectrobotcountry').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo base_url('front/get_country_store');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(response){
                         
						$('#selectpurchase').find('option').not(':first').remove();

												
						$.each(response,function(index,data){
							$('#selectpurchase').append('<option value="'+data['id']+'"  handle="'+data['store_handle']+'">'+data['store_name']+'</option>');
						});

                      
 
                    }
                });
                return false;
			}); 
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
  if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function(e) {
		e.preventDefault();
		if (this.files && this.files[0] && this.files[0].name.match(/\.(jpg|jpeg|png)$/) ) {
			if($( ".pip" ).length==0){
				var files = e.target.files;
				filesLength = files.length;
				for (var i = 0; i < filesLength; i++) {
					var f = files[i];
					var fileReader = new FileReader();
					fileReader.onload = (function(e) {
					  var file = e.target;
					  <?php 
					  if(!empty($_SESSION['site_lang'])){
								if($_SESSION['site_lang']=='english'){
								?>
								 $("<span class=\"pip\">" +
						"<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
						"<br/><span class=\"remove\">Remove image</span>" +
						"</span>").insertAfter("#files");
								
								<?php	
								}
								if($_SESSION['site_lang']=='french'){
									?>
								 $("<span class=\"pip\">" +
						"<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
						"<br/><span class=\"remove\">supprimer l'image</span>" +
						"</span>").insertAfter("#files");
								
								<?php
								}
	
						}else{
							?>
							 $("<span class=\"pip\">" +
						"<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
						"<br/><span class=\"remove\">supprimer l'image</span>" +
						"</span>").insertAfter("#files");	
								
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
			alert('This is not an image file!');
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