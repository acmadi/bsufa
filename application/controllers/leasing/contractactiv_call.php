<?
	defined('BASEPATH') or die('Access Denied');
	
	class contractactiv_call extends AdminPage{

		function contractactiv__call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('leasing/contractactiv_view');
		}
	}	
