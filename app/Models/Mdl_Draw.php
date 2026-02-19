<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdl_Draw extends Model 
{
    protected $table = 'draw';

    public function GetRecord($conditions = null)
    {   
        $builder = $this->db->table('draw');
        if (!empty($conditions)) {
            $builder->where($conditions);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function GetProofofcoupon($conditions = null)
    {   
        $builder = $this->db->table('draw');
        $builder->select('draw.*, users.email, users.firstname, users.lastname, store.store_name, coupon.coupon_name');
        $builder->join('users', 'draw.user_id = users.id');
        $builder->join('store', 'draw.store_id = store.id', 'left');
        $builder->join('coupon', 'draw.coupon_id = coupon.id', 'left');
        if (!empty($conditions)) {
            $builder->where($conditions);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function insertDraw($data)
    {
        if (empty($data)) {
            return false;
        }
        
        $builder = $this->db->table('draw');
        if ($builder->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }
    
    public function updateDraw($data, $conditions = null)
    {
        if (empty($data) || empty($conditions)) {
            return false;
        }
        
        $builder = $this->db->table('draw');
        $builder->where($conditions);
        if ($builder->update($data)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function remove($conditions = null)
    {
        if (!empty($conditions)) {
            $builder = $this->db->table('draw');
            $builder->where($conditions);
            return $builder->delete();
        }
    }
    
    public function GetCouponCodeDetails($couponcode)
    {   		
        $query = $this->db->query("select draw.*,users.*,store.*,store_coupon_list.*,store_coupon_details.*,coupon.* from draw INNER JOIN store_coupon_list ON draw.coupon_list_code = store_coupon_list.coupon_code INNER JOIN users ON draw.user_id = users.id INNER JOIN store ON store_coupon_list.store_id = store.id INNER JOIN store_coupon_details ON store_coupon_list.store_coupon_id = store_coupon_details.id INNER JOIN coupon ON store_coupon_list.coupon_id = coupon.id where draw.coupon_list_code=?", [$couponcode]);
        return $query->getRowArray();
    }
}
