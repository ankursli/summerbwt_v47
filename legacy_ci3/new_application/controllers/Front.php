<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';
// require '/var/www/clients/client0/web24/web/phpmailer/Exception.php';
// require '/var/www/clients/client0/web24/web/phpmailer/PHPMailer.php';
// require '/var/www/clients/client0/web24/web/phpmailer/SMTP.php';
require getcwd().'/phpmailer/Exception.php';
require getcwd().'/phpmailer/PHPMailer.php';
require getcwd().'/phpmailer/SMTP.php';

use \Mailjet\Resources;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



class Front extends CI_Controller {

	
	public function __construct(){

        parent::__construct();

        $this->load->model('Mdl_Block');

        $this->load->model('Mdl_Menu');

        $this->load->model('Mdl_User');

        $this->load->model('Mdl_Proof');

        $this->load->model('Mdl_ProofCover');

        $this->load->model('Mdl_Draw');

        $this->load->model('Mdl_Store');

        $this->load->model('Mdl_StoreCover');

        $this->load->model('Mdl_Coupon');

        $this->load->model('Mdl_Cover');

        $this->load->model('Mdl_Refund');

        $this->load->model('Mdl_Clientsupport');

        $this->load->model('Mdl_Country');

        $this->load->model('Mdl_Settings');

        $this->load->model('Mdl_Template');

        $this->load->helper(array('form','url','language'));

        $this->load->library(array('session', 'form_validation', 'email'));

		$siteLang = $this->session->userdata('site_lang');

		if (empty($siteLang)) {

			$this->session->set_userdata('site_lang','french');

		}

		

		/*$ip=$_SERVER['REMOTE_ADDR'];

		$details = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=$ip"));

		$country=$details->geoplugin_countryCode;

		$countries=$this->Mdl_Country->GetFrontRecord(array('is_allow'=>1));

		$array = array();

		foreach($countries as $co){

			$array[] = $co['country_code'];

		}

		if (in_array($country, $array)){

			//echo 'allowed';

			//$this->load->view('front/403');

		}else{

			$this->load->view('front/403');

		}

		/*if($country==="FR" || $country==="IN"){

			//echo 'allowed';

		}else{

			$this->load->view('front/403');die;

		}*/

    }

	

    public function index(){	
		if(!empty($_SESSION['front_user'])){

			redirect('dashboard');

		}else{
			$sidemenu_without_login=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu_without'));
			$footermenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'footer_menu'));	
			$data=array('success'=>$this->session->flashdata('success'),

					'error'=>$this->session->flashdata('error'),

					'sidemenu'=>$sidemenu_without_login,

					'footermenu'=>$footermenu,

					'main_content'=>'front/register'

					);

			$this->load->view('front/template',$data);

		}
		
    }

	public function thankyou_op1()
	{
		// $sidemenu_without_login=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu_without'));
		$sidemenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu'));
		$footermenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'footer_menu'));	
		$data=array('success'=>$this->session->flashdata('success'),

					'error'=>$this->session->flashdata('error'),

					'sidemenu'=>$sidemenu,

					'footermenu'=>$footermenu,

					'main_content'=>'front/thankyou_op1'

					);

		$this->load->view('front/template',$data);
		
    }
	public function thankyou_op2()
	{
		// $sidemenu_without_login=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu_without'));
		$sidemenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu'));
		$footermenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'footer_menu'));

		$data=array('success'=>$this->session->flashdata('success'),

					'error'=>$this->session->flashdata('error'),

					'sidemenu'=>$sidemenu,

					'footermenu'=>$footermenu,

					'main_content'=>'front/thankyou_op2'

					);

		$this->load->view('front/template',$data);

    }
	public function thankyou_op3()
	{
		// $sidemenu_without_login=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu_without'));
		$sidemenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu'));
		$footermenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'footer_menu'));

		$data=array('success'=>$this->session->flashdata('success'),

					'error'=>$this->session->flashdata('error'),

					'sidemenu'=>$sidemenu,

					'footermenu'=>$footermenu,

					'main_content'=>'front/thankyou_op3'

					);

		$this->load->view('front/template',$data);

    }
	
	public function home() {
		$sidemenu_without_login=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu_without'));
		$sidemenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu'));
		$footermenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'footer_menu'));
		if(!empty($_SESSION['front_user'])){
			$siteLang = $this->session->userdata('site_lang');
			$block=$this->Mdl_Block->GetRecordBlocks(array('language'=>$siteLang, 'status' => 'active'));
			$block_1_offset = '';
			$block_2_offset = '';
			$block_3_offset = '';
			foreach($block as $bloc){
				if($bloc['block'] == 'block-1'){
					if(count($block)=='2'){
					$block_1_offset = 'offset-lg-2';
					}elseif(count($block)=='1'){
					$block_1_offset = 'offset-lg-4';
					}elseif(count($block)=='3'){
						$block_1_offset = 'no-offset';
					}
				}
			}
			if($block_1_offset == ''){
				foreach($block as $bloc){
					if($bloc['block'] == 'block-2'){
						if(count($block)=='2'){
						$block_2_offset = 'offset-lg-2';
						}elseif(count($block)=='1'){
						$block_2_offset = 'offset-lg-4';
						}else{
							$block_2_offset = 'no-offset';
						}
					}
				}
			}
			if($block_1_offset == '' && $block_2_offset == ''){
				foreach($block as $bloc){
					if($bloc['block'] == 'block-2'){
						if(count($block)=='1'){
						$block_3_offset = 'offset-lg-4';
						}else{
							$block_3_offset = 'no-offset';
						}
					}
				}
			}
			$blolckcount = count($block);
			$data=array('success'=>$this->session->flashdata('success'),

						'error'=>$this->session->flashdata('error'),

						'main_content'=>'front/home',

						'sidemenu'=>$sidemenu,

						'footermenu'=>$footermenu,
						
						'block'=>$block,

						'blockcount' => $blolckcount,
						'blockoffset1' => $block_1_offset,
						'blockoffset2' => $block_2_offset,
						'blockoffset3' => $block_3_offset

						);

			$this->load->view('front/template',$data);
		}else{
			$siteLang = $this->session->userdata('site_lang');
			$block=$this->Mdl_Block->GetRecordBlocks(array('language'=>$siteLang, 'status' => 'active'));
			$block_1_offset = '';
			$block_2_offset = '';
			$block_3_offset = '';
			foreach($block as $bloc){
				if($bloc['block'] == 'block-1'){
					if(count($block)=='2'){
					$block_1_offset = 'offset-lg-2';
					}elseif(count($block)=='1'){
					$block_1_offset = 'offset-lg-4';
					}elseif(count($block)=='3'){
						$block_1_offset = 'no-offset';
					}
				}
			}
			if($block_1_offset == ''){
				foreach($block as $bloc){
					if($bloc['block'] == 'block-2'){
						if(count($block)=='2'){
						$block_2_offset = 'offset-lg-2';
						}elseif(count($block)=='1'){
						$block_2_offset = 'offset-lg-4';
						}else{
							$block_2_offset = 'no-offset';
						}
					}
				}
			}
			if($block_1_offset == '' && $block_2_offset == ''){
				foreach($block as $bloc){
					if($bloc['block'] == 'block-2'){
						if(count($block)=='1'){
						$block_3_offset = 'offset-lg-4';
						}else{
							$block_3_offset = 'no-offset';
						}
					}
				}
			}
			$blolckcount = count($block);
			$data=array('success'=>$this->session->flashdata('success'),

						'error'=>$this->session->flashdata('error'),

						'main_content'=>'front/home',

						'sidemenu'=>$sidemenu_without_login,

						'footermenu'=>$footermenu,
						
						'block'=>$block,

						'blockcount' => $blolckcount,
						'blockoffset1' => $block_1_offset,
						'blockoffset2' => $block_2_offset,
						'blockoffset3' => $block_3_offset

						);

			$this->load->view('front/template',$data);
		}
		
    }

	// public function header(){

	// 	$menu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu'));
	// 	$data=array('success'=>$this->session->flashdata('success'),

	// 				'error'=>$this->session->flashdata('error'),

	// 				'main_content'=>'front/header',
					
	// 				'menu'=>$menu

	// 				);

	// 	$this->load->view('front/template',$data);
	// }

	// public function footer(){
		
	// 	$menu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'footer_menu'));
	// 	$data=array('success'=>$this->session->flashdata('success'),

	// 				'error'=>$this->session->flashdata('error'),

	// 				'main_content'=>'front/footer',
					
	// 				'menu'=>$menu

	// 				);

	// 	$this->load->view('front/template',$data);
	// }

	public function login() {

		if(!empty($_SESSION['front_user'])){

			redirect(base_url());

		}else{
			$sidemenu_without_login=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu_without'));
			$footermenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'footer_menu'));	
			$data=array('success'=>$this->session->flashdata('success'),

						'error'=>$this->session->flashdata('error'),

						'sidemenu'=>$sidemenu_without_login,

						'footermenu'=>$footermenu,

						'main_content'=>'front/login'

						);
        	$this->load->view('front/template',$data);

		}

    }

	

	public function forgotpassword() {
		$sidemenu_without_login=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu_without'));
		$footermenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'footer_menu'));	
		$data=array('success'=>$this->session->flashdata('success'),

					'error'=>$this->session->flashdata('error'),

					'sidemenu'=>$sidemenu_without_login,

					'footermenu'=>$footermenu,

					'main_content'=>'front/forgotpassword'

					);

		$this->load->view('front/template',$data);	

    }

	

	/* check mail */

	public function check_email(){

		$email=$this->input->post('forgotemail'); 

		if(!empty($email)){

			$user_info=$this->Mdl_User->GetUserId(array("email"=>$email));
			$user_detail_info=$this->Mdl_User->GetUsers(array("email"=>$email));
			$user_lang = $user_detail_info['usr_lang'];
			if($user_lang == "english"){
				$lang = "en-UK";
			}else if($user_lang == "netherland"){
				$lang = "NL";
			}else {
				$lang = "fr-FR";
			}

			if(!empty($user_info))

			{

				$resetpasswordtoken=md5(uniqid(rand(), true));

				$data=array('resetpasswordtoken'=>$resetpasswordtoken);

				if($this->Mdl_User->UpdateUserByEmail($data,$email))

				{ 

					//send user an email for forgot password

					$data=array(

						'user_info'=>$user_info,

						'token'=>$resetpasswordtoken,

					);

					$settings = $this->Mdl_Settings->GetRecord();

					$apikey = $settings[0]['username'];

					$apisecret = $settings[0]['password'];

					//$get_templates=$this->Mdl_Template->GetRecordUsers(array('language'=>$lang,'type'=>'forgotpassword'));
					
					
					$langcurrent=$this->input->post('langcurrent');
					if($langcurrent=='english'){
							$get_templates=$this->Mdl_Template->GetRecordUsers(array('id'=>27));
					}
					else{
							
							$get_templates=$this->Mdl_Template->GetRecordUsers(array('id'=>20));
					}
					
					

					$template_subject = $get_templates[0]['template_subject'];

					$url = base_url('front/resetpassword?token='.$resetpasswordtoken.'&user_id='.$user_info);

					$changeurl = str_replace("[url]",$url, $get_templates[0]['template']);

					//$html = $this->load->view('mail/resetpassword', $data, true);

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

										'Email' => $email,

										'Name' => "BWT User"

									]

								],

								'Subject' => $template_subject,

								'TextPart' => '',

								'HTMLPart' => $changeurl

							]

						]

					];

					//$response = $mj->post(Resources::$Email, ['body' => $body]);


					$this->load->library('email');
					$this->email->from($settings[0]['from_email'], 'BWT');
					$this->email->to($email,'BWT User');
					$this->email->subject($template_subject);
					$this->email->message($changeurl);
					try{
					$this->email->send();
					if($siteLang=='english'){

						$this->session->set_flashdata('success','Mail Send Successfully. Please Check Your Inbox for Reset Password.');

					}else{

						$this->session->set_flashdata('success','Envoyer un mail avec succès. Veuillez vérifier votre boîte de réception pour réinitialiser le mot de passe.');

					}

					redirect("forgotpassword");
					
					}catch(Exception $e){
						$this->session->set_flashdata('error',$e->getMessage());
						if($siteLang=='english'){

							$this->session->set_flashdata('error','Mail not send because of some issue.');

						}else{

							$this->session->set_flashdata('error',"Courrier non envoyé en raison d'un problème.");

						}

						redirect("forgotpassword");

					}





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

										'Email' => $email,

										'Name' => "BWT User"

									]

								],

								'Subject' => $template_subject,

								'TextPart' => '',

								'HTMLPart' => $changeurl

							]

						]

					];

					//$response = $mj->post(Resources::$Email, ['body' => $body]);
					$this->load->library('email');
					$this->email->from($settings[0]['from_email'], 'BWT');
					$this->email->to($email);
					$this->email->subject($template_subject);
					$this->email->message($changeurl);
					try{
					$this->email->send();
					if($siteLang=='english'){

						$this->session->set_flashdata('success','Mail Send Successfully. Please Check Your Inbox for Reset Password.');

					}else{

						$this->session->set_flashdata('success','Envoyer un mail avec succès. Veuillez vérifier votre boîte de réception pour réinitialiser le mot de passe.');

					}

					redirect("forgotpassword");
					
					}catch(Exception $e){
						$this->session->set_flashdata('error',$e->getMessage());
						if($siteLang=='english'){

							$this->session->set_flashdata('error','Mail not send because of some issue.');

						}else{

							$this->session->set_flashdata('error',"Courrier non envoyé en raison d'un problème.");

						}

						redirect("forgotpassword");
	
					}

					

				}

				else

				{

					if($siteLang=='english'){

						$this->session->set_flashdata('error','Mail not send because of some issue in token insert.');

					}else{

						$this->session->set_flashdata('error',"Le courrier n'est pas envoyé en raison d'un problème d'insertion de jeton.");

					}

					redirect("forgotpassword");

				} 

			}

			else

			{

				if($siteLang=='english'){

					$this->session->set_flashdata('error','Please Enter valid Email Address.');

				}else{

					$this->session->set_flashdata('error','Veuillez entrer une adresse email valide.');

				}

				redirect("forgotpassword");

			} 

		}

		else

		{

			if($siteLang=='english'){

				$this->session->set_flashdata('error','Please Enter Email Address.');

			}else{

				$this->session->set_flashdata('error',"S'il vous plaît entrer l'adresse e-mail.");

			}

			redirect("forgotpassword");

		}

		exit;

	}

	

	/* reset password process */

	public function resetpassword(){

		$token=$this->input->get('token');

		$id=$this->input->get('user_id');

		$userdata=array('resetpasswordtoken'=>$token);

		$user=$this->Mdl_User->GetUsers($userdata); 

		if(!empty($user))

		{

			if($user['id']==$id && $user['resetpasswordtoken']==$token)

			{

				$data=array(

					'messages'=>array('success'=> $this->session->flashdata('success'), 'error'=>$this->session->flashdata('error')),

					'main_content'=>'front/resetpassword',

					'id'=>$id,

					'token'=>$token,

				);

				$this->load->view('front/template',$data);

			}

			else

			{

				if($siteLang=='english'){

					$this->session->set_flashdata('error',"Sorry You Are Unauthorized Person.");

				}else{

					$this->session->set_flashdata('error',"Désolé, vous êtes une personne non autorisée.");

				}

				redirect("forgotpassword");

			} 

		}

		else

		{

			if($siteLang=='english'){

				$this->session->set_flashdata('error','This Link is Expire.');

			}else{

				$this->session->set_flashdata('error','Ce lien est expiré.');

			}

			redirect("forgotpassword");

		} 

	}

	

	/* update password */

	public function UpdatePassword(){

		$id=$this->input->post("id");

		$pass=$this->input->post("password");

		$cpass=$this->input->post("retypepassword");



		$this->load->helper('form');

		$this->load->library('form_validation');

		// set validation rules

		$this->form_validation->set_rules('password', "Password", 'trim|required|min_length[8]');

		$this->form_validation->set_rules('retypepassword', "Retype Password", 'trim|required|min_length[8]|matches[password]');



		if ($this->form_validation->run() === FALSE) 

		{	

			$data=array(

				'messages'=>array('success'=> $this->session->flashdata('success'), 'error'=>$this->session->flashdata('error')),

				'main_content'=>'front/resetpassword',

				'id'=>$id

			);

			$this->load->view('front/template',$data);

		}

		else

		{

			if($pass==$cpass)

			{

				$data=array(

					'password'=>md5($pass),

					'resetpasswordtoken'=>'',

				);

				if($this->Mdl_User->UpdatePassword($data,$id))

				{

					if($siteLang=='english'){

						$this->session->set_flashdata('success','Password Reset Successfully' ); 

					}else{

						$this->session->set_flashdata('success','Mot de passe réinitialisé avec succès' ); 

					}

				} 

				else

				{

					if($siteLang=='english'){

						$this->session->set_flashdata('error','Password not reset, Try again later.');

					}else{

						$this->session->set_flashdata('error',"Le mot de passe n'est pas réinitialisé, réessayez plus tard.");

					}

				}

				redirect("login");

			}

		}

	}

	

	public function checkLogin()

    {		

		$ispost=$this->input->method(TRUE);

		if($ispost=='POST')

        {

            $username=$this->input->post('email');

            $password=md5($this->input->post('password'));

		    

			$this->load->helper('form');

			$this->load->library('form_validation');

			if($siteLang=='english'){

				$this->form_validation->set_rules('email','Email','required|valid_email',array('required'=>'The Email field is required','valid_email'=>'The Email field must contain a valid email address')); 

				$this->form_validation->set_rules('password','Password','required',array('required'=>'The Password field is required')); 

			}else{

				$this->form_validation->set_rules('email','Email','required|valid_email',array('required'=>'Le champ Email est obligatoire','valid_email'=>'Le format de l email est erroné')); 

				$this->form_validation->set_rules('password','Password','required',array('required'=>'Le mot de passe est obligatoire'));

			}

		

			if ($this->form_validation->run() === FALSE) 

			{

				$data=array(

						'success'=>$this->session->flashdata('success'),

						'error'=>$this->session->flashdata('error'),

						'main_content'=>'front/login'

					);

				$this->load->view('front/template',$data);

			}

			else

			{

				$user=$this->Mdl_User->checkFrontUser($username,$password);

				if($user)

				{

					$this->session->set_userdata('front_user',$user);

					$send=$_SERVER['HTTP_REFERER'];

					?> 

				    <script>

						var redirect_to="<?php echo $send;?>"; 

						window.top.location.href = redirect_to;

				    </script>

					<?php

				}else{

					if($siteLang=='english'){

						$this->session->set_flashdata('error','Invalid Username or password!');

					}else{

						$this->session->set_flashdata('error',"Nom d'utilisateur ou mot de passe invalide!");

					}

					redirect('login');

				}

			}

		}

		else

		{

			if($siteLang=='english'){

				$this->session->set_flashdata('error','Invalid Username or password!');

			}else{

				$this->session->set_flashdata('error',"Nom d'utilisateur ou mot de passe invalide!");

			}

			redirect('login');

		}

    }



	public function dashboard()

	{ 

		if(!empty($_SESSION['front_user'])){

			/*$data=array('success'=>$this->session->flashdata('success'),

					'error'=>$this->session->flashdata('error'),

					'main_content'=>'front/dashboard'

					);

			$this->load->view('front/template',$data);*/

			//echo '<prE>';print_r($_SESSION);die;

			$this->proof_of_purchase();
			$this->proof_of_cover_purchase();

		}else{

			redirect('login');

		}

		

	}
	public function checkstring($str)
	{
		if (substr($str, 0, 1)== "-") {
			return false;
		}
		return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
	}
	

	public function createprofile()

	{

		if(empty($_SESSION['front_user'])){

			$ispost=$this->input->method(TRUE);

			if($ispost=='POST'){

				$this->load->helper('form');

				$this->load->library('form_validation');

				// set validation rules

				$siteLang = $this->session->userdata('site_lang');

				if($siteLang=='english'){

					$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.Email]',array('required'=>'The Email field is required','valid_email'=>'The Email field must contain a valid email address','is_unique'=>'The Email field must contain a unique value'));

					
					$this->form_validation->set_rules('password','Password','required',array('required'=>'The Password field is required')); 

					$this->form_validation->set_rules('firstname','First Name','required|callback_checkstring',array('required'=>'The First Name field is required', 'checkstring'=>'The firstname field must contain aplhabets only')); 
					$this->form_validation->set_rules('lastname','Last Name','trim|required|callback_checkstring',array('required'=>'The Last Name field is required', 'checkstring'=>'The lastname field must contain aplhabets only'));  
					$this->form_validation->set_rules('city','City','trim|required|callback_checkstring',array('required'=>'The City field is required', 'checkstring'=>'The City field must contain aplhabets only')); 

					$this->form_validation->set_rules('phone', "Phone Number", 'trim|required|regex_match[/^[0-9]{10}$/]');

					$this->form_validation->set_rules('country', "Country", 'trim|required');

				
					$this->form_validation->set_rules('address1', "Address 1", 'trim|required');

					$this->form_validation->set_rules('postcode','Postcode','required|regex_match[/^[0-9]{5}$/]',array('required'=>'Postcode Field is required','regex_match'=>'Please add the valid Postcode like 69001 (5 digits )'));
					

				}else{

					$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.Email]',array('required'=>'Le champ Email est obligatoire','valid_email'=>'Le format de l email est erroné','is_unique'=>'Cet email est déjà utilisé merci d en choisir un autre')); 

					$this->form_validation->set_rules('firstname','First Name','required|callback_checkstring',array('required'=>'Le prénom est obligatoire', 'checkstring'=>'Le champ du prénom ne doit contenir que des alphabets')); 
					$this->form_validation->set_rules('lastname','Last Name','trim|required|callback_checkstring',array('required'=>'Le champ Nom est obligatoire', 'checkstring'=>'Le champ nom de famille ne doit contenir que des aplhabets')); 
					$this->form_validation->set_rules('city','City','trim|required|callback_checkstring',array('required'=>'La ville est obligatoire', 'checkstring'=>'Le champ de la ville ne doit contenir que des alphabets')); 


					$this->form_validation->set_rules('password','Password','required',array('required'=>'Le mot de passe est obligatoire'));

					

					$this->form_validation->set_rules('phone','Phone Number','required|regex_match[/^[0-9]{10}$/]',array('required'=>'Le téléphone est obligatoire','regex_match'=>'s il vous plaît entrer un numéro de téléphone valide'));

					$this->form_validation->set_rules('country','Country','required',array('required'=>'Le champ Pays est obligatoire'));

					

					$this->form_validation->set_rules('address1','Address','required',array('required'=>'Le adresse est obligatoire'));

					$this->form_validation->set_rules('postcode','Postcode','required|regex_match[/^[0-9]{5}$/]',array('required'=>'Le code postal est obligatoire.','regex_match'=>'Veuillez ajouter le code postal valide comme 69001 (5 chiffres)'));

				}

				$firstname=$this->input->post('firstname');

				$lastname=$this->input->post('lastname');

				$email=$this->input->post('email');

				$password=$this->input->post('password');

				$phone=$this->input->post('phone');

				$country=$this->input->post('country');

				$city=$this->input->post('city');

				$address1=$this->input->post('address1');

				$address2=$this->input->post('address2');

				$postcode=$this->input->post('postcode');
				if(!empty($this->input->post('phone'))){
					$pattern = '/^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$/';
					$phonecheck= preg_match($pattern, $this->input->post('phone'));
					
					if($phonecheck == 0){
						if($siteLang=='english'){
							$this->session->set_flashdata('error','Please format your phone as follows: 0612131415, 0231878889…' );
						}
						else{
							$this->session->set_flashdata('error','Merci de formater votre téléphone comme suit : 0612131415, 0231878889…' );
						}

					}
				}


				if($this->form_validation->run() === FALSE){

					$data=array('success'=>$this->session->flashdata('success'),

							'error'=>$this->session->flashdata('error'),

							'main_content'=>'front/register'

							);

					$this->load->view('front/template',$data);

				}else{
					
					if($siteLang=='english'){
						
						$langf="en-UK";
					}
					else{
						$langf="fr-FR";
					}
					if(!empty($this->input->post('phone'))){
						$pattern = '/^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$/';
						$phonecheck= preg_match($pattern, $this->input->post('phone'));
						
						if($phonecheck == 1){
							$insert = array(

								'firstname'=>$firstname,
		
								'lastname'=>$lastname,
		
								'email'=>$email,
		
								'phone'=>$phone,
		
								'country'=>$country,
		
								'city'=>$city,
		
								'address1'=>$address1,
		
								'address2'=>$address2,
		
								'postcode'=>$postcode,
		
								'password'=>md5($password),
		
								'usr_lang'=>$langf,
		
								'created_date'=>date('Y-m-d H:i:s'),
							);
							
					if($this->Mdl_User->insert($insert)){

							if($siteLang=='english'){

								$this->session->set_flashdata('success','User Profile Successfully Created' );
								$lang = "EN";

							}else{

								$this->session->set_flashdata('success',"Profil d'utilisateur créé avec succès" ); 
								$lang = "FR";

							}
							$langcurrent=$this->input->post('langcurrent');
							if($langcurrent=='english'){
								$user_get_templates_html=$this->Mdl_Template->GetRecordUsers(array('id'=>25));
							}
							else{
								
								$user_get_templates_html=$this->Mdl_Template->GetRecordUsers(array('id'=>13));
							}
							$user_html = $user_get_templates_html[0]['template'];

						$settings = $this->Mdl_Settings->GetRecord();

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

											'Email' => $email,

											'Name' => "BWT User"

										]

									],

									'Subject' => $user_get_templates_html[0]['template_subject'],

									'TextPart' => $user_html,

									'HTMLPart' => $user_html

								]

							]

						];

						//$response = $mj->post(Resources::$Email, ['body' => $body]);
							$this->load->library('email');
							$this->email->from($settings[0]['from_email'], 'BWT');
							$this->email->to($email,'BWT User');
							$this->email->subject($user_get_templates_html[0]['template_subject']);
							$this->email->message($user_html);
							try{
								$this->email->send();
								if($siteLang=='english'){

									$this->session->set_flashdata('success','User Profile Successfully Created' ); 

								}else{

									$this->session->set_flashdata('success',"Profil d'utilisateur créé avec succès"); 

								}
							}	
							catch(Exception $e){
								$this->session->set_flashdata('error',$e->getMessage());
								if($siteLang=='english'){

									$this->session->set_flashdata('error','Error while creating profile!' );

								}else{

									$this->session->set_flashdata('error','Erreur lors de la création du profil!' );

								}
							}
							redirect('login');

							}else{

								if($siteLang=='english'){

									$this->session->set_flashdata('error','Error while creating profile!' );

								}else{

									$this->session->set_flashdata('error','Erreur lors de la création du profil!' );

								}

								redirect('login');

							}
	
						}else{
							if($siteLang=='english'){
								$this->session->set_flashdata('error','Please format your phone as follows: 0612131415, 0231878889…' );
							}
							else{
								$this->session->set_flashdata('error','Merci de formater votre téléphone comme suit : 0612131415, 0231878889…' );
							}
								$data=array('success'=>$this->session->flashdata('success'),

								'error'=>$this->session->flashdata('error'),

								'main_content'=>'front/register'

								);
								$this->load->view('front/template',$data);
						}
					}


				}

			}else{

				redirect('register'); 

			}

		}else{

			redirect('login'); 

		}

	}

	

	public function editprofile(){
		// $sidemenu_without_login=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu_without'));
		$sidemenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu'));
		$footermenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'footer_menu'));

		//echo '<pre>'; print_r($_SESSION);

		if(!empty($_SESSION['front_user'])){

			$userdata = $this->Mdl_User->GetUsers(array('id'=>$_SESSION['front_user']['id']));

			$data=array('success'=>$this->session->flashdata('success'),

						'error'=>$this->session->flashdata('error'),

						'sidemenu'=>$sidemenu,

						'footermenu'=>$footermenu,

						'main_content'=>'front/editprofile',

						'userdata'=>$userdata

						);

			$this->load->view('front/template',$data);

		}

    }

	public function emptycheck($postcode){
		if(00000 == $postcode)
		{
		   return FALSE;
		} 
		return TRUE;
	 }



	public function updateprofile()

    {

		if(!empty($_SESSION['front_user'])){

			$ispost=$this->input->method(TRUE);

			if($ispost=='POST'){

				$this->load->helper('form');

				$this->load->library('form_validation');

				// set validation rules

				$siteLang = $this->session->userdata('site_lang');

				if($siteLang=='english'){

					$this->form_validation->set_rules('email','Email','required|valid_email',array('required'=>'The Email field is required','valid_email'=>'The Email field must contain a valid email address'));
					$this->form_validation->set_rules('firstname','First Name','required|callback_checkstring',array('required'=>'The First Name field is required', 'checkstring'=>'The firstname field must contain aplhabets only')); 
					$this->form_validation->set_rules('lastname','Last Name','trim|required|callback_checkstring',array('required'=>'The Last Name field is required', 'checkstring'=>'The lastname field must contain aplhabets only')); 
					$this->form_validation->set_rules('phone', "Phone Number", 'trim|required|regex_match[/^[0-9]{10}$/]');
					$this->form_validation->set_rules('country', "Country", 'trim|required');
					$this->form_validation->set_rules('city','City','trim|required|callback_checkstring',array('required'=>'The City field is required', 'checkstring'=>'The City field must contain aplhabets only')); 
					$this->form_validation->set_rules('address1', "Address 1", 'trim|required');
					$this->form_validation->set_rules('postcode','Postcode','required|regex_match[/^[0-9]{5}$/]|callback_emptycheck',array('required'=>'Postcode Field is required','regex_match'=>'Please add the valid Postcode like 69001 (5 digits )', 'emptycheck'=>'Please add the valid Postcode like 69001 (5 digits )'));
				}else{

					$this->form_validation->set_rules('email','Email','required|valid_email',array('required'=>'Le champ Email est obligatoire','valid_email'=>'Le format de l email est erroné')); 
					$this->form_validation->set_rules('firstname','First Name','required|callback_checkstring',array('required'=>'Le prénom est obligatoire', 'checkstring'=>'Le champ du prénom ne doit contenir que des alphabets')); 
					$this->form_validation->set_rules('lastname','Last Name','trim|required|callback_checkstring',array('required'=>'Le champ Nom est obligatoire', 'checkstring'=>'Le champ nom de famille ne doit contenir que des aplhabets')); 
					$this->form_validation->set_rules('city','City','trim|required|callback_checkstring',array('required'=>'La ville est obligatoire', 'checkstring'=>'Le champ de la ville ne doit contenir que des alphabets')); 
					$this->form_validation->set_rules('phone','Phone Number','required|regex_match[/^[0-9]{10}$/]',array('required'=>'Le téléphone est obligatoire','regex_match'=>'s il vous plaît entrer un numéro de téléphone valide'));
					$this->form_validation->set_rules('country','Country','required',array('required'=>'Le champ Pays est obligatoire'));
					
					$this->form_validation->set_rules('address1','Address','required',array('required'=>'Le adresse est obligatoire'));
					$this->form_validation->set_rules('postcode','Postcode','required|regex_match[/^[0-9]{5}$/]|callback_emptycheck',array('required'=>'Le code postal est obligatoire.','regex_match'=>'Veuillez ajouter le code postal valide comme 69001 (5 chiffres)', 'emptycheck'=>'Veuillez ajouter le code postal valide comme 69001 (5 chiffres)'));
				}

				if(!empty($this->input->post('postcode'))){
					if($this->input->post('postcode') == 00000){

					}
				}

				if(!empty($this->input->post('phone'))){
					$pattern = '/^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$/';
					$phonecheck= preg_match($pattern, $this->input->post('phone'));
					
					if($phonecheck == 0){
						if($siteLang=='english'){

							$this->session->set_flashdata('error','Please format your phone as follows: : 0612131415, 0231878889…' );
							$this->form_validation->set_rules('phone','Phone Number','required',array('required'=>'Please format your phone as follows: : 0612131415, 0231878889…'));
					
						}
						else{
							$this->session->set_flashdata('error','Merci de formater votre téléphone comme suit : 0612131415, 0231878889…' );
							$this->form_validation->set_rules('phone','Phone Number','required',array('required'=>'Merci de formater votre téléphone comme suit : 0612131415, 0231878889…'));
					
						}
					}
				}

				$firstname=$this->input->post('firstname');
				$lastname=$this->input->post('lastname');
				$email=$this->input->post('email');
				$phone=$this->input->post('phone');
				$country=$this->input->post('country');
				$city=$this->input->post('city');
				$address1=$this->input->post('address1');
				$address2=$this->input->post('address2');
				$postcode=$this->input->post('postcode');
				$usr_lang=$this->input->post('usr_lang');

				if($this->form_validation->run() === FALSE){
					
					$userdata = $this->Mdl_User->GetUsers(array('id'=>$_SESSION['front_user']['id']));
					$data=array('success'=>$this->session->flashdata('success'),
							'error'=>$this->session->flashdata('error'),
							'main_content'=>'front/editprofile',
							'userdata'=>$userdata
					);
					$this->load->view('front/template',$data);

				}else{

					if(!empty($this->input->post('phone'))){
						$pattern = '/^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$/';
						$phonecheck= preg_match($pattern, $this->input->post('phone'));
						
						if($phonecheck == 1){
							$insert = array(
								'firstname'=>$firstname,
								'lastname'=>$lastname,
								'phone'=>$phone,
								'country'=>$country,
								'city'=>$city,
								'address1'=>$address1,
								'address2'=>$address2,
								'postcode'=>$postcode,
								'usr_lang'=>$usr_lang,
								'updated_date'=>date('Y-m-d H:i:s'),
							);
							if($this->Mdl_User->update($insert,array('id'=>$_SESSION['front_user']['id']))){

								if($siteLang=='english'){
										$this->session->set_flashdata('success','User Profile Successfully Updated' ); 
								}else{
									$this->session->set_flashdata('success','Profil d utilisateur mis à jour avec succès' ); 
								}
								redirect('modifier-mon-profil');
		
							}else{
		
								if($siteLang=='english'){
									$this->session->set_flashdata('error','Error while Updating profile!' );
								}
								else{
									$this->session->set_flashdata('error','Erreur lors de la mise à jour du profil!' );
								}
								redirect('modifier-mon-profil');
							}
						}
						else{
							if($siteLang=='english'){
								$this->session->set_flashdata('error','Please format your phone as follows: : 0612131415, 0231878889…' );
								$this->form_validation->set_rules('phone','Phone Number','required',array('required'=>'Please format your phone as follows: : 0612131415, 0231878889…'));
						
							}
							else{
								$this->session->set_flashdata('error','Merci de formater votre téléphone comme suit : 0612131415, 0231878889…' );
								$this->form_validation->set_rules('phone','Phone Number','required',array('required'=>'Merci de formater votre téléphone comme suit : 0612131415, 0231878889…'));
						
							}
							$userdata = $this->Mdl_User->GetUsers(array('id'=>$_SESSION['front_user']['id']));
							$data=array('success'=>$this->session->flashdata('success'),
							'error'=>$this->session->flashdata('error'),
							'main_content'=>'front/editprofile',
							'userdata'=>$userdata
							);
							$this->load->view('front/template',$data);
						}

					}	
				}

			}else{

				redirect('modifier-mon-profil');

			}

		}else{

			redirect('login'); 

		}

    }

	

	public function userLogout()
	{

		$this->session->unset_userdata('front_user');
		//$this->session->sess_destroy(); 
		redirect('login'); 
	}

	

	public function proof_of_purchase()
	{		
		
		$sidemenu_without_login=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu_without'));
		$sidemenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu'));
		$footermenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'footer_menu'));

		if(!empty($_SESSION['front_user'])){

			$getproofs = $this->Mdl_Proof->GetRecord(array('user_id'=>$_SESSION['front_user']['id']));

			$getstores = $this->Mdl_Store->GetRecordUsers();

			$anothergetstores = $this->Mdl_Store->GetRecordUsers(array('store_handle'=>0));

			$getcoupons = $this->Mdl_Coupon->GetRecordUsers();

			
			if(!empty($getproofs)){

				$data=array('success'=>$this->session->flashdata('success'),

						'error'=>$this->session->flashdata('error'),

						'main_content'=>'front/proof_of_purchase',

						'getproofs'=>$getproofs,

						'sidemenu'=>$sidemenu,
	
						'footermenu'=>$footermenu,

						'anothergetstores'=>$anothergetstores,

						'getstores'=>$getstores,

						'getcoupons'=>$getcoupons

						);

				$this->load->view('front/template',$data);

			}else{
				$data=array('success'=>$this->session->flashdata('success'),

					'error'=>$this->session->flashdata('error'),

					'main_content'=>'front/proof_of_purchase',

					'anothergetstores'=>$anothergetstores,

					'getstores'=>$getstores,

					'sidemenu'=>$sidemenu,

					'footermenu'=>$footermenu,

					'getcoupons'=>$getcoupons

					);

				$this->load->view('front/template',$data);

			}

		}else{
			
			$data=array('success'=>$this->session->flashdata('success'),

						'error'=>$this->session->flashdata('error'),

						'sidemenu'=>$sidemenu_without_login,
	
						'footermenu'=>$footermenu,

						'main_content'=>'front/login'

						);

			$this->load->view('front/template',$data);

		}

    }

	public function proof_of_cover_purchase()
	{		
		
		$sidemenu_without_login=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu_without'));
		$sidemenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu'));
		$footermenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'footer_menu'));
		
		if(!empty($_SESSION['front_user'])){

			$getproofs = $this->Mdl_ProofCover->GetRecord(array('user_id'=>$_SESSION['front_user']['id']));

			$getstores = $this->Mdl_StoreCover->GetRecordUsers();

			$anothergetstores = $this->Mdl_StoreCover->GetRecordUsers(array('store_handle'=>0));

			$getcovers = $this->Mdl_Cover->GetRecordUsers();
			
			if(!empty($getproofs)){

				$data=array('success'=>$this->session->flashdata('success'),

						'error'=>$this->session->flashdata('error'),

						'main_content'=>'front/proof_of_cover_purchase',

						'getproofs'=>$getproofs,

						'sidemenu'=>$sidemenu,
	
						'footermenu'=>$footermenu,

						'anothergetstores'=>$anothergetstores,

						'getstores'=>$getstores,

						'getcovers'=>$getcovers

						);

				$this->load->view('front/template',$data);

			}else{
				$data=array('success'=>$this->session->flashdata('success'),

					'error'=>$this->session->flashdata('error'),

					'main_content'=>'front/proof_of_cover_purchase',

					'anothergetstores'=>$anothergetstores,

					'getstores'=>$getstores,

					'sidemenu'=>$sidemenu,

					'footermenu'=>$footermenu,

					'getcovers'=>$getcovers

					);

				$this->load->view('front/template',$data);

			}

		}else{
			
			$data=array('success'=>$this->session->flashdata('success'),

						'error'=>$this->session->flashdata('error'),

						'sidemenu'=>$sidemenu_without_login,
	
						'footermenu'=>$footermenu,

						'main_content'=>'front/login'

						);

			$this->load->view('front/template',$data);

		}

    }

	function select_validate2($cupid)
	{  
		if($cupid=="none"){
			$this->form_validation->set_message('select_validate2', 'Le champ robot est obligatoire.');
				return false;
			} else{
				return true;
			}
	}   
	function select_validatestore($cupid)
	{  
		if($storename=="none"){
			$this->form_validation->set_message('select_validatestore', 'Le champ roboto le numéro de  du robot est obligatoire..');
				return false;
			} else{
				return true;
			}
	}  

	public function create_proof_of_purchase_new()
    {

		if(!empty($_SESSION['front_user'])){

			$user_id = $_SESSION['front_user']['id'];
			$user_detail_info=$this->Mdl_User->GetUsers(array("id"=>$user_id));
			$user_lang = $user_detail_info['usr_lang'];
			if($user_lang == "english"){
				$lang = "en-UK";
			}else if($user_lang == "netherland"){
				$lang = "NL";
			}else {
				$lang = "fr-FR";
			}

			$email = $_SESSION['front_user']['email'];
			$username = $_SESSION['front_user']['firstname'].' '.$_SESSION['front_user']['lastname'] ;
			$ispost=$this->input->method(TRUE);
			if($ispost=='POST'){
				$this->load->helper('form');
				$this->load->library('form_validation');
				$abcd = $this->input->post('store_country');
				$cupid=$this->input->post('coupon_id');
				$storename=$this->input->post('store_id');
				// set validation rules
				$siteLang = $this->session->userdata('site_lang');
				if($siteLang=='english'){
					$this->form_validation->set_rules('coupon_id', "Modal", 'trim|required|callback_select_validate2');
					$this->form_validation->set_rules('date_of_purchase', "Date of purchase", 'trim|required');
					$this->form_validation->set_rules('store_country', "Store Country", 'trim|required|callback_select_validate');
					$this->form_validation->set_rules('bank_bic', "Bank BIC", 'trim|required');
					$this->form_validation->set_rules('bank_iban', "Bank IBAN", 'trim|required');
					$this->form_validation->set_rules('roboto_serial_no', "Roboto Serial No", 'trim|required');
					$this->form_validation->set_rules('store_id', "Store name", 'trim|required|callback_select_validatestore');
					if($this->input->post('store_id') == 'AUTRE'){
						$this->form_validation->set_rules('nomstoreadditional', "Store Name", 'trim|required');
						$this->form_validation->set_rules('nom_address', "Store Address", 'trim|required');
						$this->form_validation->set_rules('postalcode','Roboto Postal Code','trim|required');
						$this->form_validation->set_rules('vile','Roboto store  Vile','trim|required');
					}
					
				}else{ 
				  	$this->form_validation->set_rules('coupon_id','Modal','required|callback_select_validate2',array('required'=>'Le champ robot est obligatoire.')); 
					$this->form_validation->set_rules('date_of_purchase','Date of purchase','required',array('required'=>'Le champ Date d`achat est obligatoire.'));
					$this->form_validation->set_rules('store_country','Store Country','required|callback_select_validate',array('required'=>'Le champ Pays est obligatoire.'));
					$this->form_validation->set_rules('bank_bic','Bank Bic','required',array('required'=>'Le champ Bank BIC est obligatoire.'));
					$this->form_validation->set_rules('bank_iban','Bank IBAN','required',array('required'=>'Le champ Bank IBAN est obligatoire.'));
					$this->form_validation->set_rules('roboto_serial_no','Roboto serial no','required',array('required'=>'Le champs numéro de série du  est obligatoire.'));
					$this->form_validation->set_rules('store_id','Store','required|callback_select_validatestore',array('required'=>'Le champ  le numéro de série du  est obligatoire.'));
					if($this->input->post('store_id') == 'AUTRE'){
						$this->form_validation->set_rules('nomstoreadditional','Store Name','required',array('required'=>"Nom de l'enseigne"));
						$this->form_validation->set_rules('nom_address','Roboto store  Address','required',array('required'=>'Le champ  l’adresse est obligatoire.'));
						$this->form_validation->set_rules('postalcode','Roboto Postal Code','required',array('required'=>'Le champ  Postal Code est obligatoire.'));
						$this->form_validation->set_rules('vile','Roboto store  Vile','required',array('required'=>'Le champ  Vile est obligatoire.'));
					}
				}
				$coupon_id=$this->input->post('coupon_id');
				$coupon_code=$this->Mdl_Coupon->GetRecordUsers(array("id"=>$coupon_id));
				$date_of_purchase=$this->input->post('date_of_purchase');
				$bank_bic=$this->input->post('bank_bic');
				$bank_ibantrim=$this->input->post('bank_iban');
				$bank_iban = str_replace(' ', '', $bank_ibantrim);
			    $roboto_serial_no=$this->input->post('roboto_serial_no');
				$store_id=$this->input->post('store_id');
				$store_code=$this->Mdl_Store->GetRecordUsers(array("id"=>$store_id));
				$nom_address=$this->input->post('nom_address');
				$postalcode=$this->input->post('postalcode');
				$vile=$this->input->post('vile');
				$complementad=$this->input->post('complementad');
				$store_country=$this->input->post('store_country');
				$langcurrent=$this->input->post('langcurrent');
				$siret=$this->input->post('siret');
				$clienttype=$this->input->post('contact');
				$nomstoreadditional=$this->input->post('nomstoreadditional');
				$uplodehidenfile=$this->input->post('uplodehidenfile');
				
				if (isset($_FILES['upload_proof']['name']) && $_FILES['upload_proof']['name'] != null) {
					 $filename = $_FILES['upload_proof']['name'];
					 $filedata = $_FILES['upload_proof']['tmp_name'];
					 $filesize = $_FILES['upload_proof']['size'];
					 $filetype = $_FILES['upload_proof']['type'];
					 $config['upload_path'] = 'upload/op3/';
					 $config['allowed_types'] = 'jpg|jpeg|png|pdf';
					 $config['file_name'] = $_FILES['upload_proof']['name'];
					if (!is_dir($config['upload_path'])) 
					{
						mkdir($config['upload_path']);
						
					}
					$this->load->library('upload',$config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('upload_proof'))
					{

						$uploadData = $this->upload->data();
						$pictured = $uploadData['file_name'];
						$img_url=$_FILES['upload_proof']['name'];
						$fileinsert=$filedata."#".$filetype."#".$filename;
						
					}
					else
					{
						
						$error=$this->upload->display_errors();
						$this->session->set_flashdata('error',$error['error']);
						//redirect('offre-robot');
						$pictured = '';
						$fileinsert = '';
					}
				}
				else if(!empty($uplodehidenfile)){
					$pictured = $uplodehidenfile;
					$fileinsert = $this->input->post('fileinsert');
				   }
				if($this->form_validation->run() === FALSE){
					$getrefunds = $this->Mdl_Refund->GetRecordUsers(array('refund.user_id'=>$_SESSION['front_user']['id']));
					$getstores = $this->Mdl_Store->GetRecordUsers();
					$getcoupons = $this->Mdl_Coupon->GetRecordUsers();
					$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'front/proof_of_purchase',
						'getrefunds'=>$getrefunds,
						'getstores'=>$getstores,
						'getcoupons'=>$getcoupons,
						'coupon_id'=>$coupon_id,
						'store_country'=>$store_country,
						'date_of_purchase'=>$date_of_purchase,
						'bank_bic'=>$bank_bic,
						'bank_iban'=>$bank_iban,
						'upload_proof'=>$pictured,
						'filesizeinfo'=>$fileinsert,
						//'upload_proof'=>$_FILES['upload_proof']['name'],
						'roboto_serial_no'=>$roboto_serial_no,
						'store_id'=>$store_id,
						'siret'=>$siret,
						'clienttype'=>$clienttype,
						'nomstoreadditional'=>$nomstoreadditional,
						'nom_address'=>$nom_address,
						);
					$this->load->view('front/template',$data);
				}else{

							if(!empty($_FILES['upload_proof']['name']) || !empty($uplodehidenfile) )
							{
								if(empty($uplodehidenfile) && !empty($_FILES['upload_proof']['name'])){
									$config['upload_path'] = 'upload/op3/';
									$config['allowed_types'] = 'jpg|jpeg|png|pdf';
									$config['file_name'] = $_FILES['upload_proof']['name'];
									if (!is_dir($config['upload_path'])) 
									{
										mkdir($config['upload_path']);
									}
									$this->load->library('upload',$config);
									$this->upload->initialize($config);
									if($this->upload->do_upload('upload_proof'))
									{
										$uploadData = $this->upload->data();
										$picture = $uploadData['file_name'];
										$img_url=$_FILES['upload_proof']['name'];
									}
									else
									{
										$error = array('error' => $this->upload->display_errors());
										$this->session->set_flashdata('error',$error['error']);
										redirect('offre-robot');
										$picture = '';
									}
								}
								else if(!empty($uplodehidenfile) && !empty($_FILES['upload_proof']['name']) ){
									$config['upload_path'] = 'upload/op3/';
									$config['allowed_types'] = 'jpg|jpeg|png|pdf';
									$config['file_name'] = $_FILES['upload_proof']['name'];
									if (!is_dir($config['upload_path'])) 
									{
										mkdir($config['upload_path']);
									}
									$this->load->library('upload',$config);
									$this->upload->initialize($config);
									if($this->upload->do_upload('upload_proof'))
									{
										$uploadData = $this->upload->data();
										$picture = $uploadData['file_name'];
										$img_url=$_FILES['upload_proof']['name'];
									}
									else
									{
										$error = array('error' => $this->upload->display_errors());
										$this->session->set_flashdata('error',$error['error']);
										redirect('offre-robot');
										$picture = '';
									}

								}
								else if(!empty($uplodehidenfile) && empty($_FILES['upload_proof']['name']) ){
									$picture = $uplodehidenfile;
								}
								
								if($this->input->post('store_id') == 'AUTRE'){ $storeid='148'; }
								if($this->input->post('store_id') != 'AUTRE'){ $storeid=$store_id;}

								

								$insert = array(
									'user_id'=>$user_id,
									'store_id'=>$storeid,
									'coupon_id'=>$coupon_id,
									'upload_proof'=>(!empty($picture)) ? $picture : null,
									'coupon_list_code'=>$date_of_purchase,
									'upload_proof_date'=>date('Y-m-d H:i:s'),
									'store_country'=>(!empty($store_country)) ? $store_country : null,
									'address'=>(!empty($nom_address)) ? $nom_address : null,
									'zipcode'=>(!empty($postalcode)) ? $postalcode : null,
									'city'=>(!empty($vile)) ? $vile : null,
									'addition_address'=>(!empty($complementad)) ? $complementad : null,
									'store_name_additional'=>(!empty($nomstoreadditional)) ? $nomstoreadditional : null,
									'iban'=>(!empty($bank_iban)) ? $bank_iban : null,
									'bic'=>(!empty($bank_bic)) ? $bank_bic : null,
									'robot_serial_no'=>(!empty($roboto_serial_no)) ? $roboto_serial_no : null,
									'siret'=>(!empty($siret)) ? $siret : null,
									'clienttype'=>(!empty($clienttype)) ? $clienttype : null,
									'created_date'=>date('Y-m-d H:i:s')
									);
											
											
								if($this->Mdl_ProofCover->insert($insert)){

									
									
									$datef = str_replace('/', '-', $date_of_purchase);
									$new_date = date('Y-m-d', strtotime($date_of_purchase));
									
									if($langcurrent == "english"){
										$lang = "en-UK";
									}else {
										$lang = "fr-FR";
									}
									
									$base64_data = "";
									if(!empty($this->input->post('filesizeinfo'))  && $this->input->post('filesizeinfo')!=''){
										$etst=explode('#',$this->input->post('filesizeinfo'));
										$filename = $etst[2];
										$filedata = $etst[0];
										$filetype = $etst[1];
									}
									else{
										$filename = $_FILES['upload_proof']['name'];
										$filedata = $_FILES['upload_proof']['tmp_name'];
										$filesize = $_FILES['upload_proof']['size'];
										$filetype = $_FILES['upload_proof']['type'];
										
										$base64_data = file_get_contents( $filedata );
										$base64_data = base64_encode($base64_data);
									}
									
			
									$bank_ibantrim = str_replace(' ', '', $bank_iban);
									$dir=__DIR__;
									$finaldir=explode('application/controllers',$dir);
									$logpath=$finaldir[0].'dailylog/op1_'.date('d-m-Y').'.txt';
									
									
									// $parameters = array(
									// 	'operation->code' => '3001_BWT_LIGNEP_2022',
									// 	'contact->lname' => $user_detail_info['lastname'],
									// 	'contact->fname' => $user_detail_info['firstname'],
									// 	'contact->email' => $user_detail_info['email'],
									// 	'contact->mobile_phone' => $user_detail_info['phone'],
									// 	'contact->addresses{MED_SOCIAL_ADDRESS}->line4' => $user_detail_info['address1'],
									// 	'contact->addresses{MED_SOCIAL_ADDRESS}->line2' => $user_detail_info['address2'],
									// 	'contact->addresses{MED_SOCIAL_ADDRESS}->postal_code' => $user_detail_info['postcode'],
									// 	'contact->addresses{MED_SOCIAL_ADDRESS}->city' => $user_detail_info['city'],
									// 	'contact->iban->iban' => $bank_ibantrim,
									// 	//'contact->iban->iban' => '3001_RIB',
									// 	'contact->iban->bic' => $bank_bic,
									// 	'contact->addresses{MED_SOCIAL_ADDRESS}->country->code' => $user_detail_info['country'],
									// 	'language->code' => $lang,
									// 	'operations{3001_BWT_LIGNEP_2022}->participation->documents{3001_INVOICE}->order{0}->purchase_date' => $new_date,
									// 	'operations{3001_BWT_LIGNEP_2022}->participation->documents{3001_SERIAL_NUMBER}->order{0}->serial_number' =>$roboto_serial_no,
									// 	'operations{3001_BWT_LIGNEP_2022}->participation->documents{3001_INVOICE}->order{0}->attachment' => new CURLFile($filedata, $filetype, $filename)
									// );
									$parameters = array(
										'contact->civility->code' => 'REP_CIV_M',
										'contact->lname' => $user_detail_info['lastname'],
										'contact->fname' => $user_detail_info['firstname'],
										'contact->email' => $user_detail_info['email'],
										'contact->mobile_phone' => $user_detail_info['phone'],
										'contact->addresses{MED_SOCIAL_ADDRESS}->line4' => $user_detail_info['address1'],
										'contact->addresses{MED_SOCIAL_ADDRESS}->line2' => $user_detail_info['address2'],
										'contact->addresses{MED_SOCIAL_ADDRESS}->postal_code' => $user_detail_info['postcode'],
										'contact->addresses{MED_SOCIAL_ADDRESS}->city' => $user_detail_info['city'],
										'contact->iban->iban' => $bank_ibantrim,
										//'contact->iban->iban' => '3001_RIB',
										'contact->iban->bic' => $bank_bic,
										'contact->addresses{MED_SOCIAL_ADDRESS}->country->code' => $user_detail_info['country'],
										'language->code' => $lang,
										'operations{offre_bwt_robots_lignep_cosmy}->participation->documents{3440_INVOICE}->order{0}->purchase_date' => $new_date,
										'operations{offre_bwt_robots_lignep_cosmy}->participation->documents{3440_INVOICE}->order{0}->shop->code' => $store_code[0]['store_code'],
										'operations{offre_bwt_robots_lignep_cosmy}->participation->documents{3440_INVOICE}->order{0}->products{0}->code' => $coupon_code[0]['coupon_code'],
										// 'operations{offre_bwt_robots_lignep_cosmy}->participation->documents{3440_INVOICE}->order{0}->attachment->base64_content' => $base64_data,
										'operations{offre_bwt_robots_lignep_cosmy}->participation->documents{3440_INVOICE}->order{0}->attachment->filename' => $filename,
										'duplicate_criteria' => $roboto_serial_no
									);
									$dateti='start log  APi  send Parameter : '.date('d-m-Y').PHP_EOL;
									file_put_contents($logpath, $dateti, FILE_APPEND);
									file_put_contents($logpath, print_r($parameters, true), FILE_APPEND);

									// echo'<pre>';print_r($parameters);  echo '</pre>';exit;

									$url = 'https://je-participe.fr/Carbone-Api-V2.1/Web/public/create-participation';
									$curl = curl_init();
									curl_setopt($curl, CURLOPT_POST, 1);
									curl_setopt($curl, CURLOPT_POSTFIELDS, $parameters);
									curl_setopt($curl, CURLOPT_URL, $url);
									curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
									$result = curl_exec($curl);
									$user_get_templates_html = $this->Mdl_Template->GetRecordUsers(array('id'=>18));
									// $user_html = $user_get_templates_html[0]['template'];
									$settings = $this->Mdl_Settings->GetRecord();
									$email_body = '<!-- Header Section Start -->
													<table cellpadding="0" cellspacing="0" class="deviceWidth" id="HeaderSection" style="width:100%">
														<td style="background-color:#7bc2dc">
															<table border="0" cellpadding="0" cellspacing="0" class="center floatNone" style="margin:0 auto; width:100%">
																<tbody>
																	<tr><!-- Header logo -->
																		<td style="text-align:left; vertical-align:middle">
																		<div class="logoImg" id="header-LogoImage"><a href="#" style="outline: none !important; text-decoration: none;"><img alt="logo" src="https://www.summerbwt.fr/assets/image/logo.png" style="margin:0px auto; max-width:100%; width:250px" title="logo" /> </a></div>
																		</td>
																		<!-- Header logo end -->
																		<td style="text-align:right; vertical-align:middle">
																		<table align="center" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto; width:100%">
																			<tbody>
																				<tr>
																					<td style="text-align:right; vertical-align:middle">
																					<div class="bwtText" id="Header-right-text" style="text-align:right"><a href="#" style="outline: none !important; text-decoration: none;"><img alt="summer" src="https://www.summerbwt.fr/assets/image/summer.png" style="margin:0px auto; max-width:100%; width:130px" title="summer" /> </a></div>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																		</td>
																	</tr>
																</tbody>
															</table>
														</td>
													</table>
													<!-- Header Section Start -->

													<!-- Body section Start -->													
													<table align="left" border="0" cellpadding="0" cellspacing="0" class="deviceWidth1" style="border-spacing:0; margin:0 auto; width:1000px">
														<tbody>
															<tr>
																<td>&nbsp;</td>
															</tr>';
															foreach ($parameters as $parameter_key => $parameter_value) {
																$email_body .= '<tr>
																					<td style="text-align:left; vertical-align:top">
																						<div class="Text" id="bodycontent" style="color:#000000; font-size:20px; font-weight:normal; line-height:normal; text-align:left; vertical-align:top">' . $parameter_key . ' => ' . $parameter_value . '</div>
																					</td>
																				</tr>';
															}
															$email_body .= '	
															<tr>
																<td>&nbsp;</td>
															</tr>
														</tbody>
													</table>
													<!-- Body section end -->

													<!-- footer Start-->	
													<table align="center" border="0" cellpadding="0" cellspacing="0" class="deviceWidth1" style="border-spacing:0; margin:0 auto; width:1000px">
														<tbody>
															<tr>
																<td style="text-align:center; vertical-align:top">
																	<div class="Text" id="LISTblock_1" style="font-size:14px">CONTACT BWT</div>
																</td>
															</tr>
															<tr>
																<td>&nbsp;</td>
															</tr>
															<tr>
																<td style="text-align:center; vertical-align:top">
																	<div class="Text" id="bodycontent" style="color:#676b6d;  font-size:16px; font-weight:normal; line-height:normal; padding:0 20px; text-align:center; vertical-align:top">Vous avez particip&eacute; &agrave; notre offre Summer of Excellence BWT 2019, pour vous d&eacute;sabonner, <a href="https://www.summerbwt.fr/unsubscribe" style="color: #0070C0;">cliquez ici</a></div>
																</td>
															</tr>
															<tr>
																<td>&nbsp;</td>
															</tr>
															<tr>
																<td style="text-align:center; vertical-align:top">
																	<div class="Text" id="bodycontent" style="color:#676b6d; font-size:16px; font-weight:normal; line-height:normal; padding:0 20px; text-align:center; vertical-align:top">PROCOPI by BWT au capital de 7 000 000,00 &euro; - Si&egrave;ge social : Les Landes d&rsquo;Apign&eacute;, 35 650 LE RHEU<br />
																	SIRET : 333 263 846 - N&deg; de TVA intracommunautaire : FR37333263846 - Voir les modalit&eacute;s sur <a href="https://www.summerbwt.fr" style="color: #0070C0;">www.summerbwt.fr&quot;</a></div>
																</td>
															</tr>
															<tr>
																<td>&nbsp;</td>
															</tr>
														</tbody>
													</table>
													<!-- footer End-->';
									$this->load->library('email');
									$this->email->from($settings[0]['from_email'], 'BWT');
									// $this->email->to($user_detail_info['email'],'BWT User');
									$this->email->to('operations.bwt@phare-west.fr','BWT User');
									$this->email->subject($user_get_templates_html[0]['template_subject']);
									// $this->email->message($user_html);
									$this->email->message($email_body);
									$this->email->send();
									if (!$this->email->send()) {
										echo $this->email->print_debugger();
									}
									// if (curl_errno($curl)) {
									//    	$error_msg = curl_error($curl);
									//   	  echo "<h1>Error received</h1>";
									//  	echo'<pre>';
									//   	print_r($error_msg); echo '</pre>';exit;
									//   }else{
									//   	echo "<h1>API Response</h1>";
									//  	echo'<pre>'; print_r(json_decode($result)); echo '</pre>'; exit;
									//  } 
								
									 
									if (curl_errno($curl)) {
										$error_msg = curl_error($curl);
										$dateti=PHP_EOL.'start log  APi  Response error here : '.date('d-m-Y').PHP_EOL;
										file_put_contents($logpath, $dateti, FILE_APPEND);
										file_put_contents($logpath, print_r($error_msg, true), FILE_APPEND);
										
										$getrefunds = $this->Mdl_Refund->GetRecordUsers(array('refund.user_id'=>$_SESSION['front_user']['id']));
										$getstores = $this->Mdl_Store->GetRecordUsers();
										$getcoupons = $this->Mdl_Coupon->GetRecordUsers();
										$data=array('success'=>$this->session->flashdata('success'),
											'error'=>$this->session->flashdata('error'),
											'main_content'=>'front/proof_of_purchase',
											'getrefunds'=>$getrefunds,
											'getstores'=>$getstores,
											'getcoupons'=>$getcoupons,
											'coupon_id'=>$coupon_id,
											'store_country'=>$store_country,
											'date_of_purchase'=>$date_of_purchase,
											'bank_bic'=>$bank_bic,
											'bank_iban'=>$bank_iban,
											'upload_proof'=>$pictured,
											'filesizeinfo'=>$fileinsert,
											//'upload_proof'=>$_FILES['upload_proof']['name'],
											'roboto_serial_no'=>$roboto_serial_no,
											'store_id'=>$store_id,
											'siret'=>$siret,
											'clienttype'=>$clienttype,
											'nomstoreadditional'=>$nomstoreadditional,
											'nom_address'=>$nom_address,
											);
										$this->load->view('front/template',$data);
										if($siteLang=='english'){
										$this->session->set_flashdata('error','Error while creating OFFRE DE REMBOURSEMENTROBOTS LIGNE P BWT EXCLUSIVEMENT!' );
										}else{
											$this->session->set_flashdata('error','Erreur lors de la création du OFFRE DE REMBOURSEMENTROBOTS LIGNE P BWT EXCLUSIVEMENT!' );
										}
										
									}
									else{
										$dateti='start log succes APi  Response :'.date('d-m-Y').PHP_EOL;
										file_put_contents($logpath, $dateti, FILE_APPEND);
										file_put_contents($logpath, print_r(json_decode($result), true), FILE_APPEND);
										$this->session->set_flashdata('success',lang('success_proof'));  
										redirect('thankyou_op1');
									}
									
									curl_close($curl);
									

								}else{
									if($siteLang=='english'){
										$this->session->set_flashdata('error','Error while creating OFFRE DE REMBOURSEMENTROBOTS LIGNE P BWT EXCLUSIVEMENT!' );
									}else{
										$this->session->set_flashdata('error','Erreur lors de la création du OFFRE DE REMBOURSEMENTROBOTS LIGNE P BWT EXCLUSIVEMENT!' );
									}
									redirect('offre-robot');

								}

							}else{

								if($siteLang=='english'){

									$this->session->set_flashdata('error','Please upload proof');

								}else{

									$this->session->set_flashdata('error','Veuillez télécharger la preuve');

								}

								redirect('offre-robot');

							}

						}

			}else{

				if($siteLang=='english'){

					$this->session->set_flashdata('error','Something went wrong!');

				}else{

					$this->session->set_flashdata('error','Quelque chose a mal tourné!');

				}

				redirect('offre-robot');

			}

		}else{

			if($siteLang=='english'){

				$this->session->set_flashdata('error','Please try again login');

			}else{

				$this->session->set_flashdata('error',"S'il vous plaît essayez à nouveau de vous connecter");

			}

			redirect('login');

		}

	}

	public function create_proof_of_cover_purchase_new()
    {

		if(!empty($_SESSION['front_user'])){

			$user_id = $_SESSION['front_user']['id'];
			$user_detail_info=$this->Mdl_User->GetUsers(array("id"=>$user_id));
			$user_lang = $user_detail_info['usr_lang'];
			if($user_lang == "english"){
				$lang = "en-UK";
			}else if($user_lang == "netherland"){
				$lang = "NL";
			}else {
				$lang = "fr-FR";
			}

			$email = $_SESSION['front_user']['email'];
			$username = $_SESSION['front_user']['firstname'].' '.$_SESSION['front_user']['lastname'] ;
			$ispost=$this->input->method(TRUE);
			if($ispost=='POST'){
				$this->load->helper('form');
				$this->load->library('form_validation');
				$abcd = $this->input->post('store_country');
				$cupid=$this->input->post('cover_id');
				$storename=$this->input->post('store_id');
				// set validation rules
				$siteLang = $this->session->userdata('site_lang');
				if($siteLang=='english'){
					$this->form_validation->set_rules('cover_id', "Modal", 'trim|required|callback_select_validate2');
					$this->form_validation->set_rules('date_of_purchase', "Date of purchase", 'trim|required');
					$this->form_validation->set_rules('store_country', "Store Country", 'trim|required|callback_select_validate');
					$this->form_validation->set_rules('bank_bic', "Bank BIC", 'trim|required');
					$this->form_validation->set_rules('bank_iban', "Bank IBAN", 'trim|required');
					// $this->form_validation->set_rules('roboto_serial_no', "Roboto Serial No", 'trim|required');
					$this->form_validation->set_rules('store_id', "Store name", 'trim|required|callback_select_validatestore');
					if($this->input->post('store_id') == 'AUTRE'){
						$this->form_validation->set_rules('nomstoreadditional', "Store Name", 'trim|required');
						$this->form_validation->set_rules('nom_address', "Store Address", 'trim|required');
						$this->form_validation->set_rules('postalcode','Roboto Postal Code','trim|required');
						$this->form_validation->set_rules('vile','Roboto store  Vile','trim|required');
					}
					
				}else{ 
				  	$this->form_validation->set_rules('cover_id','Modal','required|callback_select_validate2',array('required'=>'Le champ robot est obligatoire.')); 
					$this->form_validation->set_rules('date_of_purchase','Date of purchase','required',array('required'=>'Le champ Date d`achat est obligatoire.'));
					$this->form_validation->set_rules('store_country','Store Country','required|callback_select_validate',array('required'=>'Le champ Pays est obligatoire.'));
					$this->form_validation->set_rules('bank_bic','Bank Bic','required',array('required'=>'Le champ Bank BIC est obligatoire.'));
					$this->form_validation->set_rules('bank_iban','Bank IBAN','required',array('required'=>'Le champ Bank IBAN est obligatoire.'));
					// $this->form_validation->set_rules('roboto_serial_no','Roboto serial no','required',array('required'=>'Le champs numéro de série du  est obligatoire.'));
					$this->form_validation->set_rules('store_id','Store','required|callback_select_validatestore',array('required'=>'Le champ  le numéro de série du  est obligatoire.'));
					if($this->input->post('store_id') == 'AUTRE'){
						$this->form_validation->set_rules('nomstoreadditional','Store Name','required',array('required'=>"Nom de l'enseigne"));
						$this->form_validation->set_rules('nom_address','Roboto store  Address','required',array('required'=>'Le champ  l’adresse est obligatoire.'));
						$this->form_validation->set_rules('postalcode','Roboto Postal Code','required',array('required'=>'Le champ  Postal Code est obligatoire.'));
						$this->form_validation->set_rules('vile','Roboto store  Vile','required',array('required'=>'Le champ  Vile est obligatoire.'));
					}
				}
				$coupon_id=$this->input->post('cover_id');
				$coupon_code=$this->Mdl_Cover->GetRecordUsers(array("id"=>$coupon_id));
				$date_of_purchase=$this->input->post('date_of_purchase');
				$bank_bic=$this->input->post('bank_bic');
				$bank_ibantrim=$this->input->post('bank_iban');
				$bank_iban = str_replace(' ', '', $bank_ibantrim);
			    // $roboto_serial_no=$this->input->post('roboto_serial_no');
				$store_id=$this->input->post('store_id');
				$store_code=$this->Mdl_StoreCover->GetRecordUsers(array("id"=>$store_id));
				$nom_address=$this->input->post('nom_address');
				$postalcode=$this->input->post('postalcode');
				$vile=$this->input->post('vile');
				$complementad=$this->input->post('complementad');
				$store_country=$this->input->post('store_country');
				$langcurrent=$this->input->post('langcurrent');
				$siret=$this->input->post('siret');
				$clienttype=$this->input->post('contact');
				$nomstoreadditional=$this->input->post('nomstoreadditional');
				$uplodehidenfile=$this->input->post('uplodehidenfile');
				
				if (isset($_FILES['upload_proof']['name']) && $_FILES['upload_proof']['name'] != null) {
					 $filename = $_FILES['upload_proof']['name'];
					 $filedata = $_FILES['upload_proof']['tmp_name'];
					 $filesize = $_FILES['upload_proof']['size'];
					 $filetype = $_FILES['upload_proof']['type'];
					 $config['upload_path'] = 'upload/op3/';
					 $config['allowed_types'] = 'jpg|jpeg|png|pdf';
					 $config['file_name'] = $_FILES['upload_proof']['name'];
					if (!is_dir($config['upload_path'])) 
					{
						mkdir($config['upload_path']);
						
					}
					$this->load->library('upload',$config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('upload_proof'))
					{

						$uploadData = $this->upload->data();
						$pictured = $uploadData['file_name'];
						$img_url=$_FILES['upload_proof']['name'];
						$fileinsert=$filedata."#".$filetype."#".$filename;
						
					}
					else
					{
						
						$error=$this->upload->display_errors();
						$this->session->set_flashdata('error',$error['error']);
						//redirect('offre-cover');
						$pictured = '';
						$fileinsert = '';
					}
				}
				else if(!empty($uplodehidenfile)){
					$pictured = $uplodehidenfile;
					$fileinsert = $this->input->post('fileinsert');
				   }
				if($this->form_validation->run() === FALSE){
					$getrefunds = $this->Mdl_Refund->GetRecordUsers(array('refund.user_id'=>$_SESSION['front_user']['id']));
					$getstores = $this->Mdl_StoreCover->GetRecordUsers();
					$getcovers = $this->Mdl_Cover->GetRecordUsers();
					$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'front/proof_of_cover_purchase',
						'getrefunds'=>$getrefunds,
						'getstores'=>$getstores,
						'getcovers'=>$getcovers,
						'coupon_id'=>$coupon_id,
						'store_country'=>$store_country,
						'date_of_purchase'=>$date_of_purchase,
						'bank_bic'=>$bank_bic,
						'bank_iban'=>$bank_iban,
						'upload_proof'=>$pictured,
						'filesizeinfo'=>$fileinsert,
						//'upload_proof'=>$_FILES['upload_proof']['name'],
						// 'roboto_serial_no'=>$roboto_serial_no,
						'store_id'=>$store_id,
						'siret'=>$siret,
						'clienttype'=>$clienttype,
						'nomstoreadditional'=>$nomstoreadditional,
						'nom_address'=>$nom_address,
						);
					$this->load->view('front/template',$data);
				}else{

							if(!empty($_FILES['upload_proof']['name']) || !empty($uplodehidenfile) )
							{
								if(empty($uplodehidenfile) && !empty($_FILES['upload_proof']['name'])){
									$config['upload_path'] = 'upload/op3/';
									$config['allowed_types'] = 'jpg|jpeg|png|pdf';
									$config['file_name'] = $_FILES['upload_proof']['name'];
									if (!is_dir($config['upload_path'])) 
									{
										mkdir($config['upload_path']);
									}
									$this->load->library('upload',$config);
									$this->upload->initialize($config);
									if($this->upload->do_upload('upload_proof'))
									{
										$uploadData = $this->upload->data();
										$picture = $uploadData['file_name'];
										$img_url=$_FILES['upload_proof']['name'];
									}
									else
									{
										$error = array('error' => $this->upload->display_errors());
										$this->session->set_flashdata('error',$error['error']);
										redirect('offre-cover');
										$picture = '';
									}
								}
								else if(!empty($uplodehidenfile) && !empty($_FILES['upload_proof']['name']) ){
									$config['upload_path'] = 'upload/op3/';
									$config['allowed_types'] = 'jpg|jpeg|png|pdf';
									$config['file_name'] = $_FILES['upload_proof']['name'];
									if (!is_dir($config['upload_path'])) 
									{
										mkdir($config['upload_path']);
									}
									$this->load->library('upload',$config);
									$this->upload->initialize($config);
									if($this->upload->do_upload('upload_proof'))
									{
										$uploadData = $this->upload->data();
										$picture = $uploadData['file_name'];
										$img_url=$_FILES['upload_proof']['name'];
									}
									else
									{
										$error = array('error' => $this->upload->display_errors());
										$this->session->set_flashdata('error',$error['error']);
										redirect('offre-cover');
										$picture = '';
									}

								}
								else if(!empty($uplodehidenfile) && empty($_FILES['upload_proof']['name']) ){
									$picture = $uplodehidenfile;
								}
								
								if($this->input->post('store_id') == 'AUTRE'){ $storeid='148'; }
								if($this->input->post('store_id') != 'AUTRE'){ $storeid=$store_id;}

								

								$insert = array(
									'user_id'=>$user_id,
									'store_id'=>$storeid,
									'coupon_id'=>$coupon_id,
									'upload_proof'=>(!empty($picture)) ? $picture : null,
									'coupon_list_code'=>$date_of_purchase,
									'upload_proof_date'=>date('Y-m-d H:i:s'),
									'store_country'=>(!empty($store_country)) ? $store_country : null,
									'address'=>(!empty($nom_address)) ? $nom_address : null,
									'zipcode'=>(!empty($postalcode)) ? $postalcode : null,
									'city'=>(!empty($vile)) ? $vile : null,
									'addition_address'=>(!empty($complementad)) ? $complementad : null,
									'store_name_additional'=>(!empty($nomstoreadditional)) ? $nomstoreadditional : null,
									'iban'=>(!empty($bank_iban)) ? $bank_iban : null,
									'bic'=>(!empty($bank_bic)) ? $bank_bic : null,
									// 'robot_serial_no'=>(!empty($roboto_serial_no)) ? $roboto_serial_no : null,
									'siret'=>(!empty($siret)) ? $siret : null,
									'clienttype'=>(!empty($clienttype)) ? $clienttype : null,
									'created_date'=>date('Y-m-d H:i:s')
									);

									// print_r($insert);
									// exit;			
											
								if($this->Mdl_ProofCover->insert($insert)){

									
									
									$datef = str_replace('/', '-', $date_of_purchase);
									$new_date = date('Y-m-d', strtotime($date_of_purchase));
									
									if($langcurrent == "english"){
										$lang = "en-UK";
									}else {
										$lang = "fr-FR";
									}
									
									$base64_data = "";
									if(!empty($this->input->post('filesizeinfo'))  && $this->input->post('filesizeinfo')!=''){
										$etst=explode('#',$this->input->post('filesizeinfo'));
										$filename = $etst[2];
										$filedata = $etst[0];
										$filetype = $etst[1];
									}
									else{
										$filename = $_FILES['upload_proof']['name'];
										$filedata = $_FILES['upload_proof']['tmp_name'];
										$filesize = $_FILES['upload_proof']['size'];
										$filetype = $_FILES['upload_proof']['type'];
										
										$base64_data = file_get_contents( $filedata );
										$base64_data = base64_encode($base64_data);
									}
									
			
									$bank_ibantrim = str_replace(' ', '', $bank_iban);
									$dir=__DIR__;
									$finaldir=explode('application/controllers',$dir);
									$logpath=$finaldir[0].'dailylog/op1_'.date('d-m-Y').'.txt';
									
									
									// $parameters = array(
									// 	'operation->code' => '3001_BWT_LIGNEP_2022',
									// 	'contact->lname' => $user_detail_info['lastname'],
									// 	'contact->fname' => $user_detail_info['firstname'],
									// 	'contact->email' => $user_detail_info['email'],
									// 	'contact->mobile_phone' => $user_detail_info['phone'],
									// 	'contact->addresses{MED_SOCIAL_ADDRESS}->line4' => $user_detail_info['address1'],
									// 	'contact->addresses{MED_SOCIAL_ADDRESS}->line2' => $user_detail_info['address2'],
									// 	'contact->addresses{MED_SOCIAL_ADDRESS}->postal_code' => $user_detail_info['postcode'],
									// 	'contact->addresses{MED_SOCIAL_ADDRESS}->city' => $user_detail_info['city'],
									// 	'contact->iban->iban' => $bank_ibantrim,
									// 	//'contact->iban->iban' => '3001_RIB',
									// 	'contact->iban->bic' => $bank_bic,
									// 	'contact->addresses{MED_SOCIAL_ADDRESS}->country->code' => $user_detail_info['country'],
									// 	'language->code' => $lang,
									// 	'operations{3001_BWT_LIGNEP_2022}->participation->documents{3001_INVOICE}->order{0}->purchase_date' => $new_date,
									// 	'operations{3001_BWT_LIGNEP_2022}->participation->documents{3001_SERIAL_NUMBER}->order{0}->serial_number' =>$roboto_serial_no,
									// 	'operations{3001_BWT_LIGNEP_2022}->participation->documents{3001_INVOICE}->order{0}->attachment' => new CURLFile($filedata, $filetype, $filename)
									// );
									$parameters = array(
										'contact->civility->code' => 'REP_CIV_M',
										'contact->lname' => $user_detail_info['lastname'],
										'contact->fname' => $user_detail_info['firstname'],
										'contact->email' => $user_detail_info['email'],
										'contact->mobile_phone' => $user_detail_info['phone'],
										'contact->addresses{MED_SOCIAL_ADDRESS}->line4' => $user_detail_info['address1'],
										'contact->addresses{MED_SOCIAL_ADDRESS}->line2' => $user_detail_info['address2'],
										'contact->addresses{MED_SOCIAL_ADDRESS}->postal_code' => $user_detail_info['postcode'],
										'contact->addresses{MED_SOCIAL_ADDRESS}->city' => $user_detail_info['city'],
										'contact->iban->iban' => $bank_ibantrim,
										//'contact->iban->iban' => '3001_RIB',
										'contact->iban->bic' => $bank_bic,
										'contact->addresses{MED_SOCIAL_ADDRESS}->country->code' => $user_detail_info['country'],
										'language->code' => $lang,
										'operations{3734_BWT_COUVERTURE_PISCINE}->participation->documents{3734_INVOICE}->order{0}->purchase_date' => $new_date,
										'operations{3734_BWT_COUVERTURE_PISCINE}->participation->documents{3734_INVOICE}->order{0}->shop->code' => $store_code[0]['store_code'],
										'operations{3734_BWT_COUVERTURE_PISCINE}->participation->documents{3734_INVOICE}->order{0}->products{0}->code' => $coupon_code[0]['cover_code'],
										'operations{3734_BWT_COUVERTURE_PISCINE}->participation->documents{3734_INVOICE}->order{0}->products{0}->quantity' => '1',
										// 'operations{3734_BWT_COUVERTURE_PISCINE}->participation->documents{3734_INVOICE}->order{0}->attachment->base64_content' => $base64_data,
										'operations{3734_BWT_COUVERTURE_PISCINE}->participation->documents{3734_INVOICE}->order{0}->attachment->filename' => $filename,
										'duplicate_criteria' => $roboto_serial_no
									);
									$dateti='start log  APi  send Parameter : '.date('d-m-Y').PHP_EOL;
									file_put_contents($logpath, $dateti, FILE_APPEND);
									file_put_contents($logpath, print_r($parameters, true), FILE_APPEND);

									// echo'<pre>';print_r($parameters);  echo '</pre>';exit;
									$getproofs = $this->Mdl_ProofCover->GetRecord(array('user_id'=>$_SESSION['front_user']['id']));

									// $url = 'https://je-participe.fr/Carbone-Api-V2.1/Web/public/create-subscription';
									$url = 'https://je-participe.fr/Carbone-Api-V2.1/Web/public/create-participation';
									// $url = 'https://je-participe.fr/Carbone-Api-V2.1/Web/public';
									$curl = curl_init();
									curl_setopt($curl, CURLOPT_POST, 1);
									curl_setopt($curl, CURLOPT_POSTFIELDS, $parameters);
									curl_setopt($curl, CURLOPT_URL, $url);
									curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
									$result = curl_exec($curl);

									$api_status = json_decode($result, true);
									$update = array(
										'api_insert_data' => json_encode($parameters), 
										'api_status' => $api_status['status_code'], 
										'api_get_data' => $result 
									);
									$this->Mdl_ProofCover->update($update,array('purchase_id'=>end($getproofs)['purchase_id']));

									$user_get_templates_html = $this->Mdl_Template->GetRecordUsers(array('id'=>18));
									// $user_html = $user_get_templates_html[0]['template'];
									$settings = $this->Mdl_Settings->GetRecord();
									$email_body = '<!-- Header Section Start -->
													<table cellpadding="0" cellspacing="0" class="deviceWidth" id="HeaderSection" style="width:100%">
														<td style="background-color:#7bc2dc">
															<table border="0" cellpadding="0" cellspacing="0" class="center floatNone" style="margin:0 auto; width:100%">
																<tbody>
																	<tr><!-- Header logo -->
																		<td style="text-align:left; vertical-align:middle">
																		<div class="logoImg" id="header-LogoImage"><a href="#" style="outline: none !important; text-decoration: none;"><img alt="logo" src="https://www.summerbwt.fr/assets/image/logo.png" style="margin:0px auto; max-width:100%; width:250px" title="logo" /> </a></div>
																		</td>
																		<!-- Header logo end -->
																		<td style="text-align:right; vertical-align:middle">
																		<table align="center" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto; width:100%">
																			<tbody>
																				<tr>
																					<td style="text-align:right; vertical-align:middle">
																					<div class="bwtText" id="Header-right-text" style="text-align:right"><a href="#" style="outline: none !important; text-decoration: none;"><img alt="summer" src="https://www.summerbwt.fr/assets/image/summer.png" style="margin:0px auto; max-width:100%; width:130px" title="summer" /> </a></div>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																		</td>
																	</tr>
																</tbody>
															</table>
														</td>
													</table>
													<!-- Header Section Start -->

													<!-- Body section Start -->													
													<table align="left" border="0" cellpadding="0" cellspacing="0" class="deviceWidth1" style="border-spacing:0; margin:0 auto; width:1000px">
														<tbody>
															<tr>
																<td>&nbsp;</td>
															</tr>';
															foreach ($parameters as $parameter_key => $parameter_value) {
																$email_body .= '<tr>
																					<td style="text-align:left; vertical-align:top">
																						<div class="Text" id="bodycontent" style="color:#000000; font-size:20px; font-weight:normal; line-height:normal; text-align:left; vertical-align:top">' . $parameter_key . ' => ' . $parameter_value . '</div>
																					</td>
																				</tr>';
															}
															$email_body .= '
															<tr>
																<td>&nbsp;</td>
															</tr>	
														</tbody>
													</table>
													<!-- Body section end -->

													<!-- footer Start-->	
													<table align="center" border="0" cellpadding="0" cellspacing="0" class="deviceWidth1" style="border-spacing:0; margin:0 auto; width:1000px">
														<tbody>
															<tr>
																<td style="text-align:center; vertical-align:top">
																	<div class="Text" id="LISTblock_1" style="font-size:14px">CONTACT BWT</div>
																</td>
															</tr>
															<tr>
																<td>&nbsp;</td>
															</tr>
															<tr>
																<td style="text-align:center; vertical-align:top">
																	<div class="Text" id="bodycontent" style="color:#676b6d;  font-size:16px; font-weight:normal; line-height:normal; padding:0 20px; text-align:center; vertical-align:top">Vous avez particip&eacute; &agrave; notre offre Summer of Excellence BWT 2019, pour vous d&eacute;sabonner, <a href="https://www.summerbwt.fr/unsubscribe" style="color: #0070C0;">cliquez ici</a></div>
																</td>
															</tr>
															<tr>
																<td>&nbsp;</td>
															</tr>
															<tr>
																<td style="text-align:center; vertical-align:top">
																	<div class="Text" id="bodycontent" style="color:#676b6d; font-size:16px; font-weight:normal; line-height:normal; padding:0 20px; text-align:center; vertical-align:top">PROCOPI by BWT au capital de 7 000 000,00 &euro; - Si&egrave;ge social : Les Landes d&rsquo;Apign&eacute;, 35 650 LE RHEU<br />
																	SIRET : 333 263 846 - N&deg; de TVA intracommunautaire : FR37333263846 - Voir les modalit&eacute;s sur <a href="https://www.summerbwt.fr" style="color: #0070C0;">www.summerbwt.fr&quot;</a></div>
																</td>
															</tr>
															<tr>
																<td>&nbsp;</td>
															</tr>
														</tbody>
													</table>
													<!-- footer End-->';
									$this->load->library('email');
									$this->email->from($settings[0]['from_email'], 'BWT');
									$this->email->to('operations.bwt@phare-west.fr','BWT User');
									$this->email->subject($user_get_templates_html[0]['template_subject']);
									// $this->email->message($user_html);
									$this->email->message($email_body);
									$this->email->send();
									if (!$this->email->send()) {
										echo $this->email->print_debugger();
									}
									// echo "<pre>";
									// print_r($this->load->library('email'));
									// print_r($this->email->from($settings[0]['from_email'], 'BWT'));
									// print_r($this->email->to('fentest19@gmail.com','BWT User'));
									// print_r($this->email->subject($user_get_templates_html[0]['template_subject']));
									// print_r($this->email->message($user_html));
									// print_r($this->Mdl_Template->GetRecordUsers(array('id'=>21)));
									// print_r($user_get_templates_html);
									// print_r($user_detail_info['email']);
									// print_r($email);
									// echo "</pre>";
									// exit;

									// $this->db->set('api_insert_data',json_encode($parameters))->where('purchase_id',$end($getproofs)['purchase_id']) ->update('proof_of_cover_purchase');

									// if (curl_errno($curl)) {
									//    	$error_msg = curl_error($curl);
									//   	  echo "<h1>Error received</h1>";
									//  	echo'<pre>';
									//   	print_r($error_msg); echo '</pre>';exit;
									//   }else{
									//   	echo "<h1>API Response</h1>";
									//  	echo'<pre>'; print_r(json_decode($result)); echo '</pre>'; exit;
									//  } 

									// echo'<pre>';print_r($result);  echo '</pre>';exit;
									 
									if (curl_errno($curl)) {
										$error_msg = curl_error($curl);
										$dateti=PHP_EOL.'start log  APi  Response error here : '.date('d-m-Y').PHP_EOL;
										file_put_contents($logpath, $dateti, FILE_APPEND);
										file_put_contents($logpath, print_r($error_msg, true), FILE_APPEND);
										
										$getrefunds = $this->Mdl_Refund->GetRecordUsers(array('refund.user_id'=>$_SESSION['front_user']['id']));
										$getstores = $this->Mdl_StoreCover->GetRecordUsers();
										$getcovers = $this->Mdl_Cover->GetRecordUsers();
										$data=array('success'=>$this->session->flashdata('success'),
											'error'=>$this->session->flashdata('error'),
											'main_content'=>'front/proof_of_cover_purchase',
											'getrefunds'=>$getrefunds,
											'getstores'=>$getstores,
											'getcovers'=>$getcovers,
											'coupon_id'=>$coupon_id,
											'store_country'=>$store_country,
											'date_of_purchase'=>$date_of_purchase,
											'bank_bic'=>$bank_bic,
											'bank_iban'=>$bank_iban,
											'upload_proof'=>$pictured,
											'filesizeinfo'=>$fileinsert,
											//'upload_proof'=>$_FILES['upload_proof']['name'],
											// 'roboto_serial_no'=>$roboto_serial_no,
											'store_id'=>$store_id,
											'siret'=>$siret,
											'clienttype'=>$clienttype,
											'nomstoreadditional'=>$nomstoreadditional,
											'nom_address'=>$nom_address,
											);
										$this->load->view('front/template',$data);
										if($siteLang=='english'){
										$this->session->set_flashdata('error','Error while creating OFFRE DE REMBOURSEMENTCOVERS LIGNE P BWT EXCLUSIVEMENT!' );
										}else{
											$this->session->set_flashdata('error','Erreur lors de la création du OFFRE DE REMBOURSEMENTCOVERS LIGNE P BWT EXCLUSIVEMENT!' );
										}
										
									}
									else{
										$dateti='start log succes APi  Response :'.date('d-m-Y').PHP_EOL;
										file_put_contents($logpath, $dateti, FILE_APPEND);
										file_put_contents($logpath, print_r(json_decode($result), true), FILE_APPEND);
										$this->session->set_flashdata('success',lang('success_proof'));  
										redirect('thankyou_op1');
									}
									
									curl_close($curl);
									

								}else{
									if($siteLang=='english'){
										$this->session->set_flashdata('error','Error while creating OFFRE DE REMBOURSEMENTCOVERS LIGNE P BWT EXCLUSIVEMENT!' );
									}else{
										$this->session->set_flashdata('error','Erreur lors de la création du OFFRE DE REMBOURSEMENTCOVERS LIGNE P BWT EXCLUSIVEMENT!' );
									}
									redirect('offre-cover');

								}

							}else{

								if($siteLang=='english'){

									$this->session->set_flashdata('error','Please upload proof');

								}else{

									$this->session->set_flashdata('error','Veuillez télécharger la preuve');

								}

								redirect('offre-cover');

							}

						}

			}else{

				if($siteLang=='english'){

					$this->session->set_flashdata('error','Something went wrong!');

				}else{

					$this->session->set_flashdata('error','Quelque chose a mal tourné!');

				}

				redirect('offre-cover');

			}

		}else{

			if($siteLang=='english'){

				$this->session->set_flashdata('error','Please try again login');

			}else{

				$this->session->set_flashdata('error',"S'il vous plaît essayez à nouveau de vous connecter");

			}

			redirect('login');

		}

	}

	public function draw(){		
		$sidemenu_without_login=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu_without'));
		$sidemenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu'));
		$footermenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'footer_menu'));
		if(!empty($_SESSION['front_user'])){

			$getdraws = $this->Mdl_Draw->GetRecord(array('user_id'=>$_SESSION['front_user']['id']));
			$getstores = $this->Mdl_Store->GetRecordUsers();
			$anothergetstores = $this->Mdl_Store->GetRecordUsers(array('store_handle'=>0));
			$getcoupons = $this->Mdl_Coupon->GetRecordUsers();

			if(!empty($getdraws)){

					$data=array('success'=>$this->session->flashdata('success'),
							'error'=>$this->session->flashdata('error'),
							'main_content'=>'front/draw',
							'getdraws'=>$getdraws,
							'sidemenu'=>$sidemenu,
							'anothergetstores'=>$anothergetstores,
							'getstores'=>$getstores,
							'getcoupons'=>$getcoupons
					);
					$this->load->view('front/template',$data);

				}else{

					$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'front/draw',
						'sidemenu'=>$sidemenu,
						'footermenu'=>$footermenu,
						'getstores'=>$getstores,
						'anothergetstores'=>$anothergetstores,
						'getcoupons'=>$getcoupons
					);
					$this->load->view('front/template',$data);
				}

		}else{
			$data=array('success'=>$this->session->flashdata('success'),
			'error'=>$this->session->flashdata('error'),
			'sidemenu'=>$sidemenu_without_login,
			'footermenu'=>$footermenu,
			'main_content'=>'front/login'
			);
			$this->load->view('front/template',$data);

		}
	}
	public  function create_draw()
	{
	
		if(!empty($_SESSION['front_user'])){
	
				$user_id = $_SESSION['front_user']['id'];
				$user_detail_info=$this->Mdl_User->GetUsers(array("id"=>$user_id));
				$user_lang = $user_detail_info['usr_lang'];
				$email=$user_detail_info['email'];
				if($user_lang == "english"){
					$lang = "en-UK";
				}else if($user_lang == "netherland"){
					$lang = "NL";
				}else {
					$lang = "fr-FR";
				}
				$email = $_SESSION['front_user']['email'];
				$ispost=$this->input->method(TRUE);
				if($ispost=='POST'){
	
					$this->load->helper('form');
					$this->load->library('form_validation');
					$abcd = $this->input->post('store_country');
					$storename=$this->input->post('store_id');
					// set validation rules
					$siteLang = $this->session->userdata('site_lang');
					$langcurrent=$this->input->post('langcurrent');
					$store_id=$this->input->post('store_id');

	
					$another_store_handle=$this->input->post('another_store_handle');
	
						if($siteLang=='english'){
							$this->form_validation->set_rules('store_id', "Modal", 'trim|required|callback_select_validate2');
							$this->form_validation->set_rules('store_country', "Store Country", 'trim|required|callback_select_validate');
							if($this->input->post('store_id') == 'AUTRE'){
								$this->form_validation->set_rules('nomstoreadditional', "Store Name", 'trim|required');
								$this->form_validation->set_rules('nom_address', "Store Address", 'trim|required');
								$this->form_validation->set_rules('postalcode','Roboto Postal Code','trim|required');
								$this->form_validation->set_rules('vile','Roboto store  Vile','trim|required');
								//$this->form_validation->set_rules('complementad','Roboto store  Address2','trim|required');
							}
						}else{ 
							$this->form_validation->set_rules('store_id','Modal','required|callback_select_validate2',array('required'=>'Le champ modèle du robot est obligatoire.')); 
							$this->form_validation->set_rules('store_country','Store Country','required|callback_select_validate',array('required'=>'Le champ Pays est obligatoire.'));
							
							if($this->input->post('store_id') == 'AUTRE'){
								$this->form_validation->set_rules('nomstoreadditional','Store Name','required',array('required'=>"Nom de l'enseigne"));
								$this->form_validation->set_rules('nom_address','Roboto store  Address','required',array('required'=>'Le champ  l’adresse est obligatoire.'));
								$this->form_validation->set_rules('postalcode','Roboto Postal Code','required',array('required'=>'Le champ  Postal Code est obligatoire.'));
								$this->form_validation->set_rules('vile','Roboto store  Vile','required',array('required'=>'Le champ  Vile est obligatoire.'));
								
							}
							
						}
						$coupon_id=$this->input->post('coupon_id');
						$coupon_code=$this->Mdl_Coupon->GetRecordUsers(array("id"=>$coupon_id));
						$store_id=$this->input->post('store_id');
						$nomstoreadditional=$this->input->post('nomstoreadditional');
						$nom_address=$this->input->post('nom_address');
						$postalcode=$this->input->post('postalcode');
						$vile=$this->input->post('vile');
						$complementad=$this->input->post('complementad');
						$store_country=$this->input->post('store_country');
						$clienttype=$this->input->post('contact');
						$siret=$this->input->post('siret');
						$uplodehidenfile=$this->input->post('uplodehidenfile');
						$filesizeinfo=$this->input->post('filesizeinfo');


						if (isset($_FILES['upload_draw']['name']) && $_FILES['upload_draw']['name'] != null) {
							$filename = $_FILES['upload_draw']['name'];
							$filedata = $_FILES['upload_draw']['tmp_name'];
							$filesize = $_FILES['upload_draw']['size'];
							$filetype = $_FILES['upload_draw']['type'];
							$config['upload_path'] = 'upload/draw/';
							$config['allowed_types'] = 'jpg|jpeg|png|pdf';
							$config['file_name'] = $_FILES['upload_draw']['name'];
						   if (!is_dir($config['upload_path'])) 
						   {
							   mkdir($config['upload_path']);
							   
						   }
						   $this->load->library('upload',$config);
						   $this->upload->initialize($config);
						   if($this->upload->do_upload('upload_draw'))
						   {
	   
							   $uploadData = $this->upload->data();
							   $pictured = $uploadData['file_name'];
							   $img_url=$_FILES['upload_draw']['name'];
							   $fileinsert=$filedata."#".$filetype."#".$filename;
							   
						   }
						   else
						   {
							   
							   $error=$this->upload->display_errors();
							   $this->session->set_flashdata('error',$error['error']);
							   $pictured = '';
							   $fileinsert = '';
						   }
					   }else if(!empty($uplodehidenfile)){
						$pictured = $uplodehidenfile;
						$fileinsert = $this->input->post('fileinsert');
					   }
						
	
						if($this->form_validation->run() === FALSE){
							$getrefunds = $this->Mdl_Refund->GetRecordUsers(array('refund.user_id'=>$_SESSION['front_user']['id']));
							$getstores = $this->Mdl_Store->GetRecordUsers();
							$getcoupons = $this->Mdl_Coupon->GetRecordUsers();
							$country = $this->Mdl_Country->GetRecord(array('is_allow' => '1'));
							$data=array('success'=>$this->session->flashdata('success'),
								'error'=>$this->session->flashdata('error'),
								'main_content'=>'front/draw',
								'store_country'=>$store_country,
								//'upload_draw'=>$_FILES['upload_draw']['name'],
								'upload_draw'=>$pictured,
								'postalcode'=>$postalcode,
								'store_id'=>$store_id,
								'nom_address'=>$nom_address,
								'vile'=>$vile,
								'siret'=>$siret,
								'clienttype'=>$clienttype,
								'complementad'=>$complementad,
								'nomstoreadditional'=>$nomstoreadditional,
								'filesizeinfo'=>$fileinsert,
								);
							$this->load->view('front/template',$data);
						}else{


							if(!empty($_FILES['upload_draw']['name']) || !empty($uplodehidenfile) )
							{
								if(empty($uplodehidenfile) && !empty($_FILES['upload_draw']['name'])){
									$config['upload_path'] = 'upload/draw/';
									$config['allowed_types'] = 'jpg|jpeg|png|pdf';
									$config['file_name'] = $_FILES['upload_draw']['name'];
									if (!is_dir($config['upload_path'])) 	{	mkdir($config['upload_path']);}
		
									$this->load->library('upload',$config);
									$this->upload->initialize($config);
		
									if($this->upload->do_upload('upload_draw'))
									{
										$uploadData = $this->upload->data();
										$picture = $uploadData['file_name'];
										$img_url=$_FILES['upload_draw']['name'];
		
									}else{
		
										$error = array('error' => $this->upload->display_errors());
										$this->session->set_flashdata('error',$error['error']);
										redirect('gpcastellet');
										$picture = '';
		
									}
								}
								else if(!empty($uplodehidenfile) && !empty($_FILES['upload_draw']['name']) ){
									$config['upload_path'] = 'upload/draw/';
									$config['allowed_types'] = 'jpg|jpeg|png|pdf';
									$config['file_name'] = $_FILES['upload_draw']['name'];
									if (!is_dir($config['upload_path'])) 	{	mkdir($config['upload_path']);}
		
									$this->load->library('upload',$config);
									$this->upload->initialize($config);
		
									if($this->upload->do_upload('upload_draw'))
									{
										$uploadData = $this->upload->data();
										$picture = $uploadData['file_name'];
										$img_url=$_FILES['upload_draw']['name'];
		
									}else{
		
										$error = array('error' => $this->upload->display_errors());
										$this->session->set_flashdata('error',$error['error']);
										redirect('gpcastellet');
										$picture = '';
		
									}

								}
								else if(!empty($uplodehidenfile) && empty($_FILES['upload_draw']['name']) ){
									$picture = $uplodehidenfile;
								}

							

								if("AUTRE" == $store_id){
									$store_id = 148;
								}
								$insert = array(
	
									'user_id'=>$user_id,
									'store_id'=>$store_id,
									'coupon_id'=>$coupon_id,
									'upload_draw'=>(!empty($picture)) ? $picture : null,
									'upload_draw_date'=>date('Y-m-d H:i:s'),
									'address'=>(!empty($nom_address)) ? $nom_address : null,
									'zipcode'=>(!empty($postalcode)) ? $postalcode : null,
									'city'=>(!empty($vile)) ? $vile : null,
									'addition_address'=>(!empty($complementad)) ? $complementad : null,
									'store_name_additional'=>(!empty($nomstoreadditional)) ? $nomstoreadditional : null,
									'clienttype'=>(!empty($clienttype)) ? $clienttype : null,
									'siret'=>(!empty($siret)) ? $siret : null,
									'created_date'=>date('Y-m-d H:i:s')
			
								);
								
								$result = $this->Mdl_Draw->insert($insert);
								
								
								
								if($result){
									
									if(!empty($this->input->post('filesizeinfo'))  && $this->input->post('filesizeinfo')!=''){
										$etst=explode('#',$filesizeinfo);
										
										$filename = $etst[2];
										$filedata = $etst[0];
										$filetype = $etst[1];
									}
									else{
										$filename = $_FILES['upload_draw']['name'];
										$filedata = $_FILES['upload_draw']['tmp_name'];
										$filesize = $_FILES['upload_draw']['size'];
										$filetype = $_FILES['upload_draw']['type'];
									}
									
									
									if($langcurrent == "english"){
										$lang = "en-UK";
									}else {
										$lang = "fr-FR";
									}
									//$date = str_replace('/', '-', $var);
									$bank_bic='3002RIBQ';
									$new_date = date('Y-m-d');
									$parameters = array(
										'operation->code' => '3002_bwt_contrat_excellence_2022',
										'contact->lname' => $user_detail_info['lastname'],
										'contact->fname' => $user_detail_info['firstname'],
										'contact->email' => $user_detail_info['email'],
										'contact->mobile_phone' => $user_detail_info['phone'],
										'contact->addresses{MED_SOCIAL_ADDRESS}->line4' => $user_detail_info['address1'],
										'contact->addresses{MED_SOCIAL_ADDRESS}->line2' => $user_detail_info['address2'],
										'contact->addresses{MED_SOCIAL_ADDRESS}->postal_code' => $user_detail_info['postcode'],
										'contact->addresses{MED_SOCIAL_ADDRESS}->city' => $user_detail_info['city'],
										'contact->iban->iban' => $bank_ibantrim,	
									 	'contact->iban->iban' => '3002_RIB',
										'contact->iban->bic' => $bank_bic,
										'contact->addresses{MED_SOCIAL_ADDRESS}->country->code' => $user_detail_info['country'],
										'language->code' => $lang,
										'operations{3002_bwt_contrat_excellence_2022}->participation->documents{3002_INVOICE}->order{0}->products{0}->code' => $coupon_code[0]['cover_code'],
										'operations{3002_bwt_contrat_excellence_2022}->participation->documents{3002_INVOICE}->order{0}->purchase_date' => $new_date,
										'operations{3002_bwt_contrat_excellence_2022}->participation->documents{3002_INVOICE}->order{0}->attachment' => new CURLFile($filedata, $filetype, $filename)
									);
									 
									//echo'<pre>'; print_r($parameters); echo '</pre>';

									// $url = 'https://je-participe.fr/Carbone-Api-V2.1/Web/public/create-participation';
									// $curl = curl_init();
									// curl_setopt($curl, CURLOPT_POST, 1);
									// curl_setopt($curl, CURLOPT_POSTFIELDS, $parameters);
									// curl_setopt($curl, CURLOPT_URL, $url);
									// curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
									// $result = curl_exec($curl);
									
									
									//  if (curl_errno($curl)) {
									//  	 $error_msg = curl_error($curl);
									// 	  if($siteLang=='english'){$this->session->set_flashdata('error','Error while creating Draw!' ); }
									// 	  else{ $this->session->set_flashdata('error','Erreur lors de la création de Draw!' );  }
									// 	  $getrefunds = $this->Mdl_Refund->GetRecordUsers(array('refund.user_id'=>$_SESSION['front_user']['id']));
									// 	  $getstores = $this->Mdl_Store->GetRecordUsers();
									// 	  $getcoupons = $this->Mdl_Coupon->GetRecordUsers();
									// 	  $country = $this->Mdl_Country->GetRecord(array('is_allow' => '1'));
									// 	  $data=array('success'=>$this->session->flashdata('success'),
									// 		  'error'=>$this->session->flashdata('error'),
									// 		  'main_content'=>'front/draw',
									// 		  'store_country'=>$store_country,
									// 		  //'upload_draw'=>$_FILES['upload_draw']['name'],
									// 		  'upload_draw'=>'',
									// 		  'postalcode'=>$postalcode,
									// 		  'store_id'=>$store_id,
									// 		  'nom_address'=>$nom_address,
									// 		  'vile'=>$vile,
									// 		  'siret'=>$siret,
									// 		  'clienttype'=>$clienttype,
									// 		  'complementad'=>$complementad,
									// 		  'nomstoreadditional'=>$nomstoreadditional,
									// 		  'filesizeinfo'=>'',
									// 		  );
									// 	  $this->load->view('front/template',$data);
									//  }else{
									// 	$this->session->set_flashdata('success',lang('success_draw'));  
									// 	redirect('thankyou_op2');
									//  }
									// curl_close($curl);
									if($langcurrent == "english"){
										$user_get_templates_html=$this->Mdl_Template->GetRecordUsers(array('id'=>43));
									}
									else{
										
										$user_get_templates_html=$this->Mdl_Template->GetRecordUsers(array('id'=>44));
									}
									$user_html = $user_get_templates_html[0]['template'];	
									$settings = $this->Mdl_Settings->GetRecord();

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
			
														'Email' => $user_detail_info['email'],
			
														'Name' => "BWT User"
			
													]
			
												],
			
												'Subject' => $user_get_templates_html[0]['template_subject'],
			
												'TextPart' => $user_html,
			
												'HTMLPart' => $user_html
			
											]
			
										]
			
									];
			
									//$response = $mj->post(Resources::$Email, ['body' => $body]);


									$this->load->library('email');
									$this->email->from($settings[0]['from_email'], 'BWT');
									// $this->email->to($user_detail_info['email'],'BWT User');
									$this->email->to('operations.bwt@phare-west.fr','BWT User');
									$this->email->subject($user_get_templates_html[0]['template_subject']);
									$this->email->message($user_html);
									// echo "<pre>";
									// print_r($this->email->message($user_html));
									// echo "</pre>";
									// exit;
									try{
										$this->email->send();
										if($siteLang=='english'){

											$this->session->set_flashdata('success',lang('success_draw'));  
											redirect('thankyou_op2');

										}else{

											$this->session->set_flashdata('success',lang('success_draw'));  
											redirect('thankyou_op2');

										}
									}	
									catch(Exception $e){
										$this->session->set_flashdata('error',$e->getMessage());
										if($siteLang=='english'){$this->session->set_flashdata('error','Error while creating Draw!' ); }
										  else{ $this->session->set_flashdata('error','Erreur lors de la création de Draw!' );  }
										  $getrefunds = $this->Mdl_Refund->GetRecordUsers(array('refund.user_id'=>$_SESSION['front_user']['id']));
										  $getstores = $this->Mdl_Store->GetRecordUsers();
										  $getcoupons = $this->Mdl_Coupon->GetRecordUsers();
										  $country = $this->Mdl_Country->GetRecord(array('is_allow' => '1'));
										  $data=array('success'=>$this->session->flashdata('success'),
											  'error'=>$this->session->flashdata('error'),
											  'main_content'=>'front/draw',
											  'store_country'=>$store_country,
											  //'upload_draw'=>$_FILES['upload_draw']['name'],
											  'upload_draw'=>'',
											  'postalcode'=>$postalcode,
											  'store_id'=>$store_id,
											  'nom_address'=>$nom_address,
											  'vile'=>$vile,
											  'siret'=>$siret,
											  'clienttype'=>$clienttype,
											  'complementad'=>$complementad,
											  'nomstoreadditional'=>$nomstoreadditional,
											  'filesizeinfo'=>'',
											  );
										  $this->load->view('front/template',$data);
									}

									

								}
								else{
	
									if($siteLang=='english'){$this->session->set_flashdata('error','Error while creating Draw!' ); }
									else{ $this->session->set_flashdata('error','Erreur lors de la création de Draw!' );  }
									$getrefunds = $this->Mdl_Refund->GetRecordUsers(array('refund.user_id'=>$_SESSION['front_user']['id']));
									$getstores = $this->Mdl_Store->GetRecordUsers();
									$getcoupons = $this->Mdl_Coupon->GetRecordUsers();
									$country = $this->Mdl_Country->GetRecord(array('is_allow' => '1'));
									$data=array('success'=>$this->session->flashdata('success'),
										'error'=>$this->session->flashdata('error'),
										'main_content'=>'front/draw',
										'store_country'=>$store_country,
										//'upload_draw'=>$_FILES['upload_draw']['name'],
										'upload_draw'=>$pictured,
										'postalcode'=>$postalcode,
										'store_id'=>$store_id,
										'nom_address'=>$nom_address,
										'vile'=>$vile,
										'siret'=>$siret,
										'clienttype'=>$clienttype,
										'complementad'=>$complementad,
										'nomstoreadditional'=>$nomstoreadditional,
										'filesizeinfo'=>$fileinsert,
										);
									$this->load->view('front/template',$data);

									//redirect('gpcastellet');
		
	
								}
		}
							else{
								if($siteLang=='english'){
									 $this->session->set_flashdata('error','Please upload proof');
			
								}else{
									$this->session->set_flashdata('error','Veuillez télécharger la preuve');
			
								}
							$getrefunds = $this->Mdl_Refund->GetRecordUsers(array('refund.user_id'=>$_SESSION['front_user']['id']));
							$getstores = $this->Mdl_Store->GetRecordUsers();
							$getcoupons = $this->Mdl_Coupon->GetRecordUsers();
							$country = $this->Mdl_Country->GetRecord(array('is_allow' => '1'));
							$data=array('success'=>$this->session->flashdata('success'),
								'error'=>$this->session->flashdata('error'),
								'main_content'=>'front/draw',
								'store_country'=>$store_country,
								//'upload_draw'=>$_FILES['upload_draw']['name'],
								'upload_draw'=>'',
								'postalcode'=>$postalcode,
								'store_id'=>$store_id,
								'nom_address'=>$nom_address,
								'vile'=>$vile,
								'siret'=>$siret,
								'clienttype'=>$clienttype,
								'complementad'=>$complementad,
								'nomstoreadditional'=>$nomstoreadditional,
								'filesizeinfo'=>'',
								);
							$this->load->view('front/template',$data);
								//redirect('gpcastellet');
	
							}
	
						}
	
			  }
			  else{
				if($siteLang=='english'){
					$this->session->set_flashdata('error','Something went wrong!');
	
				}else{ $this->session->set_flashdata('error','Quelque chose a mal tourné!');
	
				}
				redirect('gpcastellet');
	
			  }     
			}
		else{
			if($siteLang=='english'){	$this->session->set_flashdata('error','Please try again login'); }
				else{ $this->session->set_flashdata('error',"S'il vous plaît essayez à nouveau de vous connecter"); }
				redirect('login');
		}
	
	}
	

	public function refund() {		

		$sidemenu_without_login=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu_without'));
		$sidemenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu'));
		$footermenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'footer_menu'));

		if(!empty($_SESSION['front_user'])){

			$getrefunds = $this->Mdl_Refund->GetRecordUsers(array('refund.user_id'=>$_SESSION['front_user']['id']));
			$getstores = $this->Mdl_Store->GetRecordUsers();
			$getcoupons = $this->Mdl_Coupon->GetRecordUsers();

			if(!empty($getrefunds)){

				$data=array('success'=>$this->session->flashdata('success'),

						'error'=>$this->session->flashdata('error'),

						'main_content'=>'front/refund',

						'getrefunds'=>$getrefunds,

						'getstores'=>$getstores,

						'getcoupons'=>$getcoupons

						);

				$this->load->view('front/template',$data);

			}else{

				$data=array('success'=>$this->session->flashdata('success'),

						'error'=>$this->session->flashdata('error'),

						'sidemenu'=>$sidemenu,

						'footermenu'=>$footermenu,
						
						'main_content'=>'front/refund',

						'getstores'=>$getstores,

						'getcoupons'=>$getcoupons

						);

				$this->load->view('front/template',$data);

			}

		}else{
			$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'sidemenu'=>$sidemenu_without_login,
						'footermenu'=>$footermenu,
						'main_content'=>'front/login'
			);
			$this->load->view('front/template',$data);
		}

    }

	public function create_refundnew()
	{

		if(!empty($_SESSION['front_user'])){
			$user_id = $_SESSION['front_user']['id'];
			$user_detail_info=$this->Mdl_User->GetUsers(array("id"=>$user_id));
			$user_lang = $user_detail_info['usr_lang'];
			if($user_lang == "english"){
				$lang = "en-UK";
			}else if($user_lang == "netherland"){
				$lang = "NL";
			}else {
				$lang = "fr-FR";
			}

			$email = $_SESSION['front_user']['email'];
			$username = $_SESSION['front_user']['firstname'].' '.$_SESSION['front_user']['lastname'] ;
			$ispost=$this->input->method(TRUE);
			if($ispost=='POST'){
				$this->load->helper('form');
				$this->load->library('form_validation');
				$abcd = $this->input->post('store_country');
				$cupid=$this->input->post('coupon_id');
				$storename=$this->input->post('store_id');
				// set validation rules
				$siteLang = $this->session->userdata('site_lang');
				if($siteLang =='english'){
					$this->form_validation->set_rules('messages','messages','trim|required|min_length[1000]');
					$this->form_validation->set_rules('coupon_id', "Modal", 'trim|required|callback_select_validate2');
					$this->form_validation->set_rules('date_of_purchase', "Date of purchase", 'trim|required');
				    $this->form_validation->set_rules('store_country', "Store Country", 'trim|required|callback_select_validate');
					$this->form_validation->set_rules('bank_bic', "Bank BIC", 'trim|required');
					$this->form_validation->set_rules('bank_iban', "Bank IBAN", 'trim|required');
					$this->form_validation->set_rules('roboto_serial_no', " Serial No", 'trim|required');
					$this->form_validation->set_rules('store_id', "Store name", 'trim|required|callback_select_validatestore');
				    if($this->input->post('store_id') == 'AUTRE'){
						$this->form_validation->set_rules('nomstoreadditional', "Store Name", 'trim|required');
						$this->form_validation->set_rules('nom_address', "Store Address", 'trim|required');
						$this->form_validation->set_rules('postalcode',' Postal Code','trim|required');
						$this->form_validation->set_rules('vile',' store  Vile','trim|required');
					 }
					
				}else{ 
					$this->form_validation->set_rules('messages','messages','required|min_length[1000]',array('required'=>'Le champ du message doit contenir au moins 1000 caractères.'));
				  	$this->form_validation->set_rules('coupon_id','Modal','required|callback_select_validate2',array('required'=>'Le champ modèle du robot est obligatoire.')); 
					$this->form_validation->set_rules('date_of_purchase','Date of purchase','required',array('required'=>'Le champ Date d`achat est obligatoire.'));
				    $this->form_validation->set_rules('store_country','Store Country','required|callback_select_validate',array('required'=>'Le champ Pays est obligatoire.'));
					$this->form_validation->set_rules('bank_bic','Bank Bic','required',array('required'=>'Le champ Bank BIC est obligatoire.'));
					$this->form_validation->set_rules('bank_iban','Bank IBAN','required',array('required'=>'Le champ Bank IBAN est obligatoire.'));
					$this->form_validation->set_rules('roboto_serial_no',' serial no','required',array('required'=>'Le champs numéro de série du  est obligatoire.'));
					$this->form_validation->set_rules('store_id','Store','required|callback_select_validatestore',array('required'=>'Le champ  le numéro de série du robot est obligatoire.'));
					if($this->input->post('store_id') == 'AUTRE'){
						$this->form_validation->set_rules('nomstoreadditional','Store Name','required',array('required'=>"Nom de l'enseigne"));
						$this->form_validation->set_rules('nom_address',' store  Address','required',array('required'=>'Le champ  l’adresse est obligatoire.'));
						$this->form_validation->set_rules('postalcode',' Postal Code','required',array('required'=>'Le champ  Postal Code est obligatoire.'));
						$this->form_validation->set_rules('vile',' store  Vile','required',array('required'=>'Le champ  Vile est obligatoire.'));
					}
					
				}
			
				$coupon_id=$this->input->post('coupon_id');
				$date_of_purchase=$this->input->post('date_of_purchase');
				$bank_bic=$this->input->post('bank_bic');
				$bank_iban=$this->input->post('bank_iban');
			    $roboto_serial_no=$this->input->post('roboto_serial_no');
				$store_id=$this->input->post('store_id');
				$messages=$this->input->post('messages');
				$nom_address=$this->input->post('nom_address');
				$nomstoreadditional=$this->input->post('nomstoreadditional');
				$postalcode=$this->input->post('postalcode');
				$vile=$this->input->post('vile');
				$complementad=$this->input->post('complementad');
				$store_country=$this->input->post('store_country');
				$langcurrent=$this->input->post('langcurrent');
				$siret=$this->input->post('siret');
				$clienttype=$this->input->post('contact');
				$uplodehidenfile=$this->input->post('uplodehidenfile');
				$filesizeinfo=$this->input->post('filesizeinfo');
				
				if (isset($_FILES['upload_proof']['name']) && $_FILES['upload_proof']['name'] != null) {
					 $filename = $_FILES['upload_proof']['name'];
					 $filedata = $_FILES['upload_proof']['tmp_name'];
					 $filesize = $_FILES['upload_proof']['size'];
					 $filetype = $_FILES['upload_proof']['type'];
					 $config['upload_path'] = 'upload/*op3/';
					 $config['allowed_types'] = 'jpg|jpeg|png|pdf';
					 $config['file_name'] = $_FILES['upload_proof']['name'];
					if (!is_dir($config['upload_path'])) 
					{
						mkdir($config['upload_path']);
						
					}
					$this->load->library('upload',$config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('upload_proof'))
					{

						$uploadData = $this->upload->data();
						$pictured = $uploadData['file_name'];
						$img_url=$_FILES['upload_proof']['name'];
						$filesizeinfo=$filedata."#".$filetype."#".$filename;
						
					}
					else
					{
						$error=$this->upload->display_errors();
						$this->session->set_flashdata('error',$error['error']);
						//redirect('offre-robot');
						$pictured = '';
						$filesizeinfo = '';
					}
				}else if(!empty($uplodehidenfile)){
					$pictured = $uplodehidenfile;
					$filesizeinfo =$this->input->post('filesizeinfo');
				}
				
				if($this->form_validation->run() === FALSE){
				    $getrefunds = $this->Mdl_Refund->GetRecordUsers(array('refund.user_id'=>$_SESSION['front_user']['id']));
					$getstores = $this->Mdl_Store->GetRecordUsers();
					$getcoupons = $this->Mdl_Coupon->GetRecordUsers();
					$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'front/refund',
						'getrefunds'=>$getrefunds,
						'getstores'=>$getstores,
						'getcoupons'=>$getcoupons,
						'messages'=>$messages,
						'store_of_purchase'=>$store_of_purchase,
						'date_of_purchase'=>$date_of_purchase,
						'coupon_id'=>$coupon_id,
						'store_country'=>$store_country,
						'bank_bic'=>$bank_bic,
						'bank_iban'=>$bank_iban,
						'upload_proof'=>$pictured,
						'roboto_serial_no'=>$roboto_serial_no,
						'store_id'=>$store_id,
						'nom_address'=>$nom_address,
						'nomstoreadditional'=>$nomstoreadditional,
						'vile'=>$vile,
						'postalcode'=>$postalcode,
						'complementad'=>$complementad,
						'siret'=>$siret,
						'clienttype'=>$clienttype,
						'filesizeinfo'=>$filesizeinfo
						);
					$this->load->view('front/template',$data);

				}else{

					if(!empty($_FILES['upload_proof']['name']) || !empty($uplodehidenfile) )
							{
								if(empty($uplodehidenfile) && !empty($_FILES['upload_proof']['name'])){
									$config['upload_path'] = 'upload/*op3/';
									$config['allowed_types'] = 'jpg|jpeg|png|pdf';
									$config['file_name'] = $_FILES['upload_proof']['name'];
									if (!is_dir($config['upload_path'])) 
									{
										mkdir($config['upload_path']);
									}
									$this->load->library('upload',$config);
									$this->upload->initialize($config);
									if($this->upload->do_upload('upload_proof'))
									{
										$uploadData = $this->upload->data();
										$picture = $uploadData['file_name'];
										$img_url=$_FILES['upload_proof']['name'];
									}
									else
									{
										$error = array('error' => $this->upload->display_errors());
										$this->session->set_flashdata('error',$error['error']);
										redirect('contrat-dexcellence');
										$picture = '';
									}

								}
								else if(!empty($uplodehidenfile) && !empty($_FILES['upload_proof']['name']) ){
									$config['upload_path'] = 'upload/*op3/';
									$config['allowed_types'] = 'jpg|jpeg|png|pdf';
									$config['file_name'] = $_FILES['upload_proof']['name'];
									if (!is_dir($config['upload_path'])) 
									{
										mkdir($config['upload_path']);
									}
									$this->load->library('upload',$config);
									$this->upload->initialize($config);
									if($this->upload->do_upload('upload_proof'))
									{
										$uploadData = $this->upload->data();
										$picture = $uploadData['file_name'];
										$img_url=$_FILES['upload_proof']['name'];
									}
									else
									{
										$error = array('error' => $this->upload->display_errors());
										$this->session->set_flashdata('error',$error['error']);
										redirect('contrat-dexcellence');
										$picture = '';
									}

								}
								else if(!empty($uplodehidenfile) && empty($_FILES['upload_proof']['name']) ){
									$picture = $uplodehidenfile;
								}
	
								if($this->input->post('store_id') == 'AUTRE'){ $storeid='148'; }
								if($this->input->post('store_id') != 'AUTRE'){ $storeid=$store_id;}

								$insert = array(
									'user_id'=>$user_id,
									'modal'=>$coupon_id,
									'date_of_purchase'=>$date_of_purchase,
									'store_id'=>$storeid,
									'upload_proof'=>(!empty($picture)) ? $picture : null,
									'messages'=>(!empty($messages)) ? $messages : null,
									'store_country'=>(!empty($store_country)) ? $store_country : null,
									'bank_bic'=>(!empty($bank_bic)) ? $bank_bic : null,
									'bank_iban'=>(!empty($bank_iban)) ? $bank_iban : null,
									'created_date'=>date('Y-m-d H:i:s'),
									'roboto_serial_no'=>(!empty($roboto_serial_no)) ? $roboto_serial_no : null,
									'address'=>(!empty($nom_address)) ? $nom_address : null,
									'postcode'=>(!empty($postalcode)) ? $postalcode : null,
									'city'=>(!empty($vile)) ? $vile : null,
									'addition_address'=>(!empty($complementad)) ? $complementad : null,
									'store_name_additional'=>(!empty($nomstoreadditional)) ? $nomstoreadditional : null,
									'clienttype'=>(!empty($clienttype)) ? $clienttype : null,
									'siret'=>(!empty($siret)) ? $siret : null,
									);
	
								if($this->Mdl_Refund->insert($insert)){

									if(!empty($this->input->post('filesizeinfo'))  && $this->input->post('filesizeinfo')!=''){
										$etst=explode('#',$this->input->post('filesizeinfo'));
										
										$filename = $etst[2];
										$filedata = $etst[0];
										$filetype = $etst[1];
									}
									else{
										$filename = $_FILES['upload_proof']['name'];
										$filedata = $_FILES['upload_proof']['tmp_name'];
										$filesize = $_FILES['upload_proof']['size'];
										$filetype = $_FILES['upload_proof']['type'];
									}

										
								
								$date = str_replace('/', '-', $date_of_purchase);
								$new_date = date('Y-m-d', strtotime($date_of_purchase));
								$bank_iban=$this->input->post('bank_iban');
								$bank_ibantrim = str_replace(' ', '', $bank_iban);
								
								if($langcurrent == "english"){
									$lang = "en-UK";
								}else {
									$lang = "fr-FR";
								}

								$dirop=__DIR__;
								$finaldire=explode('application/controllers',$dirop);
								$logpathop=$finaldire[0].'dailylog/op3_'.date('d-m-Y').'.txt';
								

								$parameters = array(
									'operation->code' => '3002_bwt_contrat_excellence_2022',
									'contact->lname' => $user_detail_info['lastname'],
									'contact->fname' => $user_detail_info['firstname'],
									'contact->email' => $user_detail_info['email'],
									'contact->mobile_phone' => $user_detail_info['phone'],
									'contact->addresses{MED_SOCIAL_ADDRESS}->line4' => $user_detail_info['address1'],
									'contact->addresses{MED_SOCIAL_ADDRESS}->line2' => $user_detail_info['address2'],
									'contact->addresses{MED_SOCIAL_ADDRESS}->postal_code' => $user_detail_info['postcode'],
									'contact->addresses{MED_SOCIAL_ADDRESS}->city' => $user_detail_info['city'],
									'contact->iban->iban' => $bank_ibantrim,
									'contact->iban->bic' => $this->input->post('bank_bic'),
									'contact->addresses{MED_SOCIAL_ADDRESS}->country->code' => $user_detail_info['country'],
									'language->code' => $lang,
									'operations{3002_bwt_contrat_excellence_2022}->participation->documents{3002_INVOICE}->order{0}->comment1' => $this->input->post('messages'),
									/*'operations{2555_SOR_ROBOTS_LIGNEP}->custom{2555_INSATISFACTION}->value' => $this->input->post('messages'),*/
									'operations{3002_bwt_contrat_excellence_2022}->participation->documents{3002_INVOICE}->order{0}->purchase_date' => $new_date,
									'operations{3002_bwt_contrat_excellence_2022}->participation->documents{3002_SERIAL_NUMBER}->order{0}->serial_number' =>$roboto_serial_no,
									'operations{3002_bwt_contrat_excellence_2022}->participation->documents{3002_INVOICE}->order{0}->attachment' => new CURLFile($filedata, $filetype, $filename)
								);
									$datetio=PHP_EOL . 'start log  APi  send Parameter : '.date('d-m-Y').PHP_EOL;
									file_put_contents($logpathop, $datetio, FILE_APPEND);
									file_put_contents($logpathop, print_r($parameters, true), FILE_APPEND);
								//echo'<pre>'; print_r($parameters); echo '</pre>';
									
							$url = 'https://je-participe.fr/Carbone-Api-V2.1/Web/public/create-participation';
							$curl = curl_init();
							curl_setopt($curl, CURLOPT_POST, 1);
							curl_setopt($curl, CURLOPT_POSTFIELDS, $parameters);
							curl_setopt($curl, CURLOPT_URL, $url);
							curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
							$result = curl_exec($curl);

							// if (curl_errno($curl)) {
							//   	$error_msg = curl_error($curl);
						    //  	echo'<pre>';
							//   	print_r($error_msg); echo '</pre>'; exit;
							//  }else{
							//  	echo'<pre>'; print_r(json_decode($result)); echo '</pre>'; exit;
							//   } 
							  
							  
						    if (curl_errno($curl)) {
									$error_msg = curl_error($curl);
									$datetic=PHP_EOL . 'start log  APi  Response Error: '.date('d-m-Y').PHP_EOL;
									file_put_contents($logpathop, $datetic, FILE_APPEND);
									file_put_contents($logpathop, print_r($error_msg, true), FILE_APPEND);
								if($siteLang=='english'){
									$this->session->set_flashdata('error','Error while creating Refund! Please uplode image' );
	
								}else{
									$this->session->set_flashdata('error','Erreur lors de la création du remboursement .Veuillez télécharger la preuve' );
	
								}
								//redirect('contrat-dexcellence');
								$getrefunds = $this->Mdl_Refund->GetRecordUsers(array('refund.user_id'=>$_SESSION['front_user']['id']));
								$getstores = $this->Mdl_Store->GetRecordUsers();
								$getcoupons = $this->Mdl_Coupon->GetRecordUsers();
								$data=array('success'=>$this->session->flashdata('success'),
									'error'=>$this->session->flashdata('error'),
									'main_content'=>'front/refund',
									'getrefunds'=>$getrefunds,
									'getstores'=>$getstores,
									'getcoupons'=>$getcoupons,
									'messages'=>$messages,
									'store_of_purchase'=>$store_of_purchase,
									'date_of_purchase'=>$date_of_purchase,
									'coupon_id'=>$coupon_id,
									'store_country'=>$store_country,
									'bank_bic'=>$bank_bic,
									'bank_iban'=>$bank_iban,
									'upload_proof'=>'',
									'roboto_serial_no'=>$roboto_serial_no,
									'store_id'=>$store_id,
									'nom_address'=>$nom_address,
									'nomstoreadditional'=>$nomstoreadditional,
									'vile'=>$vile,
									'postalcode'=>$postalcode,
									'complementad'=>$complementad,
									'siret'=>$siret,
									'clienttype'=>$clienttype,
									'filesizeinfo'=>''
									);
								$this->load->view('front/template',$data);
							}
							else{
								$datetig=PHP_EOL . 'start log  APi  Response Sucess: '.date('d-m-Y').PHP_EOL;
								file_put_contents($logpathop, $datetig, FILE_APPEND);
								file_put_contents($logpathop, print_r(json_decode($result), true), FILE_APPEND);
								
								$this->session->set_flashdata('success',lang('success_refund'));  
								redirect('thankyou_op3');

							}
							curl_close($curl);

						}else{

							if($siteLang=='english'){
								$this->session->set_flashdata('error','Error while creating Refund!' );

							}else{
								$this->session->set_flashdata('error','Erreur lors de la création du remboursement!' );

							}
							$getrefunds = $this->Mdl_Refund->GetRecordUsers(array('refund.user_id'=>$_SESSION['front_user']['id']));
								$getstores = $this->Mdl_Store->GetRecordUsers();
								$getcoupons = $this->Mdl_Coupon->GetRecordUsers();
								$data=array('success'=>$this->session->flashdata('success'),
									'error'=>$this->session->flashdata('error'),
									'main_content'=>'front/refund',
									'getrefunds'=>$getrefunds,
									'getstores'=>$getstores,
									'getcoupons'=>$getcoupons,
									'messages'=>$messages,
									'store_of_purchase'=>$store_of_purchase,
									'date_of_purchase'=>$date_of_purchase,
									'coupon_id'=>$coupon_id,
									'store_country'=>$store_country,
									'bank_bic'=>$bank_bic,
									'bank_iban'=>$bank_iban,
									'upload_proof'=>'',
									'roboto_serial_no'=>$roboto_serial_no,
									'store_id'=>$store_id,
									'nom_address'=>$nom_address,
									'nomstoreadditional'=>$nomstoreadditional,
									'vile'=>$vile,
									'postalcode'=>$postalcode,
									'complementad'=>$complementad,
									'siret'=>$siret,
									'clienttype'=>$clienttype,
									'filesizeinfo'=>''
									);
								$this->load->view('front/template',$data);
							//redirect('contrat-dexcellence');

						}

					}else{

						if($siteLang=='english'){

							$this->session->set_flashdata('error','Please upload proof');

						}else{
							$this->session->set_flashdata('error','Veuillez télécharger la preuve');
						}
						$getrefunds = $this->Mdl_Refund->GetRecordUsers(array('refund.user_id'=>$_SESSION['front_user']['id']));
								$getstores = $this->Mdl_Store->GetRecordUsers();
								$getcoupons = $this->Mdl_Coupon->GetRecordUsers();
								$data=array('success'=>$this->session->flashdata('success'),
									'error'=>$this->session->flashdata('error'),
									'main_content'=>'front/refund',
									'getrefunds'=>$getrefunds,
									'getstores'=>$getstores,
									'getcoupons'=>$getcoupons,
									'messages'=>$messages,
									'store_of_purchase'=>$store_of_purchase,
									'date_of_purchase'=>$date_of_purchase,
									'coupon_id'=>$coupon_id,
									'store_country'=>$store_country,
									'bank_bic'=>$bank_bic,
									'bank_iban'=>$bank_iban,
									'upload_proof'=>'',
									'roboto_serial_no'=>$roboto_serial_no,
									'store_id'=>$store_id,
									'nom_address'=>$nom_address,
									'nomstoreadditional'=>$nomstoreadditional,
									'vile'=>$vile,
									'postalcode'=>$postalcode,
									'complementad'=>$complementad,
									'siret'=>$siret,
									'clienttype'=>$clienttype,
									'filesizeinfo'=>''
									);
								$this->load->view('front/template',$data);
						//redirect('contrat-dexcellence');
					}
				}
			}else{

				if($siteLang=='english'){

					$this->session->set_flashdata('error','Something went wrong!');

				}else{
						$this->session->set_flashdata('error','Quelque chose a mal tourné!');
				}

				redirect('contrat-dexcellence');

			}

		}else{

			if($siteLang=='english'){

				$this->session->set_flashdata('error','Please try again login');

			}else{

				$this->session->set_flashdata('error',"S'il vous plaît essayez à nouveau de vous connecter");

			}

			redirect('login');

		}

	}
	
	public function support(){	
		$sidemenu_without_login=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu_without'));
		$sidemenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu'));
		$footermenu=$this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'footer_menu'));
		if(!empty($_SESSION['front_user'])){
			$getsupports = $this->Mdl_Clientsupport->GetSupport(array('user_id'=>$_SESSION['front_user']['id']));
			$data=array('success'=>$this->session->flashdata('success'),
			'error'=>$this->session->flashdata('error'),
			'sidemenu'=>$sidemenu,
			'footermenu'=>$footermenu,
			'main_content'=>'front/support',
			'getsupports'=>$getsupports
			);
			$this->load->view('front/template',$data);
		}else{
				$data=array('success'=>$this->session->flashdata('success'),
				'error'=>$this->session->flashdata('error'),
				'sidemenu'=>$sidemenu_without_login,
				'footermenu'=>$footermenu,
				'main_content'=>'front/login'
				);
				$this->load->view('front/template',$data);
		}
	}
    public function create_support(){

		if(!empty($_SESSION['front_user'])){
			$ispost=$this->input->method(TRUE);
			if($ispost=='POST'){

				$this->load->helper('form');
				$this->load->library('form_validation');
				$siteLang = $this->session->userdata('site_lang');
				// set validation rules
				if($siteLang=='english'){
					$this->form_validation->set_rules('firstname','First Name','required|callback_checkstring',array('required'=>'The First Name field is required', 'checkstring'=>'The firstname field must contain aplhabets only')); 
					$this->form_validation->set_rules('lastname','Last Name','trim|required|callback_checkstring',array('required'=>'The Last Name field is required', 'checkstring'=>'The lastname field must contain aplhabets only'));  
					$this->form_validation->set_rules('city','City','trim|required|callback_checkstring',array('required'=>'The City field is required', 'checkstring'=>'The City field must contain aplhabets only')); 
					$this->form_validation->set_rules('email', "Email", 'trim|required|valid_email');
							$this->form_validation->set_rules('phone', "Phone Number", 'trim|required|regex_match[/^[0-9]{10}$/]');
							$this->form_validation->set_rules('address1', "Address 1", 'trim|required');
							$this->form_validation->set_rules('postcode','Postcode','required|regex_match[/^[0-9]{5}$/]',array('required'=>'Postcode Field is required','regex_match'=>'Please add the valid Postcode like 69001 (5 digits )'));
							$this->form_validation->set_rules('country', "Country", 'trim|required');
							$this->form_validation->set_rules('your_request', "Your Request", 'trim|required');
				}else{
					$this->form_validation->set_rules('firstname','First Name','required|callback_checkstring',array('required'=>'Le prénom est obligatoire', 'checkstring'=>'Le champ du prénom ne doit contenir que des alphabets')); 
					$this->form_validation->set_rules('lastname','Last Name','trim|required|callback_checkstring',array('required'=>'Le champ Nom est obligatoire', 'checkstring'=>'Le champ nom de famille ne doit contenir que des aplhabets')); 
					$this->form_validation->set_rules('city','City','trim|required|callback_checkstring',array('required'=>'La ville est obligatoire', 'checkstring'=>'Le champ de la ville ne doit contenir que des alphabets')); 
						$this->form_validation->set_rules('email','Email','required',array('required'=>'Le champ email est obligatoire.'));
							$this->form_validation->set_rules('phone','Phone Number','required|regex_match[/^[0-9]{10}$/]',array('required'=>'Le téléphone est obligatoire','regex_match'=>'s il vous plaît entrer un numéro de téléphone valide'));
							$this->form_validation->set_rules('address1','Address 1','required',array('required'=>'Le champ Adresse 1 est obligatoire.'));
							$this->form_validation->set_rules('postcode','Postcode','required|regex_match[/^[0-9]{5}$/]',array('required'=>'Le code postal est obligatoire.','regex_match'=>'Veuillez ajouter le code postal valide comme 69001 (5 chiffres)'));$this->form_validation->set_rules('city','City','required',array('required'=>'Le champ Ville est obligatoire.'));
							$this->form_validation->set_rules('country','Country','required',array('required'=>'Le champ Pays est obligatoire.'));
							$this->form_validation->set_rules('your_request','Your Request','required',array('required'=>'Le champ Votre demande est obligatoire.'));

				}
				if(!empty($this->input->post('phone'))){
					$pattern = '/^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$/';
					$phonecheck= preg_match($pattern, $this->input->post('phone'));
					if($phonecheck == 0){
						if($siteLang=='english'){
							$this->session->set_flashdata('error','Please format your phone as follows: 0612131415, 0231878889…' );
							$this->form_validation->set_rules('phone','Phone Number','required',array('required'=>'Please format your phone as follows : 0612131415, 0231878889…'));
						}else{
							$this->session->set_flashdata('error','Merci de formater votre téléphone comme suit : 0612131415, 0231878889…' );
							$this->form_validation->set_rules('phone','Phone Number','required',array('required'=>'Merci de formater votre téléphone comme suit : 0612131415, 0231878889…'));
						}
					}
				}

				$firstname=$this->input->post('firstname');
				$lastname=$this->input->post('lastname');
				$email=$this->input->post('email');
				$phone=$this->input->post('phone');
				$address1=$this->input->post('address1');
				$address2=$this->input->post('address2');
				$postcode=$this->input->post('postcode');
				$city=$this->input->post('city');
				$country=$this->input->post('country');
				$your_request=$this->input->post('your_request');
				if($this->form_validation->run() === FALSE){

					$getSupports = $this->Mdl_Clientsupport->GetSupport(array('user_id'=>$_SESSION['front_user']['id']));
					$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'front/support',
						'getSupports'=>$getSupports
					);
					$this->load->view('front/template',$data);
				}else{

					if(!empty($this->input->post('phone'))){
						$pattern = '/^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$/';
						$phonecheck= preg_match($pattern, $this->input->post('phone'));
						if($phonecheck == 1){
						
					$insert = array(
							'user_id'=>$_SESSION['front_user']['id'],
							'firstname'=>$firstname,
							'lastname'=>$lastname,
							'email'=>$email,
							'phone'=>$phone,
							'address1'=>$address1,
							'address2'=>$address2,
							'postcode'=>$postcode,
							'city'=>$city,
							'country'=>$country,
							'your_request'=>$your_request,
							'created_date'=>date('Y-m-d H:i:s')
					);
					if($this->Mdl_Clientsupport->insert($insert)){
						$settings=$this->Mdl_Settings->GetRecord();
						$template_subject = 'Client Support';
						$template = '<p>First Name : '.$firstname.'</p><p>Last Name : '.$lastname.'</p><p>Email: '.$email.'</p><p>Phone : '.$phone.'</p><p>Address: '.$address1.'<br/>'.$address2.','.$city.'</p><p>Country : '.$country.'</p><p>Client Request : '.$your_request.'</p>';
						
				$body = [

					'Messages' => [

						[

							'From' => [

							'Email' => $settings[0]['from_email'],
							'Name' => "BWT"

							],

							'To' => [

								[

									'Email' => 'service.client-bwt@take-off.fr,marc@webstorm.fr',

									'Name' => "BWT User"

								]

							],

							'Subject' => $template_subject,

							'TextPart' => '',

							'HTMLPart' => $template

						]

					]

				];

				//$response = $mj->post(Resources::$Email, ['body' => $body]);
					    $this->load->library('email');
						$this->email->from($settings[0]['from_email'], 'BWT');
						$this->email->to('service.client-bwt@take-off.fr','BWT User');
						$list = array('marc@webstorm.fr');
						$this->email->cc($list);
						$this->email->subject($template_subject);
						$this->email->message($template);
						try{
						$this->email->send();
						
						}catch(Exception $e){
							$this->session->set_flashdata('error',$e->getMessage());

						}
						if($siteLang=='english'){
							$this->session->set_flashdata('success','Support Successfully Created' );

						}else{
							$this->session->set_flashdata('success','Support créé avec succès' );

						}
						redirect('support');

					}else{

						if($siteLang=='english'){

							$this->session->set_flashdata('error','Error while creating profile!' );

						}else{

							$this->session->set_flashdata('error','Erreur lors de la création du profil!' );

						}

						redirect('support');

					}

				}
					else{
						if($siteLang=='english'){
							$this->session->set_flashdata('error','Please format your phone as follows: 0612131415, 0231878889…' );
							$this->form_validation->set_rules('phone','Phone Number','required',array('required'=>'Please format your phone as follows : 0612131415, 0231878889…'));
						}else{
							$this->session->set_flashdata('error','Merci de formater votre téléphone comme suit : 0612131415, 0231878889…' );
							$this->form_validation->set_rules('phone','Phone Number','required',array('required'=>'Merci de formater votre téléphone comme suit : 0612131415, 0231878889…'));
						}
						$getSupports = $this->Mdl_Clientsupport->GetSupport(array('user_id'=>$_SESSION['front_user']['id']));
						$data=array('success'=>$this->session->flashdata('success'),
							'error'=>$this->session->flashdata('error'),
							'main_content'=>'front/support',
							'getSupports'=>$getSupports
						);
						$this->load->view('front/template',$data);
					}

				}

			}

			}else{redirect('support'); 

			}

		}else{

			redirect('login'); 

		}

	}
	public function unsubscribe(){	

		//if(!empty($_SESSION['front_user'])){

			$data=array('success'=>$this->session->flashdata('success'),

				'error'=>$this->session->flashdata('error'),

				'main_content'=>'front/unsubscribe'

				);

			$this->load->view('front/template',$data);

		/*}else{

			redirect('login'); 

		}*/

    }

	function select_validate($abcd)
	{	if($abcd=="none"){
			$this->form_validation->set_message('select_validate', 'Le champ Pays est obligatoire.');
				return false;
			} else{
				return true;
			}
	}   
	public function check_unsubcribe()

	{

		//if(!empty($_SESSION['front_user'])){

			$ispost=$this->input->method(TRUE);

			if($ispost=='POST'){

				$this->load->helper('form');

				$this->load->library('form_validation');

				// set validation rules

				$this->form_validation->set_rules('is_Unsubscribe','Email','required|valid_email',array('required'=>'Le champ Email est obligatoire','valid_email'=>'Le format de l email est erroné')); 

				//$this->form_validation->set_rules('is_Unsubscribe', "Email", 'trim|required|valid_email');

				$is_Unsubscribe=$this->input->post('is_Unsubscribe');

				

				if($this->form_validation->run() === FALSE){

					$data=array('success'=>$this->session->flashdata('success'),

						'error'=>$this->session->flashdata('error'),

						'main_content'=>'front/unsubscribe'

						);

					$this->load->view('front/template',$data);

				}else{

					$update = array(

						'is_Unsubscribe'=>1,

						'updated_date'=>date('Y-m-d H:i:s')

					);

					if($this->Mdl_User->UpdateUserByEmail($update,$is_Unsubscribe)){

						if($siteLang=='english'){

							$this->session->set_flashdata('success','User Unsubscribe successfully' );

						}else{

							$this->session->set_flashdata('success','Désinscription de l`utilisateur avec succès' );

						}

					}else{

						if($siteLang=='english'){

							$this->session->set_flashdata('error','Error while user unsubscribe!' );

						}else{

							$this->session->set_flashdata('error','Erreur lors de la désinscription de l`utilisateur!' );

						}

					}

					redirect('unsubscribe');

				}

			}else{

				redirect('unsubscribe');

			}

		/*}else{

			redirect('login'); 

		}*/

	}

	

	public function cron_proof(){

		$today = date('Y-m-d');

		$proofs=$this->Mdl_Proof->GetProofofcoupon(array('proof_of_purchase.cron_status'=>0,'proof_of_purchase.cron_date'=>$today,'users.is_Unsubscribe'=>0));

		if(!empty($proofs)){

			//start mailjet

			$settings=$this->Mdl_Settings->GetRecord();

			$apikey = $settings[0]['username'];

			$apisecret = $settings[0]['password'];

			$mj = new \Mailjet\Client($apikey, $apisecret,true,['version' => 'v3.1']);

			foreach($proofs as $proof){

				$get_templates=$this->Mdl_Template->GetRecordUsers(array('id'=>19));

				$template_subject = $get_templates[0]['template_subject'];

				$template = $get_templates[0]['template'];

				$body = [

					'Messages' => [

						[

							'From' => [

								'Email' => $settings[0]['from_email'],

								'Name' => "BWT"

							],

							'To' => [

								[

									'Email' => $proof['email'],

									'Name' => "BWT User"

								]

							],

							'Subject' => $template_subject,

							'TextPart' => '',

							'HTMLPart' => $template

						]

					]

				];

			//	$response = $mj->post(Resources::$Email, ['body' => $body]);
				$this->load->library('email');
				$this->email->from($settings[0]['from_email'], 'BWT');
				$this->email->to($proof['email']);
				$this->email->subject($template_subject);
				$this->email->message($template);
				try{
				$this->email->send();
				
				}catch(Exception $e){
					$this->session->set_flashdata('error',$e->getMessage());

				}

				//$response->success();

				$update = array('cron_status'=>1);

				$this->Mdl_Proof->update($update,array('purchase_id'=>$proof['purchase_id']));

				var_dump($response->getData());

			}

		}

	}

	public function cron_proofcover(){

		$today = date('Y-m-d');

		$proofs=$this->Mdl_ProofCover->GetProofofcoupon(array('proof_of_cover_purchase.cron_status'=>0,'proof_of_cover_purchase.cron_date'=>$today,'users.is_Unsubscribe'=>0));

		if(!empty($proofs)){

			//start mailjet

			$settings=$this->Mdl_Settings->GetRecord();

			$apikey = $settings[0]['username'];

			$apisecret = $settings[0]['password'];

			$mj = new \Mailjet\Client($apikey, $apisecret,true,['version' => 'v3.1']);

			foreach($proofs as $proof){

				$get_templates=$this->Mdl_Template->GetRecordUsers(array('id'=>19));

				$template_subject = $get_templates[0]['template_subject'];

				$template = $get_templates[0]['template'];

				$body = [

					'Messages' => [

						[

							'From' => [

								'Email' => $settings[0]['from_email'],

								'Name' => "BWT"

							],

							'To' => [

								[

									'Email' => $proof['email'],

									'Name' => "BWT User"

								]

							],

							'Subject' => $template_subject,

							'TextPart' => '',

							'HTMLPart' => $template

						]

					]

				];

			//	$response = $mj->post(Resources::$Email, ['body' => $body]);
				$this->load->library('email');
				$this->email->from($settings[0]['from_email'], 'BWT');
				$this->email->to($proof['email']);
				$this->email->subject($template_subject);
				$this->email->message($template);
				try{
				$this->email->send();
				
				}catch(Exception $e){
					$this->session->set_flashdata('error',$e->getMessage());

				}

				//$response->success();

				$update = array('cron_status'=>1);

				$this->Mdl_ProofCover->update($update,array('purchase_id'=>$proof['purchase_id']));

				var_dump($response->getData());

			}

		}

	}

	public function cron_draw(){

		$today = date('Y-m-d');

		$draws=$this->Mdl_Proof->GetProofofcoupon(array('draw.cron_status'=>0,'draw.cron_date'=>$today,'users.is_Unsubscribe'=>0));

		if(!empty($draws)){

			//start mailjet

			$settings=$this->Mdl_Settings->GetRecord();

			$apikey = $settings[0]['username'];

			$apisecret = $settings[0]['password'];

			$mj = new \Mailjet\Client($apikey, $apisecret,true,['version' => 'v3.1']);

			foreach($draws as $draw){

				$get_templates=$this->Mdl_Template->GetRecordUsers(array('id'=>19));

				$template_subject = $get_templates[0]['template_subject'];

				$template = $get_templates[0]['template'];

				$body = [

					'Messages' => [

						[

							'From' => [

								'Email' => $settings[0]['from_email'],

								'Name' => "BWT"

							],

							'To' => [

								[

									'Email' => $draw['email'],

									'Name' => "BWT User"

								]

							],

							'Subject' => $template_subject,

							'TextPart' => '',

							'HTMLPart' => $template

						]

					]

				];

			//	$response = $mj->post(Resources::$Email, ['body' => $body]);
				$this->load->library('email');
				$this->email->from($settings[0]['from_email'], 'BWT');
				$this->email->to($draw['email']);
				$this->email->subject($template_subject);
				$this->email->message($template);
				try{
				$this->email->send();
				$update = array('cron_status'=>1);

				$this->Mdl_Draw->update($update,array('draw_id'=>$draw['draw_id']));

				}catch(Exception $e){
					$this->session->set_flashdata('error',$e->getMessage());

				}

				//$response->success();

				

				// var_dump($response->getData());

			}

		}

	}

   public  function get_country_store(){
        $country_id = $this->input->post('id',TRUE);
		$storeid = $this->input->post('storeid',TRUE);
        $data = $this->Mdl_Store->get_country_store($country_id)->result();
        echo json_encode($data);
    }

	public  function get_country_store_handle(){
        $country_id = $this->input->post('id',TRUE);
		$storeid = $this->input->post('storeid',TRUE);

        $data = $this->Mdl_Store->get_country_store_handle($country_id,$storeid);

		$price = array();
		foreach ($data as $key => $row)
		{
			$price[$row['store_name']] = $row['store_name'];
		}
		array_multisort($price, SORT_ASC, $data);
		
        echo json_encode($data);
    }


   	public  function get_country_cover_store(){
        $country_id = $this->input->post('id',TRUE);
		$storeid = $this->input->post('storeid',TRUE);
        $data = $this->Mdl_StoreCover->get_country_cover_store($country_id)->result();
        echo json_encode($data);
    }

	public  function get_country_cover_store_handle(){
        $country_id = $this->input->post('id',TRUE);
		$storeid = $this->input->post('storeid',TRUE);

        $data = $this->Mdl_StoreCover->get_country_cover_store_handle($country_id,$storeid);

		$price = array();
		foreach ($data as $key => $row)
		{
			$price[$row['store_name']] = $row['store_name'];
		}
		array_multisort($price, SORT_ASC, $data);
		
        echo json_encode($data);
    }


}
