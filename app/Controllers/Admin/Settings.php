<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Mdl_Settings;

class Settings extends BaseController
{
    protected Mdl_Settings $mdlSettings;
    protected \CodeIgniter\Session\Session $session;

    public function __construct()
    {
        $this->mdlSettings = new Mdl_Settings();
        $this->session     = \Config\Services::session();
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
        $settings = $this->mdlSettings->GetRecord();
        return view('admin/header')
            . view('admin/settings/list', [
                'settings' => $settings,
                'success'  => $this->session->getFlashdata('success'),
                'error'    => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function update(): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        $data = [
            'from_email'  => $this->request->getPost('from_email'),
            'smtp_name'   => $this->request->getPost('smtp_name'),
            'host'        => $this->request->getPost('host'),
            'port'        => $this->request->getPost('port'),
            'username'    => $this->request->getPost('username'),
            'password'    => $this->request->getPost('password'),
            'update_date' => date('Y-m-d H:i:s'),
        ];

        $settings = $this->mdlSettings->GetRecord();
        if (!empty($settings)) {
            $this->mdlSettings->updateSetting($data, ['id' => $settings[0]['id']]);
        } else {
            $this->mdlSettings->insertSetting($data);
        }

        $this->session->setFlashdata('success', 'SMTP Settings Updated Successfully');
        return redirect()->to(base_url('admin/settings'));
    }
}
