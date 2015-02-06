<?
	defined('BASEPATH') or die('Access Denied');
	
	class Login extends Application{

		function Login(){
			parent::Application();
			$this->pageCaption = 'Login Administrator';
		}
		
		function index(){
			if($this->input->post('login')){
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required|md5');
				if($this->form_validation->run()){
					extract(PopulateForm());
					$this->db->where('username',$username);
					$this->db->where('password',$password);

					$user = $this->ado->GetRow('user_admin');
					if($user){
					  $this->UserLogin->saveLogin($user);
					  redirect('administrator');
					}else setError('Login failed.'.br().'Username and password not valid');
				}
			}			
			$this->loadTemplate('administrator/login_view');
		}		
		
		function out(){
			$this->UserLogin->deleteLogin();
			redirect('administrator/login');
		}
		
	}
?>
