<?
	defined('BASEPATH') or die('Access Denied');
	
	class updateprojbgt_call extends AdminPage{

		function updateprojbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Original Budget Project';
		}
		
		function index(){	
			$this->loadTemplate('project/updateprojbgt_view');
		}
	}	
