<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use \Mailjet\Resources;

class Page extends CI_Controller {
 
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_User');
        $this->load->model('Mdl_Menu');
        $this->load->model('Mdl_Proof');
        $this->load->model('Mdl_Draw');
        $this->load->model('Mdl_Store');
        $this->load->model('Mdl_Coupon');
        $this->load->model('Mdl_Refund');
        $this->load->model('Mdl_Clientsupport');
        $this->load->model('Mdl_Country');
        $this->load->model('Mdl_Settings');
        $this->load->model('Mdl_Template');
        $this->load->helper(array('form','url','language'));
        $this->load->library(array('session', 'form_validation', 'email'));
		$siteLang = $this->session->userdata('site_lang');
		if (empty($siteLang)) {
			$this->session->set_userdata('site_lang','french');
		}
    }
	
    public function index()
    {
		$sidemenu_without_login=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu_without'));
		$sidemenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu'));
		$footermenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'footer_menu'));

		$base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .  $_SERVER['HTTP_HOST'];
		$url = $base_url . $_SERVER["REQUEST_URI"];
		$parts = explode("/", $url);
		$lastparam = end($parts);
		$main_content = 'page/'.$lastparam;
		$filename = APPPATH.'views/page/'.$lastparam.'.php';
		if(!empty($_SESSION['front_user'])){
			if (file_exists($filename)){
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'sidemenu'=>$sidemenu,
						'footermenu'=>$footermenu,
						'main_content'=>$main_content
						);
				$this->load->view('front/template',$data);
			}else{
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'front/403'
						);
				$this->load->view('front/template',$data);
			}
		}else{
			if (file_exists($filename)){
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'sidemenu'=>$sidemenu_without_login,
						'footermenu'=>$footermenu,
						'main_content'=>$main_content
						);
				$this->load->view('front/template',$data);
			}else{
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'front/403'
						);
				$this->load->view('front/template',$data);
			}
		}
    }

}