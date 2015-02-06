<?php
	class tender extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('tendereval_model');
			$this->set_page_title('Tender Project Budget');
			$this->default_limit = 30;
			$this->template_dir = 'project/tendereval';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->divisi = $session_id['divisi_id'];
			$this->pt = $session_id['id_pt'];
			$this->id = $session_id['id'];
			$this->parent = $session_id['id_parent'];
		}
		
		protected function setup_form($data=false){
			$this->parameters['divisi'] = $this->db->get('db_divisi')->result();
			$this->parameters['refbudget'] = $this->db->select('no_trbgtproj,mainjob_id,mainjob_desc')
													  ->where('isnull(id_flag,0)',1)
													  ->order_by('no_trbgtproj','asc')->get('db_mainjob')->result();
			$this->parameters['tendwin'] = $this->db->order_by('nm_supplier','asc')->get('pemasokmaster')->result();
			$this->parameters['vendor1'] = $this->db->order_by('vendor_nm','asc')->get('db_vendor')->result();
			$this->parameters['vendor'] = $this->db->select('vendor_nm,participant_id,vendor_id,offer_ven,score_ven,remark_ven')
												   ->join('db_vendor','vendor_id = id_vendor')
												   ->get('db_participant')->result();
												   
												   
			 $this->parameters['tender'] =  @$this->db->where('id_tendeva',$data->id_tendeva)
													->get('db_detailjob')->result();
													
			 $this->parameters['satuan'] = $this->db->select('satuan')
													->get('satuan')->result();
													
			$this->parameters['detailjob'] = $this->db->select('detail_job,qty,unit,price,total_price')
													  ->where('id_tendeva',@$data->id_tendeva)
													  ->get('db_detailjob')->result();
			
			$divisi = $this->divisi;
			$pt = $this->pt;
			$qcek = $this->db->query("sp_cek_tender_no ".$divisi.",".$pt."")->row();										  
			$this->parameters['no_tender'] = $qcek->no_ten; 								  
													  
													  													
													

			
		}
		
		function get_json(){
			$this->set_custom_function('nilai_tender','currency');
			parent::get_json();
		}
		
		function data($id){
			$data = $this->db->select('kode_bgtproj,nm_bgtproj,nilai_bgtproj')
							 ->where ('id_bgtproj',$id)
							 ->get('db_bgtproj')
							 ->row();							
			die(json_encode($data));
		
		}
		
		function get_participant($id){
			$sql = $this->db->select('nm_supplier,offer_ven,nego_ven,score_ven,remark_ven')
							->join('pemasokmaster','id_vendor = kd_supp_gb')
							->where('id_mainjob',$id)
							->get('db_participant')->result();
							
			$data =array();
			foreach($sql as $row){
				$data[] = array 
				(
					'contractor'=>$row->nm_supplier,
					'offering'=>$row->offer_ven,
					'nego'=>$row->nego_ven,
					'score'=>$row->score_ven,
					'remark'=>$row->remark_ven
				);
			}
			
			die(json_encode($data));
							
		}
		
		
		function get_bgt($ref){
			
			
			$data['ref'] = $ref;
			
			$sql = $this->db->where('main_job',$ref)
							->get('db_trbgtproj')->result();
			
			$data = array();
			foreach($sql as $row){
				$data[] = array
				(
					'job'=>$row->job,
					'nilai_proposed'=>$row->nilai_proposed,
					'nilai_approved'=>$row->nilai_approved,
					#'price'=>$row->price,
					#'total'=>$row->total_price
				);
			}
			die(json_encode($data));exit;				
		}
		
		function index(){
			$this->set_grid_column('id_tendeva','',array('hidden'=>true,'width'=>20));
			$this->set_grid_column('no_trbgtproj','Budget Reff',array('width'=>60,'formatter' => 'cellColumn'));
			$this->set_grid_column('no_tendeva','Tendereval Reff',array('width'=>60,'align'=>'right','formatter' => 'cellColumn'));
			$this->set_grid_column('job','Job',array('width'=>40,'formatter' => 'cellColumn'));
			$this->set_grid_column('nilai_tender','Tender Amount',array('width'=>30,'align'=>'right','formatter' => 'cellColumn'));
			$this->set_grid_column('nm_supplier','Tender Winner',array('width'=>30,'formatter' => 'cellColumn'));
			$this->set_grid_column('id_flag','Flag',array('width'=>50,'hidden'=>true,'formatter' => 'cellColumn'));			
			$this->set_jqgrid_options(array('width'=>1000,'height'=>200,'caption'=>'Tender Budget Project','rownumbers'=>true));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}	
		

		function show_form($xref){
			$index = $_GET['index'];
			$data['xref'] = $xref;
			$data['vendor'] = $this->db->select('kd_supp_gb,nm_supplier')
									   ->order_by('nm_supplier','ASC')
									   ->get('pemasokmaster')->result();
			$this->load->view("project/show_form",$data);
		}
		
		function showmr_form($ref){
			$index = $_GET['index'];
			$data['ref'] = $ref;
			$data['satuan'] = $this->db->select('satuan')->get('satuan')->result();
			$data['vendor'] = $this->db->select('id_detailjob,detail_job')
									   ->get('db_detailjob')->result();
			$this->load->view("project/showmr_form",$data);
		}		
		

		function getdata($id){
			extract(PopulateForm());
			$row1 = $this->db->where('mainjob_id',$id)
							 ->get('db_mainjob')->row();
							 
							 
			
			$data = array 
			(
				'job' => $row1->mainjob_desc,
				'amount' => $row1->mainjob_total,
				'mainjob_id' => $row1->mainjob_id,
				'no_trbgtproj' => $row1->no_trbgtproj,
				'mainjob_desc' => $row1->mainjob_desc
			);
							 
			die(json_encode($data));exit;
		}
		
		
		function save(){
			extract(PopulateForm());
			$user = $this->id;
			$pt = $this->pt;
			$tgl = inggris_date($tgl);
			
			
			//Insert Data Ke Tender
			$sql = $this->db->query("sp_Instenderproj ".$mainjob_id.",'".$tgl."','".$jobnm."',
			'".$tendwin."',".$user.",".$pt.",'".$no_ten."'");
			
			redirect('tendereval');
			//die("sukses");
			//Cek data Semuanya
			//$this->load->view('project/print/cetaktender');					
			/*if($sql){
				die("sukses");
			}*/
			
		}
		
		
		function save_app(){
			extract(PopulateForm());
			if($aksi == "Approve"){
				$data = array 
				(
					'id_flag' => 1
				);
				$this->db->where('id_tendeva',$idtender);
				$this->db->update('db_tendeva',$data);		
			}else{
				$data = array 
				(
					'id_flag' => 3
				);
				$this->db->where('id_tendeva',$idtender);
				$this->db->update('db_tendeva',$data);
				
			}
			redirect("tendereval");
		}
		
		
		
					
		
		
		//Print Tender
		
		function print_tender($id){ 
			$data['id_ten'] = $id;
			$this->load->view('project/print/cetaktender',$data);
		}
		function cekdata_dg(){
			$data = array();
			$sql = $this->db->where('id_trbgtproj','')
							->get('db_participant')->result();
			foreach($sql as $row){
				$data[] = $row;
			}
			die(json_encode($data));exit;
		}
		
		function save_dg(){
			$contractor = $_REQUEST['contractor'];
			$offering = $_REQUEST['offering'];
			$nego = $_REQUEST['nego'];
			$score = $_REQUEST['score'];
			$remark = $_REQUEST['remark'];
			$id_mainjob = $_REQUEST['id_mainjob'];
			//$id = intval($_REQUEST['id']);
			//echo $id;
			
			$data = array 
			(
				'offer_ven' => replace_numeric($offering),
				'nego_ven' => replace_numeric($nego),
				'score_ven' => $score,
				'remark_ven' => $remark,
				'id_vendor' => $contractor,
				'id_mainjob' => $id_mainjob
			);
			

			$this->db->insert('db_participant',$data);			
			
			//Cek Kontraktor Nama
			$qcek = $this->db->select('nm_supplier')
							 ->where('kd_supp_gb',$contractor)
							 ->get('pemasokmaster')->row();
							 
					  
							 
			$xtampil = array 
				(
					 'contractor' => $qcek->nm_supplier,
					 'offering' => $offering,
					 'nego' => $nego,
					 'score' => $score ,
					 'remark' => $remark,
					 'id_mainjob'	=> $id_mainjob,
					 'id' => 130 				
				);
			die(json_encode($xtampil));
		}
		
		
		function update_dg(){
			$contractor = $_REQUEST['contractor'];
			$offering = $_REQUEST['offering'];
			$nego = $_REQUEST['nego'];
			$score = $_REQUEST['score'];
			$remark = $_REQUEST['remark'];
			$id_trbgt = $_REQUEST['id_trbgt'];
			$id = intval($_REQUEST['id']);
			//echo $id;
			
			$data = array 
			(
				'offer_ven' => replace_numeric($offering),
				'nego_ven' => replace_numeric($nego),
				'score_ven' => $score,
				'remark_ven' => $remark,
				'id_vendor' => $contractor,
				'id_trbgtproj' => $id_trbgt
			);
			
			$this->db->where('participant_id', $id);
			$this->db->update('db_participant', $data);
			
			//Cek Kontraktor Nama
			$qcek = $this->db->select('nm_supplier')
							 ->where('kd_supp_gb',$contractor)
							 ->get('pemasokmaster')->row();
			$xtampil = array 
				(
					 'contractor' => $qcek->nm_supplier,
					 'offering' => $offering,
					 'nego' => $nego,
					 'score' => $score ,
					 'remark' => $remark,
					 'id_trbgt'	=> $id_trbgt 				
				);
			die(json_encode($xtampil));			
						
		}
		
		/*Pengecekan material*/
		function save_mr(){
			$product = $_REQUEST['product'];
			$qty = $_REQUEST['qty'];
			$unit = $_REQUEST['unit'];
			$price = $_REQUEST['price'];
			$total = $_REQUEST['total'];
			$id_mainjob = $_REQUEST['id_mainjob'];
			
			
			$data = array 
			(
				'detail_job' => $product,
				'qty' => $qty,
				'unit' => $unit,
				'price' => replace_numeric($price),
				'total_price' => replace_numeric($total),
				'id_mainjob' => $id_mainjob
			);
			$this->db->insert('db_detailjob',$data);

			$xtampil = array 
				(
					 'product' => $product,
					 'qty' => $qty,
					 'unit' => $unit,
					 'price' => $price ,
					 'total' => $total,
					 'id_mainjob'	=> $id_mainjob 				
				);
			die(json_encode($xtampil));
		}
	
		
		
		function delete_dg(){
			$id = $_REQUEST['id'];
			$this->db->where('participant_id',$id);
			$this->db->delete('db_participant');
			echo json_encode(array('id'=>$id));			
		}
		
		

		
		function crud($oper,$id){
			$xid = str_replace('XD','',$id);
			switch($oper){
				case 'load':
					$data = $this->db->select('id_tendeva,id_vendor1,offer_ven1,score_ven1,remark_ven1')
									 ->where ('id_trbgtproj',$xid)
									 ->get('db_participant')
									 ->row();
				break;
				case 'add':
					die(json_encode("simpan disini"));
				break;
				case 'edit':
					die("edit");
				break;
				case 'del':
					die("del");
				break;

			}
				//var_dump($data);exit;
				die(json_encode($data));exit;	
		}
		
		
		function tambah($vendor,$offe,$score,$remark,$id,$nego){
			$offe = replace_numeric($offe);
			$row = $this->db->where('vendor_id',$vendor)
							->get('db_vendor')->row();
			//var_dump($offe);exit;
			$data = array
			(
				
					'id_vendor'	=> $vendor,
					'offer_ven'	=> replace_numeric($offe),
					'nego_ven' => replace_numeric($nego),
					'score_ven'	=> $score,
					'remark_ven'	=> $remark,
					'id_trbgtproj' => $id
					
			
			);
			$this->db->insert('db_participant',$data);
			$rowpart = $this->db->order_by('participant_id','desc')
								    ->get('db_participant')->row();
			
		
			$xdata = array 
			(
				'id_vendor' => $vendor,
				'vendor_nm' => $row->vendor_nm,
				'offer_ven'	=> number_format($offe),
				'nego_ven' => $nego,
				'score_ven'	=> $score,
				'remark_ven'	=> $remark,				
				'participant_id' => $rowpart->participant_id,
				'id_trbgtproj' => $id
				
			);
			die(json_encode($xdata));	
			
		}
		
		
		function tambahjob($idten,$detjob,$qty,$unit,$price,$tot_price){
			$data = array
			(
				
					'id_tendeva'	=> $idten,
					'detail_job'	=> $detjob,
					'qty'	=> $qty,
					'unit'	=> $unit,
					'price' => replace_numeric($price),
					'total_price' => replace_numeric($tot_price)
			);
			$this->db->insert('db_detailjob',$data);
			die(json_encode($data));
		}


		
		
		function griddata($id){
			$sql = $this->db->select('participant_id,vendor_nm,offer_ven,score_ven,remark_ven')
							 ->join('db_vendor','vendor_id = id_vendor')
							 ->where('id_trbgtproj',$id)
							 ->get('db_participant')->result();
			
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
		
	function showbgt_form(){
		#$index = $_GET['index'];
		#$data['ref'] = $ref;
		#$data['trbgt'] = $this->db->select('job,nilai_proposed,')
		#							->where('main_job',$ref)
		#							->get('db_trbgtproj')->result();
			$this->load->view("project/showbgt_form",$data);
		
	
	}	
		
		
	function approve($id){
		$cek_status = $this->db->select('isnull(id_flag,0) as id')
							   ->where('id_tendeva',$id)
							   ->get('db_tendeva')->row();
							   
		if($cek_status->id != 0 ){
			echo"
				<script type='text/javascript'>
					alert('Sudah di approve');
					refreshTable();
				</script>
			";
		}else{
			parent::approve($id);
		}
	}
		
				
	
	}

