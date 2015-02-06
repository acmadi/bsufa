<?
	defined('BASEPATH') or die('Access Denied');
	
	class UserLogin extends Model{
		var $_name = 'bd_userlogin_352163';
		
		function UserLogin(){
			parent::Model();
		}
		
		function isLogin(){
			return $this->session->userdata($this->_name);
		}
		
		function saveLogin($data){
			$value = array(
				'id'=>$data->id_user,
				'username'=>$data->username,
				'class'=>$data->group_id,
				'level_id'=>$data->level_id,
				'id_pt'=>$data->id_pt,
				'divisi_id'=>$data->divisi_id,
				'id_parent'=>$data->id_parent,
				'kary_id'=>$data->kary_id,
				'group_id'=>$data->group_id,
				'id_chief'=>$data->id_chief,
				'id_attr'=>$data->id_attr				
				
			);	
			$this->session->set_userdata($this->_name,$value);
		}
		
		function getID(){
			$data = $this->session->userdata($this->_name);
			return @$data['id'];
		}
		
		function getClass(){
			$data = $this->session->userdata($this->_name);
			return @$data['class'];
		}
		
		function getUsername(){
			$data = $this->session->userdata($this->_name);
			return @$data['username'];
		}
		
		function deleteLogin(){
			$this->session->unset_userdata($this->_name);
			$this->unsetSites();
		}
		
		function isSuperAdmin(){
			$this->db->where('id',$this->getID());
			$this->db->select('is_superadmin');
			return ($this->ado->GetOne('admin') == 'Ya');
		}
		
		function filterLogin(){
			if(!$this->isLogin()){
				redirect('user/login');
				exit;
			}
		}
		
		function setSites($id_sites) {
			$this->session->set_userdata("IDsites", $id_sites);
		}
		
		function getSitesID() {
			return ($this->session->userdata("IDsites")==""?"0":$this->session->userdata("IDsites"));
		}
		
		function getSites() {
			$id_sites = $this->session->userdata("IDsites");
			$sql = "select id_sites, sites_name, sites_img from db_sites where id_sites = '".$id_sites."'";
			$sites = $this->ado->GetAll($sql);
			
			return $sites;
		}
		
		function unsetSites() {
			$this->session->unset_userdata("IDsites");
		}
	}
?>
