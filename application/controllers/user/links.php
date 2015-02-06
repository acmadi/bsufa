<?
	defined('BASEPATH') or die('Access Denied');
	
	class Links extends AdminDatabase{

		function Links(){
			parent::AdminDatabase('Links_model');
			$this->pageCaption = 'Link Terkait';
			$this->caption = 'links';
			$this->module_url = 'user/links/';
			$this->template_folder = 'user/modules/links/';
									
		}
		function index(){
			$this->_setPagging('?d=administrator&c=links&m=index',$this->db_model->countRow());			
			parent::index();
		}
	}
?>
