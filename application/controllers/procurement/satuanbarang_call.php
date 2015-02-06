<?
	defined('BASEPATH') or die('Access Denied');
	
	class satuanbarang_call extends AdminPage{

		function mstbrg_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Master Satuan';
		}
		
		function index(){	
			$this->loadTemplate('procurement/satuanbarang_view');
		}
	}	
