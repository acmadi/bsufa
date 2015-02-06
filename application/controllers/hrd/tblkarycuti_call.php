<?
	defined('BASEPATH') or die('Access Denied');
	
	class tblkarycuti_call extends AdminPage{

		function tblkarycuti_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('hrd/tblkarycuti_view');
		}}		
?>
