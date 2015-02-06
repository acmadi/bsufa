<?
	defined('BASEPATH') or die('Access Denied');
	
	class mstbgtproj_call extends AdminPage{

		function masterstrukproj_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Original Budget Project';
		}
		
		function index(){	
			$this->loadTemplate('project/masterstrukproj_view');
		}
	}	
