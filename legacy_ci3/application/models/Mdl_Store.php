<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdl_Store extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function GetRecordUsers($conditions=null)
    {   
        if(!empty($conditions))
			$this->db->where($conditions);
        $query=$this->db->get('store');
        return ($query->result_array());
    }
	
	public function insert($data)
	{
		if(empty($data))
			return false;
		else{
			if($this->db->insert('store',$data))
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
			if($this->db->update('store',$data))
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
		$result=$this->db->delete('store');
		return $result;
	}
	
    public	function get_country_store($country_id){
        $query = $this->db->get_where('store', array('store_country' => $country_id));
        return $query;
    }
    
      public function get_country_store_handle($country_id,$storeid){
        $query = $this->db->get_where('store', array('store_country' => $country_id,'store_handle' => $storeid));
		
		 return ($query->result_array());
		
    }
    
}