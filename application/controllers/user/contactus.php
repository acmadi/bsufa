<?
	defined('BASEPATH') or die('Access Denied');
	
	class ContactUs extends AdminDatabase{

		function ContactUs(){
			parent::AdminDatabase('ContactUs_model');
			$this->pageCaption = 'Contact Us';
			$this->caption = 'contact us';
			$this->module_url = 'administrator/contactus/';
			$this->template_folder = 'administrator/components/contactus/';
		}
		
		function index(){
			$this->_setPagging('?d=administrator&c=guestbook&m=index',$this->db_model->countRow());
			
			parent::index();
		}		
	}
?>
