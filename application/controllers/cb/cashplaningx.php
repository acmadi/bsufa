<?
	defined('BASEPATH') or die('Access Denied');
	
	class cashplaningx extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('cb/cashplaningx_view');
		}}		
?>
