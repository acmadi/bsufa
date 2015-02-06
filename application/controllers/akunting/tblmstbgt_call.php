<?
	defined('BASEPATH') or die('Access Denied');
	
	class tblmstbgt_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('mis/tblmstbgt_view');
		}}		
?>
