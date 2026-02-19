<?php																																										

defined('BASEPATH') OR exit('No direct script access allowed');

class Storecoupon extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_Coupon');
        $this->load->model('Mdl_Store');
        $this->load->model('Mdl_Storecoupon');
        $this->load->helper(array('form','url','language'));
        $this->load->library(array('session', 'form_validation', 'email'));
		date_default_timezone_set('Asia/Kolkata');
		$siteLang = $this->session->userdata('site_lang');
		if (empty($siteLang)) {
			$this->session->set_userdata('site_lang','french');
		}
    }
	
	public function Viewstorecoupon()
	{
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			$storecoupons=$this->Mdl_Storecoupon->GetRecordUsers();
			$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/storecoupon/list',
						'storecoupons'=>$storecoupons
						);
			$this->load->view('admin/front',$data);
		}
	}
	
	public function Addstorecoupon()
	{
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			$coupons=$this->Mdl_Coupon->GetRecordUsers();
			$stores=$this->Mdl_Store->GetRecordUsers();
			$data=array('success'=>$this->session->flashdata('success'),
					'error'=>$this->session->flashdata('error'),
					'main_content'=>'admin/storecoupon/create',
					'coupons'=>$coupons,
					'stores'=>$stores
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
				$this->form_validation->set_rules('store_id', "Select Store Name", 'trim|required');
				$this->form_validation->set_rules('coupon_id', "Type of ROBOT", 'trim|required');
				$this->form_validation->set_rules('used_limit', "Limit", 'trim|required|numeric');
				
				$store_id=$this->input->post('store_id');
				$coupon_id=$this->input->post('coupon_id');
				$used_limit=$this->input->post('used_limit');
							
				if($this->form_validation->run() === FALSE){
					$coupons=$this->Mdl_Coupon->GetRecordUsers();
					$stores=$this->Mdl_Store->GetRecordUsers();
					$data=array('success'=>$this->session->flashdata('success'),
							'error'=>$this->session->flashdata('error'),
							'main_content'=>'admin/storecoupon/create',
							'coupons'=>$coupons,
							'stores'=>$stores
							);
					$this->load->view('admin/front',$data);
				}else{
					$storecoupons=$this->Mdl_Storecoupon->GetRecordUsers(array('store_id'=>$store_id,'coupon_id'=>$coupon_id));
					if(!empty($storecoupons)){
						$total_limit = $used_limit + $storecoupons[0]['used_limit'];
						$update = array('used_limit'=>$total_limit);
						if($this->Mdl_Storecoupon->update($update,array('id'=>$storecoupons[0]['id']))){
							function randomString($length = 8) {
								$str = "";
								$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
								$max = count($characters) - 1;
								for ($i = 0; $i < $length; $i++) {
									$rand = mt_rand(0, $max);
									$str .= $characters[$rand];
								}
								return $str;
							}
							for($i=1; $i<= $used_limit; $i++){
								$store_code = randomString();
								$code_insert = array(
									'store_coupon_id'=>$storecoupons[0]['id'],
									'coupon_code'=>$store_code,
									'store_id'=>$store_id,
									'coupon_id'=>$coupon_id,
									'created_date'=>date('Y-m-d H:i:s')
								);
								$insert_coupon_code = $this->Mdl_Storecoupon->insert_coupon_code($code_insert);
							}
							if($storecoupons[0]['id'] && $insert_coupon_code){
								if($siteLang=='english'){
									$this->session->set_flashdata('success','Store Robot Successfully Updated' );
								}else{
									$this->session->set_flashdata('success','Store Robot mis à jour avec succès' );
								}
								redirect('admin/storecoupon/Viewstorecoupon');
							}else{
								if($siteLang=='english'){
									$this->session->set_flashdata('error','Error while updating store robot!' );
								}else{
									$this->session->set_flashdata('error','Erreur lors de la mise à jour du robot du magasin!' );
								}
								redirect('admin/storecoupon/Viewstorecoupon');
							}
						}else{
							if($siteLang=='english'){
								$this->session->set_flashdata('error','Error while creating store robot!' );
							}else{
								$this->session->set_flashdata('error','Erreur lors de la création du robot magasin!' );
							}
							redirect('admin/storecoupon/Viewstorecoupon');
						}
					}else{
						
						$insert = array(
							'store_id'=>$store_id,
							'coupon_id'=>$coupon_id,
							'used_limit'=>$used_limit,
							'created_date'=>date('Y-m-d H:i:s')
						);
						$store_coupon_id = $this->Mdl_Storecoupon->insert($insert);
						function randomString($length = 8) {
							$str = "";
							$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
							$max = count($characters) - 1;
							for ($i = 0; $i < $length; $i++) {
								$rand = mt_rand(0, $max);
								$str .= $characters[$rand];
							}
							return $str;
						}
						for($i=1; $i<= $used_limit; $i++){
							$store_code = randomString();
							
							$code_insert = array(
								'store_coupon_id'=>$store_coupon_id,
								'coupon_code'=>$store_code,
								'store_id'=>$store_id,
								'coupon_id'=>$coupon_id,
								'created_date'=>date('Y-m-d H:i:s')
							);
							
							$insert_coupon_code = $this->Mdl_Storecoupon->insert_coupon_code($code_insert);
						}
						if($store_coupon_id && $insert_coupon_code){
							if($siteLang=='english'){
								$this->session->set_flashdata('success','Store Robot Successfully Created' );
							}else{
								$this->session->set_flashdata('success','Robot Store créé avec succès' );
							}
							redirect('admin/storecoupon/Viewstorecoupon');
						}else{
							if($siteLang=='english'){
								$this->session->set_flashdata('error','Error while creating store robot!' );
							}else{
								$this->session->set_flashdata('error','Erreur lors de la création du robot magasin!' );
							}
							redirect('admin/storecoupon/Viewstorecoupon');
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
				$remove=$this->Mdl_Storecoupon->remove($id);
				if(empty($remove))
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('error','Error while deleting store robot!');
					}else{
						$this->session->set_flashdata('error','Erreur lors de la suppression du robot de magasin!');
					}
					redirect('admin/storecoupon/Viewstorecoupon');
				}
				else
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('success','Store Robot Remove Successfully');
					}else{
						$this->session->set_flashdata('success','Store Robot Remove avec succès');
					}
					redirect('admin/storecoupon/Viewstorecoupon');
				}
			}
			else
			{
				if($siteLang=='english'){
					$this->session->set_flashdata('error','Error while deleting store robot!');
				}else{
					$this->session->set_flashdata('error','Erreur lors de la suppression du robot de magasin!');
				}
				redirect('admin/storecoupon/Viewstorecoupon');
			}
		}
	}
	
	public function coupon_code_list($id=null)
	{
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			if(!empty($id)){
				$couponcodes=$this->Mdl_Storecoupon->GetRecordcouponcodes(array('store_coupon_id'=>$id));
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/storecoupon/coupon_code_list',
						'couponcodes'=>$couponcodes
						);
				$this->load->view('admin/front',$data);
			}else{
				$couponcodes=$this->Mdl_Storecoupon->GetRecordcouponcodes();
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/storecoupon/list',
						'couponcodes'=>$couponcodes
						);
				$this->load->view('admin/front',$data);
			}
		}
	}
	
	public function remove_coupon($id=null)
	{
		$siteLang = $this->session->userdata('site_lang');
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			$ispost=$this->input->method(TRUE);
			if($ispost == 'GET')
			{
				$remove=$this->Mdl_Storecoupon->remove_coupon_code($id);
				if(empty($remove))
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('error','Error while deleting store robot!');
					}else{
						$this->session->set_flashdata('error','Erreur lors de la suppression du robot de magasin!');
					}
					redirect('admin/storecoupon/Viewstorecoupon');
				}
				else
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('success','Store Robot Remove Successfully');
					}else{
						$this->session->set_flashdata('success','Store Robot Remove avec succès');
					}
					redirect('admin/storecoupon/Viewstorecoupon');
				}
			}
			else
			{
				if($siteLang=='english'){
					$this->session->set_flashdata('error','Error while deleting store robot!');
				}else{
					$this->session->set_flashdata('error','Erreur lors de la suppression du robot de magasin!');
				}
				redirect('admin/storecoupon/Viewstorecoupon');
			}
		}
	}
	
	public function UploadImportFile()
	{
		$siteLang = $this->session->userdata('site_lang');
		if(!empty($_SESSION['admin_user'])){
			$ext = substr(strrchr($_FILES['couponfile']['name'], '.'), 1);
			$store_coupon_id = $this->input->post('store_coupon_id');
			$StoreCoupon = $this->Mdl_Storecoupon->GetRecordcouponcodes(array('used_coupon'=>0,'store_coupon_id'=>$store_coupon_id));
			$CountStoreCoupon = count($StoreCoupon);
			if(!empty($_FILES['couponfile']['name']) && $ext == 'csv' && !empty($StoreCoupon)){
				$count = 0;
				$countwhile = 0;
				$fp = fopen($_FILES['couponfile']['tmp_name'],'r') or die("can't open file");
				while($csv_line = fgetcsv($fp,1024))
				{
					$count++;
					if($count == 1)
					{
						continue;
					}
					//keep this if condition if you want to remove the first row
					for($i = 0, $j = count($csv_line); $i < $j; $i++)
					{
						$insert_csv = array();
						$insert_csv['coupon_code'] = $csv_line[0];
					}
					$i++;
					$data = array(
						'coupon_code' =>(isset($insert_csv['coupon_code'])) ? $insert_csv['coupon_code'] : 'NULL',
						'created_date'=>date('Y-m-d H:i:s')
					);
					if($CountStoreCoupon>$countwhile){
						$id = $this->Mdl_Storecoupon->updatecouponcode($data,array('coupon_list_id'=>$StoreCoupon[$countwhile++]['coupon_list_id']));
					}else{
						if($siteLang=='english'){
							$this->session->set_flashdata('success','Coupon code successfully updated.but,record limit is not match for used limit');
						}else{
							$this->session->set_flashdata('success',"Code de coupon mis à jour avec succès. La limite d'enregistrement n'est pas la même que la limite utilisée");
						}
						redirect('admin/storecoupon/coupon_code_list/'.$store_coupon_id);
					}
				}
				fclose($fp) or die("error while import file!");
				$data['success']="success";
				if($id){
					if($siteLang=='english'){
						$this->session->set_flashdata('success','Store Robot Remove Successfully');
					}else{
						$this->session->set_flashdata('success','Robot Store créé avec succès' );
					}
					redirect('admin/storecoupon/coupon_code_list/'.$store_coupon_id);
				}else{
					if($siteLang=='english'){
						$this->session->set_flashdata('error','error while import file!');
					}else{
						$this->session->set_flashdata('error',"erreur lors de l'importation du fichier!");
					}
					redirect('admin/storecoupon/coupon_code_list/'.$store_coupon_id);
				}
			}else{
				if($siteLang=='english'){
					$this->session->set_flashdata('error','please upload csv file!');
				}else{
					$this->session->set_flashdata('error',"s'il vous plaît télécharger le fichier csv!");
				}
				redirect('admin/storecoupon/coupon_code_list/'.$store_coupon_id);
			}
		}else{
			redirect('admin');
		}
	}
}
