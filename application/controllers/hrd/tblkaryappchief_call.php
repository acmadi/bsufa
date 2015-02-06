<?
	defined('BASEPATH') or die('Access Denied');
	
	class tblkaryappchief_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('hrd/tblkaryappchief_view');
		}}		
