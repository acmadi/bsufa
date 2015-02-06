<?
	defined('BASEPATH') or die('Access Denied');
	
	class currency_call extends AdminPage{

		function currency_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('gl/currency_view');
		}
	}	
