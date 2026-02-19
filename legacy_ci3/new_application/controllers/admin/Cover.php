<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cover extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_Cover');
        $this->load->helper(array('form','url','language'));
        $this->load->library(array('session', 'form_validation', 'email'));
		$siteLang = $this->session->userdata('site_lang');
		if (empty($siteLang)) {
			$this->session->set_userdata('site_lang','french');
		}
    }
	
	public function Viewcover()
	{
		
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			$covers=$this->Mdl_Cover->GetRecordUsers();//echo $covers;
			$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/cover/list',
						'covers'=>$covers
						);
			$this->load->view('admin/front',$data);
		}
	}
	
	public function Addcover()
	{
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			$data=array('success'=>$this->session->flashdata('success'),
					'error'=>$this->session->flashdata('error'),
					'main_content'=>'admin/cover/create'
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
				$this->form_validation->set_rules('cover_name', "Cover Name", 'trim|required');
				$this->form_validation->set_rules('cover_price', "Cover Price", 'trim|required');
				$this->form_validation->set_rules('validity_date', "Cover Date", 'trim|required');
				
				$cover_name=$this->input->post('cover_name');
				$cover_price=$this->input->post('cover_price');
				$validity_date=$this->input->post('validity_date');
				// print_r($validity_date);
				// exit;
				if($this->form_validation->run() === FALSE){
					$data=array('success'=>$this->session->flashdata('success'),
							'error'=>$this->session->flashdata('error'),
							'main_content'=>'admin/cover/create'
							);
					$this->load->view('admin/front',$data);
				}else{
					if(!empty($_FILES['cover_image']['name']))
					{
						$config['upload_path'] = 'upload/';
						$config['allowed_types'] = 'jpg|jpeg|png';
						$config['file_name'] = $_FILES['cover_image']['name'];
						if (!is_dir($config['upload_path'])) 
						{
							mkdir($config['upload_path']);
						}
						
						$this->load->library('upload',$config);
						$this->upload->initialize($config);

						if($this->upload->do_upload('cover_image'))
						{
							
							$uploadData = $this->upload->data();
							$picture = $uploadData['file_name'];
							$img_url=$_FILES['cover_image']['name'];
						}
						else
						{
							$error = array('error' => $this->upload->display_errors());
							$this->session->set_flashdata('error',$error['error']);
							redirect('admin/cover/Viewcover');
							$picture = '';
						}
					}
					$insert = array(
						'cover_name'=>$cover_name,
						'cover_price'=>$cover_price,
						'cover_image'=>(!empty($picture)) ? $picture : null,
						'validity_date'=>$validity_date,
						'created_date'=>date('Y-m-d H:i:s')
					);
					// print_r($insert);
					// exit;
					if($this->Mdl_Cover->insert($insert)){
						if($siteLang=='english'){
							$this->session->set_flashdata('success','Cover Successfully Created' ); 
						}else{
							$this->session->set_flashdata('success','Cover créé avec succès' ); 
						}
						redirect('admin/cover/Viewcover');
					}else{
						if($siteLang=='english'){
							$this->session->set_flashdata('error','Error while creating cover!' );
						}else{
							$this->session->set_flashdata('error','Erreur lors de la création du cover!' );
						}
						redirect('admin/cover/Viewcover');
					}
				}
			}
		}
	}
	
	public function edit($id=null)
	{
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			if(!empty($id)){
				$covers=$this->Mdl_Cover->GetRecordUsers(array('id'=>$id));
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/cover/edit',
						'covers'=>$covers
						);
				$this->load->view('admin/front',$data);
			}else{
				$covers=$this->Mdl_Cover->GetRecordUsers();
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/cover/list',
						'covers'=>$covers
						);
				$this->load->view('admin/front',$data);
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
					// set validation rules
					$this->form_validation->set_rules('cover_name', "Cover Name", 'trim|required');
					$this->form_validation->set_rules('cover_price', "Cover Price", 'trim|required');
					$this->form_validation->set_rules('validity_date', "Cover Date", 'trim|required');
					
					$cover_name=$this->input->post('cover_name');
					$cover_price=$this->input->post('cover_price');
					$validity_date=$this->input->post('validity_date');
					if($this->form_validation->run() === FALSE){
						$covers=$this->Mdl_Cover->GetRecordUsers(array('id'=>$id));
						$data=array('success'=>$this->session->flashdata('success'),
								'error'=>$this->session->flashdata('error'),
								'main_content'=>'admin/cover/edit',
								'covers'=>$covers
								);
						$this->load->view('admin/front',$data);
					}else{
						if(!empty($_FILES['cover_image']['name']))
						{
							$config['upload_path'] = 'upload/';
							$config['allowed_types'] = 'jpg|jpeg|png';
							$config['file_name'] = $_FILES['cover_image']['name'];
							if (!is_dir($config['upload_path'])) 
							{
								mkdir($config['upload_path']);
							}
							
							$this->load->library('upload',$config);
							$this->upload->initialize($config);

							if($this->upload->do_upload('cover_image'))
							{
								
								$uploadData = $this->upload->data();
								$picture = $uploadData['file_name'];
								$img_url=$_FILES['cover_image']['name'];
								$update = array(
									'cover_name'=>$cover_name,
									'cover_price'=>$cover_price,
									'cover_image'=>$picture,
									'validity_date'=>$validity_date
								);
							}
							else
							{
								$error = array('error' => $this->upload->display_errors());
								$this->session->set_flashdata('error',$error['error']);
								redirect('admin/cover/Viewcover');
								$picture = '';
							}
						}else{
							$update = array(
								'cover_name'=>$cover_name,
								'cover_price'=>$cover_price,
								'validity_date'=>$validity_date
							);
						}
						if($this->Mdl_Cover->update($update,array('id'=>$id))){
							if($siteLang=='english'){
								$this->session->set_flashdata('success','Cover Successfully Updated' ); 
							}else{
								$this->session->set_flashdata('success','Cover mis à jour avec succès' ); 
							}
							redirect('admin/cover/Viewcover');
						}else{
							if($siteLang=='english'){
								$this->session->set_flashdata('error','Error while updating cover!' );
							}else{
								$this->session->set_flashdata('error','Erreur lors de la mise à jour du cover!' );
							}
							redirect('admin/cover/Viewcover');
						}
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
				$removecover=$this->Mdl_Cover->remove($id);
				if(empty($removecover))
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('error','Error while deleting cover!');
					}else{
						$this->session->set_flashdata('error','Erreur lors de la suppression du cover!');
					}
					redirect('admin/cover/Viewcover');
				}
				else
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('success','Cover Remove Successfully');
					}else{
						$this->session->set_flashdata('success','Cover Supprimer avec succès');
					}
					redirect('admin/cover/Viewcover');
				}
			}
			else
			{
				if($siteLang=='english'){
					$this->session->set_flashdata('error','Error while deleting cover!');
				}else{
					$this->session->set_flashdata('error','Erreur lors de la suppression du cover!');
				}
				redirect('admin/cover/Viewcover');
			}
		}
	}
}
