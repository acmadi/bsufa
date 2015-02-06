<?
	defined('BASEPATH') or die('Access Denied');
	
	class Article_model extends BaseUpload_model{

		function Article_model(){
			parent::BaseUpload_model();
			$this->load->model('Comment_model','comment');
			$this->tableName = 'article';
			$this->primaryField = 'id_article';
			$this->fieldFile = 'highlight_image';
			$this->filePath = 'assets/media/highlight_image/';
			$this->fields = array(
				'catagory_article_id'=>array('Catagory Article',true),
				'article_title'=>array('Article Title',true),
				'article_content'=>array('Article Content',true),
				'meta_keys'=>array('Meta Keys'),
				'meta_desc'=>array('Meta Desc'),		
				'status'=>array('Status')
			);
		}
		
/*
		function get($id=false){
			if($id){ 
			  return parent::get($id);
			}else{
			  $this->db->select('article.id_article, article.catagory_article_id, article.article_title, 
			  article.article_content, article.article_date, article.user_id, article.status, article.meta_keys, 
			  article.meta_desc, user_admin.group_id, user_admin.username, catagory_name');
			  $this->db->join('catagory_article','id_catagory=catagory_article_id');
			  $this->db->join('user_admin','user_admin.id_user=article.user_id');
			  $this->parameters['user_login'] = $this->UserLogin->getClass();
			  return parent::get();
			}
		}
*/		function save($id = false){
			$this->db->set('user_id',$this->UserLogin->getID());
			$this->db->set('article_update',now(1));
			$article_url = $this->input->post('article_url');
			if($article_url) $this->db->set('article_url',strtolower($article_url));
			else $this->db->set('article_url',url_title(strtolower($this->input->post('article_title'))).'.html');
			if(!$id) $this->db->set('article_date',now());
			return parent::save($id);
		}
		
		function getRecentUpdates(){
			$this->db->order_by('article_update','desc');
			$this->db->limit(7);
			$this->db->select('id_article,article_title,article_url');
			return $this->get();
		}
		
		function getLastArticle($catagory_id){
			$this->db->where('catagory_article_id',$catagory_id);
			$this->db->order_by('article_date','desc');
			return $this->ado->GetRow($this->tableName);
		}
		
		function getComments($article_id){
			$this->db->where('article_id',$article_id);
			$this->db->order_by('comment_date','desc');
			return $this->comment->get();
		}
		
		function getRelatedArticle($keys,$id){
				//die($keys);
			if($keys){
			$exp = explode(',',$keys);
			if(count($exp) > 0){
			  $arrSrc = array();
			  foreach($exp as $e){
			  	$e = trim($e);
			  	$arrSrc[] = "article_title LIKE '%$e%'" ;
			  }
			  $this->db->where("(".implode(" OR ",$arrSrc).") AND id_article <> '$id'");
			  $this->db->select('id_article,article_title');
			  $this->db->limit(5);			  
			  return $this->ado->GetAll($this->tableName);			  
			}else return false;
			}else return false;
		}
	}
?>
