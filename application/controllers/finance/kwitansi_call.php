<?
	defined('BASEPATH') or die('Access Denied');
	
	class kwitansi_call extends AdminPage{

		function kwitansi_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('finance/kwitansi_view');
		}
	}	
