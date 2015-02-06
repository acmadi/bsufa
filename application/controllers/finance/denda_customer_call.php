<?
	defined('BASEPATH') or die('Access Denied');
	
	class denda_customer_call extends AdminPage{

		function denda_customer_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('finance/denda_customer_view');
		}
	}	
