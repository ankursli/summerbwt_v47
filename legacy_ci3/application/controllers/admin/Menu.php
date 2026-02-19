<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('Mdl_Menu');
		$this->load->model('Mdl_Block');
        $this->load->model('Mdl_User');
        $this->load->model('Mdl_Country');
        $this->load->helper(array('form','url','language'));
        $this->load->library(array('session', 'form_validation', 'email'));
		$siteLang = $this->session->userdata('site_lang');
		if (empty($siteLang)) {
			$this->session->set_userdata('site_lang','french');
		}
		
		/*$ip=$_SERVER['REMOTE_ADDR'];
		$details = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=$ip"));
		$country=$details->geoplugin_countryCode;
		$countries=$this->Mdl_Country->GetFrontRecord(array('is_allow'=>1));
		$array = array();
		foreach($countries as $co){
			$array[] = $co['country_code'];
		}
		if (in_array($country, $array)){
			//echo 'allowed';
		}else{
			$this->load->view('front/403');die;
		}
		/*if($country==="FR" || $country==="IN"){
			//echo 'allowed';
		}else{
			$this->load->view('front/403');die;
		}*/
    }
	
	public function savemenu(){
		$menuitems = explode(",", $_POST['menuitems']);
	
		$store_items = array();
		
		foreach($menuitems as $menuitem){
			$menuitem = str_replace("<span>X</span>", "", $menuitem);
			$menuitem = explode(" ", $menuitem);
			print_r($menuitem);
			$sliced = array_slice($menuitem, 0, -2); 
			$mystring = implode(" ", $sliced);  
			$store_items[] = array(
				"label" => $mystring,
				"link" => str_replace("=>", "", end($menuitem)),
			);
			//print_r($store_items);
		}

		/*
		foreach($menuitems as $menuitem){
			$menuitem = str_replace("<span>X</span>", "", $menuitem);
			$menuitem = explode(" ", $menuitem);
			print_r($menuitem);
			$store_items[] = array(
				"label" => $menuitem[0],
				"link" => str_replace("=>", "", $menuitem[2]),
			);
			print_r($store_items);
		}*/

		$menu = array(
			'menu_id' => $_POST['menuid'],
			'menu_items' => json_encode($store_items)
		);
		// $menuplace = $this->Mdl_Menu->GetRecordmenus(array('id'=>$id));
		if($this->Mdl_Menu->GetRecordMenus(array('menu_id'=>$menu['menu_id']))){
			if($this->Mdl_Menu->update($menu,array("menu_id"=>$menu['menu_id']))){
				if($siteLang=='english'){
					$this->session->set_flashdata('success','menu added' ); 
				}else{
					$this->session->set_flashdata('success',"menu added" ); 
				}
				redirect('admin/menu/Viewmenu');
			}else{
				if($siteLang=='english'){
					$this->session->set_flashdata('error','Error while adding menu!' );
				}else{
					$this->session->set_flashdata('error','Error while adding menu!' );
				}
				redirect('admin/menu/Viewmenu');
			}
		}else{
			if($this->Mdl_Menu->insert($menu)){
				if($siteLang=='english'){
					$this->session->set_flashdata('success','Menu added Successfully' ); 
				}else{
					$this->session->set_flashdata('success',"Menu added Successfully" ); 
				}
				redirect('admin/menu/Viewmenu');
			}else{
				if($siteLang=='english'){
					$this->session->set_flashdata('error','Error while adding menu!' );
				}else{
					$this->session->set_flashdata('error','Error while adding menu!' );
				}
				redirect('admin/menu/Viewmenu');
			}
	    }
		exit;
	}
	
	
	public function Viewmenu()
	{
		// $siteLang = $this->session->userdata('site_lang');
		$menuplace = (isset($_POST['menuplace'])) ?  $_POST['menuplace'] : "sidebar_menu";
		if(!empty($_SESSION['admin_user'])){
			$menu=$this->Mdl_Menu->GetRecordMenus(array('menu_id'=>$menuplace));
			$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/menu/viewmenu',
						'menu'=>$menu
						);
			$this->load->view('admin/menu',$data);
		}else{
			redirect('admin');
		}
	}
	
	
	public function removemenu($id=null)
	{
		$siteLang = $this->session->userdata('site_lang');
		

		if(!empty($_SESSION['admin_user'])){
			$ispost=$this->input->method(TRUE);
			if($ispost == 'GET')
			{
				$Deleteblock=$this->Mdl_Menu->remove($id);
				if(empty($Deleteblock))
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('error','Error while deleting menu!');
					}else{
						$this->session->set_flashdata('error','Error while deleting menu!');
					}
					redirect('admin/menu/Viewmenu');
				}
				else
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('success','menu Remove Successfully');
					}else{
						$this->session->set_flashdata('success','menu Remove Successfully');
					}
					redirect('admin/menu/Viewmenu');
				}
			}
			else
			{
				if($siteLang=='english'){
					$this->session->set_flashdata('error','Error while deleting menu!');
				}else{
					$this->session->set_flashdata('error','Error while deleting menu!');
				}
				redirect('admin/menu/Viewmenu');
			}
		}else{
			redirect('admin');
		}
	}
	
	
}
