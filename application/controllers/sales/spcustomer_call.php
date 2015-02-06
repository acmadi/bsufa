<?
	defined('BASEPATH') or die('Access Denied');
	
	class spcustomer_call extends AdminPage{

		function customer_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('sales/spcustomer_view');
		}
	}	
