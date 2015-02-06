<?
	defined('BASEPATH') or die('Access Denied');
	
	class apcreditnote_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('ap/apcreditnote_view');
		}}		
?>
