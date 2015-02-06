<?
	defined('BASEPATH') or die('Access Denied');
	
	class bankkeluarx extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('cb/bankkeluarx_view');
		}}		
?>
