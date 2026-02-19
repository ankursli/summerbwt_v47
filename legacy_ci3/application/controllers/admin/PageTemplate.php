<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageTemplate extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_Template');
        $this->load->helper(array('form','url','language'));
        $this->load->library(array('session', 'form_validation', 'email'));
		$this->load->helper('directory');
		$siteLang = $this->session->userdata('site_lang');
		if (empty($siteLang)) {
			$this->session->set_userdata('site_lang','french');
		}
    }
	
	public function viewpage()
	{
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			$pagedirectory = APPPATH.'views/page';
			$files = array();
			$pages = array();
			$map = directory_map($pagedirectory);
			if(!empty($map)){
				foreach($map as $filename){
					$files['filename'] = $filename;
					$name = explode('.php',$filename);
					$files['view'] = $name[0];
					$path = 'page/'.$name[0];
					$html = $this->load->view($path,[],true);
					$files['html'] = $html;
					$pages[] = $files;
				}
				$data=array('success'=>$this->session->flashdata('success'),
							'error'=>$this->session->flashdata('error'),
							'main_content'=>'admin/pagetemplate/list',
							'pages'=>$pages
							);
				$this->load->view('admin/front',$data);
			}else{
				redirect('admin/PageTemplate/Addpage');
			}
		}
	}
	
	public function Addpage()
	{
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			$data=array('success'=>$this->session->flashdata('success'),
					'error'=>$this->session->flashdata('error'),
					'main_content'=>'admin/pagetemplate/create'
					);
			$this->load->view('admin/front',$data);
		}
	}
	
	public function create()
	{
		$siteLang = $this->session->userdata('site_lang');
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			$ispost=$this->input->method(TRUE);
			if($ispost=='POST'){
				$this->load->helper('form');
				$this->load->library('form_validation');
				// set validation rules
				$this->form_validation->set_rules('template', "Template", 'trim|required');		
				$this->form_validation->set_rules('view', "Filename", 'trim|required');		
				$template = $this->input->post('template');
				$view = $this->input->post('view');
				$filename = $view.'.php';
				if($this->form_validation->run() === FALSE){
					$data=array('success'=>$this->session->flashdata('success'),
							'error'=>$this->session->flashdata('error'),
							'main_content'=>'admin/pagetemplate/create'
							);
					$this->load->view('admin/front',$data);
				}else{
					$newFileName = APPPATH.'views/page/'.$filename;
					if (file_put_contents($newFileName, $template) !== false) {
						if($siteLang=='english'){
							$this->session->set_flashdata('success','Page Template Successfully Created' ); 
						}else{
							$this->session->set_flashdata('success','Page de courrier créé avec succès' ); 
						}
					}else{
						if($siteLang=='english'){
							$this->session->set_flashdata('error','Error while creating page template!' );
						}else{
							$this->session->set_flashdata('error','Erreur lors de la création du page!' );
						}
					}
					sleep(2);
					redirect('admin/PageTemplate/viewpage');
				}
			}
		}
	}
	
	public function edit($id=null)
	{
		$siteLang = $this->session->userdata('site_lang');
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			if(!empty($id)){
				$path = 'page/'.$id;
				$html = $this->load->view($path,[],true);
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/pagetemplate/edit',
						'html'=>$html,
						'view'=>$id,
						'filename'=>$id.'.php'
						);
				$this->load->view('admin/front',$data);
			}else{
				redirect('admin');
			}
		}
	}
	
	public function update($id=null)
	{
		$siteLang = $this->session->userdata('site_lang');
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			if(!empty($id)){
				$ispost=$this->input->method(TRUE);
				if($ispost=='POST'){
					$this->load->helper('form');
					$this->load->library('form_validation');
					$this->form_validation->set_rules('template', "Page Section", 'trim|required');		
					$template = $this->input->post('template');
					$filename = $this->input->post('filename');
					$path = 'page/'.$id;
					if($this->form_validation->run() === FALSE){
						$html = $this->load->view($path,[],true);
						$templates=$this->Mdl_Template->GetRecordUsers(array('id'=>$id));
						$data=array('success'=>$this->session->flashdata('success'),
								'error'=>$this->session->flashdata('error'),
								'main_content'=>'admin/pagetemplate/edit',
								'templates'=>$templates
								);
						$this->load->view('admin/front',$data);
					}else{
						$html = $this->load->view($path,[],true);
						$newhtml = str_replace($html,$template, $html);
						$updatefile = file_put_contents($filename,$newhtml);
						$pagedirectory = APPPATH.'views/page/'.$filename;
						$fp = fopen ($pagedirectory, "w") or die("Failed to create file");
						fwrite ($fp,$newhtml);
						fclose($fp);
						chmod($filename,0777);
						sleep(2);
						if($siteLang=='english'){
							$this->session->set_flashdata('success','Page Template Successfully Updated' ); 
						}else{
							$this->session->set_flashdata('success','Page de courrier mis à jour avec succès' ); 
						}
						redirect('admin/PageTemplate/viewpage');
					}
				}
			}
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
				$filename = $id.'.php';
				$pagedirectory = APPPATH.'views/page/'.$filename;
				if (!unlink($pagedirectory))
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('error','Error while deleting Page Template!');
					}else{
						$this->session->set_flashdata('error','Erreur lors de la suppression du page de courrier!');
					}
				}
				else
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('success','Page Template Remove Successfully');
					}else{
						$this->session->set_flashdata('success','page de courrier supprimer avec succès');
					}
				}
			}
			else
			{
				if($siteLang=='english'){
					$this->session->set_flashdata('error','Error while deleting Page Template!');
				}else{
					$this->session->set_flashdata('error','Erreur lors de la suppression du page de courrier!');
				}
			}
			redirect('admin/PageTemplate/viewpage');
		}
	}
}
