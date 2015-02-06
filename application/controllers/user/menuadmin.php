<?
	defined('BASEPATH') or die('Access Denied');
	
	class MenuAdmin extends AdminDatabase{

		function MenuAdmin(){
			parent::AdminDatabase('MenuAdmin_model');
			$this->pageCaption = 'Menu Admin Manager';
			$this->caption = strtolower($this->pageCaption);
			$this->module_url = 'user/menuadmin/';
			$this->template_folder = 'user/components/menuadmin/';
		}
		
		function index(){
			$this->parameters['alldata'] = $this->db_model->getHirearchy();			
			$this->_display();
		}
		
		function add(){
			$this->parameters['menuList'] = $this->db_model->getHirearchy();						
			parent::add();
		}
		
		function edit($id){
			$this->parameters['menuList'] = $this->db_model->getHirearchy();						
			parent::edit($id);
		}
	}
?>
