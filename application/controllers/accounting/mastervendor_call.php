<?
	defined('BASEPATH') or die('Access Denied');
	
	class mastervendor_call extends AdminPage{

		function mastervendor_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('accounting/mastervendor_view');
		}
	}	
