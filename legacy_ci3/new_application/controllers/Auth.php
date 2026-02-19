<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct()

    {

        parent::__construct();

        $this->load->model('Mdl_Api');

    }

	public function login()
	{
		$method = $_SERVER['REQUEST_METHOD'];
	
		if($method != 'POST'){
			json_encode(array('status' => 400,'message' => 'Bad request.'));
		} else {

			$check_auth_client = $this->Mdl_Api->check_auth_client();
			
			if($check_auth_client == true){
				$params = $_REQUEST;
		        $username = $params['email'];
		        $password = $params['password'];
		        $response = $this->Mdl_Api->login($username,$password);
				echo json_encode($response);
			}
		}
	}
	
}