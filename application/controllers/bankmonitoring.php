<?php
	class bankmonitoring extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('bankmonitoring_model');
			$this->set_page_title('List Of Employee');
			$this->default_limit = 30;
			$this->template_dir = 'cb/bankmonitoring';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
		}
		
		protected function setup_form($data=false){
                        
                        $this->parameters['bank'] = $this->db->select('bank_id,bank_nm')
                                                                                                            ->order_by('bank_id','ASC')
                                                                                                            ->get('db_bank')
                                                                                                            ->result();            
						$this->parameters['trxtype'] = $this->db->select('trxtype_id,trx_type')
																											->where('trx_type','BM')
                                                                                                            ->order_by('trxtype_id','ASC')
                                                                                                            ->get('db_trxType')
                                                                                                            ->result();     					
						$this->parameters['data'] = $this->db->select('id_cash,voucher')
                                                                                                            ->order_by('id_cash','ASC')
                                                                                                            ->get('db_cashheader')
                                                                                                            ->result();     
																											
						$this->parameters['project_detail'] = $this->db->select('subproject_id,nm_subproject')
																											->where('pt_id',44)
                                                                                                            ->order_by('subproject_id','ASC')
                                                                                                            ->get('db_subproject')
                                                                                                            ->result();	
																											
																											
			$no = 1;
			$proj = 44;														   
			$sql = $this->db->query("sp_cekcbno ".$no.",".$proj."")->row();
			//var_dump($sql);
			$this->parameters['nocb'] = $sql->no_cb;	
																											
            }	
			
		function get_json(){
		$this->set_custom_function('trans_date','indo_date');
		$this->set_custom_function('amount','currency');
		//$this->set_custom_function('kwitansi_jml','currency');
		parent::get_json();
		}
		
		function index(){
			#die("test");
			$this->set_grid_column('id_cash','ID',array('hidden'=>true));
			$this->set_grid_column('voucher','Voucher',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('trans_date','Voucher Date',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('bank_nm','Bank',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('base_amount','Amount',array('width'=>160, 'align'=>'right', 'formatter' => 'cellColumn'));			
			$this->set_jqgrid_options(array('width'=>1000,'height'=>400,'caption'=>'BANK IN','rownumbers'=>true));
			parent::index();		
		}		
						
	
		function cekdata($id_cash){
			$sql = $this->db->query("SP_Viewcbdetail ".$id_cash."")->result(); 
			
			echo (json_encode($sql));
		}
		
		function cekdata2($id){			
				$data = array();
				$this->db->select('*')->from('db_cashheader')
											->where('id_cash',$id)
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
		
		function cashflow(){			
		 $data = array();
				$this->db->select('cashflow_id,kodecash,nama')->from('db_cashflow')
																	//->where('flag_kons',0)
																	//->like('kodecash', 'A')
																	//->or_like('kodecash', 'C')
																	->order_by('kodecash', 'Asc');
				$Q = $this-> db-> get();
				if ($Q-> num_rows() > 0){
				foreach ($Q-> result_array() as $row){
				$data[] = $row;
				}
				}
				$Q-> free_result();
				echo json_encode($data);
		}
		
		function bank(){			

		 $data = array();
			$this->db->select('bank_id,bank_nm,bank_acc')->from('db_bank')
																	//->where('flag_kons',0)
																	->order_by('bank_id', 'Asc');
				$Q = $this-> db-> get();
				if ($Q-> num_rows() > 0){
				foreach ($Q-> result_array() as $row){
				$data[] = $row;
				}
				}
				$Q-> free_result();
				echo json_encode($data);
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
										->where('id_pt',$pt)
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
		
		function savejurnal(){				
			
					$acc_no = $_REQUEST['acc_no'];
					$dept = '44';
					$acc_name = $_REQUEST['acc_name'];
					$descs = $_REQUEST['line_desc'];
					$amount = $_REQUEST['amount'];
					$voucher = $_REQUEST['no_bgt'];
					$id_gl = $_REQUEST['gl_id'];
					
					//die($id_gl);
					
		
				$data = array
					(
					
						'acc_no'=>$acc_no,
						'acc_name'=>$acc_name,
						'line_desc'=>$line_desc,
						'amount'=>$amount						
					);	
		
					$query = $this->db->query("sp_Insertcashdetail '".$acc_no."','".$acc_name."','".$line_desc."',".$amount."");
					
					$xtampil = array 
				(

					 'acc_no' => $acc_no,
					 'acc_name' => $acc_name,
					 'line_desc' => $line_desc,
					 'amount' => $amount 


				);
			die(json_encode($xtampil));
			
			}
			
			
		function lempar($no,$thn,$bln,$urut){
//		$voucher = $this->input->
		$data = $no."/".$thn."/".$bln."/".$urut;
		
		
		
		$getsql = $this->db->select('amt_base')
						  
						   ->where('voucher',$data)
						   ->get('db_cashdetail')->row();
				
		echo json_encode($getsql);
		
		}
		
        function loadcoa(){			
		
		$session = $this->UserLogin->isLogin();
		$pt = $session['id_pt'];

		                                     $sql = "select acc_no,(acc_no + '  ||  ' + left(acc_name,30)) AS name
                                                            from db_coa
                                                            where type= 2 and group_acc='E' and id_pt=$pt";
                                                            
                                    $data = $this->db->query($sql)->result();                    

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
		
		function savedetail(){

				
					$acc_no = $_REQUEST['acc_no'];
					$acc_name = $_REQUEST['acc_name'];
					$line_desc = $_REQUEST['line_desc'];
					$amount = $_REQUEST['amount'];
					$gl_id = $_REQUEST['gl_id'];
					$voucher = $_REQUEST['no_bgt'];
					$input_user = $this->user;
					// $session_id = $this->UserLogin->isLogin();
					
							
	
				
					$data = array
					(
					
						'acc_no'=>$acc_no,
						'acc_name'=>$acc_name,
						'line_desc'=>$line_desc,
						'amount'=>$amount,						
						'gl_id'=>$gl_id,
						'voucher'=>$voucher,
					);	
					
					if ($gl_id==""){
					$gl_id=0;
					}else{
					$gl_id=$_REQUEST['gl_id'];
					}
					if (empty($sub_ledger)){
					
					$sub_ledger = $_REQUEST['sub_ledger'];
					}else{
					$sub_ledger = $_REQUEST['sub_ledger'];
					}
					
		
					$query = $this->db->query("sp_Insertcashdetail '".$acc_no."','".$acc_name."','".$sub_ledger."','".$input_user."','".$line_desc."',".replace_numeric($amount).",".$gl_id.",'".$voucher."'");
					
					$id_cash = $this->db->select('id_cash as id_cash')
												->where('voucher',$voucher)
																			->get('db_cashdetail')->row();
																			
					$supllier = $this->db->select('nm_supplier as supplier')
												->where('kd_supp_gb',$sub_ledger)
																			->get('pemasok')->row();														
					
					$xtampil = array 
				(
					'xacc_no' => $acc_no,
					'xsub_ledger' => $sub_ledger,
					 'acc_no' => $acc_no,
					 'acc_name' => $acc_name,
					 'sub_ledger' => $sub_ledger,
					 'line_desc' => $line_desc,
					 'amount' => $amount



				);
			die(json_encode($xtampil));
					              
			}		
		function saveheader(){
					//$bankname = $this->input->post('bank_nm');
			//$acc_no = $_REQUEST['acc_no'];
					$trx_type = $this->input->post('trxtype');
					$voucher = $this->input->post('voucher');
					$bank = $this->input->post('bank');
					$tgl = $this->input->post('tgl');
					$paid = $this->input->post('paid');
					$cheque = $this->input->post('cheque');
					$terima = $this->input->post('terima');
					$from = $this->input->post('from');
					$kodecash = $this->input->post('kodecash');
					$project_detail = $this->input->post('project_detail');
					$amount = $this->input->post('amount');
					$remark = $this->input->post('remark');
					
					$dtprv['voucher'] = $voucher;
					
					$balance = $this->db->select('amt_base as balance')
												->where('voucher',$voucher)
												->get('db_cashdetail')->row();
					$amount_cek = replace_numeric($amount);
			
			
			// if(@$balance->balance <> $amount_cek){
				// die("Jurnal Tidak Balance");
					// }else{
		
					$query = $this->db->query("sp_Insertcashheader '".$trx_type."','".$voucher."','".$project_detail."',".$bank.",'".$cheque."','".$terima."','".inggris_date($tgl)."','".$paid."','".$from."','".$kodecash."',".replace_numeric($amount).",'".$remark."'");
//$this->load->view('cb/print/print_recvoucher',$dtprv);
					die('sukses');
				//	}              
					
			}				
		function print_slip($id){		

			//die($id);
			$dtprv['id'] = $id;
			
			$this->load->view('cb/print/print_recvoucherall',$dtprv);
		}
			
			function delete($a){
			
				
					// $acc_no = $_REQUEST['acc_no'];
					
					$gl_id = $_REQUEST['id_cash'];
		
					//$trxtype = intval($_REQUEST['trx_type']);
				//$id = $_REQUEST['a'];
				//die($a);
				//$data = $a."/".$thn."/".$bln."/".$urut;
				//die($data);
					              
					//if($trxtype_id){
						$this->db->where('id_cash',$a);
						$this->db->delete('db_cashdetail');
					//	echo"Data berhasil didelete";
					//}else{	
						// $this->db->insert('db_trxtype',$data);								
						// echo"Data berhasil tersimpan";
					// }
			
			
			}
			
			// function approve(){
			// die('test');
			// }
			
					function approve($id){         
//die($id);					
					$query = $this->db->query("sp_approvecb '".$id."'");
					die('sukses');
					
					//die('Approval Succes');
						//$this->loadTemplate('cb/bankmonitoring_call');                                  
                                              
                        }        
						
			function get_dg2($no,$pt,$desc,$bln){

				$cekid = $no."/".$pt."/".$desc."/".$bln;
				
			// $doc_no = $this->db->select('doc_no')
							   // ->where('apinvoice_id',$cekid)
							   // ->get('db_apinvoice')->result();
							   
							  // die($cekid);
				
				// $sql = $this->db->query("select '1' as no, voucher, acc_no1, acc_name, (debet/1.1) as debet, 0 as credit from db_apjurnal
							// inner join db_coa on db_coa.acc_no=db_apjurnal.acc_no1 where voucher='$cekid'
							// union
							// select '2' as no, voucher, acc_no2, acc_name, 0 as debet, (credit-(select pph from db_apinvoicedet where doc_no='$cekid') ) as credit from db_apjurnal
							// inner join db_coa on db_coa.acc_no=db_apjurnal.acc_no2 where voucher='$cekid'
							// union
							// select '3' as no, voucher, acc_no3, acc_name, (select ppn from db_apinvoicedet where doc_no='$cekid') as debet, 0 as credit from db_apjurnal
							// inner join db_coa on db_coa.acc_no=db_apjurnal.acc_no3 where voucher='$cekid'
							// union
							// select '4' as no, voucher, acc_no4, acc_name, 0 as debet, (select pph from db_apinvoicedet where doc_no='$cekid') as credit from db_apjurnal
							// inner join db_coa on db_coa.acc_no=db_apjurnal.acc_no4 where voucher='$cekid'")->result(); 
							
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
		
	} 

			function get_dg($no,$pt,$desc,$bln){
			
			$cekid = $no."/".$pt."/".$desc."/".$bln;
//die($cekid);
		  // $cekno = $this->db->where('claim_no',$id)
						    // ->get('db_pettydetail')->row();
				$getsql = $this->db->select('a.id_cash, a.acc_no as acc_no, b.acc_name,isnull(c.nm_supplier,1) as nm_supplier,line_desc, amount')
						   ->join('db_coa b','a.acc_no = b.acc_no')
						    ->join('pemasok c','a.docref = c.kd_supp_gb','left')
						   ->where('voucher',$cekid)
						   ->get('db_cashdetail a')->result();
						   
			$xtampil = array();	

			foreach($getsql as $row){
				
			$xtampil[] = array 
				(
					 'xacc_no' => $row->acc_no,
					 'xsub_ledger' => $row->nm_supplier,
					 'acc_no' => $row->acc_no,
					 'acc_name' => $row->acc_name,
					 'sub_ledger' => $row->nm_supplier,
					 'line_desc' => $row->line_desc,
					 'amount'	=>number_format($row->amount),	
					  'gl_id' => $row->id_cash,
				);
			}
				
		die(json_encode($xtampil));
		
	} 				

	function show_form($no,$pt,$desc,$bln){
			$index = $_GET['index'];
			//$data['xref']   = $xref;
			
			$data['no_bgt'] = $no."/".$pt."/".$desc."/".$bln;
			$data['vendor'] = $this->db->select('kd_supp_gb,nm_supplier')
									   ->order_by('nm_supplier','ASC')
									   ->get('pemasokmaster')->result();
			$this->load->view("cb/show_bm",$data);
		}	
function loaddata(){
			#die($this->input->post('parent_id'));
			
			$session = $this->UserLogin->isLogin();
			$pt = $session['id_pt'];
			
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				$project = array('41012', '41011', '1');
				$group = array('A', 'R');
				switch($data_type){
					case 'acc_no':
					    $sql = $this->db->select('acc_no id,(acc_no +"  ||  "+ acc_name) nama')
										->where_in('id_pt',$pt)
										->where('type',2)
										->get('db_coa')->result();
						break;
						case 'sub_ledger':
						if (substr($parent_id,0,1) == 2) {
								$sql = $this->db->select('kd_supp_gb id,nm_supplier nama')
												//->where('group_acc','E')
												->where_in('kd_project',$project)
												->get('pemasok')->result();
							}else if(substr($parent_id,0,1) == 1 && ($parent_id) <> '1.01.03.01.01.01'){
								$sql = $this->db->select('kd_supp_gb id,nm_supplier nama')
												//->where('group_acc','E')
												->where_in('kd_project',$project)
												->get('pemasok')->result();
							}else if(substr($parent_id,0,1) == 1 && ($parent_id) == '1.01.03.01.01.01'){
								$sql = $this->db->select('unit_id id,unit_no nama')
														->join('db_unit_yogya','unit_id  = id_unit')
														->get('db_sp')->result();

							}else{
										$sql = "0";	
							}
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
		function save_dg(){
			$line_desc = $_REQUEST['line_desc'];
			$acc_no = $_REQUEST['acc_no'];
			$amount = $_REQUEST['amount'];
			$acc_name = $_REQUEST['acc_name'];
			 $no_bgt = $_REQUEST['no_bgt'];
			 $project_no = '44';
			$session = $this->UserLogin->isLogin();
			$pt = $session['id_pt'];
			
			
			$data = array 
			(
				'line_desc' => $line_desc,
				'acc_no' => $acc_no,
				'amount' => replace_numeric($amount),
				'voucher' => $no_bgt,
				'project_cd' => $project_no
			);
			

			$this->db->insert('db_cashdetail',$data);			
						 
					  
			//Cek Nama Project
			$ckproj = $this->db->select('acc_no,acc_name')
							   ->where('group_acc','E')
							   ->where('id_pt',$pt)
							   ->get('db_coa')->row();
			// //Cek Sturktur cost
			// $cekcost = $this->db->select('nm_scost')
								// ->where('id_scostproj',$cost)
								// ->get('db_costproj')->row();
			// //Cek sub struktur cost	
			// $cekscost = $this->db->select('nm_ssubbgtproj')
								// ->where('id_ssubbgtproj', $subcost)
								// ->get('db_ssubbgtproj ')->row();
														   
			$xtampil = array 
				(
					 'acc_no' => $acc_no,
					 'acc_name' => $acc_name,
					 'line_desc' => $line_desc,					
					 // 'codebgt' => $codebgt,
					 // 'cost' => $cekcost->nm_scost,
					 // 'subcost' => $cekscost->nm_ssubbgtproj,					 
					 // 'totalbgt' => $totalbgt,
					 // 'totalprop' => $totalprop,
					 // 'xblc' => $xblc,
					 'amount'	=> $amount			
				);
			die(json_encode($xtampil));
		}		
		
			function getaccname($id){
			extract(PopulateForm());
		
		    $sql = $this->db->query("SP_Cekaccname '".$id."'")->row();
							    
		    
		    die(json_encode($sql));

				
		}
		
		function update($id){
		//die('test');
		$cek_status = $this->db->select('status as id')
							   ->where('id_cash',$id)
							   ->get('db_cashheader')->row();
							   
		$cek_bank = $this->db->select('slip_date as date')
							   ->where('id_cash',$id)
							   ->get('db_cashheader')->row();
					
		$cek_trans = $this->db->select('left(convert(varchar(10), trans_date, 112),6) as period ')
							   ->where('id_cash',$id)
							   ->get('db_cashheader')->row();
		$cek_closing = $this->db->select('acc_period as closing ')
							 //  ->where('id_cash',$id)
							   ->get('db_endofyear')->row();
							   
		if($cek_status->id == 2 ){
			echo"
				<script type='text/javascript'>
					alert('Sudah di approve');
					refreshTable();
				</script>
			";
		}elseif($cek_trans->period < $cek_closing->closing ){
		echo"
				<script type='text/javascript'>
					alert('Data Sudah Closing');
					refreshTable();
				</script>
			";			
		}else{
			parent::update($id);
		}
		}
		
		function view($id){
		//die('test');
		$cek_status = $this->db->select('status as id')
							   ->where('id_cash',$id)
							   ->get('db_cashheader')->row();
							   
		$cek_bank = $this->db->select('slip_date as date')
							   ->where('id_cash',$id)
							   ->get('db_cashheader')->row();
							   
		if($cek_status->id == 2 ){
			echo"
				<script type='text/javascript'>
					alert('Sudah di approve');
					refreshTable();
				</script>
			";
		}elseif($cek_bank->date == NULL ){
		echo"
				<script type='text/javascript'>
					alert('Payment Date Belum Ada');
					refreshTable();
				</script>
			";		
		}else{
			parent::view($id);
		}
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
	}
?>
