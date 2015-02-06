<?
	defined('BASEPATH') or die('Access Denied');
	
	class mrr_call extends AdminPage{

		function po_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Material Receipt';
		}
		
		function index(){	
			$this->loadTemplate('procurement/mrr_view');
		}
	}	
