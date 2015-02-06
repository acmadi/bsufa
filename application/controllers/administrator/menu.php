<?
	defined('BASEPATH') or die('Access Denied');
	
	class Menu extends AdminDatabase{

		function Menu(){
			parent::AdminDatabase('Menu_model');
			$this->pageCaption = 'Menu Front End';
			$this->caption = strtolower($this->pageCaption);
			$this->module_url = 'administrator/menu/';
			$this->template_folder = 'administrator/modules/menu/';
		}
		
		function index(){
			$this->parameters['alldata'] = $this->db_model->getHirearchy(1);			
			$this->_display();
		}
		
		function add(){
			$this->parameters['menuList'] = $this->db_model->getHirearchy(1);						
			parent::add();
		}
		
		function edit($id){
			$this->parameters['menuList'] = $this->db_model->getHirearchy(1);						
			parent::edit($id);
		}
	}
?>
