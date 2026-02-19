<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdl_Refund extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function GetRecordUsers($conditions=null)
    {   
        //$this->db->select('refund.*,coupon.*,users.*,store.*');
        $this->db->select('refund.*,coupon.*,users.*');
		$this->db->from('refund');
		$this->db->join('coupon', 'refund.modal = coupon.id');
		$this->db->join('users', 'refund.user_id = users.id');
		//$this->db->join('store', 'refund.store_of_purchase = store.id');
		$this->db->order_by("refund.refund_id", "desc");
		if(!empty($conditions)){
			$this->db->where($conditions);
		}
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$result = $query->result_array();
		return $result;
    }
	
	public function insert($data)
	{


		if(empty($data)){
			
			//print_r($this->db->error());exit;
			return false;
			
		}
		else{
		
			
			if($this->db->insert('refund',$data))
			{
				//echo $this->db->insert_id(); exit;
				return ($this->db->insert_id());
			}
			else{
				
				//print_r($this->db->error());exit;
			
				return false;
			}
		}
        
		
	}
	
	public function update($data,$conditions=null)
	{
		if(empty($data) || empty($conditions))
			return false;
		else
		{
			$this->db->where($conditions);
			if($this->db->update('refund',$data))
			{
				//echo $sql = $this->db->last_query();die;
				return true;
			}
			else
				return false;
           
		}
	}
	
	public function remove($id)
	{
		$this->db->where(array('refund_id'=>$id));
		$result=$this->db->delete('refund');
		return $result;
	}

}