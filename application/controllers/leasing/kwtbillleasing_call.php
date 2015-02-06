<?
	defined('BASEPATH') or die('Access Denied');
	
	class kwtbillleasing_call extends AdminPage{

		function kwtbillleasing_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('leasing/kwtbillleasing_view');
		}
	}	
