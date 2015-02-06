<?php
defined('BASEPATH') or die('Access Denied');
Class report_view extends AdminPage{
	function report_view()
	{
		parent::AdminPage();
		//$this->pageCaption = 'Print Cuti Karyawan';
	}
	
	function index()
	{
		$data['divisi'] = $this->db->get('db_divisi')->result();
		$this->parameters['data'] = $data;
		$this->loadTemplate('report/report_cuti_view');
	}
	
	function report_perkaryawan(){
		$data['divisi'] = $this->db->get('db_divisi')->result();
		$this->parameters['data'] = $data;
		$this->loadTemplate('report/report_perkaryawan_view');
	}
	
	function report_denda_customer(){
		$data['project'] = $this->db->order_by('nm_project')
									->get('project')->result(); 
		$data['customer'] = $this->db->order_by('customer_nama')
								     ->get('db_custprofil')->result();
		$data['unit'] = $this->db->select('distinct(denda_unit)')
								 ->get('db_denda')->result();
		$this->parameters['data'] = $data;
		$this->loadTemplate('report/report_denda_customer_view');
	}

	function report_denda_project(){
		$this->loadTemplate('report/report_denda_project_view');
	}
	
	function report_sales_customerprospek(){
		/*$data['sales'] = $this->db->select('id_kary id,nama nama')
									->where('id_divisi','12')
									->order_by('nama','asc')
									->get('db_kary')
									->result();*/
		
		
		$this->loadTemplate('report/report_sales_customerprospek_view');
	}
	
	function report_sales_summary_customerprospek(){
			
		$this->loadTemplate('report/report_sales_summary_customerprospek_view');
	}
	
	function report_allsales_summary_customerprospek(){
			
		$this->loadTemplate('report/report_allsales_summary_customerprospek_view');
	}
	function report_mall2mall_customerprospek(){
			
		$this->loadTemplate('report/report_mall2mall_customerprospek_view');
	}
	function report_detail_customerservice(){
			
		$this->loadTemplate('report/report_detail_customerservice_view');
	}
	function report_detail_frontoffice(){
			
		$this->loadTemplate('report/report_detail_frontoffice_view');
	}
	function sales_report(){
			
		$this->loadTemplate('report/sales_report_view');
	}
	
	function statusunit_report(){
			
		$this->loadTemplate('report/statusunit_report_view');
	}
	
	function salespayment_report(){
			
		$this->loadTemplate('report/salespayment_report_view');
	}
	
	function leasingpayment_report(){
			
		$this->loadTemplate('report/leasingpayment_report_view');
	}
	
	function aging_coll_report(){
			
		$this->loadTemplate('sales/aging_collreport_view');
	}
	
	function aging_coll_report_leasing(){
			
		$this->loadTemplate('leasing/aging_leasingreport_view');
	}
	#function collprojection_report(){
			
	#	$this->loadTemplate('report/collprojection_report_view');
	#}
	
	function projection_sales_report(){
		$session_id = $this->UserLogin->isLogin();
		$pt = $session_id['id_pt'];
		$data['proj'] = $this->db->where('id_pt',$pt)
								 ->get('db_subproject')->result();
		$this->parameters['data'] = $data;
		$this->loadTemplate('sales/projection_report_view');
	}
	


	#Report History Pembayaran Customer
	function history_pembayaran_sales_report(){
		$session_id = $this->UserLogin->isLogin();
		$pt = $session_id['id_pt'];		
		$data['proj'] = $this->db->where('id_pt',$pt)
								 ->get('db_subproject')->result();
								 #var_dump($data['proj']);exit;
		$this->parameters['data'] = $data;		
		$this->loadTemplate('sales/history_pembayaran_report_view');		
	}
	
	function history_pembayaran_leasing_report(){
		$session_id = $this->UserLogin->isLogin();
		$pt = $session_id['id_pt'];		
		$data['proj'] = $this->db->where('pt_id',12)
								 ->get('db_subproject')->result();
								 #var_dump($data['proj']);exit;
		$this->parameters['data'] = $data;		
		$this->loadTemplate('leasing/history_pembayaran_report_view');		
	}
	
	function history_pembayaran_sales_summary_report(){
		$session_id = $this->UserLogin->isLogin();
		$pt = $session_id['id_pt'];		
		$data['proj'] = $this->db->where('id_pt',$pt)
								 ->get('db_subproject')->result();
								 #var_dump($data['proj']);exit;
		$this->parameters['data'] = $data;		
		$this->loadTemplate('sales/history_pembayaran_summary_report_view');		
	}
	
	
	function loaddata(){
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				$session_id = $this->UserLogin->isLogin();
				$idattr =  (@$session_id['id_attr']);
				$pt =  $session_id['id_pt'];
		
		
	
				
				switch($data_type){
					case 'salesmanager':
						$sql = $this->db->select('attr_id id,nama nama')
									#->where('id_divisi','12')
									#->where('id_karylvl','4')
									->where('isnull(id_flag,0) !=',10)
									->like('attr_id',$idattr)
									->order_by('nama','asc')
									->get('db_kary')
									->result();
						break;
					case 'unit':
						$sql = $this->db->select('unit_id id,unit_no nama')
										->where('id_subproject',$parent_id)
										->where('status_unit',3)
										->order_by('unit_no','ASC')
										->get('db_unit_yogya')
										->result();					
					break;	
					case 'unit_leasing' :
				
						$sql = $this->db->select('id id,(kd_tenant +"  ||  "+ customer_nama) nama')
										->join('db_customer','customer_id = id_customer','left outer')
										
										->where('id_subproject',$parent_id)
										->where('status !=',10)
										//->group_by('id')
									->order_by('kd_tenant','ASC')
										->get('db_loo_sewa')->result();
					break;
					case 'mall':
						$sql = $this->db->select('venue id,venue nama')
									->join('db_custcomp','customer_id = id_customer','left')
									->where('id_media','6')
									->group_by('venue')
									->get('db_customer')
									->result();
						break;	
					case 'customer':
						$sql = $this->db->select('id_customer id,customer_nama nama')
									->join('db_customer','customer_id = id_customer','left')
									->group_by('id_customer')
									->group_by('customer_nama')
									->get('db_cs')
									->result();
						break;	
					
					case 'subproject':
						$sql = $this->db->select('subproject_id id,nm_subproject nama')
									->where('pt_id',$pt)									
									->get('db_subproject')
									->result();
						break;
						

					case 'status':
						$sql = $this->db->select('unitstatus_id id,unitstatus_nm nama')
									->get('db_unitstatus')
									->result();
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
		
		function loaddata_leasing(){
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				$session_id = $this->UserLogin->isLogin();
				$idattr =  (@$session_id['id_attr']);
				$pt =  $session_id['id_pt'];
		
		
	
				
				switch($data_type){
					case 'salesmanager':
						$sql = $this->db->select('attr_id id,nama nama')
									#->where('id_divisi','12')
									#->where('id_karylvl','4')
									->where('isnull(id_flag,0) !=',10)
									->like('attr_id',$idattr)
									->order_by('nama','asc')
									->get('db_kary')
									->result();
						break;
					case 'unit':
						$sql = $this->db->select('unit_id id,unit_no nama')
										->where('id_subproject',$parent_id)
										->where('status_unit',3)
										->order_by('unit_no','ASC')
										->get('db_unit_yogya')
										->result();					
					break;	
					case 'mall':
						$sql = $this->db->select('venue id,venue nama')
									->join('db_custcomp','customer_id = id_customer','left')
									->where('id_media','6')
									->group_by('venue')
									->get('db_customer')
									->result();
						break;	
					case 'customer':
						$sql = $this->db->select('id_customer id,customer_nama nama')
									->join('db_customer','customer_id = id_customer','left')
									->group_by('id_customer')
									->group_by('customer_nama')
									->get('db_cs')
									->result();
						break;	
					
					case 'subproject':
						$sql = $this->db->select('subproject_id id,nm_subproject nama')
									->where('pt_id',12)									
									->get('db_subproject')
									->result();
						break;
						

					case 'status':
						$sql = $this->db->select('unitstatus_id id,unitstatus_nm nama')
									->get('db_unitstatus')
									->result();
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

