<?
	defined('BASEPATH') or die('Access Denied');
	
	class tblkarycutiapp_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('hrd/tblkarycutiapp_view');
		}}		
