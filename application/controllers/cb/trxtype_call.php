<?
	defined('BASEPATH') or die('Access Denied');
	
	class trxtype_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('cb/trxtype_view');
		}}		
?>
