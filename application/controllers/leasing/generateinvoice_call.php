<?
	defined('BASEPATH') or die('Access Denied');
	
	class generateinvoice_call extends AdminPage{

		function generateinvoice_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('leasing/generateinvoice_view');
			//$this->load->model('coa_model'); 
		}
	}	
