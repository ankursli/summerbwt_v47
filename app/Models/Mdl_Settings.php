<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdl_Settings extends Model
{
    protected $table = 'settings';

    public function GetRecord($conditions = null)
    {
        $builder = $this->db->table('settings');
        if (!empty($conditions)) {
            $builder->where($conditions);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function insertSetting($data)
    {
        if (empty($data)) {
            return false;
        }
        
        $builder = $this->db->table('settings');
        if ($builder->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }
    
    public function updateSetting($data, $conditions = null)
    {
        if (empty($data) || empty($conditions)) {
            return false;
        }
        
        $builder = $this->db->table('settings');
        $builder->where($conditions);
        if ($builder->update($data)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function remove($id)
    {
        $builder = $this->db->table('settings');
        $builder->where(['id' => $id]);
        return $builder->delete();
    }
}
