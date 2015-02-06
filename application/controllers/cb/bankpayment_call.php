<?
	defined('BASEPATH') or die('Access Denied');
	
	class bankpayment_call extends AdminPage{

		function bankpayment_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('cb/bankpayment_view');
		}}		
?>
