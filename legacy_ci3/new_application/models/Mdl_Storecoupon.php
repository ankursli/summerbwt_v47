<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdl_Storecoupon extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function GetRecordUsers($conditions=null)
    {   
        if(!empty($conditions))
			$this->db->where($conditions);
        $query=$this->db->get('store_coupon_details');
        return ($query->result_array());
    }
	
	public function insert($data)
	{
		if(empty($data))
			return false;
		else{
			if($this->db->insert('store_coupon_details',$data))
			{
				//data inserted
				return ($this->db->insert_id());
			}
			else
				return false;
           
		}
	}
	
	public function insert_coupon_code($data)
	{
		if(empty($data))
			return false;
		else{
			if($this->db->insert('store_coupon_list',$data))
			{
				//data inserted
				return ($this->db->insert_id());
			}
			else
				return false;
           
		}
	} 
	
	public function update($data,$conditions=null)
	{
		if(empty($data) || empty($conditions))
			return false;
		else
		{
			$this->db->where($conditions);
			if($this->db->update('store_coupon_details',$data))
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
		$this->db->where(array('id'=>$id));
		$result=$this->db->delete('store_coupon_details');
		$this->db->where(array('store_coupon_id'=>$id));
		$result=$this->db->delete('store_coupon_list');
		return $result;
	}
	
	public function GetRecordcouponcodes($couponcodes=null)
    {   
		if(!empty($couponcodes)){
			$this->db->where($couponcodes);
		}
		$query=$this->db->get('store_coupon_list');
		$result = $query->result_array();
		return $result;
    }
	public function remove_coupon_code($id)
	{
		$this->db->where(array('coupon_list_id'=>$id));
		$result=$this->db->delete('store_coupon_list');
		return $result;
	}
	
	public function updatecouponcode($data,$conditions=null)
	{
		if(empty($data) || empty($conditions))
			return false;
		else
		{
			$this->db->where($conditions);
			if($this->db->update('store_coupon_list',$data))
			{
				//echo $sql = $this->db->last_query();die;
				return true;
			}
			else
				return false;
           
		}
	}

}