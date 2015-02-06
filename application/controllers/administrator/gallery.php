<?
defined('BASEPATH') or die('Access Denied');

	class Gallery extends AdminDatabase{
		var $paggingURL = '?d=administrator&c=gallery&m=index';
		
		function Gallery(){
			parent::AdminDatabase('Gallery_model');
			$this->pageCaption = 'Gallery';
			$this->caption = 'gallery';
			$this->module_url = 'administrator/gallery/';
			$this->template_folder = 'administrator/components/gallery/';
		}
		
		function index(){
			$this->_setPagging('?d=administrator&c=gallery&m=index',$this->db_model->countRow());
			parent::index();
		}	
	}	
?>
