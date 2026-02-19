<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdl_Refund extends Model 
{
    protected $table = 'refund';

    public function GetRecordUsers($conditions = null)
    {   
        $builder = $this->db->table('refund');
        //$this->db->select('refund.*,coupon.*,users.*,store.*');
        $builder->select('refund.*, robot.robot_name as coupon_name, users.email, users.firstname, users.lastname, store.store_name');
        $builder->join('robot', 'refund.modal = robot.id');
        $builder->join('users', 'refund.user_id = users.id');
        $builder->join('store', 'refund.store_id = store.id', 'left');
        $builder->orderBy("refund.refund_id", "desc");
        if (!empty($conditions)) {
            $builder->where($conditions);
        }
        $query = $builder->get();
        //echo $this->db->getLastQuery();die;
        return $query->getResultArray();
    }
    
    public function insertRefund($data)
    {
        if (empty($data)) {
            return false;
        }
        
        $builder = $this->db->table('refund');
        if ($builder->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }
    
    public function updateRefund($data, $conditions = null)
    {
        if (empty($data) || empty($conditions)) {
            return false;
        }
        
        $builder = $this->db->table('refund');
        $builder->where($conditions);
        if ($builder->update($data)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function remove($id)
    {
        $builder = $this->db->table('refund');
        $builder->where(['refund_id' => $id]);
        return $builder->delete();
    }
}
