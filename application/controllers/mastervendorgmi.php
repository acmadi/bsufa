<?php
	class mastervendorgmi extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('masterVendorgmi_model');
			$this->set_page_title('List Of Vendors');
			$this->default_limit = 30;
			$this->template_dir = 'accounting/mastervendorgmi';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
		}
		
		protected function setup_form($data=false){
			$this->parameters['lastid'] = $this->mstmodel->get_lastid("kd_supplier","pemasokmaster");
			$this->load->model('project_model','kdproj');
			$this->parameters['kd_project'] = $this->kdproj->project();
			$this->load->model('masterVendorgmi_model','kdsup');
			$this->parameters['nm_supplier']=$this->kdsup->nama_supp();
		}
		
		function index(){
			$this->set_grid_column('kd_supplier','Kode Supplier',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('nm_supplier','Nama Supplier',array('width'=>60));
			$this->set_grid_column('supp_code','Kode Supplier',array('width'=>40));
			$this->set_grid_column('kdkel_usaha','Kelompok Usaha',array('width'=>30));
			$this->set_grid_column('alamat','Alamat',array('width'=>100));
			$this->set_grid_column('nm_project','Project',array('width'=>60));
			$this->set_jqgrid_options(array('width'=>1200,'height'=>400,'caption'=>'List Of Vendors','rownumbers'=>true));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}		
		
		function add_supp_code(){
			$data = $this->db->query("select * from pemasokmaster")->result();
			$new_no=1;
			foreach ($data as $row){
			$id = $row->kd_supplier;
						if($new_no<=9){
						$doc_no = "SUPP-0000".$new_no;
						}elseif($new_no<=99){
						$doc_no = "SUPP-000".$new_no;
						}elseif($new_no<=999){
						$doc_no = "SUPP-00".$new_no;
						}elseif($new_no<=9999){
						$doc_no = "SUPP-0".$new_no;
						}elseif($new_no<=99999){
						$doc_no = "SUPP-".$new_no;
						}
			$this->db->query("update pemasokmaster set supp_code='$doc_no' where kd_supplier='$id'");
			$new_no++;}
		}
		
		function save(){
			//die("tesr");
			extract(PopulateForm());
			$session_id = $this->UserLogin->isLogin();
			$user = $session_id['username'];
			$pt = $session_id['id_pt'];
			
			if ($opt1=="PT")
				$opt='PT.';
			elseif($opt1=="CV")
				$opt='CV.';
			else
				$opt="";
			// STATUS : PENAGIH BARU --> save ke tabel pemasokmaster	
			$data = array
			(
				'kd_supplier'	=> $this->input->post('kd_supplier'),
				'kd_supp_gb' 	=> $this->input->post('kd_supp_gb'),
				'nm_supp_gb' 	=> $opt.''.$this->input->post('nm_supplier'),
				'nm_supplier' 	=> $opt.''.$this->input->post('nm_supplier'),
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
				'kdkel_usaha' 	=> $kel_usaha,
				'id_kelusaha' 	=> $kelusaha,
				'jns_usaha' 		=> $this->input->post('opt1')
			);
			// STATUS : PENAGIH BARU --> save ke tabel pemasok
			$data1 = array
			(
				//'kd_supplier'	=> $this->input->post('kd_supplier1'),
				'kd_supp_gb' 	=> $this->input->post('kd_supp_gb'),
				'nm_supp_gb' 	=> $opt.''.$this->input->post('nm_supplier'),
				'nm_supplier' 	=> $opt.''.$this->input->post('nm_supplier'),
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
				'kdkel_usaha' 	=> $kel_usaha,
				'id_kelusaha' 	=> $kelusaha,
				'jns_usaha' 		=> $this->input->post('opt1')
				
			);
			// STATUS : PENAGIH LAMA --> save ke tabel pemasok
			$data2 = array
			(
				//'kd_supplier'	=> $this->input->post('kd_supplier1'),
				'kd_supp_gb' 	=> $this->input->post('kd_supp_gb1'),
				'nm_supp_gb' 	=> $opt.''.$this->input->post('nm_supplier'),
				'nm_supplier' 	=> $opt.''.$this->input->post('nm_supplier'),
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
				'kdkel_usaha' 	=> $kel_usaha,
				'id_kelusaha' 	=> $kelusaha,
				'jns_usaha' 		=> $this->input->post('opt1')
			);
			$nm_supp=$this->input->post('nm_supplier');
			$nm_supp1=$this->input->post('nm_supplier1');
			$kd=$this->input->post('kd_supp_gb');
			$proj=$this->input->post('project');
			$idusaha=$this->input->post('kelusaha');
			$jnsusaha=$this->input->post('opt1');
			$kd_supplier1=$this->input->post('kd_supplier1');
			if ($status=="BARU"){
				$select  = $this->mstmodel->getmstvendor($nm_supp,$proj);
				if ($select>0){
					echo"Gagal Tersimpan !! Nama Vendor  ".strtoupper($nm_supp)."  Sudah Ada";	
				}else{	
					echo"Tersimpan"	;	
					$query = $this->db->query("sp_Insertmastervendor ".$kd_supplier.",'".$nm_supplier."','".$npwp."','".$kontak."','".$akte."','".$alamat."',
					'".$kota."','".$kodepos."','".$telepon."','".$fax."','".$user."','".$project."','".$kel_usaha."',".$kelusaha.",'".$opt1."',".$pt."");
					//$this->db->insert('pemasokMaster',$data);
					//$this->db->insert('pemasok',$data1);
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
						//$this->db->insert('pemasok',$data2);
						$query = $this->db->query("sp_Insertmastervendor_exit ".$kd_supp_gb1.",'".$nm_supplier1."','".$npwp."','".$kontak."','".$akte."','".$alamat."',
						'".$kota."','".$kodepos."','".$telepon."','".$fax."','".$user."','".$project."','".$kel_usaha."',".$kelusaha.",'".$opt1."',".$pt."");
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
				
				$session_id = $this->UserLogin->isLogin();
				$this->user = $session_id['username'];
				$this->pt	= $session_id['id_pt'];
				
				
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				#die($parent_id);
				switch($data_type){
					case 'project':
					default:
					    $sql = $this->db->select('subproject_id id,nm_subproject nama')
										->where('pt_id',$this->pt)
										->get('db_subproject')->result();
					
						break;
					case 'kelusaha':
						$sql = $this->db->select('id_kelusaha id,kel_usaha nama')
										->where('kd_project',$parent_id)
										->get('db_kelusaha')->result();
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
				die(json_encode($response));
			}
		}
		
	    function data4($id){
			#$session_id = $this->UserLogin->isLogin();
			//$pt = $session_id['id_pt'];
			$data4 = $this->db->where('id_kelusaha',$id)
							  ->get('db_kelusaha')
							  ->row_array();
			echo json_encode($data4);
		}
	}
?>
