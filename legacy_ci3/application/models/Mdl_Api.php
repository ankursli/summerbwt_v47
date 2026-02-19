<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_Api extends CI_Model {

    var $client_service = "frontend-client";
    var $auth_key       = "simplerestapi";

    public function check_auth_client(){
        $client_service = $this->input->get_request_header('Client-Service', TRUE);
        $auth_key  = $this->input->get_request_header('Auth-Key', TRUE);
        if($client_service == $this->client_service && $auth_key == $this->auth_key){
            return true;
        } else {
            return json_encode(array('status' => 401,'message' => 'Unauthorized.'));
        }
    }

    public function login($username,$password)
    {
        $q  = $this->db->select('password,id')->from('users')->where('email',$username)->get()->row();
       
        if($q == ""){
            return array('status' => 204,'message' => 'User not found.');
        } else {
            $hashed_password = $q->password;
            $id              = $q->id;
        //exit;
        if (md5($password) == $hashed_password) {
            
               $last_login = date('Y-m-d H:i:s');
               $token = crypt(substr( md5(rand()), 0, 7));
               $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
               $this->db->trans_start();
               $this->db->where('id',$id)->update('users',array('last_login' => $last_login));
               $this->db->insert('users_authentication',array('users_id' => $id,'token' => $token,'expired_at' => $expired_at));
               if ($this->db->trans_status() === FALSE){
                  $this->db->trans_rollback();
                  return array('status' => 500,'message' => 'Internal server error.');
               } else {
                  $this->db->trans_commit();
                  return array('status' => 200,'message' => 'Successfully login.','id' => $id, 'token' => $token);
               }
            } else {
               return array('status' => 204,'message' => 'Wrong password.');
            }
        }
    }

    public function set_operation_flag($type, $id, $status)
    {
        if($type == 'purchase'){
            $q = $this->db->select('purchase_id')->from('proof_of_purchase')->where('purchase_id',$id)->get()->row();
            if($q == ""){
                return array('status' => 401,'message' => 'Purchase ID not found');
            }else{
                $this->db->where('purchase_id',$id)->update('proof_of_purchase',array('api_status' => $status));
                return array('status' => 200,'message' => 'Flag set successfully');
            }
        }else if($type == 'draw'){
            $q = $this->db->select('draw_id')->from('draw')->where('draw_id',$id)->get()->row();
            if($q == ""){
                return array('status' => 401,'message' => 'Draw ID not found');
            }else{
                $this->db->where('draw_id',$id)->update('draw',array('api_status' => $status));
                return array('status' => 200,'message' => 'Flag set successfully');
            }
        }else if($type == 'refund'){
            $q = $this->db->select('refund_id')->from('refund')->where('refund_id',$id)->get()->row();
            if($q == ""){
                return array('status' => 401,'message' => 'Refund ID not found');
            }else{
                $this->db->where('refund_id',$id)->update('refund',array('api_status' => $status));
                return array('status' => 200,'message' => 'Flag set successfully');
            }
        }else{
            return array('status' => 204,'message' => 'Invalid Operation');
        }
    }

    public function auth()
    {
        $users_id  = $this->input->get_request_header('User-ID', TRUE);
        $token     = $this->input->get_request_header('Authorization-Token', TRUE);
        $q = $this->db->select('expired_at')->from('users_authentication')->where('users_id',$users_id)->where('token',$token)->get()->row();
        if($q == ""){
            return array('status' => 401,'message' => 'Unauthorized.');
        } else {
            if($q->expired_at < date('Y-m-d H:i:s')){
                return array('status' => 401,'message' => 'Your session has been expired.');
            } else {
                $updated_at = date('Y-m-d H:i:s');
                $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
                $this->db->where('users_id',$users_id)->where('token',$token)->update('users_authentication',array('expired_at' => $expired_at,'updated_at' => $updated_at));
                return array('status' => 200,'message' => 'Authorized.');
            }
        }
    }

    public function get_all_data()
    {
        $data['refund']=array();
        $data['purchase']=array();
        $data['draw']=array();
        $customers = array();

        $query = $this->db->query("SELECT * FROM users");
        foreach ($query->result_array() as $row)
		{
            $customers[$row['id']] = $row;
        }
        $query = $this->db->query("SELECT * FROM refund where api_status = '0' or api_status IS NULL");
		foreach ($query->result_array() as $row)
		{
            $customer_lang = null;
            if($customers[$row['user_id']]['usr_lang'] == "english"){
                $customer_lang = "EN";
            }else if($customers[$row['user_id']]['usr_lang'] == "french"){
                $customer_lang = "FR";
            }

            $uplodeimg=base_url().'upload/'.$row['upload_proof'];
            $data['refund'][]=array("refund_id"=>$row['refund_id'],"user_id"=>$row['user_id'],"firstname" => $customers[$row['user_id']]['firstname'],"lastname" => $customers[$row['user_id']]['lastname'],"email" => $customers[$row['user_id']]['email'],"phone" => $customers[$row['user_id']]['phone'],"address1" => $customers[$row['user_id']]['address1'],"address2" => $customers[$row['user_id']]['address2'],"postcode" => $customers[$row['user_id']]['postcode'],"city" => $customers[$row['user_id']]['city'],"country" => $customers[$row['user_id']]['country'],"usr_lang" => $customer_lang,"modal"=>$row['modal'],"date_of_purchase"=>$row['date_of_purchase'],"store_of_purchase"=>$row['store_of_purchase'],"upload_proof"=>$uplodeimg,"messages"=>$row['messages'],"bank_name"=>$row['bank_name'],"bank_country"=>$row['bank_country'],"bank_bic"=>$row['bank_bic'],"bank_iban"=>$row['bank_iban'],"created_date"=>$row['created_date'],"roboto_serial_no"=>$row['roboto_serial_no']);
        }
        
        $query = $this->db->query("SELECT * FROM proof_of_purchase where api_status = '0' or api_status IS NULL");
		foreach ($query->result_array() as $row)
		{
            $customer_lang = null;
            if($customers[$row['user_id']]['usr_lang'] == "english"){
                $customer_lang = "EN";
            }else if($customers[$row['user_id']]['usr_lang'] == "french"){
                $customer_lang = "FR";
            }
				
            $uplodeimg=base_url().'upload/'.$row['upload_proof'];
            $data['purchase'][]=array("purchase_id"=>$row['id'],"user_id"=>$row['user_id'],"firstname" => $customers[$row['user_id']]['firstname'],"lastname" => $customers[$row['user_id']]['lastname'],"email" => $customers[$row['user_id']]['email'],"phone" => $customers[$row['user_id']]['phone'],"address1" => $customers[$row['user_id']]['address1'],"address2" => $customers[$row['user_id']]['address2'],"postcode" => $customers[$row['user_id']]['postcode'],"city" => $customers[$row['user_id']]['city'],"country" => $customers[$row['user_id']]['country'],"usr_lang" => $customer_lang,"store_id"=>$row['store_id'],"another_store_handle"=>$row['another_store_handle'],"coupon_id"=>$row['coupon_id'],"upload_proof"=>$uplodeimg,"coupon_list_code"=>$row['coupon_list_code'],"status"=>$row['status'],"upload_proof_date"=>$row['upload_proof_date'],"coupon_status_date"=>$row['coupon_status_date'],"cron_status"=>$row['cron_status'],"cron_date"=>$row['cron_date'],"product_shop"=>$row['product_shop'],"robot_serial_no"=>$row['robot_serial_no']);
		}
  
  
        $query = $this->db->query("SELECT * FROM draw where api_status = '0' or api_status IS NULL");
		foreach ($query->result_array() as $row)
		{
            $customer_lang = null;
            if($customers[$row['user_id']]['usr_lang'] == "english"){
                $customer_lang = "EN";
            }else if($customers[$row['user_id']]['usr_lang'] == "french"){
                $customer_lang = "FR";
            }

            $uplodeimg=base_url().'upload/'.$row['upload_draw'];
            $data['draw'][]=array("draw_id"=>$row['draw_id'],"user_id"=>$row['user_id'],"firstname" => $customers[$row['user_id']]['firstname'],"lastname" => $customers[$row['user_id']]['lastname'],"email" => $customers[$row['user_id']]['email'],"phone" => $customers[$row['user_id']]['phone'],"address1" => $customers[$row['user_id']]['address1'],"address2" => $customers[$row['user_id']]['address2'],"postcode" => $customers[$row['user_id']]['postcode'],"city" => $customers[$row['user_id']]['city'],"country" => $customers[$row['user_id']]['country'],"usr_lang" => $customer_lang,"store_id"=>$row['store_id'],"another_store_handle"=>$row['another_store_handle'],"upload_draw"=>$uplodeimg,"coupon_list_code"=>$row['coupon_list_code'],"status"=>$row['status'],"upload_draw_date"=>$row['upload_draw_date'],"coupon_status_date"=>$row['coupon_status_date'],"cron_status"=>$row['cron_status'],"cron_date"=>$row['cron_date']);
		}
		
		return array('status' => 200, 'data' => $data);
    }

}