<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StoreCover extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_StoreCover');
        	$this->load->model('Mdl_Country');
        $this->load->helper(array('form','url','language'));
        $this->load->library(array('session', 'form_validation', 'email'));
		$siteLang = $this->session->userdata('site_lang');
		if (empty($siteLang)) {
			$this->session->set_userdata('site_lang','french');
		}
    }
	
	public function Viewstorecover()
	{
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			$stores=$this->Mdl_StoreCover->GetRecordUsers();
			 $countries=$this->Mdl_Country->GetRecord(array('is_allow'=>'1'));
			$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/storecover/list',
						'stores'=>$stores,
						'countries'=>$countries
						);
			$this->load->view('admin/front',$data);
		}
	}
	
	public function Addstorecover()
	{
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
		    $countries=$this->Mdl_Country->GetRecord(array('is_allow'=>'1'));
			$data=array('success'=>$this->session->flashdata('success'),
					'error'=>$this->session->flashdata('error'),
					'main_content'=>'admin/storecover/create',
					'countries'=>$countries
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
				$this->form_validation->set_rules('store_name', "Store Name", 'trim|required');
				$this->form_validation->set_rules('store_email', "Store Email", 'trim|required|valid_email');
				$this->form_validation->set_rules('store_phone', "Store Phone", 'trim|required|regex_match[/^[0-9]{10}$/]');
				
				$store_name=$this->input->post('store_name');
				$store_email=$this->input->post('store_email');
				$store_phone=$this->input->post('store_phone');
				$store_mobile=$this->input->post('store_mobile');
				$store_address1=$this->input->post('store_address1');
				$store_address2=$this->input->post('store_address2');
				$store_postcode=$this->input->post('store_postcode');
				$store_city=$this->input->post('store_city');
				$store_country=$this->input->post('store_country');
				$store_handle=$this->input->post('store_handle');
				
				if($this->form_validation->run() === FALSE){
					$data=array('success'=>$this->session->flashdata('success'),
							'error'=>$this->session->flashdata('error'),
							'main_content'=>'admin/storecover/create'
							);
					$this->load->view('admin/front',$data);
				}else{
					$insert = array(
						'store_name'=>$store_name,
						'store_email'=>$store_email,
						'store_phone'=>$store_phone,
						'store_mobile'=>(!empty($store_mobile)) ? $store_mobile : NULL,
						'store_address1'=>(!empty($store_address1)) ? $store_address1 : NULL,
						'store_address2'=>(!empty($store_address2)) ? $store_address2 : NULL,
						'store_postcode'=>(!empty($store_postcode)) ? $store_postcode : NULL,
						'store_city'=>(!empty($store_city)) ? $store_city : NULL,
						'store_handle'=>(!empty($store_handle)) ? $store_handle : 0,
						'created_date'=>date('Y-m-d H:i:s'),
						'store_country'=>(!empty($store_country)) ? $store_country : NULL,
					);
					if($this->Mdl_StoreCover->insert($insert)){
						if($siteLang=='english'){
							$this->session->set_flashdata('success','Store Successfully Created' );
						}else{
							$this->session->set_flashdata('success','Magasin créé avec succès' );
						}
						redirect('admin/storecover/Viewstore');
					}else{
						if($siteLang=='english'){
							$this->session->set_flashdata('error','Error while creating store!' );
						}else{
							$this->session->set_flashdata('error','Erreur lors de la création du magasin!' );
						}
						redirect('admin/storecover/Viewstorecover');
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
		       $countries=$this->Mdl_Country->GetRecord(array('is_allow'=>'1'));
			if(!empty($id)){
			  
				$stores=$this->Mdl_StoreCover->GetRecordUsers(array('id'=>$id));
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/storecover/edit',
						'stores'=>$stores,
						'countries'=>$countries
						);
				$this->load->view('admin/front',$data);
			}else{
				$stores=$this->Mdl_StoreCover->GetRecordUsers();
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/storecover/list',
						'stores'=>$stores,
						'countries'=>$countries
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
					$this->form_validation->set_rules('store_name', "Store Name", 'trim|required');
					$this->form_validation->set_rules('store_email', "Store Email", 'trim|required|valid_email');
					$this->form_validation->set_rules('store_phone', "Store Phone", 'trim|required|regex_match[/^[0-9]{10}$/]');
					
					$store_name=$this->input->post('store_name');
					$store_email=$this->input->post('store_email');
					$store_phone=$this->input->post('store_phone');
					$store_mobile=$this->input->post('store_mobile');
					$store_address1=$this->input->post('store_address1');
					$store_address2=$this->input->post('store_address2');
					$store_postcode=$this->input->post('store_postcode');
					$store_city=$this->input->post('store_city');
					$store_country=$this->input->post('store_country');
					$store_handle=$this->input->post('store_handle');
					
					if($this->form_validation->run() === FALSE){
						$stores=$this->Mdl_StoreCover->GetRecordUsers(array('id'=>$id));
						$data=array('success'=>$this->session->flashdata('success'),
								'error'=>$this->session->flashdata('error'),
								'main_content'=>'admin/storecover/edit',
								'stores'=>$stores
								);
						$this->load->view('admin/front',$data);
					}else{
						$update = array(
							'store_name'=>$store_name,
							'store_email'=>$store_email,
							'store_phone'=>$store_phone,
							'store_mobile'=>$store_mobile,
							'store_address1'=>$store_address1,
							'store_address2'=>$store_address2,
							'store_postcode'=>$store_postcode,
							'store_city'=>$store_city,
							'store_country'=>$store_country,
							'store_handle'=>$store_handle
						);
						if($this->Mdl_StoreCover->update($update,array('id'=>$id))){
							if($siteLang=='english'){
								$this->session->set_flashdata('success','Store Successfully Updated' ); 
							}else{
								$this->session->set_flashdata('success','Store mis à jour avec succès' ); 
							}
							redirect('admin/storecover/Viewstorecover');
						}else{
							if($siteLang=='english'){
								$this->session->set_flashdata('error','Error while updating store!' );
							}else{
								$this->session->set_flashdata('error','Erreur lors de la mise à jour du magasin!' );
							}
							redirect('admin/storecover/Viewstorecover');
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
				$remove=$this->Mdl_StoreCover->remove($id);
				if(empty($remove))
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('error','Error while deleting store!');
					}else{
						$this->session->set_flashdata('error','Erreur lors de la suppression du magasin!');
					}
					redirect('admin/storecover/Viewstorecover');
				}
				else
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('success','Store Remove Successfully');
					}else{
						$this->session->set_flashdata('success','Store Remove avec succès');
					}
					redirect('admin/storecover/Viewstorecover');
				}
			}
			else
			{
				if($siteLang=='english'){
					$this->session->set_flashdata('error','Error while deleting store!');
				}else{
					$this->session->set_flashdata('error','Erreur lors de la suppression du magasin!');
				}
				redirect('admin/storecover/Viewstorecover');
			}
		}
	}
	
	public function UploadImportFile()
	{
		$siteLang = $this->session->userdata('site_lang');
		if(!empty($_SESSION['admin_user'])){
			$ext = substr(strrchr($_FILES['storefile']['name'], '.'), 1);
			if(!empty($_FILES['storefile']['name']) && $ext == 'csv'){
				$count=0;
				$fp = fopen($_FILES['storefile']['tmp_name'],'r') or die("can't open file");
				while($csv_line = fgetcsv($fp,1024))
				{
					//echo '<pre>';print_r($csv_line);
					$count++;
					//echo $count;die;
					if($count == 1)
					{
						continue;
					}//keep this if condition if you want to remove the first row
					for($i = 0, $j = count($csv_line); $i < $j; $i++)
					{
						$insert_csv = array();
						$insert_csv['store_name'] 			= $csv_line[0];
						$insert_csv['store_email'] 	        = $csv_line[1];
						$insert_csv['store_phone'] 			= $csv_line[2];
						$insert_csv['store_mobile'] 		= $csv_line[3];
						$insert_csv['store_address1'] 		= $csv_line[4];
						$insert_csv['store_address2'] 		= $csv_line[5];
						$insert_csv['store_postcode'] 		= $csv_line[6];
						$insert_csv['store_city'] 		    = $csv_line[7];
						$insert_csv['store_country'] 		= $csv_line[8];
					}
					$i++;
					
					$data = array(
						'store_name'				=>(isset($insert_csv['store_name'])) ? $insert_csv['store_name'] : 'NULL',
						'store_email'				=>(isset($insert_csv['store_email'])) ? $insert_csv['store_email'] : '',
						'store_phone'				=>(isset($insert_csv['store_phone'])) ? $insert_csv['store_phone'] : '',
						'store_mobile'				=>(isset($insert_csv['store_mobile'])) ? $insert_csv['store_mobile'] : '',
						'store_address1'			=>(isset($insert_csv['store_address1'])) ? $insert_csv['store_address1'] : '',
						'store_address2'			=>(isset($insert_csv['store_address2'])) ? $insert_csv['store_address2'] : '',
						'store_postcode'			=>(isset($insert_csv['store_postcode'])) ? $insert_csv['store_postcode'] : '',
						'store_city'				=>(isset($insert_csv['store_city'])) ? $insert_csv['store_city'] : '',
						'store_country'		    	=>(isset($insert_csv['store_country'])) ? $insert_csv['store_country'] : '',
						'created_date'				=>date('Y-m-d H:i:s')
					);
					$id = $this->Mdl_StoreCover->insert($data);
				}
				fclose($fp) or die("error while import file!");
				$data['success']="success";
				if($id){
					if($siteLang=='english'){
						$this->session->set_flashdata('success','Store Successfully Created' );
					}else{
						$this->session->set_flashdata('success','Magasin créé avec succès' );
					}
					redirect('admin/storecover/Viewstorecover');
				}else{
					if($siteLang=='english'){
						$this->session->set_flashdata('error','error while import file!');
					}else{
						$this->session->set_flashdata('error',"erreur lors de l'importation du fichier!");
					}
					redirect('admin/storecover/Viewstorecover');
				}
			}else{
				if($siteLang=='english'){
					$this->session->set_flashdata('error','please upload csv file!');
				}else{
					$this->session->set_flashdata('error',"s'il vous plaît télécharger le fichier csv!");
				}
				redirect('admin/storecover/Viewstorecover');
			}
		}else{
			redirect('admin');
		}
	}
}
