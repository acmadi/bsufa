<?
	defined('BASEPATH') or die('Access Denied');
	
	class komisi_call extends AdminPage{

		function komisi_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('sales/komisi_view');
			//$this->load->model('coa_model'); 
		}
	}	
