<?
	defined('BASEPATH') or die('Access Denied');
	
	class viewsalesadminunit_status extends AdminPage{

		function viewsalesadminunit_status()
		{
			parent::AdminPage();
			$this->pageCaption = 'Status Unit';
		}
		
			
		function index(){	
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];			
			$data['proj'] = $this->db->where('id_pt',$pt)
									 ->get('db_subproject')->result();
			$this->parameters['data'] = $data;
			$this->loadTemplate('sales/salesadminstatus_view');
		}
		
		function view_salesadminunit(){
			extract(PopulateForm());
			$data['unit'] = $this->db->where('id_subproject',$proj)
									 ->get('db_unit_yogya')->result();
			
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
										 ->get('db_unit_yogya')->result();

			$data['unittown4'] = $this->db->where_in('unit_no',$lsunit4)
										 ->get('db_unit_yogya')->result();


			$this->parameters['data'] = $data;



			if($proj=='41011'){
				$this->loadTemplate('sales/salesadminunittown_view');
			}elseif($proj=='41012'){
				$this->loadTemplate('sales/salesadminunitcondotel_view');
			}else{
				die("Belum Ada Gambar");
			}
		}

		function salesadmin(){
			extract(PopulateForm());
			$sql = "select top 209 unit_no,id_statusunit,unit_id from db_unit";
			$data['unit'] = $this->db->query($sql)->result();
			$this->parameters['data'] = $data;		
			$this->loadTemplate('sales/salesadminstatus_view');	
		}

		function form_salesadminunit($id){
			$data['cek'] = $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									->where('unit_id',$id)
									->get('db_unit_yogya')->row(); 	
			
			$rows = $data['cek'];
			/*if($rows->status_unit==3){
				$data['ceksales'] = $this->db->join()
			}*/
														
			$this->load->view('sales/detail_condotel_unit',$data);
		}		

		function form_salesadmin_condotel($id){
			/*$data['cek']= $this->db->where('unit_id',$id)
									->get('db_unit')->row();
			*/
			#Query edit abas
			$data['cek']= $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									->join('db_reserved','id_unit = unit_id')
									->join('db_customer','customer_id = id_customer')
									->where('unit_id',$id)
									->get('db_reserved')->row();						
			
			$this->load->view('sales/detailalokasi',$data);
		}
		
		#Alokasi Town House
		function form_salesadmin_town_town($id){
			$data['town']= $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									->where('unit_id',$id)
									->get('db_unit_yogya')->row(); 						
			$this->load->view('sales/detail_town_sales',$data);
		}		
		
		function cekprice(){
			$unit = $this->input->post('unit');
			$paytipe = $this->input->post('paytipe');
			$paytipepl = $this->input->post('paytipepl');
			$rows = $this->db->where('id_unit',$unit)
							 ->where('id_paytipe',$paytipe)
							 ->where('id_paytipepl',$paytipepl)
							 ->where('phase',1)
							 ->get('db_unitprice')->row();
			$nilai = number_format($rows->pricelist_ppn);
			echo(@$nilai);
		}

		function loaddata(){
			#die($this->input->post('parent_id'));
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				$session_id = $this->UserLogin->isLogin();
				$pt = $session_id['id_pt'];
				
				
				switch($data_type){
					case "bayarku":
						$sql = $this->db->select('paytipe_id id,paytipe_nm nama')
										->get('db_paytipe')->result();

					break;
					case "lunas":
						$sql = $this->db->select('paytipepl_id id,paytipe_pl nama')
										->where('id_paytipe',$parent_id)
										->get('db_paytipepl')->result();					
					break;
					case "type":
						$sql = $this->db->select('tipecustomer_id id,tipecustomer_nm nama')
										->get('db_tipecustomer')->result();
					break;
					case "custnm":
						$sql = $this->db->select('customer_id id,customer_nama nama')
										->where('fu_stat',$parent_id)
										->get('db_customer')->result();					
					break;
					case"sales":
						$sql = $this->db->select('id_kary id,nama nama')
										->where('id_karylvl',7)
										->where('id_divisi',12)
										->order_by('nama','ASC')
										->get('db_kary')->result();
					break;	
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
				die(json_encode($response));
			}
		}

		
		function updatestatus(){
			extract(PopulateForm());
			$amount = replace_numeric($amount);
			$lunas=0;
			$bayar=0;
			
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];	
		
			if ($aksi == 2 and $amount < 5000000){
				die("tidak boleh kurang dari Rp 5,000,000");
				
			}elseif($aksi == 5){
				$amount = 0;
				$query = $this->db->query("sp_UpdateReserved '".$unit."',".$amount."
				,'".@$custnm."','".$sales2."','".$bayar."','".$lunas."','".$tgl."','".$ket."','".$aksi."','".$pt."'");		
				die("sukses");				
			}else {
				$query = $this->db->query("sp_UpdateReserved ".$unit.",".$amount."
				,".$custnm.",".$sales.",".$bayar.",".$lunas.",'".$tgl."','".$ket."','".$aksi."','".$pt."'");				
				die("sukses");
			redirect("sales/viewsalesadmin_status/view_salesadmin");
			}
	/*$data = array 
			(
				'id_statusunit'=> $status
			);
			
			$this->db->where('unit_id',$unit);
			$this->db->update('db_unit',$data);*/
			die("sukses");
		}			


		
	}		
?>
