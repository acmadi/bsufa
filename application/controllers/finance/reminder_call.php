<?
	defined('BASEPATH') or die('Access Denied');
	
	class reminder_call extends AdminPage{

		function reminder_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('finance/reminder_view');
			//$this->load->model('coa_model'); 
		}
	}	
