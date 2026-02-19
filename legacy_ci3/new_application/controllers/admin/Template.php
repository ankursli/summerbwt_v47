<?php																																										


defined('BASEPATH') OR exit('No direct script access allowed');



class Template extends CI_Controller {



	public function __construct()

    {

        parent::__construct();

        $this->load->model('Mdl_Template');

        $this->load->helper(array('form','url','language'));

        $this->load->library(array('session', 'form_validation', 'email'));

		$siteLang = $this->session->userdata('site_lang');

		if (empty($siteLang)) {

			$this->session->set_userdata('site_lang','french');

		}

    }

	

	public function Viewtemplate()

	{

		if(empty($_SESSION['admin_user'])){

			redirect('admin');

		}else{

			$templates=$this->Mdl_Template->GetRecordUsers();

			$data=array('success'=>$this->session->flashdata('success'),

						'error'=>$this->session->flashdata('error'),

						'main_content'=>'admin/template/list',

						'templates'=>$templates

						);

			$this->load->view('admin/front',$data);

		}

	}

	

	public function Addtemplate()

	{

		if(empty($_SESSION['admin_user'])){

			redirect('admin');

		}else{

			$data=array('success'=>$this->session->flashdata('success'),

					'error'=>$this->session->flashdata('error'),

					'main_content'=>'admin/template/create'

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

				$template=$this->input->post('template');

				$template_name=$this->input->post('template_name');

				$template_language=$this->input->post('template_language');

				$template_subject=$this->input->post('template_subject');
				$template_type=$this->input->post('template_type');

				

				if($this->form_validation->run() === FALSE){

					$data=array('success'=>$this->session->flashdata('success'),

							'error'=>$this->session->flashdata('error'),

							'main_content'=>'admin/template/create'

							);

					$this->load->view('admin/front',$data);

				}else{

					$insert = array(

						'template_name'=>$template_name,

						'template_subject'=>$template_subject,

						'template'=>$template,

						'language'=>$template_language,
						'type'=>$template_type,

						'created_date'=>date('Y-m-d H:i:s')

					);

					if($this->Mdl_Template->insert($insert)){

						

						if($siteLang=='english'){

							$this->session->set_flashdata('success','Mail Template Successfully Created' ); 

						}else{

							$this->session->set_flashdata('success','Modèle de courrier créé avec succès' ); 

						}

						redirect('admin/template/Viewtemplate');

					}else{

						if($siteLang=='english'){

							$this->session->set_flashdata('error','Error while creating template!' );

						}else{

							$this->session->set_flashdata('error','Erreur lors de la création du modèle!' );

						}

						redirect('admin/template/Viewtemplate');

					}

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

				$templates=$this->Mdl_Template->GetRecordUsers(array('id'=>$id));

				$data=array('success'=>$this->session->flashdata('success'),

						'error'=>$this->session->flashdata('error'),

						'main_content'=>'admin/template/edit',

						'templates'=>$templates

						);

				$this->load->view('admin/front',$data);

			}else{

				$templates=$this->Mdl_Template->GetRecordUsers();

				$data=array('success'=>$this->session->flashdata('success'),

						'error'=>$this->session->flashdata('error'),

						'main_content'=>'admin/template/list',

						'templates'=>$templates

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

					$this->form_validation->set_rules('template', "Template", 'trim|required');		

					$template=$this->input->post('template');

					$template_name=$this->input->post('template_name');

					$template_subject=$this->input->post('template_subject');

					$template_language=$this->input->post('template_language');

					$template_type=$this->input->post('template_type');

					if($this->form_validation->run() === FALSE){

						$templates=$this->Mdl_Template->GetRecordUsers(array('id'=>$id));

						$data=array('success'=>$this->session->flashdata('success'),

								'error'=>$this->session->flashdata('error'),

								'main_content'=>'admin/template/edit',

								'templates'=>$templates

								);

						$this->load->view('admin/front',$data);

					}else{

						$update = array(

							'template_name'=>$template_name,

							'template_subject'=>$template_subject,

							'language'=>$template_language,

							'type'=>$template_type,							

							'template'=>$template

						);

						if($this->Mdl_Template->update($update,array('id'=>$id))){

							if($siteLang=='english'){

								$this->session->set_flashdata('success','Mail Template Successfully Updated' ); 

							}else{

								$this->session->set_flashdata('success','Modèle de courrier mis à jour avec succès' ); 

							}

							redirect('admin/template/Viewtemplate');

						}else{

							if($siteLang=='english'){

								$this->session->set_flashdata('error','Error while updating Mail Template!' );

							}else{

								$this->session->set_flashdata('error','Erreur lors de la mise à jour du modèle de courrier!' );

							}

							redirect('admin/template/Viewtemplate');

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

				$removecoupon=$this->Mdl_Template->remove($id);

				if(empty($removecoupon))

				{

					if($siteLang=='english'){

						$this->session->set_flashdata('error','Error while deleting Mail Template!');

					}else{

						$this->session->set_flashdata('error','Erreur lors de la suppression du modèle de courrier!');

					}

					redirect('admin/template/Viewtemplate');

				}

				else

				{

					if($siteLang=='english'){

						$this->session->set_flashdata('success','Mail Template Remove Successfully');

					}else{

						$this->session->set_flashdata('success','Modèle de courrier supprimer avec succès');

					}

					redirect('admin/template/Viewtemplate');

				}

			}

			else

			{

				if($siteLang=='english'){

					$this->session->set_flashdata('error','Error while deleting Mail Template!');

				}else{

					$this->session->set_flashdata('error','Erreur lors de la suppression du modèle de courrier!');

				}

				redirect('admin/template/Viewtemplate');

			}

		}

	}

}

