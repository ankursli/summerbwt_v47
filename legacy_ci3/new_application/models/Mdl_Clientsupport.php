<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdl_Clientsupport extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function GetRecordUsers($conditions=null)
    {   
        if(!empty($conditions))
			$this->db->where($conditions);
        $query=$this->db->get('client_support');
        return ($query->result_array());
    }
	
	public function GetSupport($conditions=null)
    {   
        $this->db->select('client_support.*,users.email as useremail');
		$this->db->from('client_support');
		$this->db->join('users', 'client_support.user_id = users.id');
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
			if($this->db->insert('client_support',$data))
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
			if($this->db->update('client_support',$data))
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
		$result=$this->db->delete('client_support');
		return $result;
	}

}