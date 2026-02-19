<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdl_Block extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
    }
	

	
	public function GetRecordBlocks($conditions=null)
    {   
        if(!empty($conditions))
			$this->db->where($conditions);
        $query=$this->db->get('block');
        return ($query->result_array());
    }
	
	public function GetRecordBlocksconnection($conditions=null)
    {   
        if(!empty($conditions))
			$this->db->where($conditions);
        $query=$this->db->get('block_connection');
        return ($query->result_array());
    }
	
	
	public function insert($data)
	{
		if(empty($data))
			return false;
		else{
			if($this->db->insert('block',$data))
			{
				//data inserted
				return ($this->db->insert_id());
			}
			else
				return false;
           
		}
	}
	public function insertconnection($data)
	{
		if(empty($data))
			return false;
		else{
			if($this->db->insert('block_connection',$data))
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
			if($this->db->update('block',$data))
			{
				//echo $sql = $this->db->last_query();die;
				return true;
			}
			else
				return false;
           
		}
	}
	
	public function getblockconnection($id,$siteLang){
		if($siteLang == "french" ){
			$this->db->where(array('french_id'=>$id));
        $query=$this->db->get('block_connection');
        $result=$query->row_array();
		}else{
			$this->db->where(array('english_id'=>$id));
        $query=$this->db->get('block_connection');
        $result=$query->row_array();
		}
		$conid = $result['id'];
		return array(
			'frid' => $result['french_id'],
			'enid' => $result['english_id']);
		
	}
	public function deleteconnection($id,$siteLang)
	{
	   	if($siteLang == "french" ){
			$this->db->where(array('french_id'=>$id));
        $query=$this->db->get('block_connection');
        $result=$query->row_array();
		}else{
			$this->db->where(array('english_id'=>$id));
        $query=$this->db->get('block_connection');
        $result=$query->row_array();
		}
		$conid = $result['id'];
		$frid = $result['french_id'];
		$enid = $result['english_id'];
		$this->db->where(array('id'=>$conid));
		$result=$this->db->delete('block_connection');
		$this->db->where(array('id'=>$frid));
		$result=$this->db->delete('block');
		$this->db->where(array('id'=>$enid));
		$result=$this->db->delete('block');
		
		return $result;

	}

	public function deletefrblock($id)
	{
		$this->db->where(array('id'=>$id));
		$result=$this->db->delete('block');
		return $result;
	}
	
	public function deleteenblock($id)
	{
		$this->db->where(array('id'=>$id));
		$result=$this->db->delete('block');
		return $result;
	}
	
	public function UpdatePassword($data,$id)
    {   
		if(empty($data) || empty($id))
            return false;
		$this->db->where('id',$id);
		if($this->db->update("block",$data))
			return true;
		else
			return false;
    }

}