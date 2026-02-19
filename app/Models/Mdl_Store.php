<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdl_Store extends Model 
{
    protected $table = 'store';

    public function GetRecordUsers($conditions = null)
    {   
        $builder = $this->db->table('store');
        if (!empty($conditions)) {
            $builder->where($conditions);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function insertStore($data)
    {
        if (empty($data)) {
            return false;
        }
        
        $builder = $this->db->table('store');
        if ($builder->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }
    
    public function updateStore($data, $conditions = null)
    {
        if (empty($data) || empty($conditions)) {
            return false;
        }
        
        $builder = $this->db->table('store');
        $builder->where($conditions);
        if ($builder->update($data)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function remove($id)
    {
        $builder = $this->db->table('store');
        $builder->where(['id' => $id]);
        return $builder->delete();
    }
    
    public function get_country_store($country_id)
    {
        $builder = $this->db->table('store');
        $builder->where('store_country', $country_id);
        return $builder->get();
    }
    
    public function get_country_store_handle($country_id, $storeid)
    {
        $builder = $this->db->table('store');
        $builder->where('store_country', $country_id);
        $builder->where('store_handle', $storeid);
        $query = $builder->get();
        
        return $query->getResultArray();
    }
}