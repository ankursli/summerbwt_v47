<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdl_Robot extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function GetRecordUsers($conditions=null)
	{   
		if(!empty($conditions))
			$this->db->where($conditions);
		$query=$this->db->get('robot');
		return ($query->result_array());
	}
	
	public function insert($data)
	{
		if(empty($data))
			return false;
		else{
			if($this->db->insert('robot',$data))
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
			if($this->db->update('robot',$data))
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
		$result=$this->db->delete('robot');
		return $result;
	}
	
	}