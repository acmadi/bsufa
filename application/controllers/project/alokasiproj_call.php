<?
	defined('BASEPATH') or die('Access Denied');
	
	class alokasiproj_call extends AdminPage{

		function alokasiproj_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			
			
			
			$this->loadTemplate('project/alokasiproj_view');
							
			}
		
        
        }	
?>
