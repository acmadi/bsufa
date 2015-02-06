<?
	defined('BASEPATH') or die('Access Denied');
	
	class purchasereq_call extends AdminPage{

		function purchasereq_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Purchase Requsition Online';
		}
		
		function index(){	
			$this->loadTemplate('procurement/purchase_req');
		}
	}	
