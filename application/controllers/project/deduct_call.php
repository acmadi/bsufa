<?
	defined('BASEPATH') or die('Access Denied');
	
	class deduct_call extends AdminPage{

		function deduct_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Approve Tender Evaluation';
		}
		
		function index(){	
			$this->loadTemplate('project/deduct_view');
		}
	}	
