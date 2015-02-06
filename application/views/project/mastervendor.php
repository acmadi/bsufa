<?php
	class masterVendor extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('masterVendor_model');
			$this->set_page_title('List Of Vendors');
			$this->default_limit = 30;
			$this->template_dir = 'accounting/mastervendor';
		}
		
		protected function setup_form($data=false){
			$this->parameters['lastid'] = $this->mstmodel->get_lastid("kd_supplier","pemasokmaster");
			$this->load->model('project_model','kdproj');
			$this->parameters['kd_project'] = $this->kdproj->project();
			$this->load->model('masterVendor_model','kdsup');
			$this->parameters['nm_supplier']=$this->kdsup->nama_supp();
		}
		
		function index(){
			#die("test");
			$this->set_grid_column('kd_supplier','Kode Supplier',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('nm_supplier','Nama Supplier',array('width'=>60));
			$this->set_grid_column('nm_project','Project',array('width'=>60));
			$this->set_grid_column('kdkel_usaha','Kelompok Usaha',array('width'=>30));
			$this->set_grid_column('alamat','Alamat',array('width'=>100));
			$this->set_jqgrid_options(array('width'=>1000,'height'=>200,'caption'=>'List Of Vendors','rownumbers'=>true));
			parent::index();
		}		
		
		function save(){
			extract(PopulateForm());
			if ($opt1=="PT")
				$opt=',PT';
			elseif($opt1=="CV")
				$opt=',CV';
			else
				$opt="";
			// STATUS : PENAGIH BARU --> save ke tabel pemasokmaster	
			$data = array
			(
				'kd_supplier'	=> $this->input->post('kd_supplier'),
				'kd_supp_gb' 	=> $this->input->post('kd_supp_gb'),
				'nm_supp_gb' 	=> strtoupper($this->input->post('nm_supplier').''.$opt),
				'nm_supplier' 	=> strtoupper($this->input->post('nm_supplier').''.$opt),
				'npwp'			=> $this->input->post('npwp'),
				'kontak' 		=> strtoupper($this->input->post('kontak')),
				'akte' 			=> strtoupper($this->input->post('akte')),
				'alamat' 		=> strtoupper($this->input->post('alamat')),
				'kota' 			=> strtoupper($this->input->post('kota')),
				'kodepos' 		=> $this->input->post('kodepos'),
				'telepon' 		=> $this->input->post('telepon'),
				'fax' 			=> $this->input->post('fax'),
				'user_input' 	=> $this->input->post('user_input'),
				'tgl_input' 	=> $tgl_input,
				'kd_project' 	=> $project,
				'kdkel_usaha' 	=> $this->input->post('kel_usaha'),
				'id_kelusaha' 	=> $this->input->post('kelusaha'),
			);
			// STATUS : PENAGIH BARU --> save ke tabel pemasok
			$data1 = array
			(
				//'kd_supplier'	=> $this->input->post('kd_supplier1'),
				'kd_supp_gb' 	=> $this->input->post('kd_supp_gb'),
				'nm_supp_gb' 	=> strtoupper($this->input->post('nm_supplier').''.$opt),
				'nm_supplier' 	=> strtoupper($this->input->post('nm_supplier').''.$opt),
				'npwp'			=> $this->input->post('npwp'),
				'kontak' 		=> strtoupper($this->input->post('kontak')),
				'akte' 			=> strtoupper($this->input->post('akte')),
				'alamat' 		=> strtoupper($this->input->post('alamat')),
				'kota' 			=> strtoupper($this->input->post('kota')),
				'kodepos' 		=> $this->input->post('kodepos'),
				'telepon' 		=> $this->input->post('telepon'),
				'fax' 			=> $this->input->post('fax'),
				'user_input' 	=> $this->input->post('user_input'),
				'tgl_input' 	=> $tgl_input,
				'kd_project' 	=> $project,
				'kdkel_usaha' 	=> $this->input->post('kel_usaha'),
				'id_kelusaha' 	=> $this->input->post('kelusaha'),
			);
			// STATUS : PENAGIH LAMA --> save ke tabel pemasok
			$data2 = array
			(
				//'kd_supplier'	=> $this->input->post('kd_supplier1'),
				'kd_supp_gb' 	=> $this->input->post('kd_supp_gb1'),
				'nm_supp_gb' 	=> strtoupper($this->input->post('nm_supplier1')),
				'nm_supplier' 	=> strtoupper($this->input->post('nm_supplier1')),
				'npwp'			=> $this->input->post('npwp'),
				'kontak' 		=> strtoupper($this->input->post('kontak')),
				'akte' 			=> strtoupper($this->input->post('akte')),
				'alamat' 		=> strtoupper($this->input->post('alamat')),
				'kota' 			=> strtoupper($this->input->post('kota')),
				'kodepos' 		=> $this->input->post('kodepos'),
				'telepon' 		=> $this->input->post('telepon'),
				'fax' 			=> $this->input->post('fax'),
				'user_input' 	=> $this->input->post('user_input'),
				'tgl_input' 	=> $tgl_input,
				'kd_project' 	=> $project,
				'kdkel_usaha' 	=> $this->input->post('kel_usaha'),
				'id_kelusaha' 	=> $this->input->post('kelusaha'),
			);
			$nm_supp=$this->input->post('nm_supplier');
			$nm_supp1=$this->input->post('nm_supplier1');
			$kd=$this->input->post('kd_supp_gb');
			$proj=$this->input->post('project');
			$idusaha=$this->input->post('kelusaha');
			$kd_supplier1=$this->input->post('kd_supplier1');
			if ($status=="BARU"){
				$select  = $this->mstmodel->getmstvendor($nm_supp);
				if ($select>0){
					echo"Gagal Tersimpan !! Nama Vendor  ".strtoupper($nm_supp)."  Sudah Ada";	
				}else{	
					echo"Tersimpan"	;	
					$this->db->insert('pemasokMaster',$data);
					$this->db->insert('pemasok',$data1);
				}
			}elseif( $status=="LAMA"){
				$select1 = $this->mstmodel->getproject($nm_supp1,$proj);
				if ($kd_supplier1=="pilih"){
						echo"Pilih Nama Penagih Terlebih Dahulu";
				}elseif($kd_supplier1!="pilih"){
					if ($select1>0){
						echo"Gagal Tersimpan !! Nama Vendor ".strtoupper($nm_supp1).
						" dengan Project ".strtoupper($proj)." dan Kelompok Usaha ".strtoupper($idusaha). " sudah ada";	
					}else{	
						echo"Tersimpan"	;	
						$this->db->insert('pemasok',$data2);
					}
				}
			}else{
				echo"PILIH STATUS TERLEBIH DAHULU";
			}
		}
		
		function data3($id){
			$session_id = $this->UserLogin->isLogin();
			//$pt = $session_id['id_pt'];
			$data3 = $this->db->where('kd_supplier',$id)
							  ->get('PemasokMaster')
							  ->row_array();
			echo json_encode($data3);
		}
		
		function loaddata(){
			#die($this->input->post('parent_id'));
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				#die($parent_id);
				switch($data_type){
					case 'kelusaha':
						$sql = $this->db->select('id_kelusaha id,kel_usaha nama')
										->where('kd_project',$parent_id)
										->get($data_type)->result();
						break;
					case 'project':
					default:
					    $sql = $this->db->select('kd_project id,nm_project nama')
										->get('project')->result();
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
		
	    function data4($id){
			$session_id = $this->UserLogin->isLogin();
			//$pt = $session_id['id_pt'];
			$data4 = $this->db->where('id_kelusaha',$id)
							  ->get('kelusaha')
							  ->row_array();
			echo json_encode($data4);
		}
	}
?>
