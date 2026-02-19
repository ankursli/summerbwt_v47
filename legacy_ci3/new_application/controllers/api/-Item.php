<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Item extends REST_Controller {
    
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
            $data = $this->db->get_where("proof_of_purchase", ['id' => $id])->row_array();
        }else{
			$data=array();
			 $query = $this->db->query("SELECT * FROM proof_of_purchase");
           // $data = $this->db->get("proof_of_purchase")->result();
		   foreach ($query->result_array() as $row)
			{
				
			$uplodeimg=base_url().'upload/'.$row['upload_proof'];
			$data[]=array("purchase_id"=>$row['id'],"user_id"=>$row['user_id'],"store_id"=>$row['store_id'],"another_store_handle"=>$row['another_store_handle'],"coupon_id"=>$row['coupon_id'],"upload_proof"=>$uplodeimg,"coupon_list_code"=>$row['coupon_list_code'],"status"=>$row['status'],"upload_proof_date"=>$row['upload_proof_date'],"coupon_status_date"=>$row['coupon_status_date'],"cron_status"=>$row['cron_status'],"cron_date"=>$row['cron_date'],"product_shop"=>$row['product_shop'],"robot_serial_no"=>$row['robot_serial_no']);
			}
			
        }
  
        $this->response($data, REST_Controller::HTTP_OK);
	}
      
   
    	
}