<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Records extends REST_Controller {
    
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
        $data['refund']=array();
        $data['purchase']=array();
        $data['draw']=array();
        
		$query = $this->db->query("SELECT * FROM refund");
		foreach ($query->result_array() as $row)
		{
            $uplodeimg=base_url().'upload/'.$row['upload_proof'];
            $data['refund'][]=array("refund_id"=>$row['refund_id'],"user_id"=>$row['user_id'],"modal"=>$row['modal'],"date_of_purchase"=>$row['date_of_purchase'],"store_of_purchase"=>$row['store_of_purchase'],"upload_proof"=>$uplodeimg,"messages"=>$row['messages'],"bank_name"=>$row['bank_name'],"bank_country"=>$row['bank_country'],"bank_bic"=>$row['bank_bic'],"bank_iban"=>$row['bank_iban'],"created_date"=>$row['created_date'],"roboto_serial_no"=>$row['roboto_serial_no']);
        }
        
        $query = $this->db->query("SELECT * FROM proof_of_purchase");
		foreach ($query->result_array() as $row)
		{
				
		$uplodeimg=base_url().'upload/'.$row['upload_proof'];
		$data['purchase'][]=array("purchase_id"=>$row['id'],"user_id"=>$row['user_id'],"store_id"=>$row['store_id'],"another_store_handle"=>$row['another_store_handle'],"coupon_id"=>$row['coupon_id'],"upload_proof"=>$uplodeimg,"coupon_list_code"=>$row['coupon_list_code'],"status"=>$row['status'],"upload_proof_date"=>$row['upload_proof_date'],"coupon_status_date"=>$row['coupon_status_date'],"cron_status"=>$row['cron_status'],"cron_date"=>$row['cron_date'],"product_shop"=>$row['product_shop'],"robot_serial_no"=>$row['robot_serial_no']);
		}
  
  
        $query = $this->db->query("SELECT * FROM draw");
		foreach ($query->result_array() as $row)
		{
				
		$uplodeimg=base_url().'upload/'.$row['upload_draw'];
		$data['draw'][]=array("draw_id"=>$row['draw_id'],"user_id"=>$row['user_id'],"store_id"=>$row['store_id'],"another_store_handle"=>$row['another_store_handle'],"upload_draw"=>$uplodeimg,"coupon_list_code"=>$row['coupon_list_code'],"status"=>$row['status'],"upload_draw_date"=>$row['upload_draw_date'],"coupon_status_date"=>$row['coupon_status_date'],"cron_status"=>$row['cron_status'],"cron_date"=>$row['cron_date']);
		}
			
        $this->response($data, REST_Controller::HTTP_OK);
	}
      
   
    	
}