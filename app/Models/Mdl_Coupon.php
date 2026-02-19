<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdl_Coupon extends Model 
{
    protected $table = 'coupon';

    public function GetRecordUsers($conditions = null)
    {   
        $builder = $this->db->table('coupon');
        if (!empty($conditions)) {
            $builder->where($conditions);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function insertCoupon($data)
    {
        if (empty($data)) {
            return false;
        }
        
        $builder = $this->db->table('coupon');
        if ($builder->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }
    
    public function updateCoupon($data, $conditions = null)
    {
        if (empty($data) || empty($conditions)) {
            return false;
        }
        
        $builder = $this->db->table('coupon');
        $builder->where($conditions);
        if ($builder->update($data)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function remove($id)
    {
        $builder = $this->db->table('coupon');
        $builder->where(['id' => $id]);
        return $builder->delete();
    }
}
