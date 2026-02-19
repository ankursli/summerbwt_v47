<?php																																										

class LanguageLoader
{
	function initialize() {
		$ci =& get_instance();
		$ci->load->helper('language');
		$siteLang = $ci->session->userdata('site_lang');
        if ($siteLang) {
           $ci->lang->load('information',$siteLang);
        } else {
		   $ci->session->set_userdata('site_lang','french');
           $ci->lang->load('information','french');
        }
	}
}