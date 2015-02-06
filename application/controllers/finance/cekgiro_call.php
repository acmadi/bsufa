<?
	defined('BASEPATH') or die('Access Denied');
	
	class cekgiro_call extends AdminPage{

		function cekgiro_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('finance/cekgiro_view');
		}
	}	

