<?
	defined('BASEPATH') or die('Access Denied');
	
	class masterproj_call extends AdminPage{

		function kwtbill_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Master Project';
		}
		
		function index(){	
			$this->loadTemplate('project/masterproj_view');
		}
	}	
