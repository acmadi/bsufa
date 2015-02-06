<?
	defined('BASEPATH') or die('Access Denied');
	
	class purchase_req_call extends AdminPage{

		function purchase_req_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Approve Tender Evaluation';
		}
		
		function index(){	
			$this->loadTemplate('procurement/purchase_req_view');
		}
	}	
