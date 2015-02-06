<?
	defined('BASEPATH') or die('Access Denied');
	
	class Setupmenu extends AdminDatabase{

		function Setupmenu(){
			parent::AdminDatabase('Setupmenu_model');
			$this->pageCaption = 'Setup menu';
			$this->caption = 'setupmenu';
			$this->module_url = 'user/setupmenu/';
			$this->template_folder = 'user/components/setupmenu/';
			$this->load->model('UserMenu_model','menu');
									
		}
	}
?>
