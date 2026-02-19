<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdl_Storecoupon extends Model 
{
    protected $table = 'store_coupon_details';

    public function GetRecordUsers($conditions = null)
    {   
        $builder = $this->db->table('store_coupon_details');
        if (!empty($conditions)) {
            $builder->where($conditions);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function insertStoreCoupon($data) // Renamed from insert to avoid conflict/confusion, though optional
    {
        if (empty($data)) {
            return false;
        }
        
        $builder = $this->db->table('store_coupon_details');
        if ($builder->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }
    
    public function insert_coupon_code($data)
    {
        if (empty($data)) {
            return false;
        }
        
        $builder = $this->db->table('store_coupon_list');
        if ($builder->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    } 
    
    public function updateStoreCoupon($data, $conditions = null)
    {
        if (empty($data) || empty($conditions)) {
            return false;
        }
        
        $builder = $this->db->table('store_coupon_details');
        $builder->where($conditions);
        if ($builder->update($data)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function remove($id)
    {
        $builderDetails = $this->db->table('store_coupon_details');
        $builderDetails->where(['id' => $id]);
        $result = $builderDetails->delete();
        
        $builderList = $this->db->table('store_coupon_list');
        $builderList->where(['store_coupon_id' => $id]);
        $builderList->delete();
        
        return $result;
    }
    
    public function GetRecordcouponcodes($couponcodes = null)
    {   
        $builder = $this->db->table('store_coupon_list');
        if (!empty($couponcodes)) {
            $builder->where($couponcodes);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function remove_coupon_code($id)
    {
        $builder = $this->db->table('store_coupon_list');
        $builder->where(['coupon_list_id' => $id]);
        return $builder->delete();
    }
    
    public function updatecouponcode($data, $conditions = null)
    {
        if (empty($data) || empty($conditions)) {
            return false;
        }
        
        $builder = $this->db->table('store_coupon_list');
        $builder->where($conditions);
        if ($builder->update($data)) {
            return true;
        } else {
            return false;
        }
    }
}
