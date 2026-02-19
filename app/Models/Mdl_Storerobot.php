<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdl_Storerobot extends Model 
{
    protected $table = 'robot_store';

    public function GetRecordUsers($conditions = null)
    {   
        $builder = $this->db->table('robot_store');
        if (!empty($conditions)) {
            $builder->where($conditions);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function insertStoreRobot($data)
    {
        if (empty($data)) {
            return false;
        }
        
        $builder = $this->db->table('robot_store');
        if ($builder->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }
    
    public function updateStoreRobot($data, $conditions = null)
    {
        if (empty($data) || empty($conditions)) {
            return false;
        }
        
        $builder = $this->db->table('robot_store');
        $builder->where($conditions);
        if ($builder->update($data)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function remove($id)
    {
        $builder = $this->db->table('robot_store');
        $builder->where(['id' => $id]);
        return $builder->delete();
    }
    
    public function get_country_store($country_id)
    {
        $builder = $this->db->table('robot_store');
        $builder->where('store_country', $country_id);
        return $builder->get();
    }
    
    public function get_country_robot_store_handle($country_id, $storeid)
    {
        $builder = $this->db->table('robot_store');
        $builder->orderBy('store_name', 'asc');
        $builder->where('store_country', $country_id);
        $builder->where('store_handle', $storeid);
        $query = $builder->get();
        
        return $query->getResultArray();
    }
}