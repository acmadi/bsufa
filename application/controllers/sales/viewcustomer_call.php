<?
	defined('BASEPATH') or die('Access Denied');
	
	class viewcustomer_call extends AdminPage{

		function customer_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('sales/viewcustomer_view');
		}
	}	
