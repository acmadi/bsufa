<?
	defined('BASEPATH') or die('Access Denied');
	
	class MenuAdmin_model extends Base_model{
		
		function MenuAdmin_model(){
			parent::Base_model();
			$this->tableName = 'modules';
			$this->primaryField = 'id_module';
			$this->fields = array(
				'parent_module_id'=>array('Parent Menu'),
				'module_index'=>array('Menu Index',true,'is_natural'),
				'module_name'=>array('Menu Title',true),
				'module_path'=>array('Menu Path'),
				'status'=>array('Status')
			);
		}
		function getHirearchy(){
			$this->db->orderby('parent_module_id');
			$this->db->orderby('module_index');
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
