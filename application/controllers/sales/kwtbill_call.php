<?
	defined('BASEPATH') or die('Access Denied');
	
	class kwtbill_call extends AdminPage{

		function kwtbill_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('sales/kwtbill_view');
		}
	}	
