<?
	defined('BASEPATH') or die('Access Denied');
	
	class mcekgiro_call extends AdminPage{

		function mcekgiro_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('finance/mcekgiro_view');
		}
	}	

