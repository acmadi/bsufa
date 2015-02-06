<?
	defined('BASEPATH') or die('Access Denied');
	
	class dailycash_call extends AdminPage{

		function dailycash_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('cb/dailycash_view');
		}
	}	
