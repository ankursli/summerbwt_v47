<?php																																										

   
require APPPATH . 'libraries/REST_Controller.php';
     
class Draw extends REST_Controller {
    
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
            $data = $this->db->get_where("draw", ['id' => $id])->row_array();
        }else{
			$data=array();
			 $query = $this->db->query("SELECT * FROM draw");
           // $data = $this->db->get("draw")->result();
		   foreach ($query->result_array() as $row)
			{
				
			$uplodeimg=base_url().'upload/'.$row['upload_draw'];
			$data[]=array("draw_id"=>$row['draw_id'],"user_id"=>$row['user_id'],"store_id"=>$row['store_id'],"another_store_handle"=>$row['another_store_handle'],"upload_draw"=>$uplodeimg,"coupon_list_code"=>$row['coupon_list_code'],"status"=>$row['status'],"upload_draw_date"=>$row['upload_draw_date'],"coupon_status_date"=>$row['coupon_status_date'],"cron_status"=>$row['cron_status'],"cron_date"=>$row['cron_date']);
			}
			
        }
  
        $this->response($data, REST_Controller::HTTP_OK);
	}
      
   
    	
}