<?php
class paycustomer extends Controller{
	

	function index(){
		
		$this->load->view('sales/paycustomer_view');
		
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
						$sql = $this->db->select('subproject_id id,nm_subproject nama')
										->where('id_pt','44')
									//	->order_by('nm_subproject','ASC')
										->get('db_subproject')->result();
						break;
						
						
					case 'unit' :
						$sql = $this->db->select('unit_id id,unit_no nama')
				//						->join('db_unit_yogya','unit_no = id_unit')
										->where('id_subproject',$parent_id)
										->where('status_unit','3')
										->get('db_unit_yogya')->result();
						break;
					/*	
					case 'customername' :
						$sql = $this->db->select('distinct(customer_id) id,customer_nama nama')
										->join('db_custprofil','customer_id = id_customer')
										->where('id_project',$parent_id)
										->get('db_denda')->result();
					break; */
		/*				
select customer_nama,customer_hp,customer_alamat1 from db_unit_yogya
left join db_sp on (unit_id = id_unit)
left join db_customer on(customer_id = id_customer)
where status_unit = '3' and unit_id='47'
			*/			
						
					case 'customername' :
						$sql = $this->db->select('customer_nama,customer_hp,customer_alamat1')
										->join('db_sp','unit_id = id_unit',left)
										->join('db_customer','customer_id = id_customer',left)
										->where('status_unit','3')
										->where('unit_id',$parent_id)
										->get('db_unit_yogya')->result();
					break;
					case 'periode':
						$sql = $this->db->select('denda_periode id,denda_periode nama')
										->where('denda_unit',$parent_id)
										->get('db_denda')->result();
						//var_dump($sql);exit;
					break;
					case 'denda_unit' :
						$sql = $this->db->select('distinct(denda_unit) id,denda_unit nama')
										->where('id_customer',$parent_id)
										->get('db_denda')->result();
					break;	
					case 'project_denda':
						$sql = $this->db->select('distinct(db_denda.id_project) id_project,nm_subproject nama')
										->where('db_subproject.id_pt',$pt)
										->join('db_subproject','subproject_id = db_denda.id_project')
										->get('db_denda')->result();
					break;				
					case 'project':
					default:
					    $sql = $this->db->select('subproject_id id,nm_subproject nama')
										->where('id_pt',$pt)
										->order_by('nm_subproject','ASC')
										->get('db_subproject')->result();
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

