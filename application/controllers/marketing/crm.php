<?php
	class crm extends controller{
		function index(){
			$this->load->view('marketing/crm-index');
		}
		function loaddata(){
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				switch($data_type){
					case 'project_nm':
						$sql = $this->db->select('kd_project id,nm_project nama')
										->where('judul','n')
										->order_by('nm_project','asc')
										->get('project')
										->result();
						break;
					case 'customer':
					    $sql = $this->db->select('kd_cust id,nm_cust nama')
										->order_by('nm_cust','asc')
										->get('customer')->result();
						break;
					case 'bulan':
					    $sql = $this->db->select('bulan_id id,bulan_nm nama')
										->order_by('bulan_id','asc')
										->get('db_bulan')->result();
						break;
					case 'agama':
					    $sql = $this->db->select('agama_id id,agama_nm nama')
										->order_by('agama_id','asc')
										->get('db_agama')->result();
						break;	
					case 'sex':
					    $sql = $this->db->select('karysek_id id,karysek_nm nama')
										->order_by('karysek_id','asc')
										->get('db_karysek')->result();
						break;							
				}
				$response = array();
				if($sql){
					foreach($sql as $row){
						$response[] = $row;
					}
				}
				die(json_encode($response));
			}
		}  
	}
?>
