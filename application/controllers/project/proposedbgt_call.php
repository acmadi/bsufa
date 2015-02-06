<?
	defined('BASEPATH') or die('Access Denied');
	
	class proposedbgt_call extends AdminPage{

		function proposedbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Master Contractor';
		}
		
		function index(){	
			$this->loadTemplate('project/proposedbgt_view');
		}
	}	
