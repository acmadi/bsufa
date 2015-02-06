<?
//die ('test');
	defined('BASEPATH') or die('Access Denied');
	
	class jurnal_call extends AdminPage{

		function jurnal_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
			
		}
		
		function index(){	
			$this->loadTemplate('gl/jurnal_view');
		}
	}	
