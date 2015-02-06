<?
	defined('BASEPATH') or die('Access Denied');
	
	class mastercontr_call extends AdminPage{

		functionmastercontr_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Master Contractor';
		}
		
		function index(){	
			$this->loadTemplate('project/mastercontr_view');
		}
	}	
