<?
	defined('BASEPATH') or die('Access Denied');
	
	class schedulebilling_call extends AdminPage{

		function schedulebilling_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('leasing/schedulebilling_view');
			//$this->load->model('coa_model'); 
		}
	}	
