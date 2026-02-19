<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Mdl_Robot;

class Robot extends BaseController
{
    protected Mdl_Robot $mdlRobot;
    protected \CodeIgniter\Session\Session $session;
    protected \CodeIgniter\Validation\Validation $validation;

    public function __construct()
    {
        $this->mdlRobot   = new Mdl_Robot();
        $this->session    = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        helper(['form', 'url', 'language']);
        if (empty($this->session->get('site_lang'))) {
            $this->session->set('site_lang', 'french');
        }
    }

    private function requireLogin(): bool
    {
        return (bool) $this->session->get('admin_user');
    }

    public function Viewrobot(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        $robots = $this->mdlRobot->GetRecordUsers();
        return view('admin/header')
            . view('admin/robot/list', [
                'robots'  => $robots,
                'success' => $this->session->getFlashdata('success'),
                'error'   => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function Addrobot(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        return view('admin/header')
            . view('admin/robot/create', [
                'success' => $this->session->getFlashdata('success'),
                'error'   => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function create(): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if (strtolower($this->request->getMethod()) !== 'post') {
            return redirect()->to(base_url('admin/robot/Addrobot'));
        }
        $data = [
            'robot_code'    => $this->request->getPost('robot_code'),
            'robot_name'    => $this->request->getPost('robot_name'),
            'robot_price'   => $this->request->getPost('robot_price'),
            'validity_date' => $this->request->getPost('validity_date'),
            'created_date'  => date('Y-m-d H:i:s'),
        ];
        if ($this->mdlRobot->insertRobot($data)) {
            $this->session->setFlashdata('success', 'Robot Created Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while creating robot!');
        }
        return redirect()->to(base_url('admin/robot/Viewrobot'));
    }

    public function edit(?int $id = null): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if (empty($id)) return redirect()->to(base_url('admin/robot/Viewrobot'));
        $robots = $this->mdlRobot->GetRecordUsers(['id' => $id]);
        return view('admin/header')
            . view('admin/robot/edit', [
                'robots'  => $robots,
                'success' => $this->session->getFlashdata('success'),
                'error'   => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function update(?int $id = null): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if (empty($id)) return redirect()->to(base_url('admin/robot/Viewrobot'));
        $data = [
            'robot_code'    => $this->request->getPost('robot_code'),
            'robot_name'    => $this->request->getPost('robot_name'),
            'robot_price'   => $this->request->getPost('robot_price'),
            'validity_date' => $this->request->getPost('validity_date'),
        ];
        if ($this->mdlRobot->updateRobot($data, ['id' => $id])) {
            $this->session->setFlashdata('success', 'Robot Updated Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while updating robot!');
        }
        return redirect()->to(base_url('admin/robot/Viewrobot'));
    }

    public function remove(?int $id = null): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if ($this->mdlRobot->remove($id)) {
            $this->session->setFlashdata('success', 'Robot Removed Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while deleting robot!');
        }
        return redirect()->to(base_url('admin/robot/Viewrobot'));
    }
}
