<?
	defined('BASEPATH') or die('Access Denied');
	
	class jurnaltransfer_call extends AdminPage{

		function jurnaltransfer_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('gl/jurnaltransfer_view');
			//$this->load->model('coa_model'); 
		}
	}	
