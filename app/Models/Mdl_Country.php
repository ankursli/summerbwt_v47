<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdl_Country extends Model 
{
    protected $table = 'country';

    public function GetRecord($conditions = null)
    {   
        $builder = $this->db->table('country');
        if (!empty($conditions)) {
            $builder->where($conditions);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function GetFrontRecord($conditions = null)
    {   
        $builder = $this->db->table('country');
        $builder->select('country_code');
        if (!empty($conditions)) {
            $builder->where($conditions);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function insertCountry($data)
    {
        if (empty($data)) {
            return false;
        }
        
        $builder = $this->db->table('country');
        if ($builder->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }
    
    public function updateCountry($data, $conditions = null)
    {
        if (empty($data) || empty($conditions)) {
            return false;
        }
        
        $builder = $this->db->table('country');
        $builder->where($conditions);
        if ($builder->update($data)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function remove($id)
    {
        $builder = $this->db->table('country');
        $builder->where(['id' => $id]);
        return $builder->delete();
    }
}
