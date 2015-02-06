<?php
class loo extends DBController{
	function __construct(){
		parent::__construct('loo_model');
		$this->set_page_title('List Loo');
		$this->template_dir = 'leasing/loo';
		$this->default_limit = 17;
		$session_id = $this->UserLogin->isLogin();
		$this->user_account = $session_id['username'];
	}

	protected function setup_form($data=false){
			//~ $this->load->model('tenant_model','customer');
			//~ $id = @$data->customer_id;
			$this->parameters['sql'] = $this->db->query('sp_getnoloo')->row();
			
	}
	function get_json(){
			
			//~ $this->set_custom_function('tglsp','indo_date');
			$this->set_custom_function('hrg_meter','currency');
			$this->set_custom_function('hrg_tot','currency');
			parent::get_json();
		}
		
	
	function index(){
		$this->set_grid_column('id','ID',array('hidden'=>true));
		$this->set_grid_column('no_loo','No LOO',array('width'=>50,'align'=>'left','formatter' => 'cellColumn'));
		$this->set_grid_column('nama','Tenant',array('width'=>60,'formatter' => 'cellColumn'));
		$this->set_grid_column('nounit','No Unit',array('width'=>20,'formatter' => 'cellColumn'));
		$this->set_grid_column('luas','Sqm',array('width'=>20,'formatter' => 'cellColumn','align'=>'center'));
		$this->set_grid_column('hrg_meter','Price/Meter',array('width'=>30,'formatter' => 'cellColumn','align' => 'right'));
		$this->set_grid_column('hrg_tot','Total Leased',array('width'=>30,'align'=>'left','formatter' => 'cellColumn','align' => 'right'));
		$this->set_grid_column('nm_subproject','Project',array('width'=>50,'align'=>'left','formatter' => 'cellColumn'));
		//~ $this->set_grid_column('nm_project','Nm.Project',array('width'=>90));
		//~ $this->set_grid_column('unit_no','Unit',array('width'=>25));
		//~ $this->set_grid_column('customer_tlp2','HP',array('width'=>20));
		$this->set_jqgrid_options(array('width'=>1100,'height'=>300,'caption'=>'List Unit Leasing','rownumbers'=>true,'sortname'=>'a.id','sortorder'=>'desc'));
		parent::index();
	}
	
	function InsertLoo(){
			extract(PopulateForm());
			$session_id = $this->UserLogin->isLogin();
			$idpt = $session_id['id_pt'];
			$iduser =  $session_id['id'];
	
			//$tgl=inggris_date($customertgllhr);
			
			//die($period);
		
			$query = $this->db->query("SP_Inputloo ".$proj.",'".$noref."',".$function.",'".$tgl."',
			".$period.",".$nounit.",".replace_numeric($psm).",".replace_numeric($totlease).",".replace_numeric($depoleas).",".$tenant.",".replace_numeric($lpm).",
			".replace_numeric($deposc).",'".$tlp."',".replace_numeric($depotlp).",".$iduser.",'".$alamat."'");
			 
		
			 $sukses = 4;
			die(json_encode($sukses));
	}
	
	function UpdateLoo(){
			extract(PopulateForm());
			$session_id = $this->UserLogin->isLogin();
			$idpt = $session_id['id_pt'];
			$iduser =  $session_id['id'];
	
			//$tgl=inggris_date($customertgllhr);
			
			//die($period);
		
			$query = $this->db->query("SP_UpdateLoo '".$id."',".$proj.",'".$noref."',".$function.",'".inggris_date($tgl)."',
			".$period.",".$nounit.",".replace_numeric($psm).",".replace_numeric($totlease).",".replace_numeric($depoleas).",".$tenant.",".replace_numeric($lpm).",
			".replace_numeric($deposc).",'".$tlp."',".replace_numeric($depotlp).",".$iduser.",'".$alamat."','".$status."','".replace_numeric($sc_psm)."','".replace_numeric($sc_bln)."'");
			 
		
			 $sukses = 4;
			die(json_encode($sukses));
	}
	
	
		function show_unit($ref){
	//die($ref);
	
			
	
			$data['contract'] = $ref;

			$this->load->view("leasing/show_unit",$data);
		}	
	
	function get_dg($id){

				$cekid = $id;						
							
				$sql = $this->db->query("select  id, id_loo, kode, tahapan, freq, intvl, persen, fix_amount, tax, stamp, iduser, audit_date
													from db_payplan
													where id_loo='".$cekid."'")->result(); 
		 
			$xtampil = array();	
			
			foreach($sql as $row){
				
			 $xtampil[] = array 
			 (
						'project2'=>$row->tahapan,
						'unitno'=>$row->tahapan,
						'luas'=>$row->freq,
						'harga'=>$row->intvl,

				 );
			 }
				
		 die(json_encode($xtampil));
	//	}
	} 	
	
	
			function tampil($id){
			
				$data = $this->db->where('customer_id',$id)
							->get('db_customer')->row_array();
			
				echo json_encode($data);
		
				}
				
				function tampilluas($id){
			
				$data = $this->db->where('id',$id)
							->get('db_unit_sewa')->row_array();
			
				echo json_encode($data);
		
				}
				
			
			function cetakloo($id){
		
			$sql = 'SELECT a.id,a.status,a.no_loo,nm_subproject,c.id_project,b.nounit,b.luas,d.customer_nama,a.periode,a.hrg_meter,a.hrg_bln,a.depo_ls,
					a.depo_sc,a.depo_tlp,a.hrg_tot,b.id as idunit,d.customer_id,d.customer_alamat1,d.customer_tlp,d.trade_name,a.tgl_loo,a.fungsi,b.lantai
						FROM db_loo_sewa a 
							JOIN db_unit_sewa b on b.id = a.nounit
							JOIN db_subproject c on b.kd_project = c.id_project 
							JOIN db_customer d on a.id_customer = d.customer_id
							WHERE a.id ='.$id.'';
			
			$data['row'] = $this->db->query($sql)->row();
		//~ die($id);
			$this->load->view("leasing/print/print_loo",$data);		
				}
			
			
				
			function app($id){
			
			$session_id = $this->UserLogin->isLogin();
			$idpt = $session_id['id_pt'];
			
		
			
			$sql = 'SELECT a.id,a.status,a.no_loo,nm_subproject,c.id_project,b.nounit,b.luas,d.customer_nama,a.periode,a.hrg_meter,a.hrg_bln,a.depo_ls,
					a.depo_sc,a.depo_tlp,a.hrg_tot,b.id as idunit,d.customer_id		
						FROM db_loo_sewa a 
							JOIN db_unit_sewa b on b.id = a.nounit
							JOIN db_subproject c on b.kd_project = c.id_project 
							JOIN db_customer d on a.id_customer = d.customer_id
							WHERE a.id ='.$id.'';
			$data['data'] =  $this->db->query($sql)->row();
			
			$sql = 'SELECT * FROM db_subproject	WHERE id_pt ='.$idpt.'';
			$data['data1'] =  $this->db->query($sql)->result();
			
			$sql = "SELECT * FROM db_customer WHERE category ='rental'";
			$data['data2'] =  $this->db->query($sql)->result();
			
			$this->load->view('leasing/loo-app',$data);
			
	
		
				}
				
			function saveitem(){		
			
					
					$session_id = $this->UserLogin->isLogin();
					$idpt = $session_id['id_pt'];
					$iduser =  $session_id['id'];
					
					
					
					$project2 = $_REQUEST['project2'];
					$unitno = $_REQUEST['unitno'];
					$luas = $_REQUEST['luas'];
					$harga = $_REQUEST['harga'];
					$no_bgt = $_REQUEST['no_bgt'];
					
					
					
					// //~ $input_user = $this->user_account;
					// //~ $trxtype2 = $_REQUEST['xacc_no'];
					// $kode = $_REQUEST['kodedet'];
					// //~ $pp_id = $_REQUEST['pp_id'];
			
					// $data = array
					// (
						// 'thp_bayar'=>$thp_bayar,
						// 'freq'=>$freq,
						// 'intvl'=>$intvl,
						// //~ 'intvl_type'=>$intvl_type,
						// 'persen' => $persen,
						// 'fix_amount' => $fix_amount,
						// 'tax' => $tax,
						// 'stamp' => $stamp
						
					
					// );	


												
				$query = $this->db->query("sp_insertunitasign  '".$project2."',".$unitno.",'".$no_bgt."'");
											
				// if ($kode == 0){
			
					 // $id_other = $this->db->select_max('id')
									// ->get('db_payplan')->row();
					// }else{
					// $id_other = $this->db->select('id')
												 // ->where('id',$kode)
												// ->get('db_payplan')->row();
					// }
				
				
				
																			
					$xtampil = array 
				( 
					'project2'=>$project2,
					'unitno'=>$unitno,
					'luas' =>$luas,
					'harga'=>$harga				

				);
					die(json_encode($xtampil));

			
			}
			
			function getluas($id){
			extract(PopulateForm());
		
		    $data = $this->db->where('id',$id)
							->get('db_unit_sewa')->row_array();
			
			echo json_encode($data);
		

				
		}
	
	
			//~ function cetakloo($id){
			//~ 
				//~ echo "<script> alert ('tes');</script>";
		//~ 
				//~ }
	
			function loaddata(){
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
					
					$session_id = $this->UserLogin->isLogin();
					$idpt = $session_id['id_pt'];
					$iduser =  $session_id['id'];
					
				switch($data_type){
					case 'proj':
						$sql = $this->db->select('subproject_id id,nm_subproject nama')
										->where('id_pt',$idpt)
										->where('pt_id',12)
										->get('db_subproject')
										->result();
						break;
					case 'nounit':
						$sql = $this->db->select('id id,nounit nama')
										->where('kd_project',$parent_id)
										->where('status','1')
										->get('db_unit_sewa')
										->result();
						break;
					case 'project2':
						$sql = $this->db->select('subproject_id id,nm_subproject nama')
										->where('id_pt',$idpt)
										->where('pt_id',12)
										->get('db_subproject')
										->result();
						break;
					case 'unitno':
						$sql = $this->db->select('id id,nounit nama')
										->where('kd_project',$parent_id)
										->where('status','1')
										->get('db_unit_sewa')
										->result();
						break;
					case 'tenant':
						$sql = $this->db->select('customer_id id,customer_nama nama')
										->where('category','rental')
										->get('db_customer')
										->result();
						break;
					
					
				
				}
				$response = array();
				if($sql){
					foreach($sql as $row){
						$response[] = $row;
					}
				}
				die(json_encode($response));
			}
		}
	
}

