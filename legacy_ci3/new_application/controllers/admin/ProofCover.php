<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use \Mailjet\Resources;

class ProofCover extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_User');
        $this->load->model('Mdl_ProofCover');
        $this->load->model('Mdl_Storecoupon');
        $this->load->model('Mdl_Coupon');
        $this->load->model('Mdl_Cover');
        $this->load->model('Mdl_Store');
        $this->load->model('Mdl_StoreCover');
		$this->load->model('Mdl_Settings');
		$this->load->model('Mdl_Template');
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
					$couponcodes=$this->Mdl_Storecoupon->GetRecordcouponcodes(array('store_id'=>$proofs[0]['another_store_handle'],'coupon_id'=>$proofs[0]['coupon_id'],'used_coupon'=>0));
				}else{	
					$couponcodes=$this->Mdl_Storecoupon->GetRecordcouponcodes(array('store_id'=>$proofs[0]['store_id'],'coupon_id'=>$proofs[0]['coupon_id'],'used_coupon'=>0));
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
	
	public function export_proofcover(){
		$result=array();
		$second_export = chr(0xEF).chr(0xBB).chr(0xBF)."id,Username,Robot,Stores,Another Stores,Address,Postcode,City,Upload Proof,Proof Date,Client Type,IBAN,BIC,Robot serial no,Status\n";
		$proofs=$this->Mdl_ProofCover->GetProofofcoupon();
		$couponlist=$this->Mdl_Storecoupon->GetRecordcouponcodes();
		foreach($proofs as $proof){
			if($proof['store_id']!=0){
				$anothergetstores = $this->Mdl_StoreCover->GetRecordUsers(array('id'=>$proof['store_id']));
				$name = $anothergetstores[0]['store_name'];
			}else{
				$name = '';
			}


			if($name == 'AUTRE'){ 
				$stroname=strtoupper($proof['store_name_additional']);
				$athorestore=$stroname;
				$address=$proof['address']." ".$proof['addition_address'];
				$postcode=$proof['zipcode'];
				$city=$proof['city'];
				 } else{
					$athorestore='';
					$address='';
					$postcode='';
					$city='';

				 }
			$coupon = $this->Mdl_Coupon->GetRecordUsers(array('id'=>$proof['coupon_id']));
			$img = base_url('upload').'/op3/'.$proof['upload_proof'];
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
			$iban=$proof['iban'];
			$bic=$proof['bic'];
			$second_export.= $proof['purchase_id'].',"'.$proof['email'].'","'.$coupon[0]['coupon_name'].'","'.$name.'","'.$athorestore.'","'.$address.'","'.$postcode.'","'.$city.'","'.$img.'","'.$proof['upload_proof_date'].'","'.$clienttype.'","'.$iban.'","'.$bic.'","'.$proof['robot_serial_no'].'","'.$status.'"'."\n";
		
		}
		
		$userid=$_SESSION['admin_user']['id'];
		
		$name = 'offer_robot'.date('Ymdhis');
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
	
	/*public function update()
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
	}*/
	
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
							$html = $this->load->view('mail/pdftemplate',$array,true);
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
							//start mailjet
							$file_encoded = base64_encode(file_get_contents('upload/pdf/'.$filename));
							$settings=$this->Mdl_Settings->GetRecord();
							$apikey = $settings[0]['username'];
							$apisecret = $settings[0]['password'];
							$mj = new \Mailjet\Client($apikey, $apisecret,true,['version' => 'v3.1']);
							
							$body = [
								'Messages' => [
									[
										'From' => [
											'Email' => $settings[0]['from_email'],
											'Name' => "BWT"
										],
										'To' => [
											[
												'Email' => $toEmail,
												'Name' => "BWT User"
											]
										],
										'Subject' => "Coupon Code Successfully Approved",
										'TextPart' => "Coupon Code Successfully Approved",
										'HTMLPart' => "Coupon Code Successfully Approved",
										'Attachments'=> [
											[
												'ContentType' => 'application/pdf',
												'Filename' => $filename,
												'Base64Content' => $file_encoded
											]	
										]
									]
								]
							];
							$response = $mj->post(Resources::$Email, ['body' => $body]);
							if ($response->success()) {
								//var_dump($response->getData());
								if($siteLang=='english'){
									$this->session->set_flashdata('success','Coupon Code Successfully Approved' ); 
								}else{
									$this->session->set_flashdata('success','Code de coupon approuvé avec succès' ); 
								}
							} else {
								//var_dump($response->getStatus());
								if($siteLang=='english'){
									$this->session->set_flashdata('error','Error while updating Coupon Code!' );
								}else{
									$this->session->set_flashdata('error','Erreur lors de la mise à jour du code de coupon!' );
								}
							}
							//end mailjet
							
							//start email
							/*$email = new \SendGrid\Mail\Mail(); 
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
							} catch (Exception $e) {
								//echo 'Caught exception: '. $e->getMessage() ."\n";
								if($siteLang=='english'){
									$this->session->set_flashdata('error','Error while updating Coupon Code!' );
								}else{
									$this->session->set_flashdata('error','Erreur lors de la mise à jour du code de coupon!' );
								}
							}
							//end email*/
							redirect('admin/proofcover');
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
						//start mailjet
						$settings=$this->Mdl_Settings->GetRecord();
						$apikey = $settings[0]['username'];
						$apisecret = $settings[0]['password'];
						$mj = new \Mailjet\Client($apikey, $apisecret,true,['version' => 'v3.1']);
						$body = [
							'Messages' => [
								[
									'From' => [
										'Email' => $settings[0]['from_email'],
										'Name' => "BWT"
									],
									'To' => [
										[
											'Email' => $toEmail,
											'Name' => "BWT User"
										]
									],
									'Subject' => "Coupon Code is Rejected",
									'TextPart' => "Coupon Code is Rejected",
									'HTMLPart' => "Coupon Code is Rejected"
								]
							]
						];
						$response = $mj->post(Resources::$Email, ['body' => $body]);
						if ($response->success()) {
							//var_dump($response->getData());
							if($siteLang=='english'){
								$this->session->set_flashdata('success','Coupon Code is Rejected' ); 
							}else{
								$this->session->set_flashdata('success','Le code de coupon est rejeté' ); 
							}
						} else {
							//var_dump($response->getStatus());die;
							if($siteLang=='english'){
								$this->session->set_flashdata('error','Error while rejecting Coupon Code!' );
							}else{
								$this->session->set_flashdata('error','Erreur lors du rejet du code de coupon!' );
							}
						}
						//end mailjet
							
						/*$email = new \SendGrid\Mail\Mail(); 
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
						} catch (Exception $e) {
							//echo 'Caught exception: '. $e->getMessage() ."\n";
							if($siteLang=='english'){
								$this->session->set_flashdata('error','Error while rejecting Coupon Code!' );
							}else{
								$this->session->set_flashdata('error','Erreur lors du rejet du code de coupon!' );
							}
						}*/
						redirect('admin/proofcover');
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
	
	public function finalupdate()
	{
		$siteLang = $this->session->userdata('site_lang');
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			if( isset($_POST['Approved']) && !empty($_POST['Approved']) ){
				$status = 1;
			}
			if( isset($_POST['Rejected'])  && !empty($_POST['Rejected']) ){
				$status = 2;
			}
			if($status==1){
				$id = $_GET['purchase'];
				$coupon_list_code = (isset($_POST['coupon'])) ? $_POST['coupon'] : '';
				if(!empty($id) && !empty($status) && !empty($coupon_list_code)){
					$proofs=$this->Mdl_ProofCover->GetProofofcoupon(array('purchase_id'=>$id));
					$store_id = $proofs[0]['store_id'];
					if(!empty($proofs[0]['coupon_list_code'])){
						$used = array('used_coupon'=>0);
						$this->Mdl_Storecoupon->updatecouponcode($used,array('coupon_code'=>$proofs[0]['coupon_list_code']));
					}
					$toEmail = $proofs[0]['email'];
					$today = date('Y-m-d H:i:s');
					$cron_date = date("Y-m-d", strtotime( "$today +7 day" ) ); // PHP:  2009-03-04
					$update = array(
						'coupon_list_code'=>$coupon_list_code,
						'status'=>$status,
						'coupon_status_date'=>$today,
						'cron_status'=>0,
						'cron_date'=>$cron_date
					);
					$data = array('used_coupon'=>1);
					if($status==1){
						$this->Mdl_Storecoupon->updatecouponcode($data,array('coupon_code'=>$coupon_list_code));
						if($this->Mdl_ProofCover->update($update,array('purchase_id'=>$id))){
							//get coupon code details
							$get_proof=$this->Mdl_ProofCover->GetCouponCodeDetails($coupon_list_code);
							$today = date('Y-m-d');
							$validity_date = $get_proof['validity_date'];
							if($today<=$validity_date){
								$array = array('proof'=>$get_proof);
								//pdf genrate code
								$get_templates_pdf=$this->Mdl_Template->GetRecordUsers(array('id'=>8));
								$get_pdf=$this->Mdl_Template->GetRecordUsers(array('id'=>10));
								if(!empty($get_templates_pdf)){
									$Username = $get_proof['firstname'].' '.$get_proof['lastname'];
									$template_subject = $get_templates_pdf[0]['template_subject'];
									$changepdf = str_replace("Username",$Username, $get_templates_pdf[0]['template']);
									$pdf = str_replace("coupon_price",$get_proof['coupon_price'], $changepdf);
									/*pdf*/
									$pdfformat1 = str_replace("[firstname]",$get_proof['firstname'], $get_pdf[0]['template']);
									$pdfformat2 = str_replace("[lastname]",$get_proof['lastname'], $pdfformat1);
									$pdfformat3 = str_replace("[email]",$get_proof['email'], $pdfformat2);
									$pdfformat4 = str_replace("[coupon_name]",$get_proof['coupon_name'], $pdfformat3);
									$pdfformat5 = str_replace("[coupon_price]",$get_proof['coupon_price'], $pdfformat4);
									$pdfformat6 = str_replace("[coupon_list_code]",$get_proof['coupon_list_code'], $pdfformat5);
									$pdfformat7 = str_replace("[store_name]",$get_proof['store_name'], $pdfformat6);
									$pdfformat8 = str_replace("[store_address1]",$get_proof['store_address1'], $pdfformat7);
									$pdfformat9 = str_replace("[store_postcode]",$get_proof['store_postcode'], $pdfformat8);
									$pdfformat10 = str_replace("[store_city]",$get_proof['store_city'], $pdfformat9);
								}else{
									$template_subject = "Code de coupon approuvé avec succès";
									$pdfformat10 = $this->load->view('mail/pdftemplate',$array,true);
								}
								//echo $pdf;die;
								$mpdf = new \Mpdf\Mpdf();
								$mpdf->WriteHTML($pdfformat10);
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
								$file_encoded = base64_encode(file_get_contents('upload/pdf/'.$filename));
								//start mailjet
								$settings=$this->Mdl_Settings->GetRecord();
								$apikey = $settings[0]['username'];
								$apisecret = $settings[0]['password'];
								$mj = new \Mailjet\Client($apikey, $apisecret,true,['version' => 'v3.1']);
								$body = [
									'Messages' => [
										[
											'From' => [
												'Email' => $settings[0]['from_email'],
												'Name' => "BWT"
											],
											'To' => [
												[
													'Email' => $toEmail,
													'Name' => "BWT User"
												]
											],
											'Subject' => $template_subject,
											'TextPart' => '',
											'HTMLPart' => $pdf,
											'Attachments'=> [
												[
													'ContentType' => 'application/pdf',
													'Filename' => $filename,
													'Base64Content' => $file_encoded
												]	
											]
										]
									]
								];
								/*$get_thank=$this->Mdl_Template->GetRecordUsers(array('id'=>18));
								$subject = $get_thank[0]['template_subject'];
								$thankyou = $get_thank[0]['template'];
								$body1 = [
									'Messages' => [
										[
											'From' => [
												'Email' => $settings[0]['from_email'],
												'Name' => "BWT"
											],
											'To' => [
												[
													'Email' => $toEmail,
													'Name' => "BWT User"
												]
											],
											'Subject' => $subject,
											'TextPart' => '',
											'HTMLPart' => $thankyou
										]
									]
								];
								$response1 = $mj->post(Resources::$Email,['body'=>$body1]);
								$response1->success();*/
								$response = $mj->post(Resources::$Email,['body'=>$body]);
								if ($response->success()) {
									//var_dump($response->getData());
									if($siteLang=='english'){
										$this->session->set_flashdata('success','Coupon Code Successfully Approved' ); 
									}else{
										$this->session->set_flashdata('success','Code de coupon approuvé avec succès' ); 
									}
								} else {
									//var_dump($response->getStatus());
									if($siteLang=='english'){
										$this->session->set_flashdata('error','Error while updating Coupon Code!' );
									}else{
										$this->session->set_flashdata('error','Erreur lors de la mise à jour du code de coupon!' );
									}
								}
								redirect('admin/proofcover');
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
				}else{
					if($siteLang=='english'){
						$this->session->set_flashdata('error','Please Admin set Store coupon code details!' );
					}else{
						$this->session->set_flashdata('error','Veuillez définir les détails du code de coupon du magasin!' );
					}
					redirect('admin/proofcover');
				}
			}else{
				if($status==2){
					$id = $_GET['purchase'];
					$coupon_list_code = $_POST['coupon'];
					//$template = $_POST['template'];
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
							
							$settings=$this->Mdl_Settings->GetRecord();
							$apikey = $settings[0]['username'];
							$apisecret = $settings[0]['password'];
							$mj = new \Mailjet\Client($apikey, $apisecret,true,['version' => 'v3.1']);
							$body = [
								'Messages' => [
									[
										'From' => [
											'Email' => $settings[0]['from_email'],
											'Name' => "BWT"
										],
										'To' => [
											[
												'Email' => $toEmail,
												'Name' => "BWT"
											]
										],
										'Subject' => "Coupon Code is Rejected",
										'TextPart' => "Coupon Code is Rejected",
										'HTMLPart' => "Coupon Code is Rejected"
									]
								]
							];
							$response = $mj->post(Resources::$Email, ['body' => $body]);
							if ($response->success()) {
								//var_dump($response->getData());
								if($siteLang=='english'){
									$this->session->set_flashdata('success','Coupon Code is Rejected' ); 
								}else{
									$this->session->set_flashdata('success','Le code de coupon est rejeté' ); 
								}
							} else {
								//var_dump($response->getStatus());die;
								if($siteLang=='english'){
									$this->session->set_flashdata('error','Error while rejecting Coupon Code!' );
								}else{
									$this->session->set_flashdata('error','Erreur lors du rejet du code de coupon!' );
								}
							}
							redirect('admin/proofcover');
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
	
	public function rejectproofcover(){
		$siteLang = $this->session->userdata('site_lang');
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			$id = $_POST['purchase'];
			$status = $_POST['status'];
			$template = $_POST['template'];
			$data = array('template'=>$template);
			$get_templates=$this->Mdl_Template->GetRecordUsers(array('id'=>21));
			$template_subject = $get_templates[0]['template_subject'];
			$html = str_replace("[content]",$template, $get_templates[0]['template']);
			//$html = $this->load->view('mail/template', $data, true);
			$proofs=$this->Mdl_ProofCover->GetProofofcoupon(array('purchase_id'=>$id));
			if(!empty($proofs[0])){
				$toEmail = $proofs[0]['email'];
				$update = array(
					'status'=>$status,
					'coupon_status_date'=>date('Y-m-d H:i:s')
				);
				if($this->Mdl_ProofCover->update($update,array('purchase_id'=>$id))){
					$settings=$this->Mdl_Settings->GetRecord();
					$apikey = $settings[0]['username'];
					$apisecret = $settings[0]['password'];
					$mj = new \Mailjet\Client($apikey, $apisecret,true,['version' => 'v3.1']);
					$body = [
						'Messages' => [
							[
								'From' => [
									'Email' => $settings[0]['from_email'],
									'Name' => "BWT"
								],
								'To' => [
									[
										'Email' => $toEmail,
										'Name' => "BWT User"
									]
								],
								'Subject' => $template_subject,
								'TextPart' => "",
								'HTMLPart' => $html
							]
						]
					];
					/*$get_thank=$this->Mdl_Template->GetRecordUsers(array('id'=>18));
					$subject = $get_thank[0]['template_subject'];
					$thankyou = $get_thank[0]['template'];
					$body1 = [
						'Messages' => [
							[
								'From' => [
									'Email' => $settings[0]['from_email'],
									'Name' => "BWT"
								],
								'To' => [
									[
										'Email' => $toEmail,
										'Name' => "BWT User"
									]
								],
								'Subject' => $subject,
								'TextPart' => '',
								'HTMLPart' => $thankyou
							]
						]
					];
					$response1 = $mj->post(Resources::$Email,['body'=>$body1]);
					$response1->success();*/
					$response = $mj->post(Resources::$Email, ['body' => $body]);
					if ($response->success()) {
						if($siteLang=='english'){
							$this->session->set_flashdata('success','Coupon Code is Rejected' ); 
						}else{
							$this->session->set_flashdata('success','Le code de coupon est rejeté' ); 
						}
					} else {
						//var_dump($response->getStatus());die;
						if($siteLang=='english'){
							$this->session->set_flashdata('error','Error while rejecting Coupon Code!' );
						}else{
							$this->session->set_flashdata('error','Erreur lors du rejet du code de coupon!' );
						}
					}
					redirect('admin/proofcover');
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
		$siteLang = $this->session->userdata('site_lang');
		$coupon_list_code = 'rgMYA4WX';
		$get_proof=$this->Mdl_ProofCover->GetCouponCodeDetails($coupon_list_code);
		$get_templates=$this->Mdl_Template->GetRecordUsers(array('id'=>5));
		$array = array('proof'=>$get_proof);
		//pdf genrate code
		$mpdf = new \Mpdf\Mpdf();
		$html = $this->load->view('mail/conformation-contract',$array,true);
		//$html = $this->load->view('mail/email-felicitation',$array,true);
		//$html = $this->load->view('mail/email-coupon-reduction',$array,true);
		//$html = $this->load->view('mail/email-confirmation-inscription',$array,true);
		//$html = $get_templates[0]['template'];
		echo $html;
		$mpdf->WriteHTML($html);
		$filename = 'BWT_'.$coupon_list_code.'.pdf';
		$path = FCPATH.'upload/pdf/';
		if(is_dir($path)){
			$mpdf->Output($path.''.$filename, 'F');
		}else{
			if($siteLang=='english'){
				echo 'Error while updating Coupon Code!';
			}else{
				echo 'Erreur lors de la mise à jour du code de coupon!';
			}
		}
		sleep(2);
		//start mailjet
		$file_encoded = base64_encode(file_get_contents('upload/pdf/'.$filename));
		$settings=$this->Mdl_Settings->GetRecord();
		$apikey = $settings[0]['username'];
		$apisecret = $settings[0]['password'];
		$mj = new \Mailjet\Client($apikey, $apisecret,true,['version' => 'v3.1']);
		
		$body = [
			'Messages' => [
				[
					'From' => [
						'Email' => $settings[0]['from_email'],
						'Name' => "BWT"
					],
					'To' => [
						[
							'Email' => 'dev3.ts3@gmail.com',
							'Name' => "BWT User"
						]
					],
					'Subject' => "Coupon Code Successfully Approved",
					'TextPart' => "Coupon Code Successfully Approved",
					'HTMLPart' => "Coupon Code Successfully Approved",
					'Attachments'=> [
						[
							'ContentType' => 'application/pdf',
							'Filename' => $filename,
							'Base64Content' => $file_encoded
						]	
					]
				]
			]
		];
		$response = $mj->post(Resources::$Email, ['body' => $body]);
		if ($response->success()) {
			var_dump($response->getData());
		} else {
			var_dump($response->getStatus());
		}
	}
	
}
