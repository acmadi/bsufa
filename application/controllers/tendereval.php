<?php
	class tendereval extends DBController{
		
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
													  ->where('isnull(id_nonkontrak,0)',0)
													  ->order_by('no_trbgtproj','asc')->get('db_mainjob')->result();
			$this->parameters['tendwin'] = $this->db->order_by('nm_supplier','asc')->get('pemasokmaster')->result();
			$this->parameters['vendor1'] = $this->db->order_by('vendor_nm','asc')->get('db_vendor')->result();
			$this->parameters['vendor'] = $this->db->select('vendor_nm,participant_id,vendor_id,offer_ven,score_ven,remark_ven')
												   ->join('db_vendor','vendor_id = id_vendor')
												   ->get('db_participant')->result();
												   
			
												   
			 $this->parameters['vendorwinner'] = $this->db->select('id_vendor,no_tenproj,nm_supplier')
																   ->join('pemasok','kd_supp_gb = id_vendor')
																  // ->where_in('kd_project','41012','41011','1')
																  ->where('no_tenproj',@$data->id_mainjob)
                                                                   ->order_by('id_vendor','ASC')
                                                                   ->get('db_temp_vendor')
                                                                   ->result();     											   
												   
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
							->group_by('nm_supplier,offer_ven,nego_ven,score_ven,remark_ven')
							->get('db_participant')->result();
							
			$data =array();
			foreach($sql as $row){
				$data[] = array 
				(
					'contractor'=>$row->nm_supplier,
					'offering'=>number_format($row->offer_ven),
					'nego'=>number_format($row->nego_ven),
					'score'=>$row->score_ven,
					'remark'=>$row->remark_ven
				);
			}
			
			die(json_encode($data));
							
		}
		
		
		function get_bgt($id){
		
		//die($id);
			$cekid = $id;

		
			$sql = $this->db->select('d.id_trbgtproj,d.job,d.nilai_proposed,isnull(d.deduct_amt,0) as nilai_approved,e.nm_subproject,g.nm_scost')
						    ->join('db_tendeva b','a.id_tendeva = b.id_tendeva')
							->join('db_mainjob c','b.id_mainjob = c.mainjob_id')
							->join('db_trbgtproj d','c.no_trbgtproj = d.no_trbgtproj')
							->join('db_subproject e','d.id_subproject = e.subproject_id')
							->join('db_bgtproj_update f','f.kode_bgtproj = d.kd_bgtproj')
							->join('db_costproj g','g.id_scostproj = f.id_costproj')
							->where('a.id_kontrak',$id)
							->group_by('d.id_trbgtproj,d.job,d.nilai_proposed,isnull(d.deduct_amt,0) ,e.nm_subproject,g.nm_scost')
							->get('db_kontrak a')->result();
			
			$data = array();
			foreach($sql as $row){
				$data[] = array
				(
					'idtrbgtproj'=>$row->id_trbgtproj,
					'job'=>$row->job,
					'nm_subproject'=>$row->nm_subproject,
					'nm_scost'=>$row->nm_scost,
					'nilai_proposed'=>number_format($row->nilai_proposed),
					'nilai_approved'=>number_format($row->nilai_approved)
					#'price'=>$row->price,
					#'total'=>$row->total_price
				);
			}
			die(json_encode($data));exit;				
		
		
		
		
		}
		
		function index(){
			$this->set_grid_column('id_tendeva','',array('hidden'=>true,'width'=>20));
			$this->set_grid_column('no_trbgtproj','Budget Reff',array('hidden'=>true,'width'=>60,'formatter' => 'cellColumn'));
			$this->set_grid_column('no_tendeva','No.Tender',array('width'=>35,'formatter' => 'cellColumn'));
			$this->set_grid_column('job','Job',array('width'=>77,'formatter' => 'cellColumn'));
			$this->set_grid_column('nilai_tender','Tender Amount',array('width'=>18,'align'=>'right','formatter' => 'cellColumn'));
			$this->set_grid_column('nm_supplier','Tender Winner',array('width'=>30,'formatter' => 'cellColumn'));
			$this->set_grid_column('id_flag','Flag',array('width'=>50,'hidden'=>true,'formatter' => 'cellColumn'));			
			$this->set_jqgrid_options(array('width'=>1202,'height'=>350,'caption'=>'Tender Budget Project','rownumbers'=>true,'sortname'=>'id_tendeva','sortorder'=>'desc'));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}	
		

		function show_form($xref){
			$index = $_GET['index'];
			$data['xref'] = $xref;
			$data['vendor'] = $this->db->select('kd_supp_gb,nm_supplier')
										->join('db_subproject','subproject_id = kd_project')
										->where('db_subproject.pt_id',$this->pt)
										->order_by('nm_supplier','ASC')
									   ->get('pemasok')->result();
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
			
			//$this->db->empty_table('db_temp_vendor');
			redirect('tendereval');
			//die("sukses");
			//Cek data Semuanya
			//$this->load->view('project/print/cetaktender');					
			/*if($sql){
				die("sukses");
			}*/
			
		}
		
		function save_vendor(){
			extract(PopulateForm());
			$user = $this->id;
			$pt = $this->pt;
			//$tgl = inggris_date($tgl);
	
			
			//Insert Data Ke Tender
			$sql = $this->db->query("sp_Instenderwinner ".$idtender.",'".$jobnm."',
			".$win.",".$user.",".$pt.",'".$no_ten."'");
			
			
	
			redirect('tendereval');
	
			
		}
		
		
		function save_app(){
			extract(PopulateForm());
			if($aksi == "Approve"){
				$data = array 
				(
					'id_flag' => 2
				);
				$this->db->where('id_tendeva',$idtender);
				$this->db->update('db_tendeva',$data);
				
				$message = "Kepada Bpk. Rochmad Wahyudi\n
				
Dengan hormat,\n
Permohonan anda terkait pekerjaan ".$jobnm.", dengan nilai tender sebesar Rp.".($ambudget)."\n
Dengan pemenang tender ".$win."\n
Mohon untuk di berikan komentar/persetujuan bapak/ibu dengan mengakses http://mis.bsu.co.id \n
Demikian Informasi permohonan proposed project budget ini\n
Terimakasih 
PT.GMI System Application";			

//die($message);
			$this->email->from($this->from_tender_propbgt, $this->displayname_tender_probgt);
			$listpro =  array('rochmad@bsu.co.id','ali@bsu.co.id');
			$this->email->to($listpro);
			//$this->email->to($this->to_tender_probgt);
			$this->email->subject($this->subject_tender_probgt);
			$this->email->message($message);	
			$this->email->send();
				
				#die($message);
				
						
			}else{
				$data = array 
				(
					'id_flag' => 1
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
			
			$query = array
			(
				'id_vendor' => $contractor,
				'no_tenproj' => $id_mainjob
			);
			
			$this->db->insert('db_temp_vendor',$query);
			
			$project = array('41012','41011','1');
			//Cek Kontraktor Nama
			$qcek = $this->db->select('nm_supplier')
							 ->where('kd_supp_gb',$contractor)
							 ->where_in('kd_project',$project)
							 ->get('pemasok')->row();
							 
					  
							 
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
		
		
		function update_trbgt(){
				$nilaiapproved = $_REQUEST['nilai_approved'];
				$idtrbgtproj	= $_REQUEST['idtrbgtproj'];
				
					#var_dump($idtrbgtproj);
				$data = array
				(
					'deduct_amt' => replace_numeric($nilaiapproved)
									
				);
			#	var_dump($data);
				
				$this->db->where('id_trbgtproj',$idtrbgtproj);
				$this->db->update('db_trbgtproj',$data);
		
			$qcek = $this->db->where('id_trbgtproj',$idtrbgtproj)
								->get('db_trbgtproj')->row();
			
			$xtampil = array 
				(
					 
					 'job' => $qcek->job,
					 'nilai_proposed' => number_format($qcek->nilai_proposed),
					 'nilai_approved' => $nilaiapproved
					 
				);
			die(json_encode($xtampil));
		
		
		
		}
		
		function vendor(){
		
		$project = array('41012','41011','1');
		$query	= $this->db->select('id_vendor,nm_supp_gb')
							->join('pemasok','kd_supp_gb = id_vendor')
							->where_in('kd_project',$project)
							->get('db_temp_vendor')->result_array();
		#$vendor = $query->id_vendor;

		echo json_encode($query);
		
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
		
	function showbgt_form($ref){
		#$index = $_GET['index'];
		$data['ref'] = $ref;
		#$data['trbgt'] = $this->db->select('job,nilai_proposed,')
									#->where('main_job',$ref)
									#->gt('db_trbgtproj')->result();
			$this->load->view("project/showbgt_form",$data);
		
	
	}	
		
		
	function approve($id){
		$cek_status = $this->db->select('isnull(id_flag,0) as id')
							   ->where('id_tendeva',$id)
							   ->get('db_tendeva')->row();
							   
		if($cek_status->id >= 2 ){
			echo"
				<script type='text/javascript'>
					alert('Tender sudah di Approve');
					refreshTable();
				</script>
			";
		}elseif($cek_status->id < 1){
			echo"
				<script type='text/javascript'>
					alert('Alokasikan tender budget terlebih dahulu');
					refreshTable();
				</script>
			";
		}else{
			parent::approve($id);
		}
	}
	
	function tender($id){
		$cek_status = $this->db->select('isnull(id_flag,0) as id')
							   ->where('id_tendeva',$id)
							   ->get('db_tendeva')->row();
							   
		if($cek_status->id >= 1  ){
			echo"
				<script type='text/javascript'>
					alert('Budget sudah dialokasikan');
					refreshTable();
				</script>
			";
		}else{
			parent::tender($id);
		}
	}
	
	function view($id){
		$cek_status = $this->db->select('isnull(id_flag,0) as id')
							   ->where('id_tendeva',$id)
							   ->get('db_tendeva')->row();
							   
		if($cek_status->id > 0  ){
			echo"
				<script type='text/javascript'>
					alert('Tender Winner Sudah Dipilih');
					refreshTable();
				</script>
			";
		}else{
			parent::view($id);
		}
	}
		
				
	
	}

