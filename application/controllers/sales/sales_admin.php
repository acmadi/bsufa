<?
	defined('BASEPATH') or die('Access Denied');
	
	class sales_admin extends AdminPage{

		function sales_admin()
		{
			parent::AdminPage();
			$this->pageCaption = 'Sales View';
		}
		
		function index(){	
			extract(PopulateForm());	
			
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];
			$data['proj'] = $this->db->where('id_pt',$pt)
									 ->get('db_subproject')->result();
									 
			$data['view'] = $this->db->select('DISTINCT(view_unit)')
									 // ->where('id_subproject',$proj)
									 ->order_by('view_unit','ASC')
									->get('db_unit_yogya')->result();							  
			#$data['sold'] = 
		//	vardump($data['view']);exit;						 
			$this->parameters['data'] = $data;
			$this->loadTemplate('sales/sales_admin_view');
		}
		
		function view_sales_admin(){
			extract(PopulateForm());	
			$data['total'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										//  ->where('status_unit',1)
										  ->get('db_unit_yogya')->row();
					
			if($view=="ALL"){
			
			
				$data['unit'] = $this->db->where('id_subproject',$proj)
										 ->order_by('unit_id','DESC')
										 ->get('db_unit_yogya')->result();

			$data['avaliable'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										  ->where('status_unit',1)
										  ->get('db_unit_yogya')->row();
										  
			$data['reserved'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										  ->where('status_unit',2)
										  ->get('db_unit_yogya')->row();
										  
			$data['sold'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										  ->where('status_unit',3)
										  ->get('db_unit_yogya')->row();
										  
									  	
										  									  
			$data['na'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										  ->where('status_unit',4)
										  ->get('db_unit_yogya')->row();
			//var_dump($data['na']);exit;	
										  										  										 										 
			$data['pd'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										  ->where('status_unit',5)
										  ->get('db_unit_yogya')->row();										  										 										 
			}else{
				
			$data['avaliable'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										  ->where('status_unit',1)
										  ->where('view_unit',$view) 
										  ->get('db_unit_yogya')->row();
										  
			$data['reserved'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										  ->where('status_unit',2)
										  ->where('view_unit',$view) 
										  ->get('db_unit_yogya')->row();
										  
			$data['sold'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										  ->where('status_unit',3)
										  ->where('view_unit',$view) 
										  ->get('db_unit_yogya')->row();
										  
									  	
										  									  
			$data['na'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										  ->where('status_unit',4)
										  ->where('view_unit',$view) 
										  ->get('db_unit_yogya')->row();
			//var_dump($data['na']);exit;	
										  										  										 										 
			$data['pd'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										  ->where('status_unit',5)
										  ->where('view_unit',$view) 
										  ->get('db_unit_yogya')->row();		

				$data['unit'] = $this->db->where('id_subproject',$proj)
										 ->where('view_unit',$view) 
										 ->order_by('unit_id','DESC')
										 ->get('db_unit_yogya')->result();				
			}

			$lsunit1 = array("TH25","TH27","TH29","TH31","TH33",
							"TH35","TH37","TH39","TH41");						
			$lsunit2 = array("TH26","TH28","TH30","TH32","TH36","TH38",
			"TH40","TH42","TH43");

			$lsunit3 = array("TH22","TH20","TH18","TH16","TH12","TH10",
			"TH08","TH06","TH02");
			
			$lsunit4 = array("TH23","TH21","TH19","TH17","TH15","TH11",
			"TH09","TH07","TH05","TH03","TH01");
							
													 
			$data['unittown1'] = $this->db->where_in('unit_no',$lsunit1)
										 ->get('db_unit_yogya')->result();
									
													 
			$data['unittown2'] = $this->db->where_in('unit_no',$lsunit2)
										 ->get('db_unit_yogya')->result();

			$data['unittown3'] = $this->db->where_in('unit_no',$lsunit3)
										 ->get('db_unit_yogya')->result();

			$data['unittown4'] = $this->db->where_in('unit_no',$lsunit4)
										 ->get('db_unit_yogya')->result();

									 
			$this->parameters['data'] = $data;
			if($proj=='41011'){
				$this->loadTemplate('sales/sales_admin_townhouse_view');
			}elseif($proj=='41012'){
				$this->loadTemplate('sales/sales_admin_condotel_view');
			}else{
				die("Belum Ada Gambar");
			}			
		}
		
		function form_sales_admin($id){
			$data['cek']= $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									->where('unit_id',$id)
									->get('db_unit_yogya')->row();	
											
			$this->load->view('sales/sales_admin_condotel_unit_view',$data);
		}	
		
		function form_sales_admin_town($id){
			
			#die($id);
			$data['cek']= $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									->where('unit_id',$id)
									->get('db_unit_yogya')->row();	
		//	vardump($data['cek']);exit();								
			$this->load->view('sales/sales_admin_town_unit_view',$data);
			
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
						
						
					case 'view' :
						$sql = $this->db->select('distinct view_unit id,view_unit nama')
				//						->join('db_unit_yogya','unit_no = id_unit')
										->where('id_subproject',$parent_id)
									//	->where('status_unit','3')
										->get('db_unit_yogya')->result();
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
