<?
	defined('BASEPATH') or die('Access Denied');
	
	class Usermenu extends AdminDatabase{

		function Usermenu(){
			parent::AdminDatabase('UserMenu_model');
			$this->pageCaption = 'User Menu Manager';
			$this->caption = strtolower($this->pageCaption);
			$this->module_url = 'administrator/usermenu/';
			$this->template_folder = 'administrator/components/usermenu/';
			$this->load->model('UserMenu_model','usermenu');						
		}
		
		function index($usermenu=false){
			
			if(!$usermenu) redirect('administrator/setupmenu');
			$this->parameters['usermenu'] = $usermenu;
			
			$this->db->select("user_menu.*, modules.*,user_group.*",false);
			$this->db->join('modules','user_menu.module_id=modules.id_module',"left");
			$this->db->join('user_group','user_menu.group_id=user_group.id_group',"left");
			$this->db->order_by('module_index','asc');
			$this->db->where('group_id',$usermenu);
			$this->parameters['alldata'] = $this->db_model->getHirearchy();			
			$this->_display();
		}
		
		function add($usermenu){
			$this->load->model('UserGroup_model','usergroup');
			$this->parameters['UserGroup'] = $this->usergroup->getDropdown('id_group','group_name');
			$this->load->model('MenuAdmin_model','menu');
			$this->parameters['menuList'] = $this->menu->getHirearchy();
			$this->parameters['usermenu'] = $this->usermenu->get($usermenu);	
			$this->parameters['usermenuSelected'] = $usermenu;	
			$this->parameters['module_back'] = $this->module_url . 'index/' . $usermenu;	
			$this->module_url = uri_string();
			parent::add();
		}
		
		function edit($id){
			$this->load->model('UserGroup_model','usergroup');
			$this->parameters['UserGroup']	= $this->usergroup->getDropdown('id_group','group_name');
			$this->load->model('MenuAdmin_model','menu');
			$this->parameters['Menu']	= $this->menu->getDropdown('id_module','module_name');
			$this->db->select("user_menu.*, modules.*,user_group.*",false);
			$this->db->join('modules','user_menu.module_id=modules.id_module',"left");
			$this->db->join('user_group','user_menu.group_id=user_group.id_group',"left");
			$this->parameters['menuList'] = $this->db_model->getHirearchy();						
			parent::edit($id);
		}
	}
?>
