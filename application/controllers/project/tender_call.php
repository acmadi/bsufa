<?
	defined('BASEPATH') or die('Access Denied');
	
	class tender_call extends AdminPage{

		function tender_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Tender Evaluation';
		}
		
		function index(){	
			$this->loadTemplate('project/tender_view');
		}
	}	
