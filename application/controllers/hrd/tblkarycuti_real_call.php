<?
	defined('BASEPATH') or die('Access Denied');
	
	class tblkarycuti_real_call extends AdminPage{

		function tblkarycuti_real_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('hrd/tblkarycuti_real_view');
		}}		
?>
