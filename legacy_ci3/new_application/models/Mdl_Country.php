<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdl_Country extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function GetRecord($conditions=null)
    {   
        if(!empty($conditions))
			$this->db->where($conditions);
        $query=$this->db->get('country');
        return ($query->result_array());
    }
	
	public function GetFrontRecord($conditions=null)
    {   
        $this->db->select('country_code');
		$this->db->from('country');
		 if(!empty($conditions))
			$this->db->where($conditions);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
    }
	
	public function insert($data)
	{
		if(empty($data))
			return false;
		else{
			if($this->db->insert('country',$data))
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
			if($this->db->update('country',$data))
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
		$result=$this->db->delete('country');
		return $result;
	}

}