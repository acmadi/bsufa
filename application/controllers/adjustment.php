<?php
	class adjustment extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('adjustment_model');
			$this->set_page_title('Journal Memorial');
			$this->default_limit = 30;
			$this->template_dir = 'gl/adjustment';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
		}
		
		protected function setup_form($data=false){
		
		$session = $this->UserLogin->isLogin();
		$pt = $session['id_pt'];
                        
                        $this->parameters['coa'] = $this->db->select('acc_no,acc_name')
																											->where('id_pt',$pt )
                                                                                                            ->order_by('acc_no','ASC')
                                                                                                            ->get('db_coa')
                                                                                                            ->result();     
						$this->parameters['project_detail'] = $this->db->select('subproject_id,nm_subproject')
																											->where('pt_id',$pt )
                                                                                                            ->order_by('subproject_id','ASC')
                                                                                                            ->get('db_subproject')
                                                                                                            ->result();	
   

			$no = 1;
			$proj = 44;														   
			$sql = $this->db->query("sp_cekglno ".$no.",".$proj."")->row();
			$this->parameters['nogl'] = $sql->no_gl;																											
            }	
			
		function get_json(){
		$this->set_custom_function('trans_date','indo_date');
		//$this->set_custom_function('debit','currency');
		//$this->set_custom_function('credit','currency');
		parent::get_json();
		}
		
		function index(){
			#die("test");
			$this->set_grid_column('gl_id','ID',array('hidden'=>true));
			$this->set_grid_column('voucher','Voucher',array('width'=>100, 'formatter' => 'cellColumn'));
			$this->set_grid_column('trans_date','Voucher Date',array('width'=>100, 'formatter' => 'cellColumn'));
			$this->set_grid_column('desc','Description',array('width'=>300, 'formatter' => 'cellColumn'));
			$this->set_grid_column('debit','Debet',array('width'=>120,'align'=>'right', 'formatter' => 'cellColumn'));
			$this->set_grid_column('credit','Credit',array('width'=>120,'align'=>'right', 'formatter' => 'cellColumn'));			
			$this->set_jqgrid_options(array('width'=>1200,'height'=>400,'caption'=>'Memorial Journal','rownumbers'=>true));
			parent::index();		
		}		
		
		function loadcoa(){			
		
		$session = $this->UserLogin->isLogin();
		$pt = $session['id_pt'];

		                                     $sql = "select acc_no,(acc_no + '  ||  ' + left(acc_name,25)) AS name
                                                            from db_coa
                                                            where type= 2 and id_pt=$pt";
                                                            
                                    $data = $this->db->query($sql)->result();                    

				echo json_encode($data);
		}
		
		function test($id){
		
		die($id);
			$sql = $this->db->query("SP_ViewAPPO ".$id."")->row(); 
			die(json_encode($sql));
		}
						
	
		function cekdata($gl_id){
			$sql = $this->db->query("SP_Viewgldetail ".$gl_id."")->result(); 
			
			echo (json_encode($sql));
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
		
		function approve($id){         
//die($id);					

		$cek_status = $this->db->select('balance as id')
							   ->where('gl_id',$id)
							   ->get('db_glheader')->row();
							   
		if($cek_status->id != 0 ){
			echo"
				<script type='text/javascript'>
					alert('Jurnal Tidak Balance');
					refreshTable();
				</script>
			";
			
		}else{
					$query = $this->db->query("sp_approvegl '".$id."'");
					redirect('adjustment');
					}
                        }    
						
		function get_dg($id){

				$cekid = $id;
				//$cekid = '2607';
				//die($cekid);
				// $cekid = $this->db->select('ref_no')
												// ->where('voucher',$voucher)
												// ->get('db_gldetail')->result();
				 //die($cekid);
				 
				 // $getsql = $this->db->select('acc_no, line_desc, debit, credit')
												// ->where('ref_no',$cekid)
												// ->get('db_gldetail')->row();

				// $getsql = $this->db->select('acc_no, line_desc, debit, credit')
	    					  // ->where('ref_no',$cekid)
		     				   // ->get('db_gldetail')->result();
				$getsql   = $this->db->where('ref_no',$cekid)
							 ->get('db_gldetail')->result();		  
							 
				//var_dump($getsql);exit;
				//$getsql = $this->db->where('ref_no',$xrows->ref_no)
								   //->get('db_gldetail')->result();
			//$sql = $this->db->query("SP_Viewgldetail ".$gl_id."")->result(); 
			
								 
					   //die($getsql);
					//echo (json_encode($getsql));		
			
			//var_dump($cekid);exit;		   
			$xtampil = array();	

			foreach($getsql as $row){
				
			 $xtampil[] = array 
			 (
					'xacc_no' => $row->acc_no,
					 'acc_no' => $row->acc_no,
					 'acc_name' => $row->acc_name,
					 'descs' => $row->line_desc,
					 'debet'	=>number_format($row->debit),
					 'credit'	=>number_format($row->credit),
					 'gl_id' => $row->gl_id,
				 );
			 }
				
		 die(json_encode($xtampil));
		
	} 	
	
	function get_dg_input(){
	
				$no = 1;
				$proj = 44;		
				$sql = $this->db->query("sp_cekglno ".$no.",".$proj."")->row();

				$cek = $sql->no_gl;		
				//$cekid = '2607';
				//die($cekid);
				 $cekid = $this->db->select('voucher')
												->where('ref_no',$cek)
												->get('db_gldetail')->result();
				 //die($cekid);
				 
				 // $getsql = $this->db->select('acc_no, line_desc, debit, credit')
												// ->where('ref_no',$cekid)
												// ->get('db_gldetail')->row();

				// $getsql = $this->db->select('acc_no, line_desc, debit, credit')
	    					  // ->where('ref_no',$cekid)
		     				   // ->get('db_gldetail')->result();
				$getsql   = $this->db->where('voucher',$cek)
							 ->get('db_gldetail')->result();		  
							 
				//var_dump($getsql);exit;
				//$getsql = $this->db->where('ref_no',$xrows->ref_no)
								   //->get('db_gldetail')->result();
			//$sql = $this->db->query("SP_Viewgldetail ".$gl_id."")->result(); 
			
								 
					   //die($getsql);
					//echo (json_encode($getsql));		
			
			//var_dump($cekid);exit;		   
			$xtampil = array();	

			foreach($getsql as $row){
			
			
			 $xtampil[] = array 
			 (
					 'xacc_no' => $row->acc_no,
					 'acc_no' => $row->acc_no,
					 'acc_name' => $row->acc_name,
					 'descs' => $row->line_desc,
					 'debet'	=>number_format($row->debit),
					 'credit'	=>number_format($row->credit),
					 'gl_id' => $row->gl_id,
				 );
			 }
				
		 die(json_encode($xtampil));
		
	} 	
	function view_dg($no_bgt){
		
				//$voucher = $_REQUEST['no_bgt'];
				//$voucher = $this->input->post('voucher');
				//die($no_bgt);
				$acc_no = $_REQUEST['acc_no'];
				$descs = $_REQUEST['descs'];
				$debet = $_REQUEST['debet'];
				$credit = $_REQUEST['credit'];
				/*$getsql = $this->db->select('acc_no, line_desc, debit, credit')
						  // ->join('db_pettydetail b','a.claim_no = b.claim_no')
						  ->where('voucher',$no_bgt)
						   ->get('db_gldetail')->result();*/
						   
			//$xtampil = array();	

			//foreach($getsql as $row){
				
			$xtampil = array 
				(
					 
					 'acc_no' => $acc_no,
					 'descs' => $descs,
					 'debet'	=>$debet,
					 'credit'	=>$credit
				);
			//}
				
		die(json_encode($xtampil));
		
	} 	
	
	function show_form($no,$pt,$desc,$bln){
	
			$session = $this->UserLogin->isLogin();
			$pt = $session['id_pt'];

			$index = $_GET['index'];
			//$data['xref']   = $xref;
			$sql = $this->db->select('acc_no id,(acc_no +"  ||  "+ acc_name) nama')
										->where('type',2)
										->where('id_pt',$pt)
										->get('db_coa')->result();
			$data['no_bgt'] = $no."/".$pt."/".$desc."/".$bln;
			$data['acc_no'] = $sql;
			
			$this->load->view("gl/show_gl2",$data);
		}	
		
		function show_form2($no,$pt,$desc,$bln){
		$index = $_GET['index'];
		//$data['xref']   = $xref;
		$nobgt = $no."/".$pt."/".$desc."/".$bln;
		$rows = $this->db->where('acc_no',$nobgt)
						->get('db_gldetail')->row();
						
		$sql = $this->db->select('sum(debit) as debit,sum(credit) as credit')
								->where('voucher',$nobgt)
								->get('db_gldetail')->row();
		//var_dump($rows);			
		//$data['acc_no'] = $rows->acc_no;				
		$data['no_bgt'] = $no."/".$pt."/".$desc."/".$bln;
		$data['debit'] = number_format($sql->debit);
		//$data['rem'] = $rema;	
		$this->load->view("gl/show_gl",$data);
		}	
		
		function loaddata(){
			#die($this->input->post('parent_id'));
			$session = $this->UserLogin->isLogin();
			$pt = $session['id_pt'];
			
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				$project = array('41012', '41011', '1');
			

				switch($data_type){
					case 'acc_no':
					    $sql = $this->db->select('acc_no id,(acc_no +"  ||  "+ acc_name) nama')
										->where('id_pt',$pt)
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
							// if (substr($parent_id,0,1) == 2) {
								// $sql = $this->db->select('kd_supp_gb id,nm_supplier nama')
												// //->where('group_acc','E')
												// ->where('kd_project','41012')
												// ->get('pemasok')->result();
							// }else if(substr($parent_id,0,1) == 1 || substr($parent_id,0,1) == 3){
								// $sql = $this->db->select('unit_id id,unit_no nama')
														// ->join('db_unit_yogya','unit_id  = id_unit')
														// ->get('db_sp')->result();

							// }else{
								// $sql = "0";	
							// }
						break;
						
						case 'ap_no':
					    $sql = $this->db->select('apinvoice_id id, doc_no nama')
										->where('vendor_acct',$parent_id)
										->get('db_apinvoice')->result();

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
		
		function getinvoiceap($id){
		
		//die($id);
			extract(PopulateForm());
		
		    $sql = $this->db->query("SP_Cekinvoiceap '".$id."'")->row();
							    
		    
		    die(json_encode($sql));

				
		}
		
		function save_dg(){
		
			$jobdet = $_REQUEST['jobdet'];
			$proj_id = $_REQUEST['proj_id'];
			$debet = $_REQUEST['debet'];
			$credit = $_REQUEST['credit'];
			 $no_bgt = $_REQUEST['no_bgt'];
			 $project_no = '44';

			
			
			$data = array 
			(
				'line_desc' => $jobdet,
				'acc_no' => $proj_id,
				'debet' => replace_numeric($debet),
				'credit' => replace_numeric($credit),
				'voucher' => $no_bgt,
				'project_no' => $project_no
			);
			
			$query = $this->db->query("sp_Insertgldetail '".$jobdet."','".$project_no."','".$proj_id."','".replace_numeric($debet)."','".replace_numeric($credit)."'");
			//$this->db->insert('db_gldetail',$data);			
						 
			$ckproj = $this->db->select('acc_no')
							   ->where('group_acc','E')
							   ->get('db_coa')->row();
														   
			$xtampil = array 
				(
					 'acc_no' => $proj_id,
					 'jobdet' => $jobdet,					
					 'debet' => $debet,	 
					 'credit' => $credit	 
				);
			die(json_encode($xtampil));
		}	
		
		function saveheader(){
			extract(PopulateForm());
		//die($debet);
					$trx_type = $this->input->post('trxtype');					
					$voucher_date = $this->input->post('voucher_date');
					$voucher = $this->input->post('voucher');
					$project_detail = $this->input->post('project_detail');
					$remark = $this->input->post('remark');
					$input_user = $this->user;
					
					$dtprv['voucher'] = $voucher;
					
			$debet = $this->db->select('sum(debit)')
			 ->where('voucher',$voucher)
			->get('db_gldetail')->result();
			
			$credit = $this->db->select('sum(credit)')
			 ->where('voucher',$voucher)
			->get('db_gldetail')->result();
			
			$cekvoucher = $this->db->select('voucher')
												->where('voucher',$voucher)
												->get('db_gldetail')->row();
												
			$amount = $this->db->select('(sum(debit)+sum(credit)) as amount')
												->where('voucher',$voucher)
												->get('db_gldetail')->row();
			
			
			if($debet <> $credit){
				die("Jurnal Tidak Balance");
			}elseif (empty($cekvoucher)){
				die("Jurnal Masih Kosong");
			}elseif ($amount->amount == 0){
				die("Jurnal Masih 0");
			}else{
				$query = $this->db->query("sp_Insertglheader '".$trx_type."','".$input_user."','".$project_detail."','".inggris_date($voucher_date)."','".$voucher."','".$remark."'");
				die('sukses');
			}
			}		
			
			function savedetail(){				
			
					$acc_no = $_REQUEST['acc_no'];
					$dept = '44';
					$descs = $_REQUEST['descs'];
					$debit = $_REQUEST['debet'];
					$credit = $_REQUEST['credit'];
					$voucher = $_REQUEST['no_bgt'];
					$id_gl = $_REQUEST['gl_id'];
					//$sub_ledger = $_REQUEST['sub_ledger'];
					//$ap_no = $_REQUEST['ap_no'];
					$invoice_ap = $_REQUEST['invoice_ap'];					
					#$sub_ledger = $_REQUEST['sub_ledger'];
					#$ap_no = $_REQUEST['ap_no'];
					#$invoice_ap = $_REQUEST['invoice_ap'];
					$input_user = $this->user;
					if (empty($sub_ledger)){
					
					$sub_ledger=$_REQUEST['sub_ledger'];
					$ap_no=$_REQUEST['sub_ledger'];				
					}else{
					$sub_ledger = $_REQUEST['sub_ledger'];
					$ap_no = $_REQUEST['ap_no'];
					}
				if (empty($id_gl)){				
					$query = $this->db->query("sp_Insertgldetail '".$acc_no."','".$input_user."','".$dept."','".$descs."','".$voucher."','".$sub_ledger."','".$ap_no."',".replace_numeric($invoice_ap).",".replace_numeric($debit).",".replace_numeric($credit)."");
					
					$gl_id = $this->db->select('gl_id,acc_name')
												->where('voucher',$voucher)
												->where('acc_no',$acc_no)
												->get('db_gldetail')->row();				
				
				$xtampil = array 
				(
					 'xacc_no' => $acc_no,
					 'gl_id' => $gl_id->gl_id,
					 'acc_no' => $acc_no,
					 'acc_name' => $gl_id->acc_name,
					 'descs' => $descs,		
					 'debet' => $debit ,	 
					 'credit' => $credit,
					 'sub_ledger'=>$sub_ledger,
					 'ap_no'=>$ap_no,
					 'invoice_ap'=>$invoice_ap

				);
			die(json_encode($xtampil));	//}
				}else{
					//$query = $this->db->query("sp_Insertgldetail '".$acc_no."','".$dept."','".$descs."','".$voucher."',".replace_numeric($debit).",".replace_numeric($credit)."");
					$query = $this->db->query("sp_updategldetail '".$id_gl."','".$acc_no."','".$dept."','".$descs."','".$voucher."',".replace_numeric($debit).",".replace_numeric($credit)."");
					//$query = $this->db->query("sp_Insertgldetail '".$acc_no."','".$input_user."','".$dept."','".$descs."','".$voucher."','".$sub_ledger."','".$ap_no."',".replace_numeric($invoice_ap).",".replace_numeric($debit).",".replace_numeric($credit)."");
					$gl_id = $this->db->select('gl_id,acc_name')
												->where('voucher',$voucher)
												->where('acc_no',$acc_no)
												->get('db_gldetail')->row();
				
				
				$xtampil = array 
				(
					 'xacc_no' => $acc_no,
					 'gl_id' => $id_gl,
					 'acc_no' => $acc_no,
					 'acc_name' => $gl_id->acc_name,
					 'descs' => $descs,		
					 'debet' => $debit ,	 
					 'credit' => $credit,
					 'sub_ledger'=>$sub_ledger,
					 'ap_no'=>$ap_no,
					 'invoice_ap'=>$invoice_ap

				);
			die(json_encode($xtampil));
	
				}	
				
					$gl_id = $this->db->select('gl_id,acc_name')
												->where('voucher',$voucher)
												->where('acc_no',$acc_no)
												->get('db_gldetail')->row();
				
				
				$xtampil = array 
				(
					 'xacc_no' => $acc_no,
					 'gl_id' => $id_gl,
					 'acc_no' => $acc_no,
					 'acc_name' => $gl_id->acc_name,
					 'descs' => $descs,		
					 'debet' => $debit ,	 
					 'credit' => $credit,
					 'sub_ledger'=>$sub_ledger,
						'ap_no'=>$ap_no,
						'invoice_ap'=>$invoice_ap

				);
			die(json_encode($xtampil));
			
			}

		function lempar($no,$thn,$bln,$urut){
//		$voucher = $this->input->
		$data = $no."/".$thn."/".$bln."/".$urut;
		
		
		
		$getsql = $this->db->select('convert(varchar,CONVERT(money, sum(debit)),1) as debet, convert(varchar,CONVERT(money, sum(credit)),1) as credit')
						  
						   ->where('voucher',$data)
						   ->get('db_gldetail')->row();
				
		echo json_encode($getsql);
		
		}
		
	
		
		function print_slip($id){		

			//die($id);
			$dtprv['id'] = $id;
			
			$this->load->view('gl/print/print_jurnalvoucherall',$dtprv);
		}
		
		function save(){
					$bankname = $this->input->post('bank_nm');
			
					$trxtype_id = $_REQUEST['trxtype_id'];
					$trxtype = $_REQUEST['trx_type'];
					$descs = $_REQUEST['descs'];
					$trxmode = $_REQUEST['trx_mode'];

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
			
			function delete_data($id){
			
			
			      $q=$this->db->query("delete db_glheader  WHERE gl_id='$id'");
				  $w=$this->db->query("delete db_gldetail  WHERE ref_no='$id'");
         	
					// $query = $this->db->query("sp_approveGL '".$id."'");
					 echo"
                                                <script type='text/javascript'>
                                                            alert('Delete Sukses');
                                                            window.close();
															 refreshTable();
                                                </script>
                                     ";        
			
			
			
			
			
			
			
			}
			
			function delete($a){
			
				
					// $acc_no = $_REQUEST['acc_no'];
					
					$gl_id = $_REQUEST['gl_id'];
		
					//$trxtype = intval($_REQUEST['trx_type']);
				//$id = $_REQUEST['a'];
				//die($a);
				//$data = $a."/".$thn."/".$bln."/".$urut;
				//die($data);
					              
					//if($trxtype_id){
						$this->db->where('gl_id',$a);
						$this->db->delete('db_gldetail');
					//	echo"Data berhasil didelete";
					//}else{	
						// $this->db->insert('db_trxtype',$data);								
						// echo"Data berhasil tersimpan";
					// }
			
			
			}

				
		function update($id){
		//die('test');
		$cek_status = $this->db->select('status as id')
							   ->where('gl_id',$id)
							   ->get('db_glheader')->row();
							   
		if($cek_status->id != 1 ){
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
		
		// function view($id){
		// //die('test');
		// $cek_status = $this->db->select('status as id')
							   // ->where('gl_id',$id)
							   // ->get('db_glheader')->row();
							   
			   
		// if($cek_status->id == 1 ){
			// echo"
				// <script type='text/javascript'>
					// alert('Sudah di approve');
					// refreshTable();
				// </script>
			// ";
		// }else{
			// parent::view($id);
		// }
		// }	
				
			
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
