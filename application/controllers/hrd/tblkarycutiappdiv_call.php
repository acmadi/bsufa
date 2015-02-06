<?
	defined('BASEPATH') or die('Access Denied');
	
	class tblkarycutiappdiv_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('hrd/tblkarycutiappdiv_view');
		}}		
