<?
	defined('BASEPATH') or die('Access Denied');
	
	class apdebitnote_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('ap/apdebitnote_view');
		}}		
?>
