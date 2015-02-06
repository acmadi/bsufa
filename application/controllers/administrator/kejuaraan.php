<?
defined('BASEPATH') or die('Access Denied');

	class Kejuaraan extends AdminDatabase{
		var $paggingURL = '?d=administrator&c=kejuaraan&m=index';
		
		function Kejuaraan(){
			parent::AdminDatabase('Kejuaraan_model');
			$this->pageCaption = 'Kejuaraan';
			$this->caption = 'kejuaraan';
			$this->module_url = 'administrator/kejuaraan/';
			$this->template_folder = 'administrator/components/kejuaraan/';
		}
		
		function index(){
			$this->_setPagging('?d=administrator&c=kejuaraan&m=index',$this->db_model->countRow());
			parent::index();
		}	
	}	
?>
