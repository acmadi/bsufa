<?
	defined('BASEPATH') or die('Access Denied');
	
	class CatagoryNews extends AdminDatabase{

		function CatagoryNews(){
			parent::AdminDatabase('CatagoryArticle_model');
			$this->pageCaption = 'Catagory News';
			$this->caption = strtolower($this->pageCaption);
			$this->module_url = 'administrator/catagorynews/';
			$this->template_folder = 'administrator/components/article/';
			$this->db_model->setCatagoryType('news');
			$this->parameters['filePath'] = $this->db_model->filePath;
		}
		
		function index(){
			$this->parameters['alldata'] = $this->db_model->getHirearchy();			
			$this->_display();
		}
		
		function add(){
			$this->parameters['catagoryList'] = $this->db_model->getHirearchy();						
			parent::add();
		}
		
		function edit($id){
			$this->parameters['catagoryList'] = $this->db_model->getHirearchy();						
			parent::edit($id);
		}
		
		function thickbox(){
			$this->parameters['url_prefix'] = 'berita/index/';
			$this->parameters['alldata'] = $this->db_model->getHirearchy();
			$this->_display('thickbox');
		}
	}
?>
