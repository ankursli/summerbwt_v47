<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Mdl_Storerobot;
use App\Models\Mdl_Country;

class Storerobot extends BaseController
{
    protected Mdl_Storerobot $mdlStorerobot;
    protected Mdl_Country $mdlCountry;
    protected \CodeIgniter\Session\Session $session;

    public function __construct()
    {
        $this->mdlStorerobot = new Mdl_Storerobot();
        $this->mdlCountry    = new Mdl_Country();
        $this->session       = \Config\Services::session();
        helper(['form', 'url', 'language']);
        if (empty($this->session->get('site_lang'))) {
            $this->session->set('site_lang', 'french');
        }
    }

    private function requireLogin(): bool
    {
        return (bool) $this->session->get('admin_user');
    }

    public function Viewstore(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        $stores = $this->mdlStorerobot->GetRecordUsers();
        return view('admin/header')
            . view('admin/storerobot/list', [
                'stores'  => $stores,
                'success' => $this->session->getFlashdata('success'),
                'error'   => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function Addstore(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        $countries = $this->mdlCountry->GetRecord();
        return view('admin/header')
            . view('admin/storerobot/create', [
                'countries' => $countries,
                'success'   => $this->session->getFlashdata('success'),
                'error'     => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function create(): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        $data = [
            'store_name'     => $this->request->getPost('store_name'),
            'store_code'     => $this->request->getPost('store_code'),
            'store_email'    => $this->request->getPost('store_email'),
            'store_phone'    => $this->request->getPost('store_phone'),
            'store_mobile'   => $this->request->getPost('store_mobile'),
            'store_address1' => $this->request->getPost('store_address1'),
            'store_address2' => $this->request->getPost('store_address2'),
            'store_city'     => $this->request->getPost('store_city'),
            'store_country'  => $this->request->getPost('store_country'),
            'store_postcode' => $this->request->getPost('store_postcode'),
            'store_handle'   => $this->request->getPost('store_handle'),
            'created_date'   => date('Y-m-d H:i:s'),
        ];
        if ($this->mdlStorerobot->insertStoreRobot($data)) {
            $this->session->setFlashdata('success', 'Robot Store Created Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while creating robot store!');
        }
        return redirect()->to(base_url('admin/storerobot/Viewstore'));
    }

    public function edit(?int $id = null): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if (empty($id)) return redirect()->to(base_url('admin/storerobot/Viewstore'));
        $stores = $this->mdlStorerobot->GetRecordUsers(['id' => $id]);
        $countries = $this->mdlCountry->GetRecord();
        return view('admin/header')
            . view('admin/storerobot/edit', [
                'stores'    => $stores,
                'countries' => $countries,
                'success'   => $this->session->getFlashdata('success'),
                'error'     => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function update(?int $id = null): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        $data = [
            'store_name'     => $this->request->getPost('store_name'),
            'store_code'     => $this->request->getPost('store_code'),
            'store_email'    => $this->request->getPost('store_email'),
            'store_phone'    => $this->request->getPost('store_phone'),
            'store_mobile'   => $this->request->getPost('store_mobile'),
            'store_address1' => $this->request->getPost('store_address1'),
            'store_address2' => $this->request->getPost('store_address2'),
            'store_city'     => $this->request->getPost('store_city'),
            'store_country'  => $this->request->getPost('store_country'),
            'store_postcode' => $this->request->getPost('store_postcode'),
            'store_handle'   => $this->request->getPost('store_handle'),
        ];
        if ($this->mdlStorerobot->updateStoreRobot($data, ['id' => $id])) {
            $this->session->setFlashdata('success', 'Robot Store Updated Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while updating robot store!');
        }
        return redirect()->to(base_url('admin/storerobot/Viewstore'));
    }

    public function remove(?int $id = null): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if ($this->mdlStorerobot->remove($id)) {
            $this->session->setFlashdata('success', 'Robot Store Removed Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while deleting robot store!');
        }
        return redirect()->to(base_url('admin/storerobot/Viewstore'));
    }
}
