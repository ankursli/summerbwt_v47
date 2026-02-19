<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Mdl_Coupon;

class Coupon extends BaseController
{
    protected Mdl_Coupon $mdlCoupon;
    protected \CodeIgniter\Session\Session $session;

    public function __construct()
    {
        $this->mdlCoupon = new Mdl_Coupon();
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

    public function Viewcoupon(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        $coupons = $this->mdlCoupon->GetRecordUsers();
        return view('admin/header')
            . view('admin/coupon/list', [
                'coupons' => $coupons,
                'success' => $this->session->getFlashdata('success'),
                'error'   => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function Addcoupon(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        return view('admin/header')
            . view('admin/coupon/create', [
                'success' => $this->session->getFlashdata('success'),
                'error'   => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function create(): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));

        // Handle image upload
        $couponImage = '';
        $file = $this->request->getFile('coupon_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'upload', $newName);
            $couponImage = $newName;
        }

        $data = [
            'coupon_name'   => $this->request->getPost('coupon_name'),
            'coupon_image'  => $couponImage,
            'coupon_price'  => $this->request->getPost('coupon_price'),
            'validity_date' => $this->request->getPost('validity_date'),
            'created_date'  => date('Y-m-d H:i:s'),
        ];
        if ($this->mdlCoupon->insertCoupon($data)) {
            $this->session->setFlashdata('success', 'Coupon Created Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while creating coupon!');
        }
        return redirect()->to(base_url('admin/coupon/Viewcoupon'));
    }

    public function edit(?int $id = null): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if (empty($id)) return redirect()->to(base_url('admin/coupon/Viewcoupon'));
        $coupons = $this->mdlCoupon->GetRecordUsers(['id' => $id]);
        return view('admin/header')
            . view('admin/coupon/edit', [
                'coupons' => $coupons,
                'success' => $this->session->getFlashdata('success'),
                'error'   => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function update(?int $id = null): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));

        $data = [
            'coupon_name'   => $this->request->getPost('coupon_name'),
            'coupon_price'  => $this->request->getPost('coupon_price'),
            'validity_date' => $this->request->getPost('validity_date'),
        ];

        $file = $this->request->getFile('coupon_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'upload', $newName);
            $data['coupon_image'] = $newName;
        }

        if ($this->mdlCoupon->updateCoupon($data, ['id' => $id])) {
            $this->session->setFlashdata('success', 'Coupon Updated Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while updating coupon!');
        }
        return redirect()->to(base_url('admin/coupon/Viewcoupon'));
    }

    public function remove(?int $id = null): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if ($this->mdlCoupon->remove($id)) {
            $this->session->setFlashdata('success', 'Coupon Removed Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while deleting coupon!');
        }
        return redirect()->to(base_url('admin/coupon/Viewcoupon'));
    }
}
