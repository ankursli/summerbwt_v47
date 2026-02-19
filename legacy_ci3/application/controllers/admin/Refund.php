<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refund extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_Refund');
		$this->load->model('Mdl_User');
      
        $this->load->model('Mdl_Storecoupon');
        $this->load->model('Mdl_Coupon');
        $this->load->model('Mdl_Store');
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
			$refunds=$this->Mdl_Refund->GetRecordUsers();
			$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/refund/list',
						'refunds'=>$refunds
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
				$Delete=$this->Mdl_Refund->remove($id);
				if(empty($Delete))
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('error','Error while deleting Refund!');
					}else{
						$this->session->set_flashdata('error','Erreur lors de la suppression du remboursement!');
					}
					redirect('admin/refund');
				}
				else
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('success','Refund Remove Successfully');
					}else{
						$this->session->set_flashdata('success','Remboursement supprimer avec succès');
					}
					redirect('admin/refund');
				}
			}
			else
			{
				if($siteLang=='english'){
					$this->session->set_flashdata('error','Error while deleting Refund!');
				}else{
					$this->session->set_flashdata('error','Erreur lors de la suppression du remboursement!');
				}
				redirect('admin/refund');
			}
		}
	}



	public function export_refund(){
		$result=array();
		$second_export = chr(0xEF).chr(0xBB).chr(0xBF)."id,Username,Robot,Stores,Another Stores,Address,Postcode,City,Upload Proof,Proof Date,Client Type,IBAN,BIC,Serial No,Status\n";
		$proofs=$this->Mdl_Refund->GetRecordUsers();
		$couponlist=$this->Mdl_Storecoupon->GetRecordcouponcodes();
		foreach($proofs as $proof){
			if($proof['store_id']!=0){
				$anothergetstores = $this->Mdl_Store->GetRecordUsers(array('id'=>$proof['store_id']));
				$name = $anothergetstores[0]['store_name'];
			}else{
				$name = '';
			}


			if($name == 'AUTRE'){ 
				$stroname=strtoupper($proof['store_name_additional']);
				$athorestore=$stroname;
				$address=$proof['address']."".$proof['addition_address'];
				$postcode=$proof['postcode'];
				$city=$proof['city'];
				 } else{
					$athorestore='';
					$address='';
					$postcode='';
					$city='';

				 }
			$coupon = $this->Mdl_Coupon->GetRecordUsers(array('id'=>$proof['modal']));
			$img = base_url('upload').'/*op3/'.$proof['upload_proof'];
			if($proof['status']==1){
				$status = 'Approved';
			}elseif($proof['status']==2){
				$status = 'Rejected';
			}else{
				$status = 'Pending';
			}

			$clienttype=''; 
			if($proof['clienttype'] == 'particulier')
			{ 
				$clienttype='Particulier'; 
			} 
			else if($proof['clienttype'] == 'pro')
			{ 
				$clienttype='Professionnal';  
			} 
			else { 
				$clienttype='NULL'; 
			} 
			$iban=$proof['bank_iban'];
			$bic=$proof['bank_bic'];
			
		$second_export.= $proof['refund_id'].',"'.$proof['email'].'","'.$coupon[0]['coupon_name'].'","'.$name.'","'.$athorestore.'","'.$address.'","'.$postcode.'","'.$city.'","'.$img.'","'.$proof['date_of_purchase'].'","'.$clienttype.'","'.$iban.'","'.$bic.'","'.$proof['roboto_serial_no'].'","'.$status.'"'."\n";
		
		
		}
		
		$userid=$_SESSION['admin_user']['id'];
		
		$name = 'contratdexcellence'.date('Ymdhis');
		$filename = $name.$userid.'.csv';
		$csv_handler = fopen (FCPATH.'/upload/robot/'.$filename, 'w');
		fwrite ($csv_handler,$second_export);
		fclose ($csv_handler);
		header('Content-Type: text/csv');
		header('Content-Type: text/html; charset=UTF-8');
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		echo file_get_contents(FCPATH.'/upload/robot/'.$filename);
		exit;
	}
}
