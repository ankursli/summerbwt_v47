<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdl_Api extends Model
{
    protected $client_service = "frontend-client";
    protected $auth_key       = "simplerestapi";

    public function check_auth_client()
    {
        $request = \Config\Services::request();
        $client_service = $request->getHeaderLine('Client-Service');
        $auth_key  = $request->getHeaderLine('Auth-Key');

        if($client_service == $this->client_service && $auth_key == $this->auth_key){
            return true;
        } else {
            return json_encode(array('status' => 401,'message' => 'Unauthorized.'));
        }
    }

    public function login($username, $password)
    {
        $builder = $this->db->table('users');
        $builder->select('password, id');
        $builder->where('email', $username);
        $q = $builder->get()->getRow();
       
        if(empty($q)){
            return array('status' => 204,'message' => 'User not found.');
        } else {
            $hashed_password = $q->password;
            $id              = $q->id;
        
            if (md5($password) == $hashed_password) {
                
               $last_login = date('Y-m-d H:i:s');
               $token = crypt(substr( md5(rand()), 0, 7)); // crypt() without salt is deprecated in newer PHP, but might work if salt provided or implicit. Keeping as is but might need attention.
               // Actually crypt() second arg is required in PHP 8 if using standard DES, or ignored if system salt? CI4 usually uses password_hash.
               // Let's assume standard md5 + crypt behavior for now, but note it.
               // Actually for now let's just use what was there but be aware it might fail on PHP 8 if salt missing.
               // PHP 8: crypt(): Argument #2 ($salt) must be a valid salt string
               // The original code was: $token = crypt(substr( md5(rand()), 0, 7)); 
               // This missing salt is definitely an issue on PHP 8.
               // Replacing with something safer for a token.
               $token =  bin2hex(random_bytes(16)); // Generating a random token safely

               $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
               
               $this->db->transStart();
               
               $builderUsers = $this->db->table('users');
               $builderUsers->where('id',$id)->update(array('last_login' => $last_login));
               
               $builderAuth = $this->db->table('users_authentication');
               $builderAuth->insert(array('users_id' => $id,'token' => $token,'expired_at' => $expired_at));
               
               $this->db->transComplete();

               if ($this->db->transStatus() === FALSE){
                  return array('status' => 500,'message' => 'Internal server error.');
               } else {
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
            $builder = $this->db->table('proof_of_purchase');
            $q = $builder->select('purchase_id')->where('purchase_id',$id)->get()->getRow();
            if(empty($q)){
                return array('status' => 401,'message' => 'Purchase ID not found');
            }else{
                $builder->where('purchase_id',$id)->update(array('api_status' => $status));
                return array('status' => 200,'message' => 'Flag set successfully');
            }
        }else if($type == 'draw'){
            $builder = $this->db->table('draw');
            $q = $builder->select('draw_id')->where('draw_id',$id)->get()->getRow();
            if(empty($q)){
                return array('status' => 401,'message' => 'Draw ID not found');
            }else{
                $builder->where('draw_id',$id)->update(array('api_status' => $status));
                return array('status' => 200,'message' => 'Flag set successfully');
            }
        }else if($type == 'refund'){
            $builder = $this->db->table('refund');
            $q = $builder->select('refund_id')->where('refund_id',$id)->get()->getRow();
            if(empty($q)){
                return array('status' => 401,'message' => 'Refund ID not found');
            }else{
                $builder->where('refund_id',$id)->update(array('api_status' => $status));
                return array('status' => 200,'message' => 'Flag set successfully');
            }
        }else{
            return array('status' => 204,'message' => 'Invalid Operation');
        }
    }

    public function auth()
    {
        $request = \Config\Services::request();
        $users_id  = $request->getHeaderLine('User-ID');
        $token     = $request->getHeaderLine('Authorization-Token');
        
        $builder = $this->db->table('users_authentication');
        $builder->select('expired_at');
        $builder->where('users_id',$users_id);
        $builder->where('token',$token);
        $q = $builder->get()->getRow();
        
        if(empty($q)){
            return array('status' => 401,'message' => 'Unauthorized.');
        } else {
            if($q->expired_at < date('Y-m-d H:i:s')){
                return array('status' => 401,'message' => 'Your session has been expired.');
            } else {
                $updated_at = date('Y-m-d H:i:s');
                $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
                
                $builder->where('users_id',$users_id)->where('token',$token)->update(array('expired_at' => $expired_at,'updated_at' => $updated_at));
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
        foreach ($query->getResultArray() as $row)
		{
            $customers[$row['id']] = $row;
        }
        $query = $this->db->query("SELECT * FROM refund where api_status = '0' or api_status IS NULL");
		foreach ($query->getResultArray() as $row)
		{
            $customer_lang = null;
            if(isset($customers[$row['user_id']])) {
                 if($customers[$row['user_id']]['usr_lang'] == "english"){
                    $customer_lang = "EN";
                }else if($customers[$row['user_id']]['usr_lang'] == "french"){
                    $customer_lang = "FR";
                }
                
                // Be careful with array keys if user doesn't exist
                $user = $customers[$row['user_id']];
                
                $uplodeimg=base_url().'upload/'.$row['upload_proof'];
                $data['refund'][]=array("refund_id"=>$row['refund_id'],"user_id"=>$row['user_id'],"firstname" => $user['firstname'],"lastname" => $user['lastname'],"email" => $user['email'],"phone" => $user['phone'],"address1" => $user['address1'],"address2" => $user['address2'],"postcode" => $user['postcode'],"city" => $user['city'],"country" => $user['country'],"usr_lang" => $customer_lang,"modal"=>$row['modal'],"date_of_purchase"=>$row['date_of_purchase'],"store_of_purchase"=>$row['store_of_purchase'],"upload_proof"=>$uplodeimg,"messages"=>$row['messages'],"bank_name"=>$row['bank_name'],"bank_country"=>$row['bank_country'],"bank_bic"=>$row['bank_bic'],"bank_iban"=>$row['bank_iban'],"created_date"=>$row['created_date'],"roboto_serial_no"=>$row['roboto_serial_no']);
            }
        }
        
        $query = $this->db->query("SELECT * FROM proof_of_purchase where api_status = '0' or api_status IS NULL");
		foreach ($query->getResultArray() as $row)
		{
            if(isset($customers[$row['user_id']])) {
                $customer_lang = null;
                if($customers[$row['user_id']]['usr_lang'] == "english"){
                    $customer_lang = "EN";
                }else if($customers[$row['user_id']]['usr_lang'] == "french"){
                    $customer_lang = "FR";
                }
                
                $user = $customers[$row['user_id']];
                    
                $uplodeimg=base_url().'upload/'.$row['upload_proof'];
                $data['purchase'][]=array("purchase_id"=>$row['id'],"user_id"=>$row['user_id'],"firstname" => $user['firstname'],"lastname" => $user['lastname'],"email" => $user['email'],"phone" => $user['phone'],"address1" => $user['address1'],"address2" => $user['address2'],"postcode" => $user['postcode'],"city" => $user['city'],"country" => $user['country'],"usr_lang" => $customer_lang,"store_id"=>$row['store_id'],"another_store_handle"=>$row['another_store_handle'],"coupon_id"=>$row['coupon_id'],"upload_proof"=>$uplodeimg,"coupon_list_code"=>$row['coupon_list_code'],"status"=>$row['status'],"upload_proof_date"=>$row['upload_proof_date'],"coupon_status_date"=>$row['coupon_status_date'],"cron_status"=>$row['cron_status'],"cron_date"=>$row['cron_date'],"product_shop"=>$row['product_shop'],"robot_serial_no"=>$row['robot_serial_no']);
            }
		}
  
  
        $query = $this->db->query("SELECT * FROM draw where api_status = '0' or api_status IS NULL");
		foreach ($query->getResultArray() as $row)
		{
            if(isset($customers[$row['user_id']])) {
                $customer_lang = null;
                if($customers[$row['user_id']]['usr_lang'] == "english"){
                    $customer_lang = "EN";
                }else if($customers[$row['user_id']]['usr_lang'] == "french"){
                    $customer_lang = "FR";
                }
                
                 $user = $customers[$row['user_id']];

                $uplodeimg=base_url().'upload/'.$row['upload_draw'];
                $data['draw'][]=array("draw_id"=>$row['draw_id'],"user_id"=>$row['user_id'],"firstname" => $user['firstname'],"lastname" => $user['lastname'],"email" => $user['email'],"phone" => $user['phone'],"address1" => $user['address1'],"address2" => $user['address2'],"postcode" => $user['postcode'],"city" => $user['city'],"country" => $user['country'],"usr_lang" => $customer_lang,"store_id"=>$row['store_id'],"another_store_handle"=>$row['another_store_handle'],"upload_draw"=>$uplodeimg,"coupon_list_code"=>$row['coupon_list_code'],"status"=>$row['status'],"upload_draw_date"=>$row['upload_draw_date'],"coupon_status_date"=>$row['coupon_status_date'],"cron_status"=>$row['cron_status'],"cron_date"=>$row['cron_date']);
            }
		}
		
		return array('status' => 200, 'data' => $data);
    }
}