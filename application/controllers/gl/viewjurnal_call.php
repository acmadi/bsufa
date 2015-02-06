<?
	defined('BASEPATH') or die('Access Denied');
	
	class viewjurnal_call extends AdminPage{

		function viewjurnal_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('gl/viewjurnal_view');
			//$this->load->model('coa_model'); 
		}
	}	
