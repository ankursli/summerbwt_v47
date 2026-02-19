<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Robot extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_Robot');
        $this->load->helper(array('form','url','language'));
        $this->load->library(array('session', 'form_validation', 'email'));
		$siteLang = $this->session->userdata('site_lang');
		if (empty($siteLang)) {
			$this->session->set_userdata('site_lang','french');
		}
    }
	
	public function Viewrobot()
	{
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			$robots=$this->Mdl_Robot->GetRecordUsers();
			$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/robot/list',
						'robots'=>$robots
						);
			$this->load->view('admin/front',$data);
		}
	}
	
	public function Addrobot()
	{
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			$data=array('success'=>$this->session->flashdata('success'),
					'error'=>$this->session->flashdata('error'),
					'main_content'=>'admin/robot/create'
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
				$this->form_validation->set_rules('robot_name', "robot Name", 'trim|required');
                $this->form_validation->set_rules('robot_code', "robot Code", 'trim|required');
				$this->form_validation->set_rules('robot_price', "robot Price", 'trim|required');
				$this->form_validation->set_rules('validity_date', "robot Date", 'trim|required');
				
				$robot_name=$this->input->post('robot_name');
                $robot_code=$this->input->post('robot_code');
				$robot_price=$this->input->post('robot_price');
				$validity_date=$this->input->post('validity_date');
				if($this->form_validation->run() === FALSE){
					$data=array('success'=>$this->session->flashdata('success'),
							'error'=>$this->session->flashdata('error'),
							'main_content'=>'admin/robot/create'
							);
					$this->load->view('admin/front',$data);
				}else{
					if(!empty($_FILES['robot_image']['name']))
					{
						$config['upload_path'] = 'upload/';
						$config['allowed_types'] = 'jpg|jpeg|png';
						$config['file_name'] = $_FILES['robot_image']['name'];
						if (!is_dir($config['upload_path'])) 
						{
							mkdir($config['upload_path']);
						}
						
						$this->load->library('upload',$config);
						$this->upload->initialize($config);

						if($this->upload->do_upload('robot_image'))
						{
							
							$uploadData = $this->upload->data();
							$picture = $uploadData['file_name'];
							$img_url=$_FILES['robot_image']['name'];
						}
						else
						{
							$error = array('error' => $this->upload->display_errors());
							$this->session->set_flashdata('error',$error['error']);
							redirect('admin/robot/Viewrobot');
							$picture = '';
						}
					}
					$insert = array(
						'robot_name'=>$robot_name,
                        'robot_code'=>$robot_code,
						'robot_price'=>$robot_price,
						'robot_image'=>(!empty($picture)) ? $picture : null,
						'validity_date'=>$validity_date,
						'created_date'=>date('Y-m-d H:i:s')
					);
					if($this->Mdl_Robot->insert($insert)){
						if($siteLang=='english'){
							$this->session->set_flashdata('success','robot Successfully Created' ); 
						}else{
							$this->session->set_flashdata('success','robot créé avec succès' ); 
						}
						redirect('admin/robot/Viewrobot');
					}else{
						if($siteLang=='english'){
							$this->session->set_flashdata('error','Error while creating robot!' );
						}else{
							$this->session->set_flashdata('error','Erreur lors de la création du robot!' );
						}
						redirect('admin/robot/Viewrobot');
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
				$robots=$this->Mdl_Robot->GetRecordUsers(array('id'=>$id));
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/robot/edit',
						'robots'=>$robots
						);
				$this->load->view('admin/front',$data);
			}else{
				$robots=$this->Mdl_Robot->GetRecordUsers();
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/robot/list',
						'robots'=>$robots
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
					$this->form_validation->set_rules('robot_name', "robot Name", 'trim|required');
					$this->form_validation->set_rules('robot_price', "robot Price", 'trim|required');
					$this->form_validation->set_rules('validity_date', "robot Date", 'trim|required');
					
					$robot_name=$this->input->post('robot_name');
					$robot_price=$this->input->post('robot_price');
					$validity_date=$this->input->post('validity_date');
					if($this->form_validation->run() === FALSE){
						$robots=$this->Mdl_Robot->GetRecordUsers(array('id'=>$id));
						$data=array('success'=>$this->session->flashdata('success'),
								'error'=>$this->session->flashdata('error'),
								'main_content'=>'admin/robot/edit',
								'robots'=>$robots
								);
						$this->load->view('admin/front',$data);
					}else{
						if(!empty($_FILES['robot_image']['name']))
						{
							$config['upload_path'] = 'upload/';
							$config['allowed_types'] = 'jpg|jpeg|png';
							$config['file_name'] = $_FILES['robot_image']['name'];
							if (!is_dir($config['upload_path'])) 
							{
								mkdir($config['upload_path']);
							}
							
							$this->load->library('upload',$config);
							$this->upload->initialize($config);

							if($this->upload->do_upload('robot_image'))
							{
								
								$uploadData = $this->upload->data();
								$picture = $uploadData['file_name'];
								$img_url=$_FILES['robot_image']['name'];
								$update = array(
									'robot_name'=>$robot_name,
									'robot_price'=>$robot_price,
									'robot_image'=>$picture,
									'validity_date'=>$validity_date
								);
							}
							else
							{
								$error = array('error' => $this->upload->display_errors());
								$this->session->set_flashdata('error',$error['error']);
								redirect('admin/robot/Viewrobot');
								$picture = '';
							}
						}else{
							$update = array(
								'robot_name'=>$robot_name,
								'robot_price'=>$robot_price,
								'validity_date'=>$validity_date
							);
						}
						if($this->Mdl_Robot->update($update,array('id'=>$id))){
							if($siteLang=='english'){
								$this->session->set_flashdata('success','robot Successfully Updated' ); 
							}else{
								$this->session->set_flashdata('success','robot mis à jour avec succès' ); 
							}
							redirect('admin/robot/Viewrobot');
						}else{
							if($siteLang=='english'){
								$this->session->set_flashdata('error','Error while updating robot!' );
							}else{
								$this->session->set_flashdata('error','Erreur lors de la mise à jour du robot!' );
							}
							redirect('admin/robot/Viewrobot');
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
				$removerobot=$this->Mdl_Robot->remove($id);
				if(empty($removerobot))
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('error','Error while deleting robot!');
					}else{
						$this->session->set_flashdata('error','Erreur lors de la suppression du robot!');
					}
					redirect('admin/robot/Viewrobot');
				}
				else
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('success','robot Remove Successfully');
					}else{
						$this->session->set_flashdata('success','robot Supprimer avec succès');
					}
					redirect('admin/robot/Viewrobot');
				}
			}
			else
			{
				if($siteLang=='english'){
					$this->session->set_flashdata('error','Error while deleting robot!');
				}else{
					$this->session->set_flashdata('error','Erreur lors de la suppression du robot!');
				}
				redirect('admin/robot/Viewrobot');
			}
		}
	}
}
