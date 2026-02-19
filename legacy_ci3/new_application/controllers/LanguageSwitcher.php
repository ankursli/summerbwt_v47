<?php 
if ( ! defined('BASEPATH')) exit('Direct access allowed');

class LanguageSwitcher extends CI_Controller
{
	public function __construct() {
       parent::__construct();
	   $this->load->helper('url');
	   $this->lang->load('information','french');
	   //$this->lang->load('form_validation','french');
	}

	public function switchLang($language = "") {
       $language = ($language != "") ? $language : "french";
       $this->session->set_userdata('site_lang', $language);
       redirect($_SERVER['HTTP_REFERER']);
	}

}