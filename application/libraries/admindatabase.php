<?
	defined('BASEPATH') or die('Access Denied');
	
	class AdminDatabase extends AdminPage{
		var $caption;
		var $module_url;
		var $template_folder;
		
		function AdminDatabase($model_name){
			parent::AdminPage();
			$this->load->model($model_name,'db_model');		
		}
		
		function _display($action='default'){
			$this->parameters['action'] = $action;
			$this->parameters['labels'] = $this->db_model->getLabels();
			$this->parameters['module_url'] = $this->module_url;
			$this->loadTemplate($this->template_folder.$action);
		}
		
		function index(){
			$this->parameters['alldata'] = $this->db_model->get();
			$this->db->last_query();
			$this->_display();
		}
		
		function add(){
			if($this->input->post('submit')){
			  if($this->db_model->isValid()){
			    if($this->db_model->save()){
				  redirect($this->module_url);
				}else setError('Insert '.$this->caption.' failed');
			  }			  
			}
			$this->_display('form');
		}
		
		function edit($id){
			$this->parameters['data'] = $this->db_model->get($id);
			if(!$this->parameters['data'])
			 die('Group not found');
			 
			if($this->input->post('submit')){
			  if($this->db_model->isValid()){
			    if($this->db_model->save($id)){
				  redirect($this->module_url);
				}else setError('Update '.$this->caption.' failed');
			  }			  
			}
			
			$this->_display('form');
		}
		
		function delete($id){
			if($this->db_model->delete($id)){ 
			  redirect($this->module_url);
			}else die('Delete '.$this->caption.' failed');
		}
		
		function _getSQL($parent=0){ return ''; }	
		
		function child($parent){
			$SQL = $this->_getSQL($parent);
			$data = $this->ado->GetAll($SQL);
			//die($SQL);
			if($data){
			  include_once('application/libraries/JSON.php');
			  $json = new Services_JSON;
			  echo $json->encode($data);
			}
		}
	}
?>
