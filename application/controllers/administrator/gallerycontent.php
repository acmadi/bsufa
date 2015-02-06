<?
defined('BASEPATH') or die('Access Denied');

	class GalleryContent extends AdminDatabase{
		var $paggingURL = '?d=administrator&c=gallery&m=index';
		
		function GalleryContent(){
			parent::AdminDatabase('GalleryContent_model');
			$this->pageCaption = 'Gallery Content';
			$this->caption = 'gallery content';
			$this->module_url = 'administrator/gallerycontent/';
			$this->template_folder = 'administrator/components/gallerycontent/';
			$this->parameters['filePath'] = $this->db_model->filePath;
		}
		
		function index($id=false){
			if(!$id) $id = $this->input->get('gallery');
			
			$this->load->model('Gallery_model','gallery');
			$this->parameters['galleryName'] = $this->gallery->getValue('gallery_catagory_name',$id);
			
			$this->parameters['currentCatagory'] = $id;
			$this->db->where('gallery_catagory_id',$id);
			$this->_setPagging('?d=administrator&c=gallerycontent&m=index&gallery='.$id,$this->db_model->countRow());
			$this->db->where('gallery_catagory_id',$id);
			$this->db->order_by('gallery_content_index');
			parent::index();
		}	
		
		
		function add($id=false){
			$this->parameters['currentCatagory'] = $id;
			$this->module_url .= 'index/'.$id;
			parent::add();
		}		
		
		function edit($id=false){
			$this->module_url .= 'index/'.$this->db_model->getValue('gallery_catagory_id',$id);
			parent::edit($id);
		}
		
		function delete($id){
			$this->module_url .= 'index/'.$this->db_model->getValue('gallery_catagory_id',$id);
			parent::delete($id);
		}
	}	
?>
