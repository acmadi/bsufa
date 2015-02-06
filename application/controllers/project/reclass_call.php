<?
	defined('BASEPATH') or die('Access Denied');
	
	class reclass_call extends AdminPage{

		function deduct_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'RECLASS BUSGET';
		}
		
		function index(){
		$this->loadTemplate('project/reclassbgt_view');
		}
	}	
