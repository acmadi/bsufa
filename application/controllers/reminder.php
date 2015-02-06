<?php
class reminder extends DBController{
	function __construct(){
		parent::__construct('reminder_model');
		$this->set_page_title('Generate Reminder');
		$this->default_limit = 30;
		$this->template_dir = 'finance/reminder';
		$session_id = $this->UserLogin->isLogin();
		$this->user = $session_id['username'];
		$this->user_id = $session_id['id'];
		$this->pt_id = $session_id['id_pt'];

	}

	protected function setup_form($data=false){
		$arr = array(1,2,3,4,5,6);
		$this->parameters['currency'] = $this->db->where('status',1)
											  ->get('db_currency')->result();
		$this->parameters['spec'] = $this->db->where_in('spec_id',$arr)
											 ->get('db_spec')->result();	
		$this->parameters['type'] = $this->db->where_in('type_id',$arr)
											 ->get('db_typeacc')->result();		
		$this->parameters['project_detail'] = $this->db->select('subproject_id,nm_subproject')
																											->where('pt_id',44)
                                                                                                            ->order_by('subproject_id','ASC')
                                                                                                            ->get('db_subproject')
                                                                                                            ->result();	
											 
	}

	 function get_json(){
		$this->set_custom_function('tgl_sales','indo_date');
		// // $this->set_custom_function('pay_date','indo_date');
		//$this->set_custom_function('debit','currency');
		//$this->set_custom_function('credit','currency');
		parent::get_json();
	 }
	
	function index(){
		$this->set_grid_column('sp_id','ID',array('hidden'=>true,'key'=>true));
		$this->set_grid_column('tgl_sales','Date',array('width'=>45,'align'=>'Left', 'formatter' => 'cellColumn'));
		$this->set_grid_column('customer_nama','Customer',array('width'=>200,'align'=>'Left', 'formatter' => 'cellColumn'));
		$this->set_grid_column('unit_no','Unit No',array('width'=>50,'align'=>'left', 'formatter' => 'cellColumn'));
		//$this->set_grid_column('acc_no','Acc No',array('width'=>60,'align'=>'left', 'formatter' => 'cellColumn'));
		$this->set_grid_column('selling_price','Selling Price',array('width'=>60,'align'=>'left', 'formatter' => 'cellColumn'));
		$this->set_grid_column('payment','Payment',array('width'=>60,'align'=>'right', 'formatter' => 'cellColumn'));		
		$this->set_grid_column('balance','Balance',array('width'=>60,'align'=>'right', 'formatter' => 'cellColumn'));
		$this->set_jqgrid_options_ceklist(array('width'=>1200,'height'=>350,'caption'=>'Generate Reminder','rownumbers'=>true,'sortname'=>'unit_no','sortorder'=>'ASC'));
		parent::index();
	}
	
	function settingreminder1($id){
	
			// $cek_plan = $this->db->select('count(id_ap) as id')
							   // ->where('id_ap',$id)
							   // ->get('db_cashplan')->row();
							   
			// if($cek_plan->id == 2 ){
			// echo"
				// <script type='text/javascript'>
					// alert('Payment Plan sudah dilakukan');
					// refreshTable();
				// </script>
			// ";
		// }elseif($id == NULL ){
			// echo"
				// <script type='text/javascript'>
					// alert('Pilih Data dahulu !!');
					// refreshTable();
				// </script>
			// ";
		// }else{
		
		
		
			$data['id'] = $id;
	
										
										
			$this->load->view('finance/reminder-planning1',$data);
		//	}
	}	
	
	function surat_reminder1(){
		
		extract(PopulateForm());
		
		$data['reminder_date'] = $reminder_date;
		//$data['tgl'] = $tgl;
		//$data['no_reminder'] = $no_reminder;
		$data['id_sp'] = $id_sp;
		//die($nama);
		if ($this->pt_id == 44){
		
		$this->load->view("finance/print/print_surat_reminder1",$data);		
		}elseif($this->pt_id == 22) {
		$this->load->view("finance/print/print_surat_reminder1",$data);		
		}elseif($this->pt_id == 11) {
		$this->load->view("finance/print/print_surat_reminder1",$data);		
		}
		
		
	}
	
	function settingreminder2($id){
	
			// $cek_plan = $this->db->select('count([print]) as id')
							   // ->where('id_sp',$id)
							   // ->where('[print]',0)
							   // ->get('db_genreminder')->row();
							   
			// if($cek_plan->id == 0 ){
			// echo"
				// <script type='text/javascript'>
					// alert('Anda Belum Generate Untuk Reminder 2');
					// refreshTable();
				// </script>
			// ";
			// }else{
		
		
		
			$data['id'] = $id;
			// $data['row'] = $this->db->select('convert(varchar,CONVERT(money, (db_apinvoice.trx_amt-isnull(db_apinvoicedet.pph,0))),1) as trx_amt')
											// ->join('db_apinvoicedet', 'db_apinvoicedet.doc_no = db_apinvoice.doc_no')
										// ->where('apinvoice_id',$id)
										// ->get('db_apinvoice')->row();
										
										
			$this->load->view('finance/reminder-planning2',$data);
		//	}
	}	
	
	function surat_reminder2(){
	
		extract(PopulateForm());
		
		$data['reminder_date'] = $reminder_date;
		$data['tgl'] = $tgl;
		$data['no_reminder'] = $no_reminder;
		$data['id_sp'] = $id_sp;
		//die($nama);
		if ($this->pt_id == 44){
		
		$this->load->view("finance/print/print_surat_reminder2",$data);		
		}elseif($this->pt_id == 22) {
		$this->load->view("finance/print/print_surat_reminder2",$data);		
		}elseif($this->pt_id == 11) {
		$this->load->view("finance/print/print_surat_reminder2",$data);		
		}
		
		
	}
	
	function settingreminder3($id){
	
			// $cek_plan = $this->db->select('count(id_ap) as id')
							   // ->where('id_ap',$id)
							   // ->get('db_cashplan')->row();
							   
			// if($cek_plan->id == 2 ){
			// echo"
				// <script type='text/javascript'>
					// alert('Payment Plan sudah dilakukan');
					// refreshTable();
				// </script>
			// ";
		// }elseif($id == NULL ){
			// echo"
				// <script type='text/javascript'>
					// alert('Pilih Data dahulu !!');
					// refreshTable();
				// </script>
			// ";
		// 
			// $cek_plan = $this->db->select('count([print]) as id')
							   // ->where('id_sp',$id)
							   // ->where('[print]',0)
							   // ->get('db_genreminder')->row();
							   
			// if($cek_plan->id == 0 ){
			// echo"
				// <script type='text/javascript'>
					// alert('Anda Belum Generate Untuk Reminder 3');
					// refreshTable();
				// </script>
			// ";
		// }else{
		
		
		
			$data['id'] = $id;
			// $data['row'] = $this->db->select('convert(varchar,CONVERT(money, (db_apinvoice.trx_amt-isnull(db_apinvoicedet.pph,0))),1) as trx_amt')
											// ->join('db_apinvoicedet', 'db_apinvoicedet.doc_no = db_apinvoice.doc_no')
										// ->where('apinvoice_id',$id)
										// ->get('db_apinvoice')->row();
										
										
			$this->load->view('finance/reminder-planning3',$data);
			//}
	}	
	
	function surat_reminder3(){
		
		extract(PopulateForm());
		
		$data['reminder_date'] = $reminder_date;
		$data['tgl'] = $tgl;
		$data['tgl2'] = $tgl2;
		$data['no_reminder'] = $no_reminder;
		$data['no_reminder2'] = $no_reminder2;
		$data['id_sp'] = $id_sp;
		//die($nama);
		if ($this->pt_id == 44){
		
		$this->load->view("finance/print/print_surat_reminder3",$data);		
		}elseif($this->pt_id == 22) {
		$this->load->view("finance/print/print_surat_reminder3",$data);		
		}elseif($this->pt_id == 11) {
		$this->load->view("finance/print/print_surat_reminder3",$data);		
		}
		
		
	}


	function simpan(){
		extract(PopulateForm());
		// //Cek Account Bank
		// $cekbank = $this->db->select('bank_coa,bank_nm')
							// ->where('bank_id',$bank)
							// ->get('db_bank')->row();
		//Simpan data
		$data = array
		(
			'acc_no'=> $acc_no,
			'acc_name'=> $acc_name,
			'level'=> $level,
			'type'=>$type,
			'group_acc'=>$group,
			'currency_cd'=>$currency,
			'status'=>$status
		);
		//Buat Jurnal unidentified
		// $x1 = array 
		// (
			// 'date_jurnal'=> inggris_date($tgl),
			// 'acc_coa' =>$cekbank->bank_coa,
			// 'debet'=>replace_numeric($amount),
			// 'credit'=>0,
			// 'remark'=>$cekbank->bank_nm
		// );

		// $x2 = array 
		// (
			// 'date_jurnal'=> inggris_date($tgl),
			// 'acc_coa' =>'2.02.01.03',
			// 'debet'=>0,
			// 'credit'=>replace_numeric($amount),
			// 'remark'=>'Unidentified'
		// );

		//Insert Ke Map Jurnal
		//$this->db->insert('db_mapjurnal',$x1);
		//$this->db->insert('db_mapjurnal',$x2);		
		//Insert Ke Unidentified
		$this->db->insert('db_coa',$data);
		redirect('coa');
	}		
	
	function print_slip($id){		

			//die($id);
			$dtprv['id'] = $id;
			
			$this->load->view('gl/print/print_jurnaltransferall',$dtprv);
		}
	
	function approve($id){                  
			//$this->db->query("delete db_genreminder");
			
			$jml=strlen($id);
            $a=explode(',',$id);
            $ja=count($a);
            for($i=0;$i<$ja;$i++){
 			   $q=$this->db->query("sp_generatereminder '".$a[$i]."'");
            }
					 echo"
                                                <script type='text/javascript'>
                                                            alert('Generate Berhasil');
                                                            window.close();
															refreshTable();
                                                </script>
                                    ";
               
           }           
						
	function unapprove($id){          

		$cek_status = $this->db->select('status as id')
							   ->where('gl_id',$id)
							   ->get('db_glheader')->row();
							   
		if($cek_status->id == 5 || $cek_status->id == 0 ){
			echo"
				<script type='text/javascript'>
					alert('Journal Belum di Posting');
					refreshTable();
				</script>
			";
			
		}else{

			$jml=strlen($id);
            $a=explode(',',$id);
            $ja=count($a);
            for($i=0;$i<$ja;$i++){
               //$q=$this->db->query("update db_glheader set status=1 WHERE gl_id='$a[$i]'");
			   $q=$this->db->query("sp_unapproveGL '".$a[$i]."'");
            }
					//$query = $this->db->query("sp_approveGL '".$id."'");
					 echo"
                                                <script type='text/javascript'>
                                                            alert('unPosting Berhasil');
                                                            window.close();
															refreshTable();
                                                </script>
                                    ";
				
                               }                 
                        }        

	function unverifikasi($id){                  

			$jml=strlen($id);
            $a=explode(',',$id);
            $ja=count($a);
            for($i=0;$i<$ja;$i++){
               $q=$this->db->query("update db_glheader set status=0 WHERE gl_id='$a[$i]'");
			   //$q=$this->db->query("sp_approveGL '".$a[$i]."'");
            }
					//$query = $this->db->query("sp_approveGL '".$id."'");
					 echo"
                                                <script type='text/javascript'>
                                                            alert('UnVerifikasi Berhasil');
                                                            window.close();
															refreshTable();
                                                </script>
                                    ";
				
                                              
                        }     

	function get_dg($id){

				$cekid = $id;

				$getsql   = $this->db->where('ref_no',$cekid)
							 ->get('db_gldetail')->result();		  
							 
				 
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
	
	
	function savedetail(){				
			
					$acc_no = $_REQUEST['acc_no'];
					$acc_name = $_REQUEST['acc_name'];
					$dept = '44';
					$descs = $_REQUEST['descs'];
					$debit = $_REQUEST['debet'];
					$credit = $_REQUEST['credit'];
					$voucher = $_REQUEST['no_bgt'];
					$id_gl = $_REQUEST['gl_id'];
					$input_user = $this->user;
					
					$ledger =0;
					$ap_id =0;
					$apinvoice =0;
					
					//die($id_gl);
					
		
				
					// $data = array
					// (
						// 'acc_no'=>$acc_no,
						// 'dept'=>$dept,
						// 'descs'=>$descs,		
						// 'voucher'=>$voucher,						
						// 'debit'=>$debit,
						// 'credit'=>$credit		
					// );	
					
				
					$cekvoucher = $this->db->select('voucher')
												->where('voucher',$voucher)
												->where('acc_no',$acc_no)
												->get('db_gldetail')->row();
											
				if (empty($id_gl)){
				
				//die('test disini');
					 $query = $this->db->query("sp_Insertgldetail '".$acc_no."','".$input_user."','".$dept."','".$descs."','".$voucher."',".$ledger.",".$ap_id.",".$apinvoice.",".replace_numeric($debit).",".replace_numeric($credit)."");
					
					$gl_id = $this->db->select('gl_id,acc_name')
												->where('voucher',$voucher)
												->where('acc_no',$acc_no)
												->get('db_gldetail')->row();
				
				
				$xtampil = array 
				(
					 'xacc_no' => $acc_no,
					 'gl_id' => $gl_id->gl_id,
					 'acc_no' => $acc_no,
					 'acc_name' =>  $gl_id->acc_name,
					 'descs' => $descs,		
					 'debet' => $debit ,	 
					 'credit' => $credit

				);
			die(json_encode($xtampil));
	
				}else{
					//$query = $this->db->query("sp_Insertgldetail '".$acc_no."','".$dept."','".$descs."','".$voucher."',".replace_numeric($debit).",".replace_numeric($credit)."");
					$query = $this->db->query("sp_updategldetail '".$id_gl."','".$acc_no."','".$dept."','".$descs."','".$voucher."',".replace_numeric($debit).",".replace_numeric($credit)."");
					
					$gl_id = $this->db->select('gl_id,acc_name')
												->where('voucher',$voucher)
												->where('acc_no',$acc_no)
												->get('db_gldetail')->row();
				
				
				$xtampil = array 
				(
					 'xacc_no' => $acc_no,
					 'gl_id' => $id_gl,
					 'acc_no' => $acc_no,
					 'acc_name' => $acc_name,
					 'descs' => $descs,		
					 'debet' => $debit ,	 
					 'credit' => $credit

				);
			die(json_encode($xtampil));
	
				}	
				
					// $gl_id = $this->db->select('gl_id,acc_name')
												// ->where('voucher',$voucher)
												// ->where('acc_no',$acc_no)
												// ->get('db_gldetail')->row();
				
				
				// $xtampil = array 
				// (
					 // 'xacc_no' => $acc_no,
					 // 'gl_id' => $gl_id->gl_id,
					 // 'acc_no' => $acc_no,
					 // 'acc_name' => $gl_id->acc_name,
					 // 'descs' => $descs,		
					 // 'debet' => $debit ,	 
					 // 'credit' => $credit

				// );
			// die(json_encode($xtampil));
			
			}
			
			function lempar($no,$thn,$bln,$urut){
//		$voucher = $this->input->
		$data = $no."/".$thn."/".$bln."/".$urut;
		
		
		
		$getsql = $this->db->select('convert(varchar,CONVERT(money, sum(debit)),1) as debet, convert(varchar,CONVERT(money, sum(credit)),1) as credit')
						  
						   ->where('voucher',$data)
						   ->get('db_gldetail')->row();
				
		echo json_encode($getsql);
		
		}
		
		//function show_form2($no,$pt,$desc,$bln,$rema){
		function show_form2($no,$pt,$desc,$bln){
		$index = $_GET['index'];
		//$data['xref']   = $xref;
		$nobgt = $no."/".$pt."/".$desc."/".$bln;
		$rows = $this->db->where('acc_no',$nobgt)
						->get('db_gldetail')->row();
		//var_dump($rows);			
		//$data['acc_no'] = $rows->acc_no;				
		$data['no_bgt'] = $no."/".$pt."/".$desc."/".$bln;
		//$data['rem'] = $rema;	
		$this->load->view("gl/show_jurnaltransfer",$data);
		}	
		
		function delete($a){
						$gl_id = $_REQUEST['gl_id'];
						$this->db->where('gl_id',$a);
						$this->db->delete('db_gldetail');
			}
			
		function loaddata(){
			#die($this->input->post('parent_id'));
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				
				switch($data_type){
					case 'acc_no':
					    $sql = $this->db->select('acc_no id,(acc_no +"  ||  "+ acc_name) nama')
										//->where('group_acc','E')
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
			
			
			if($debet <> $credit){
				die("Jurnal Tidak Balance");
			}elseif (empty($cekvoucher)){
				die("Jurnal Masih Kosong");
			}else{
				$query = $this->db->query("sp_Insertglheader '".$trx_type."','".$input_user."','".$project_detail."','".inggris_date($voucher_date)."','".$voucher."','".$remark."'");
				die('sukses');
			}
			}		
			
	function getaccname($id){
			extract(PopulateForm());
		
		    $sql = $this->db->query("SP_Cekaccname '".$id."'")->row();
							    
		    
		    die(json_encode($sql));

				
		}


	
}

