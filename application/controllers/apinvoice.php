<?php
	class apinvoice extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('apinvoice_model');
			$this->set_page_title('AP INVOICE');
			$this->default_limit = 30;
			$this->template_dir = 'ap/apinvoice';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
		}
		/* di hilangkan oleh Abas
		protected function setup_form($data=false){
		
		
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->pt	= $session_id['id_pt'];
                        
			/*updatean
		$Ph_SQL = "select id_coa,acc_name from db_coa where acc_name like '%pph%'";
		$this->parameters['pphPajak'] = $this->db->query($Ph_SQL)->result();
		
		$Pr_SQL = "select * from db_subproject inner join pt on db_subproject.pt_id = pt.id_pt";
		$this->parameters['ptProject'] = $this->db->query($Pr_SQL)->result();
		/*end updatean
						
         $this->parameters['trxtype'] = $this->db->select('trxtype_id,trx_type')
																											->where('trx_class','P')
                                                                                                            ->order_by('trxtype_id','ASC')
                                                                                                            ->get('db_trxtype')
                                                                                                            ->result();
																											
        $this->parameters['ppn'] = $this->db->select('id_tax,ppn')
																											->where('tax_cd','ppn')
                                                                                                            ->order_by('id_tax','ASC')
                                                                                                            ->get('db_tax')
                                                                                                            ->result();																											
																											
         $this->parameters['pph'] = $this->db->select('id_tax,pph')
																											->where('tax_cd','pph')
                                                                                                            ->order_by('pph','ASC')
                                                                                                            ->get('db_tax')
                                                                                                            ->result();																												
																											
		$this->parameters['cjc'] = $this->db->select('id_cjc,no_cjc')
																											->where('flag_id',1)
																											->order_by('no_cjc','ASC')
                                                                                                            ->get('db_cjc')
                                                                                                            ->result();				
		$this->parameters['po'] = $this->db->select('brgpoh_id,no_po')
																											->where('isLockMR',1)
                                                                                                            ->order_by('no_po','ASC')
                                                                                                            ->get('db_barangPOH')
                                                                                                            ->result();				
		$this->parameters['term'] = $this->db->select('term_cd,descs')
                                                                                                            ->order_by('term_cd','ASC')
                                                                                                            ->get('db_term')
                                                                                                            ->result();		
																											
		$this->parameters['vendor'] = $this->db->select('kd_supp_gb,nm_supplier')
																											->join('db_subproject','kd_project = subproject_id')
																											->where('pt_id',$this->pt)
                                                                                                            ->order_by('nm_supplier','ASC')
                                                                                                            ->get('pemasok')
                                                                                                            ->result();	
		$this->parameters['project_detail'] = $this->db->select('subproject_id,nm_subproject')
																											->where('pt_id',44)
                                                                                                            ->order_by('subproject_id','ASC')
                                                                                                            ->get('db_subproject')
                                                                                                            ->result();																												
		$this->parameters['project'] = $this->db->select('mainjob_id,(no_trbgtproj +"  ||  "+ left(mainjob_desc,49))  as no_trbgtproj')
																											->where_not_in('no_trbgtproj','0')
                                                                                                            ->order_by('mainjob_id','ASC')
                                                                                                            ->get('db_mainjob')
                                                                                                            ->result();
		$this->parameters['operational'] = $this->db->select('id_trbgt,form_kode,(code_id +"  ||  "+ remark) code' )
																											->where('id_pt',$this->pt)
                                                                                                            ->order_by('code_id','ASC')
                                                                                                            ->get('db_trbgtdiv')
                                                                                                            ->result();																												
																																													
			$no = 1;
			$proj = 44;														   
			$sql = $this->db->query("sp_cekapno ".$no.",".$proj."")->row();
			//var_dump($sql);
			$this->parameters['noap'] = $sql->no_ap;																														
            }	
			 Akhir di hilangkan oleh Abas*/
		protected function setup_form($data=false){
		
		
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->pt	= $session_id['id_pt'];
		
		/*updatean*/
		$Ph_SQL = "select id_coa,acc_name from db_coa where acc_name like '%pph%'";
		$this->parameters['pphPajak'] = $this->db->query($Ph_SQL)->result();
		$this->parameters['ppnPajak'] = $this->db->query("select * from db_coa where acc_name like '%ppn%'")->result();
		$Pr_SQL = "select * from db_subproject inner join pt on db_subproject.pt_id = pt.id_pt where db_subproject.pt_id <> 12";
		$this->parameters['ptProject'] = $this->db->query($Pr_SQL)->result();
		/*end updatean*/
                        
        $this->parameters['trxtype'] = $this->db->select('trxtype_id,trx_type')
				->where('trx_class','P')
				->order_by('trxtype_id','ASC')
				->get('db_trxtype')
				->result();
				
		 $this->parameters['sprojecst'] = $this->db->select('id_project,nm_subproject')
				->order_by('id','ASC')
				->get('db_subproject')
				->result();
																																
        $this->parameters['ppn'] = $this->db->select('id_tax,ppn')
				->where('tax_cd','ppn')
				->order_by('id_tax','ASC')
				->get('db_tax')
				->result();																											
																											
         $this->parameters['pph'] = $this->db->select('id_tax,pph')
				->where('tax_cd','pph')
				->order_by('pph','ASC')
				->get('db_tax')
				->result();																												
																											
		$this->parameters['cjc'] = $this->db->select('id_cjc,no_cjc')
				->where('flag_id',1)
				->order_by('no_cjc','ASC')
				->get('db_cjc')
				->result();				
		$this->parameters['po'] = $this->db->select('brgpoh_id,no_po')
				->where('isLockMR',1)
				->order_by('no_po','ASC')
				->get('db_barangPOH')
				->result();				
		$this->parameters['term'] = $this->db->select('term_cd,descs')
				->order_by('term_cd','ASC')
				->get('db_term')
				->result();		
																											
		$this->parameters['vendor'] = $this->db->select('kd_supp_gb,nm_supplier')
				->join('db_subproject','kd_project = subproject_id')
				->where('pt_id',$this->pt)
				->order_by('nm_supplier','ASC')
				->get('pemasok')
				->result();	
		$this->parameters['project_detail'] = $this->db->select('subproject_id,nm_subproject')
				->where('pt_id',44)
				->order_by('subproject_id','ASC')
				->get('db_subproject')
				->result();																												
		$this->parameters['project'] = $this->db->select('mainjob_id,(no_trbgtproj +"  ||  "+ left(mainjob_desc,49))  as no_trbgtproj')
				->where_not_in('no_trbgtproj','0')
				->order_by('mainjob_id','ASC')
				->get('db_mainjob')
				->result();
		$this->parameters['operational'] = $this->db->select('id_trbgt,form_kode,(code_id +"  ||  "+ remark) code' )
				->where('id_pt',$this->pt)
				->order_by('code_id','ASC')
				->get('db_trbgtdiv')
				->result();																												
																																													
			# Disable cek tahun untuk reset, by Fata
			/*$last_year = $this->db->query("select doc_year from db_document where type_document='AP'")->row()->doc_year;
			$year_now = date('Y');
			if($year_now>$last_year){
			$this->db->query("update db_document set doc_year='$year_now',no_document='0' where type_document='AP'");
			}*/
			$no = 1;
			$proj = 44;					
			
			# Disable ambil nilai urutan otomatis, by Fata
			/*$sql = $this->db->query("sp_cekapno ".$no.",".$proj."")->row();
			//var_dump($sql);
			$this->parameters['noap'] = $sql->no_ap;*/																										
            }		
			
		function get_json(){
		$this->set_custom_function('doc_date','indo_date');
		$this->set_custom_function('inv_date','indo_date');
		$this->set_custom_function('base_amt','currency');
		parent::get_json();
		}
		
		function index(){
			#die("test");
			$this->set_grid_column('apinvoice_id','ID',array('hidden'=>true));
			$this->set_grid_column('doc_no','AP No',array('width'=>160, 'formatter' => 'cellColumn'));
			$this->set_grid_column('doc_date','AP Date',array('width'=>160, 'formatter' => 'cellColumn'));
			$this->set_grid_column('inv_no','Inv No',array('width'=>160, 'formatter' => 'cellColumn'));
			$this->set_grid_column('inv_date','Inv Date',array('width'=>160, 'formatter' => 'cellColumn'));
			$this->set_grid_column('nm_supplier','Vendor',array('width'=>100, 'formatter' => 'cellColumn'));			
			$this->set_grid_column('descs','Descs',array('width'=>160, 'formatter' => 'cellColumn'));		
			$this->set_grid_column('base_amt','Amount',array('width'=>160, 'align'=>'right', 'formatter' => 'cellColumn'));		
			$this->set_jqgrid_options(array('width'=>1300,'height'=>350,'caption'=>'AP INVOICE','rownumbers'=>true,'sortname'=>'apinvoice_id','sortorder'=>'DESC'));
			parent::index();		
		}		
		
		function addkd(){
		ini_set("memory_limit","256M");
		$query = $this->db->query("select * from db_customer where kd_customer is null order by customer_id asc")->result();
		foreach($query as $row){
			$cid = $row->customer_id;
			if($cid<=9){
				$code = "CUST-00000".$cid;
			}elseif($cid<=99){
				$code = "CUST-0000".$cid;
			}elseif($cid<=999){
				$code = "CUST-000".$cid;
			}elseif($cid<=9999){
				$code = "CUST-00".$cid;
			}elseif($cid<=99999){
				$code = "CUST-0".$cid;
			}elseif($cid<=999999){
				$code = "CUST-".$cid;
			}
			$this->db->query("update db_customer set kd_customer='$code' where customer_id='$cid'");
			//echo $code."<br>";
		}
		}
		

		function getdata($id){
			$sql = $this->db->query("SP_ViewAPPO ".$id."")->row(); 
			die(json_encode($sql));
		}
		
		function getcjc($id){
			$sql = $this->db->query("SP_DatAPCJC ".$id."")->row(); 
			die(json_encode($sql));
		}
		
		function getdtl($id){
			$sql = $this->db->query("select *from pemasokmaster where kd_supp_gb='$id'")->row();
			die(json_encode($sql));
		}
		
		function getpph($id){
			$sql = $this->db->query("SP_getpph ".$id."")->row(); 
			die(json_encode($sql));
			
		}
		
		function getkelusaha($id){
			$sql = $this->db->query("SP_vendorcategory ".$id."")->row(); 
			die(json_encode($sql));
			
		}
		
		function nonkontrak($id){			
			
			$data = $this->db->select('mainjob_id,no_trbgtproj,mainjob_desc, mainjob_total')
							 ->where('mainjob_id',$id)
							 ->get('db_mainjob')->row();
	 
			die(json_encode($data));			
		}
		
		function operational($id){			
			
			$data = $this->db->select('id_trbgt,remark,amount')
							 ->where('id_trbgt',$id)
							 ->get('db_trbgtdiv')->row();
	 
			die(json_encode($data));			
		}
		
		function jnsusaha($id){			
			
			$data = $this->db->select('jns_usaha')
							 ->where('kd_supp_gb',$id)
							 ->get('pemasok')->row();
	 
			die(json_encode($data));			
		}
		
		function get_dg($no,$pt,$desc,$bln){

				$cekid = $no."/".$pt."/".$desc."/".$bln;
				
			$doc_no = $this->db->select('trx_type id')
							   ->where('doc_no',$cekid)
							   ->get('db_apinvoice')->row();
							   
							 //    die($doc_no->id);
							   
			// if ($doc_no->id == "CJC"){
							   
							  // // die($cekid);
				
				// $sql = $this->db->query("select id_other as no, voucher, acc_no1, acc_name, (debet/1.1) as debet, 0 as credit from db_apjurnal
							// inner join db_coa on db_coa.acc_no=db_apjurnal.acc_no1 where voucher='$cekid'
							// union
							// select id_other as no, voucher, acc_no2, acc_name, 0 as debet, (credit-(select pph from db_apinvoicedet where doc_no='$cekid') ) as credit from db_apjurnal
							// inner join db_coa on db_coa.acc_no=db_apjurnal.acc_no2 where voucher='$cekid'
							// union
							// select id_other as no, voucher, acc_no3, acc_name, (select ppn from db_apinvoicedet where doc_no='$cekid') as debet, 0 as credit from db_apjurnal
							// inner join db_coa on db_coa.acc_no=db_apjurnal.acc_no3 where voucher='$cekid'
							// union
							// select id_other as no, voucher, acc_no4, acc_name, 0 as debet, (select pph from db_apinvoicedet where doc_no='$cekid') as credit from db_apjurnal
							// inner join db_coa on db_coa.acc_no=db_apjurnal.acc_no4 where voucher='$cekid'")->result(); 
							
			// $xtampil = array();	

			// foreach($sql as $row){
				
			 // $xtampil[] = array 
			 // (
					 // 'xacc_no' => $row->acc_no1,
					 // 'acc_no' => $row->acc_no1,
					 // 'acc_name' => $row->acc_name,
					// // 'descs' => $row->descs,
					 // 'debet'	=>number_format($row->debet),
					 // 'credit'	=>number_format($row->credit),
					 // 'gl_id' => $row->no,
				 // );
			 // }
				
		 // die(json_encode($xtampil));
		 
		 // }else{
							
				$sql = $this->db->query("select id_other as no, doc_no as voucher, acc_no as acc_no1, acc_name as acc_name, descs, debet, credit 
													 from db_apinvoiceoth where doc_no='$cekid'")->result(); 
				
				// $getsql   = $this->db->where('ref_no',$cekid)
							 // ->get('db_gldetail')->result();		  				 
		 
			$xtampil = array();	

			foreach($sql as $row){
				
			 $xtampil[] = array 
			 (
					 'xacc_no' => $row->acc_no1,
					 'acc_no' => $row->acc_no1,
					 'acc_name' => $row->acc_name,
					 'descs' => $row->descs,
					 'debet'	=>number_format($row->debet),
					 'credit'	=>number_format($row->credit),
					 'gl_id' => $row->no,
				 );
			 }
				
		 die(json_encode($xtampil));
	//	}
	} 	
	function get_dg2($no,$pt,$desc,$bln){

				$cekid = $no."/".$pt."/".$desc."/".$bln;
							
				$sql = $this->db->query("select id_other as no, doc_no as voucher, acc_no as acc_no1, descs as acc_name, debet, credit from db_apinvoiceoth where doc_no='$cekid'")->result(); 
				
				// $getsql   = $this->db->where('ref_no',$cekid)
							 // ->get('db_gldetail')->result();		  				 
		 
			$xtampil = array();	

			foreach($sql as $row){
				
			 $xtampil[] = array 
			 (
					 'acc_no' => $row->acc_no1,
					 'descs' => $row->acc_name,
					 'debet'	=>number_format($row->debet),
					 'credit'	=>number_format($row->credit),
					 'gl_id' => $row->no,
				 );
			 }
				
		 die(json_encode($xtampil));
		
	} 	
	
		function lempar($no,$thn,$bln,$urut){
//		$voucher = $this->input->
		extract(PopulateForm());
		$data = $no."/".$thn."/".$bln."/".$urut;
		
		
		
		
		
		$getsql = $this->db->select('convert(varchar,CONVERT(money, sum(debet)),1) as debet, convert(varchar,CONVERT(money, sum(credit)),1) as credit, doc_no, 0 as amo')
						  
						   ->where('doc_ref',$data)
						   ->group_by('doc_no')
						 //  ->where('descs',$remark)
						   ->get('db_apinvoiceoth_temp')->row();
				
		echo json_encode($getsql);
		
		}
		
		function lemparap($no,$thn,$bln,$urut){
//		$voucher = $this->input->
		extract(PopulateForm());
		$data = $no."/".$thn."/".$bln."/".$urut;
		
		
		$account = array('2.01.01.01.01','2.01.01.01.02','2.01.01.01.03','2.01.01.02.01','2.01.01.02.02','2.01.01.02.03','2.01.01.03','2.01.01.04');
		
		
		$getsql = $this->db->select('convert(varchar,CONVERT(money, sum(debet)),1) as debet, convert(varchar,CONVERT(money, sum(credit)),1) as credit, doc_no')
						  
						   ->where('doc_ref',$data)
						    ->where_in('acc_no',$account)
						   ->group_by('doc_no')
						 //  ->where('descs',$remark)
						   ->get('db_apinvoiceoth_temp')->row();
				
		echo json_encode($getsql);
		
		}
		
		function lempar_edit($no,$thn,$bln,$urut){
//		$voucher = $this->input->
		extract(PopulateForm());
		$data = $no."/".$thn."/".$bln."/".$urut;
		
		
		
		
		
		$getsql = $this->db->select('convert(varchar,CONVERT(money, sum(debet)),1) as debet, convert(varchar,CONVERT(money, sum(credit)),1) as credit')
						  
						   ->where('doc_no',$data)
						   //->group_by('doc_no')
						 //  ->where('descs',$remark)
						   ->get('db_apinvoiceoth')->row();
				
		echo json_encode($getsql);
		
		}
	
		//function show_form($no,$pt,$desc,$bln,$rema){
		function show_form($no,$pt,$desc,$bln){
		
			$session = $this->UserLogin->isLogin();
			$pt = $session['id_pt'];
		
			$index = $_GET['index'];
			//$data['xref']   = $xref;
			$sql = $this->db->select('acc_no id,(acc_no +"  ||  "+ acc_name) nama')
										->where('id_pt',$pt)
										->where('type',2)
										->get('db_coa')->result();
			$data['no_bgt'] = $no."/".$pt."/".$desc."/".$bln;
			//$data['rem'] = $rema;	
			
			$this->load->view("ap/show_ap",$data);
		}	
		
		//function show_manual($no,$pt,$desc,$bln,$amo){
		function show_manual($no,$pt,$desc,$bln){
		
			$session = $this->UserLogin->isLogin();
			$pt2 = $session['id_pt'];
			
			$index = $_GET['index'];
			//$data['xref']   = $xref;
			$sql = $this->db->select('acc_no id,(acc_no +"  ||  "+ acc_name) nama')
										->where('id_pt',$pt2)
										->where('type',2)
										->get('db_coa')->result();
			$data['no_bgt'] = $no."/".$pt."/".$desc."/".$bln;
			//$data['rem'] = $rema;	
			//$data['amo1'] = $amo;	
			
			$this->load->view("ap/show_manual",$data);
		}	
		
		function budgetproject($id){
		
			$this->db->select('kd_bgtproj, coa_no');
			$this->db->from('db_trbgtproj');
			$this->db->join('db_bgtproj', 'db_bgtproj.kode_bgtproj = db_trbgtproj.kd_bgtproj');
			$this->db->where('db_trbgtproj.kd_bgtproj',$id);
			$query = $this->db->get();	
			//$sql = $this->db->query("SP_Searchbudgetproject ".$id."")->row(); 

			die(json_encode($query));
			
		}		
		
		function loadbudget($id){
			$data = $this->db->select('id_cjc,no_cjc')
							 ->where('id_cjc',$id)
							 ->get('db_cjc')->row();
	 
			die(json_encode($data));			
		}	
						
		function cekdata(){			
				$data = array();
				$this->db->select('*')->from('db_cashheader')
											->where('voucher','')
											->order_by('voucher', 'desc');
				$Q = $this-> db-> get();
				if ($Q-> num_rows() > 0){
				foreach ($Q-> result_array() as $row){
				$data[] = $row;
				}
				}
				$Q-> free_result();
				echo json_encode($data);
		}
		
		function loadcoa(){			
		
		$session = $this->UserLogin->isLogin();
		$pt = $session['id_pt'];
		
		                                     $sql = "select acc_no,(acc_no + '  ||  ' + left(acc_name,30)) AS name
                                                            from db_coa
                                                            where type= 2 and id_pt=$pt";
                                                            
                                    $data = $this->db->query($sql)->result();                    

				echo json_encode($data);
		}
		
		function budget(){			

		 $data = array();
				$this->db->select('kode_bgtproj,nm_bgtproj')->from('db_bgtproj')
																	->group_by(array("kode_bgtproj", "nm_bgtproj"))
																	->order_by('kode_bgtproj', 'Asc');
				$Q = $this-> db-> get();
				if ($Q-> num_rows() > 0){
				foreach ($Q-> result_array() as $row){
				$data[] = $row;
				}
				}
				$Q-> free_result();
				echo json_encode($data);
		}
		
		function loaddivisi(){			

		 $data = array();
				$this->db->select('divisi_id,divisi_nm')->from('db_divisi')
																		->order_by('divisi_id', 'Asc');
				$Q = $this-> db-> get();
				if ($Q-> num_rows() > 0){
				foreach ($Q-> result_array() as $row){
				$data[] = $row;
				}
				}
				$Q-> free_result();
				echo json_encode($data);
		}
		
		function tax(){			

		 $data = array();
				$this->db->select('id_tax,tax_cd')->from('db_tax')
																		->order_by('id_tax', 'Asc');
				$Q = $this-> db-> get();
				if ($Q-> num_rows() > 0){
				foreach ($Q-> result_array() as $row){
				$data[] = $row;
				}
				}
				$Q-> free_result();
				echo json_encode($data);
		}
		
		function update($id){
		//die('test');
		$noap = $this->db->query("select doc_no from db_apinvoice where apinvoice_id = '$id'")->row()->doc_no;
		$cek_status = $this->db->select('status as id')
							   ->where('apinvoice_id',$id)
							   ->get('db_apinvoice')->row();
							   
		if($cek_status->id != 0 ){
			echo"
				<script type='text/javascript'>
					alert('Sudah di approve');
					refreshTable();
				</script>
			";
		}else{
			parent::update($id);
		}
		}
		
		function tam(){
			//die($id);	
			$session_id = $this->UserLogin->isLogin();
			$pt	= $session_id['id_pt'];
			
			if ($pt==44){																																								
				$no = 1;
				$proj = 44;														   
				$sql = $this->db->query("sp_cekapno ".$no.",".$proj."")->row();
				//var_dump($sql);
						
				$this->load->view('ap/apinvoice-tam',$sql);
			} else {
				$data['vendor'] = $this->db->select('kd_supp_gb,nm_supplier')
					->join('db_subproject','kd_project = subproject_id')
					->where('pt_id',$pt)
					->order_by('nm_supplier','ASC')
					->get('pemasok')
					->result();
				$this->load->view('ap/apinvoice-tamx',$data);
			}
		
		}
		
		
		function loaddata(){
			#die($this->input->post('parent_id'));
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				//$trx_type = $this->input->post('trx_type');
				$t = 'CJC';
				//die($parent_id);				
				
				switch($data_type){
					case 'trx_type':
					    $sql = $this->db->select('trxtype_id id,trx_type nama')
										->where('trx_class','P')
										->get('db_trxtype')->result();
						break;
						
						
						case 'noreff':
							    $sql = $this->db->select('id_cjc id,no_cjc nama')
										->like('no_cjc',$t)
										->get('db_cjc')->result();
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
		
		function loaddatacoa(){
			#die($this->input->post('parent_id'));
			
			$session = $this->UserLogin->isLogin();
			$pt = $session['id_pt'];
			
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				
				switch($data_type){
					case 'acc_no':
					    $sql = $this->db->select('acc_no id,(acc_no +"  ||  "+ acc_name) nama')
										->where('id_pt',$pt )
										->where('type',2)
										->get('db_coa')->result();

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
		
		function approve(){                

					$doc_no = $this->input->post('doc_no');
					
					$query = $this->db->query("sp_approveap '".$doc_no."'");
					die('sukses');		
					
                        }       
						
		// function view($id){
		// //die('test');
		 // $cek_status = $this->db->select('status as id')
							   // ->where('apinvoice_id',$id)
							   // ->get('db_apinvoice')->row();
							   
		// // $cek_bank = $this->db->select('slip_date as date')
							   // // ->where('id_cash',$id)
							   // // ->get('db_cashheader')->row();
							   
		// if($cek_status->id >= 1 ){
			// echo"
				// <script type='text/javascript'>
					// alert('Sudah di approve');
					// refreshTable();
				// </script>
			// ";
		// }else{
			// parent::update($id);
		// }
		// }
						
		// function view($id){       


					// $doc_no = $this->db->select('doc_no')
							   // ->where('apinvoice_id',$id)
							   // ->get('db_apinvoice')->row();
							   
							   // var_dump($doc_no);

					// //$doc_no = $this->input->post('doc_no');
					
					// $query = $this->db->query("sp_approveap '".$doc_no."'");
					// redirect('apinvoice');		
					
                        // }      
		
		function savedetail(){
		
					$po_no = $_REQUEST['po_no'];
					$tax = $_REQUEST['tax'];
					$line_desc = $_REQUEST['line_desc'];
					$amount = $_REQUEST['amount'];
					$input_user = $this->user;
					$data = array
					(
						'po_no'=>$po_no,
						'tax'=>$tax,
						'line_desc'=>$line_desc,
						'amount'=>$amount						
					);	
		
					$query = $this->db->query("sp_Insertapinvoicedetail '".$po_no."','".$tax."','".$line_desc."',".$amount."");       

			}		
					
			function savedetail2(){
		
					$acc_no = $_REQUEST['acc_no'];
					$tax = $_REQUEST['tax'];
					$line_desc = $_REQUEST['line_desc'];
					$amount = $_REQUEST['amount'];
					$input_user = $this->user;
			
					$data = array
					(
						'acc_no'=>$acc_no,
						'tax'=>$tax,
						'line_desc'=>$line_desc,
						'amount'=>$amount						
					);	
		
					$query = $this->db->query("sp_Insertapinvoicedetail2 '".$acc_no."','".$tax."','".$line_desc."',".$amount."");       

			}	
			
		function saveheader(){

					//Start change, by Fata
						# cek tahun untuk reset
						$last_year = $this->db->query("select max(doc_year) as doc_year from db_document where type_document='AP'")->row()->doc_year;
						$inv_date = $this->input->post('inv_date');
						$year_now = substr($inv_date,6,4);
						//die($last_year." ".$year_now);
						if($year_now>$last_year){
						$this->db->query("insert into db_document values('AP','0','','$year_now')");
						}
						$new_no = $this->db->query("select max(no_document) as no_document from db_document where type_document='AP' and doc_year='$year_now'")->row()->no_document+1;
						$m = substr($inv_date,3,2);
						if(($m==11) or ($m==12)){
						$mon = $m;
						}else{
						$mon = substr($m,1,1);
						}						
						if($new_no<=9){
						$doc_no = "AP/".$year_now."/".$mon."/0000".$new_no;
						}elseif($new_no<=99){
						$doc_no = "AP/".$year_now."/".$mon."/000".$new_no;
						}elseif($new_no<=999){
						$doc_no = "AP/".$year_now."/".$mon."/00".$new_no;
						}elseif($new_no<=9999){
						$doc_no = "AP/".$year_now."/".$mon."/0".$new_no;
						}elseif($new_no<=99999){
						$doc_no = "AP/".$year_now."/".$mon."/".$new_no;
						}
						//die($doc_no);
						# update nilai urutan ap tbl db_document
						$this->db->query("update db_document set no_document='$new_no' where type_document='AP' and doc_year='$year_now'");
					//End change, by Fata
					$ap_proj = $this->input->post('ap_project');
					$inv_no = $this->input->post('inv_no');
					$receipt_date = $this->input->post('receipt_date');
					$inv_date = $this->input->post('inv_date');
					$trx_type = $this->input->post('trx_type');
					$cr_term = $this->input->post('cr_term');
					$po = $this->input->post('po');
					$vendor = $this->input->post('vendor');
					$amount = $this->input->post('amount');
					$category = $this->input->post('category');
					$ppn = $this->input->post('ppn');
					$total_billing = $this->input->post('total_billing');
					$pph = $this->input->post('pph');
					$paid_billing = $this->input->post('paid_billing');
					$balance = $this->input->post('balance');
					$remark = $this->input->post('remark');
					$dtprv['doc_no'] = $doc_no;		
					$input_user = $this->user;
					

						$query = $this->db->query("sp_Insertapinvoice '".$ap_proj."','".$doc_no."','".$inv_no."'
						,'".inggris_date($receipt_date)."','".inggris_date($inv_date)."','".$trx_type."','".$cr_term."','".$po."','".$vendor."','".replace_numeric($amount)."','".$category."','".replace_numeric($ppn)."','".replace_numeric($total_billing)."','".$pph."',
						'".$paid_billing."','".$balance."','".$remark."'");
									
					//$query = $this->db->query("sp_Insertapinvoice '".$doc_no."','".$inv_no."','".inggris_date($tgl)."','".inggris_date($inv_date)."','".$vendor."','".$cr_term."','".$pph."','".$fromto."','".$remark."','".$cjc."',".replace_numeric($amount)."");
					//$this->load->view('ap/print/print_rpayvoucher',$dtprv);
					redirect('ap/apinvoice');				              
				
			}	
			
		function saveheader2(){

					//Start change, by Fata
						# cek tahun untuk reset
						$last_year = $this->db->query("select max(doc_year) as doc_year from db_document where type_document='AP'")->row()->doc_year;
						$inv_date = $this->input->post('inv_date2');
						$year_now = substr($inv_date,6,4);
						if($year_now>$last_year){
						$this->db->query("insert into db_document values('AP','0','','$year_now')");
						}
						$new_no = $this->db->query("select max(no_document) as no_document from db_document where type_document='AP' and doc_year='$year_now'")->row()->no_document+1;
						$m = substr($inv_date,3,2);
						if(($m==11) or ($m==12)){
						$mon = $m;
						}else{
						$mon = substr($m,1,1);
						}		
						if($new_no<=9){
						$doc_no = "AP/".$year_now."/".$mon."/0000".$new_no;
						}elseif($new_no<=99){
						$doc_no = "AP/".$year_now."/".$mon."/000".$new_no;
						}elseif($new_no<=999){
						$doc_no = "AP/".$year_now."/".$mon."/00".$new_no;
						}elseif($new_no<=9999){
						$doc_no = "AP/".$year_now."/".$mon."/0".$new_no;
						}elseif($new_no<=99999){
						$doc_no = "AP/".$year_now."/".$mon."/".$new_no;
						}
						# update nilai urutan ap tbl db_document
						$this->db->query("update db_document set no_document='$new_no' where type_document='AP' and doc_year='$year_now'");
					//End change, by Fata
					$ap_proj = $this->input->post('ap_project2');
					$inv_no = $this->input->post('inv_no2');
					$receipt_date = $this->input->post('receipt_date2');
					//$inv_date = $this->input->post('inv_date2');
					$trx_type = $this->input->post('trx_type2');
					$trx_type2 = $this->input->post('trx_type21');
					$cr_term = $this->input->post('cr_term2');
					$po = $this->input->post('project2');
					$vendor = $this->input->post('vendor2');
					$amount = $this->input->post('amount2');
					$category = $this->input->post('category2');
					$ppn = 1;
					$total_billing = $this->input->post('total_billing2');
					$pph = $this->input->post('pph2');
					$paid_billing = $this->input->post('paid_billing2');
					$balance = $this->input->post('balance2');
					$remark = $this->input->post('remark2');
					$dtprv['doc_no2'] = $doc_no;
					$input_user = $this->user;
					
	
					
					if ($trx_type2 == 1){
							$po = $this->input->post('project2');
						}else{
							$po = $this->input->post('operational2');
						}
		//die($po);
						$query = $this->db->query("sp_Insertapinvoice2 '".$doc_no."','".$inv_no."',".$trx_type2."
						,'".inggris_date($receipt_date)."','".inggris_date($inv_date)."',".$trx_type.",".$cr_term.",'".$po."','".$vendor."',".replace_numeric($amount).",'".$category."',".replace_numeric($ppn).",'".$pph."','".$remark."'");
								
					//$query = $this->db->query("sp_Insertapinvoice '".$doc_no."','".$inv_no."','".inggris_date($tgl)."','".inggris_date($inv_date)."','".$vendor."','".$cr_term."','".$pph."','".$fromto."','".$remark."','".$cjc."',".replace_numeric($amount)."");
					//$this->load->view('ap/print/print_rpayvoucher2',$dtprv);
					redirect('ap/apinvoice');				              
			}			
		function saveheader3(){

					//Start change, by Fata
						# cek tahun untuk reset
						$last_year = $this->db->query("select max(doc_year) as doc_year from db_document where type_document='AP'")->row()->doc_year;
						$inv_date = $this->input->post('inv_date3');
						$year_now = substr($inv_date,6,4);
						if($year_now>$last_year){
						$this->db->query("insert into db_document values('AP','0','','$year_now')");
						}
						$new_no = $this->db->query("select max(no_document) as no_document from db_document where type_document='AP' and doc_year='$year_now'")->row()->no_document+1;
						$m = substr($inv_date,3,2);
						if(($m==11) or ($m==12)){
						$mon = $m;
						}else{
						$mon = substr($m,1,1);
						}		
						if($new_no<=9){
						$doc_no = "AP/".$year_now."/".$mon."/0000".$new_no;
						}elseif($new_no<=99){
						$doc_no = "AP/".$year_now."/".$mon."/000".$new_no;
						}elseif($new_no<=999){
						$doc_no = "AP/".$year_now."/".$mon."/00".$new_no;
						}elseif($new_no<=9999){
						$doc_no = "AP/".$year_now."/".$mon."/0".$new_no;
						}elseif($new_no<=99999){
						$doc_no = "AP/".$year_now."/".$mon."/".$new_no;
						}
						# update nilai urutan ap tbl db_document
						$this->db->query("update db_document set no_document='$new_no' where type_document='AP' and doc_year='$year_now'");
					//End change, by Fata
					$inv_no = $this->input->post('inv_no3');
					$receipt_date = $this->input->post('receipt_date3');
					$inv_date = $this->input->post('inv_date3');
					$trx_type = $this->input->post('trx_type3');
					$cr_term = $this->input->post('cr_term3');
					$po = $this->input->post('cjc3');
					$cip = $this->input->post('cip3');
					$ap_proj = $this->input->post('ap_project3');
					$vendor = $this->input->post('vendor3');
					$amount = $this->input->post('amount3');
					$category = $this->input->post('category3');
					$ppn = $this->input->post('ppn3');
					$total_billing = $this->input->post('total_billing3');
					$pph = $this->input->post('pph3');
					$paid_billing = $this->input->post('paid_billing3');
					$balance = $this->input->post('balance3');
					$remark = $this->input->post('remark3');
					$dtprv['doc_no3'] = $doc_no;
					$input_user = $this->user;
		
						$query = $this->db->query("sp_Insertapinvoicecjc '".$doc_no."','".$inv_no."'
						,'".inggris_date($receipt_date)."','".inggris_date($inv_date)."',".$trx_type.",".$cr_term.",'".$po."','".$cip."','".$vendor."',".replace_numeric($amount).",'".$category."',".replace_numeric($ppn).",'".replace_numeric($total_billing)."','".$pph."','"
						.$paid_billing."','".$balance."','".$remark."'");
									
					//$query = $this->db->query("sp_Insertapinvoice '".$doc_no."','".$inv_no."','".inggris_date($tgl)."','".inggris_date($inv_date)."','".$vendor."','".$cr_term."','".$pph."','".$fromto."','".$remark."','".$cjc."',".replace_numeric($amount)."");
					//$this->load->view('ap/print/print_rpayvoucher3',$dtprv);
					redirect('ap/apinvoice');				              
			}				

			function saveheader4(){

					//Start change, by Fata
						# cek tahun untuk reset
						$last_year = $this->db->query("select max(doc_year) as doc_year from db_document where type_document='AP'")->row()->doc_year;
						$year_now = date('Y');
						if($year_now>$last_year){
						$this->db->query("insert into db_document values('AP','0','','$year_now')");
						}
						$new_no = $this->db->query("select max(no_document) as no_document from db_document where type_document='AP' and doc_year='$year_now'")->row()->no_document+1;
						$m = date('m');
						if(($m==11) or ($m==12)){
						$mon = $m;
						}else{
						$mon = substr($m,1,1);
						}		
						if($new_no<=9){
						$doc_no = "AP/".date('Y')."/".$mon."/0000".$new_no;
						}elseif($new_no<=99){
						$doc_no = "AP/".date('Y')."/".$mon."/000".$new_no;
						}elseif($new_no<=999){
						$doc_no = "AP/".date('Y')."/".$mon."/00".$new_no;
						}elseif($new_no<=9999){
						$doc_no = "AP/".date('Y')."/".$mon."/0".$new_no;
						}elseif($new_no<=99999){
						$doc_no = "AP/".date('Y')."/".$mon."/".$new_no;
						}
						# update nilai urutan ap tbl db_document
						$this->db->query("update db_document set no_document='$new_no' where type_document='AP' and doc_year='$year_now'");
					//End change, by Fata
					$inv_no = $this->input->post('inv_no');
					$receipt_date = $this->input->post('receipt_date');
					$inv_date = $this->input->post('inv_date');
					$due_date = $this->input->post('due_date');
					$vendor = $this->input->post('vendor');
					$amount2 = $this->input->post('amount');
					$project_detail = $this->input->post('project_detail');
					$input_user = $this->user;
					// $ppn = $this->input->post('ppn');
					// $pph = $this->input->post('pph');
					// $pphamount = $this->input->post('pphamount');
					$ppn = 0;
					$pph = 0;
					$pphamount = 0;
					$remark = $this->input->post('remark');
					$dtprv['doc_no'] = $doc_no;
					
					$debet = $this->db->select('sum(debet)')
					->where('doc_ref',$doc_no)
					->get('db_apinvoiceoth_temp')->result();
			
					$credit = $this->db->select('sum(credit)')
					->where('doc_ref',$doc_no)
					->get('db_apinvoiceoth_temp')->result();
			
					$cekvoucher = $this->db->select('doc_no')
												->where('doc_ref',$doc_no)
												->get('db_apinvoiceoth_temp')->row();
												
					$amount = $this->db->select('(sum(debet)+sum(credit)) as amount')
												->where('doc_ref',$doc_no)
												->get('db_apinvoiceoth_temp')->row();
												
					if($debet <> $credit){
						die("Jurnal Tidak Balance");
						}elseif (empty($cekvoucher)){
						die("Jurnal Masih Kosong");
					}elseif ($amount->amount == 0){
						die("Jurnal Masih 0");
					}else{
		
						$query = $this->db->query("sp_Insertapinvoicemanual '".$doc_no."','".$inv_no."','".$input_user."','".$project_detail."'
						,'".inggris_date($receipt_date)."','".inggris_date($inv_date)."','".inggris_date($due_date)."','".$vendor."',".replace_numeric($amount2).",".replace_numeric($ppn).",'".$pph."',".replace_numeric($pphamount).",'".$remark."'");
									
					//$query = $this->db->query("sp_Insertapinvoice '".$doc_no."','".$inv_no."','".inggris_date($tgl)."','".inggris_date($inv_date)."','".$vendor."','".$cr_term."','".$pph."','".$fromto."','".$remark."','".$cjc."',".replace_numeric($amount)."");
					//$this->load->view('ap/print/print_rpayvoucher3',$dtprv);
					//redirect('apinvoice');	
					die('sukses');
					}					
			}			

				function saveheader_edit(){

					$doc_no = $this->input->post('doc_no');
					$inv_no = $this->input->post('inv_no');
					$receipt_date = $this->input->post('receipt_date');
					$inv_date = $this->input->post('inv_date');
					$due_date = $this->input->post('due_date');
					$vendor = $this->input->post('vendor');
					$project_detail = $this->input->post('project_detail');
					$amount2 = $this->input->post('amount');
					$input_user = $this->user;
					// $ppn = $this->input->post('ppn');
					// $pph = $this->input->post('pph');
					// $pphamount = $this->input->post('pphamount');
					$ppn = 0;
					$pph = 0;
					$pphamount = 0;
					$remark = $this->input->post('remark');
					$dtprv['doc_no'] = $doc_no;
					//die($doc_no);
					
					$debet = $this->db->select('sum(debet)')
					->where('doc_no',$doc_no)
					->get('db_apinvoiceoth')->result();
			
					$credit = $this->db->select('sum(credit)')
					->where('doc_no',$doc_no)
					->get('db_apinvoiceoth')->result();
			
					$cekvoucher = $this->db->select('doc_no')
												->where('doc_no',$doc_no)
												->get('db_apinvoiceoth')->row();
					$proj = $this->db->select('project_no')
												->where('doc_no',$doc_no)
												->get('db_apinvoice')->result();
												
					$amount = $this->db->select('(sum(debet)+sum(credit)) as amount')
												->where('doc_no',$doc_no)
												->get('db_apinvoiceoth')->row();
												
					if($debet <> $credit){
						die("Jurnal Tidak Balance");
						}elseif (empty($cekvoucher)){
						die("Jurnal Masih Kosong");
					}elseif ($amount->amount == 0){
						die("Jurnal Masih 0");
					}else{
		
						$query = $this->db->query("sp_Insertapinvoicemanual '".$doc_no."','".$inv_no."','".$input_user."','".$proj."'
						,'".inggris_date($receipt_date)."','".inggris_date($inv_date)."','".inggris_date($due_date)."','".$vendor."',".replace_numeric($amount2).",".replace_numeric($ppn).",'".$pph."',".replace_numeric($pphamount).",'".$remark."'");
									
					//$query = $this->db->query("sp_Insertapinvoice '".$doc_no."','".$inv_no."','".inggris_date($tgl)."','".inggris_date($inv_date)."','".$vendor."','".$cr_term."','".$pph."','".$fromto."','".$remark."','".$cjc."',".replace_numeric($amount)."");
					//$this->load->view('ap/print/print_rpayvoucher3',$dtprv);
					//redirect('apinvoice');	
					die('sukses');
					}					
			}	
			
		function print_slip($id){	
			$qdata = $this->db->select('status')
							  ->where('apinvoice_id',$id)
							   ->get('db_apinvoice')->row();
			if($qdata->status != 0){
					echo"
							<script type='text/javascript'>
								alert('AP telah di proses');
								document.location.href = 'apinvoice'
								window.close();
							</script>
						
						";
			}else{	

			$dtprv['id'] = $id;
			$session = $this->UserLogin->isLogin();
			$dtprv['pt'] = $session['id_pt'];
			//die($dtprv['pt']);
			$qvou = "select doc_no from db_apinvoice where apinvoice_id = $id";
			
			$dtprv['doc_no'] = $this->db->query($qvou)->row();
			
		
			$this->load->view('ap/print/print_rpayvoucher4',$dtprv);
		
		}

		}
			
			// function delete(){
		
					// $trxtype = intval($_REQUEST['trx_type']);
				// die($trxtype);
		
					              
					// //if($trxtype_id){
						// $this->db->where('trx_type',$trxtype);
						// $this->db->delete('db_trxtype');
						// echo"Data berhasil didelete";
					// //}else{	
						// // $this->db->insert('db_trxtype',$data);								
						// // echo"Data berhasil tersimpan";
					// // }
			// }		
			
			function delete($a){
			
				
					// $acc_no = $_REQUEST['acc_no'];
					
					$gl_id = $_REQUEST['gl_id'];
		
					//$trxtype = intval($_REQUEST['trx_type']);
				//$id = $_REQUEST['a'];
				//die($a);
				//$data = $a."/".$thn."/".$bln."/".$urut;
				//die($data);
					              
					//if($trxtype_id){
						$this->db->where('id_other',$a);
						$this->db->delete('db_apinvoiceoth');
					//	echo"Data berhasil didelete";
					//}else{	
						// $this->db->insert('db_trxtype',$data);								
						// echo"Data berhasil tersimpan";
					// }
			
			
			}

			
			function savejurnal(){				
			
					$acc_no = $_REQUEST['acc_no'];
					$dept = '44';
					$acc_name = $_REQUEST['acc_name'];
					$descs = $_REQUEST['descs'];
					$debit = $_REQUEST['debet'];
					$credit = $_REQUEST['credit'];
					$voucher = $_REQUEST['no_bgt'];
					$xacc_no = $_REQUEST['xacc_no'];
					$id_gl = $_REQUEST['gl_id'];
					$input_user = $this->user;
					
					//die($id_gl);
					
		
				
					$data = array
					(
						'voucher'=>$voucher,
						'acc_no'=>$acc_no,
						'acc_name'=>$acc_name,
						'xacc_no'=>$xacc_no,
						'debet'=>$debit,
						'credit'=>$credit,
						'gl_id'=>$id_gl
						
					);	
					
												
				$query = $this->db->query("sp_updatejurnalap  '".$voucher."','".$id_gl."','".$acc_no."','".$acc_name."','".$descs."',".replace_numeric($debit).",".replace_numeric($credit).",'".$xacc_no."'");
											
							
				 $gl_desc = $this->db->select('acc_name')
												// ->where('voucher',$voucher)
												->where('acc_no',$acc_no)
												->get('db_coa')->row();
				
				
				$xtampil = array 
				(
					 //'xacc_no' => $xacc_no,
					//'gl_id' => $id_gl,
					 'acc_no' => $acc_no,
					 'acc_name' => $acc_name,
					 //'descs' => $gl_desc->acc_name,		
					 'descs' => $descs,
					 'debet' => $debit ,	 
					 'credit' => $credit

				);
			die(json_encode($xtampil));
			
			}
			
			function savemanual(){				
			
					$acc_no = $_REQUEST['acc_no'];
					$dept = '44';
					$acc_name = $_REQUEST['acc_name'];
					$descs = $_REQUEST['descs'];
					$debet = $_REQUEST['debet'];
					$credit = $_REQUEST['credit'];
					$voucher = $_REQUEST['no_bgt'];
					$gl_id = $_REQUEST['gl_id'];
					$input_user = $this->user;
			
					$data = array
					(
						'doc_no'=>$voucher,
						'acc_name'=>$acc_name,
						'descs'=>$descs,
						'acc_no'=>$acc_no,
						'debet' => $debet,
						'credit' => $credit
					
					);	


												
				$query = $this->db->query("sp_insertapmanual  '".$voucher."','".$acc_name."',".$gl_id.",'".$descs."','".$acc_no."',".replace_numeric($debet).",".replace_numeric($credit)."");
											
					if ($gl_id == 0){
			
					 $id_other = $this->db->select_max('id_other')
												 ->where('doc_ref',$voucher)
												->get('db_apinvoiceoth_temp')->row();
					}else{
					$id_other = $this->db->select('id_other')
												 ->where('id_other',$gl_id)
												->get('db_apinvoiceoth_temp')->row();
					}
																			
					$xtampil = array 
				( 
					 'xacc_no' => $acc_no,
					 'gl_id' => $id_other->id_other,
					 'acc_no' => $acc_no,
					 'acc_name' => $acc_name,
					 'descs'=>$descs,
					 'debet' => $debet,
					 'credit' => $credit

				);
					die(json_encode($xtampil));
					
				// }else{
				
					// $query = $this->db->query("sp_insertapmanual  '".$voucher."','".$acc_name."','".$descs."','".$acc_no."',".replace_numeric($debet).",".replace_numeric($credit)."");
					// $xtampil = array 
				// (
					 // //'xacc_no' => $xacc_no,
					// //'gl_id' => $gl_id,
					 // 'acc_no' => $acc_no,
					 // 'acc_name' => $acc_name,
					 // 'descs'=>$descs,
					 // 'debet' => $debet,
					 // 'credit' => $credit

				// );
					// die(json_encode($xtampil));
					// }
			
			}
			
	function getaccname($id){
			extract(PopulateForm());
		
		    $sql = $this->db->query("SP_Cekaccname '".$id."'")->row();
							    
		    
		    die(json_encode($sql));

				
		}
				
			
		function input(){
				    //extract(PopulateForm());
					
					$trxtype_id = $this->input->post('trxtype_id');
					$trxtype 	= $this->input->post('trx_type');
					$descs 		= $this->input->post('descs');
					$trxmode 		= $this->input->post('select');
					$session_id = $this->UserLogin->isLogin();
		
					$pt = $session_id['id_pt'];
	
					$user = $session_id['id'];
				//die($trxtype_id);	
					$data = array
					(
						'trx_type'=>$trxtype,
						'descs'=>$descs,
						'trx_mode'=>$trxmode						
					);	
		
					              
					if($trxtype_id){
						$this->db->where('trxtype_id',$trxtype_id);
						$this->db->update('db_trxtype',$data);
						echo"Data berhasil terupdate";
					}else{	
						$this->db->insert('db_trxtype',$data);								
						echo"Data berhasil tersimpan";
					}
			}	

		function apcust(){
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->pt	= $session_id['id_pt'];
			$data['pph'] = $this->db->query("select * from db_coa where id_pt = ".$this->pt." and acc_name like 'pph%'")->result();
			$data['vendor'] = $this->db->query('select * from pemasok a join db_subproject b on a.kd_project = b.subproject_id where pt_id = '.$this->pt.' order by nm_supplier asc')->result();
			$data['project'] = $this->db->query('select * from db_subproject where id_pt = 11 order by subproject_id asc')->result();
			$this->load->view('ap/apcustomer',$data);
		}	

		function viewss($id){
			#die($id);
			$qdata = $this->db->select('status')
							  ->where('apinvoice_id',$id)
							   ->get('db_apinvoice')->row();
			if($qdata->status != 0){
					echo"
							<script type='text/javascript'>
								alert('AP telah di proses');
								document.location.href = 'apinvoice'
								refreshTable();
							</script>
						
						";
			}else{	
				#die("tes");

					$session_id = $this->UserLogin->isLogin();
					$pt	= $session_id['id_pt'];
					$cek = $this->db->query("select trx_type,doc_no from db_apinvoice where apinvoice_id = ".$id."")->row();
				#	if (($pt == 11) and ($cek->trx_type == 'MAN')) {
						$data['detail'] = $this->db->query("select *
													 from db_apinvoice 
													 left join pemasokmaster on vendor_acct = kd_supp_gb
													 left join db_subproject on project_no = subproject_id
													 where apinvoice_id = ".$id." ")
												   ->row();
						$data['kelusaha'] =	$this->db->query("select * from db_apinvoiceoth where doc_no ='".$cek->doc_no."' and acc_name like ('ap%')")->row();											   
						$data['vendor'] = $this->db->select('kd_supp_gb,nm_supplier')
							->join('db_subproject','kd_project = subproject_id')
							->where('pt_id',$pt)
							->order_by('nm_supplier','ASC')
							->get('pemasokmaster')
							->result();
						
					#} 

					$this->load->view('ap/apinvoice-viewx',$data);

			}


		}		
	}
?>
