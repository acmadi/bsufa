<?
	defined('BASEPATH') or die('Access Denied');
	
	class term_call extends AdminPage{

		function term_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('ap/term_view');
			//$this->load->model('coa_model'); 
		}
	}	
