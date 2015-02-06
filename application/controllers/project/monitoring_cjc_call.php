<?
	defined('BASEPATH') or die('Access Denied');
	
	class monitoring_cjc_call extends AdminPage{

		function workinginst_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Approve Tender Evaluation';
		}
		
		function index(){	
			$this->loadTemplate('project/monitoring_cjc_view');
		}
	}	
