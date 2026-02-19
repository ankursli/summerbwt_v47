<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Mdl_Draw;
use App\Models\Mdl_Store;
use App\Models\Mdl_Coupon;

class Draw extends BaseController
{
    protected Mdl_Draw $mdlDraw;
    protected Mdl_Store $mdlStore;
    protected Mdl_Coupon $mdlCoupon;
    protected \CodeIgniter\Session\Session $session;

    public function __construct()
    {
        $this->mdlDraw   = new Mdl_Draw();
        $this->mdlStore  = new Mdl_Store();
        $this->mdlCoupon = new Mdl_Coupon();
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

    public function index(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        $draws = $this->mdlDraw->GetProofofcoupon();
        return view('admin/header')
            . view('admin/draw/list', [
                'draws'     => $draws,
                'Mdl_Store' => $this->mdlStore,
                'Mdl_Coupon'=> $this->mdlCoupon,
                'success'   => $this->session->getFlashdata('success'),
                'error'     => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function edit(?int $id = null): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if (empty($id)) return redirect()->to(base_url('admin/draw'));
        $draw = $this->mdlDraw->GetRecord(['id' => $id]);
        return view('admin/header')
            . view('admin/draw/edit', [
                'draw'    => $draw[0] ?? [],
                'success' => $this->session->getFlashdata('success'),
                'error'   => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function update(): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        $id   = $this->request->getPost('id');
        $data = [
            'status'  => $this->request->getPost('status'),
            'comment' => $this->request->getPost('comment'),
        ];
        if ($this->mdlDraw->updateDraw($data, ['id' => $id])) {
            $this->session->setFlashdata('success', 'Draw Updated Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while updating draw!');
        }
        return redirect()->to(base_url('admin/draw'));
    }

    public function remove(?int $id = null): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if ($this->mdlDraw->remove(['id' => $id])) {
            $this->session->setFlashdata('success', 'Draw Removed Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while deleting draw!');
        }
        return redirect()->to(base_url('admin/draw'));
    }
}
