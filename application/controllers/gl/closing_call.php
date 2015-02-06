<?
	defined('BASEPATH') or die('Access Denied');
	
	class closing_call extends AdminPage{

		function closing_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('gl/closing_view');
			//$this->load->model('coa_model'); 
		}
	}	
