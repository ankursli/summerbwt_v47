<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_Coupon');
        $this->load->helper(array('form','url','language'));
        $this->load->library(array('session', 'form_validation', 'email'));
		$siteLang = $this->session->userdata('site_lang');
		if (empty($siteLang)) {
			$this->session->set_userdata('site_lang','french');
		}
    }
	
	public function Viewcoupon()
	{
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			$coupons=$this->Mdl_Coupon->GetRecordUsers();
			$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/coupon/list',
						'coupons'=>$coupons
						);
			$this->load->view('admin/front',$data);
		}
	}
	
	public function Addcoupon()
	{
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			$data=array('success'=>$this->session->flashdata('success'),
					'error'=>$this->session->flashdata('error'),
					'main_content'=>'admin/coupon/create'
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
				$this->form_validation->set_rules('coupon_name', "Coupon Name", 'trim|required');
				$this->form_validation->set_rules('coupon_price', "Coupon Price", 'trim|required');
				$this->form_validation->set_rules('validity_date', "Coupon Date", 'trim|required');
				
				$coupon_name=$this->input->post('coupon_name');
				$coupon_price=$this->input->post('coupon_price');
				$validity_date=$this->input->post('validity_date');
				if($this->form_validation->run() === FALSE){
					$data=array('success'=>$this->session->flashdata('success'),
							'error'=>$this->session->flashdata('error'),
							'main_content'=>'admin/coupon/create'
							);
					$this->load->view('admin/front',$data);
				}else{
					if(!empty($_FILES['coupon_image']['name']))
					{
						$config['upload_path'] = 'upload/';
						$config['allowed_types'] = 'jpg|jpeg|png';
						$config['file_name'] = $_FILES['coupon_image']['name'];
						if (!is_dir($config['upload_path'])) 
						{
							mkdir($config['upload_path']);
						}
						
						$this->load->library('upload',$config);
						$this->upload->initialize($config);

						if($this->upload->do_upload('coupon_image'))
						{
							
							$uploadData = $this->upload->data();
							$picture = $uploadData['file_name'];
							$img_url=$_FILES['coupon_image']['name'];
						}
						else
						{
							$error = array('error' => $this->upload->display_errors());
							$this->session->set_flashdata('error',$error['error']);
							redirect('admin/coupon/Viewcoupon');
							$picture = '';
						}
					}
					$insert = array(
						'coupon_name'=>$coupon_name,
						'coupon_price'=>$coupon_price,
						'coupon_image'=>(!empty($picture)) ? $picture : null,
						'validity_date'=>$validity_date,
						'created_date'=>date('Y-m-d H:i:s')
					);
					if($this->Mdl_Coupon->insert($insert)){
						if($siteLang=='english'){
							$this->session->set_flashdata('success','Coupon Successfully Created' ); 
						}else{
							$this->session->set_flashdata('success','Coupon créé avec succès' ); 
						}
						redirect('admin/coupon/Viewcoupon');
					}else{
						if($siteLang=='english'){
							$this->session->set_flashdata('error','Error while creating coupon!' );
						}else{
							$this->session->set_flashdata('error','Erreur lors de la création du coupon!' );
						}
						redirect('admin/coupon/Viewcoupon');
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
				$coupons=$this->Mdl_Coupon->GetRecordUsers(array('id'=>$id));
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/coupon/edit',
						'coupons'=>$coupons
						);
				$this->load->view('admin/front',$data);
			}else{
				$coupons=$this->Mdl_Coupon->GetRecordUsers();
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/coupon/list',
						'coupons'=>$coupons
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
					$this->form_validation->set_rules('coupon_name', "Coupon Name", 'trim|required');
					$this->form_validation->set_rules('coupon_price', "Coupon Price", 'trim|required');
					$this->form_validation->set_rules('validity_date', "Coupon Date", 'trim|required');
					
					$coupon_name=$this->input->post('coupon_name');
					$coupon_price=$this->input->post('coupon_price');
					$validity_date=$this->input->post('validity_date');
					if($this->form_validation->run() === FALSE){
						$coupons=$this->Mdl_Coupon->GetRecordUsers(array('id'=>$id));
						$data=array('success'=>$this->session->flashdata('success'),
								'error'=>$this->session->flashdata('error'),
								'main_content'=>'admin/coupon/edit',
								'coupons'=>$coupons
								);
						$this->load->view('admin/front',$data);
					}else{
						if(!empty($_FILES['coupon_image']['name']))
						{
							$config['upload_path'] = 'upload/';
							$config['allowed_types'] = 'jpg|jpeg|png';
							$config['file_name'] = $_FILES['coupon_image']['name'];
							if (!is_dir($config['upload_path'])) 
							{
								mkdir($config['upload_path']);
							}
							
							$this->load->library('upload',$config);
							$this->upload->initialize($config);

							if($this->upload->do_upload('coupon_image'))
							{
								
								$uploadData = $this->upload->data();
								$picture = $uploadData['file_name'];
								$img_url=$_FILES['coupon_image']['name'];
								$update = array(
									'coupon_name'=>$coupon_name,
									'coupon_price'=>$coupon_price,
									'coupon_image'=>$picture,
									'validity_date'=>$validity_date
								);
							}
							else
							{
								$error = array('error' => $this->upload->display_errors());
								$this->session->set_flashdata('error',$error['error']);
								redirect('admin/coupon/Viewcoupon');
								$picture = '';
							}
						}else{
							$update = array(
								'coupon_name'=>$coupon_name,
								'coupon_price'=>$coupon_price,
								'validity_date'=>$validity_date
							);
						}
						if($this->Mdl_Coupon->update($update,array('id'=>$id))){
							if($siteLang=='english'){
								$this->session->set_flashdata('success','Coupon Successfully Updated' ); 
							}else{
								$this->session->set_flashdata('success','Coupon mis à jour avec succès' ); 
							}
							redirect('admin/coupon/Viewcoupon');
						}else{
							if($siteLang=='english'){
								$this->session->set_flashdata('error','Error while updating coupon!' );
							}else{
								$this->session->set_flashdata('error','Erreur lors de la mise à jour du coupon!' );
							}
							redirect('admin/coupon/Viewcoupon');
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
				$removecoupon=$this->Mdl_Coupon->remove($id);
				if(empty($removecoupon))
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('error','Error while deleting coupon!');
					}else{
						$this->session->set_flashdata('error','Erreur lors de la suppression du coupon!');
					}
					redirect('admin/coupon/Viewcoupon');
				}
				else
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('success','Coupon Remove Successfully');
					}else{
						$this->session->set_flashdata('success','Coupon Supprimer avec succès');
					}
					redirect('admin/coupon/Viewcoupon');
				}
			}
			else
			{
				if($siteLang=='english'){
					$this->session->set_flashdata('error','Error while deleting coupon!');
				}else{
					$this->session->set_flashdata('error','Erreur lors de la suppression du coupon!');
				}
				redirect('admin/coupon/Viewcoupon');
			}
		}
	}
}
