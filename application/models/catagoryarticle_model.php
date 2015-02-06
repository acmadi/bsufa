<?
	defined('BASEPATH') or die('Access Denied');
	
	class CatagoryArticle_model extends BaseUpload_model{
		var $catType = 'news';
		
		function CatagoryArticle_model(){
			parent::Base_model();
			$this->tableName = 'catagory_article';
			$this->primaryField = 'id_catagory';
			$this->fieldFile = 'catagory_image';
			$this->filePath = 'assets/media/article/';
			$this->fields = array(
				'parent_catagory_id'=>array('Parent Catagory'),
				'catagory_name'=>array('Nama Catagory',true),
				'catagory_index'=>array('Catagory Index',true,'is_natural'),			
				'allow_comment'=>array('Allow Comment')	
			);			
		}
		function setCatagoryType($catType = 'news'){
			$this->catType = $catType;
		}
		function getHirearchy($all=false){
			$this->db->orderby($this->primaryField);
			$this->db->orderby('parent_catagory_id');
			if(!$all) $this->db->where('catagory_type',$this->catType);
			$all = $this->ado->GetAll($this->tableName);
			$data = array();
			if($all){
			  foreach($all as $row){
			    $data[$row->parent_catagory_id][] = $row; 
			  }
			}
			return $data;
		}
		function save($id = false){
			$this->db->set('catagory_type',$this->catType);
			return parent::save($id);
		}
		function get($id=false,$limit=0,$page=0){
			$this->db->where('catagory_type',$this->catType);
			return parent::get($id,$limit,$page);
		}
		function countRow(){
			$this->db->where('catagory_type',$this->catType);
			return parent::countRow();
		}
		function delete($id){
			$this->db->where('catagory_type',$this->catType);
			return parent::delete($id);
		}
		function getMainProduct(){
			$this->setCatagoryType('product');
			$this->db->where('parent_catagory_id',0);
			$this->db->limit(5);
			$this->db->order_by('catagory_index');
			return $this->get();
		}
	}
?>
