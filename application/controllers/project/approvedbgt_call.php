<?
	defined('BASEPATH') or die('Access Denied');
	
	class approvedbgt_call extends AdminPage{

		function approvedbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Approved Project Budget';
		}
		
		function index(){	
			$this->loadTemplate('project/approvedbgt_view');
		}
	}	
