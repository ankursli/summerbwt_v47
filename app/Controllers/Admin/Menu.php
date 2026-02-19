<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Mdl_Menu;

class Menu extends BaseController
{
    protected Mdl_Menu $mdlMenu;
    protected \CodeIgniter\Session\Session $session;

    public function __construct()
    {
        $this->mdlMenu  = new Mdl_Menu();
        $this->session  = \Config\Services::session();
        helper(['form', 'url', 'language']);
        if (empty($this->session->get('site_lang'))) {
            $this->session->set('site_lang', 'french');
        }
    }

    private function requireLogin(): bool
    {
        return (bool) $this->session->get('admin_user');
    }

    public function Viewmenu(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));

        // The menu table stores menus by menu_id (e.g. 'sidebar_menu', 'footer_menu')
        $menuId   = $this->request->getPost('menu_id') ?? $this->request->getGet('menu_id') ?? 'sidebar_menu';
        $menuData = $this->mdlMenu->GetRecordMenus(['menu_id' => $menuId]);

        // Decode menu_items JSON if exists
        $menuItems = [];
        if (!empty($menuData['menu_items'])) {
            $menuItems = json_decode($menuData['menu_items'], true) ?? [];
        }

        return view('admin/header')
            . view('admin/menu/viewmenu', [
                'menus'     => $menuItems,
                'menu_id'   => $menuId,
                'menu_row'  => $menuData,
                'success'   => $this->session->getFlashdata('success'),
                'error'     => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function savemenu(): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));

        $menuId = $this->request->getPost('menu_id') ?? 'sidebar_menu';
        $urls   = $this->request->getPost('url') ?? [];
        $texts  = $this->request->getPost('link_text') ?? [];

        // Build menu items array
        $menuItems = [];
        foreach ($urls as $key => $url) {
            if (empty($url)) continue;
            $menuItems[] = [
                'url'       => $url,
                'link_text' => $texts[$key] ?? '',
            ];
        }

        $data = [
            'menu_id'    => $menuId,
            'menu_items' => json_encode($menuItems),
        ];

        // Check if menu_id already exists
        $existing = $this->mdlMenu->GetRecordMenus(['menu_id' => $menuId]);
        if (!empty($existing)) {
            $this->mdlMenu->updateMenu(['menu_items' => json_encode($menuItems)], ['menu_id' => $menuId]);
        } else {
            $this->mdlMenu->insertMenu($data);
        }

        $this->session->setFlashdata('success', 'Menu Saved Successfully');
        return redirect()->to(base_url('admin/menu/Viewmenu?menu_id=' . $menuId));
    }

    public function removemenu(?int $id = null): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if ($this->mdlMenu->remove($id)) {
            $this->session->setFlashdata('success', 'Menu Item Removed Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while deleting menu item!');
        }
        return redirect()->to(base_url('admin/menu/Viewmenu'));
    }
}
