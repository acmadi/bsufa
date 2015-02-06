<?
	defined('BASEPATH') or die('Access Denied');
	
	class payplan_call extends AdminPage{

		function payplan__call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('leasing/payplan_view');
		}
	}	
