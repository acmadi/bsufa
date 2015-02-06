<?
	defined('BASEPATH') or die('Access Denied');
	
	class mastervendorgmi_call extends AdminPage{

		function mastervendorgmi_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('accounting/mastervendorgmi_view');
		}
	}	
