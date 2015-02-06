<?
	defined('BASEPATH') or die('Access Denied');
	
	class tagihan_search_call extends AdminPage{

		function tagihan_search_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'Searching Tagihan';
		}
		
		function index(){	
			$this->loadTemplate('accounting/tagihan_search_view');
		}
	}	
