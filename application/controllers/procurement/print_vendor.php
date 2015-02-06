<?
	defined('BASEPATH') or die('Access Denied');
	
	class print_vendor extends AdminPage{

	
		function print_vendorpdf()
		{
			//die("tes");
			$this->load->view('procurement/print/print_vendor');
			
		}
		
		
		function index(){	
			extract(PopulateForm());	
			
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];
			//$data['proj'] = $this->db->where('kd_project,nm_project',$pt)
			$data['proj'] = $this->db->select('kd_project,nm_project')
									 ->get('project')->result();
									 
			$data['div'] = $this->db->select('id,div')
										->order_by('id','ASC')
										->get('divisi')->result();
												
			$data['ven'] = $this->db->select('kd_supplier,nm_supplier')
									//->order_by('kd_project','11101')
									//->where('kd_project'
									->get('pemasok')->result();
		
									 
			$this->parameters['data'] = $data;
			$this->loadTemplate('procurement/vendor_view');
		}
		
		
		function loaddata(){
			#die($this->input->post('parent_id'));
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				$session_id = $this->UserLogin->isLogin();
				$session_cus = $this->input->post('subproject');
				
				$pt = $session_id['id_pt'];
				//$a=44;
				//die($a);
				switch($data_type){
					case 'proj':
						$sql = $this->db->select('kd_project id,nm_project nama')
												 ->get('project')->result();
						//var_dump($data['proj']);
						break;
						
						
					case 'ven' :
						$sql = $this->db->select('kd_supplier id,nm_supplier nama')
									//->order_by('kd_project','11101')
									->where('kd_project',$parent_id)
									->get('pemasok')->result();
						break;
				
						
					
				}
				$response = array();
				if($sql){
					foreach($sql as $row){
						$response[] = $row;
					}
				}else{
					$response['error'] = 'Data kosong';
				}
				die(json_encode($response));exit;
			}
		}
		
		
						
		
	}		
?>
