<?
	defined('BASEPATH') or die('Access Denied');
	
	class viewsalesadmin_status extends AdminPage{
		function viewsalesadmin()
		{
			parent::AdminPage();
			$this->pageCaption = 'Alokasi Status';
		}
		
		function index(){	
			extract(PopulateForm());	
			
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];
			$data['proj'] = $this->db->where('id_pt',$pt)
									 ->get('db_subproject')->result();
									 
			if($pt == 44){
									 
			$data['view'] = $this->db->select('DISTINCT(view_unit)')
									 // ->where('id_subproject',$proj)
									 ->order_by('view_unit','ASC')
									->get('db_unit_yogya')->result();	

			}
			else{
			
			$data['view'] = $this->db->select('DISTINCT(view_unit)')
									 // ->where('id_subproject',$proj)
									 ->order_by('view_unit','ASC')
									->get('db_unit_bdm')->result();
			
			
			
			}
			#$data['sold'] = 
		//	vardump($data['view']);exit;						 
			$this->parameters['data'] = $data;
			$this->loadTemplate('sales/salesadminstatus_view');
		}
		
		function view_salesadmin(){
			extract(PopulateForm());	
			if($proj=="--Pilih--")  die("Please Cek pilihan anda");
				$session_id = $this->UserLogin->isLogin();
				$pt = $session_id['id_pt'];
			
					if($pt == 44){
			
						$data['total'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										//  ->where('status_unit',1)
										  ->get('db_unit_yogya')->row();
					}
					
					else{
						
						$data['total'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										  ->where('status_unit <>',10)
										//  ->where('status_unit',1)
										  ->get('db_unit_bdm')->row();
					}
			
			
			if($view=="ALL"){
			
				if($pt == 44){
					
					$data['unit'] = $this->db->where('id_subproject',$proj)
										//->order_by('substring(unit_no,3,4)','DESC')
										 ->order_by('unit_id','ASC')
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
												  										  										 										 
					$data['pd'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										  ->where('status_unit',5)
										  ->get('db_unit_yogya')->row();
					}
					
				ELSE{
					$data['unit'] = $this->db->where('id_subproject',$proj)
										// ->order_by('substring(unit_no,3,4)','ASC')
										->where('status_unit <>',10) 
										 ->order_by('unit_id','ASC')
										 ->get('db_unit_bdm')->result();

					$data['avaliable'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										  ->where('status_unit',1)
										  ->get('db_unit_bdm')->row();
										  
					$data['reserved'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										  ->where('status_unit',2)
										  ->get('db_unit_bdm')->row();
										  
					$data['sold'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										  ->where('status_unit',3)
										  ->get('db_unit_bdm')->row();
										  
					$data['na'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										  ->where('status_unit',4)
										  ->get('db_unit_bdm')->row();
												  										  										 										 
					$data['pd'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										  ->where('status_unit',5)
										  ->get('db_unit_bdm')->row();
					}
					
					
					
					
															  										 										 
			}else{
				
				if($pt == 44){
				
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
				
				ELSE{
				
					$data['avaliable'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										  ->where('status_unit',1)
										  ->where('view_unit',$view) 
										  ->get('db_unit_bdm')->row();
										  
					$data['reserved'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										  ->where('status_unit',2)
										  ->where('view_unit',$view) 
										  ->get('db_unit_bdm')->row();
										  
					$data['sold'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										  ->where('status_unit',3)
										  ->where('view_unit',$view) 
										  ->get('db_unit_bdm')->row();
										  
									  	
										  									  
					$data['na'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										  ->where('status_unit',4)
										  ->where('view_unit',$view) 
										  ->get('db_unit_bdm')->row();
													  										  										 										 
					$data['pd'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  ->where('id_subproject',$proj)
										  ->where('status_unit',5)
										  ->where('view_unit',$view) 
										  ->get('db_unit_bdm')->row();		

					$data['unit'] = $this->db->where('id_subproject',$proj)
										 ->where('view_unit',$view) 
										 ->where('status_unit <>',10) 
										 ->order_by('unit_id','DESC')
										 ->get('db_unit_bdm')->result();				
				
				}
				
			
			
			}

			$lsunit1 = array("AT25","AT27","AT29","AT31","AT33",
							"AT35","AT37","AT39","AT41");						
			$lsunit2 = array("AT26","AT28","AT30","AT32","AT36","AT38",
			"AT40","AT42","AT43");

			$lsunit3 = array("AT22","AT20","AT18","AT16","AT12","AT10",
			"AT08","AT06","AT02");
			
			$lsunit4 = array("AT23","AT21","AT19","AT17","AT15","AT11",
			"AT09","AT07","AT05","AT03","AT01");
							
													 
			$data['unittown1'] = $this->db->where_in('unit_no',$lsunit1)
										 ->get('db_unit_yogya')->result();
									
													 
			$data['unittown2'] = $this->db->where_in('unit_no',$lsunit2)
										 ->get('db_unit_yogya')->result();

			$data['unittown3'] = $this->db->where_in('unit_no',$lsunit3)
										 ->order_by('unit_no','DESC')
										 ->get('db_unit_yogya')->result();

			$data['unittown4'] = $this->db->where_in('unit_no',$lsunit4)
										  ->order_by('unit_no','DESC')
										  ->get('db_unit_yogya')->result();

									 
			$this->parameters['data'] = $data;
			
				if($proj=='41011'){
					//$this->loadTemplate('sales/salesadminunittown_view');
					$this->loadTemplate('sales/salesadminunitcondotel_view');
				}
			
				elseif($proj=='41012'){
				$this->loadTemplate('sales/salesadminunitcondotel_view');
				
				}elseif($proj=='41013'){
				$this->parameters['pp'] = $pt;
				$this->loadTemplate('sales/salesadminunitsardjito_view');
			    }
				elseif($proj=='41014'){
				$this->loadTemplate('sales/salesadminunitcondotel3_view');
				}
				elseif($pt==11){
				$this->loadTemplate('sales/salesadminunitbsu_view');				
				}
				elseif($pt==22){
				$this->loadTemplate('sales/salesadminunitbsu_view');				
				}
				elseif($pt==66){
		#die($pt);
				$this->parameters['pp'] = $pt;;
				$this->loadTemplate('sales/salesadminunitsardjito_view');
				
				}
				else{die("Belum Ada Gambar");}			
		}
		
		function form_alokasi_sardjito($id){
			/*
			 #Query Production
			$data['cek']= $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									->where('unit_id',$id)
									->get('db_unit_yogya')->row();	
			*/
			extract(PopulateForm());	

			$session_id = $this->UserLogin->isLogin();
			$this->pt_id = $session_id['id_pt'];
			$pt = $this->pt_id;
		
			if($pt == 44){
			#Query edit abas
			$sql = "select a.unit_id,a.unit_pic,a.unit_no,a.view_unit,a.tanah,a.bangunan,a.pricelist_ppn,b.unitstatus_id,
					b.unitstatus_nm,d.customer_nama,c.reserved_tgl,f.nama as sales_nama,c.reserved_amount
					from db_unit_yogya a
					left join db_unitstatus b on (b.unitstatus_id = a.status_unit)
					left join db_reserved c on (c.id_unit = a.unit_id)
					left join db_customer d on (d.customer_id = c.id_customer)
					left join db_sp e on (e.id_unit = a.unit_id)
					left join db_kary f on (f.id_kary = c.id_sales)
					where unit_id = $id";
			}ELSE{
			$sql = "select a.unit_id,a.unit_pic,a.unit_no,a.view_unit,a.tanah,a.bangunan,a.pricelist_ppn,b.unitstatus_id,
					b.unitstatus_nm,d.customer_nama,c.reserved_tgl,f.nama as sales_nama,c.reserved_amount
					from db_unit_bdm a
					left join db_unitstatus b on (b.unitstatus_id = a.status_unit)
					left join db_reserved c on (c.id_unit = a.unit_id)
					left join db_customer d on (d.customer_id = c.id_customer)
					left join db_sp e on (e.id_unit = a.unit_id)
					left join db_kary f on (f.id_kary = c.id_sales)
					where unit_id = $id";	
			}
			
			
					
			$data['cek'] = $this->db->query($sql)->row();		
			
			
			/*$data['cek']= $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									->join('db_reserved','id_unit = unit_id')
									->join('db_customer','customer_id = id_customer')
									//->join('db_sp','id_unit = db_unit_yogya.unit_id')
									//->join('db_kary','id_kary = db_sp.id_sales')
									->where('unit_id',$id)
									->get('db_unit_yogya')->row();*/
				

			if ($data['cek']->unitstatus_id == 1){
				#die("test");
				$this->load->view('sales/salesadmincondotelunit_view',$data);
			}elseif ($data['cek']->unitstatus_id == 5){
				#die("coba");		
				$this->load->view('sales/salesadminsardjito_view',$data);
					
			}else{
				#die("coba");		
				$this->load->view('sales/view_after',$data);
					
			}									
								
			
		}	
		
		function form_salesadmin_condotel($id){
			/*
			 #Query Production
			$data['cek']= $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									->where('unit_id',$id)
									->get('db_unit_yogya')->row();	
			*/
			extract(PopulateForm());	

			$session_id = $this->UserLogin->isLogin();
			$this->pt_id = $session_id['id_pt'];
			$pt = $this->pt_id;
		
			if($pt == 44){
			#Query edit abas
			$sql = "select a.unit_id,a.unit_pic,a.unit_no,a.view_unit,a.tanah,a.bangunan,a.pricelist_ppn,b.unitstatus_id,
					b.unitstatus_nm,d.customer_nama,c.reserved_tgl,f.nama as sales_nama,c.reserved_amount
					from db_unit_yogya a
					left join db_unitstatus b on (b.unitstatus_id = a.status_unit)
					left join db_reserved c on (c.id_unit = a.unit_id)
					left join db_customer d on (d.customer_id = c.id_customer)
					left join db_sp e on (e.id_unit = a.unit_id)
					left join db_kary f on (f.id_kary = c.id_sales)
					where unit_id = $id";
			}ELSE{
			$sql = "select a.unit_id,a.unit_pic,a.unit_no,a.view_unit,a.tanah,a.bangunan,a.pricelist_ppn,b.unitstatus_id,
					b.unitstatus_nm,d.customer_nama,c.reserved_tgl,f.nama as sales_nama,c.reserved_amount
					from db_unit_bdm a
					left join db_unitstatus b on (b.unitstatus_id = a.status_unit)
					left join db_reserved c on (c.id_unit = a.unit_id)
					left join db_customer d on (d.customer_id = c.id_customer)
					left join db_sp e on (e.id_unit = a.unit_id)
					left join db_kary f on (f.id_kary = c.id_sales)
					where unit_id = $id";	
			}
			
			
					
			$data['cek'] = $this->db->query($sql)->row();		
			
			
			/*$data['cek']= $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									->join('db_reserved','id_unit = unit_id')
									->join('db_customer','customer_id = id_customer')
									//->join('db_sp','id_unit = db_unit_yogya.unit_id')
									//->join('db_kary','id_kary = db_sp.id_sales')
									->where('unit_id',$id)
									->get('db_unit_yogya')->row();*/
				

			if ($data['cek']->unitstatus_id == 1){
				#die("test");
				$this->load->view('sales/salesadmincondotelunit_view',$data);
			}elseif ($data['cek']->unitstatus_id == 5){
				#die("coba");		
				$this->load->view('sales/salesadminsardjito_view',$data);
					
			}else{
				#die("coba");		
				$this->load->view('sales/view_after',$data);
					
			}									
								
			
		}	
		
		function form_salesadmin_town($id){
			
			#die($id);
			
			/*$data['cek']= $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									->where('unit_id',$id)
									->get('db_unit_yogya')->row();	*/
	
	
			#Query edit abas
			
			$sql = "select a.unit_id,a.unit_pic,a.unit_no,a.view_unit,a.tanah,a.bangunan,a.pricelist_ppn,b.unitstatus_id,
					b.unitstatus_nm,d.customer_nama,c.reserved_tgl,f.nama as sales_nama,c.reserved_amount
					from db_unit_yogya a
					left join db_unitstatus b on (b.unitstatus_id = a.status_unit)
					left join db_reserved c on (c.id_unit = a.unit_id)
					left join db_customer d on (d.customer_id = c.id_customer)
					left join db_sp e on (e.id_unit = a.unit_id)
					left join db_kary f on (f.id_kary = c.id_sales)
					where unit_id = $id";
					
					$data['cek'] = $this->db->query($sql)->row();	
			// $data['cek']= $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									// ->join('db_reserved','id_unit = unit_id')
									// ->join('db_customer','customer_id = id_customer')
									// //->join ('db_kary','id_kary = id_sales') 
									// ->where('unit_id',$id)
									// ->get('db_unit_yogya')->row();

		//	vardump($data['cek']);exit();				
			if ($data['cek']->unitstatus_id == 1 and 5){
			$this->load->view('sales/salesadmintownunit_view',$data);
			
				}else{
					
			$this->load->view('sales/view_after',$data);
					
			}								
			
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
										->where('id_pt',$pt)
									//	->order_by('nm_subproject','ASC')
										->get('db_subproject')->result();
						break;
						
						
					case 'view' :
						if($pt == 44){
						$sql = $this->db->select('distinct view_unit id,view_unit nama')
				//						->join('db_unit_yogya','unit_no = id_unit')
										->where('id_subproject',$parent_id)
									//	->where('status_unit','3')
										->get('db_unit_yogya')->result();
						break;}
						else{
						$sql = $this->db->select('distinct view_unit id,view_unit nama')
				//						->join('db_unit_yogya','unit_no = id_unit')
										->where('id_subproject',$parent_id)
									//	->where('status_unit','3')
										->get('db_unit_bdm')->result();
						break;}	
					
				
						
					
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
		// function viewsalesadmin()
		// {
			// parent::AdminPage();
			// $this->pageCaption = 'Alokasi Status';
		// }
		
		// function index(){	
			// extract(PopulateForm());	
			
			// $session_id = $this->UserLogin->isLogin();
			// $pt = $session_id['id_pt'];
			// $data['proj'] = $this->db->where('id_pt',$pt)
									 // ->get('db_subproject')->result();
									 
			// // $data['view'] = $this->db->select('DISTINCT(view_unit)')
									 // // // ->where('id_subproject',$proj)
									 // // ->order_by('view_unit','ASC')
									// // ->get('db_unit_yogya')->result();		

			// if($pt == 44){
									 
			// $data['view'] = $this->db->select('DISTINCT(view_unit)')
									 // // ->where('id_subproject',$proj)
									 // ->order_by('view_unit','ASC')
									// ->get('db_unit_bdm')->result();	

			// }
			// elseif($pt = 11){
			
			// $data['view'] = $this->db->select('DISTINCT(view_unit)')
									 // // ->where('id_subproject',$proj)
									 // ->order_by('view_unit','ASC')
									// ->get('db_unit_yogya')->result();
			
			
			
			// }
			// #$data['sold'] = 
		// //	vardump($data['view']);exit;						 
			// $this->parameters['data'] = $data;
			// $this->loadTemplate('sales/salesadminstatus_view');
		// }
		
		// function view_salesadmin(){
			// extract(PopulateForm());	
			// if($proj=="--Pilih--")  die("Please Cek pilihan anda");
			// // $data['total'] = $this->db->select('count(unit_no) as status,
								// // sum(tanah) as land,sum(bangunan) as bgnan')
										  // // ->where('id_subproject',$proj)
										// // //  ->where('status_unit',1)
										  // // ->get('db_unit_yogya')->row();
										  
			// $session_id = $this->UserLogin->isLogin();
				// $pt = $session_id['id_pt'];
			
					// if($pt == 44){
			
						// $data['total'] = $this->db->select('count(unit_no) as status,
								// sum(tanah) as land,sum(bangunan) as bgnan')
										  // ->where('id_subproject',$proj)
										// //  ->where('status_unit',1)
										  // ->get('db_unit_yogya')->row();
					// }
					
					// elseif($pt = 11){
						
						// $data['total'] = $this->db->select('count(unit_no) as status,
								// sum(tanah) as land,sum(bangunan) as bgnan')
										  // ->where('id_subproject',$proj)
										// //  ->where('status_unit',1)
										  // ->get('db_unit_bdm')->row();
					// }
					
			// if($view=="ALL"){
			
			
				// $data['unit'] = $this->db->where('id_subproject',$proj)
										// // ->order_by('substring(unit_no,3,4)','ASC')
										 // ->order_by('unit_id','ASC')
										 // ->get('db_unit_yogya')->result();

				// $data['avaliable'] = $this->db->select('count(unit_no) as status,
								// sum(tanah) as land,sum(bangunan) as bgnan')
										  // ->where('id_subproject',$proj)
										  // ->where('status_unit',1)
										  // ->get('db_unit_yogya')->row();
										  
				// $data['reserved'] = $this->db->select('count(unit_no) as status,
								// sum(tanah) as land,sum(bangunan) as bgnan')
										  // ->where('id_subproject',$proj)
										  // ->where('status_unit',2)
										  // ->get('db_unit_yogya')->row();
										  
				// $data['sold'] = $this->db->select('count(unit_no) as status,
								// sum(tanah) as land,sum(bangunan) as bgnan')
										  // ->where('id_subproject',$proj)
										  // ->where('status_unit',3)
										  // ->get('db_unit_yogya')->row();
										  
									  	
										  									  
			// $data['na'] = $this->db->select('count(unit_no) as status,
								// sum(tanah) as land,sum(bangunan) as bgnan')
										  // ->where('id_subproject',$proj)
										  // ->where('status_unit',4)
										  // ->get('db_unit_yogya')->row();
			// //var_dump($data['na']);exit;	
										  										  										 										 
			// $data['pd'] = $this->db->select('count(unit_no) as status,
								// sum(tanah) as land,sum(bangunan) as bgnan')
										  // ->where('id_subproject',$proj)
										  // ->where('status_unit',5)
										  // ->get('db_unit_yogya')->row();										  										 										 
			// }else{
				
			// $data['avaliable'] = $this->db->select('count(unit_no) as status,
								// sum(tanah) as land,sum(bangunan) as bgnan')
										  // ->where('id_subproject',$proj)
										  // ->where('status_unit',1)
										  // ->where('view_unit',$view) 
										  // ->get('db_unit_yogya')->row();
										  
			// $data['reserved'] = $this->db->select('count(unit_no) as status,
								// sum(tanah) as land,sum(bangunan) as bgnan')
										  // ->where('id_subproject',$proj)
										  // ->where('status_unit',2)
										  // ->where('view_unit',$view) 
										  // ->get('db_unit_yogya')->row();
										  
			// $data['sold'] = $this->db->select('count(unit_no) as status,
								// sum(tanah) as land,sum(bangunan) as bgnan')
										  // ->where('id_subproject',$proj)
										  // ->where('status_unit',3)
										  // ->where('view_unit',$view) 
										  // ->get('db_unit_yogya')->row();
										  
									  	
										  									  
			// $data['na'] = $this->db->select('count(unit_no) as status,
								// sum(tanah) as land,sum(bangunan) as bgnan')
										  // ->where('id_subproject',$proj)
										  // ->where('status_unit',4)
										  // ->where('view_unit',$view) 
										  // ->get('db_unit_yogya')->row();
			// //var_dump($data['na']);exit;	
										  										  										 										 
			// $data['pd'] = $this->db->select('count(unit_no) as status,
								// sum(tanah) as land,sum(bangunan) as bgnan')
										  // ->where('id_subproject',$proj)
										  // ->where('status_unit',5)
										  // ->where('view_unit',$view) 
										  // ->get('db_unit_yogya')->row();		

				// $data['unit'] = $this->db->where('id_subproject',$proj)
										 // ->where('view_unit',$view) 
										 // ->order_by('unit_id','DESC')
										 // ->get('db_unit_yogya')->result();				
			// }

			// $lsunit1 = array("AT25","AT27","AT29","AT31","AT33",
							// "AT35","AT37","AT39","AT41");						
			// $lsunit2 = array("AT26","AT28","AT30","AT32","AT36","AT38",
			// "AT40","AT42","AT43");

			// $lsunit3 = array("AT22","AT20","AT18","AT16","AT12","AT10",
			// "AT08","AT06","AT02");
			
			// $lsunit4 = array("AT23","AT21","AT19","AT17","AT15","AT11",
			// "AT09","AT07","AT05","AT03","AT01");
							
													 
			// $data['unittown1'] = $this->db->where_in('unit_no',$lsunit1)
										 // ->get('db_unit_yogya')->result();
									
													 
			// $data['unittown2'] = $this->db->where_in('unit_no',$lsunit2)
										 // ->get('db_unit_yogya')->result();

			// $data['unittown3'] = $this->db->where_in('unit_no',$lsunit3)
										 // ->order_by('unit_no','DESC')
										 // ->get('db_unit_yogya')->result();

			// $data['unittown4'] = $this->db->where_in('unit_no',$lsunit4)
										  // ->order_by('unit_no','DESC')
										  // ->get('db_unit_yogya')->result();

									 
			// $this->parameters['data'] = $data;
			// if($proj=='41011'){
				// $this->loadTemplate('sales/salesadminunittown_view');
			// }elseif($proj=='41012'){
				// $this->loadTemplate('sales/salesadminunitcondotel_view');
			// }elseif($proj=='41013'){
				// $this->loadTemplate('sales/salesadminunitsardjito_view');
			// }else{
				// die("Belum Ada Gambar");
			// }			
		// }
		
		// function form_salesadmin_condotel($id){
			// /*
			 // #Query Production
			// $data['cek']= $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									// ->where('unit_id',$id)
									// ->get('db_unit_yogya')->row();	
			// */
			
			
			// #Query edit abas
			// $sql = "select a.unit_id,a.unit_pic,a.unit_no,a.view_unit,a.tanah,a.bangunan,a.pricelist_ppn,b.unitstatus_id,
					// b.unitstatus_nm,d.customer_nama,c.reserved_tgl,f.nama as sales_nama,c.reserved_amount
					// from db_unit_yogya a
					// left join db_unitstatus b on (b.unitstatus_id = a.status_unit)
					// left join db_reserved c on (c.id_unit = a.unit_id)
					// left join db_customer d on (d.customer_id = c.id_customer)
					// left join db_sp e on (e.id_unit = a.unit_id)
					// left join db_kary f on (f.id_kary = c.id_sales)
					// where unit_id = $id";
					
			// $data['cek'] = $this->db->query($sql)->row();		
			
			
			// /*$data['cek']= $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									// ->join('db_reserved','id_unit = unit_id')
									// ->join('db_customer','customer_id = id_customer')
									// //->join('db_sp','id_unit = db_unit_yogya.unit_id')
									// //->join('db_kary','id_kary = db_sp.id_sales')
									// ->where('unit_id',$id)
									// ->get('db_unit_yogya')->row();*/
				

			// if ($data['cek']->unitstatus_id == 1){
				// #die("test");
				// $this->load->view('sales/salesadmincondotelunit_view',$data);
			// }else{
				// #die("coba");		
				// $this->load->view('sales/view_after',$data);
					
			// }								
								
			
		// }	
		
		// function form_salesadmin_town($id){
			
			// #die($id);
			
			// /*$data['cek']= $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									// ->where('unit_id',$id)
									// ->get('db_unit_yogya')->row();	*/
	
	
			// #Query edit abas
			
			// $sql = "select a.unit_id,a.unit_pic,a.unit_no,a.view_unit,a.tanah,a.bangunan,a.pricelist_ppn,b.unitstatus_id,
					// b.unitstatus_nm,d.customer_nama,c.reserved_tgl,f.nama as sales_nama,c.reserved_amount
					// from db_unit_yogya a
					// left join db_unitstatus b on (b.unitstatus_id = a.status_unit)
					// left join db_reserved c on (c.id_unit = a.unit_id)
					// left join db_customer d on (d.customer_id = c.id_customer)
					// left join db_sp e on (e.id_unit = a.unit_id)
					// left join db_kary f on (f.id_kary = c.id_sales)
					// where unit_id = $id";
					
					// $data['cek'] = $this->db->query($sql)->row();	
			// // $data['cek']= $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									// // ->join('db_reserved','id_unit = unit_id')
									// // ->join('db_customer','customer_id = id_customer')
									// // //->join ('db_kary','id_kary = id_sales') 
									// // ->where('unit_id',$id)
									// // ->get('db_unit_yogya')->row();

		// //	vardump($data['cek']);exit();				
			// if ($data['cek']->unitstatus_id == 1 and 5){
			// $this->load->view('sales/salesadmintownunit_view',$data);
			
				// }else{
					
			// $this->load->view('sales/view_after',$data);
					
			// }								
			
		// }
		
			// function loaddata(){
			// #die($this->input->post('parent_id'));
			// if($this->input->post('data_type')){
				// $data_type = $this->input->post('data_type');
				// $parent_id = $this->input->post('parent_id');
				// $session_id = $this->UserLogin->isLogin();
				// $session_cus = $this->input->post('subproject');
				
				// $pt = $session_id['id_pt'];
				// $a=44;
				// //die($a);
				// switch($data_type){
					// case 'subproject':
						// $sql = $this->db->select('subproject_id id,nm_subproject nama')
										// ->where('id_pt',$pt)
									// //	->order_by('nm_subproject','ASC')
										// ->get('db_subproject')->result();
						// break;
						
						
					// case 'view' :
						// $sql = $this->db->select('distinct view_unit id,view_unit nama')
				// //						->join('db_unit_yogya','unit_no = id_unit')
										// ->where('id_subproject',$parent_id)
									// //	->where('status_unit','3')
										// ->get('db_unit_yogya')->result();
						// break;
				
						
					
				// }
				// $response = array();
				// if($sql){
					// foreach($sql as $row){
						// $response[] = $row;
					// }
				// }else{
					// $response['error'] = 'Data kosong';
				// }
				// die(json_encode($response));exit;
			// }
		// }
		
						
		
	}		
?>
