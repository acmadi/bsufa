<?
	defined('BASEPATH') or die('Access Denied');
	
	class cekgantung_call extends AdminPage{

		function cekgantung_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->loadTemplate('cb/cekgantung_view');
		}
	}		
?>
