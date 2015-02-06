<?
	defined('BASEPATH') or die('Access Denied');
	
	class viewmrr_call extends AdminPage{

		function viewmrr_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Purchase Order';
		}
		
		function index(){	
			$this->loadTemplate('procurement/viewmrr_view');
		}
	}	
