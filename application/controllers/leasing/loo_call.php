<?
	defined('BASEPATH') or die('Access Denied');
	
	class loo_call extends AdminPage{

		function loo_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('leasing/loo_view');
		}
	}	
