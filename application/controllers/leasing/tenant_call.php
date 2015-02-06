<?
	defined('BASEPATH') or die('Access Denied');
	
	class tenant_call extends AdminPage{

		function tenant_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('leasing/tenant_view');
		}
	}	
