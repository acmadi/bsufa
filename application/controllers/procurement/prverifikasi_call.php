<?
	defined('BASEPATH') or die('Access Denied');
	
	class prverifikasi_call extends AdminPage{

		function prverifikasi_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Purchase Verification';
		}
		
		function index(){	
			$this->loadTemplate('procurement/prverifikasi');
		}
	}	
