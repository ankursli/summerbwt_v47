<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_support extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_Clientsupport');
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
		$clients=$this->Mdl_Clientsupport->GetSupport();
		$data=array('success'=>$this->session->flashdata('success'),
					'error'=>$this->session->flashdata('error'),
					'main_content'=>'admin/client_support/list',
					'clients'=>$clients
					);
		$this->load->view('admin/front',$data);
		}
	}
	
	public function remove($id=null)
	{
		$siteLang = $this->session->userdata('site_lang');
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			$ispost=$this->input->method(TRUE);
			if($ispost == 'GET')
			{
				$Delete=$this->Mdl_Clientsupport->remove($id);
				if(empty($Delete))
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('error','Error while deleting Client Support!');
					}else{
						$this->session->set_flashdata('error','Erreur lors de la suppression du support client!');
					}
					redirect('admin/client_support');
				}
				else
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('success','Client Support Remove Successfully');
					}else{
						$this->session->set_flashdata('success','Support client Supprimer avec succès');
					}
					redirect('admin/client_support');
				}
			}
			else
			{
				if($siteLang=='english'){
					$this->session->set_flashdata('error','Error while deleting Client Support!');
				}else{
					$this->session->set_flashdata('error','Erreur lors de la suppression du support client!');
				}
				redirect('admin/client_support');
			}
		}
	}
}
