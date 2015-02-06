<?
	defined('BASEPATH') or die('Access Denied');
	
	class frontoffice_call extends AdminPage{

		function customerservice_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('marketing/frontoffice_view');
		}
	}	
