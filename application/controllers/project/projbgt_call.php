<?
	defined('BASEPATH') or die('Access Denied');
	
	class projbgt_call extends AdminPage{

		function projbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Original Budget Project';
		}
		
		function index(){	
			$this->loadTemplate('project/projbgt_view');
		}
	}	
