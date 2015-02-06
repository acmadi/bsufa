<?
	defined('BASEPATH') or die('Access Denied');
	
	class Useradmin extends AdminDatabase{

		function Useradmin(){
			parent::AdminDatabase('Useradmin_model');
			$this->pageCaption = 'Add User';
			$this->caption = 'useradmin';
			$this->module_url = 'user/useradmin/';
			$this->template_folder = 'user/components/useradmin/';
			$this->load->model('Setupmenu_model','setup');	
									
		}
		
		function index($setup=false){			
			$this->_setPagging('?d=administrator&c=useradmin&m=index',$this->db_model->countRow());			
			$this->db->select('user_admin.id_user,user_group.group_name,user_admin.group_id,user_admin.username,user_admin.password,user_admin.status');
			$this->db->join('user_group','user_group.id_group = user_admin.group_id','left');		
			parent::index();
		}
		
		function add($setup=false){
			$this->parameters['UserGroup'] = $this->setup->getDropdown('id_group','group_name');
			$this->parameters['usermenuSelected'] = $setup;	
			
			if($this->input->post('submit')){
			  if($this->db_model->isValid() && $this->db_model->checkUsername()){
			    if($this->db_model->save()){
				  redirect($this->module_url);
				}else setError('Insert '.$this->caption.' failed');
			  }			  
			}
			$this->_display('form');
		}
		
		function edit($id){
			$this->parameters['UserGroup'] = $this->setup->getDropdown('id_group','group_name');
			$this->parameters['data'] = $this->db_model->get($id);
			if(!$this->parameters['data'])
			 die('News not found');
			 
			if($this->input->post('submit')){
			  if(!$this->input->post('password') && !$this->input->post('passconf')){
			    array_push($this->db_model->ignoreFields,'password');
			  }
			  if($this->db_model->isValid() && $this->db_model->checkUsername($this->parameters['data']->username)){
			    if($this->db_model->save($id)){
				  redirect($this->module_url);
				}else setError('Update '.$this->caption.' failed');
			  }			  
			}
			
			$this->_display('form');
		}
	}
?>
