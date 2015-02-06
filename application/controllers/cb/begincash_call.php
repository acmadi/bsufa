<?
	defined('BASEPATH') or die('Access Denied');
	
	class begincash_call extends AdminPage{

		function begincash_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('cb/begincash_view');
		}
	}	
