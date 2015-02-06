<?
	defined('BASEPATH') or die('Access Denied');
	
	class pengalihancustomer_call extends AdminPage{

		function pengalihancustomer_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('marketing/pengalihan_view');
		}
	}	
