<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Mdl_Refund;
use App\Models\Mdl_Store;

class Refund extends BaseController
{
    protected Mdl_Refund $mdlRefund;
    protected Mdl_Store $mdlStore;
    protected \CodeIgniter\Session\Session $session;

    public function __construct()
    {
        $this->mdlRefund = new Mdl_Refund();
        $this->mdlStore  = new Mdl_Store();
        $this->session   = \Config\Services::session();
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
        $refunds = $this->mdlRefund->GetRecordUsers();
        return view('admin/header')
            . view('admin/refund/list', [
                'refunds'   => $refunds,
                'Mdl_Store' => $this->mdlStore,
                'success'   => $this->session->getFlashdata('success'),
                'error'     => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function remove(?int $id = null): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if ($this->mdlRefund->remove($id)) {
            $this->session->setFlashdata('success', 'Refund Removed Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while deleting refund!');
        }
        return redirect()->to(base_url('admin/refund'));
    }
}
