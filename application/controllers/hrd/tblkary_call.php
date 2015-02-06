<?
	defined('BASEPATH') or die('Access Denied');
	
	class tblkary_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('hrd/tblkary_view');
		}}		
?>
