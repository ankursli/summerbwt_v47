<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Refund extends REST_Controller {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->database();
	   $this->load->helper('url');
    }
       
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
	public function index_get($id = 0)
	{
        if(!empty($id)){
            $data = $this->db->get_where("refund", ['id' => $id])->row_array();
        }else{
			$data=array();
			 $query = $this->db->query("SELECT * FROM refund");
          // $data = $this->db->get("refund")->result();
		   foreach ($query->result_array() as $row)
			{
				
            $uplodeimg=base_url().'upload/'.$row['upload_proof'];
            $data[]=array("refund_id"=>$row['refund_id'],"user_id"=>$row['user_id'],"modal"=>$row['modal'],"date_of_purchase"=>$row['date_of_purchase'],"store_of_purchase"=>$row['store_of_purchase'],"upload_proof"=>$uplodeimg,"messages"=>$row['messages'],"bank_name"=>$row['bank_name'],"bank_country"=>$row['bank_country'],"bank_bic"=>$row['bank_bic'],"bank_iban"=>$row['bank_iban'],"created_date"=>$row['created_date'],"roboto_serial_no"=>$row['roboto_serial_no']);

			
			}
			
        }
  
        $this->response($data, REST_Controller::HTTP_OK);
	}
      
   
    	
}