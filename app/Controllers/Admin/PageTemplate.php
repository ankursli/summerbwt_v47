<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Mdl_Template as Mdl_PageTemplate;

class PageTemplate extends BaseController
{
    protected \CodeIgniter\Session\Session $session;
    protected $db;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->db      = \Config\Database::connect();
        helper(['form', 'url', 'language']);
        if (empty($this->session->get('site_lang'))) {
            $this->session->set('site_lang', 'french');
        }
    }

    private function requireLogin(): bool
    {
        return (bool) $this->session->get('admin_user');
    }

    private function getAll(?array $conditions = null): array
    {
        $builder = $this->db->table('page_template');
        if (!empty($conditions)) $builder->where($conditions);
        return $builder->get()->getResultArray();
    }

    private function insertRecord(array $data): int|false
    {
        $builder = $this->db->table('page_template');
        if ($builder->insert($data)) return $this->db->insertID();
        return false;
    }

    private function updateRecord(array $data, array $conditions): bool
    {
        $builder = $this->db->table('page_template');
        $builder->where($conditions);
        return $builder->update($data);
    }

    private function deleteRecord(int $id): bool
    {
        return $this->db->table('page_template')->where('id', $id)->delete();
    }

    public function viewpage(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        $siteLang  = $this->session->get('site_lang');
        $pages     = $this->getAll(['language' => $siteLang]);
        return view('admin/header')
            . view('admin/pagetemplate/list', [
                'pages'   => $pages,
                'success' => $this->session->getFlashdata('success'),
                'error'   => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function Addpage(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        return view('admin/header')
            . view('admin/pagetemplate/create', [
                'success' => $this->session->getFlashdata('success'),
                'error'   => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function create(): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        $data = [
            'page_name'    => $this->request->getPost('page_name'),
            'page_content' => $this->request->getPost('page_content'),
            'language'     => $this->session->get('site_lang'),
            'created_date' => date('Y-m-d H:i:s'),
        ];
        if ($this->insertRecord($data)) {
            $this->session->setFlashdata('success', 'Page Template Created Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while creating page template!');
        }
        return redirect()->to(base_url('admin/pagetemplate/viewpage'));
    }

    public function edit(?int $id = null): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if (empty($id)) return redirect()->to(base_url('admin/pagetemplate/viewpage'));
        $template = $this->getAll(['id' => $id]);
        return view('admin/header')
            . view('admin/pagetemplate/edit', [
                'template' => $template[0] ?? [],
                'success'  => $this->session->getFlashdata('success'),
                'error'    => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function update(?int $id = null): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        $data = [
            'page_name'    => $this->request->getPost('page_name'),
            'page_content' => $this->request->getPost('page_content'),
        ];
        if ($this->updateRecord($data, ['id' => $id])) {
            $this->session->setFlashdata('success', 'Page Template Updated Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while updating page template!');
        }
        return redirect()->to(base_url('admin/pagetemplate/viewpage'));
    }

    public function remove(?int $id = null): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if ($this->deleteRecord($id)) {
            $this->session->setFlashdata('success', 'Page Template Removed Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while deleting page template!');
        }
        return redirect()->to(base_url('admin/pagetemplate/viewpage'));
    }
}
