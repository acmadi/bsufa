<?
	defined('BASEPATH') or die('Access Denied');
	
	class GalleryContent_model extends BaseUpload_model{
		
		function GalleryContent_model(){
			parent::BaseUpload_model();
			$this->tableName = 'gallery_content';
			$this->primaryField = 'id_gallery_content';
			$this->fieldFile = 'image';
			$this->filePath = 'assets/media/image_gallerycontent/';
			$this->fields = array(
				'gallery_content_name'=>array('Title',true),
				'gallery_content_index'=>array('Index',true,'is_natural'),
				'gallery_content_desc'=>array('Description'),
				'gallery_catagory_id'=>array('Gallery Category',true),
			);
		}
	}
?>
