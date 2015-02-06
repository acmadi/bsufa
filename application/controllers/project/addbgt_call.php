<?
	defined('BASEPATH') or die('Access Denied');
	
	class addbgt_call extends AdminPage{

		function deduct_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'ADD BUSGET';
		}
		
		function index(){	
			$this->loadTemplate('project/addbgt_view');
		}
	}	
