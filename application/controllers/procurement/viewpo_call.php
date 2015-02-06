<?
	defined('BASEPATH') or die('Access Denied');
	
	class viewpo_call extends AdminPage{

		function viewpo_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Purchase Order';
		}
		
		function index(){	
			$this->loadTemplate('procurement/viewpo_view');
		}
	}	
