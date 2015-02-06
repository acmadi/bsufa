<?php
class pengalihan extends DBController{
	function __construct(){
		parent::__construct('pengalihan_model');
		$this->set_page_title('List pengalihan');
		$this->template_dir = ('marketing/pengalihan');
		$this->default_limit = 30;
		$session_id = $this->UserLogin->isLogin();
		$this->user_account = $session_id['username'];
	}

protected function setup_form($data=false){

		$this->parameters['project'] =$this->db->select('subproject_id,nm_subproject')
																	->where('id_pt','44')
																	->get('db_subproject')->result();
		$this->parameters['pengalihancust']  = $this->db->select('customer_id,customer_nama')
																		->where('id_pt','44')
																		->order_by('customer_nama','asc')
																	->get('db_customer')->result();
		
		#$this->parameters['kodecoa'] = $this->mstmodel->get_coa($coa);
	}
	
	

	function index(){
		
		
		$this->set_grid_column('id_pengalihancustomer','ID',array('hidden'=>true));
		$this->set_grid_column('proyek','Proyek',array('width'=>45,'align'=>'left','formatter' => 'cellColumn'));
		$this->set_grid_column('unit','Unit',array('width'=>30,'formatter' => 'cellColumn'));
		$this->set_grid_column('tanggal_pengalihan','Tanggal Pengalihan',array('width'=>105,'formatter' => 'cellColumn'));
		$this->set_grid_column('nama_pemilik_lama','Nama Pemilik Lama',array('width'=>110,'formatter' => 'cellColumn'));
		$this->set_grid_column('nama_pemilik_baru','Nama Pemilik Baru',array('width'=>110,'formatter' => 'cellColumn'));
		$this->set_grid_column('biaya_adm','Biaya ADM',array('width'=>75,'formatter' => 'cellColumn'));
		$this->set_grid_column('pajak_pengalihan','Pajak Pengalihan',array('width'=>110,'formatter' => 'cellColumn'));
		$this->set_jqgrid_options(array('width'=>1250,'height'=>300,'caption'=>'List Pengalihan','rownumbers'=>true,'sortname'=>'id_pengalihancustomer','sortorder'=>'desc'));
		parent::index();
	}

	 function insertpengalihan(){
		extract(PopulateForm());	
			


		
			$query = $this->db->query("inputpengalihancustomer '".$idcust."','".$nosp."','".$project."','".$unit."','".$tanggalpengalihan."','".$namapemiliklama."',
			'".$alamatsurat."','".$telp."','".$namapemilikbaru."','".$alamatsurat1."',
			'".$telp1."','".$biayaadm."','".$pajakpengalihan."','".$saksibsu."','".$saksipnj."'");
		
		//die('sukses');
		$sukses = 4;
			die(json_encode($sukses));
			
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
					case 'project':
						$sql = $this->db->select('subproject_id id,nm_subproject nama')
										->where('id_pt','44')
									//	->order_by('nm_subproject','ASC')
										->get('db_subproject')->result();
						break;
						
						
					case 'unit' :
						$sql = $this->db->select('unit_no id,unit_no nama')
									      ->join('db_sp','id_unit = unit_id','left')
									      ->where('db_unit_yogya.id_subproject',$parent_id)
											->where('status_unit','3')
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
	
	function data($id){
		//die($id);
		/*$data = $this->db->join('db_jenissetoran','id_jenissetor = jenissetor_id','left')
						 ->where('id_akunpajak',$id)
						 ->get('db_akunpajak')
						 ->row();*/
						# var_dump($data);exit;
		// select unit_id,no_sp,unit_no,customer_nama,customer_alamat1,customer_tlp
// from db_unit_yogya a 
// right join db_sp b on b.id_unit = a.unit_id
// left join c on c.customer_id = b.id_customer

		$data = $this->db->select('unit_id,no_sp,sp_id,unit_no,customer_id,customer_nama,customer_alamat1,customer_tlp')
						 ->join(' db_sp b','b.id_unit = a.unit_id','right')
						 ->join(' db_customer c','c.customer_id = b.id_customer','left')
						 ->where('unit_no',$id)
						 ->where('b.id_flag',1)
						 ->get('db_unit_yogya a')
						 ->row();
		//var_dump($data);
			
		/*$xdata = array 
		(
		
			'kdakun' => $data->jenissetoran,
			/*'kdjns' => $data->kd_jenissetor,
			'uraianpem' => $data->jenissetoran*/
			
		//);			

		die(json_encode($data));
		
		}
		
		
	function datax($id){
	//	die($id);
		extract(PopulateForm());	
		/*$data = $this->db->join('db_jenissetoran','id_jenissetor = jenissetor_id','left')
						 ->where('id_akunpajak',$id)
						 ->get('db_akunpajak')
						 ->row();*/
						# var_dump($data);exit;
		
		//var_dump($data);
		$datax = $this->db->select('customer_id,customer_nama,customer_alamat1,customer_tlp')
						->where('customer_id',$id)
						->where('id_pt','44')
						->order_by('customer_nama','ASC')
						->get('db_customer')
						->row();				
		// $datax =  $this->db->select('unit_id,no_sp,unit_no,customer_id,customer_nama,customer_alamat1,customer_tlp')
						 // ->join(' db_sp b','b.id_unit = a.unit_id','left')
						 // ->join(' db_customer c','c.customer_id = b.id_customer','left')
						 // ->where('unit_id',$id)
						 // ->get('db_unit_yogya a')
						 // ->row();	
			// $datax = $this->db->select('customer_nama,cu')
			//				  ->
		
		/*$xdata = array 
		(
		
			'kdakun' => $data->jenissetoran,
			/*'kdjns' => $data->kd_jenissetor,
			'uraianpem' => $data->jenissetoran*/
			
		//);			

		die(json_encode($datax));
		
		}
		

	
}


		

