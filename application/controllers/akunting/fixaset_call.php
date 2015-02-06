<?
	defined('BASEPATH') or die('Access Denied');
	
	class fixaset_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('accounting/fixaset_view');
		}}		
?>
