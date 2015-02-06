<?
	defined('BASEPATH') or die('Access Denied');
	
	class spk_call extends AdminPage{

		function spk_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Approve Tender Evaluation';
		}
		
		function index(){	
			$this->loadTemplate('project/spk_view');
		}
	}	
