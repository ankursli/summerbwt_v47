<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdl_Block extends Model
{
    // Keeping properties minimal as this model accesses multiple tables
    
    public function GetRecordBlocks($conditions = null)
    {
        $builder = $this->db->table('block');
        if (!empty($conditions)) {
            $builder->where($conditions);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function GetRecordBlocksconnection($conditions = null)
    {
        $builder = $this->db->table('block_connection');
        if (!empty($conditions)) {
            $builder->where($conditions);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function insertBlock($data)
    {
        if (empty($data)) {
            return false;
        }
        
        $builder = $this->db->table('block');
        if ($builder->insert($data)) {
            return $this->db->insertID();
        }
        return false;
    }

    public function insertconnection($data)
    {
        if (empty($data)) {
            return false;
        }
        
        $builder = $this->db->table('block_connection');
        if ($builder->insert($data)) {
            return $this->db->insertID();
        }
        return false;
    }
    
    public function updateBlock($data, $conditions = null)
    {
        if (empty($data) || empty($conditions)) {
            return false;
        }
        
        $builder = $this->db->table('block');
        $builder->where($conditions);
        if ($builder->update($data)) {
            return true;
        }
        return false;
    }
    
    public function getblockconnection($id, $siteLang)
    {
        $builder = $this->db->table('block_connection');
        if ($siteLang == "french") {
            $builder->where(['french_id' => $id]);
        } else {
            $builder->where(['english_id' => $id]);
        }
        $query = $builder->get();
        $result = $query->getRowArray();
        
        if (!$result) return null; // Handle case where result is empty

        return array(
            'frid' => $result['french_id'],
            'enid' => $result['english_id']
        );
    }

    public function deleteconnection($id, $siteLang)
    {
        $builder = $this->db->table('block_connection');
        if ($siteLang == "french") {
            $builder->where(['french_id' => $id]);
        } else {
            $builder->where(['english_id' => $id]);
        }
        $query = $builder->get();
        $result = $query->getRowArray();
        
        if (!$result) return false;

        $conid = $result['id'];
        $frid = $result['french_id'];
        $enid = $result['english_id'];
        
        $builder->where(['id' => $conid]);
        $builder->delete(); // Delete connection

        $builderBlock = $this->db->table('block');
        $builderBlock->where(['id' => $frid]);
        $builderBlock->delete();
        
        $builderBlock->where(['id' => $enid]);
        $builderBlock->delete();
        
        return true;
    }

    public function deletefrblock($id)
    {
        $builder = $this->db->table('block');
        $builder->where(['id' => $id]);
        return $builder->delete();
    }
    
    public function deleteenblock($id)
    {
        $builder = $this->db->table('block');
        $builder->where(['id' => $id]);
        return $builder->delete();
    }
    
    public function UpdatePassword($data, $id)
    {
        if (empty($data) || empty($id)) {
            return false;
        }
        $builder = $this->db->table('block');
        $builder->where('id', $id);
        if ($builder->update($data)) {
            return true;
        } else {
            return false;
        }
    }
}
