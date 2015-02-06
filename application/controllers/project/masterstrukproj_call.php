<?
	defined('BASEPATH') or die('Access Denied');
	
	class masterstrukproj_call extends AdminPage{

		function masterstrukproj_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Master Struktur Project';
		}
		
		function index(){	
			$this->loadTemplate('project/masterstrukproj_view');
		}
	}	
