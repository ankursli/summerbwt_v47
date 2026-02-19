<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Mdl_Clientsupport;

class Client_support extends BaseController
{
    protected Mdl_Clientsupport $mdlClientsupport;
    protected \CodeIgniter\Session\Session $session;

    public function __construct()
    {
        $this->mdlClientsupport = new Mdl_Clientsupport();
        $this->session          = \Config\Services::session();
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
        $supports = $this->mdlClientsupport->GetSupport();
        return view('admin/header')
            . view('admin/client_support/list', [
                'supports' => $supports,
                'success'  => $this->session->getFlashdata('success'),
                'error'    => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function remove(?int $id = null): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if ($this->mdlClientsupport->remove($id)) {
            $this->session->setFlashdata('success', 'Contact Removed Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while deleting contact!');
        }
        return redirect()->to(base_url('admin/client_support'));
    }
}
