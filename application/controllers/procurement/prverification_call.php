<?
	defined('BASEPATH') or die('Access Denied');
	
	class prverification_call extends AdminPage{

		function prverification_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Approve Tender Evaluation';
		}
		
		function index(){	
			$this->loadTemplate('procurement/prverification_view');
		}
	}	
