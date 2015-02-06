<?
	defined('BASEPATH') or die('Access Denied');
	
	class viewunitgrove_status extends AdminPage{

		function viewgrove()
		{
			parent::AdminPage();
			$this->pageCaption = 'Unit Status Grove Condotel';
		}
		
		function index(){	
			extract(PopulateForm());	
			
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];
			//$data['proj'] = $this->db->where('id_pt',$pt)
				//					 ->get('db_subproject')->result();
									 
			$data['view'] = $this->db->select('DISTINCT(view_unit)')
									 // ->where('id_subproject',$proj)
									 ->order_by('view_unit','ASC')
									->get('db_unit_grove')->result();							  
			#$data['sold'] = 
		//	vardump($data['view']);exit;						 
			$this->parameters['data'] = $data;
			//$this->loadTemplate('sales/unitgrovestatus_view');
			$this->loadTemplate('sales/unitgrovestatus_view');
		}
		
		function view_unitgrove(){
			//die('tes');
			extract(PopulateForm());	
			if($view=="--Pilih--")  die("Please Cek pilihan anda");
			$data['total'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  
										
										  ->get('db_unit_grove')->row();
					
			if($view=="All"){
			//die($view);
			
				$data['unit'] = $this->db->order_by('unit_no','ASC')
										 ->get('db_unit_grove')->result();
				//var_dump($data['unit']);exit();
				$data['avaliable'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  
										  ->where('status_unit',1)
										  ->get('db_unit_grove')->row();
										  
				$data['reserved'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  
										  ->where('status_unit',2)
										  ->get('db_unit_grove')->row();
										  
				$data['sold'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  
										  ->where('status_unit',3)
										  ->get('db_unit_grove')->row();
										  
									  	
										  									  
			$data['na'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										 
										  ->where('status_unit',4)
										  ->get('db_unit_grove')->row();
			//var_dump($data['na']);exit;	
										  										  										 										 
			$data['pd'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										 
										  ->where('status_unit',5)
										  ->get('db_unit_grove')->row();										  										 										 
			}else{
				
			$data['avaliable'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  
										  ->where('status_unit',1)
										  ->where('view_unit',$view) 
										  ->get('db_unit_grove')->row();
										  
			$data['reserved'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										  
										  ->where('status_unit',2)
										  ->where('view_unit',$view) 
										  ->get('db_unit_grove')->row();
										  
			$data['sold'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										
										  ->where('status_unit',3)
										  ->where('view_unit',$view) 
										  ->get('db_unit_grove')->row();
										  
									  	
										  									  
			$data['na'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										 
										  ->where('view_unit',$view) 
										  ->get('db_unit_grove')->row();
			//var_dump($data['na']);exit;	
										  										  										 										 
			$data['pd'] = $this->db->select('count(unit_no) as status,
								sum(tanah) as land,sum(bangunan) as bgnan')
										 
										  ->where('status_unit',5)
										  ->where('view_unit',$view) 
										  ->get('db_unit_grove')->row();		

				$data['unit'] = $this->db->where('id_subproject',3103)
										 ->where('view_unit',$view) 
										 ->order_by('unit_id','DESC')
										 ->get('db_unit_grove')->result();				
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
										 ->get('db_unit_grove')->result();
									
													 
			$data['unittown2'] = $this->db->where_in('unit_no',$lsunit2)
										 ->get('db_unit_grove')->result();

			$data['unittown3'] = $this->db->where_in('unit_no',$lsunit3)
										 ->order_by('unit_no','DESC')
										 ->get('db_unit_grove')->result();

			$data['unittown4'] = $this->db->where_in('unit_no',$lsunit4)
										  ->order_by('unit_no','DESC')
										  ->get('db_unit_grove')->result();

									 
			$this->parameters['data'] = $data;
			$this->loadTemplate('sales/salesadminunitgrove_view');
			/*
			if($proj=='41011'){
				$this->loadTemplate('sales/salesadminunittown_view');
			}elseif($proj=='41012'){
				$this->loadTemplate('sales/salesadminunitcondotel_view');
			}else{
				die("Belum Ada Gambar");
			}			
			*/
		}
		
		function form_salesadmin_condotel($id){
			/*
			 #Query Production
			$data['cek']= $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									->where('unit_id',$id)
									->get('db_unit_grove')->row();	
			*/
			
			
			#Query edit abas
			$sql = "select a.unit_id,a.unit_pic,a.unit_no,a.view_unit,a.tanah,a.bangunan,a.pricelist_ppn,b.unitstatus_id,
					b.unitstatus_nm,d.customer_nama,c.reserved_tgl,f.nama,c.reserved_amount
					from db_unit_grove a
					left join db_unitstatus b on (b.unitstatus_id = a.status_unit)
					left join db_reserved c on (c.id_unit = a.unit_id)
					left join db_customer d on (d.customer_id = c.id_customer)
					left join db_sp e on (e.id_unit = a.unit_id)
					left join db_kary f on (f.id_kary = c.id_sales)
					where unit_id = $id";
					
			$data['cek'] = $this->db->query($sql)->row();		
			
			
			/*$data['cek']= $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									->join('db_reserved','id_unit = unit_id')
									->join('db_customer','customer_id = id_customer')
									//->join('db_sp','id_unit = db_unit_grove.unit_id')
									//->join('db_kary','id_kary = db_sp.id_sales')
									->where('unit_id',$id)
									->get('db_unit_grove')->row();*/
				

			if ($data['cek']->unitstatus_id == 1){
				#die("test");
				$this->load->view('sales/salesadmincondotelunit_view',$data);
			}else{
				#die("coba");		
				$this->load->view('sales/view_aftergrove',$data);
					
			}								
								
			
		}	
		
		function form_grove($id){
			
			#die($id);
			
			$data['cek']= $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									->where('unit_id',$id)
									->get('db_unit_grove')->row();	
	
	/*
			#Query edit abas
			$data['cek']= $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									->join('db_reserved','id_unit = unit_id')
									->join('db_customer','customer_id = id_customer')
									->where('unit_id',$id)
									->get('db_unit_grove')->row();
	*/
		//	vardump($data['cek']);exit();				
			if ($data['cek']->unitstatus_id == 1 and 5){
			$this->load->view('sales/grove_view',$data);
			
				}else{
					
			$this->load->view('sales/view_aftergrove',$data);
					
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
										->where('id_pt','44')
									//	->order_by('nm_subproject','ASC')
										->get('db_subproject')->result();
						break;
						
						
					case 'view' :
						$sql = $this->db->select('distinct view_unit id,view_unit nama')
				//						->join('db_unit_grove','unit_no = id_unit')
										->where('id_subproject',$parent_id)
									//	->where('status_unit','3')
										->get('db_unit_grove')->result();
						break;
					case"sales":
						$sql = $this->db->select('nama id,nama nama')
										->where('id_karylvl',7)
										->where('id_divisi',12)
										->get('db_kary')->result();
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
		
		
		function updatestatus(){
			extract(PopulateForm());
			//die($unit);
			$amount = replace_numeric($amount);
			
			$query = $this->db->query("sp_Updatereservedgrove '".$unit."','".$aksi."','".$custnm."','".$sales."','".$amount."','".inggris_date($tgl)."'");
			//die("sukses");
		
			/*
			if ($aksi == 2 and $amount < 5000000){
				die("tidak boleh kurang dari Rp 5,000,000");
				
			}elseif($aksi == 5){
				$amount = 0;
				$query = $this->db->query("sp_UpdateReserved '".$unit."',".$amount."
				,'".@$custnm."','".$sales."','".$bayar."','".$lunas."','".$tgl."','".$ket."','".$aksi."'");				
				die("sukses");				
			}else {
				$query = $this->db->query("sp_UpdateReserved ".$unit.",".$amount."
				,".$custnm.",".$sales.",".$bayar.",".$lunas.",'".$tgl."','".$ket."','".$aksi."'");				
				die("sukses");
		
			}
		*/
			die("sukses");
		}			

		
						
		
	}		
?>
