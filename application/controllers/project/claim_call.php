<?
	defined('BASEPATH') or die('Access Denied');
	
	class claim_call extends AdminPage{

		function claim_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Historical Claim';
		}
		
		function index(){	
			$this->loadTemplate('project/claim_view');
		}
	}	
