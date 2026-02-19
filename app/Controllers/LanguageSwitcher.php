<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class LanguageSwitcher extends BaseController
{
    public function index()
    {
    }

    public function switchLang($language = "")
    {
        $session = \Config\Services::session();
        
        $language = ($language != "") ? $language : "french";
        $session->set('site_lang', $language);
        
        $locale = ($language == 'french') ? 'fr' : 'en';
        service('request')->setLocale($locale);
        
        return redirect()->to(base_url());
    }
}
