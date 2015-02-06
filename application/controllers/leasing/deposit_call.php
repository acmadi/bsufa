<?
	defined('BASEPATH') or die('Access Denied');
	
	class deposit_call extends AdminPage{

		function deposit_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('leasing/deposit_view');
		}}		
?>
