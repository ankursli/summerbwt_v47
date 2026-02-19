<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdl_User extends Model
{
    // The table is 'users' based on the CI3 code
    protected $table = 'users';

    public function checkUserWeb($username, $password)
    {
        $builder = $this->db->table('users');
        $builder->where('email', $username);
        $builder->where('password', $password);
        $builder->where('is_admin', 1);
        $query = $builder->get();
        $result = $query->getRowArray();
        
        if (empty($result)) {
            return false;
        } else {
            return $result;
        }
    }
    
    public function checkFrontUser($username, $password)
    {
        $builder = $this->db->table('users');
        $builder->where('email', $username);
        $builder->where('password', $password);
        // Assuming checkFrontUser is for non-admins, but original code had where('is_admin', 0)
        $builder->where('is_admin', 0); 
        $query = $builder->get();
        $result = $query->getRowArray();
        
        if (empty($result)) {
            return false;
        } else {
            return $result;
        }
    }
    
    public function UpdateUserByEmail($data, $email)
    {
        if (empty($data) || empty($email)) {
            return false;
        }
        $builder = $this->db->table('users');
        $builder->where('email', $email);
        return $builder->update($data);
    }

    public function GetUserByemail($email)
    {
        return $this->GetUsers(['email' => $email]);
    }

    public function GetUserByToken($token)
    {
        return $this->GetUsers(['resetpasswordtoken' => $token]);
    }
    
    public function GetUserId($params = null)
    {
        if (empty($params)) {
            return false;
        }
        $builder = $this->db->table('users');
        $builder->select('id');
        $builder->where($params);
        $query = $builder->get();
        $result = $query->getRowArray();
        return $result ? $result['id'] : false;
    }
    
    public function GetRecordUsers($conditions = null)
    {
        $builder = $this->db->table('users');
        if (!empty($conditions)) {
            $builder->where($conditions);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function GetUsers($conditions = null)
    {
        if (empty($conditions)) {
            return false;
        }
        $builder = $this->db->table('users');
        $builder->where($conditions);
        $query = $builder->get();
        $result = $query->getRowArray();
        return $result;
    }
    
    public function insertUser($data)
    {
        if (empty($data)) {
            return false;
        }
        
        $builder = $this->db->table('users');
        if ($builder->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }
    
    public function updateUser($data, $conditions = null)
    {
        if (empty($data) || empty($conditions)) {
            return false;
        }
        
        $builder = $this->db->table('users');
        $builder->where($conditions);
        if ($builder->update($data)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function remove($id)
    {
        $builder = $this->db->table('users');
        $builder->where(['id' => $id]);
        return $builder->delete();
    }
    
    public function UpdatePassword($data, $id)
    {
        if (empty($data) || empty($id)) {
            return false;
        }
        $builder = $this->db->table('users');
        $builder->where('id', $id);
        if ($builder->update($data)) {
            return true;
        } else {
            return false;
        }
    }
}
