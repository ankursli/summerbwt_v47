<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdl_Menu extends Model
{
    protected $table = 'menu';
    protected $allowedFields = ['menu_id', 'label', 'link', 'parent', 'sort', 'status', 'created', 'updated']; // Add actual fields if known, or rely on Query Builder
    
    // If not using the standard Model features for everything, we can just use the builder

    public function GetRecordMenus($conditions = null)
    {
        $builder = $this->db->table('menu');
        if (!empty($conditions)) {
            $builder->where($conditions);
        }
        $query = $builder->get();
        // The original code returned row_array() which returns a single row.
        // However, the function name suggests 'Menus' (plural), but the commented out code
        // and the usage in Front.php suggests it might be expecting a single record with a 'menu_items' json field or something.
        // Let's check Front.php usage.
        // Line 72: $sidemenu_without_login = $this->Mdl_Menu->GetRecordMenus(array('menu_id' => 'sidebar_menu_without'));
        // Line 236 template.php: $json_decode = json_decode($sidemenu['menu_items'], true);
        // So yes, it expects a single row that contains a 'menu_items' field.
        return $query->getRowArray();
    }

    public function insertMenu($data)
    {
        if (empty($data)) {
            return false;
        }
        
        $builder = $this->db->table('menu');
        if ($builder->insert($data)) {
            return $this->db->insertID();
        }
        return false;
    }

    public function updateMenu($data, $conditions = null)
    {
        if (empty($data) || empty($conditions)) {
            return false;
        }
        
        $builder = $this->db->table('menu');
        $builder->where($conditions);
        if ($builder->update($data)) {
            return true;
        }
        return false;
    }

    public function remove($id)
    {
        $builder = $this->db->table('menu');
        $builder->where(['id' => $id]);
        return $builder->delete();
    }

    // This method seems out of place (deleting from 'block' table in Menu model), but preserving functionality.
    public function deleteenblock($id)
    {
        $builder = $this->db->table('block');
        $builder->where(['id' => $id]);
        return $builder->delete();
    }
}
