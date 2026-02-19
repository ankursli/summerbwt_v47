<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Mdl_Country;

class Country extends BaseController
{
    protected Mdl_Country $mdlCountry;
    protected \CodeIgniter\Session\Session $session;

    public function __construct()
    {
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

    public function index(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        $countries  = $this->mdlCountry->GetRecord();
        $countries1 = $this->mdlCountry->GetRecord(['is_allow' => 1]);
        return view('admin/header')
            . view('admin/country/list', [
                'countries'  => $countries,
                'countries1' => $countries1,
                'success'    => $this->session->getFlashdata('success'),
                'error'      => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function update(): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        $allowedIds = $this->request->getPost('country_code') ?? [];

        // Reset all to 0
        $allCountries = $this->mdlCountry->GetRecord();
        foreach ($allCountries as $country) {
            $this->mdlCountry->updateCountry(['is_allow' => 0], ['id' => $country['id']]);
        }
        // Set selected ones to 1
        foreach ($allowedIds as $id) {
            $this->mdlCountry->updateCountry(['is_allow' => 1], ['id' => $id]);
        }

        $this->session->setFlashdata('success', 'Country Restrictions Updated Successfully');
        return redirect()->to(base_url('admin/country'));
    }
}
