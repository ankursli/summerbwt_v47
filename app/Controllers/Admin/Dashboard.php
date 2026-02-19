<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('admin_user')) {
            return redirect()->to(base_url('admin'));
        }

        $data = [
            'success' => session()->getFlashdata('success'),
            'error'   => session()->getFlashdata('error'),
            'main_content' => 'admin/dashboard'
        ];

        return view('admin/front', $data);
    }
}
