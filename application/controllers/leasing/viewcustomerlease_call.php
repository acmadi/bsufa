<?
	defined('BASEPATH') or die('Access Denied');
	
	class viewcustomerlease_call extends AdminPage{

		function viewcustomerlease_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('leasing/viewcustomerlease_view');
		}
	}	
