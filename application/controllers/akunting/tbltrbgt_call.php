<?
	defined('BASEPATH') or die('Access Denied');
	
	class tbltrbgt_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('mis/tbltrbgt_view');
		}}		
?>
