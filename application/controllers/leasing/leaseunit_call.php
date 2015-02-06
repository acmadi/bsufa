<?
	defined('BASEPATH') or die('Access Denied');
	
	class leaseunit_call extends AdminPage{

		function leaseunit_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('leasing/leaseunit_view');
		}
	}	
