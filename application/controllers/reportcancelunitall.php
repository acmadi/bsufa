<?
	defined('BASEPATH') or die('Access Denied');
	
	class reportcancelunitall extends AdminPage{

		function print_cancelunitall()
		{
			
			extract(PopulateForm());
		
			$this->load->view('sales/print/print_cancelunit_all');
			
		}
		
	
		function index(){	
			extract(PopulateForm());	
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];
			
			$data['project'] = $this->db->where('id_pt',$pt)->get('db_subproject')->result();
			$this->parameters['data'] = $data;
			
			$this->loadTemplate('sales/reportcancelunitall_view');
		}
		
		
		function view_type(){
			extract(PopulateForm());	
			
			
		}
		
		function loaddata(){
		
			#die($this->input->post('parent_id'));
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				$session_id = $this->UserLogin->isLogin();
				$session_cus = $this->input->post('subproject');
				
				$pt = $session_id['id_pt'];
				$a=44;
				//die($a);
				switch($data_type){
					case 'subproject':
						$tes = array('41011','41012');
						$sql = $this->db->select('subproject_id id,nm_subproject nama')
										->where('pt_id',$pt)
										->where('subproject_id !=','1')
									//	->order_by('nm_subproject','ASC')
										->get('db_subproject')->result();
						break;
							case 'unit' :
							
						if ($pt==11){
						$sql = $this->db->select('unit_id id,unit_no nama')
				//						->join('db_unit_yogya','unit_no = id_unit')
										->where('id_subproject',$parent_id)
										->where('status_unit','3')
										->order_by('unit_no','ASC')
										->get('db_unit_bdm')->result();
						}elseif ($pt==44){
						$sql = $this->db->select('unit_id id,unit_no nama')
				//						->join('db_unit_yogya','unit_no = id_unit')
										->where('id_subproject',$parent_id)
										->where('status_unit','3')
										->order_by('unit_no','ASC')
										->get('db_unit_yogya')->result();
						}
						break;	
						
					case 'kat' :
						$sql = $this->db->select('nm_table id,katcustprof_nm nama')
				//						->join('db_unit_yogya','unit_no = id_unit')
										->where('id_subproject',$parent_id)
										->order_by('katcustprof_nm','ASC')
										->get('db_katcustprof')->result();
						break;
					case 'tipe' :
						
						$kat = $this->input->post('kat');
			
			if ($a == 1){
			$sql = $this->db->select('motivie_id id,motivie_nm nama')
											->get('db_motivie')->result();
											break;
			}elseif($a == 2){
			$sql = $this->db->select('karysek_id id,karysek_nm nama')
											->get('db_karysek')->result();
											break;
			}elseif($a == 3){
			$sql = $this->db->select('agama_id id,agama_nm nama')
											->get('db_agama')->result();
											break;
			}elseif($a == 4){
			$sql = $this->db->select('profesi_id id,profesi_nm nama')
											->get('db_profesi')->result();
											break;
			}elseif($a == 5){
			$sql = $this->db->select('negara_id id,negara_nm nama')
											->get('db_negara')->result();
											break;
			}elseif($a == 6){
			$sql = $this->db->select('etnis_id id,etnis_nm nama')
											->get('db_etnis')->result();
											break;
			}elseif($a == 7){
			$sql = $this->db->select('media_id id,media_nm nama')
											->get('db_media')->result();
											break;
			}else{
				$sql = 'tes';
			
		
							break;
						}
							
					
								
						
						
					
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
		
		function gettype($a){
			
			$kat = $this->input->post('kat');
			
			if ($a == 1){
			$sql = $this->db->select('motivie_id id,motivie_nm nama')
											->get('db_motivie')->result();
			}elseif($a == 2){
			$sql = $this->db->select('karysek_id id,karysek_nm nama')
											->get('db_karysek')->result();
			}elseif($a == 3){
			$sql = $this->db->select('agama_id id,agama_nm nama')
											->get('db_agama')->result();
			}elseif($a == 4){
			$sql = $this->db->select('profesi_id id,profesi_nm nama')
											->get('db_profesi')->result();
			}elseif($a == 5){
			$sql = $this->db->select('negara_id id,negara_nm nama')
											->get('db_negara')->result();
			}elseif($a == 6){
			$sql = $this->db->select('etnis_id id,etnis_nm nama')
											->get('db_etnis')->result();
			}elseif($a == 7){
			$sql = $this->db->select('media_id id,media_nm nama')
											->get('db_media')->result();
			}else{
				$sql = 'tes';
			}
							
			$data = array();
			foreach($sql as $row){
				$data[] = $row;
			}		
			die(json_encode($data));		
							
		}		
		
	}		
?>
