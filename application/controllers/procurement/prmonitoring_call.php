<?
	defined('BASEPATH') or die('Access Denied');
	
	class prmonitoring_call extends AdminPage{

		function prmonitoring_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'PR Monitoring';
		}
		
		function index(){	
			$this->loadTemplate('procurement/prmonitoring_view');
		}
	}	
