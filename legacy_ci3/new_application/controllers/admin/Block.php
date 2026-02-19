<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Block extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('Mdl_Block');
        $this->load->model('Mdl_User');
        $this->load->model('Mdl_Country');
        $this->load->helper(array('form','url','language'));
        $this->load->library(array('session', 'form_validation', 'email'));
		$siteLang = $this->session->userdata('site_lang');
		if (empty($siteLang)) {
			$this->session->set_userdata('site_lang','french');
		}
		
		/*$ip=$_SERVER['REMOTE_ADDR'];
		$details = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=$ip"));
		$country=$details->geoplugin_countryCode;
		$countries=$this->Mdl_Country->GetFrontRecord(array('is_allow'=>1));
		$array = array();
		foreach($countries as $co){
			$array[] = $co['country_code'];
		}
		if (in_array($country, $array)){
			//echo 'allowed';
		}else{
			$this->load->view('front/403');die;
		}
		/*if($country==="FR" || $country==="IN"){
			//echo 'allowed';
		}else{
			$this->load->view('front/403');die;
		}*/
    }
	
	
	
	
	public function Addblock()
	{
		if(!empty($_SESSION['admin_user'])){
			$siteLang = $this->session->userdata('site_lang');
			$block=$this->Mdl_Block->GetRecordBlocks(array('language'=>$siteLang));
			$masterblocks = array('block-1', 'block-2', 'block-3');
			$usedblocks = array();
			foreach($block as $bloc){
				$usedblocks[] = $bloc['block'];
			}
			$result=array_diff($masterblocks, $usedblocks);
			$data=array('success'=>$this->session->flashdata('success'),
					'error'=>$this->session->flashdata('error'),
					'main_content'=>'admin/block/createblock',
					'blocks' => $result
					);
			$this->load->view('admin/front',$data);
		}else{
			redirect('admin');
		}
	}
	
	public function createblock()
	{
		$siteLang = $this->session->userdata('site_lang');
		if(!empty($_SESSION['admin_user'])){
			$ispost=$this->input->method(TRUE);
			if($ispost=='POST'){
				$this->load->helper('form');
				$this->load->library('form_validation');
				// set validation rules
				$this->form_validation->set_rules('fr_title', "Title", 'required');
				$this->form_validation->set_rules('fr_date', "Date", 'required');
				$this->form_validation->set_rules('fr_middle_content', "Middle_content", 'required');
				$this->form_validation->set_rules('fr_bottom_content', "Bottom_content", 'required');

				$this->form_validation->set_rules('en_title', "Title", 'required');
				$this->form_validation->set_rules('en_date', "Date", 'required');
				$this->form_validation->set_rules('en_middle_content', "Middle_content", 'required');
				$this->form_validation->set_rules('en_bottom_content', "Bottom_content", 'required');
				
				
				if($this->form_validation->run() === FALSE){
					$data=array('success'=>$this->session->flashdata('success'),
							'error'=>$this->session->set_flashdata('error','please fill all details' ),
							'main_content'=>'admin/block/createblock'
							);
					$this->load->view('admin/front',$data);
				}else{

					$frinsert = array(
						'title'=>$this->input->post('fr_title'),
						'date'=>$this->input->post('fr_date'),
						'middle_content'=>$this->input->post('fr_middle_content'),
						'bottom_content'=>$this->input->post('fr_bottom_content'),
						'bg_color'=>$this->input->post('bg_color'),
						'opacity'=>$this->input->post('opacity'),
						'link'=>$this->input->post('link'),
						'status'=>$this->input->post('status'),
						'block'=>$this->input->post('block'),
						'language'=> 'french',
						'date_created'=>date('Y-m-d H:i:s')
					);

					$eninsert = array(
						'title'=>$this->input->post('en_title'),
						'date'=>$this->input->post('en_date'),
						'middle_content'=>$this->input->post('en_middle_content'),
						'bottom_content'=>$this->input->post('en_bottom_content'),
						'bg_color'=>$this->input->post('bg_color'),
						'opacity'=>$this->input->post('opacity'),
						'link'=>$this->input->post('link'),
						'status'=>$this->input->post('status'),
						'block'=>$this->input->post('block'),
						'language'=> 'english',
						'date_created'=>date('Y-m-d H:i:s')
					);

					$errorflg = 0;
					$frblock = $this->Mdl_Block->insert($frinsert);
					$enblock = $this->Mdl_Block->insert($eninsert);
					if(!$frblock){
						$errorflg = 1;
					}
					if(!$enblock){
						$errorflg = 1;
					}
					

					if($errorflg == 0){
						$blockconnection = array('french_id'=>$frblock,'english_id' => $enblock);
						$this->Mdl_Block->insertconnection($blockconnection);
						if($siteLang=='fr'){
							$this->session->set_flashdata('success','Block Successfully Created' ); 
						}else{
							$this->session->set_flashdata('success',"Block Successfully Created" ); 
						}
						redirect('admin/block/Viewblock');
					}else{
						$this->Mdl_Block->deletefrblock($frblock);
						$this->Mdl_Block->deleteenblock($enblock);
						if($siteLang=='english'){
							$this->session->set_flashdata('error','Error while creating block!' );
						}else{
							$this->session->set_flashdata('error','Error while creating block!' );
						}
						redirect('admin/block/Viewblock');
					}
				}
			}
		}else{
			redirect('admin');
		}
	}
	
	public function Viewblock()
	{
		$siteLang = $this->session->userdata('site_lang');
		if(!empty($_SESSION['admin_user'])){
			$block=$this->Mdl_Block->GetRecordBlocks(array('language'=>$siteLang));
			$blolckcount = count($block);
			$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/block/viewblock',
						'block'=>$block,
						'blockcount' => $blolckcount
						);
			$this->load->view('admin/block',$data);
		}else{
			redirect('admin');
		}
	}
	
	
	
	public function editblock($id=null)
	{
		if(!empty($_SESSION['admin_user'])){
			if(!empty($id)){
				$siteLang = $this->session->userdata('site_lang');
				$blockconnection=$this->Mdl_Block->getblockconnection($id,$siteLang);
				$frblock=$this->Mdl_Block->GetRecordBlocks(array('id'=>$blockconnection['frid']));
				$enblock=$this->Mdl_Block->GetRecordBlocks(array('id'=>$blockconnection['enid']));
				$block=$this->Mdl_Block->GetRecordBlocks(array('id'=>$id));
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/block/editblock',
						'block'=>$block,
						'frblock'=>$frblock,
						'enblock'=>$enblock
						);
				$this->load->view('admin/front',$data);
			}else{
				$block=$this->Mdl_Block->GetRecordBlocks();
				$data=array('success'=>$this->session->flashdata('success'),
						'error'=>$this->session->flashdata('error'),
						'main_content'=>'admin/block/viewblock',
						'block'=>$block
						);
				$this->load->view('admin/front',$data);
			}
		}else{
			redirect('admin');
		}
	}
	
	public function updateblock($id=null)
	{
		$siteLang = $this->session->userdata('site_lang');
		if(!empty($_SESSION['admin_user'])){
			if(!empty($id)){
				$ispost=$this->input->method(TRUE);
				if($ispost=='POST'){
					$this->load->helper('form');
					$this->load->library('form_validation');
					// set validation rules
					$this->form_validation->set_rules('fr_title', "Title", 'required');
					$this->form_validation->set_rules('fr_date', "Date", 'required');
					$this->form_validation->set_rules('fr_middle_content', "Middle_content", 'required');
					$this->form_validation->set_rules('fr_bottom_content', "Bottom_content", 'required');

					$this->form_validation->set_rules('en_title', "Title", 'required');
					$this->form_validation->set_rules('en_date', "Date", 'required');
					$this->form_validation->set_rules('en_middle_content', "Middle_content", 'required');
					$this->form_validation->set_rules('en_bottom_content', "Bottom_content", 'required');
				
					if($this->form_validation->run() === FALSE){
						$block=$this->Mdl_Block->GetRecordBlocks(array('id'=>$id));
						$data=array('success'=>$this->session->flashdata('success'),
								'error'=>$this->session->flashdata('error'),
								'main_content'=>'admin/block/editblock',
								'block'=>$block
								);
						$this->load->view('admin/front',$data);
					}else{
						$frinsert = array(
							'title'=>$this->input->post('fr_title'),
							'date'=>$this->input->post('fr_date'),
							'middle_content'=>$this->input->post('fr_middle_content'),
							'bottom_content'=>$this->input->post('fr_bottom_content'),
							'bg_color'=>$this->input->post('bg_color'),
							'opacity'=>$this->input->post('opacity'),
							'link'=>$this->input->post('link'),
							'status'=>$this->input->post('status'),
							'block'=>$this->input->post('block'),
							'language'=> 'french',
							'date_created'=>date('Y-m-d H:i:s')
						);
	
						$eninsert = array(
							'title'=>$this->input->post('en_title'),
							'date'=>$this->input->post('en_date'),
							'middle_content'=>$this->input->post('en_middle_content'),
							'bottom_content'=>$this->input->post('en_bottom_content'),
							'bg_color'=>$this->input->post('bg_color'),
							'opacity'=>$this->input->post('opacity'),
							'link'=>$this->input->post('link'),
							'status'=>$this->input->post('status'),
							'block'=>$this->input->post('block'),
							'language'=> 'english',
							'date_created'=>date('Y-m-d H:i:s')
						);

						$blockconnection=$this->Mdl_Block->getblockconnection($id,$siteLang);
						$errorflg = 0;
						$frblock = $this->Mdl_Block->update($frinsert,array("id"=>$blockconnection['frid']));
						$enblock = $this->Mdl_Block->update($eninsert,array("id"=>$blockconnection['enid']));
						if(!$frblock){
							$errorflg = 1;
						}
						if(!$enblock){
							$errorflg = 1;
						}
						if($errorflg == 0){
							if($siteLang=='fr'){
								$this->session->set_flashdata('success','Block Successfully updated' ); 
							}else{
								$this->session->set_flashdata('success',"Block Successfully updated" ); 
							}
							redirect('admin/block/Viewblock');
						}else{
							if($siteLang=='english'){
								$this->session->set_flashdata('error','Error while updating block!' );
							}else{
								$this->session->set_flashdata('error','Error while updating block!' );
							}
							redirect('admin/block/Viewblock');
						}
					}
				}
			}
		}else{
			redirect('admin');
		}
	}
	
	public function removeblock($id=null)
	{
		$siteLang = $this->session->userdata('site_lang');
		

		if(!empty($_SESSION['admin_user'])){
			$ispost=$this->input->method(TRUE);
			if($ispost == 'GET')
			{
				$Deleteblock=$this->Mdl_Block->deleteconnection($id,$siteLang);
				if(empty($Deleteblock))
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('error','Error while deleting block!');
					}else{
						$this->session->set_flashdata('error','Error while deleting block!');
					}
					redirect('admin/block/Viewblock');
				}
				else
				{
					if($siteLang=='english'){
						$this->session->set_flashdata('success','block Remove Successfully');
					}else{
						$this->session->set_flashdata('success','block Remove Successfully');
					}
					redirect('admin/block/Viewblock');
				}
			}
			else
			{
				if($siteLang=='english'){
					$this->session->set_flashdata('error','Error while deleting block!');
				}else{
					$this->session->set_flashdata('error','Error while deleting block!');
				}
				redirect('admin/block/Viewblock');
			}
		}else{
			redirect('admin');
		}
	}
	
	
}
