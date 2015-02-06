<?
	defined('BASEPATH') or die('Access Denied');
	
	class mstbrg_call extends AdminPage{

		function mstbrg_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Master Barang';
		}
		
		function index(){	
			$this->loadTemplate('procurement/mstbrg_view');
		}
	}	
