<?
	defined('BASEPATH') or die('Access Denied');
	
	class customer_call extends AdminPage{

		function customer_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('marketing/customer_view');
		}
	}	
