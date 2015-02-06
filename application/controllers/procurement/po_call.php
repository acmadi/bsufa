<?
	defined('BASEPATH') or die('Access Denied');
	
	class po_call extends AdminPage{

		function po_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Purchase Order';
		}
		
		function index(){	
			$this->loadTemplate('procurement/po_view');
		}
	}	
