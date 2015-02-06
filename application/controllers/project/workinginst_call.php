<?
	defined('BASEPATH') or die('Access Denied');
	
	class workinginst_call extends AdminPage{

		function workinginst_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Approve Tender Evaluation';
		}
		
		function index(){	
			$this->loadTemplate('project/workinginst_view');
		}
	}	
