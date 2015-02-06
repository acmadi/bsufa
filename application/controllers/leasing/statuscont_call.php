<?
	defined('BASEPATH') or die('Access Denied');
	
	class statuscont_call extends AdminPage{

		function statuscont_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('leasing/statuscont_view');
		}
	}	

