<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Mdl_Proof;
use App\Models\Mdl_Storerobot;
use App\Models\Mdl_Robot;

class Proof extends BaseController
{
    protected Mdl_Proof $mdlProof;
    protected Mdl_Storerobot $mdlStorerobot;
    protected Mdl_Robot $mdlRobot;
    protected \CodeIgniter\Session\Session $session;

    public function __construct()
    {
        $this->mdlProof      = new Mdl_Proof();
        $this->mdlStorerobot = new Mdl_Storerobot();
        $this->mdlRobot      = new Mdl_Robot();
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

    public function index(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        $proofs = $this->mdlProof->GetProofofcoupon();
        $db = \Config\Database::connect();
        $total_raw = $db->table('proof_of_purchase')->countAllResults();
        $this->session->setFlashdata('debug_msg', 'DEBUG: Total in table: ' . $total_raw . ' | Joined: ' . count($proofs));

        return view('admin/header')
            . view('admin/proof/list', [
                'proofs'         => $proofs,
                'Mdl_Storerobot' => $this->mdlStorerobot,
                'Mdl_Robot'      => $this->mdlRobot,
                'success'        => $this->session->getFlashdata('success'),
                'error'          => $this->session->getFlashdata('error'),
                'debug_msg'      => $this->session->getFlashdata('debug_msg'),
            ])
            . view('admin/footer');
    }

    public function edit(?int $id = null): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if (empty($id)) return redirect()->to(base_url('admin/proof'));
        $proof = $this->mdlProof->GetRecord(['id' => $id]);
        return view('admin/header')
            . view('admin/proof/edit', [
                'proof'   => $proof[0] ?? [],
                'success' => $this->session->getFlashdata('success'),
                'error'   => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function newupdate(): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        $id   = $this->request->getPost('id');
        $data = [
            'status'  => $this->request->getPost('status'),
            'comment' => $this->request->getPost('comment'),
        ];
        if ($this->mdlProof->updateProof($data, ['id' => $id])) {
            $this->session->setFlashdata('success', 'Proof Updated Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while updating proof!');
        }
        return redirect()->to(base_url('admin/proof'));
    }

    public function remove(?int $id = null): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if ($this->mdlProof->remove(['id' => $id])) {
            $this->session->setFlashdata('success', 'Proof Removed Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while deleting proof!');
        }
        return redirect()->to(base_url('admin/proof'));
    }
}
