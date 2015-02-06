<?
	defined('BASEPATH') or die('Access Denied');
	
	class locaset_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('accounting/locaset_view');
		}}		
?>
