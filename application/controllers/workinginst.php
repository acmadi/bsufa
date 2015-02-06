<?php
	class workinginst extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('workinginst_model');
			$this->set_page_title('Contract Agreement');
			$this->default_limit = 30;
			$this->template_dir = 'project/workinginst';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->pt = $session_id['id_pt'];
		}
		
		protected function setup_form($data=false){
			$this->parameters['tender'] = $this->db->select('id_tendeva,no_tendeva')
													   ->where('isnull(id_flag,0)','1')
													   ->get('db_tendeva')->result();

			#$this->parameters['pph'] = $this->db->select('pph')->get('db_tax')->result();
			//var_dump($this->parameters['pph']);exit;

			$this->parameters['kontrak'] = $this->db->select('id_kontrak,no_spk,no_kontrak,pph')
													->where('id_kontrak',@$data->id_kontrak)
													->get('db_kontrak')->row();
													
			$this->parameters['tender'] = $this->db->select('id_detailjob,detail_job,qty,unit,price,total_price')
												   ->where('id_kontrak',@$data->id_kontrak)
												   ->get('db_detailjob')->result();
												   
			$this->parameters['prevalue'] = $this->db->select('sum(claim_amount) as nilai')
												   ->where('id_kontrak',@$data->id_kontrak)
												   ->get('db_cjc')->row();
												   
			$kontrak = @$data->id_kontrak;
			$this->parameters['progress'] = $this->db->query("sp_prevprog ".$kontrak."")->row();
												   
			#$this->parameters['prop'] = $this->db->select('sum(isnull(pph,0)) as prop_pph,
			#										sum(isnull(ppn,0)) as prop_ppn,
			#										sum(isnull(paynet,0)) as paynet,
			#										sum(isnull(claim_amount,0)) as prop_amount')
			#										 ->where('id_payspk',@$data->id_kontrak)
			#										 ->where('pemby_id',2)
			#										 ->get('db_cjc')->row();
			
			
			#$this->parameters['dp'] = $this->db->select('isnull(sum(claim_amount),0) as paiddp')
			#										 ->where('id_payspk',@$data->id_kontrak)
			#										 ->where('pemby_id',1)
			#										 ->get('db_cjc')->row();
			
			#$this->parameters['nildp'] = $this->db->select('dp')
			#										 ->where('id_kontrak',@$data->id_kontrak)
			#										 #->where('pemby_id',1)
			#										 ->get('db_kontrak')->row();
													
			$no = 1;
			$proj = 14101;										
			$this->parameters['cjc_no'] = $this->db->query("sp_cekcjcno ".$no.",".$proj."")->row();
			$this->parameters['payspk'] = $this->db->select('*')
												   ->where('nospk',@$data->no_spk)
												   ->order_by('id_payspk','asc')
												   ->get('db_payspk')->result();
												
		}	
		
		
		function get_json(){
			$this->set_custom_function('contract_amount','currency');
			$this->set_custom_function('adendum','currency');
			$this->set_custom_function('deduction','currency');
			$this->set_custom_function('start_date','indo_date');
			$this->set_custom_function('end_date','indo_date');
			parent::get_json();
		}						
		
		function index(){
			$this->set_grid_column('id_kontrak','id',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('lunas','lunas',array('hidden'=>true,'width'=>60,'formatter' => 'cellColumn'));
			$this->set_grid_column('no_spk','Reff SPK',array('hidden'=>true,'width'=>60,'formatter' => 'cellColumn'));
			$this->set_grid_column('start_date','Start Date',array('width'=>15,'formatter' => 'cellColumn','align'=>'center'));
			$this->set_grid_column('no_kontrak','Contract.No',array('width'=>35,'formatter' => 'cellColumn'));
			//$this->set_grid_column('nm_subproject','Mainjob',array('width'=>30));
			$this->set_grid_column('nm_supplier','Contractor',array('width'=>25,'formatter' => 'cellColumn'));
			$this->set_grid_column('mainjob_desc','Mainjob',array('width'=>80,'formatter' => 'cellColumn'));
			
			$this->set_grid_column('end_date','End Date',array('hidden'=>true,'width'=>30,'formatter' => 'cellColumn'));
			$this->set_grid_column('contract_amount','Contract Amount',array('width'=>20,'align'=>'right','formatter' => 'cellColumn'));
			//$this->set_grid_column('adendum','Addendum',array('width'=>30,'formatter' => 'cellColumn'));
			//$this->set_grid_column('deduction','Deduction',array('width'=>30,'formatter' => 'cellColumn'));
			$this->set_grid_column('id_flag','Flag',array('width'=>50,'hidden'=>true,'formatter' => 'cellColumn'));				
			$this->set_jqgrid_options(array('width'=>1200,'height'=>350,'caption'=>'Contract Agreement','rownumbers'=>true));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}		
		
		
		function getdata($id){
			$sql = $this->db->query("SP_Tampilspkrow ".$id."")->row(); 
			die(json_encode($sql));
			
			

		}
		
		function getproject($id){
			
			$query = $this->db->select('distinct(id_subproject) as subproject')
					->join('db_trbgtproj b ','a.job = b.main_job')
					->where('id_tendeva',$id)
					->get('db_tendeva a')->row();
			die(json_encode($query));	 
		
		
		}
		
		
		function save(){
			extract(PopulateForm());
			$ppn_amount = replace_numeric($ppn) ;
			$pph_amount = replace_numeric($pph) ;
			$dp_amount = replace_numeric($dp) ;
			$pt = $this->pt;
			$progress_amount = replace_numeric($progress);
			$retensi_amount = replace_numeric($retension);
			$contract_amount =  replace_numeric($amcontr);
			$tgl_awal = inggris_date($tgl_awal);
			$tgl_akhir = inggris_date($tgl_akhir);
			$project = "41011";
			
			//Insert SPK Project
			$sql = $this->db->query("sp_InsSpkproj ".$reftender.",'".$tgl_awal."'
			,'".$tgl_akhir."','".inggris_date($tgl)."',".$ppn_amount.",".$pph_amount.",".$dp_amount.",".$progress_amount."
			,".$retensi_amount.",".$contract_amount.",'".$nm1."','".$nm2."','".$position1."','".$position2."','".$project."',".$pt.",'".$spk."'");
			
			redirect("spk");
			//die("sukses");
			//$this->load->view('project/print/print_spk');	
			
			
		}
		
		function saveprop(){
			extract(PopulateForm());
			$data = array 
			(
				'id_flag' =>2
			);
			$this->db->where('id_kontrak',$id_kontrak);
			$this->db->update('db_kontrak',$data);
			redirect('workinginst');
		}
		
		
		function updatecin(){
			extract(PopulateForm());
			$data = array 
			(
				'no_kontrak' => $no_contr
			);
			$this->db->where('id_kontrak',$id_kontrak);
			$this->db->update('db_kontrak',$data);
			redirect('workinginst');		
		}
		
		function print_spk($id){
			die("test");
		}
		
		function update($id){
			$cek = $this->db->select("no_kontrak")
							->where('id_kontrak',$id)
							->get('db_kontrak')->row();
							//var_dump($cek);exit;
			
			if(@$cek->no_kontrak != " "){
			echo"
				<script type='text/javascript'>
					alert('Contract sudah di buat');
					refreshTable();
				</script>
			";				
			}else{
				parent::update($id);
			}
			//var_dump($cek);exit;
		}
		
		function approve($id){
			$cek = $this->db->select("no_kontrak,id_flag")
							->where('id_kontrak',$id)
							->get('db_kontrak')->row();
							
			if(@$cek->id_flag == 2){
			echo"
				<script type='text/javascript'>
					alert('Approval sudah di buat');
					refreshTable();
				</script>
			";					
			}else{
				parent::approve($id);
			}
			
		}
		
		
		function get_topspk($no,$dir,$pt,$bln,$thn){
			
			$data['nospk'] = $no."/".$dir."/".$pt."/".$bln."/".$thn;
			
			$sql = $this->db->select('*')
							->where('nospk',$data['nospk'])
							->order_by('id_payspk','asc')
							->get('db_payspk')->result();
			
			
			
			
			$data = array();
			foreach($sql as $row){
			
			$query = $this->db->select('sum(claim_amount) as nilai')
								->where('id_payspk',$row->id_payspk)
								
								->get('db_cjc')->row();
			$top = $row->tipe_payspk;
			
			if($top == 1){ $top = 'DP';}
			elseif ($top == 2){ $top = 'Progress';}
			elseif($top == 3){ $top = 'Retensi';}
			
			$blc = $row->amount - $query->nilai;
			
				$data[] = array
				(
					'top'=>$top,
					'persen'=>$row->persen,
					'amount' =>number_format($row->amount),
					'claim' => number_format($query->nilai),
					'blc'=>number_format($blc),
					'keterangan'=>$row->ket_spk
					
				);
			}
			die(json_encode($data));exit;				
		}
		
		function cancel($id){
	
		$cekflag = $this->db->select("id_flag as flag")
							  ->where("id_kontrak",$id)
							  ->get("db_kontrak")->row();

						  
			if($cekflag->flag == 10){
				echo"
					<script type='text/javascript'>
						alert('Kontrak sudah Di Cancel');
						refreshTable();
					</script>
				";					
			}else{
		$data['id'] = $id;
		$this->load->view('project/cancelkontrak-cancel',$data);
		//}
		
	}
	}
		
		function ok(){
		$session_id = $this->UserLogin->isLogin();
		$this->user = $session_id['username'];
		$this->pt = $session_id['id_pt'];
		$user=$this->user;
		extract(PopulateForm());	
		$this->db->query("sp_batalkontrak '".$id."','".$no_void."','".$ket."','".$user."'");
		// echo"
					// <script type='text/javascript'>
						// alert('Cancel Kontrak Sukses');
						// refreshTable();
					// </script>
				// ";		
		die('Cancel Kontrak Sukses');

	}
	
	function dropdown(){
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->pt = $session_id['id_pt'];
		
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				switch($data_type){
					case 'project':
						$sql = $this->db->select('subproject_id id,nm_subproject nama')
										->where('id_pt',$this->pt)
										->get('db_subproject')
										->result();
						break;
					case 'addbgt':
						$sql = $this->db->select('kode_bgtproj id,nm_bgtproj nama')
									  ->where('id_subproject',$parent_id)
									  ->group_by('nm_bgtproj')
									  ->group_by('kode_bgtproj')
									  ->get('db_bgtproj_update')->result();
						
		
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

		
		
		
		
		function mapping($id){
			$cekdt = $this->db->select("id_lunas as lunas")
							  ->where("id_kontrak",$id)
							  ->get("db_kontrak")->row();
							  
		#	$contr = $this->db->select ('contract_amount as kontrak')
		#						->where ("id_kontrak",$id)
		#						->get("db_kontrak")->row();
			$lunas = $cekdt->lunas; 
		#	$kontrak = $contr->kontrak; 
							  
			if($lunas == 1){
				echo"
					<script type='text/javascript'>
						alert('Tidak bisa buat cjc,Claim sudah 100 %');
						refreshTable();
					</script>
				";					
			}else{
				parent::mapping($id);

			}
			
		}
	
	}

