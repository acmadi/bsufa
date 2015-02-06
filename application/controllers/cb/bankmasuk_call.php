<?
	defined('BASEPATH') or die('Access Denied');
	
	class bankmasuk_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('cb/bankmasuk_view');
		}}		
?>
