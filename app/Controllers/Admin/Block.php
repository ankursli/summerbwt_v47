<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Mdl_Block;

class Block extends BaseController
{
    protected Mdl_Block $mdlBlock;
    protected \CodeIgniter\Session\Session $session;
    protected \CodeIgniter\Validation\Validation $validation;

    public function __construct()
    {
        $this->mdlBlock   = new Mdl_Block();
        $this->session    = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        helper(['form', 'url', 'language']);

        $siteLang = $this->session->get('site_lang');
        if (empty($siteLang)) {
            $this->session->set('site_lang', 'french');
        }
    }

    private function requireLogin(): bool
    {
        if (!$this->session->get('admin_user')) {
            return false;
        }
        return true;
    }

    public function Viewblock(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));

        $siteLang  = $this->session->get('site_lang');
        $block     = $this->mdlBlock->GetRecordBlocks(['language' => $siteLang]);
        $blockcount = count($block);

        return view('admin/header')
            . view('admin/block/viewblock', [
                'block'      => $block,
                'blockcount' => $blockcount,
                'success'    => $this->session->getFlashdata('success'),
                'error'      => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function Addblock(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));

        $siteLang    = $this->session->get('site_lang');
        $block       = $this->mdlBlock->GetRecordBlocks(['language' => $siteLang]);
        $masterblocks = ['block-1', 'block-2', 'block-3'];
        $usedblocks  = array_column($block, 'block');
        $blocks      = array_values(array_diff($masterblocks, $usedblocks));

        return view('admin/header')
            . view('admin/block/createblock', [
                'blocks'  => $blocks,
                'success' => $this->session->getFlashdata('success'),
                'error'   => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function createblock(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));

        if (strtolower($this->request->getMethod()) !== 'post') {
            return redirect()->to(base_url('admin/block/Addblock'));
        }

        $this->validation->setRules([
            'fr_title'          => 'required',
            'fr_date'           => 'required',
            'fr_middle_content' => 'required',
            'fr_bottom_content' => 'required',
            'en_title'          => 'required',
            'en_date'           => 'required',
            'en_middle_content' => 'required',
            'en_bottom_content' => 'required',
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            $this->session->setFlashdata('error', 'Please fill all required fields.');
            return redirect()->to(base_url('admin/block/Addblock'));
        }

        $frinsert = [
            'title'          => $this->request->getPost('fr_title'),
            'date'           => $this->request->getPost('fr_date'),
            'middle_content' => $this->request->getPost('fr_middle_content'),
            'bottom_content' => $this->request->getPost('fr_bottom_content'),
            'bg_color'       => $this->request->getPost('bg_color'),
            'opacity'        => $this->request->getPost('opacity'),
            'link'           => $this->request->getPost('link'),
            'status'         => $this->request->getPost('status'),
            'block'          => $this->request->getPost('block'),
            'language'       => 'french',
            'date_created'   => date('Y-m-d H:i:s'),
        ];

        $eninsert = [
            'title'          => $this->request->getPost('en_title'),
            'date'           => $this->request->getPost('en_date'),
            'middle_content' => $this->request->getPost('en_middle_content'),
            'bottom_content' => $this->request->getPost('en_bottom_content'),
            'bg_color'       => $this->request->getPost('bg_color'),
            'opacity'        => $this->request->getPost('opacity'),
            'link'           => $this->request->getPost('link'),
            'status'         => $this->request->getPost('status'),
            'block'          => $this->request->getPost('block'),
            'language'       => 'english',
            'date_created'   => date('Y-m-d H:i:s'),
        ];

        $frblock = $this->mdlBlock->insertBlock($frinsert);
        $enblock = $this->mdlBlock->insertBlock($eninsert);

        if ($frblock && $enblock) {
            $this->mdlBlock->insertconnection(['french_id' => $frblock, 'english_id' => $enblock]);
            $this->session->setFlashdata('success', 'Block Successfully Created');
        } else {
            if ($frblock) $this->mdlBlock->deletefrblock($frblock);
            if ($enblock) $this->mdlBlock->deleteenblock($enblock);
            $this->session->setFlashdata('error', 'Error while creating block!');
        }

        return redirect()->to(base_url('admin/block/Viewblock'));
    }

    public function editblock(?int $id = null): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));

        if (empty($id)) return redirect()->to(base_url('admin/block/Viewblock'));

        $siteLang       = $this->session->get('site_lang');
        $blockconnection = $this->mdlBlock->getblockconnection($id, $siteLang);
        $frblock        = $this->mdlBlock->GetRecordBlocks(['id' => $blockconnection['frid']]);
        $enblock        = $this->mdlBlock->GetRecordBlocks(['id' => $blockconnection['enid']]);
        $block          = $this->mdlBlock->GetRecordBlocks(['id' => $id]);

        return view('admin/header')
            . view('admin/block/editblock', [
                'block'   => $block,
                'frblock' => $frblock,
                'enblock' => $enblock,
                'success' => $this->session->getFlashdata('success'),
                'error'   => $this->session->getFlashdata('error'),
            ])
            . view('admin/footer');
    }

    public function updateblock(?int $id = null): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if (empty($id)) return redirect()->to(base_url('admin/block/Viewblock'));

        if (strtolower($this->request->getMethod()) !== 'post') {
            return redirect()->to(base_url('admin/block/editblock/' . $id));
        }

        $siteLang = $this->session->get('site_lang');

        $frinsert = [
            'title'          => $this->request->getPost('fr_title'),
            'date'           => $this->request->getPost('fr_date'),
            'middle_content' => $this->request->getPost('fr_middle_content'),
            'bottom_content' => $this->request->getPost('fr_bottom_content'),
            'bg_color'       => $this->request->getPost('bg_color'),
            'opacity'        => $this->request->getPost('opacity'),
            'link'           => $this->request->getPost('link'),
            'status'         => $this->request->getPost('status'),
            'block'          => $this->request->getPost('block'),
            'language'       => 'french',
            'date_created'   => date('Y-m-d H:i:s'),
        ];

        $eninsert = [
            'title'          => $this->request->getPost('en_title'),
            'date'           => $this->request->getPost('en_date'),
            'middle_content' => $this->request->getPost('en_middle_content'),
            'bottom_content' => $this->request->getPost('en_bottom_content'),
            'bg_color'       => $this->request->getPost('bg_color'),
            'opacity'        => $this->request->getPost('opacity'),
            'link'           => $this->request->getPost('link'),
            'status'         => $this->request->getPost('status'),
            'block'          => $this->request->getPost('block'),
            'language'       => 'english',
            'date_created'   => date('Y-m-d H:i:s'),
        ];

        $blockconnection = $this->mdlBlock->getblockconnection($id, $siteLang);
        $frOk = $this->mdlBlock->updateBlock($frinsert, ['id' => $blockconnection['frid']]);
        $enOk = $this->mdlBlock->updateBlock($eninsert, ['id' => $blockconnection['enid']]);

        if ($frOk && $enOk) {
            $this->session->setFlashdata('success', 'Block Successfully Updated');
        } else {
            $this->session->setFlashdata('error', 'Error while updating block!');
        }

        return redirect()->to(base_url('admin/block/Viewblock'));
    }

    public function removeblock(?int $id = null): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));

        $siteLang = $this->session->get('site_lang');
        $result   = $this->mdlBlock->deleteconnection($id, $siteLang);

        if ($result) {
            $this->session->setFlashdata('success', 'Block Removed Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while deleting block!');
        }

        return redirect()->to(base_url('admin/block/Viewblock'));
    }
}
