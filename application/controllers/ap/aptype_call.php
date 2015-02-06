<?
	defined('BASEPATH') or die('Access Denied');
	
	class aptype_call extends AdminPage{

		function aptype_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('AP/aptype_view');
			//$this->load->model('coa_model'); 
		}
	}	
