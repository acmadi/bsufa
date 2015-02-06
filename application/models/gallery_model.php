<?
	defined('BASEPATH') or die('Access Denied');
	
	class Gallery_model extends Base_model{
		
		function Gallery_model(){
			parent::Base_model();
			$this->tableName = 'gallery_catagory';
			$this->primaryField = 'id_gallery_catagory';
			$this->fields = array(
				'gallery_catagory_name'=>array('Gallery Category',true),
			);
		}
	}
?>
