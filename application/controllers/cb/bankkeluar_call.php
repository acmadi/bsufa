<?
	defined('BASEPATH') or die('Access Denied');
	
	class bankkeluar_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('cb/bankkeluar_view');
		}}		
?>
