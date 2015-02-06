<?
	defined('BASEPATH') or die('Access Denied');
	
	class HomeProfile extends AdminDatabase{

		function HomeProfile(){
			parent::AdminDatabase('HomeProfile_model');
			$this->pageCaption = 'Home Profile Article';
			$this->caption = 'home profile';
			$this->module_url = 'administrator/homeprofile/';
			$this->template_folder = 'administrator/modules/homeprofile/';
			$this->parameters['filePath'] = $this->db_model->filePath;
		}
		
		function index(){
			$this->_setPagging('?d=administrator&c=homeprofile&m=index',$this->db_model->countRow());	
			$this->db->order_by('profile_index');		
			parent::index();
		}					
		
		function setfrontend(){
			$id = $this->input->post('postID');
			$stat = $this->input->post('postStatus');
			$result = $stat=='true'?'yes':'no';
			$this->db->set('show_frontend',$result);
			$this->db->where('id_profile',$id);
			$this->db->update('home_profile');
			echo $result;
		}
	}
?>
