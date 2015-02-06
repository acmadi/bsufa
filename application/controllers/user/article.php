<?
	defined('BASEPATH') or die('Access Denied');
	
	class Article extends AdminDatabase{

		function Article(){
			parent::AdminDatabase('Article_model');
			$this->pageCaption = 'Master Article';
			$this->caption = 'article';
			$this->module_url = 'administrator/article/';
			$this->template_folder = 'administrator/components/article/master';
			
			$this->load->model('CatagoryArticle_model','catagory');
			$this->parameters['catagoryList'] = $this->catagory->getHirearchy(1);	
			$this->parameters['filePath'] = $this->db_model->filePath;					
		}
		
		function index($catagory=0){
			if(!$catagory) $catagory = $this->input->get('catagory');
			
			$this->parameters['catagoryName'] = $this->catagory->getValue('catagory_name',$catagory);
			
			if($catagory) $this->db->where('catagory_article_id',$catagory);			
			//$this->_setPagging($this->module_url.'index/'.$catagory.'/',$this->db_model->countRow());
			$this->_setPagging('?d=administrator&c=article&m=index&catagory='.$catagory,$this->db_model->countRow());
			
			$this->parameters['currentCatagory'] = $catagory;
			if($catagory) $this->db->where('catagory_article_id',$catagory);
			$this->db->order_by('article_update','desc');
			
			parent::index();
		}
		
		function add($catagory=0){
			$this->parameters['currentCatagory'] = $catagory;
			if($catagory) $this->module_url .= 'index/'.$catagory;
			parent::add();
		}
		
		function comment($article_id=0){
			if(!$article_id) $article_id= $this->input->get('article_id');
			
			$this->parameters['articledata'] = $this->db_model->get($article_id);

			if($article_id) $this->db->where('article_id',$article_id);			
			$this->_setPagging('?d=administrator&c=article&m=comment&article_id='.$article_id,$this->db_model->comment->countRow(),5);

			if($article_id) $this->db->where('article_id',$article_id);
			$this->parameters['alldata'] = $this->db_model->comment->get();
			$this->parameters['commentLabels'] = $this->db_model->comment->getLabels();
			
			$this->parameters['backURL'] = $this->module_url.'index/'.$this->parameters['articledata']->catagory_article_id;
			
			$this->_display('comment');
		}
		
		function edit($id){
/*
			$this->db->where('id_user',$this->db_model->getValue('user_id',$id));
			$this->db->select('group_id');
			$group_id = $this->ado->GetOne('user_admin');
			if($this->UserLogin->getClass() > $group_id) redirect($this->module_url);
*/
			$catagory = $this->db_model->getValue('catagory_article_id',$id);
			$this->module_url .= 'index/'.$catagory;
			parent::edit($id);
		}
		
		function thickbox($type=false){			
			if(!$type) $type= $this->input->get('type');
			
			$SQLWhere = "FROM article a 
						 JOIN catagory_article c ON a.catagory_article_id = c.id_catagory
						 WHERE catagory_type = '$type'";
			$count = $this->ado->GetOne("SELECT COUNT(id_article) ".$SQLWhere);
			$this->_setPagging('?d=administrator&c=article&m=thickbox&type='.$type,$count,10,false);
			
			$currentPage = intval($this->input->get('per_page'));
			$data = $this->ado->GetAll("SELECT id_article,article_title,article_url ".$SQLWhere." LIMIT ".$currentPage.",10");
			//echo $this->db->last_query();
			$this->parameters['alldata'] = $data;
			$this->_display('thickbox');	
		}
		
		function setfrontend(){
			$id = $this->input->post('postID');
			$stat = $this->input->post('postStatus');
			$result = $stat=='true'?'yes':'no';
			$this->db->set('show_frontend',$result);
			$this->db->where('id_article',$id);
			$this->db->update('article');
			echo $result;
		}
	}
?>
