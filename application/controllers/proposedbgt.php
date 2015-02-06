<?php
	class proposedbgt extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('proposedbgt_model');
			$this->set_page_title('Proposed Project Budget');
			$this->default_limit = 30;
			$this->template_dir = 'project/proposedbgt';
			$this->load->library('email');
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->pt = $session_id['id_pt'];
			$this->divisi = $session_id['divisi_id'];
			#$pt = $session_id['id_pt'];
		}
		
		protected function setup_form($data=false){
			$this->parameters['proj'] = $this->db->where('id_pt',$this->pt)
												 ->get('db_subproject')->result();
			$this->parameters['bgt'] = $this->db->select('distinct(kode_bgtproj)')
												->where('id_pt',$this->pt)
												->get('db_bgtproj')->result();
			$this->parameters['approved'] = $this->db->select('distinct(kode_bgtproj)')
												->where('id_pt',$this->pt)
												->get('db_bgtproj')->result();
			
			$this->parameters['join'] = $this->db->select('*')
										->join('db_bgtproj_update', 'kd_bgtproj = kode_bgtproj')
									//	->join ('db_ssubbgtproj', 'db_ssubbgtproj.id_ssubbgtproj = db_bgtproj_update.id_ssubbgtproj')
										->join ('db_costproj','db_bgtproj_update.id_costproj = db_costproj.id_scostproj')
										->where ('id_trbgtproj', @$data->id_trbgtproj)
										->get('db_trbgtproj')->row();
										
			$this->parameters['trbgt'] = $this->db->join('db_trbgtproj b','a.no_trbgtproj = b.no_trbgtproj')
												->where ('a.no_trbgtproj', @$data->no_trbgtproj)
												->get('db_mainjob a')->row();
			
			$this->parameters['totbgt'] = $this->db->select('sum(nilai_bgtproj) as tot')
										->join ('db_bgtproj_update', 'kd_bgtproj = kode_bgtproj')
										->where ('id_trbgtproj', @$data->id_trbgtproj)
										->where ('isnull(db_trbgtproj.id_flag,0) <> 10')
										->get('db_trbgtproj')->row();
										
			$this->parameters['totact'] =$this->db->select ('sum(nilai_proposed) as totact') 
													->where ('kd_bgtproj',@$data->kd_bgtproj) 
													->where ('isnull(db_trbgtproj.id_flag,0) <> 10')
													->get('db_trbgtproj')->row();
													
			//CEK NO
			//var_dump($this->divisi);exit;
			$sql = $this->db->query("sp_cek_bgt_no ".$this->divisi.",".$this->pt."")->row();
			$this->parameters['nobgt'] = $sql->no_bgt;
							
										
										
 
		}
		
		
		
		function get_json(){
			$this->set_custom_function('mainjob_total','currency');
			$this->set_custom_function('mainjob_date','indo_date');
			parent::get_json();
		}	
		
		function index(){
			$this->set_grid_column('mainjob_id','Main Job',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('no_trbgtproj','Budget No.',array('width'=>35,'formatter' => 'cellColumn'));
			$this->set_grid_column('mainjob_date','Date',array('width'=>15,'formatter' => 'cellColumn','align'=>'center'));
			$this->set_grid_column('mainjob_desc','Main Job',array('width'=>108,'formatter' 	=> 'cellColumn'));
			$this->set_grid_column('mainjob_total','Proposed Amount',array('width'=>18,'align'=>'right','formatter' => 'cellColumn'));
			/*$this->set_grid_column('nm_bgtprojcode','Budget Name',array('width'=>40,'formatter' => 'cellColumn'));
			$this->set_grid_column('tgl_proposed','Date',array('width'=>30,'formatter' => 'cellColumn'));
			$this->set_grid_column('nilai_proposed','Proposed Amount',array('width'=>30,'align'=>'right','formatter' => 'cellColumn'));
			$this->set_grid_column('nilai_approved','Approved Amount',array('width'=>30,'align'=>'right','formatter' => 'cellColumn'));
			*/$this->set_grid_column('id_flag','Flag',array('width'=>50,'hidden'=>true,'formatter' => 'cellColumn'));
			$this->set_jqgrid_options(array('width'=>1200,'height'=>350,'caption'=>'Proposed Project Budget','rownumbers'=>true,'sortname'=>'mainjob_id','sortorder'=>'desc'));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}	
		
		
		function cekdata($id,$proj,$cost,$subcost){
			//Cek Project Gabungan
			$cekgab = $this->db->select('isnull(id_gabungan,0) as idgab')
							   ->where('kode_bgtproj',$id)
							   ->get('db_bgtproj_update')->row();
							   
			$gabungan = $cekgab->idgab;
			$allrow = $this->db->query("sp_allbgtproj '".$proj."'")->row();
			if($gabungan==1){
				//die("test");
				$row = $this->db->query("sp_cekbgtprojgab '".$id."','".$proj."'")->row();
				$ket = "Join Project";
			}else{
				//die("coba");
				$row = $this->db->query("sp_cekbgtproj '".$id."','".$proj."'")->row();
				$ket = "Single Project";
			}				   
			
			
			
			
			
			#Budget project#
			$bgt = number_format($row->bgt);
			$desc = $row->nm_bgtproj;
			$actual = number_format($row->actual);
			$blc = number_format($row->bgt  - $row->actual);
			#End Budget Project#
			
			
			#Budget All Project#
			$allbgt = number_format($allrow->bgt);
			$allactual = number_format($allrow->actual);
			$allblc = number_format($allrow->bgt  - $allrow->actual);			
			#End Budget All Project#
			
			$data = array(
				'totbgt'	=> $bgt,
				'actual'	=> $actual,
				'blc' 		=> $blc,
				'allbgt'	=> $allbgt,
				'allactual'	=> $allactual,
				'allblc'	=> $allblc,
				'desc'		=> $desc,
				'ket'		=> $ket
			);
			die(json_encode($data));exit;
			
		}	
		function approval($id){
//("tes");
//die($id);
		/*	$data = $this->db->join('db_bgtproj_update','kd_bgtproj = kode_bgtproj')
							->where('id_trbgtproj',$id)
							 ->get('db_trbgtproj')->result();
			
			*/
		$row = $this->db->query("approvebgt '".$id."'")->row();
		
//		var_dump($row);
			
		}
		
		function save(){
	
	
			extract(PopulateForm());
			//die("test");
			$tgl = date("Y-m-d");
			$blc = replace_numeric($blc);
			$amount = replace_numeric($amount);
			
			$data = array 
			(
				'kd_bgtproj' => $bgt,
				'tgl_proposed' => $tgl,
				'nilai_proposed' => $amount,
				'remark' => $remark,
				'id_subproject' => $project_id,
				'id_pt' => $this->pt
			);
			
			//Cek Proposed Amount
			if($amount > $blc){
				die("Amount proposed budget greater than balance annual budget");
			}
				//$this->db->insert('db_trbgtproj',$data);
				die("sukses");
		

			

//			die($message);
			//Akhir pengiriman Email
		
		
		
		
		
		
		
		
		}
		
		
		function tampildata(){
			extract(PopulateForm());
			$sql = $this->db->select("kode_bgtproj id,kode_bgtproj + '(' + nm_bgtproj + ')' nama")
							->where('id_subproject',$project)
							->where('id_sbgtproj',$cost)
						//	->where('id_ssubbgtproj',$subcost)
							->group_by('kode_bgtproj,nm_bgtproj')
							->get('db_bgtproj_update')->result();

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
		
		
		function print_slip($id){
			$gabungan = 0;
			//Cek Data Budget Project
			$qrows = $this->db->query("SP_PrintBgt ".$id."")->row();
			//var_dump($qrows);exit;
			//Cek sisa budget tahunan
			$data['cekdata'] = array 
			(
				'kd_bgtproj' => $qrows->kd_bgtproj,
				'descbgt'	=> $qrows->nm_bgtproj,
				'tgl_proposed' => $qrows->tgl_proposed,
				'amount' => number_format($qrows->nilai_proposed),
				'remark' => $qrows->remark,
				'blc' => number_format($qrows->blcbgt),
				'totbgt' => number_format($qrows->totbgt),
				'ytotbgt' => number_format($qrows->totbgt),
				'yblcbgt' => number_format($qrows->blcbgt),
				'usebgt' => number_format($qrows->amount),
				'nama_pt' => $qrows->nm_pt,
				'Struk' => $qrows->nm_scost,
				'substruk' => $qrows->nm_ssubbgtproj
			);
			
			$data['cekkode'] = $qrows->no_trbgtproj;
		
		if($qrows->kd_bgtproj==""){
			echo"
				<script type='text/javascript'>
					alert('Hasil Print Error, Cek kembali pengajuan budget');
					window.close();
				</script>
			";
			exit;
		}elseif($qrows->nilai_proposed < 0){
			$data['status'] = "Over Budget";	
			$this->load->view('project/print/slip_budget_besar',$data);
		}elseif($gabungan==1){
			$data['status'] = "On Budget";
			$this->load->view("project/print/slip_budget_gabungan",$data);
	    }else{
			$data['status'] = "On Budget";
			$this->load->view("project/print/slip_budget_kecil",$data);
		}
	}
	
	
	function save_approve(){
			extract(PopulateForm());
			$pt = $this->pt;
			if($ketprop == ''){ $ketprop = 'No Comment';};
			$this->db->query("sp_appbgtproj ".$idmain.",'".inggris_date($tgl_prop)."','".inggris_date($tgl_app)."'
			,".$pt.",'".$no_prop."','".$aksi."','".$ketprop."','".$nil."'");
			
			$row = $this->db->select('sum(nilai_proposed) as nilai')->where('no_trbgtproj',$no_prop)
						->get('db_trbgtproj')->row();
			
			$message = "Kepada Bpk. Erick\n
				
Dengan hormat,\n
Permohonan anda terkait pekerjaan ".$job.", dengan nilai proposed budget sebesar Rp.".($row->nilai)."\n
Telah disetujui. dengan catatan".$ketprop."silahkan melanjutkan ke tahap tender proyek anda dengan mengakses http://mis.bsu.co.id \n
Demikian informasi persetujuan proposed project budget ini kami sampaikan.\n
Terimakasih 
PT.GMI System Application";			

//die($message);
			$this->email->from($this->from_app, $this->displayname_app);
			$list = array('ali@bsu.co.id','erick@bsu.co.id','andianto@bsu.co.id');
			$this->email->to($list);
			#$this->email->to('donsadat@gmail.com','erick@bsu.co.id');
			$this->email->subject($this->subject_app);
			$this->email->message($message);	
			$this->email->send();
			#die($message);
			redirect("proposedbgt");	
	}
	
	function approve($id){
		$cek_status = $this->db->select('isnull(id_flag,0) as id')
							   ->where('mainjob_id',$id)
							   ->get('db_mainjob')->row();
							   
		if($cek_status->id!=0){
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
	
	function show_form($no,$pt,$desc,$bln,$thn){
			$index = $_GET['index'];
			//$data['xref']   = $xref;
			$data['no_bgt'] = $no."/".$pt."/".$desc."/".$bln."/".$thn;
			$data['vendor'] = $this->db->select('kd_supp_gb,nm_supplier')
									   ->order_by('nm_supplier','ASC')
									   ->get('pemasokmaster')->result();
			$this->load->view("project/show_proproj",$data);
		}	
		
	function showbgt_edit($no,$pt,$desc,$bln,$thn){
			$index = $_GET['index'];
			//$data['xref']   = $xref;
			$data['no_bgt'] = $no."/".$pt."/".$desc."/".$bln."/".$thn;
			$data['vendor'] = $this->db->select('kd_supp_gb,nm_supplier')
									   ->order_by('nm_supplier','ASC')
									   ->get('pemasokmaster')->result();
			$this->load->view("project/show_proproj_edit",$data);
		}	
		
	function get_dg($id){
		$cekno = $this->db->where('mainjob_id',$id)
						  ->get('db_mainjob')->row();
		$getsql = $this->db->select('job,nm_subproject,kd_bgtproj,total_bgt,total_prop,
							(total_bgt - total_prop) as blc,nilai_proposed,id_trbgtproj')
						   ->join('db_trbgtproj b','a.no_trbgtproj = b.no_trbgtproj')
						   ->join('db_subproject c','b.id_subproject = c.subproject_id')
						   ->where('b.no_trbgtproj',$cekno->no_trbgtproj)
						   ->get('db_mainjob a')->result();
						   
			$xtampil = array();	

			foreach($getsql as $row){
				
			
			
			$sub = $this->db->where('kode_bgtproj',$row->kd_bgtproj)
								->get('db_bgtprojcode')->row();
			
			$ssub = $this->db->select('distinct(b.id_ssubbgtproj),b.nm_ssubbgtproj,c.nm_scost')
							->join('db_ssubbgtproj b','a.id_ssubbgtproj = b.id_ssubbgtproj')
							->join('db_costproj c','c.id_scostproj = a.id_sbgtproj')
							->where('kode_bgtproj',$row->kd_bgtproj)
							->get('db_bgtproj_update a ')->row();
			
			
			$xtampil[] = array 
				(
					 #'id_trbgtproj' => $row->id_trbgtproj,
					 'jobdet' => $row->job,
					 'proj_id' => $row->nm_subproject,
					 'cost' => $ssub->nm_scost,
					// 'subcost' => $ssub->nm_ssubbgtproj,
					 'codebgt' => $sub->nm_bgtprojcode,
					 'totalbgt' => number_format($row->total_bgt),
					 'totalprop' => number_format($row->total_prop),
					 'xblc' => number_format($row->blc),
					 'amount'	=>number_format($row->nilai_proposed)			
				);
			}
				
		die(json_encode($xtampil));
		
	} 
	
	function get_mr($id){
			$sql = $this->db->select('*')
							->where('id_bqproj',$id )
							->get('db_bqproj')->result();
			
			$data = array();
			foreach($sql as $row){
				$data[] = array
				(
					'no_proposed'=>$row->no_proposed,
					'product'=>$row->product,
					'qty'=>$row->qty,
					'unit'=>$row->unit,
					'price'=>$row->price,
					'total'=>$row->tot_price
				);
			}
			die(json_encode($data));exit;				
		}
	
	
	function get_approved($id){
		$sql = $this->db->query("SP_AppPropBgt '".$id."'")->result();
						
			
			$data = array();
			foreach($sql as $row){
				$data[] = array
				(
					'jobdet'=>$row->nm_subproject,
					'proj_id'=>$row->nm_bgtproj,
					'nil_prop'=>number_format($row->nilai_proposed),
					'totalprop'=>number_format($row->realisasi),
					'totalbgt'=>number_format($row->tot)
					//~ 'unit'=>$row->unit,
					//~ 'price'=>$row->price,
					//~ 'total'=>$row->tot_price
				);
			}
			die(json_encode($data));exit;				
		
		
	}
	
	function cekpdf(){

		
		
		$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->pt = $session_id['id_pt'];
			$this->divisi = $session_id['divisi_id'];
		
		$pt = $this->pt;
		$sql = $this->db->select('TOP 1 isnull(mainjob_id,0)as mainjob_id')
						->order_by('mainjob_id','desc')
						->get('db_mainjob')->row();
		$id = $sql->mainjob_id + 1;
		
		extract(PopulateForm());
		
		$tglmain = inggris_date($tgl);
		#$pt			= "PT. Graha Multi Insani";
		#die(@$nonkontrak);exit;
		
		//~ if($nonkontrak == '')
			//~ {$nonkontrak = 0;}
			//~ else{ $nonkontrak = 1;}
		
		$this->db->query("sp_Insbgtproj '".$tglmain."','".$no_prop."','".$job."',".$pt.",'".$nonkontrak."'")->row();
	
		$row = $this->db->select('sum(nilai_proposed) as nilai')
				->where('no_trbgtproj',$no_prop)
				->get('db_trbgtproj')->row();
	$message = "Kepada Bpk. Erick\n
				
Dengan hormat,\n
Sehubungan dengan adanya rencana pekerjaan ".$job.",dengan nilai proposed budget sebesar Rp.".number_format($row->nilai)."\n
Mohon untuk di berikan komentar/persetujuan bapak/ibu dengan mengakses http://mis.bsu.co.id/user/login/approve/".$id." \n
Demikian Informasi permohonan proposed project budget ini\n
Terimakasih 
PT.GMI System Application";			

//die($message);
			$this->email->from($this->from_app_propbgt, $this->displayname_app_probgt);
			$listpro =  array('ali@bsu.co.id','erick@bsu.co.id','andianto@bsu.co.id');
			$this->email->to($listpro);
			$this->email->subject($this->subject_app_probgt);
			$this->email->message($message);	
			$this->email->send();
		
		#die($message);
		redirect('proposedbgt');
			
	}
	
	
	function recekpdf($id){
		$data['id'] = $id;
		$this->load->view('project/print/reprint_proposedbudget',$data);
	}
	
	
	function appprop(){
		extract(PopulateForm());
		
		$this->db->query("sp_app_prop_update '".$no."'");
		
		$message = "Kepada Bpk. Erick\n
				
Dengan hormat,\n
Permohonan anda terkait pekerjaan ".$job.", dengan nilai proposed budget sebesar Rp.".($nilai)."\n
Telah disetujui. silahkan melanjutkan ke tahap tender proyek anda dengan mengakses http://mis.bsu.co.id \n
Demikian informasi persetujuan proposed project budget ini kami sampaikan.\n
Terimakasih 
PT.GMI System Application";			

//die($message);
			$this->email->from($this->from_app, $this->displayname_app);
			$list = array('ali@bsu.co.id','erick@bsu.co.id','andianto@bsu.co.id');
			$this->email->to($list);
			#$this->email->to('donsadat@gmail.com','erick@bsu.co.id');
			$this->email->subject($this->subject_app);
			$this->email->message($message);	
			$this->email->send();
		
		
		
		
		
		$this->UserLogin->deleteLogin();
		redirect('user/login');
	
	}
	
		
		
	function loaddata(){
			#die($this->input->post('parent_id'));
			#$prj = $_REQUEST['prj'];
			
			if($this->input->post('data_type')){
				
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				
				
				
				switch($data_type){
					case 'proj_id':
					    $sql = $this->db->select('subproject_id id,nm_subproject nama')
										->where('id_pt','44')
										->get('db_subproject')->result();
						break;
						
					
					case 'totalbgt':
							$sql = $this->db->select('sum(nilai_bgtproj) nama')
										->where('kode_bgtproj',$parent_id)
										->get('db_bgtproj_update')->result();
							break;
					case 'scost' :
					    $sql = $this->db->select('c.id_scostproj id,c.nm_scost nama')
										->join('db_sbgtproj b','a.project_id = b.id_hbgbtproj')
										->join('db_costproj c','b.id_scostproj = c.id_scostproj')
										->where('project_id',$parent_id)
										->get('db_hbgtproject a')->result();	
						break;
					// case 'sscost' :
						// $sql = $this->db->select('id_ssubbgtproj id,nm_ssubbgtproj nama')
										// ->where('id_scostproj',$parent_id)
										// ->get('db_ssubbgtproj')->result();
					// break;
					
					case 'codebgt':
					#extract(PopulateForm());
					
							#$prj = $_REQUEST['proj'];
							$sql = $this->db->select('kode_bgtproj id, nm_bgtproj nama')
										->where('id_costproj',$parent_id)
										//->where('id_subproject',$prj)
										->group_by('kode_bgtproj,nm_bgtproj')
										->get('db_bgtproj_update')->result();
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
		 
		function gettotal($id){
			
			
			$data = $this->db->select('sum(nilai_bgtproj) as total')
							 ->where('kode_bgtproj',$id)
							 ->get('db_bgtproj_update')->row();
							 
		    
		    		    
		    
		    die(json_encode($data));exit;
			
		}

		function gettotprop($id){
			
						
		    $data = $this->db->select('isnull(sum(nilai_proposed),0) as totprop')
							->where('kd_bgtproj',$id)
							->get('db_trbgtproj')->row();
		    
		    
		    die(json_encode($data));exit;

				
		}
		function getgrandtotal($id){
			extract(PopulateForm());

		    $sql = $this->db->query("SP_nilaiproposed '".$id."'")->row();
							    
		    
		    die(json_encode($sql));

				
		}
		
		
		//Save Data 
		function save_dg(){
			#$jobdet = $_REQUEST['jobdet'];
			$proj_id = $_REQUEST['proj_id'];
			$codebgt = $_REQUEST['codebgt'];
			$totalbgt = $_REQUEST['totalbgt'];
			$totalprop = $_REQUEST['totalprop'];
			$xblc = $_REQUEST['xblc'];
			$amount = $_REQUEST['amount'];
			$no_bgt = $_REQUEST['no_bgt'];
			$cost = $_REQUEST['cost'];
			//$subcost = $_REQUEST['subcost'];
			//echo $id;
			$tgl = date("Y-m-d H:i:s");
			$pt = '44';
			
			$data = array 
			(
				#'job' => $jobdet,
				'id_subproject' => $proj_id,
				'kd_bgtproj' => $codebgt,
				'no_trbgtproj' => $no_bgt,
				'tgl_proposed' => $tgl,
				
				'total_bgt' => replace_numeric($totalbgt),
				'total_prop' => replace_numeric($totalprop),
				'nilai_proposed' => replace_numeric($amount),
				
				'id_pt'	=> $pt
			);
			

			$this->db->insert('db_trbgtproj',$data);			
			
			//Cek Kontraktor Nama
			//$qcek = $this->db->select('nm_supplier')
							// ->where('kd_supp_gb',$contractor)
							 //->get('pemasokmaster')->row();
							 
					  
			//Cek Nama Project
			$ckproj = $this->db->select('nm_subproject')
							   ->where('subproject_id',$proj_id)
							   ->get('db_subproject')->row();
			//Cek Sturktur cost
			$cekcost = $this->db->select('nm_scost')
								->where('id_scostproj',$cost)
								->get('db_costproj')->row();
			//Cek sub struktur cost	
			// $cekscost = $this->db->select('nm_ssubbgtproj')
								// ->where('id_ssubbgtproj', $subcost)
								// ->get('db_ssubbgtproj ')->row();
			
			$sub = $this->db->where('kode_bgtproj',$codebgt)
								->get('db_bgtproj')->row();
														   
			$xtampil = array 
				(
					 //~ 'jobdet' => $jobdet,
					 'proj_id' => $ckproj->nm_subproject,
					 'codebgt' => $sub->nm_bgtproj,
					 'cost' => $cekcost->nm_scost,
					// 'subcost' => $cekscost->nm_ssubbgtproj,					 
					 'totalbgt' => $totalbgt,
					 'totalprop' => $totalprop,
					 'xblc' => $xblc,
					 'amount'	=> $amount			
				);
			die(json_encode($xtampil));
			redirect('proposedbgt');
		}
		
		function savemr_bq(){
			#$no_bgt = $_REQUEST['no_bgt'];
			$noprop = $_REQUEST['noprop'];
			$product = $_REQUEST['product'];
			$qty = $_REQUEST['qty'];
			$unit = $_REQUEST['unit'];
			$price = $_REQUEST['price'];
			$total = $_REQUEST['total'];
			
			#var_dump($noprop);
			
			$datamr = array 
				(
					'no_proposed' => $noprop,
					 'product' => $product,
					 'qty' => $qty,
					 'unit' => $unit,
					 'price' => replace_numeric($price),
					 'total' => replace_numeric($total)
					 
				);
			$this->db->insert('db_bqproj',$datamr);			
			
			$xtampil = array 
				(
					'no_proposed' => $noprop,
					 'product' => $product,
					 'qty' => $qty,
					 'unit' => $unit,
					 'price' => $price,
					 'total' =>$total				
				);
			die(json_encode($xtampil));
			
			
			
			
			#die($product);
			
			#extract(PopulateForm());
			#var_dump($product);
			#die($product);
			#$this->db->query("sp_InsBqProj '".$no_prop."','".$product."',".$qty.",
			#".$unit.",".$price.",".$total."");
			
			#redirect("proposedbgt");

			/*$sql = $this->db->where('id_mainjob',$id)
							->get('db_detailjob')->result();
			
			$data = array();
			foreach($sql as $row){
				$data[] = array
				(
					'product'=>$row->detail_job,
					'qty'=>$row->qty,
					'unit'=>$row->unit,
					'price'=>$row->price,
					'total'=>$row->total_price
				);
			}*/	
			#die(json_encode($data));exit;			
		}
		
		function showmr_form($no,$pt,$desc,$bln,$thn){
			$index = $_GET['index'];
			$data['noprop'] = $no."/".$pt."/".$desc."/".$bln."/".$thn;
			
			#$data['ref'] = $ref;
			$data['satuan'] = $this->db->select('satuan')->get('satuan')->result();
			#$data['vendor'] = $this->db->select('id_detailjob,detail_job')
			#						   ->get('db_detailjob')->result();
			$this->load->view("project/showmr_form",$data);
		}
		
		function edit($id){
			
			
							  
			$flag = $this->db->where("mainjob_id",$id)
								->get("db_mainjob")->row();
			$flagid = $flag->id_flag; 
			
							  
			if($flagid == 1){
				echo"
					<script type='text/javascript'>
						alert('Tidak bisa edit, budget telah di approve');
						refreshTable();
					</script>
				";					
			}else{
				parent::edit($id);

			}
		}
		
		function update_proproj($id){
			
			
			$idtrbgtproj = $_REQUEST['id_trbgtproj'];
			$jobdet 	= $_REQUEST['jobdet']; 
			$proj		= $_REQUEST['proj_id'];
			$cost		= $_REQUEST['cost'];
		//	$subcost	= $_REQUEST['subcost'];
			$codebgt	= $_REQUEST['codebgt'];
			$totalbgt	= $_REQUEST['totalbgt'];
			$totalprop 	= $_REQUEST['totalprop'];
			$xblc		= $_REQUEST['xblc'];
			$amount		= $_REQUEST['amount'];
		
		
			$data = array
			(
				'job' => $jobdet,
				'id_subproject' => $proj,
				'kd_bgtproj'=> $codebgt,
				'total_bgt' => replace_numeric($totalbgt),
				'nilai_proposed' => replace_numeric($amount)
			);
			
			$this->db->where('id_trbgtproj',$idtrbgtproj)
						->update('db_trbgtproj',$data);
		
			$project = $this->db->where('subproject_id',$proj)
								->get('db_subproject')->row();
			$scost	= $this->db->where('id_scostproj',$cost)
								->get('db_costproj')->row();
			
			$sub = $this->db->where('kode_bgtproj',$codebgt)
								->get('db_bgtprojcode')->row();
			
			$ssub = $this->db->select('distinct(b.id_ssubbgtproj),b.nm_ssubbgtproj,c.nm_scost')
							->join('db_ssubbgtproj b','a.id_ssubbgtproj = b.id_ssubbgtproj')
							->join('db_costproj c','c.id_scostproj = a.id_sbgtproj')
							->where('kode_bgtproj',$codebgt)
							->get('db_bgtproj_update a ')->row();
			
			
			$xtampil = array 
				(
					#'id_trbgtproj' =>$idtrbgtproj,
					'jobdet' 	=> $jobdet, 
					'proj_id'	=> $project->nm_subproject,
					'cost'	=> $ssub->nm_scost,
					//'subcost' =>$ssub->nm_ssubbgtproj,
					'codebgt' =>$sub->nm_bgtprojcode,
					'totalbgt' =>$totalbgt,
					'totalprop' => $totalprop,
					'xblc' =>$xblc,
					'amount' =>$amount
						
				);
			die(json_encode($xtampil));
			
			
			
		}		
		
		function save_proproj(){
			
			extract(PopulateForm());
			
			$angka = $this->db->select('sum(nilai_proposed) as nilai')
								->where('no_trbgtproj',$no_prop)
								->get('db_trbgtproj')->row();
			
			$data = array
			(
				'mainjob_desc'=> $job,
				'mainjob_total'=>$angka->nilai
			);
			
			$this->db->where('no_trbgtproj',$no_prop)
					 ->update('db_mainjob',$data);
			
			redirect('proposedbgt');
			
		}
		
		function showbgt(){
			$sscost = $this->input->post('scost');
			$proj = $this->input->post('proj');
			$sql = $this->db->select('kode_bgtproj id, nm_bgtproj nama')
						    ->where('id_costproj',$sscost)
						    ->where('id_subproject',$proj)
							->group_by('kode_bgtproj,nm_bgtproj')
							->get('db_bgtproj_update')->result();
							
			$data = array();
			foreach($sql as $row){
				$data[] = $row;
			}		
			die(json_encode($data));		
							
		}
		
		function showdes($idp,$stru){
			// $sscost = $this->input->post('cost');
			// $proj = $this->input->post('proj_id');
			$sql = $this->db->select('kode_bgtproj id, nm_bgtproj nama')
										->where('id_costproj',$stru)
										->where('id_subproject',$idp)
										->group_by('kode_bgtproj,nm_bgtproj')
										->order_by('nm_bgtproj','asc')
										->get('db_bgtproj_update')->result();
							
			$data = array();
			foreach($sql as $row){
				$data[] = $row;
			}		
			die(json_encode($data));		
							
		}		
		
		
		

		
}

