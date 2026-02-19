<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_Settings');
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
			$settings=$this->Mdl_Settings->GetRecord();
			$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/settings/list',
						'settings'=>$settings
						);
			$this->load->view('admin/front',$data);
		}
	}
	
	public function update()
	{
		$siteLang = $this->session->userdata('site_lang');
		if(!empty($_SESSION['admin_user'])){
			$ispost=$this->input->method(TRUE);
			if($ispost=='POST'){
				$id=$this->input->post('id');
				$from_email=$this->input->post('from_email');
				$smtp_name=$this->input->post('smtp_name');
				$host=$this->input->post('host');
				$port=$this->input->post('port');
				$username=$this->input->post('username');
				$password=$this->input->post('password');
				$update = array(
					'from_email'=>$from_email,
					'smtp_name'=>$smtp_name,
					'host'=>$host,
					'port'=>$port,
					'username'=>$username,
					'password'=>$password,
					'update_date'=>date('Y-m-d H:i:s')
				);
				$settings=$this->Mdl_Settings->update($update,array('id'=>$id));
				if($siteLang=='english'){
					$this->session->set_flashdata('success','SMTP setting are saved' ); 
				}else{
					$this->session->set_flashdata('success','Les paramètres SMTP sont enregistrés' ); 
				}
				redirect('admin/settings');
			}
		}
	}

}