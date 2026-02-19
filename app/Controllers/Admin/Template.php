<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Mdl_Template;

class Template extends BaseController
{
    protected Mdl_Template $mdlTemplate;
    protected \CodeIgniter\Session\Session $session;

    public function __construct()
    {
        $this->mdlTemplate = new Mdl_Template();
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

    public function Viewtemplate(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        $siteLang  = $this->session->get('site_lang');
        $templates = $this->mdlTemplate->GetRecordUsers(['language' => $siteLang]);
        return view('admin/header')
            . view('admin/template/list', [
                'templates' => $templates,
                'success'   => $this->session->getFlashdata('success'),
                'error'     => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function Addtemplate(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        return view('admin/header')
            . view('admin/template/create', [
                'templates' => [], // Added to satisfy view requirements
                'success'   => $this->session->getFlashdata('success'),
                'error'     => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function create(): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        $data = [
            'template_name'    => $this->request->getPost('template_name'),
            'template_subject' => $this->request->getPost('template_subject'),
            'template'         => $this->request->getPost('template'),
            'language'         => $this->request->getPost('template_language') ?: $this->session->get('site_lang'),
            'type'             => $this->request->getPost('template_type'),
            'created_date'     => date('Y-m-d H:i:s'),
        ];
        if ($this->mdlTemplate->insertTemplate($data)) {
            $this->session->setFlashdata('success', 'Mail Template Created Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while creating template!');
        }
        return redirect()->to(base_url('admin/template/Viewtemplate'));
    }

    public function edit(?int $id = null): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if (empty($id)) return redirect()->to(base_url('admin/template/Viewtemplate'));
        $template = $this->mdlTemplate->GetRecordUsers(['id' => $id]);
        return view('admin/header')
            . view('admin/template/edit', [
                'templates' => $template, // Passed as plural to match view expectation
                'success'   => $this->session->getFlashdata('success'),
                'error'     => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function update(?int $id = null): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        $data = [
            'template_name'    => $this->request->getPost('template_name'),
            'template_subject' => $this->request->getPost('template_subject'),
            'template'         => $this->request->getPost('template'),
            'language'         => $this->request->getPost('template_language'),
            'type'             => $this->request->getPost('template_type'),
        ];
        if ($this->mdlTemplate->updateTemplate($data, ['id' => $id])) {
            $this->session->setFlashdata('success', 'Mail Template Updated Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while updating template!');
        }
        return redirect()->to(base_url('admin/template/Viewtemplate'));
    }

    public function remove(?int $id = null): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if ($this->mdlTemplate->remove($id)) {
            $this->session->setFlashdata('success', 'Template Removed Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while deleting template!');
        }
        return redirect()->to(base_url('admin/template/Viewtemplate'));
    }
}
