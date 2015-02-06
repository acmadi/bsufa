<?
	defined('BASEPATH') or die('Access Denied');
	
	class appayment_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('account_payable/appayment_view');
		}}		
?>
