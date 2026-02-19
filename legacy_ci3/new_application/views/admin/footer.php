<footer class="main-footer">
	<div class="pull-right hidden-xs">
	  <b><?php echo $this->lang->line('label_version');?></b> 2.4.0
	</div>
	<strong><?php echo $this->lang->line('label_copyright');?> &copy; 2019 <a href="https://adminlte.io">BWT</a>.</strong> <?php echo $this->lang->line('label_all_rights_reserved');?>.
</footer>
<style>
.error{
	color:red;
}
</style>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url();?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url();?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url();?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url();?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url();?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url();?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url();?>assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>
<!-- Magnific popup -->
<script src="<?php echo base_url();?>assets/dist/js/jquery.magnific-popup.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/jquery.magnific-popup.min.js"></script>
<!-- CK Editor -->
<!--script src="<?php echo base_url();?>assets/bower_components/ckeditor/ckeditor.js"></script-->
<script src="//cdn.ckeditor.com/4.11.4/full/ckeditor.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#sortable" ).sortable();
	
	$( ".add-item-to-menu" ).click(function(){
		link = $(".menu_item_url").val();
		label = $(".menu_item_label").val();
		if(link == "" || label == ""){
			alert("please insert label and link to add menu item");
		}else{
			html = '<li class="ui-state-default">' + label + ' => '+ link +'<span>X</span></li>';
			$(".menu_item_url").val('');
			$(".menu_item_label").val('');
			$( "#sortable" ).append(html);
			$( "#sortable" ).sortable();
		}
	});

	$( ".save_menu" ).click(function(){
		var menu_item = [];
		$("#sortable li").each(function(){
			menu_item.push($(this).html());
		})
		$("#menuitems").val(menu_item);
		$(".triggersave").trigger("click");
	});

	$(document).on("click", "#sortable li span", function(){
		$(this).parent().remove();
	})
  } );
  </script>
<script>
$(function () {
	CKEDITOR.replace('editor1');
	//$('#editor1').wysihtml5();
});
//Date picker
$('#date').datepicker({
	format:'yyyy-mm-dd',
	startDate: new Date(),
	autoclose: true,
	todayHighlight: true
})
$(function () {
	$('#viewuser').DataTable();
})
$(document).on('click','.importuser',function(){
	if(! $(".importuser").hasClass("bar")){
		$(".showuserfile").show();
		$(".importuser").addClass('bar');
	}else{
		$(".showuserfile").hide();
		$(".importuser").removeClass('bar');
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
</body>
</html>