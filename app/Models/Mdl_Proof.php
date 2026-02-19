<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdl_Proof extends Model
{
    protected $table = 'proof_of_purchase';

    public function GetRecord($conditions = null)
    {
        $builder = $this->db->table('proof_of_purchase');
        if (!empty($conditions)) {
            $builder->where($conditions);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function GetProofofcoupon($conditions = null)
    {
        $builder = $this->db->table('proof_of_purchase');
        $builder->select('proof_of_purchase.purchase_id, proof_of_purchase.user_id, proof_of_purchase.store_id, proof_of_purchase.robot_id, proof_of_purchase.upload_proof, proof_of_purchase.robot_purchase_date, proof_of_purchase.status, proof_of_purchase.upload_proof_date, proof_of_purchase.address, proof_of_purchase.zipcode, proof_of_purchase.city, proof_of_purchase.addition_address, proof_of_purchase.store_name_additional, proof_of_purchase.iban, proof_of_purchase.bic, proof_of_purchase.robot_serial_no, proof_of_purchase.clienttype, users.email, users.firstname, users.lastname, robot.robot_name, robot.robot_code, robot_store.store_name');
        $builder->join('users', 'proof_of_purchase.user_id = users.id', 'left');
        $builder->join('robot_store', 'proof_of_purchase.store_id = robot_store.id', 'left');
        $builder->join('robot', 'proof_of_purchase.robot_id = robot.id', 'left');
        if (!empty($conditions)) {
            $builder->where($conditions);
        }
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function insertProof($data)
    {
        if (empty($data)) {
            return false;
        }
        
        // CI4 debug mode handling if absolutely needed, but usually exceptions or return values
        // original used db_debug = false. In CI4, if exceptions disabled:
        // $this->db->transStart(); ... $this->db->transComplete(); or just try/catch
        
        $builder = $this->db->table('proof_of_purchase');
        if ($builder->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }

    public function updateProof($data, $conditions = null)
    {
        if (empty($data) || empty($conditions)) {
            return false;
        }
        
        $builder = $this->db->table('proof_of_purchase');
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
            $builder = $this->db->table('proof_of_purchase');
            $builder->where($conditions);
            return $builder->delete();
        }
    }

    public function GetCouponCodeDetails($couponcode)
    {
        $query = $this->db->query("select proof_of_purchase.*,users.*,store.*,store_coupon_list.*,store_coupon_details.*,coupon.* from proof_of_purchase INNER JOIN store_coupon_list ON proof_of_purchase.coupon_list_code = store_coupon_list.coupon_code INNER JOIN users ON proof_of_purchase.user_id = users.id INNER JOIN store ON store_coupon_list.store_id = store.id INNER JOIN store_coupon_details ON store_coupon_list.store_coupon_id = store_coupon_details.id INNER JOIN coupon ON store_coupon_list.coupon_id = coupon.id where proof_of_purchase.coupon_list_code=?", [$couponcode]);
        return $query->getRowArray();
    }
}
