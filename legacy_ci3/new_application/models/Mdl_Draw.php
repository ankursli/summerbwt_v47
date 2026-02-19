<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdl_Draw extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function GetRecord($conditions=null)
    {   
        if(!empty($conditions))
			$this->db->where($conditions);
        $query=$this->db->get('draw');
        return ($query->result_array());
    }
	
	public function GetProofofcoupon($conditions=null)
    {   
        $this->db->select('draw.*,users.*,store.*');
		$this->db->from('draw');
		$this->db->join('users', 'draw.user_id = users.id');
		$this->db->join('store', 'draw.store_id = store.id');
		$this->db->join('coupon', 'draw.coupon_id = coupon.id');
		 if(!empty($conditions))
			$this->db->where($conditions);
		$query = $this->db->get();
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
			if($this->db->insert('draw',$data)){
				//echo $this->db->insert_id(); exit;
				return ($this->db->insert_id());
			}
			else{
				//print_r($this->db->error());
				//exit;
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
			if($this->db->update('draw',$data)){
				//echo $sql = $this->db->last_query();die;
				return true;
			}
			else
				return false;
		}
	}
	
	public function remove($conditions=null)
	{
		if(!empty($conditions)){
			$this->db->where($conditions);
			$result=$this->db->delete('draw');
			return $result;
		}
	}
	
	public function GetCouponCodeDetails($couponcode)
    {   		
		$query = $this->db->query("select draw.*,users.*,store.*,store_coupon_list.*,store_coupon_details.*,coupon.* from draw INNER JOIN store_coupon_list ON draw.coupon_list_code = store_coupon_list.coupon_code INNER JOIN users ON draw.user_id = users.id INNER JOIN store ON store_coupon_list.store_id = store.id INNER JOIN store_coupon_details ON store_coupon_list.store_coupon_id = store_coupon_details.id INNER JOIN coupon ON store_coupon_list.coupon_id = coupon.id where draw.coupon_list_code='".$couponcode."'");
		$result = $query->row_array();
		return $result;
    }

}