<?
	defined('BASEPATH') or die('Access Denied');
	
	class PublicSite extends Application{
		var $pathTemplate = 'templates/template1/';
		var $componentName;
		var $componentContent;
		var $metaValue = false;
		var $headerNav = array();

		function PublicSite(){
			parent::Application();
			$this->setHeaderFooter(true);
			$this->setFullScreen(true);
			
			// add 22 oct 09
			$this->addHeaderNavigator('main.html','Home');
		}
		
		protected function setContent($varname,$value){
			$this->componentContent[$varname] = $value;
		}
		
		protected function setModule($varname,$parameters){
			$module_path = 'modules/mod_'.$varname;
			if(file_exists('application/views/'.$this->pathTemplate.'html/'.$module_path.'.php'))
			 $module_path = $this->pathTemplate.'html/'.$module_path;		
			//echo $module_path;
			$this->parameters[$varname] = $this->load->view($module_path,$parameters,TRUE);
		}
		protected function addHeaderNavigator($url,$navigator){
			$this->headerNav[] = $url==''?$navigator:anchor($url,$navigator);
		}
		protected function setMenu($object){		    
			$var = array();
			$var['data'] = $object->getHirearchy();
			$var['URL'] = $this->componentName.'/index/';
			$var['primaryField'] = $object->primaryField;
			$var['nameField'] = 'name';
			
			$varname = 'menu_content';
			$this->setModule($varname,$var);
			$this->setContent($varname,$this->parameters[$varname]);
			unset($this->parameters[$varname]);
		}
		protected function setMeta($desc,$keys){
			$this->metaValue = (object) array('desc'=>$desc,'keys'=>$keys);
		}
		protected function setFullScreen($fullscreen){
			$this->parameters['fullscreen'] = $fullscreen;
		}
		protected function setHeaderFooter($status){
			$this->parameters['isHeader'] = $status;
			$this->parameters['isFooter'] = $status;
		}
		protected function loadTemplate($template_file='default'){
			$this->parameters['pathTemplate'] = base_url() . 'application/views/' . $this->pathTemplate;
			$this->parameters['pageTitle'] = $this->pageCaption ?  $this->pageCaption . ' | ' . WEB_TITLE : WEB_TITLE;

			$this->load->model('Menu_model','menu');
			$this->load->model('CatagoryArticle_model','cat');
			$this->load->model('Article_model','article');
			$this->load->model('Links_model','links');

			$menu = $this->menu->getHirearchy();				
			$meta = $this->metaValue ? $this->metaValue : $this->menu->getMeta();		
			//Dump($menu,1);		
			$this->setModule('menu_navigator',array('menu'=>$menu));
			$this->setModule('html_head',array('meta'=>$meta));
			$this->setModule('catagory_list',array('data'=>$this->cat->getMainProduct(),'filePath'=>$this->cat->filePath));			
			$this->setModule('recent_updates',array('data'=>$this->article->getRecentUpdates()));			
			$this->setModule('links_sidebar',array('data'=>$this->links->getLinks()));
			
			if(isset($this->parameters['pagging'])) {
				$this->setContent('pagging',$this->parameters['pagging']);
			}

			$component_path = 'components/com_'.$this->componentName.'/'.$template_file;
			if(file_exists($this->pathTemplate.'html/'.$component_path))
			 $component_path = $this->pathTemplate.'html/'.$component_path;		
			$this->parameters['content'] = $this->load->view($component_path,$this->componentContent,TRUE);						
			
			$this->parameters['componentName'] = $this->componentName;
			
			// add 22 oct 09
			$this->parameters['headerNav'] = $this->headerNav;		
			
			parent::loadTemplate($this->pathTemplate.'index.php');
		}
	}
?>
