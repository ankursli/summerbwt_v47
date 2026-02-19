<?php 

namespace App\Models;

use CodeIgniter\Model;

class Mdl_Clientsupport extends Model 
{
    protected $table = 'client_support';

    public function GetRecordUsers($conditions = null)
    {   
        $builder = $this->db->table('client_support');
        if (!empty($conditions)) {
            $builder->where($conditions);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function GetSupport($conditions = null)
    {   
        $builder = $this->db->table('client_support');
        $builder->select('client_support.*, users.email as useremail');
        $builder->join('users', 'client_support.user_id = users.id');
        if (!empty($conditions)) {
            $builder->where($conditions);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function insertSupport($data)
    {
        if (empty($data)) {
            return false;
        }
        
        $builder = $this->db->table('client_support');
        if ($builder->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }
    
    public function updateSupport($data, $conditions = null)
    {
        if (empty($data) || empty($conditions)) {
            return false;
        }
        
        $builder = $this->db->table('client_support');
        $builder->where($conditions);
        if ($builder->update($data)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function remove($id)
    {
        $builder = $this->db->table('client_support');
        $builder->where(['id' => $id]);
        return $builder->delete();
    }
}