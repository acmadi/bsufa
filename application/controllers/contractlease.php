<?php
class contractlease extends DBController{
	function __construct(){
		parent::__construct('contractlease_model');
		$this->set_page_title('List contractlease');
		$this->template_dir = 'leasing/contractlease';
		$this->default_limit = 17;
		$session_id = $this->UserLogin->isLogin();
		$this->user_account = $session_id['username'];
	}

	protected function setup_form($data=false){
		
	}
	
	
	function index(){
		$this->set_grid_column('id_kontrak','ID',array('hidden'=>true));
		$this->set_grid_column('no_kontrak_sewa','No.Contract',array('width'=>50,'align'=>'left','formatter' => 'cellColumn'));		
		$this->set_grid_column('tgl_mulai','Start Date',array('width'=>30,'formatter' => 'cellColumn'));
		$this->set_grid_column('tgl_buka','End Date',array('width'=>30,'formatter' => 'cellColumn'));
		$this->set_grid_column('hrg_meter','Total Leased',array('width'=>80,'formatter' => 'cellColumn'));
		//$this->set_grid_column('grace_period','Grace Period',array('width'=>50,'align'=>'left','formatter' => 'cellColumn'));
		$this->set_grid_column('customer_nama','Name',array('width'=>100,'align'=>'left','formatter' => 'cellColumn'));
		$this->set_jqgrid_options(array('width'=>1100,'height'=>300,'caption'=>'List Contract Leased','rownumbers'=>true,'sortname'=>'id_kontrak','sortorder'=>'desc'));
		parent::index();
	}
	
	function InsertCustomer(){
			extract(PopulateForm());
			$session_id = $this->UserLogin->isLogin();
			$idpt = $session_id['id_pt'];
			$iduser =  $session_id['id'];
			$status ='0';
			$idproject='1111';
			 
			
			$tglmulai=inggris_date($tglmulai);
			$tglopen=inggris_date($tglopen);
			



			
		
			$query = $this->db->query("SP_InputkontrakSewa '".$no_contract."','".$no_loo."','".$penyewa."',
			".$period.",'".$tglmulai."','".$tglopen."','".$nounit."',".replace_numeric($hrg_meter).",".$status.",".$iduser."");
			
		
			$sukses = 4;
			die(json_encode($sukses));
	}
	
	function saveinvoice(){
			extract(PopulateForm());
			$session_id = $this->UserLogin->isLogin();
			$idpt = $session_id['id_pt'];
			$iduser =  $session_id['id'];

		
			
			
			$tglopen=inggris_date($tglopen);
			

			 $q=$this->db->query("update db_kontrak_sewa set status=1, tgl_buka='".$tglopen."' WHERE id_loo='".$id_loo."'");

			
		
		
			$sukses = 4;
			die(json_encode($sukses));
	}
	
	function generateinvoice(){
			extract(PopulateForm());
			$session_id = $this->UserLogin->isLogin();
			$idpt = $session_id['id_pt'];
			$iduser =  $session_id['id'];

		
			
			
			$tglopen=inggris_date($tglopen);
			
	
			$query = $this->db->query("SP_saveinvoice '".$id_loo."'");
			
			
			$message = "Kepada Bpk. Jati Pamungkas\n
				
Dengan hormat,\n
Diberitahukan bahwa unit  ".$nounit." sudah diproses menjadi billing oleh pihak Markering\n
Demikian informasi ini kami sampaikan.\n
Terimakasih 
PT.Bakrie Swasakti Utama";			

//die($message);
			$this->email->from($this->from_app, $this->displayname_app);
			$list = array('jati@bsu.co.id','gunawan@bsu.co.id');
			$this->email->to($list);
			#$this->email->to('donsadat@gmail.com','erick@bsu.co.id');
			$this->email->subject($this->subject_app);
			$this->email->message($message);	
			$this->email->send();
			
		
			$sukses = 4;
			die(json_encode($sukses));
	}
	
	
	function renewalkontrak(){
			extract(PopulateForm());
			$session_id = $this->UserLogin->isLogin();
			$idpt = $session_id['id_pt'];
			$iduser =  $session_id['id'];

		
			
			
			$tglselesai=inggris_date($tglselesai);
			$tglmulai=inggris_date($tglmulai);
			
			$query = $this->db->query("SP_renewalkontrak '".$no_contract."','".$no_loo."',".$id_loo.",
			'".$tglmulai."','".$tglselesai."',".replace_numeric($hrg_meter).",".$iduser.",".$interval."");
			
			$message = "Kepada Bpk. Jati Pamungkas\n
				
Dengan hormat,\n
Diberitahukan bahwa unit  ".$nounit." sudah diproses menjadi billing oleh pihak Markering\n
Demikian informasi ini kami sampaikan.\n
Terimakasih 
PT.Bakrie Swasakti Utama";			

//die($message);
			$this->email->from($this->from_app, $this->displayname_app);
			//$list = array('jati@bsu.co.id','gunawan@bsu.co.id');
			$list = array('gunawan@bsu.co.id');
			$this->email->to($list);
			#$this->email->to('donsadat@gmail.com','erick@bsu.co.id');
			$this->email->subject($this->subject_app);
			$this->email->message($message);	
			$this->email->send();
		
			$sukses = 4;
			die(json_encode($sukses));
	}
	
	function UpdateCustomer(){
			//~ extract(PopulateForm());
			//~ $session_id = $this->UserLogin->isLogin();
			//~ $idpt = $session_id['id_pt'];
			//~ $iduser =  $session_id['id'];
			//~ $idflag ='1';
			//~ $idproject='1111';
			//~ $tgl=inggris_date($customertgllhr);
			//~ 
			//~ die($idkarysek);
			//~ 
			//~ $query = $this->db->query("UpdateCustomer '".$idfilter."','".$idgroup."','".$customernama."','".$tgl."',
			//~ '".$customertmptlhr."','".$idagama."','".$idkarysek."','".$customerstatus."','".$idprofesi."','".$customerhp."',
			//~ '".$customertlp."','".$customerfax."','".$idtipe."','".$idno."','".$email."','".$npwp."','".$idtipemedia."','".$idmedia."',
			//~ '".$idmotivie."','".$customeralamat1."','".$idnegara."','".$idpropinsi."','".$idkota."','".$kdpos."','".$customeralamat2."','".$idnegara1."','".$idpropinsi1."','".$idkota1."','".$kdpos1."','".$iduser."','".$idpt."','".$idflag."',
			//~ '".$idetnis."','".$fb."','".$twiter."','".$custcompnm."','".$idbisnis."','".$custcompalamat."','".$custcomphp."',
			//~ '".$custcompfax."','".$custcompnpwp."','".$id."'");
			//~ 
		//~ 
			//~ $sukses = 4;
			//~ die(json_encode($sukses));
	}
	
			function tampil($id){
			
				$row = "select d.customer_nama,b.nounit,b.luas,a.hrg_meter,c.nm_subproject from db_loo_sewa a
						JOIN db_unit_sewa b on a.nounit = b.id
						JOIN db_subproject c on b.kd_project = c.id_project
						JOIN db_customer d on a.id_customer = d.customer_id
						WHERE a.id =".$id."";
	
				$data = $this->db->query($row)->row_array();
			
				echo json_encode($data);
		
				}
	
	function show_manual(){
		
			
			$this->load->view("leasing/show_manual");
		}	
	
	function get_dg($id){

				//$cekid = $kode;
				$cekid = $id;
				
				
			// $doc_no = $this->db->select('trx_type id')
							   // ->where('doc_no',$cekid)
							   // ->get('db_apinvoice')->row();
							   
							
							
				$sql = $this->db->query("select  id, id_loo, kode, tahapan, freq, intvl, persen, fix_amount, tax, stamp, iduser, audit_date
													from db_payplan
													where id_loo='".$cekid."'")->result(); 
				//~ 
			 				 //~ 
		 
			$xtampil = array();	
			
			foreach($sql as $row){
				
			 $xtampil[] = array 
			 (
					
					'thp_bayar'=>$row->tahapan,
						'freq'=>$row->freq,
						'intvl'=>$row->intvl,
						//~ 'intvl_type'=>$intvl_type,
						'persen' => $row->persen,
						'fix_amount' => $row->fix_amount,
						'tax' => $row->tax,
						'stamp' => $row->stamp
				 );
			 }
				
		 die(json_encode($xtampil));
	//	}
	} 	
	
	function saveitem(){		
			
					
					$session_id = $this->UserLogin->isLogin();
					$idpt = $session_id['id_pt'];
					$iduser =  $session_id['id'];
					
					
					
					$thp_bayar = $_REQUEST['thp_bayar'];
					$desc = $_REQUEST['xacc_no'];
					//~ $descs = $_REQUEST['descs'];
					$freq = $_REQUEST['freq'];
					$intvl = $_REQUEST['intvl'];
					//~ $intvl_type = $_REQUEST['intvl_type'];
					$persen = $_REQUEST['persen'];
					$fix_amount = $_REQUEST['fix_amount'];
					$tax = $_REQUEST['tax'];
					$stamp = $_REQUEST['stamp'];
					
					
					//~ $input_user = $this->user_account;
					//~ $trxtype2 = $_REQUEST['xacc_no'];
					$kode = $_REQUEST['kodedet'];
					//~ $pp_id = $_REQUEST['pp_id'];
			
					$data = array
					(
						'thp_bayar'=>$thp_bayar,
						'freq'=>$freq,
						'intvl'=>$intvl,
						//~ 'intvl_type'=>$intvl_type,
						'persen' => $persen,
						'fix_amount' => $fix_amount,
						'tax' => $tax,
						'stamp' => $stamp
						
					
					);	


												
				$query = $this->db->query("sp_payplan  '".$thp_bayar."',".$kode.",'".$freq."','".$intvl."','".$persen."',".replace_numeric($fix_amount).",'".$tax."','".$stamp."','".$iduser."'");
											
				if ($kode == 0){
			
					 $id_other = $this->db->select_max('id')
									->get('db_payplan')->row();
					}else{
					$id_other = $this->db->select('id')
												 ->where('id',$kode)
												->get('db_payplan')->row();
					}
				
				
				
																			
					$xtampil = array 
				( 
					'thp_bayar'=>$desc,
					'xacc_no'=>$desc,
					'kodedet' =>$id_other->id,
					'freq'=>$freq,
					'intvl'=>$intvl,
						//~ 'intvl_type'=>$intvl_type,
					'persen' => $persen,
					'fix_amount' => $fix_amount,
					'tax' => $tax,
					'stamp' => $stamp
					

				);
					die(json_encode($xtampil));

			
			}
	
	
	
			function getdescs($id){
			extract(PopulateForm());
		
		    $data = $this->db->where('id',$id)
							->get('db_transaksi')->row_array();
			
			echo json_encode($data);
		

				
		}
	
	
			function loaddata(){
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
					
					$session_id = $this->UserLogin->isLogin();
					$idpt = $session_id['id_pt'];
					$iduser =  $session_id['id'];
					
				switch($data_type){
					case 'no_loo':
						//~ $sql = $this->db->select('subproject_id id,no_loo nama')
										//~ ->where('id_pt',$idpt)
										//~ ->get('db_subprojectg')
										//~ ->result();
						
						
						$row = "SELECT a.id as id,no_loo as nama FROM db_loo_sewa a
								JOIN db_unit_sewa b on a.nounit = b.id
								JOIN db_subproject c on b.kd_project = c.id_project
								WHERE c.id_pt =".$idpt." and a.status=0 and c.pt_id=12";
						$sql = $this->db->query($row)->result();		

						break;
						
						
					//~ case 'sub':
						//~ $sql = $this->db->select('id_luas id,sub nama')
										//~ ->where('kd_project',$parent_id)
										//~ ->get('db_luas_sewa')
										//~ ->result();
						//~ break;
						
					case 'thp_bayar':
							$sql = $this->db->select('id id,deskripsi nama')
										//->where('kd_project',$parent_id)
										->get('db_transaksi')
										->result();
						break;
					case 'tax':
							$sql = $this->db->select('id_tax id,tax_cd nama')
										->where('id_pt',11)
										->get('db_tax')
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

