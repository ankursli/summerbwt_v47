<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Mdl_User;

class User extends BaseController
{
    protected Mdl_User $mdlUser;
    protected \CodeIgniter\Session\Session $session;
    protected \CodeIgniter\Validation\Validation $validation;

    public function __construct()
    {
        $this->mdlUser = new Mdl_User();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        helper(['form', 'url', 'language']);

        $siteLang = $this->session->get('site_lang');
        if (empty($siteLang)) {
            $this->session->set('site_lang', 'french');
        }
    }

    public function index()
    {
        if ($this->session->get('admin_user')) {
            return redirect()->to(base_url('admin/dashboard'));
        } else {
            return view('admin/login');
        }
    }

    public function checklogin()
    {
        if (strtolower($this->request->getMethod()) === 'post') {
            $username = $this->request->getPost('email');
            $password = md5($this->request->getPost('password'));

            $this->validation->setRules([
                'email' => 'trim|required',
                'password' => 'trim|required'
            ]);

            if (!$this->validation->withRequest($this->request)->run()) {
                return view('admin/login', [
                    'validation' => $this->validation
                ]);
            } else {
                $user = $this->mdlUser->checkUserWeb($username, $password);
                if ($user) {
                    $this->session->set('admin_user', $user);
                    if ($this->session->get('site_lang') == 'english') {
                        $this->session->setFlashdata('success', 'Admin Login successfully!');
                    } else {
                        $this->session->setFlashdata('success', 'Admin Login avec succès!');
                    }
                    return redirect()->to(base_url('admin/dashboard'));
                } else {
                    if ($this->session->get('site_lang') == 'english') {
                        $this->session->setFlashdata('error', 'Invalid Username or password!');
                    } else {
                        $this->session->setFlashdata('error', "Nom d'utilisateur ou mot de passe invalide!");
                    }
                    return redirect()->to(base_url('admin'));
                }
            }
        }
        return redirect()->to(base_url('admin'));
    }

    public function logout()
    {
        $this->session->remove('admin_user');
        return redirect()->to(base_url('admin'));
    }

    public function Viewuser()
    {
        if (!$this->session->get('admin_user')) {
            return redirect()->to(base_url('admin'));
        }

        $users = $this->mdlUser->GetRecordUsers(['is_admin' => 0]);

        $data = [
            'success'      => $this->session->getFlashdata('success'),
            'error'        => $this->session->getFlashdata('error'),
            'main_content' => 'admin/user/viewuser',
            'users'        => $users
        ];

        return view('admin/front', $data);
    }

    public function viewprofile($id = null)
    {
        if (!$this->session->get('admin_user')) {
            return redirect()->to(base_url('admin'));
        }

        if (!empty($id)) {
            $users = $this->mdlUser->GetRecordUsers(['id' => $id]);
        } else {
            $users = $this->mdlUser->GetRecordUsers(['is_admin' => 0]);
        }

        $data = [
            'success'      => $this->session->getFlashdata('success'),
            'error'        => $this->session->getFlashdata('error'),
            'main_content' => 'admin/user/viewprofile',
            'users'        => $users
        ];

        return view('admin/front', $data);
    }

    public function Adduser()
    {
        if (!$this->session->get('admin_user')) {
            return redirect()->to(base_url('admin'));
        }

        $data = [
            'success'      => $this->session->getFlashdata('success'),
            'error'        => $this->session->getFlashdata('error'),
            'main_content' => 'admin/user/createprofile'
        ];

        return view('admin/front', $data);
    }

    public function createprofile()
    {
        if (!$this->session->get('admin_user')) {
            return redirect()->to(base_url('admin'));
        }

        $siteLang = $this->session->get('site_lang');

        if ($this->request->getMethod() === 'POST') {
            $this->validation->setRules([
                'firstname' => 'trim|required',
                'email'     => 'trim|required|valid_email|is_unique[users.email]',
                'password'  => 'trim|required|min_length[8]',
                'phone'     => 'trim|required',
                'country'   => 'trim|required',
                'city'      => 'trim|required',
                'address1'  => 'trim|required',
                'postcode'  => 'trim|required',
            ]);

            if (!$this->validation->withRequest($this->request)->run()) {
                $data = [
                    'success'      => $this->session->getFlashdata('success'),
                    'error'        => $this->session->getFlashdata('error'),
                    'main_content' => 'admin/user/createprofile',
                    'validation'   => $this->validation
                ];
                return view('admin/front', $data);
            }

            $insert = [
                'firstname'    => $this->request->getPost('firstname'),
                'lastname'     => $this->request->getPost('lastname'),
                'email'        => $this->request->getPost('email'),
                'phone'        => $this->request->getPost('phone'),
                'country'      => $this->request->getPost('country'),
                'city'         => $this->request->getPost('city'),
                'address1'     => $this->request->getPost('address1'),
                'address2'     => $this->request->getPost('address2'),
                'postcode'     => $this->request->getPost('postcode'),
                'password'     => md5($this->request->getPost('password')),
                'countrycode'  => $this->request->getPost('countrycode'),
                'created_date' => date('Y-m-d H:i:s'),
                'is_admin'     => 0,
            ];

            if ($this->mdlUser->insertUser($insert)) {
                $msg = ($siteLang === 'english') ? 'User Profile Successfully Created' : "Profil d'utilisateur créé avec succès";
                $this->session->setFlashdata('success', $msg);
            } else {
                $msg = ($siteLang === 'english') ? 'Error while creating profile!' : 'Erreur lors de la création du profil!';
                $this->session->setFlashdata('error', $msg);
            }

            return redirect()->to(base_url('admin/user/Viewuser'));
        }

        return redirect()->to(base_url('admin'));
    }

    public function editprofile($id = null)
    {
        if (!$this->session->get('admin_user')) {
            return redirect()->to(base_url('admin'));
        }

        if (!empty($id)) {
            $users = $this->mdlUser->GetRecordUsers(['id' => $id]);
        } else {
            $users = $this->mdlUser->GetRecordUsers(['is_admin' => 0]);
        }

        $data = [
            'success'      => $this->session->getFlashdata('success'),
            'error'        => $this->session->getFlashdata('error'),
            'main_content' => 'admin/user/editprofile',
            'users'        => $users
        ];

        return view('admin/front', $data);
    }

    public function updateprofile($id = null)
    {
        if (!$this->session->get('admin_user')) {
            return redirect()->to(base_url('admin'));
        }

        $siteLang = $this->session->get('site_lang');

        if (!empty($id) && $this->request->getMethod() === 'POST') {
            $this->validation->setRules([
                'firstname' => 'trim|required',
                'email'     => 'trim|required|valid_email',
                'phone'     => 'trim|required',
                'country'   => 'trim|required',
                'city'      => 'trim|required',
                'address1'  => 'trim|required',
                'postcode'  => 'trim|required',
            ]);

            if (!$this->validation->withRequest($this->request)->run()) {
                $users = $this->mdlUser->GetRecordUsers(['id' => $id]);
                $data = [
                    'success'      => $this->session->getFlashdata('success'),
                    'error'        => $this->session->getFlashdata('error'),
                    'main_content' => 'admin/user/editprofile',
                    'users'        => $users,
                    'validation'   => $this->validation
                ];
                return view('admin/front', $data);
            }

            $update = [
                'firstname'   => $this->request->getPost('firstname'),
                'lastname'    => $this->request->getPost('lastname'),
                'email'       => $this->request->getPost('email'),
                'phone'       => $this->request->getPost('phone'),
                'country'     => $this->request->getPost('country'),
                'city'        => $this->request->getPost('city'),
                'address1'    => $this->request->getPost('address1'),
                'address2'    => $this->request->getPost('address2'),
                'postcode'    => $this->request->getPost('postcode'),
                'countrycode' => $this->request->getPost('countrycode'),
            ];

            if ($this->mdlUser->updateUser($update, ['id' => $id])) {
                $msg = ($siteLang === 'english') ? 'User Profile Successfully Updated' : "Profil d'utilisateur mis à jour avec succès";
                $this->session->setFlashdata('success', $msg);
            } else {
                $msg = ($siteLang === 'english') ? 'Error while updating profile!' : 'Erreur lors de la mise à jour du profil!';
                $this->session->setFlashdata('error', $msg);
            }
        }

        return redirect()->to(base_url('admin/user/Viewuser'));
    }

    public function removeprofile($id = null)
    {
        if (!$this->session->get('admin_user')) {
            return redirect()->to(base_url('admin'));
        }

        $siteLang = $this->session->get('site_lang');

        if (!empty($id)) {
            if ($this->mdlUser->remove($id)) {
                $msg = ($siteLang === 'english') ? 'User Remove Profile Successfully' : 'Utilisateur Supprimer le profil avec succès';
                $this->session->setFlashdata('success', $msg);
            } else {
                $msg = ($siteLang === 'english') ? 'Error while deleting profile!' : 'Erreur lors de la suppression du profil!';
                $this->session->setFlashdata('error', $msg);
            }
        }

        return redirect()->to(base_url('admin/user/Viewuser'));
    }

    public function UploadImportFile()
    {
        if (!$this->session->get('admin_user')) {
            return redirect()->to(base_url('admin'));
        }

        $siteLang = $this->session->get('site_lang');
        $file = $this->request->getFile('userfile');

        if ($file && $file->isValid() && $file->getClientExtension() === 'csv') {
            $fp = fopen($file->getTempName(), 'r');
            $count = 0;
            $lastId = false;

            while ($csv_line = fgetcsv($fp, 1024)) {
                $count++;
                if ($count === 1) continue; // skip header row

                $data = [
                    'firstname'    => $csv_line[0] ?? 'NULL',
                    'lastname'     => $csv_line[1] ?? 'NULL',
                    'email'        => $csv_line[2] ?? '',
                    'password'     => isset($csv_line[3]) ? md5($csv_line[3]) : '',
                    'phone'        => $csv_line[4] ?? '',
                    'address1'     => $csv_line[5] ?? '',
                    'address2'     => $csv_line[6] ?? '',
                    'postcode'     => $csv_line[7] ?? '',
                    'city'         => $csv_line[8] ?? '',
                    'country'      => $csv_line[9] ?? '',
                    'created_date' => date('Y-m-d H:i:s'),
                ];

                $lastId = $this->mdlUser->insertUser($data);
            }

            fclose($fp);

            if ($lastId) {
                $msg = ($siteLang === 'english') ? 'User is successfully import file!' : "L'utilisateur est correctement importé!";
                $this->session->setFlashdata('success', $msg);
            } else {
                $msg = ($siteLang === 'english') ? 'Error while import file!' : "Erreur lors de l'importation du fichier!";
                $this->session->setFlashdata('error', $msg);
            }
        } else {
            $msg = ($siteLang === 'english') ? 'Please upload a CSV file!' : "S'il vous plaît télécharger le fichier csv!";
            $this->session->setFlashdata('error', $msg);
        }

        return redirect()->to(base_url('admin/user/Viewuser'));
    }
}
