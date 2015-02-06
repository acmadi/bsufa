<?
	defined('BASEPATH') or die('Access Denied');
	
	class useraccess_call extends AdminPage{

		function useraccess_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('user/useraccess_view');
		}
	}	
