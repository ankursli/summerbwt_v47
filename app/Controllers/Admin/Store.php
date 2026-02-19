<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Mdl_Store;
use App\Models\Mdl_Country;

class Store extends BaseController
{
    protected Mdl_Store $mdlStore;
    protected Mdl_Country $mdlCountry;
    protected \CodeIgniter\Session\Session $session;

    public function __construct()
    {
        $this->mdlStore   = new Mdl_Store();
        $this->mdlCountry = new Mdl_Country();
        $this->session    = \Config\Services::session();
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
        $stores = $this->mdlStore->GetRecordUsers();
        return view('admin/header')
            . view('admin/store/list', [
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
            . view('admin/store/create', [
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
        if ($this->mdlStore->insertStore($data)) {
            $this->session->setFlashdata('success', 'Store Created Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while creating store!');
        }
        return redirect()->to(base_url('admin/store/Viewstore'));
    }

    public function edit(?int $id = null): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if (empty($id)) return redirect()->to(base_url('admin/store/Viewstore'));
        $stores = $this->mdlStore->GetRecordUsers(['id' => $id]);
        $countries = $this->mdlCountry->GetRecord();
        return view('admin/header')
            . view('admin/store/edit', [
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
        if ($this->mdlStore->updateStore($data, ['id' => $id])) {
            $this->session->setFlashdata('success', 'Store Updated Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while updating store!');
        }
        return redirect()->to(base_url('admin/store/Viewstore'));
    }

    public function remove(?int $id = null): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if ($this->mdlStore->remove($id)) {
            $this->session->setFlashdata('success', 'Store Removed Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while deleting store!');
        }
        return redirect()->to(base_url('admin/store/Viewstore'));
    }
}
