<?
	defined('BASEPATH') or die('Access Denied');
	
	class Login extends Application{

		function Login(){
			parent::Application();
			$this->pageCaption = 'Login User';
			@$this->groupcapcha = @$group;
		}
		
		function index(){;

			if($this->input->post('login')){
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required|md5');
				$this->form_validation->set_rules('pt', 'PT', 'required');
				//$this->form_validation->set_rules('parent_pt', 'Parent PT', 'required');
				if($this->form_validation->run()){
					extract(PopulateForm());				
					$this->db->where('username',$username);
					$this->db->where('password',$password);	
					$this->db->where('id_pt',$pt);
					//$this->db->where('id_parent',$parent_pt);				
					$user = $this->ado->GetRow('user_admin');
					if($user){
					  $this->UserLogin->saveLogin($user);
					  if($this->input->post('username')=='salesmanager'){
								 redirect('mobile/viewalokasi_status/');
							  }
					  // elseif($this->input->post('username')=='indra'){
								 // redirect('mobile/viewalokasi_status/');
							  // }
					  else {redirect('user');}
					}else setError('Login failed.'.br().'Data not valid');
				}
			}	
			$this->loadTemplate('user/login_view');
		}
		
		
		function approve($id){
			if($this->input->post('login')){
				if(@$this->groupcapcha) true;
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required|md5');
				$this->form_validation->set_rules('pt', 'PT', 'required');
				//$this->form_validation->set_rules('parent_pt', 'Parent PT', 'required');
				if($this->form_validation->run()){
					extract(PopulateForm());				
					$this->db->where('username',$username);
					$this->db->where('password',$password);	
					$this->db->where('id_pt',$pt);
					//$this->db->where('id_parent',$parent_pt);				
					$user = $this->ado->GetRow('user_admin');
					if($user){
					  $this->UserLogin->saveLogin($user);
							  if($this->input->post('username')=='mgr.gmi'){
								 //~ function tes(){
									 //~ 
									//~ $this->loadTemplate('project')
								 //~ }
								#die(json_encode($id));exit;
								 													 
								redirect('project/approval_call/index/'.$id.'');
								
							  
							  }
							  elseif($this->input->post('username')=='rochmad'){
								 redirect('project/approval_call/index/'.$id.'');
							  }
							   
					}else setError('Login failed.'.br().'Data not valid');
				}
			}	
			$this->loadTemplate('user/login_view');
		}
		
		function appreclass($id){
			if($this->input->post('login')){
				if(@$this->groupcapcha) true;
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required|md5');
				$this->form_validation->set_rules('pt', 'PT', 'required');
				//$this->form_validation->set_rules('parent_pt', 'Parent PT', 'required');
				if($this->form_validation->run()){
					extract(PopulateForm());				
					$this->db->where('username',$username);
					$this->db->where('password',$password);	
					$this->db->where('id_pt',$pt);
					//$this->db->where('id_parent',$parent_pt);				
					$user = $this->ado->GetRow('user_admin');
					if($user){
					  $this->UserLogin->saveLogin($user);
							  if($this->input->post('username')=='mgr.gmi'){
								 //~ function tes(){
									 //~ 
									//~ $this->loadTemplate('project')
								 //~ }
								#die(json_encode($id));exit;
								 													 
								redirect('project/reclassbgt_call/index/'.$id.'');
								
							  
							  }
							  
							   elseif($this->input->post('username')=='rochmad'){
								 redirect('project/reclassbgt_call/index/'.$id.'');
							  }
							  //~ else{
								 //~ redirect('user');
							  //~ }
					}else setError('Login failed.'.br().'Data not valid');
				}
			}	
			$this->loadTemplate('user/login_view');
		}
		
		function appaddbgtproj($id){
			if($this->input->post('login')){
				if(@$this->groupcapcha) true;
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required|md5');
				$this->form_validation->set_rules('pt', 'PT', 'required');
				//$this->form_validation->set_rules('parent_pt', 'Parent PT', 'required');
				if($this->form_validation->run()){
					extract(PopulateForm());				
					$this->db->where('username',$username);
					$this->db->where('password',$password);	
					$this->db->where('id_pt',$pt);
					//$this->db->where('id_parent',$parent_pt);				
					$user = $this->ado->GetRow('user_admin');
					if($user){
					  $this->UserLogin->saveLogin($user);
							  if($this->input->post('username')=='mgr.gmi'){
								 //~ function tes(){
									 //~ 
									//~ $this->loadTemplate('project')
								 //~ }
								#die(json_encode($id));exit;
								 													 
								redirect('project/appaddbgtproj_call/index/'.$id.'');
								
							  
							  }
							  
							   elseif($this->input->post('username')=='rochmad'){
								 redirect('project/appaddbgtproj_call/index/'.$id.'');
							  }
							  //~ else{
								 //~ redirect('user');
							  //~ }
					}else setError('Login failed.'.br().'Data not valid');
				}
			}	
			$this->loadTemplate('user/login_view');
		}
		
		function appcjc($id){
			if($this->input->post('login')){
				if(@$this->groupcapcha) true;
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required|md5');
				$this->form_validation->set_rules('pt', 'PT', 'required');
				//$this->form_validation->set_rules('parent_pt', 'Parent PT', 'required');
				if($this->form_validation->run()){
					extract(PopulateForm());				
					$this->db->where('username',$username);
					$this->db->where('password',$password);	
					$this->db->where('id_pt',$pt);
					//$this->db->where('id_parent',$parent_pt);				
					$user = $this->ado->GetRow('user_admin');
					if($user){
					  $this->UserLogin->saveLogin($user);
							  if($this->input->post('username')=='mgr.gmi'){
								 //~ function tes(){
									 //~ 
									//~ $this->loadTemplate('project')
								 //~ }
								#die(json_encode($id));exit;
								 													 
								redirect('project/appcjc_call/index/'.$id.'');
								
							  
							  }
							  
							   elseif($this->input->post('username')=='rochmad'){
								 redirect('project/appcjc_call/index/'.$id.'');
							  }
							  //~ else{
								 //~ redirect('user');
							  //~ }
					}else setError('Login failed.'.br().'Data not valid');
				}
			}	
			$this->loadTemplate('user/login_view');
		}
			
		function loaddata(){
			#die($this->input->post('parent_id'));
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				#die($parent_id);
				switch($data_type){
					case 'parent_pt':
						$sql = $this->db->select('id_parentpt id,nm_parent nama')
										->where('id_pt',$parent_id)
										->get($data_type)->result();
						break;
					case 'pt':
					default:
					    $sql = $this->db->select('id_pt id,nm_pt nama')
										  ->order_by('id_pt','ASC')
										->get('pt')->result();
							
				}
				$response = array();
				if($sql){
					foreach($sql as $row){
						$response[] = $row;
					}
				}else{
					$response['error'] = 'Data kosong';
				}
				die(json_encode($response));
			}
		}	
		
		function out(){
			$this->UserLogin->deleteLogin();
			redirect('user/login');
		}
		
	}
?>
