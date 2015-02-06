<?
	defined('BASEPATH') or die('Access Denied');
	
	class customerprospek_call extends AdminPage{

		function customerprospek_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('marketing/customerprospek_view');
		}
	}	
