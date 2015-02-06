<?
	defined('BASEPATH') or die('Access Denied');
	
	class coa_call extends AdminPage{

		function coa_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('general_ledger/coa_view');
			//$this->load->model('coa_model'); 
		}
	}	