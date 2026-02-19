<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use \Mailjet\Resources;

class Draw extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_User');
        $this->load->model('Mdl_Draw');
        $this->load->model('Mdl_Storecoupon');
        $this->load->model('Mdl_Coupon');
        $this->load->model('Mdl_Store');
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
			$draws=$this->Mdl_Draw->GetProofofcoupon();
			$couponlist=$this->Mdl_Storecoupon->GetRecordcouponcodes();
			$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/draw/list',
						'draws'=>$draws,
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
				$draws=$this->Mdl_Draw->GetProofofcoupon(array('draw_id'=>$id));
				if($draws[0]['another_store_handle']!=0){
					$couponcodes=$this->Mdl_Storecoupon->GetRecordcouponcodes(array('store_id'=>$draws[0]['another_store_handle'],'coupon_id'=>7,'used_coupon'=>0));
				}else{	
					$couponcodes=$this->Mdl_Storecoupon->GetRecordcouponcodes(array('store_id'=>$draws[0]['store_id'],'coupon_id'=>7,'used_coupon'=>0));
				}
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/draw/edit',
						'draws'=>$draws,
						'couponcodes'=>$couponcodes
						);
				$this->load->view('admin/front',$data);
			}else{
				redirect('admin/draw');
			}
		}
	}
	
	public function export_draw(){
		$result=array();
		$second_export = chr(0xEF).chr(0xBB).chr(0xBF)."id,Username,Stores,Another Stores,Address,Postcode,City,Upload Draw,Draw Date,Client Type,Status\n";
		$draws=$this->Mdl_Draw->GetProofofcoupon();
		$couponlist=$this->Mdl_Storecoupon->GetRecordcouponcodes();
		foreach($draws as $draw){
			if($draw['store_id']!=0){
				$anothergetstores = $this->Mdl_Store->GetRecordUsers(array('id'=>$draw['store_id']));
				$name = $anothergetstores[0]['store_name'];
			}else{
				$name = '';
			}
			if($name == 'AUTRE'){ 
				$stroname=strtoupper($draw['store_name_additional']);
				$athorestore=$stroname;
				$address=$draw['address']."".$draw['addition_address'];
				$postcode=$draw['zipcode'];
				$city=$draw['city'];
				 } else{
					$athorestore='';
					$address='';
					$postcode='';
					$city='';

				 }
			$img = base_url('upload').'/draw/'.$draw['upload_draw'];
			if($draw['status']==1){
				$status = 'Approved';
			}elseif($draw['status']==2){
				$status = 'Rejected';
			}else{
				$status = 'Pending';
			}
			$clienttype=''; 
			if($draw['clienttype'] == 'particulier')
			{ 
				$clienttype='Particulier'; 
			} 
			else if($draw['clienttype'] == 'pro')
			{ 
				$clienttype='Professionnal';  
			} 
			else { 
				$clienttype='NULL'; 
			} 
			$iban=$draw['iban'];
			$bic=$draw['bic'];
				$second_export.= $draw['draw_id'].',"'.$draw['email'].'","'.$name.'","'.$athorestore.'","'.$address.'","'.$postcode.'","'.$city.'","'.$img.'","'.$draw['upload_draw_date'].'","'.$clienttype.'","'.$status.'"'."\n";
	
				}
		
		
		$userid=$_SESSION['admin_user']['id'];
		
		$name = 'gpcastellet'.date('Ymdhis');
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
					$proofs=$this->Mdl_Draw->GetProofofcoupon(array('draw_id'=>$id));
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
						if($this->Mdl_Draw->update($update,array('draw_id'=>$id))){
							//get coupon code details
							$get_proof=$this->Mdl_Draw->GetCouponCodeDetails($coupon_list_code);
							 //echo '<pre>';print_r($get_proof);
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
								redirect('admin/draw');
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
								redirect('admin/draw');
							} catch (Exception $e) {
								//echo 'Caught exception: '. $e->getMessage() ."\n";
								if($siteLang=='english'){
									$this->session->set_flashdata('error','Error while updating Coupon Code!' );
								}else{
									$this->session->set_flashdata('error','Erreur lors de la mise à jour du code de coupon!' );
								}
								redirect('admin/draw');
							}
						}else{
							if($siteLang=='english'){
								$this->session->set_flashdata('error','Error while updating Coupon Code!' );
							}else{
								$this->session->set_flashdata('error','Erreur lors de la mise à jour du code de coupon!' );
							}
							redirect('admin/draw');
						}
					}
				}
			}else{
				if($_POST['status']==2){
					$id = $_POST['purchase'];
					$coupon_list_code = $_POST['coupon'];
					$status = $_POST['status'];
					$template = $_POST['template'];
					$proofs=$this->Mdl_Draw->GetProofofcoupon(array('draw_id'=>$id));
					if(!empty($proofs[0])){
						$toEmail = $proofs[0]['email'];
						$update = array(
							'coupon_list_code'=>$coupon_list_code,
							'status'=>$status,
							'coupon_status_date'=>date('Y-m-d H:i:s')
						);
						$data = array('used_coupon'=>2);
						$this->Mdl_Storecoupon->updatecouponcode($data,array('coupon_code'=>$coupon_list_code));
						if($this->Mdl_Draw->update($update,array('draw_id'=>$id))){
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
								$this->session->set_flashdata('success','Coupon Code is Rejected' ); 
								redirect('admin/draw');
							} catch (Exception $e) {
								//echo 'Caught exception: '. $e->getMessage() ."\n";
								if($siteLang=='english'){
									$this->session->set_flashdata('error','Error while rejecting Coupon Code!' );
								}else{
									$this->session->set_flashdata('error','Erreur lors du rejet du code de coupon!' );
								}
								redirect('admin/draw');
							}
						}else{
							if($siteLang=='english'){
								$this->session->set_flashdata('error','Error while rejecting Coupon Code!' );
							}else{
								$this->session->set_flashdata('error','Erreur lors du rejet du code de coupon!' );
							}
							redirect('admin/draw');
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
				$removecoupon=$this->Mdl_Draw->remove(array('draw_id'=>$id));
				if(empty($removecoupon))
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('error','Error while deleting Draw Proof!');
					}else{
						$this->session->set_flashdata('error','Erreur lors de la suppression de Draw Proof!');
					}
					redirect('admin/draw');
				}
				else
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('success','Draw Proof Remove Successfully');
					}else{
						$this->session->set_flashdata('success','Tirer preuve supprimer supprimer avec succès');
					}
					redirect('admin/draw');
				}
			}
			else
			{
				if($siteLang=='english'){
					$this->session->set_flashdata('error','Error while deleting Draw Proof!');
				}else{
					$this->session->set_flashdata('error','Erreur lors de la suppression de Draw Proof!');
				}
				redirect('admin/draw');
			}
		}
	}
	
	public function finalupdate()
	{
		$siteLang = $this->session->userdata('site_lang');
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			//echo '<prE>';print_r($_POST);die;
			if( isset($_POST['Approved']) && !empty($_POST['Approved']) ){
				$status = 1;
			}
			if( isset($_POST['Rejected'])  && !empty($_POST['Rejected']) ){
				$status = 2;
			}
			if($status==1){
				$id = $_GET['draw'];
				$coupon_list_code = (isset($_POST['coupon'])) ? $_POST['coupon'] : '';
				if(!empty($id) && !empty($status) && !empty($coupon_list_code)){
					$proofs=$this->Mdl_Draw->GetProofofcoupon(array('draw_id'=>$id));
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
						if($this->Mdl_Draw->update($update,array('draw_id'=>$id))){
							//get coupon code details
							$get_proof=$this->Mdl_Draw->GetCouponCodeDetails($coupon_list_code);
							//echo '<pre>';print_r($get_proof);die;
							$today = date('Y-m-d');
							$validity_date = $get_proof['validity_date'];
							if($today<=$validity_date){
								$array = array('proof'=>$get_proof);
								//pdf genrate code
								$mpdf = new \Mpdf\Mpdf();
								$get_templates_pdf=$this->Mdl_Template->GetRecordUsers(array('id'=>9));
								$get_pdf=$this->Mdl_Template->GetRecordUsers(array('id'=>10));
								if(!empty($get_templates_pdf)){
									$Username = $get_proof['firstname'].' '.$get_proof['lastname'];
									$template_subject = $get_templates_pdf[0]['template_subject'];
									$changepdf = str_replace("Username",$Username, $get_templates_pdf[0]['template']);
									$pdf = str_replace("draw_date",$get_proof['upload_draw_date'], $changepdf);
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
									redirect('admin/draw');
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
								redirect('admin/draw');
							}else{
								if($siteLang=='english'){
									$this->session->set_flashdata('success','Coupon Code Successfully Approved, But not User Receive Mail' );
								}else{
									$this->session->set_flashdata('success',"Code de coupon approuvé avec succès, mais non reçu par l'utilisateur" );
								}
								redirect('admin/draw');
							}
						}else{
							if($siteLang=='english'){
								$this->session->set_flashdata('error','Error while updating Coupon Code!' );
							}else{
								$this->session->set_flashdata('error','Erreur lors de la mise à jour du code de coupon!' );
							}
							redirect('admin/draw');
						}
					}
				}else{
					if($siteLang=='english'){
						$this->session->set_flashdata('error','Please Admin set Store coupon code details!' );
					}else{
						$this->session->set_flashdata('error','Veuillez définir les détails du code de coupon du magasin!' );
					}
					redirect('admin/draw');
				}
			}else{
				if($status==2){
					$id = $_GET['draw'];
					$coupon_list_code = $_POST['coupon'];
					//$template = $_POST['template'];
					$proofs=$this->Mdl_Draw->GetProofofcoupon(array('draw_id'=>$id));
					if(!empty($proofs[0])){
						$toEmail = $proofs[0]['email'];
						$update = array(
							'coupon_list_code'=>$coupon_list_code,
							'status'=>$status,
							'coupon_status_date'=>date('Y-m-d H:i:s')
						);
						$data = array('used_coupon'=>2);
						$this->Mdl_Storecoupon->updatecouponcode($data,array('coupon_code'=>$coupon_list_code));
						if($this->Mdl_Draw->update($update,array('draw_id'=>$id))){
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
							redirect('admin/draw');
						}else{
							if($siteLang=='english'){
								$this->session->set_flashdata('error','Error while rejecting Coupon Code!' );
							}else{
								$this->session->set_flashdata('error','Erreur lors du rejet du code de coupon!' );
							}
							redirect('admin/draw');
						}
					}
				}
			}
		}
	}
	
	public function rejectdraw(){
		$siteLang = $this->session->userdata('site_lang');
		if(empty($_SESSION['admin_user'])){
			redirect('admin');
		}else{
			$id = $_POST['draw'];
			$status = $_POST['status'];
			$template = $_POST['template'];
			$data = array('template'=>$template);
			$get_templates=$this->Mdl_Template->GetRecordUsers(array('id'=>21));
			$template_subject = $get_templates[0]['template_subject'];
			$html = str_replace("[content]",$template, $get_templates[0]['template']);
			//$html = $this->load->view('mail/template', $data, true);
			$proofs=$this->Mdl_Draw->GetProofofcoupon(array('draw_id'=>$id));
			if(!empty($proofs[0])){
				$toEmail = $proofs[0]['email'];
				$update = array(
					'status'=>$status,
					'coupon_status_date'=>date('Y-m-d H:i:s')
				);
				if($this->Mdl_Draw->update($update,array('draw_id'=>$id))){
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
					redirect('admin/draw');
				}else{
					if($siteLang=='english'){
						$this->session->set_flashdata('error','Error while rejecting Coupon Code!' );
					}else{
						$this->session->set_flashdata('error','Erreur lors du rejet du code de coupon!' );
					}
					redirect('admin/draw');
				}
			}
		}
	}
}
