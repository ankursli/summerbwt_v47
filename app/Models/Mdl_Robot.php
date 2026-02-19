<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdl_Robot extends Model 
{
    protected $table = 'robot';

    public function GetRecordUsers($conditions = null)
    {   
        $builder = $this->db->table('robot');
        if (!empty($conditions)) {
            $builder->where($conditions);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function insertRobot($data)
    {
        if (empty($data)) {
            return false;
        }
        
        $builder = $this->db->table('robot');
        if ($builder->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }
    
    public function updateRobot($data, $conditions = null)
    {
        if (empty($data) || empty($conditions)) {
            return false;
        }
        
        $builder = $this->db->table('robot');
        $builder->where($conditions);
        if ($builder->update($data)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function remove($id)
    {
        $builder = $this->db->table('robot');
        $builder->where(['id' => $id]);
        return $builder->delete();
    }
}
