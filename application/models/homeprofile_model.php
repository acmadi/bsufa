<?
	defined('BASEPATH') or die('Access Denied');
	
	class HomeProfile_model extends BaseUpload_model{

		function HomeProfile_model(){
			parent::Base_model();
			$this->tableName = 'home_profile';
			$this->primaryField = 'id_profile';
			$this->fieldFile = 'profile_image';
			$this->filePath = 'assets/media/profile/';
			$this->fields = array(
				'title'=>array('Title',true),
				'profile_index'=>array('Profile Index',true,'is_natural'),
				'content'=>array('Content',true)
			);
		}
		
		function save($id = false){
			if(!$id) $this->db->set('submit_date',now());
			return parent::save($id);
		}		
		
	}
?>
