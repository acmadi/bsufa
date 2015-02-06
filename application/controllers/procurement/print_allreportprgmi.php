<?
	defined('BASEPATH') or die('Access Denied');
	
	class print_allreportprgmi extends AdminPage{

		function print_reportpr()
		{
			//die($ven."-".$div);
			$this->load->view('procurement/print/print_reportprgmi');
			
		}
		
		
		function index(){	
			extract(PopulateForm());	
			
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];
			$data['proj'] = $this->db->where('id_pt',$pt)
									 ->get('db_subproject')->result();
									 
			$data['div'] = $this->db->select('a.divisi_id,a.divisi_nm')
										->join('db_linkdivisi b','b.divisi_id = a.divisi_id')
										->where('b.id_pt','44')
										->group_by('a.divisi_id,a.divisi_nm')
										->order_by('a.divisi_id','ASC')
										->get('db_divisi a')->result();
												
			$data['ven'] = $this->db->select('kd_supplier,nm_supplier')
									//->where('kd_supp !=','0')
									->group_by('kd_supplier,nm_supplier')
									->order_by('nm_supplier','ASC')
									->get('pemasokmaster')->result();
		
									 
			$this->parameters['data'] = $data;
			$this->loadTemplate('procurement/allreportprgmi_view');
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
					case 'div':
						$sql = $this->db->select('id,div')
										->order_by('id','ASC')
										->get('divisi')->result();
						break;
						
						
					case 'ven' :
						$sql = $this->db->select('kd_supplier,nm_supplier')
										->where('kd_project','11101')
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
