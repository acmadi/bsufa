<?
	defined('BASEPATH') or die('Access Denied');
	
	class cataset_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('accounting/cataset_view');
		}
	}		
?>
