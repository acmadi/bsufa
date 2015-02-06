<?php
class denda_customer extends DBController{
	function __construct(){
		parent::__construct('denda_customer_model');
		$this->set_page_title('Daftar Denda Pelanggan');
		$this->template_dir = 'finance/denda_customer';

	}

	protected function setup_form($data=false){
		$id_denda = @$data->denda_id;
		//$this->parameters['customer'] = $this->mstmodel->globalresult('db_customer');
		$this->parameters['customer'] = $this->db->order_by('customer_nama','ASC')
											     ->get('db_custprofil')->result();
		//var_dump($this->parameters['customer']);exit;
		$this->parameters['project'] = $this->db->order_by('nm_project','ASC')
												->get('project')->result();
		$this->parameters['cicilan'] = $this->db->where('cicilan_ceklist',1)
												->where('id_denda',$id_denda)
											    ->get('db_cicilan')->result();
		
		$this->parameters['data_cust'] = $this->db->join('db_denda','denda_id = id_denda')
												  ->join('db_custprofil','customer_id = id_customer')
												  ->where('id_denda',$id_denda)
												  ->get('db_cicilan')->row();
												  
		$this->parameters['nil_cil'] = $this->db->select_sum('cicilan_jml')
												 ->where('cicilan_ceklist',2)
												 ->where('id_denda',$id_denda)
												 ->get('db_cicilan')->row();
		 
	}

	function get_json(){
		$this->set_custom_function('denda_tglmulai','indo_date');
		$this->set_custom_function('denda_tglakhir','indo_date');
		$this->set_custom_function('denda_nilai','currency');
		$this->set_custom_function('denda_paid','currency');
		$this->set_custom_function('denda_balance','currency');
		parent::get_json();
	}
	
	
	function index(){
		$this->set_grid_column('denda_id','ID',array('hidden'=>true));
		$this->set_grid_column('customer_nama','Customer Name',array('width'=>95,'align'=>'Left'));
		$this->set_grid_column('nm_project','Project',array('width'=>120,'align'=>'Left'));
		$this->set_grid_column('denda_tglmulai','Start Date',array('width'=>50,'align'=>'center'));
		$this->set_grid_column('denda_tglakhir','End Date',array('width'=>50,'align'=>'center'));
		$this->set_grid_column('denda_persentase','%',array('width'=>15,'align'=>'center'));
		$this->set_grid_column('denda_top','Top',array('width'=>15,'align'=>'center'));
		$this->set_grid_column('denda_nilai','Total',array('width'=>60,'align'=>'right'));
		$this->set_grid_column('denda_paid','Paid',array('width'=>65,'align'=>'right'));
		$this->set_grid_column('denda_balance','Balance',array('width'=>60,'align'=>'right'));
		$this->set_grid_column('denda_periode','Periode',array('width'=>30,'align'=>'center'));
		$this->set_jqgrid_options(array('width'=>870,'height'=>300,'caption'=>'List Penalty Customer','rownumbers'=>true,'sortname'=>'denda_id','sortorder'=>'desc'));
		parent::index();
	}
	
	function cekdata($unit){		
		$data = $this->db->join('db_unit','id_unit = unit_no')
						 ->where('id_unit',$unit)
						 ->get('db_sales')->row();
		/*$xdata = array
		(
			'price' => $data->price_sales
		);
		var_dump($xdata);exit;		*/		 
		die(json_encode($data));
		
	}
	

		function loaddata(){
			#die($this->input->post('parent_id'));
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				$session_id = $this->UserLogin->isLogin();
				$pt = $session_id['id_pt'];
				
				switch($data_type){
					case 'customer':
						$sql = $this->db->select('customer_id id,customer_nama nama')
										->join('db_sales','id_customer = customer_id')
										->join('db_unit','id_unit = unit_no')
										->where('id_subproject',$parent_id)
										->order_by('customer_nama','ASC')
										->get('db_custprofil')->result();
						break;
					case 'unit' :
						$sql = $this->db->select('unit_no id,unit_no nama')
										->join('db_unit','unit_no = id_unit')
										->where('id_customer',$parent_id)
										->get('db_sales')->result();
						break;
					case 'customer_denda' :
						$sql = $this->db->select('distinct(customer_id) id,customer_nama nama')
										->join('db_custprofil','customer_id = id_customer')
										->where('id_project',$parent_id)
										->get('db_denda')->result();
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
						$sql = $this->db->select('distinct(db_denda.id_project) id,nm_subproject nama')
										->where('db_subproject.pt_id',$pt)
										->join('db_subproject','subproject_id = db_denda.id_project')
										->get('db_denda')->result();
					break;				
					case 'project':
					default:
					    $sql = $this->db->select('subproject_id id,nm_subproject nama')
										->where('pt_id',$pt)
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
	
	function masuk(){
		$nama = "reza";
		$email = "reza@yahoo.com";
		$query = $this->db->query("sp_insert_customer ".$nama.",".$email."");
	}
	function insert_denda(){
		extract(PopulateForm());
		$session_id = $this->UserLogin->isLogin();
		$pt = $session_id['id_pt'];
		$intamount = str_replace(",","",$amount);
		$ftglmulai = inggris_date($tgl_mulai);
		$fiom_date = inggris_date($iom_date);
		list($d,$m,$y) = split("-",$tgl_mulai);
		$chk_dt = $this->db->where('id_customer',$customer_id)
						   ->where('id_project',$project)
						   ->where('denda_periode',$periode)
						   ->get('db_denda')->num_rows();
		if($chk_dt > 0){
			$alert = "Data sudah ada";			
		}else{
			$data1 = array
			(
				'denda_nilai' => $intamount, 
				'denda_top' => $top,
				'denda_tglmulai' => $ftglmulai,
				'denda_persentase' => $persen,
				'denda_no_iom' => $iom_no,
				'denda_hargajual' => str_replace(",","",$sell),
				'denda_tgl_iom' => $fiom_date,
				'denda_unit' => $unit,
				'denda_paid' => 0, 
				'denda_periode' => $periode,
				'id_project' => $project,
				'id_customer' => $customer_id,
				'id_pt' => $pt
			);
		
			//simpan nilai di tabel denda
			$this->db->insert('db_denda',$data1);
			//tampilkan nomor untuk denda yang terakhir
			$dt = $this->db->order_by('denda_id','DESC')
					   ->get('db_denda')->row();
			$noakhir = $dt->denda_id;
			
			for($i = 1; $i <= $top; $i++){
				$jmldenda = $intamount/$top;
				$m1 = $m++;			
				if($m1 <= 12){
					$m1 = $m1;
					$n = 1;
					$thn = $y;
				}else{
					$jml = $m1 - $nil;
				if($jml==12){
					$n = $m1;
					$thn = $thn + 1;
					$m1 = 1;
				}else{
					$m1 = $m1 - $nil + 1;
				} 
				}
			
				$nil = $n;
				$thn = $thn;
				$tgldenda = $thn."-".$m1."-".$d;			
				$data2 = array 
				(
					'cicilan_tgl' => $tgldenda,
					'cicilan_jml' => $jmldenda,
					'cicilan_ceklist' => 1,
					'id_denda' => $noakhir
				);
				$this->db->insert('db_cicilan',$data2);
			}
			$alert = "sukses";			
		}
		die($alert);
		//redirect('denda_customer');
	}

	function cek_data(){
		$tgl_mulai = $this->input->post('tgl_mulai');
		$top = $this->input->post('top');
		$sell = str_replace(",","",$this->input->post('sell'));
		$jml = array();
		for($i=1;$i<=$top;$i++){
			$jml[] = 100000;
		}
		var_dump($jml);
	}
	
	function cekperiode(){
		$customer = $this->input->post('customer');
		$unit = $this->input->post('unit');
		$periode = $this->input->post('periode');
		$row = $this->db->where('denda_unit',$unit)
						->where('id_customer',$customer)
						->where('denda_periode',$periode)
						->get('db_denda')->num_rows();
		if($row > 0){
			$error = "Periode sudah ada";
		}else{
			$error = "Periode belum ada";
		}		
		 die($error);
	}
	
	function bayar_denda(){
		extract(PopulateForm());
		$jml = count($chk);
		for($i = 0; $i < $jml ; $i++){
			#Update Ceklist
			$data = array 
			(	
				'cicilan_ceklist' => 2,
				'cicilan_byr' => inggris_date($paid_date[$i])
			);			
			$this->db->where('cicilan_id',$chk[$i]);
			$this->db->update('db_cicilan',$data);	
		}

		#Update data di denda
		$xrow = $this->db->select_sum('cicilan_jml')
		                 ->where('cicilan_ceklist',2)
						 ->where('id_denda',$denda_id)
						 ->get('db_cicilan')->row();
		$xdata = array 
		(
			'denda_paid' => $xrow->cicilan_jml
		);
		$this->db->where('denda_id',$denda_id);
		$this->db->update('db_denda',$xdata);
		redirect('denda_customer');
	}

		
}

