<?
	defined('BASEPATH') or die('Access Denied');
	
	class viewmgtunit_status extends AdminPage{

		function viewunitmgt_status()
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
			$this->loadTemplate('sales/mgtstatus_view');
		}
		
		function viewmgtunit(){
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
				$this->loadTemplate('sales/mgtunittown_view');
			}elseif($proj=='41012'){
				$this->loadTemplate('sales/mgtunitcondotel_view');
			}else{
				die("Belum Ada Gambar");
			}
		}

		function mgt(){
			extract(PopulateForm());
			$sql = "select top 209 unit_no,id_statusunit,unit_id from db_unit";
			$data['unit'] = $this->db->query($sql)->result();
			$this->parameters['data'] = $data;		
			$this->loadTemplate('sales/mgtstatus_view');	
		}

		function form_mgtunit($id){
			$data['cek'] = $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									->where('unit_id',$id)
									->get('db_unit_yogya')->row(); 	
			$rows = $data['cek'];
			
			/*if($rows->status_unit==3){
				$data['ceksales'] = $this->db->join()
			}
			select customer_nama,pay_amount,balance_amount from db_billing 
join db_sp on id_sp = sp_id
join db_customer on id_customer = customer_id
where id_unit = '53'

					*/						
			$this->load->view('sales/detail_condotel_unit',$data);
		}		

		function form_mgt_condotel($id){
			$data['cek']= $this->db->where('unit_id',$id)
									->get('db_unit')->row();
									
			$data['minta'] = $this->db->select('customer_nama','pay_amount','balance_amount','selling_price')
								  ->join('db_sp','sp_id = id_sp')
								  ->join('db_customer','customer_id = id_customer')
								  ->where('id_unit',$id)
								  ->get('db_billing')->row();
			$rows = $data['minta'];
			//var_dump($data['minta']);exit();
			$this->load->view('sales/mgtcondotelunit_view',$data);
		}
		
		#Alokasi Town House
		function form_mgt_town($id){
			$data['town']= $this->db->join('db_unitstatus','unitstatus_id = status_unit')
									->where('unit_id',$id)
									->get('db_unit_yogya')->row(); 	
			
			$data['minta'] = $this->db->select('customer_nama','pay_amount','balance_amount','selling_price')
								  ->join('db_sp','sp_id = id_sp')
								  ->join('db_customer','customer_id = id_customer')
								  ->where('id_unit',$id)
								  ->get('db_billing')->row();
			$rows = $data['minta'];					
			$this->load->view('sales/detail_town',$data);
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
		
		function updatestatusbintaro(){
			extract(PopulateForm());
			/*$amount = replace_numeric($amount);
			$lunas=0;
			$bayar=0;
			if($amount < 5000000){
				die("tidak boleh kurang dari Rp 5,000,000");
			}else{
				$query = $this->db->query("sp_UpdateReserved ".$unit.",".$amount."
				,".$custnm.",".$sales.",".$bayar.",".$lunas.",'".$tgl."'");				
				die("sukses");
			}*/
			
			//die($cek->unit_no);
			//die($unit_id);
			$data = array(
			'status_unit'=>$upstat
			);
			//die($unitstatus);
			if($unitstatus == 3){
				die("Unit Telah Terjual");
				
				#$this->loadTemplate('sales/mgtunitcondotel_view');
			}elseif($upstat == 1){
				$this->db->where('unit_id',$unit);
				$this->db->update('db_unit_bdm',$data);
				#$this->loadTemplate('sales/mgtunitcondotel_view');
				die("sukses");
			}elseif($upstat == 4){
				$this->db->where('unit_id',$unit);
				$this->db->update('db_unit_bdm',$data);
				die("sukses");
			}else{
				die ("data salah");	
			}
			
			/*$data = array 
			(
				'id_statusunit'=> $status
			);
			
			$this->db->where('unit_id',$unit);
			$this->db->update('db_unit',$data);*/
			//die("sukses");
		}		

		
		function updatestatus(){
			extract(PopulateForm());
			/*$amount = replace_numeric($amount);
			$lunas=0;
			$bayar=0;
			if($amount < 5000000){
				die("tidak boleh kurang dari Rp 5,000,000");
			}else{
				$query = $this->db->query("sp_UpdateReserved ".$unit.",".$amount."
				,".$custnm.",".$sales.",".$bayar.",".$lunas.",'".$tgl."'");				
				die("sukses");
			}*/
			
			//die($cek->unit_no);
			//die($unit_id);
			$data = array(
			'status_unit'=>$upstat
			);
			//die($unitstatus);
			if($unitstatus == 3){
				die("Unit Telah Terjual");
				
				#$this->loadTemplate('sales/mgtunitcondotel_view');
			}elseif($upstat == 1){
				$this->db->where('unit_id',$unit);
				$this->db->update('db_unit_yogya',$data);
				#$this->loadTemplate('sales/mgtunitcondotel_view');
				die("sukses");
			}elseif($upstat == 4){
				$this->db->where('unit_id',$unit);
				$this->db->update('db_unit_yogya',$data);
				die("sukses");
			}else{
				die ("data salah");	
			}
			
			/*$data = array 
			(
				'id_statusunit'=> $status
			);
			
			$this->db->where('unit_id',$unit);
			$this->db->update('db_unit',$data);*/
			//die("sukses");
		}		

		function resume(){
		#die("tes");
		$this->load->view("sales/viewresumebintaro_view");
		}
		
	}		
?>
