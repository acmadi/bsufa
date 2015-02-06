<?php
	class bankkeluar extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('bankkeluar_model');
			$this->set_page_title('Bank Keluar');
			$this->default_limit = 60;
			$this->template_dir = 'cb/bankkeluar';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
		}
		
		protected function setup_form($data=false){
                        
                        $this->parameters['bank'] = $this->db->select('bank_id,bank_nm')
                                                                                                            ->order_by('bank_id','ASC')
                                                                                                            ->get('db_bank')
                                                                                                            ->result();            
						$this->parameters['trxtype'] = $this->db->select('trxtype_id,trx_type')
																											->where('trx_type','BK')
                                                                                                            ->order_by('trxtype_id','ASC')
                                                                                                            ->get('db_trxType')
                                                                                                            ->result();     					
						$this->parameters['po'] = $this->db->select('apinvoice_id,doc_no,id_plan')	
																											->join('db_cashplan', 'db_cashplan.id_ap = db_apinvoice.apinvoice_id')
																											->where('status',2)
                                                                                                            ->order_by('apinvoice_id','ASC')
                                                                                                            ->get('db_apinvoice')
                                                                                                            ->result();     																																		
						$this->parameters['data'] = $this->db->select('id_cash,voucher')
                                                                                                            ->order_by('id_cash','ASC')
                                                                                                            ->get('db_cashheader')
                                                                                                            ->result();     
																											
																											
			$no = 1;
			$proj = 44;														   
			$sql = $this->db->query("sp_cekbkno ".$no.",".$proj."")->row();
			//var_dump($sql);
			$this->parameters['nobk'] = $sql->no_bk;	
																											
            }	
			
		function get_json(){
		$this->set_custom_function('trans_date','indo_date');
		
		//$this->set_custom_function('amount','currency');
		parent::get_json();
		}
		
		function index(){
			#die("test");
			$this->set_grid_column('id_cash','ID',array('hidden'=>true));
			//$this->set_grid_column('id_plan','ID',array('hidden'=>true));
			$this->set_grid_column('id_cash','ID Cash',array('width'=>50, 'formatter' => 'cellColumn'));
			$this->set_grid_column('doc_no','AP No',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('voucher','Voucher',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('trans_date','Trans Date',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('bank_nm','Bank',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('slip_date','Payment Date',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('payment_date','Bank Date',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('amount','Amount',array('width'=>160, 'align'=>'right', 'formatter' => 'cellColumn'));			
			$this->set_jqgrid_options(array('width'=>1280,'height'=>450,'caption'=>'BANK PAYMENT','rownumbers'=>true,'sortname'=>'a.id_plan','sortorder'=>'DESC'));
			parent::index();		
		}		
		
		function getdata($id){
			$sql = $this->db->query("SP_ViewCBPO ".$id."")->row(); 
			die(json_encode($sql));
		}
		
		function payment($id){
		//die($id);
			$no = 1;
			$proj = 44;														   
			$sql = $this->db->query("sp_cekbkno ".$no.",".$proj."")->row();
			//var_dump($sql);
			$data['nobk'] = $sql->no_bk;	
			$data['row'] = $this->db->query("select c.nm_supplier,c.alamat,b.doc_no,b.base_amt,b.project_no from db_cashheader a
							left join db_apinvoice b on a.apinvoice_id = b.apinvoice_id 
							left join pemasokmaster c on b.vendor_acct = c.kd_supp_gb where a.id_cash = '$id'")->row();
							//var_dump($data['row']);exit;
			$data['cashflow'] = $this->db->query("select cashflow_id,kodecash,nama from db_cashflow order by nama asc")->result();
			$data['bank'] = $this->db->query("select bank_id,bank_nm,bank_acc from db_bank where id_pt=11")->result();
			#$this->load->view('cb/bankkeluar_add',$data);
			$this->load->view('cb/bankkeluarx_add',$data);
		}
						
		// function cekdata(){			
				// $data = array();
				// $this->db->select('*')->from('db_cashheader')
											// ->where('voucher','')
											// ->order_by('voucher', 'desc');
				// $Q = $this-> db-> get();
				// if ($Q-> num_rows() > 0){
				// foreach ($Q-> result_array() as $row){
				// $data[] = $row;
				// }
				// }
				// $Q-> free_result();
				// echo json_encode($data);
		// }
		function cekdata($id_cash){
			$sql = $this->db->query("SP_Viewbkdetail ".$id_cash."")->result(); 
			
			echo (json_encode($sql));
		}
		
		function approve2($id){         
				//die($id);
			$payment_date = $this->db->select('payment_date as date')
							   ->where('id_cash',$id)
							   ->get('db_cashheader')->row();
							   
			if($payment_date->date == NULL ){
			die("Data Belum Lengkap");
			}else{
				
						
					$query = $this->db->query("sp_approvecb '".$id."'");
					die('sukses');
					}
					
					//die('Approval Succes');
						//$this->loadTemplate('cb/bankmonitoring_call');                                  
                                              
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
		
		function PO(){			
		
		//die($id_cash);

		 $data = array();
				$this->db->select('apinvoice_id,doc_no')->from('db_apinvoice')
																	>where('apinvoice_id',$id)
																	->order_by('doc_no', 'Asc');
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

		                                     $sql = "select acc_no,(acc_no + '  ||  ' + left(acc_name,30)) AS name
                                                            from db_coa
                                                            where type= 2";
                                                            
                                    $data = $this->db->query($sql)->result();                    

				echo json_encode($data);
		}
		
		function loadAP(){			

		                                     $sql = "select doc_no, nm_supplier, trx_amt from db_apinvoice a
														inner join pemasokmaster b on b.kd_supp_gb=a.vendor_acct where status='1'";
                                                            
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
		
		function savedetail($nobk){					
					$acc_no = $_REQUEST['acc_no'];
					//$dept = $_REQUEST['dept'];
					$line_desc = $_REQUEST['line_desc'];
					$amount = $_REQUEST['amount'];
									
					$data = array
					(
					
						'acc_no'=>$acc_no,
						'line_desc'=>$line_desc,
						'amount'=>$amount						
					);	
		
					$query = $this->db->query("sp_Insertcashdetail '".$acc_no."','".$line_desc."',".$amount."");
					              					
			}		
		/*function saveheader(){
					//$bankname = $this->input->post('bank_nm');
			//$acc_no = $_REQUEST['acc_no'];
					$trx_type = $this->input->post('trxtype');
					$voucher = $this->input->post('voucher');
					$bank = $this->input->post('bank');
					$tgl = $this->input->post('tgl');
					$paid = $this->input->post('paid');
					$from = $this->input->post('from');
					$kodecash = $this->input->post('kodecash');
					$apno = $this->input->post('apno');
					$no_cek = $this->input->post('nocek');
					$cek_date = $this->input->post('cek_date');
					$paid_date = $this->input->post('paid_date');
					$amount = $this->input->post('amount');
					$remark = $this->input->post('remark');	
					$input_user = $this->user;					
					
					$dtprv['voucher'] = $voucher;

					$query = $this->db->query("sp_InsertBK '".$trx_type."','".$input_user."','".$voucher."','".$bank."','".inggris_date($tgl)."','".$paid."','".$from."','".$kodecash."','".$apno."','".$no_cek."','".inggris_date($cek_date)."','".inggris_date($paid_date)."',".replace_numeric($amount).",'".$remark."'");
					//$this->load->view('cb/print/print_rpayvoucher',$dtprv);
					die('sukses');		              
			}	*/
			
			function saveheader(){
			$month_now = date('m');
			$year_now = date('Y');
			$closing = $this->db->query("select top 1 * from db_closingfinance order by id_closf desc")->row();
			if ($month_now <= $closing->periode_bulan && $year_now <= $closing->periode_tahun) {
				die('Bulan tersebut sudah closing');
			} else {
			#end update danu
					//$bankname = $this->input->post('bank_nm');
			//$acc_no = $_REQUEST['acc_no'];
					//$trx_type = $this->input->post('trxtype');
					$trx_type = 'BK';
					$voucher = $this->input->post('voucher');
					$bank = $this->input->post('bank');
					$tgl = $this->input->post('tgl');
					$paid = $this->input->post('paid');
					//$from = $this->input->post('from');
					$kodecash = $this->input->post('kodecash');
					$apno = $this->input->post('id_plan');
					//$no_cek = $this->input->post('nocek');
					//$cek_date = $this->input->post('cek_date');
					//$paid_date = $this->input->post('paid_date');
					$amount = $this->input->post('amount');
					$remark = $this->input->post('remark');	
					$input_user = $this->user;					
					
					$dtprv['voucher'] = $voucher;
					//die($apno);
					$query = $this->db->query("sp_InsertBKN '".$trx_type."','".$input_user."','".$voucher."','".$bank."','".inggris_date($tgl)."','".$paid."','".$kodecash."','".$apno."',".replace_numeric($amount).",'".$remark."'");
					//$this->load->view('cb/print/print_rpayvoucher',$dtprv);
					echo "<script>alert('Sukses');
						document.location.href='".base_url()."cb/bankkeluar/';</script>";
				}		              
			}			

			function Editheader(){
					$voucher = $this->input->post('voucher');
					$nocek = $this->input->post('nocek');
					$cek_date = $this->input->post('cek_date');
					$paid_date = $this->input->post('paid_date');
					$trans_date = $this->input->post('tgl');
					
					//$dtprv['voucher'] = $voucher;

					$query = $this->db->query("sp_EditBK '".$voucher."','".$nocek."','".inggris_date($cek_date)."','".inggris_date($paid_date)."','".inggris_date($trans_date)."'");
					//$this->load->view('cb/print/print_rpayvoucher',$dtprv);
					die('sukses');				              
			}		
			
			function Editheader2(){
					$voucher = $this->input->post('voucher');
					$nocek = $this->input->post('nocek');
					$cek_date = $this->input->post('cek_date');
					$paid_date = $this->input->post('paid_date');
					$trans_date = $this->input->post('tgl');
					
					//$dtprv['voucher'] = $voucher;

					$query = $this->db->query("sp_EditBK2 '".$voucher."','".$nocek."','".inggris_date($cek_date)."','".inggris_date($paid_date)."','".inggris_date($paid_date)."'");
					//$this->load->view('cb/print/print_rpayvoucher',$dtprv);
					die('sukses');		              
			}		
			
			function print_slip($id){		

			//die($id);
			$dtprv['id'] = $id;
			
			$this->load->view('cb/print/print_rpayvoucherall',$dtprv);
		}
			
			function delete(){
		
					$trxtype = intval($_REQUEST['trx_type']);
				die($trxtype);
		
					              
					//if($trxtype_id){
						$this->db->where('trx_type',$trxtype);
						$this->db->delete('db_trxtype');
						echo"Data berhasil didelete";
					//}else{	
						// $this->db->insert('db_trxtype',$data);								
						// echo"Data berhasil tersimpan";
					// }
					
					
			}		
			
		function approve($id){
		//die('test');
		$cek_status = $this->db->select('status as id')
							   ->where('id_cash',$id)
							   ->get('db_cashheader')->row();
							   
		$cek_bank = $this->db->select('slip_date as date')
							   ->where('id_cash',$id)
							   ->get('db_cashheader')->row();
							   
		$cek_trans = $this->db->select('left(convert(varchar(10), payment_date, 112),6) as period ')
							   ->where('id_cash',$id)
							   ->get('db_cashheader')->row();
							   
		$cek_closing = $this->db->select('acc_period as closing ')
							 //  ->where('id_cash',$id)
							   ->get('db_endofyear')->row();
							   
		if($cek_status->id == 3 ){
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
		}elseif($cek_trans->period < $cek_closing->closing ){
		echo"
				<script type='text/javascript'>
					alert('Data Sudah Closing');
					refreshTable();
				</script>
			";		
		}else{
			parent::approve($id);
			//$this->load->view('cb/bankkeluar-app',$id);
		}
		}
		
		// function add($id){
		
		// $cekvoucher = $this->db->select('voucher as id')
							   // ->where('refno',$id)
							   // ->get('db_cashheader')->row();
		// if(empty($cekvoucher){
			// echo"
				// <script type='text/javascript'>
					// alert('Sudah di Payment');
					// refreshTable();
				// </script>
			// ";
		// }else{
			// parent::add($id);
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
