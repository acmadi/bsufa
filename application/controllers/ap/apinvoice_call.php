<?
	defined('BASEPATH') or die('Access Denied');
	
	class apinvoice_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('ap/apinvoice_view');
		}}		
?>
