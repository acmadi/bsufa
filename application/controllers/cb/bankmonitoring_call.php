<?
	defined('BASEPATH') or die('Access Denied');
	
	class bankmonitoring_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('cb/bankmonitoring_view');
		}}		
?>
