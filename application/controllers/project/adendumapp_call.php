<?
	defined('BASEPATH') or die('Access Denied');
	
	class adendumapp_call extends AdminPage{

		function adendumapp_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Approve Tender Evaluation';
		}
		
		function index(){	
			$this->loadTemplate('project/adendumapp_view');
		}
	}	
