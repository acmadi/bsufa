<?
	defined('BASEPATH') or die('Access Denied');
	
	class cashplaning_call extends AdminPage{

		function cashplaning_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('cb/cashplaning_view');
			//$this->load->model('coa_model'); 
		}
	}	
