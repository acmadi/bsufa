<?
	defined('BASEPATH') or die('Access Denied');
	
	class contractlease_call extends AdminPage{

		function contractlease__call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('leasing/contractlease_view');
		}
	}	
