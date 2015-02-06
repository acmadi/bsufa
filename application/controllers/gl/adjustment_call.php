<?
	defined('BASEPATH') or die('Access Denied');
	
	class adjustment_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('gl/adjustment_view');
		}}		
?>
