<?
	defined('BASEPATH') or die('Access Denied');
	
	class historyjurnal_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('accounting/historyjurnal_view');
		}
	}		
?>
