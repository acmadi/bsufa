<?
	defined('BASEPATH') or die('Access Denied');
	
	class customerservice_call extends AdminPage{

		function customerservice_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('marketing/customerservice_view');
		}
	}	
