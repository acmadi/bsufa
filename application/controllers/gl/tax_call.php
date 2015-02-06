<?
	defined('BASEPATH') or die('Access Denied');
	
	class tax_call extends AdminPage{

		function tax_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('gl/tax_view');
			//$this->load->model('coa_model'); 
		}
	}	
