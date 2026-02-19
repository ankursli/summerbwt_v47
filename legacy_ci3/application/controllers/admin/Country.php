<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_Country');
        $this->load->helper(array('form','url','language'));
        $this->load->library(array('session', 'form_validation', 'email'));
		$siteLang = $this->session->userdata('site_lang');
		if (empty($siteLang)) {
			$this->session->set_userdata('site_lang','french');
		}
    }
	
	public function index()
	{
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			$countries=$this->Mdl_Country->GetRecord();
			$countries1=$this->Mdl_Country->GetRecord(array('is_allow'=>1));
			$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/country/list',
						'countries'=>$countries,
						'countries1'=>$countries1
						);
			$this->load->view('admin/front',$data);
		}
	}
	
	public function update()
	{ 
		$siteLang = $this->session->userdata('site_lang');
		if(empty($_SESSION['front_user'])){
			$ispost=$this->input->method(TRUE);
			if($ispost=='POST'){
				$country_code=$this->input->post('country_code');
				//echo '<pre>';print_r($_POST);
				$update = array('is_allow'=>0);
				$countries=$this->Mdl_Country->update($update,array('is_allow'=>1));
				$i=1;
				foreach($country_code as $id){
					$update1 = array('is_allow'=>1);
					 $countries1=$this->Mdl_Country->update($update1,array('id'=>$id));
					 $i++;
				}
				//die;
				if($siteLang=='english'){
					$this->session->set_flashdata('success','Country Restriction is allow' ); 
				}else{
					$this->session->set_flashdata('success','La restriction de pays est permise' ); 
				}
				redirect('admin/country');
			}
		}
	}

}