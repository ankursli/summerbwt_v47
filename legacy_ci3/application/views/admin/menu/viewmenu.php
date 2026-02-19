<div class="content-wrapper">
		<section class="content">
			<div class="manage-menus" style="margin-top: 23px; padding: 10px; overflow: hidden; background: #fff">
				<div class="row">
				    <form method="post" action="<?php echo base_url('admin/menu/Viewmenu');?>">
						<div class="from-group col-md-4">
							<?php $menuplace = (isset($_POST['menuplace'])) ?  $_POST['menuplace'] : "sidebar_menu";?>
							<label style="display: inline-block; margin-right: 3px; vertical-align: middle;">Select Menu</label>
							<select class="form-control" name="menuplace" style="display: inline-block;">
								<option <?php echo ($menuplace == 'sidebar_menu') ?  "selected" : ""; ?> value="sidebar_menu">sidebar_menu with login</option>
								<option <?php echo ($menuplace == 'sidebar_menu_without') ?  "selected" : ""; ?> value="sidebar_menu_without">sidebar_menu without login</option>
								<option <?php echo ($menuplace == 'footer_menu') ?  "selected" : ""; ?> value="footer_menu">footer menu</option>
							</select>
						</div>
						<div class="col-md-8">	
							<button type="submit" class="btn btn-primary" style="margin-top: 20px;">Select</button>
						</div>	
					</form>	
				</div>
			</div>
			<div class="nav-menus-frame" style="margin-top: 50px;">
				<div class="row">
					<div class="col-md-4 metabox-holder" style=" display: block; background:#fff; padding: 10px; margin: 20px;">
					    <h3>Add Menu Item</h3>
						<div class="form-group">
							<label for="exampleInputTitle">Url</label>
							<input type="text" class="form-control menu_item_url" name="url" placeholder="https://" value="">
						</div>
						<div class="form-group">
							<label for="exampleInputDate">link text</label>
							<input type="text" name="link" class="form-control menu_item_label" placeholder="" value="">
						</div>
						<button type="submit" class="btn btn-primary add-item-to-menu">Add menu</button>
					</div>
					<div class="col-md-7" style="padding: 0 10px; border-top: 1px solid #fff; border-bottom: 1px solid #dcdcde; background: #fff; margin: 20px;">
					    <h3>Menu structure</h3>
						<div class="menu-management-liquid" style="float: left; min-width: 100%;margin-top: 3px;padding:10px">
							<ul id="sortable" style="list-style:none; padding:0px;">
							<?php
							$json_decode = json_decode($menu['menu_items'], true);
							 foreach($json_decode as $menu){
								echo "<li class='ui-state-default'>".$menu['label']." => ".$menu['link']."<span>X</span></li>";
							 }?>	
							</ul> 
							<button type="button" class="btn btn-primary save_menu">Save</button>
						</div>
					</div>
				</div>
			</div>
			<div style="display: none;">	
				<form method="post" action="<?php echo base_url('admin/menu/savemenu');?>">
					<input type="text" name="menuid" id="menu_id" value="<?php echo $menuplace;?>">
					<input type="text" name="menuitems" id="menuitems">
					<button class="triggersave">Save</button>
				</form>
			</div>
		</section>
</div>		
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>
	li.ui-state-default {
    padding: 10px;
	margin: 10px 0;
    display: flex;
    justify-content: space-between;
    font-size: 16px;
}
</style>