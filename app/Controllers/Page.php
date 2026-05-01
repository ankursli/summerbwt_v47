<?php

namespace App\Controllers;

use App\Models\Mdl_Block;
use App\Models\Mdl_Menu;
use App\Models\Mdl_User;
use App\Models\Mdl_Proof;
use App\Models\Mdl_Draw;
use App\Models\Mdl_Store;
use App\Models\Mdl_Storerobot;
use App\Models\Mdl_Robot;
use App\Models\Mdl_Coupon;
use App\Models\Mdl_Refund;
use App\Models\Mdl_Clientsupport;
use App\Models\Mdl_Country;
use App\Models\Mdl_Settings;
use App\Models\Mdl_Template;
use CodeIgniter\Controller;

class Page extends BaseController
{
    protected $session;
    protected $mdlMenu;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->mdlMenu = new Mdl_Menu();

        $siteLang = $this->session->get('site_lang');
        if (empty($siteLang)) {
            $this->session->set('site_lang', 'french');
        }
    }

    // Helper to get logged-in user
    protected function getFrontUser()
    {
        return $this->session->get('front_user');
    }

    // Helper to render template
    protected function renderTemplate($data)
    {
        return view('front/template', $data);
    }

    public function index($pageParam = '')
    {
        if (empty($pageParam)) {
            // Check if the URI has the page name, e.g. /page/politique-cookies
            $uri = service('uri');
            $segmentCount = $uri->getTotalSegments();
            if ($segmentCount > 0) {
                $pageParam = $uri->getSegment($segmentCount);
            }
        }

        $sidemenu_without_login = $this->mdlMenu->GetRecordMenus(['menu_id' => 'sidebar_menu_without']);
        $sidemenu = $this->mdlMenu->GetRecordMenus(['menu_id' => 'sidebar_menu']);
        $footermenu = $this->mdlMenu->GetRecordMenus(['menu_id' => 'footer_menu']);

        $main_content = 'page/' . $pageParam;
        $filename = APPPATH . 'Views/page/' . $pageParam . '.php';

        $frontUser = $this->getFrontUser();

        if (file_exists($filename)) {
            $data = [
                'success' => $this->session->getFlashdata('success'),
                'error' => $this->session->getFlashdata('error'),
                'sidemenu' => !empty($frontUser) ? $sidemenu : $sidemenu_without_login,
                'footermenu' => $footermenu,
                'main_content' => $main_content
            ];
            return $this->renderTemplate($data);
        } else {
            // 404 Not Found fallback
            $data = [
                'success' => $this->session->getFlashdata('success'),
                'error' => $this->session->getFlashdata('error'),
                'sidemenu' => !empty($frontUser) ? $sidemenu : $sidemenu_without_login,
                'footermenu' => $footermenu,
                'main_content' => 'front/403' // usually a 403 or 404 page template
            ];
            return $this->renderTemplate($data);
        }
    }
}
