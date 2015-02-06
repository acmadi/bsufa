<?
	defined('BASEPATH') or die('Access Denied');
	
	class sales_admin_status extends AdminPage{

		function unit_status()
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
			$this->loadTemplate('sales/unit_status');
		}
		
		function view_unit(){
			extract(PopulateForm());
			$data['unit'] = $this->db->where('id_subproject',$proj)
									 ->get('db_unit_yogya')->result();
			
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
				$this->loadTemplate('sales/view_unit_townhouse');
			}elseif($proj=='41012'){
				$this->loadTemplate('sales/view_unit_condotel');
			}else{
				die("Belum Ada Gambar");
			}
		}

		function alokasi_unit(){
			extract(PopulateForm());
			$sql = "select top 209 unit_no,id_statusunit,unit_id from db_unit";
			$data['unit'] = $this->db->query($sql)->result();
			$this->parameters['data'] = $data;		
			$this->loadTemplate('sales/alokasi_unit');	
		}

		function form_unit($id){
			$data['cek'] = $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									->where('unit_id',$id)
									->get('db_unit_yogya')->row(); 	
			$rows = $data['cek'];
			/*if($rows->status_unit==3){
				$data['ceksales'] = $this->db->join()
			}*/
														
			$this->load->view('sales/detail_condotel_unit',$data);
		}		

		function form_alokasi($id){
			$data['cek']= $this->db->where('unit_id',$id)
									->get('db_unit')->row();
									
			
			$this->load->view('sales/detailalokasi',$data);
		}
		
		#Alokasi Town House
		function form_alokasi_town($id){
			$data['town']= $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									->where('unit_id',$id)
									->get('db_unit_yogya')->row(); 						
			$this->load->view('sales/detail_town_alokasi',$data);
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
			if($amount < 5000000){
				die("tidak boleh kurang dari Rp 5,000,000");
			}else{
				$query = $this->db->query("sp_UpdateReserved ".$unit.",".$amount."
				,".$custnm.",".$sales.",".$bayar.",".$lunas.",'".$tgl."'");				
				die("sukses");
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
