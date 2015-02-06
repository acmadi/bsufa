<?
	defined('BASEPATH') or die('Access Denied');
	
	class AdminPage extends Application{
		
		function AdminPage(){
			parent::Application();
			$this->UserLogin->filterLogin();
		}	
		
		/*protected function initModule(){
			$var = array();
			$sql = 'SELECT m. * FROM modules m 
					JOIN user_menu u ON m.id_module = u.module_id 
					WHERE u.group_id = "'.$this->UserLogin->getClass().'" 
					ORDER BY m.module_index , m.parent_module_id';
			$modules = $this->ado->GetAll($sql);
			if($modules){
				$data = array();
				foreach($modules as $mod){
					$data[$mod->parent_module_id][] = $mod;
				}
				$var['modules_menu'] = $this->loadMenu($data,0);
			}else $var['modules_menu'] = false;
			return $var;
		}*/		
		
		protected function initModule(){
			$var = array();
			$sql = 'SELECT m.* FROM modules m 
					left JOIN user_menu u ON m.id_module = u.module_id 
					left join db_site_modules sm on m.id_module = sm.id_module
					WHERE u.group_id = \''.$this->UserLogin->getClass().'\' and (sm.id_sites = \''. $this->UserLogin->getSitesID() .'\' or sm.id_sites = \'0\' or sm.id_sites is null)
					ORDER BY m.module_index , m.parent_module_id';
			//echo "ID Sites = ".$this->UserLogin->getSitesID();
			$modules = $this->ado->GetAll($sql);
			if($modules){
				$data = array();
				foreach($modules as $mod){
					$data[$mod->parent_module_id][] = $mod;
				}
				$var['modules_menu'] = $this->loadMenu($data,0);
			}else $var['modules_menu'] = false;
			
			$var['sites_menu'] = $this->loadSites();
			return $var;
		}

		protected function loadMenu($data,$parent){
			if(isset($data[$parent])){
			   $str = ($parent==0?'':'<div>').'<ul'.($parent==0?' class="menu-drop"':'').'>'; //parent_module_id
			   foreach($data[$parent] as $row){
				 $str .= '<li>'.($row->module_path?anchor($row->module_path,$row->module_name):'<a href="javascript:;">'.$row->module_name.'</a>');			 
				 $str .= $this->loadMenu($data,$row->id_module);
				 $str .= '</li>';
			   }
			   $str .= '</ul>'.($parent==0?'':'</div>');
			   return $str;
			}else return '';	
		}
		
		/*protected function loadSites() {
			$sql = "SELECT ISNULL(d.id_sites, 0) as id_sites, ISNULL(c.sites_name, 'ALL') as sites_name, ISNULL(c.sites_img, 'global_32.png') as sites_img FROM user_menu a left join modules b on b.id_module = a.module_id left join db_site_modules d on b.id_module = d.id_module right join db_sites c on c.id_sites = d.id_sites where a.group_id = '". $this->UserLogin->getClass() ."' group by d.id_sites, c.sites_name, c.sites_img";
			$res_sites = false;
			$sites = $this->ado->GetAll($sql);
			#var_dump($this->UserLogin->getClass());exit;
			if(count($sites) > 0){
				$res_sites .= "<nav id=nav>
					<ul class=\"menu collapsible shadow-bottom\">";
				foreach($sites as $s){
					$res_sites .= "<li>
						<a href=\"".base_url()."user/home/sites/".$s->id_sites."\">
						<img src=\"".base_url()."assets/css/images/icons/".$s->sites_img."\">". $s->sites_name ."</a>
						</li>";
				}
				$res_sites .= "</ul>
					</nav>";
			}
			
			return $res_sites;			
		}*/
		
		protected function loadSites() {
			//$sql = "SELECT ISNULL(c.id_sites, 0) as id_sites, ISNULL(c.sites_name, 'Back To Home') as sites_name, ISNULL(c.sites_img, 'global_32.png') as sites_img FROM db_sites c";
			$sql = "SELECT ISNULL(d.id_sites, 0) as id_sites, ISNULL(c.sites_name, 'Back To Home') as sites_name, ISNULL(c.sites_img, 'global_32.png') as sites_img FROM user_menu a left join modules b on b.id_module = a.module_id left join db_site_modules d on b.id_module = d.id_module right join db_sites c on c.id_sites = d.id_sites where a.group_id = '". $this->UserLogin->getClass() ."' group by d.id_sites, c.sites_name, c.sites_img";
			$res_sites = false;
			$sites = $this->ado->GetAll($sql);
			$sites2 = false;
			$idSites2 = "";
			$res_sites .= "<nav id=nav>
				<ul class=\"menu collapsible shadow-bottom\">";
			$res_sites .= "<li>
						<a href=\"".base_url()."user/home/sites/0\">
						<img src=\"".base_url()."assets/css/images/icons/global_32.png\">Back to Home</a>
						</li>";
			if($sites){
				foreach($sites as $s){
					$sql2 = "SELECT ISNULL(d.id_sites, 0) as id_sites, ISNULL(c.sites_name, 'Back To Home') as sites_name, ISNULL(c.sites_img, 'global_32.png') as sites_img FROM user_menu a left join modules b on b.id_module = a.module_id left join db_site_modules d on b.id_module = d.id_module right join db_sites c on c.id_sites = d.id_sites where a.group_id = '". $this->UserLogin->getClass() ."' and d.id_sites = '". $s->id_sites ."' group by d.id_sites, c.sites_name, c.sites_img";
					$sites2 = $this->ado->GetAll($sql2);
					$idSites2 = $s->id_sites;
					/*if($sites2) {
						foreach($sites2 as $s2){
							$idSites2 = $s2->id_sites;
						}
					}*/
					$res_sites .= "<li>
						<a ".($idSites2!=""?"":"style='-moz-opacity: .75;filter: alpha(opacity=50);opacity: 0.5;'")." ".($idSites2!=""?"href=\"".base_url()."user/home/sites/".$s->id_sites:"#")."\">
						<img ".($idSites2!=""?"":"style='-moz-opacity: .0;filter: alpha(opacity=50);opacity: 0.5;'")." src=\"".base_url()."assets/css/images/icons/".$s->sites_img."\">". $s->sites_name ."</a>
						</li>";
					$idSites2 = "";
					//var_dump($res_sites);
				}
			}
			$res_sites .= "</ul>
					</nav>";
			
			return $res_sites;			
		}
	}
?>
