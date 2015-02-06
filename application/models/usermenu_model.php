<?
	defined('BASEPATH') or die('Access Denied');
	
	class UserMenu_model extends Base_model{
		
		function UserMenu_model(){
			parent::Base_model();
			$this->tableName = 'user_menu';
			$this->primaryField = 'id_usermenu';
			$this->fields = array(
				'group_id'=>array('Group Name'),
				'module_id'=>array('Menu Title')
			);
		}
		function getHirearchy(){
			//$this->db->orderby($this->primaryField);
			//$this->db->orderby('parent_module_id');
			$all = $this->get();
			$data = array();
			if($all){
			  foreach($all as $row){
			    $data[$row->parent_module_id][] = $row; 
			  }
			}
			return $data;
		}
	}
?>
