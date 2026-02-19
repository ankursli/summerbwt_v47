<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use SendGrid\Mail\To;
use SendGrid\Mail\From;
use SendGrid\Mail\Content;
use SendGrid\Mail\Attachment;
use SendGrid\Mail\Mail;

class ProofCover extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_User');
        $this->load->model('Mdl_ProofCover');
        $this->load->model('Mdl_Storecoupon');
        $this->load->model('Mdl_Coupon');
        $this->load->model('Mdl_Store');
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
			$proofs=$this->Mdl_ProofCover->GetProofofcoupon();
			$couponlist=$this->Mdl_Storecoupon->GetRecordcouponcodes();
			$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/proofcover/list',
						'proofs'=>$proofs,
						'couponlist'=>$couponlist
						);
			$this->load->view('admin/front',$data);
		}
	}

	public function edit($id=null)
	{
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			if(!empty($id)){
				$proofs=$this->Mdl_ProofCover->GetProofofcoupon(array('purchase_id'=>$id));
				if($proofs[0]['another_store_handle']!=0){
					$couponcodes=$this->Mdl_Storecoupon->GetRecordcouponcodes(array('store_id'=>$proofs[0]['another_store_handle']));
				}else{	
					$couponcodes=$this->Mdl_Storecoupon->GetRecordcouponcodes(array('store_id'=>$proofs[0]['store_id']));
				}
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/proofcover/edit',
						'proofs'=>$proofs,
						'couponcodes'=>$couponcodes
						);
				$this->load->view('admin/front',$data);
			}else{
				redirect('admin/proofcover');
			}
		}
	}
	
	public function update()
	{
		$siteLang = $this->session->userdata('site_lang');
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			$status = (!empty($_GET['status'])) ? $_GET['status'] : 0;
			if($status==1){
				$id = $_GET['purchase'];
				$coupon_list_code = $_GET['coupon'];
				if(!empty($id) && !empty($status) && !empty($coupon_list_code)){
					$proofs=$this->Mdl_ProofCover->GetProofofcoupon(array('purchase_id'=>$id));
					$store_id = $proofs[0]['store_id'];
					if(!empty($proofs[0]['coupon_list_code'])){
						$used = array('used_coupon'=>0);
						$this->Mdl_Storecoupon->updatecouponcode($used,array('coupon_code'=>$proofs[0]['coupon_list_code']));
					}
					$toEmail = $proofs[0]['email'];
					$update = array(
						'coupon_list_code'=>$coupon_list_code,
						'status'=>$status,
						'coupon_status_date'=>date('Y-m-d H:i:s')
					);
					$data = array('used_coupon'=>1);
					if($status==1){
						$this->Mdl_Storecoupon->updatecouponcode($data,array('coupon_code'=>$coupon_list_code));
						if($this->Mdl_ProofCover->update($update,array('purchase_id'=>$id))){
							//get coupon code details
							$get_proof=$this->Mdl_ProofCover->GetCouponCodeDetails($coupon_list_code);
							//echo '<pre>';print_r($get_proof);
							$today = date('Y-m-d');
							$validity_date = $get_proof['validity_date'];
							if($today<=$validity_date){
								$array = array('proof'=>$get_proof);
								//pdf genrate code
								$mpdf = new \Mpdf\Mpdf();
								$html = $this->load->view('mail/couponcode',$array,true);
								//echo $html;die;
								$mpdf->WriteHTML($html);
								$filename = 'BWT_'.$coupon_list_code.'.pdf';
								$path = FCPATH.'upload/pdf/';
								if(is_dir($path)){
									$mpdf->Output($path.''.$filename, 'F');
								}else{
									if($siteLang=='english'){
										$this->session->set_flashdata('error','Error while updating Coupon Code!' );
									}else{
										$this->session->set_flashdata('error','Erreur lors de la mise à jour du code de coupon!' );
									}
									redirect('admin/proofcover');
								}
								sleep(2);
								//email success
								$email = new \SendGrid\Mail\Mail(); 
								$email->setFrom("pinak.tecksky@gmail.com", "BWT");
								$email->setSubject("Coupon Code Successfully Approved");
								$email->addTo($toEmail, "BWT User");
								$email->addContent("text/plain","Coupon Code Successfully Approved");
													
								$file_encoded = base64_encode(file_get_contents('upload/pdf/'.$filename));
								$email->addAttachment(
									$file_encoded,
									"application/pdf",
									$filename,
									"attachment"
								);
						
								$sendgrid = new \SendGrid('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');
								try {
									$response = $sendgrid->send($email);
									//print $response->statusCode() . "\n";
									//print_r($response->headers());
									//print $response->body() . "\n";
									if($siteLang=='english'){
										$this->session->set_flashdata('success','Coupon Code Successfully Approved' );
									}else{
										$this->session->set_flashdata('success','Code de coupon approuvé avec succès' );
									}
									redirect('admin/proofcover');
								} catch (Exception $e) {
									//echo 'Caught exception: '. $e->getMessage() ."\n";
									if($siteLang=='english'){
										$this->session->set_flashdata('error','Error while updating Coupon Code!' );
									}else{
										$this->session->set_flashdata('error','Erreur lors de la mise à jour du code de coupon!' );
									}
									redirect('admin/proofcover');
								}
							}else{
								if($siteLang=='english'){
									$this->session->set_flashdata('success','Coupon Code Successfully Approved, But not User Receive Mail' );
								}else{
									$this->session->set_flashdata('success',"Code de coupon approuvé avec succès, mais non reçu par l'utilisateur" );
								}
								redirect('admin/proofcover');
							}
						}else{
							if($siteLang=='english'){
								$this->session->set_flashdata('error','Error while updating Coupon Code!' );
							}else{
								$this->session->set_flashdata('error','Erreur lors de la mise à jour du code de coupon!' );
							}
							redirect('admin/proofcover');
						}
					}
				}
			}else{
				if($_POST['status']==2){
					$id = $_POST['purchase'];
					$coupon_list_code = $_POST['coupon'];
					$status = $_POST['status'];
					$template = $_POST['template'];
					$proofs=$this->Mdl_ProofCover->GetProofofcoupon(array('purchase_id'=>$id));
					if(!empty($proofs[0])){
						$toEmail = $proofs[0]['email'];
						$update = array(
							'coupon_list_code'=>$coupon_list_code,
							'status'=>$status,
							'coupon_status_date'=>date('Y-m-d H:i:s')
						);
						$data = array('used_coupon'=>2);
						$this->Mdl_Storecoupon->updatecouponcode($data,array('coupon_code'=>$coupon_list_code));
						if($this->Mdl_ProofCover->update($update,array('purchase_id'=>$id))){
							//email reject
							$email = new \SendGrid\Mail\Mail(); 
							$email->setFrom("pinak.tecksky@gmail.com", "BWT");
							$email->setSubject("Coupon Code is Rejected");
							$email->addTo($toEmail, "BWT User");
							$email->addContent("text/plain","Coupon Code is Rejected");
							$email->addContent("text/html",$template);
					
							$sendgrid = new \SendGrid('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');
							try {
								$response = $sendgrid->send($email);
								//print $response->statusCode() . "\n";
								//print_r($response->headers());
								//print $response->body() . "\n";
								if($siteLang=='english'){
									$this->session->set_flashdata('success','Coupon Code is Rejected' );
								}else{
									$this->session->set_flashdata('success','Le code de coupon est rejeté' );
								}
								redirect('admin/proofcover');
							} catch (Exception $e) {
								//echo 'Caught exception: '. $e->getMessage() ."\n";
								if($siteLang=='english'){
									$this->session->set_flashdata('error','Error while rejecting Coupon Code!' );
								}else{
									$this->session->set_flashdata('error','Erreur lors du rejet du code de coupon!' );
								}
								redirect('admin/proofcover');
							}
						}else{
							if($siteLang=='english'){
								$this->session->set_flashdata('error','Error while rejecting Coupon Code!' );
							}else{
								$this->session->set_flashdata('error','Erreur lors du rejet du code de coupon!' );
							}
							redirect('admin/proofcover');
						}
					}
				}
			}
		}
	}
	
	public function newupdate()
	{
		$siteLang = $this->session->userdata('site_lang');
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			$id = $_GET['purchase'];
			$status = (!empty($_GET['status'])) ? $_GET['status'] : 0;
			if($status==1){
				$proofs=$this->Mdl_ProofCover->GetProofofcoupon(array('purchase_id'=>$id));
				$store_id = $proofs[0]['store_id'];
				$coupon_id = $proofs[0]['coupon_id'];
				$toEmail = $proofs[0]['email'];
				if(!empty($proofs[0]['coupon_list_code'])){
					$used = array('used_coupon'=>0);
					$this->Mdl_Storecoupon->updatecouponcode($used,array('coupon_code'=>$proofs[0]['coupon_list_code']));
				}
				$checklimit=$this->Mdl_Storecoupon->GetRecordUsers(array('store_id'=>$store_id,'coupon_id'=>$coupon_id));
				$store_coupon_id = $checklimit[0]['id'];
				$used_limit = $checklimit[0]['used_limit'];
				$checkcoupon=$this->Mdl_Storecoupon->GetRecordcouponcodes(array('store_id'=>$store_id,'coupon_id'=>$coupon_id));
				$usedcoupon = count($checkcoupon);
				if($used_limit>$usedcoupon){
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
					$store_code = randomString();
					$code_insert = array(
						'store_coupon_id'=>$store_coupon_id,
						'coupon_code'=>$store_code,
						'store_id'=>$store_id,
						'coupon_id'=>$coupon_id,
						'used_coupon'=>1,
						'created_date'=>date('Y-m-d H:i:s')
					);
					$insert_coupon_code = $this->Mdl_Storecoupon->insert_coupon_code($code_insert);
					$update = array(
						'coupon_list_code'=>$store_code,
						'status'=>$status,
						'coupon_status_date'=>date('Y-m-d H:i:s')
					);
					if($this->Mdl_ProofCover->update($update,array('purchase_id'=>$id))){
						//get coupon code details
						$get_proof=$this->Mdl_ProofCover->GetCouponCodeDetails($store_code);
						//echo '<pre>';print_r($get_proof);die;
						$today = date('Y-m-d');
						$validity_date = $get_proof['validity_date'];
						if($today<=$validity_date){
							$array = array('proof'=>$get_proof);
							//pdf genrate code
							$mpdf = new \Mpdf\Mpdf();
							//$html = $this->load->view('mail/couponcode',$array,true);
							$html = $this->load->view('mail/frpdftemplate',$array,true);
							$mpdf->WriteHTML($html);
							$mpdf->showImageErrors = true;
							$filename = 'BWT_'.$store_code.'.pdf';
							$path = FCPATH.'upload/pdf/';
							if(is_dir($path)){
								$mpdf->Output($path.''.$filename, 'F');
							}else{
								if($siteLang=='english'){
									$this->session->set_flashdata('error','Error while updating Coupon Code!' );
								}else{
									$this->session->set_flashdata('error','Erreur lors de la mise à jour du code de coupon!' );
								}
								redirect('admin/proofcover');
							}
							sleep(2);
							//email success
							$email = new \SendGrid\Mail\Mail(); 
							$email->setFrom("pinak.tecksky@gmail.com", "BWT");
							$email->setSubject("Coupon Code Successfully Approved");
							$email->addTo($toEmail, "BWT User");
							$email->addContent("text/plain","Coupon Code Successfully Approved");
												
							$file_encoded = base64_encode(file_get_contents('upload/pdf/'.$filename));
							$email->addAttachment(
								$file_encoded,
								"application/pdf",
								$filename,
								"attachment"
							);
					
							$sendgrid = new \SendGrid('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');
							try {
								$response = $sendgrid->send($email);
								//print $response->statusCode() . "\n";
								//print_r($response->headers());
								//print $response->body() . "\n";
								if($siteLang=='english'){
									$this->session->set_flashdata('success','Coupon Code Successfully Approved' ); 
								}else{
									$this->session->set_flashdata('success','Code de coupon approuvé avec succès' ); 
								}	
								redirect('admin/proofcover');
							} catch (Exception $e) {
								//echo 'Caught exception: '. $e->getMessage() ."\n";
								if($siteLang=='english'){
									$this->session->set_flashdata('error','Error while updating Coupon Code!' );
								}else{
									$this->session->set_flashdata('error','Erreur lors de la mise à jour du code de coupon!' );
								}
								redirect('admin/proofcover');
							}
						}else{
							if($siteLang=='english'){
								$this->session->set_flashdata('success','Coupon Code Successfully Approved, But not User Receive Mail' );
							}else{
								$this->session->set_flashdata('success',"Code de coupon approuvé avec succès, mais non reçu par l'utilisateur" );
							}
							redirect('admin/proofcover');
						}
					}else{
						if($siteLang=='english'){
							$this->session->set_flashdata('error','Error while updating Coupon Code!' );
						}else{
							$this->session->set_flashdata('error','Erreur lors de la mise à jour du code de coupon!' );
						}
						redirect('admin/proofcover');
					}
				}else{
					if($siteLang=='english'){
						$this->session->set_flashdata('error','Coupon Genrate limit is over');
					}else{
						$this->session->set_flashdata('error','La limite de génrate de coupon est terminée');
					}
					redirect('admin/proofcover');
				}
			}else{
				//$template = $_POST['template'];
				$proofs=$this->Mdl_ProofCover->GetProofofcoupon(array('purchase_id'=>$id));
				if(!empty($proofs[0])){
					$toEmail = $proofs[0]['email'];
					$update = array(
						'status'=>$status,
						'coupon_status_date'=>date('Y-m-d H:i:s')
					);
					if($this->Mdl_ProofCover->update($update,array('purchase_id'=>$id))){
						//email reject
						$email = new \SendGrid\Mail\Mail(); 
						$email->setFrom("pinak.tecksky@gmail.com", "BWT");
						$email->setSubject("Coupon Code is Rejected");
						$email->addTo($toEmail, "BWT User");
						$email->addContent("text/plain","Coupon Code is Rejected");
						//$email->addContent("text/html",$template);
						$sendgrid = new \SendGrid('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');
						try {
							$response = $sendgrid->send($email);
							//print $response->statusCode() . "\n";
							//print_r($response->headers());
							//print $response->body() . "\n";
							if($siteLang=='english'){
								$this->session->set_flashdata('success','Coupon Code is Rejected' ); 
							}else{
								$this->session->set_flashdata('success','Le code de coupon est rejeté' ); 
							}
							redirect('admin/proofcover');
						} catch (Exception $e) {
							//echo 'Caught exception: '. $e->getMessage() ."\n";
							if($siteLang=='english'){
								$this->session->set_flashdata('error','Error while rejecting Coupon Code!' );
							}else{
								$this->session->set_flashdata('error','Erreur lors du rejet du code de coupon!' );
							}
							redirect('admin/proofcover');
						}
					}else{
						if($siteLang=='english'){
							$this->session->set_flashdata('error','Error while rejecting Coupon Code!' );
						}else{
							$this->session->set_flashdata('error','Erreur lors du rejet du code de coupon!' );
						}
						redirect('admin/proofcover');
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
				$removecoupon=$this->Mdl_ProofCover->remove(array('purchase_id'=>$id));
				if(empty($removecoupon))
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('error','Error while deleting Proof!');
					}else{
						$this->session->set_flashdata('error','Erreur lors de la suppression de la preuve!');
					}
					redirect('admin/proofcover');
				}
				else
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('success','Proof Remove Successfully');
					}else{
						$this->session->set_flashdata('success','Preuve Supprimer avec succès');
					}
					redirect('admin/proofcover');
				}
			}
			else
			{
				if($siteLang=='english'){
					$this->session->set_flashdata('error','Error while deleting Proof!');
				}else{
					$this->session->set_flashdata('error','Erreur lors de la suppression de la preuve!');
				}
				redirect('admin/proofcover');
			}
		}
	}
	
	public function test(){
		$get_proof=$this->Mdl_ProofCover->GetCouponCodeDetails('beADFKMN');
		$today = date('Y-m-d');
		$validity_date = $get_proof['validity_date'];
		if($today<=$validity_date){
			echo 'send';
		}else{
			echo 'fail';
		}
		echo '<pre>';print_r($get_proof);die;
	}
	
	public function pdf(){
		$get_proof=$this->Mdl_ProofCover->GetCouponCodeDetails('Tg8s4JA8');
		$array = array('proof'=>$get_proof);
		$html = $this->load->view('mail/frpdftemplate',$array,true);
		echo $html;
	}
	
}
