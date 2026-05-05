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
        
        $proofs = $this->mdlProof->GetProofofcoupon(['proof_of_purchase.purchase_id' => $id]);
        
        if (empty($proofs)) {
            return redirect()->to(base_url('admin/proof'))->with('error', 'Proof not found');
        }

        $db = \Config\Database::connect();
        $couponcodes = $db->table('store_coupon_list')->get()->getResultArray();

        return view('admin/header')
            . view('admin/proof/edit', [
                'proofs'         => $proofs,
                'couponcodes'    => $couponcodes,
                'Mdl_Storerobot' => $this->mdlStorerobot,
                'success'        => $this->session->getFlashdata('success'),
                'error'          => $this->session->getFlashdata('error'),
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
        if ($this->mdlProof->updateProof($data, ['purchase_id' => $id])) {
            $this->session->setFlashdata('success', 'Proof Updated Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while updating proof!');
        }
        return redirect()->to(base_url('admin/proof'));
    }

    public function finalupdate()
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        
        $id = $this->request->getGet('purchase');
        if (empty($id)) {
            $id = $this->request->getPost('purchase');
        }

        $data = [];
        if ($this->request->getPost('Approved')) {
            $data['status'] = 1;
        }

        if (!empty($data)) {
            if ($this->mdlProof->updateProof($data, ['purchase_id' => $id])) {
                $this->session->setFlashdata('success', 'Proof Updated Successfully');
            } else {
                $this->session->setFlashdata('error', 'Error while updating proof!');
            }
        }
        
        return redirect()->to(base_url('admin/proof'));
    }

    public function rejectproof()
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        
        $id     = $this->request->getPost('purchase');
        $status = $this->request->getPost('status');
        
        $data = [
            'status' => $status,
        ];

        if ($this->mdlProof->updateProof($data, ['purchase_id' => $id])) {
            $this->session->setFlashdata('success', 'Proof Rejected Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while rejecting proof!');
        }
        
        return redirect()->to(base_url('admin/proof'));
    }

    public function remove(?int $id = null): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        if ($this->mdlProof->remove(['purchase_id' => $id])) {
            $this->session->setFlashdata('success', 'Proof Removed Successfully');
        } else {
            $this->session->setFlashdata('error', 'Error while deleting proof!');
        }
        return redirect()->to(base_url('admin/proof'));
    }

    public function export_proof()
    {
        if (!$this->requireLogin()) return redirect()->to(base_url('admin'));
        
        $proofs = $this->mdlProof->GetProofofcoupon();
        
        $filename = 'proof_export_' . date('Ymd_His') . '.csv';
        
        $response = $this->response->setHeader('Content-Type', 'text/csv; charset=utf-8')
                                   ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
        
        $output = fopen('php://temp', 'w');
        fputs($output, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
        
        fputcsv($output, [
            'ID',
            'Username',
            'Robot',
            'Robot Information',
            'Stores',
            'Another Store',
            'Upload Proof',
            'Proof Date',
            'Date of Purchase',
            'Bank Details',
            'Client Type',
            'Status'
        ]);
        
        foreach ($proofs as $proof) {
            $name = $proof['store_name'] ?? '';
            $anotherStore = '';
            if ($name == 'AUTRE') {
                $anotherStore = strtoupper($proof['store_name_additional'] ?? '') . " - " . ($proof['address'] ?? '') . " " . ($proof['addition_address'] ?? '') . " " . ($proof['zipcode'] ?? '') . " " . ($proof['city'] ?? '');
            }
            
            $robotInfo = "Serial no: " . ($proof['robot_serial_no'] ?? '') . " - Robot Date: " . ($proof['robot_purchase_date'] ?? '');
            
            $bankDetails = "BIC: " . ($proof['bic'] ?? '') . " - IBAN: " . ($proof['iban'] ?? '');
            
            $clienttype = '';
            if (($proof['clienttype'] ?? '') == 'particulier') {
                $clienttype = 'Particulier';
            } else if (($proof['clienttype'] ?? '') == 'pro') {
                $clienttype = 'Professionnal';
            } else {
                $clienttype = 'NULL';
            }
            
            $statusStr = 'Pending';
            if (($proof['status'] ?? 0) == 1) {
                $statusStr = 'Approved';
            } elseif (($proof['status'] ?? 0) == 2) {
                $statusStr = 'Rejected';
            }
            
            fputcsv($output, [
                $proof['purchase_id'] ?? '',
                $proof['email'] ?? '',
                $proof['robot_name'] ?? '',
                $robotInfo,
                $proof['store_name'] ?? '',
                $anotherStore,
                $proof['upload_proof'] ?? '',
                $proof['upload_proof_date'] ?? '',
                $proof['robot_purchase_date'] ?? '',
                $bankDetails,
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
