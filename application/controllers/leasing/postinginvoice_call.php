<?
	defined('BASEPATH') or die('Access Denied');
	
	class postinginvoice_call extends AdminPage{

		function postinginvoice_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('leasing/postinginvoice_view');
			//$this->load->model('coa_model'); 
		}
	}	
