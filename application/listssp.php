<?php
class listssp extends DBController{
	function __construct(){
		parent::__construct('listssp_model');
		$this->set_page_title('List SSP');
		$this->template_dir = 'tax/listssp';
		$this->default_limit = 30;
		$session_id = $this->UserLogin->isLogin();
		$this->user = $session_id['id'];
	
	}


	protected function setup_form($data=false){
		//var_dump($data->listssp_id);exit;
		/*$this->parameters['view']= $this->db->select('listssp_id,npwp,namawp,alamatwp,nop,
						kd_akunpajak,kd_jenissetor,jenissetoran,jml_byr,
						bln_masapajak,thn_masapajak,nm_ttdwp')
							->join('db_akunpajak a','a.id_akunpajak = c.akunpajak_id')	
							->join('db_jenissetoran b','c.id_setor = b.setor_id')
							->where('id_akunpajak',@$data->listssp_id)
							->get('db_listssp c')->row();*/
		$this->parameters['view'] = $this->db->join('db_akunpajak b','b.id_akunpajak = a.akunpajak_id','left')
											 ->join('db_jenissetoran c','c.setor_id = a.id_setor','left')
											 ->where('listssp_id',@$data->listssp_id)
											 ->get('db_listssp a')->row();
		
		$this->parameters['akunpjk'] = $this->db->select('kd_akunpajak,id_akunpajak,uraian_akunpajak')
									->order_by('kd_akunpajak','ASC')
									->get('db_akunpajak')
									->result();
		#$this->parameters['data'] = $data; 
			#var_dump($data['akunpjk']);
		
		//$data['jnssetor']->$this->db->get('db_jenissetoran')->row();
		#$this->parameters['kodecoa'] = $this->mstmodel->get_coa($coa);
	}

	function get_json(){
		//$this->set_custom_function('kwtbill_paydate','indo_date');
		//$this->set_custom_function('jml_byr','number_format');		
		
		
		parent::get_json();
	}



	function index(){
		$this->set_grid_column('listssp_id','ID',array('width'=>30));
		$this->set_grid_column('namawp','Nama WP',array('width'=>30,'align'=>'left'));		
		$this->set_grid_column('npwp','NPWP',array('width'=>30,'align'=>'center'));
		$this->set_grid_column('nop','NOP',array('width'=>30,'align'=>'center'));		
		$this->set_grid_column('kd_akunpajak','Kode Akun Pajak',array('width'=>30,'align'=>'center'));		
		$this->set_grid_column('kd_jenissetor','Jenis Setoran',array('width'=>30,'align'=>'center'));		
		$this->set_grid_column('jenissetoran','Uraian',array('width'=>30,'align'=>'left'));		
		$this->set_grid_column('jml_byr','Jumlah Pembayaran',array('width'=>30,'align'=>'center'));
		$this->set_grid_column('bln_masapajak','Bulan',array('width'=>30,'align'=>'center'));
		$this->set_grid_column('thn_masapajak','Tahun',array('width'=>30,'align'=>'center'));
		$this->set_grid_column('nm_ttdwp','Jumlah Pembayaran',array('width'=>30,'align'=>'center'));
		$this->set_jqgrid_options(array('width'=>1200,'height'=>350,'caption'=>'List SSP','rownumbers'=>true,'sortname'=>'listssp_id','sortorder'=>'desc'));
		parent::index();
	}
	
	function insertssp(){
		extract(PopulateForm());
		
		
		//die($npwp);
		$query = $this->db->query("sp_InsertSSP '".$npwp."','".$namawp."','".$alamatwp."',
				'".$nop."','".$alamatnop."','".$noketap."','".$jupem."','".$uraianpem."','".$blnmspjk."','".$thnmspjk."',
				'".$tempatttdwp."','".$tglttdwp."','".$nmjls."','".$kdakun."','".$jnskode."'");
		die("sukses");
	}
	
	function data($id){
		//die('tes');
		/*$data = $this->db->join('db_jenissetoran','id_jenissetor = jenissetor_id','left')
						 ->where('id_akunpajak',$id)
						 ->get('db_akunpajak')
						 ->row();*/
						# var_dump($data);exit;
		$data = $this->db->select('jenissetoran,ket_jenissetor')
						 ->where('setor_id',$id)
						 ->get('db_jenissetoran')
						 ->row();
	
						
		/*$xdata = array 
		(
		
			'kdakun' => $data->jenissetoran,
			/*'kdjns' => $data->kd_jenissetor,
			'uraianpem' => $data->jenissetoran*/
			
		//);			

		die(json_encode($data));
		
		}
		



		function loaddata(){
			#die($this->input->post('parent_id'));
			#die("test");
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				$session_id = $this->UserLogin->isLogin();
				$pt = $session_id['id_pt'];
				
				
				switch($data_type){
					case 'jnskode':
					#var_dump($parent_id );exit;
						$sql = $this->db->select("akunpajak_id id,convert(varchar,kd_jenissetor) + ' (' + ket_jenissetor +')' nama")
						 ->join('db_jenissetoran','id_akunpajak = akunpajak_id','left')
						 ->where('id_akunpajak',$parent_id)
						 ->get('db_akunpajak')
						 ->result();
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
	
		/*function view($id){
		//die('tes');
		$data['view'] = $this->db->select('listssp_id,npwp,namawp,alamatwp,nop,kd_akunpajak,kd_jenissetor,jenissetoran,jml_byr,bln_masapajak,thn_masapajak,nm_ttdwp')
					->join('db_akunpajak a','a.id_akunpajak = c.akunpajak_id')	
					->join('db_jenissetoran b','c.id_setor = b.setor_id')	
				->get('db_listssp c')->row();
		//parent::view();
		//var_dump($data['view']);exit();		
		//$this->parameters['data'] = $data; 
		//$this->load->view(listssp-view,$data);
		
		}*/
		function reprintssp($id){
		include_once( APPPATH."libraries/translate_currency.php");		
		$data['cekdt'] = $this->db->query("sp_tampil_ssp ".$id)->row();						  
		//$this->load->view('sales/rkwprint',$data);
		$this->load->view('sales/printssp',$data);
	} 
}

