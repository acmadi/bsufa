<?
	defined('BASEPATH') or die('Access Denied');
	
	class unidentified_call extends AdminPage{

		function unidentified_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('sales/unidentified_view');
		}
	}	
