<?
	defined('BASEPATH') or die('Access Denied');
	
	class Menu_model extends Base_model{
		
		function Menu_model(){
			parent::Base_model();
			$this->tableName = 'menu';
			$this->primaryField = 'id_menu';
			$this->fields = array(
				'parent_menu_id'=>array('Parent Menu'),
				'menu_index'=>array('Menu Index',true,'is_natural'),
				'menu_title'=>array('Menu Title'),
				'menu_url'=>array('Menu URL'),
				'meta_keys'=>array('Meta Keys'),
				'meta_desc'=>array('Meta Desc'),
				'status'=>array('Status')
			);
		}
		function getHirearchy(){
			$this->db->orderby('parent_menu_id');
			$this->db->orderby('menu_index');
			$all = $this->get();
			$data = array();
			if($all){
			  foreach($all as $row){
				$data[$row->parent_menu_id][] = $row; 
			  }
			}
			return $data;
		}
		function getMeta(){
			$uri = uri_string();
			if(empty($uri)) $uri = 'home';
			if(substr($uri,0,1) == '/') $uri = substr($uri,1);
			$this->db->select('meta_keys,meta_desc');
			$this->db->where('menu_url',$uri);
			$data = $this->ado->GetRow($this->tableName);
			//die($this->db->last_query());
			if($data){
			  return (object) array('desc'=>$data->meta_desc,'keys'=>$data->meta_keys);
			}else return false;
		}
	}
?>
