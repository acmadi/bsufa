<?
	defined('BASEPATH') or die('Access Denied');
	
	class pettycash_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('cb/pettycash_view');
		}}		
?>
