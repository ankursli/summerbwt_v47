<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flag extends CI_Controller {

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
					$params = $_REQUEST;
					$type = $params['operation_type'];
					$id = $params['operation_id'];
					$status = $params['status'];
		            $response = $this->Mdl_Api->set_operation_flag($type, $id, $status);
	    			echo json_encode($response);
		        }else{
		            echo json_encode($response);
		        }
			}
		}
	}


}