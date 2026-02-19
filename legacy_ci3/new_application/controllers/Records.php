<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Records extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_Api');
    }

	public function index()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
			json_encode(array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Mdl_Api->check_auth_client();
			if($check_auth_client == true){
				$response = $this->Mdl_Api->auth();
		        if($response['status'] == 200){
		            $response = $this->Mdl_Api->get_all_data();
	    			echo json_encode($response);
		        }else{
		            echo json_encode($response);
		        }
			}
		}
	}


}