<?
	defined('BASEPATH') or die('Access Denied');
	
	class tendereval_call extends AdminPage{

		function tendereval_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Tender Evaluation';
		}
		
		function index(){	
			$this->loadTemplate('project/tendereval_view');
		}
	}	
