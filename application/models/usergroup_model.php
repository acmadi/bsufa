<?
	defined('BASEPATH') or die('Access Denied');
	
	class UserGroup_model extends Base_model{
		
		function UserGroup_model(){
			parent::Base_model();
			$this->tableName = 'user_group';
			$this->primaryField = 'id_group';
			$this->fields = array(
				'group_name'=>array('Nama Group'),
			);
		}
	}
?>
