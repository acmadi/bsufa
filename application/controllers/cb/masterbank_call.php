<?
	defined('BASEPATH') or die('Access Denied');
	
	class masterbank_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('cb/masterbank_view');
		}}		
?>
