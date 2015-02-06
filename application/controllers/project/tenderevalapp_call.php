<?
	defined('BASEPATH') or die('Access Denied');
	
	class tenderevalapp_call extends AdminPage{

		function tendereval_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Approve Tender Evaluation';
		}
		
		function index(){	
			$this->loadTemplate('project/tenderevalapp_view');
		}
	}	
