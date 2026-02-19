<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdl_User extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function checkUserWeb($username,$password)
    {
        $this->db->where('email',$username);
        $this->db->where('password',$password);
        $this->db->where('is_admin',1);
        $query=$this->db->get('users');
        $result=$query->row_array();
        if(empty($result)){
            return false;
        }
        else{
            return ($result);
        }
    }
	
	public function checkFrontUser($username,$password)
    {
        $this->db->where('email',$username);
        $this->db->where('password',$password);
        $this->db->where('is_admin',0);
        $query=$this->db->get('users');
        $result=$query->row_array();
		//echo $sql = $this->db->last_query();die;
        if(empty($result)){
            return false;
        }
        else{
            return ($result);
        }
    }
	public function UpdateUserByEmail($data,$email){
        if(empty($data) || empty($email))
            return false;
        $this->db->where('email',$email);
        $this->db->update('users',$data);
        return true;
    }
	public function GetUserId($params=null){
		if(empty($params))
		{
			return false;
		}
		$this->db->select("id");
		$this->db->where($params);
		$query=$this->db->get('users');
		$result=$query->row_array();
		return $result['id'];
	}
	
	public function GetRecordUsers($conditions=null)
    {   
        if(!empty($conditions))
			$this->db->where($conditions);
        $query=$this->db->get('users');
        return ($query->result_array());
    }
	
	public function GetUsers($conditions=null)
    {   
        if(empty($conditions))
            return false;
        $this->db->where($conditions);
        $query=$this->db->get('users');
        $result=$query->row_array();
        return ($result);
    }
	
	public function insert($data)
	{
		if(empty($data))
			return false;
		else{
			if($this->db->insert('users',$data))
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
			if($this->db->update('users',$data))
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
		$result=$this->db->delete('users');
		return $result;
	}
	
	public function UpdatePassword($data,$id)
    {   
		if(empty($data) || empty($id))
            return false;
		$this->db->where('id',$id);
		if($this->db->update("users",$data))
			return true;
		else
			return false;
    }

}