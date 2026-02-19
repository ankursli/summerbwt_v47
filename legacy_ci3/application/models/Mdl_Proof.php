<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mdl_Proof extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function GetRecord($conditions = null)
	{
		if (!empty($conditions))
			$this->db->where($conditions);
		$query = $this->db->get('proof_of_purchase');
		return ($query->result_array());
	}

	public function GetProofofcoupon($conditions = null)
	{
		$this->db->select('proof_of_purchase.*,users.*,robot_store.*,robot.*');
		$this->db->from('proof_of_purchase');
		$this->db->join('users', 'proof_of_purchase.user_id = users.id');
		$this->db->join('robot_store', 'proof_of_purchase.store_id = robot_store.id');
		$this->db->join('robot', 'proof_of_purchase.robot_id = robot.id');
		if (!empty($conditions))
			$this->db->where($conditions);
		$query = $this->db->get();

		$result = $query->result_array();
		return $result;
	}

	public function insert($data)
	{

		if (empty($data))
			return false;
		else {

			$this->db->db_debug = false;
			if ($this->db->insert('proof_of_purchase', $data)) {
				return ($this->db->insert_id());
			} else {
				// print_r($this->db->error()); die;
				return false;
			}
		}
	}

	public function update($data, $conditions = null)
	{
		if (empty($data) || empty($conditions))
			return false;
		else {
			$this->db->where($conditions);
			if ($this->db->update('proof_of_purchase', $data)) {
				//echo $sql = $this->db->last_query();die;
				return true;
			} else
				return false;
		}
	}

	public function remove($conditions = null)
	{
		if (!empty($conditions)) {
			$this->db->where($conditions);
			$result = $this->db->delete('proof_of_purchase');
			return $result;
		}
	}

	public function GetCouponCodeDetails($couponcode)
	{
		$query = $this->db->query("select proof_of_purchase.*,users.*,store.*,store_coupon_list.*,store_coupon_details.*,coupon.* from proof_of_purchase INNER JOIN store_coupon_list ON proof_of_purchase.coupon_list_code = store_coupon_list.coupon_code INNER JOIN users ON proof_of_purchase.user_id = users.id INNER JOIN store ON store_coupon_list.store_id = store.id INNER JOIN store_coupon_details ON store_coupon_list.store_coupon_id = store_coupon_details.id INNER JOIN coupon ON store_coupon_list.coupon_id = coupon.id where proof_of_purchase.coupon_list_code='" . $couponcode . "'");
		$result = $query->row_array();
		return $result;
	}
}
