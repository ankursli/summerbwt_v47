<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdl_Template extends Model
{
    protected $table = 'mail_template';
    
    public function GetRecordUsers($conditions = null)
    {
        $builder = $this->db->table('mail_template');
        if (!empty($conditions)) {
            $builder->where($conditions);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function insertTemplate($data)
    {
        if (empty($data)) {
            return false;
        }
        
        $builder = $this->db->table('mail_template');
        if ($builder->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }
    
    public function updateTemplate($data, $conditions = null)
    {
        if (empty($data) || empty($conditions)) {
            return false;
        }
        
        $builder = $this->db->table('mail_template');
        $builder->where($conditions);
        if ($builder->update($data)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function remove($id)
    {
        $builder = $this->db->table('mail_template');
        $builder->where(['id' => $id]);
        return $builder->delete();
    }
}