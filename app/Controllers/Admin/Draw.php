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
        
        $draws = $this->mdlDraw->GetProofofcoupon(['draw.draw_id' => $id]);
        
        if (empty($draws)) {
            return redirect()->to(base_url('admin/draw'))->with('error', 'Draw not found');
        }

        $db = \Config\Database::connect();
        $couponcodes = $db->table('store_coupon_list')->get()->getResultArray();

        return view('admin/header')
            . view('admin/draw/edit', [
                'draws'       => $draws,
                'couponcodes' => $couponcodes,
                'Mdl_Store'   => $this->mdlStore,
                'success'     => $this->session->getFlashdata('success'),
                'error'       => $this->session->getFlashdata('error'),
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
        if ($this->mdlDraw->updateDraw($data, ['draw_id' => $id])) {
            $this->session->setFlashdata('success', 'Draw Updated Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while updating draw!');
        }
        return redirect()->to(base_url('admin/draw'));
    }

    public function finalupdate()
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        
        $id = $this->request->getGet('draw');
        if (empty($id)) {
            $id = $this->request->getPost('draw');
        }

        $data = [];
        if ($this->request->getPost('Approved')) {
            $data['status'] = 1;
        }

        if (!empty($data)) {
            if ($this->mdlDraw->updateDraw($data, ['draw_id' => $id])) {
                $this->session->setFlashdata('success', 'Draw Updated Successfully');
            } else {
                $this->session->setFlashdata('error', 'Error while updating draw!');
            }
        }
        
        return redirect()->to(base_url('admin/draw'));
    }

    public function rejectdraw()
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        
        $id     = $this->request->getPost('draw');
        $status = $this->request->getPost('status');
        
        $data = [
            'status' => $status,
        ];

        if ($this->mdlDraw->updateDraw($data, ['draw_id' => $id])) {
            $this->session->setFlashdata('success', 'Draw Rejected Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while rejecting draw!');
        }
        
        return redirect()->to(base_url('admin/draw'));
    }

    public function remove(?int $id = null): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if ($this->mdlDraw->remove(['draw_id' => $id])) {
            $this->session->setFlashdata('success', 'Draw Removed Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while deleting draw!');
        }
        return redirect()->to(base_url('admin/draw'));
    }

    public function export_draw()
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        
        $draws = $this->mdlDraw->GetProofofcoupon();
        
        $filename = 'draw_export_' . date('Ymd_His') . '.csv';
        
        $response = $this->response->setHeader('Content-Type', 'text/csv; charset=utf-8')
                                   ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
        
        $output = fopen('php://temp', 'w');
        fputs($output, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
        
        fputcsv($output, [
            'ID',
            'Username',
            'Robot',
            'Stores',
            'Another Store',
            'Upload Draw',
            'Draw Date',
            'Client Type',
            'Status'
        ]);
        
        foreach ($draws as $draw) {
            $name = $draw['store_name'] ?? '';
            $anotherStore = '';
            if ($name == 'AUTRE') {
                $anotherStore = strtoupper($draw['store_name_additional'] ?? '') . " - " . ($draw['address'] ?? '') . " " . ($draw['addition_address'] ?? '') . " " . ($draw['zipcode'] ?? '') . " " . ($draw['city'] ?? '');
            }
            
            $clienttype = '';
            if (($draw['clienttype'] ?? '') == 'particulier') {
                $clienttype = 'Particulier';
            } else if (($draw['clienttype'] ?? '') == 'pro') {
                $clienttype = 'Professionnal';
            } else {
                $clienttype = 'NULL';
            }
            
            $statusStr = 'Pending';
            if (($draw['status'] ?? 0) == 1) {
                $statusStr = 'Approved';
            } elseif (($draw['status'] ?? 0) == 2) {
                $statusStr = 'Rejected';
            }
            
            fputcsv($output, [
                $draw['draw_id'] ?? '',
                $draw['email'] ?? '',
                $draw['coupon_name'] ?? '',
                $draw['store_name'] ?? '',
                $anotherStore,
                $draw['upload_draw'] ?? '',
                $draw['upload_draw_date'] ?? '',
                $clienttype,
                $statusStr
            ]);
        }
        
        rewind($output);
        $csvData = stream_get_contents($output);
        fclose($output);
        
        return $response->setBody($csvData);
    }
}
