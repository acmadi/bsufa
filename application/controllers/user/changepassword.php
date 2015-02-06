<?
	defined('BASEPATH') or die('Access Denied');
	
	class ChangePassword extends AdminPage{

		function ChangePassword(){
			parent::AdminPage();
			$this->pageCaption = 'Change Password';
			$this->module_url = 'administrator/changepassword/';
			$this->template_folder = 'administrator/components/useradmin/change';
		}
		function index(){
			$ID = $this->UserLogin->getID();
			$this->db->where('id_user',$ID);
			$query = $this->ado->GetRow('user_admin');
			if($this->input->post('submit')){
				extract(PopulateForm());
				if($passold && $password && $passconf){
				  if(md5($passold) == $query->password){
					 if($password == $passconf){
						$this->db->set('password',md5($password));
						$this->db->where('id_user',$ID);
						$this->db->update('user_admin');
						setError('Password berhasil diubah');
					 }else setError('Password baru tidak sama');
				  }else setError('Password lama salah');
				}else setError('Lengkapi Form');
			}
			$this->loadTemplate($this->template_folder.'form');
		}
		
	}
?>
