<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_User');
        $this->load->model('Mdl_Country');
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
		}else{
			$this->load->view('front/403');die;
		}
		/*if($country==="FR" || $country==="IN"){
			//echo 'allowed';
		}else{
			$this->load->view('front/403');die;
		}*/
    }
	
	public function index()
	{
		if(!empty($_SESSION['admin_user'])){
			redirect('admin/dashboard');
		}else{ 
			$this->load->view('admin/login');
		}
	}

	public function checklogin()
    {
		$siteLang = $this->session->userdata('site_lang');
		if(!empty($_SESSION['admin_user'])){
			redirect('admin/dashboard');
		}else{
			$ispost=$this->input->method(TRUE);
			if($ispost=='POST')
			{
				$username=$this->input->post('email');
				$password=md5($this->input->post('password'));
			   
				$this->load->helper('form');
				$this->load->library('form_validation');
				$this->form_validation->set_rules('email', "Email", 'trim|required');
				$this->form_validation->set_rules('password', "Password", 'trim|required');
			
				if ($this->form_validation->run() === FALSE) 
				{
					$data=array(
							'success'=>$this->session->flashdata('success'),
							'error'=>$this->session->flashdata('error')
						);
					$this->load->view('admin/login',$data);
				}
				else
				{
					$user=$this->Mdl_User->checkUserWeb($username,$password);
					if($user)
					{
						$this->session->set_userdata('admin_user',$user);
						if($siteLang=='english'){
							$this->session->set_flashdata('success','Admin Login successfully!');
						}else{
							$this->session->set_flashdata('success','Admin Login avec succès!');
						}
						?>
						<script>
								window.top.location.href = "<?php echo base_url().'admin/dashboard'; ?>";
						</script>
						<?php 
					}else{
						if($siteLang=='english'){
							$this->session->set_flashdata('error','Invalid Username or password!');
						}else{
							$this->session->set_flashdata('error',"Nom d'utilisateur ou mot de passe invalide!");
						}
						redirect('admin/user');
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
				redirect('admin/user');
			}
		}
	}
	
	public function logout()
    {
		if(!empty($_SESSION['admin_user'])){
			$this->session->unset_userdata('admin_user');
			//$this->session->sess_destroy(); 
			redirect('admin'); 
		}else{
			redirect('admin');
		}
    }
	
	public function Adduser()
	{
		if(!empty($_SESSION['admin_user'])){
			$data=array('success'=>$this->session->flashdata('success'),
					'error'=>$this->session->flashdata('error'),
					'main_content'=>'admin/user/createprofile'
					);
			$this->load->view('admin/front',$data);
		}else{
			redirect('admin');
		}
	}
	
	public function createprofile()
	{
		$siteLang = $this->session->userdata('site_lang');
		if(!empty($_SESSION['admin_user'])){
			$ispost=$this->input->method(TRUE);
			if($ispost=='POST'){
				$this->load->helper('form');
				$this->load->library('form_validation');
				// set validation rules
				$this->form_validation->set_rules('firstname', "First Name", 'trim|required');
				$this->form_validation->set_rules('email', "Email", 'trim|required|valid_email|is_unique[users.Email]');
				$this->form_validation->set_rules('password', "Password", 'trim|required|min_length[8]');
				$this->form_validation->set_rules('phone', "Phone Number", 'trim|required|regex_match[/^[0-9]{10}$/]');
				$this->form_validation->set_rules('country', "Country", 'trim|required');
				$this->form_validation->set_rules('city', "City", 'trim|required');
				$this->form_validation->set_rules('address1', "Address 1", 'trim|required');
				$this->form_validation->set_rules('postcode', "Postcode", 'trim|required');
				
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
				$countrycode=$this->input->post('countrycode');
				
				
				if($this->form_validation->run() === FALSE){
					$data=array('success'=>$this->session->flashdata('success'),
							'error'=>$this->session->flashdata('error'),
							'main_content'=>'admin/user/createprofile'
							);
					$this->load->view('admin/front',$data);
				}else{
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
						'created_date'=>date('Y-m-d H:i:s'),
						'countrycode'=>$countrycode
					);
					if($this->Mdl_User->insert($insert)){
						if($siteLang=='english'){
							$this->session->set_flashdata('success','User Profile Successfully Created' ); 
						}else{
							$this->session->set_flashdata('success',"Profil d'utilisateur créé avec succès" ); 
						}
						redirect('admin/user/Viewuser');
					}else{
						if($siteLang=='english'){
							$this->session->set_flashdata('error','Error while creating profile!' );
						}else{
							$this->session->set_flashdata('error','Erreur lors de la création du profil!' );
						}
						redirect('admin/user/Viewuser');
					}
				}
			}
		}else{
			redirect('admin');
		}
	}
	
	public function Viewuser()
	{
		if(!empty($_SESSION['admin_user'])){
			$users=$this->Mdl_User->GetRecordUsers(array('is_admin'=>0));
			$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/user/viewuser',
						'users'=>$users
						);
			$this->load->view('admin/front',$data);
		}else{
			redirect('admin');
		}
	}
	
	public function viewprofile($id=null)
	{
		if(!empty($_SESSION['admin_user'])){
			if(!empty($id)){
				$users=$this->Mdl_User->GetRecordUsers(array('id'=>$id));
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/user/viewprofile',
						'users'=>$users
						);
				$this->load->view('admin/front',$data);
			}else{
				$users=$this->Mdl_User->GetRecordUsers();
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/user/viewuser',
						'users'=>$users
						);
				$this->load->view('admin/front',$data);
			}
		}else{
			redirect('admin');
		}
	}
	
	public function editprofile($id=null)
	{
		if(!empty($_SESSION['admin_user'])){
			if(!empty($id)){
				$users=$this->Mdl_User->GetRecordUsers(array('id'=>$id));
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/user/editprofile',
						'users'=>$users
						);
				$this->load->view('admin/front',$data);
			}else{
				$users=$this->Mdl_User->GetRecordUsers();
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/user/viewuser',
						'users'=>$users
						);
				$this->load->view('admin/front',$data);
			}
		}else{
			redirect('admin');
		}
	}
	
	public function updateprofile($id=null)
	{
		$siteLang = $this->session->userdata('site_lang');
		if(!empty($_SESSION['admin_user'])){
			if(!empty($id)){
				$ispost=$this->input->method(TRUE);
				if($ispost=='POST'){
					$this->load->helper('form');
					$this->load->library('form_validation');
					// set validation rules
					$this->form_validation->set_rules('firstname', "First Name", 'trim|required');
					$this->form_validation->set_rules('email', "Email", 'trim|required|valid_email');
					$this->form_validation->set_rules('phone', "Phone Number", 'trim|required|regex_match[/^[0-9]{10}$/]');
					$this->form_validation->set_rules('country', "Country", 'trim|required');
					$this->form_validation->set_rules('city', "City", 'trim|required');
					$this->form_validation->set_rules('address1', "Address 1", 'trim|required');
					$this->form_validation->set_rules('postcode', "Postcode", 'trim|required');
					
					$firstname=$this->input->post('firstname');
					$lastname=$this->input->post('lastname');
					$email=$this->input->post('email');
					$phone=$this->input->post('phone');
					$country=$this->input->post('country');
					$city=$this->input->post('city');
					$address1=$this->input->post('address1');
					$address2=$this->input->post('address2');
					$postcode=$this->input->post('postcode');
					$countrycode=$this->input->post('countrycode');
				
					if($this->form_validation->run() === FALSE){
						$users=$this->Mdl_User->GetRecordUsers(array('id'=>$id));
						$data=array('success'=>$this->session->flashdata('success'),
								'error'=>$this->session->flashdata('error'),
								'main_content'=>'admin/user/editprofile',
								'users'=>$users
								);
						$this->load->view('admin/front',$data);
					}else{
						$update = array(
							'firstname'=>$firstname,
							'lastname'=>$lastname,
							'email'=>$email,
							'phone'=>$phone,
							'country'=>$country,
							'city'=>$city,
							'address1'=>$address1,
							'address2'=>$address2,
							'postcode'=>$postcode,
							'countrycode'=>$countrycode
						);
						if($this->Mdl_User->update($update,array("id"=>$id))){
							if($siteLang=='english'){
								$this->session->set_flashdata('success','User Profile Successfully Updated' ); 
							}else{
								$this->session->set_flashdata('success',"Profil d'utilisateur mis à jour avec succès" ); 
							}
							redirect('admin/user/Viewuser');
						}else{
							if($siteLang=='english'){
								$this->session->set_flashdata('error','Error while updating profile!' );
							}else{
								$this->session->set_flashdata('error','Erreur lors de la mise à jour du profil!' );
							}
							redirect('admin/user/Viewuser');
						}
					}
				}
			}
		}else{
			redirect('admin');
		}
	}
	
	public function removeprofile($id=null)
	{
		$siteLang = $this->session->userdata('site_lang');
		if(!empty($_SESSION['admin_user'])){
			$ispost=$this->input->method(TRUE);
			if($ispost == 'GET')
			{
				$DeleteAccount=$this->Mdl_User->remove($id);
				if(empty($DeleteAccount))
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('error','Error while deleting profile!');
					}else{
						$this->session->set_flashdata('error','Erreur lors de la suppression du profil!');
					}
					redirect('admin/user/Viewuser');
				}
				else
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('success','User Remove Profile Successfully');
					}else{
						$this->session->set_flashdata('success','Utilisateur Supprimer le profil avec succès');
					}
					redirect('admin/user/Viewuser');
				}
			}
			else
			{
				if($siteLang=='english'){
					$this->session->set_flashdata('error','Error while deleting profile!');
				}else{
					$this->session->set_flashdata('error','Erreur lors de la suppression du profil!');
				}
				redirect('admin/user/Viewuser');
			}
		}else{
			redirect('admin');
		}
	}
	
	public function UploadImportFile()
	{
		$siteLang = $this->session->userdata('site_lang');
		if(!empty($_SESSION['admin_user'])){
			$ext = substr(strrchr($_FILES['userfile']['name'], '.'), 1);
			if(!empty($_FILES['userfile']['name']) && $ext == 'csv'){
				$count=0;
				$fp = fopen($_FILES['userfile']['tmp_name'],'r') or die("can't open file");
				while($csv_line = fgetcsv($fp,1024))
				{
					$count++;
					if($count == 1)
					{
						continue;
					}//keep this if condition if you want to remove the first row
					for($i = 0, $j = count($csv_line); $i < $j; $i++)
					{
						$insert_csv = array();
						$insert_csv['firstname'] 		= $csv_line[0];//remove if you want to have primary key,
						$insert_csv['lastname'] 		= $csv_line[1];//remove if you want to have primary key,
						$insert_csv['email'] 	        = $csv_line[2];
						$insert_csv['password'] 		= $csv_line[3];
						$insert_csv['phone'] 			= $csv_line[4];
						$insert_csv['address1'] 		= $csv_line[5];
						$insert_csv['address2'] 		= $csv_line[6];
						$insert_csv['postcode'] 		= $csv_line[7];
						$insert_csv['city'] 			= $csv_line[8];
						$insert_csv['country'] 			= $csv_line[9];
					}
					$i++;
					
					$data = array(
						'firstname'				=>(isset($insert_csv['firstname'])) ? $insert_csv['firstname'] : 'NULL',
						'lastname'				=>(isset($insert_csv['lastname'])) ? $insert_csv['lastname'] : 'NULL',
						'email'				=>(isset($insert_csv['email'])) ? $insert_csv['email'] : '',
						'password'				=>(isset($insert_csv['password'])) ? md5($insert_csv['password']) : '',
						'phone'				=>(isset($insert_csv['phone'])) ? $insert_csv['phone'] : '',
						'address1'				=>(isset($insert_csv['address1'])) ? $insert_csv['address1'] : '',
						'address2'				=>(isset($insert_csv['address2'])) ? $insert_csv['address2'] : '',
						'postcode'				=>(isset($insert_csv['postcode'])) ? $insert_csv['postcode'] : '',
						'city'				=>(isset($insert_csv['city'])) ? $insert_csv['city'] : '',
						'country'				=>(isset($insert_csv['country'])) ? $insert_csv['country'] : '',
						'created_date'		=>date('Y-m-d h:i:s')
					);
					$id = $this->Mdl_User->insert($data);
				}
				fclose($fp) or die("error while import file!");
				$data['success']="success";
				if($id){
					if($siteLang=='english'){
						$this->session->set_flashdata('success','User is successfully import file!');
					}else{
						$this->session->set_flashdata('success',"L'utilisateur est correctement importé!");
					}
					redirect('admin/user/Viewuser');
				}else{
					if($siteLang=='english'){
						$this->session->set_flashdata('error','error while import file!');
					}else{
						$this->session->set_flashdata('error',"erreur lors de l'importation du fichier!");
					}
					redirect('admin/user/Viewuser');
				}
			}else{
				if($siteLang=='english'){
					$this->session->set_flashdata('error','please upload csv file!');
				}else{
					$this->session->set_flashdata('error',"s'il vous plaît télécharger le fichier csv!");
				}
				redirect('admin/user/Viewuser');
			}
		}else{
			redirect('admin');
		}
	}
}
