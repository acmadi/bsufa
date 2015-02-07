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
                        																					->like('bank_nm', 'transit') 
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
                                                                                                            ->order_by('doc_no','ASC')
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
			
		
		
		
		
		function index(){ 
			$this->set_grid_column('id_cash','ID',array('hidden'=>true));
			$this->set_grid_column('doc_no','No AP',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('voucher','Voucher',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('no_arsip','No Arsip',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('nm_supplier','Supplier',array('width'=>280, 'formatter' => 'cellColumn'));
			$this->set_grid_column('descs','Ket',array('width'=>200, 'formatter' => 'cellColumn'));
			//$this->set_grid_column('amt_balance','Balance',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('amount','Amount',array('width'=>200, 'align'=>'right','formatter' => 'cellColumn'));
			$this->set_grid_column('slipno','No Cek',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('slip_date','Tgl Cek',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('payment_date','Tgl Bayar',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('paid_date','Tgl Cair',array('width'=>200, 'formatter' => 'cellColumn'));
			/*$this->set_grid_column('voucher','Voucher',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('trans_date','Trans Date',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('acc_name','Bank',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('slip_date','Payment Date',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('payment_date','Bank Date',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('amount','Amount',array('width'=>160, 'align'=>'right', 'formatter' => 'cellColumn'));		*/
			$this->set_jqgrid_options(array('width'=>1280,'height'=>450,'caption'=>'BANK PAYMENT','rownumbers'=>true,'sortname'=>'id_plan','sortorder'=>'DESC'));
			parent::index();		
		}				
		
		function getdata($id){
			$sql = $this->db->query("SP_ViewCBPO ".$id."")->row(); 
			die(json_encode($sql));
		}
		
		function getkodebank($id){
			$kode = $this->db->query("select bank_acc from db_bank where bank_id='$id'")->row();
			die(json_encode($kode));
		}
		
		function paid($id){
			//die($id);
			$cek = $this->db->query("select c.status as status from db_cashplan a
							join db_apinvoice b on a.id_ap = b.apinvoice_id 
							join db_cashheader c on a.id_cash = c.id_cash where a.id_plan = '$id'")->row()->status;
			if($cek>=3){
			echo "<script>alert('Sudah Paid');
				refreshTable();</script>";
			}else{
			$data['row'] = $this->db->query("select c.trans_date,c.slipno,c.payment_date,c.voucher,c.bankacc,c.descs,c.amount,c.paidby,b.doc_no,c.id_cash from db_cashplan a
							join db_apinvoice b on a.id_ap = b.apinvoice_id 
							join db_cashheader c on a.id_cash = c.id_cash where a.id_plan = '$id'")->row();
		
			$data['bank'] = $this->db->query("select bank_nm,bank_acc from db_bank where bank_id='".$data['row']->bankacc."'")->row();
			$data['id_plan'] = $id;
			$this->load->view('cb/bankkeluar_paid',$data);
			}
		}
		
		function payment($id){
			$id_cash = $id;
			$id = $this->db->query("select a.id_plan from db_cashplan a join db_cashheader b on a.id_ap = b.apinvoice_id where b.id_cash =  '$id'")->row()->id_plan;
			//var_dump($id);exit;
		#var_dump($id);exit;
			$no = 1;
			$proj = 11;														   
			$sql = $this->db->query("sp_cekbkno ".$no.",".$proj."")->row();
			//var_dump($sql);
			$data['nobk'] = $sql->no_bk;	
			
			/*$data['nil'] = $this->db->query("select c.*, a.id_plan,b.doc_no,b.base_amt as jumlah_tagihan,a.plan_amount as jumlah_bayar,debet-d.base_amount as balance from db_cashplan a
							join db_apinvoice b on a.id_ap = b.apinvoice_id 
							join db_apinvoiceoth c on c.doc_no = b.doc_no 
							join db_cashheader d on d.apinvoice_id = b.apinvoice_id
							where a.id_plan = '".$id."' and debet != 0 and acc_name not like '%ppn%' and acc_no!='' ")->row();*/
			$data['bayar'] = $this->db->query("select amount from db_cashheader where id_cash = '$id_cash'")->row();
			//}else{
				$data['id_plan'] = $id;
				$data['id_cash'] = $id_cash;
			$data['row'] = $this->db->query("select b.project_no,b.descs as rem,a.id_plan,c.nm_supplier,c.alamat,b.doc_no,b.base_amt,b.project_no from db_cashplan a
							join db_apinvoice b on a.id_ap = b.apinvoice_id 
							join PemasokMaster c on b.vendor_acct = c.kd_supplier where a.id_plan = '$id' ")->row(); 
			$data['cashflow'] = $this->db->query("select cashflow_id,kodecash,nama from db_cashflow order by nama asc")->result();
			$data['coa'] = 	$this->db->query("select c.* from db_cashplan a
							join db_apinvoice b on a.id_ap = b.apinvoice_id 
							join db_apinvoiceoth c on c.doc_no = b.doc_no 
							where a.id_plan = '$id' and debet != 0 and acc_name not like '%ppn%' and acc_no!=''")->result();
			$data['bank'] = $this->db->query("select bank_id,bank_nm,bank_acc from db_bank where bank_nm not like ('%transit%') and id_pt=11")->result();
			$this->load->view('cb/bankkeluar_add',$data);
			//}
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
		
		function getcoacash(){
			$term = $this->input->post('term'); 
			//$Qry  = "SELECT acc_no,acc_name FROM db_coa WHERE acc_no LIKE '".$term."%' or acc_name LIKE '".$term."%' and type='2.00' ORDER BY id_coa";
			//$Qry = "select id_coa as cashflow_id,acc_no as kodeperk,acc_name as nama from db_coa where (acc_no like ('%".$term."%') or acc_name like ('%".$term."%')) order by acc_name asc";
			$Qry = "select cash_id as cashflow_id,kodecash as kodeperk,nama from cashflow where (kodecash like ('%".$term."%') or nama like ('%".$term."%')) order by nama asc";
			$Sql  = $this->db->query($Qry)->result();
			
			foreach ($Sql as $r){
				$r->value  = $r->kodeperk." | ".$r->nama;
				$r->id	   = $r->nama;
				$row_set[] = $r; 		
			}

			echo json_encode($row_set);
		
			}
		
		function approve2($id){  
			$month_now = date('m');
			$year_now = date('Y');
			$closing = $this->db->query("select top 1 * from db_closingfinance order by id_closf desc")->row();
			if ($month_now <= $closing->periode_bulan && $year_now <= $closing->periode_tahun) {
				echo "<script>
					alert('Bulan tersebut sudah closing');
					history.go(-1);
					</script>";
			} else {       
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
		
		function getidcash($id){
		$sql = $this->db->query("select b.status as status from db_cashplan a join db_cashheader b on a.id_cash = b.id_cash where a.id_plan = '$id'")->row();
		if(!empty($sql)){
		die(json_encode($sql));
		}else{
		$data['status'] = '0';
		die(json_encode($data));
		}
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
			$month_now = date('m');
			$year_now = date('Y');
			$closing = $this->db->query("select top 1 * from db_closingfinance order by id_closf desc")->row();
			if ($month_now <= $closing->periode_bulan && $year_now <= $closing->periode_tahun) {
				die('Bulan ini sudah closing');
			} else {
			#end update danu				
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
		}		
		
		function get_bank($id){
			$data = "<option>--</option>";
			$q = $this->db->query("select * from db_bank where id_subproject = '$id'")->result();
			foreach($q as $row){
			$data .= "<option value='".$row->bank_id."'>".$row->bank_nm." | ".$row->bank_acc."</option>";
			}
			die($data);
		}

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
					$proj = $this->input->post('proj');
					$tgl = $this->input->post('tgl');
					$paid = $this->input->post('paid');
					//$from = $this->input->post('from');
					$kodecash = $this->input->post('kodecash');
					$apno = $this->input->post('id_plan');
					$idcash  = $this->input->post('id_cash');
					//$no_cek = $this->input->post('nocek');
					//$cek_date = $this->input->post('cek_date');
					//$paid_date = $this->input->post('paid_date');
					$amount = $this->input->post('byr');
					$remark = $this->input->post('remark');	
					$input_user = $this->user;					
					$memo = $this->input->post('memo'); 
					$dtprv['voucher'] = $voucher;
				//	die("sp_InsertBK '".$idcash."','".$proj."','".$trx_type."','".$input_user."','".$voucher."','".$bank."','".inggris_date($tgl)."','".$paid."','".$apno."',".replace_numeric($amount).",'".$remark."','".$memo."'");
					//die($apno);
					//die("sp_InsertBK '".$trx_type."','".$input_user."','".$voucher."','".$bank."','".inggris_date($tgl)."','".$paid."','".$apno."',".replace_numeric($amount).",'".$remark."','".$memo);
					//die("sp_InsertBK '".$proj."','".$trx_type."','".$input_user."','".$voucher."','".$bank."','".inggris_date($tgl)."','".$paid."','".$apno."',".replace_numeric($amount).",'".$remark."','".$memo."'");
					$query = $this->db->query("sp_InsertBK '".$idcash."','".$proj."','".$trx_type."','".$input_user."','".$voucher."','".$bank."','".inggris_date($tgl)."','".$paid."','".$apno."',".replace_numeric($amount).",'".$remark."','".$memo."'");
					//$this->load->view('cb/print/print_rpayvoucher',$dtprv);
					$total_row = $this->input->post('total_row');
					for($no=1;$no<=$total_row;$no++){
						$data = array(
							'project_cd'	=> $this->input->post('project'),
							'voucher'		=> $this->input->post('voucher'),
							'acc_no'		=> $this->input->post('kodecash'.$no),
							'acc_name'		=> $this->input->post('cashname'.$no),
							'amount'		=> $this->input->post('amount'.$no),
							'rate'			=> 1,
							'module'		=> 'CB',
							'dept'			=> 9,
							'user_'			=> $input_user,
							'datetime'		=> date('Y-m-d h:i:s')
							);
						$this->db->insert('db_cashdetail',$data);
					}
					die('sukses');
				}		              
			}			

			function Editheader(){
				$month_now = date('m');
				$year_now = date('Y');
				$closing = $this->db->query("select top 1 * from db_closingfinance order by id_closf desc")->row();
				if ($month_now <= $closing->periode_bulan && $year_now <= $closing->periode_tahun) {
					die('Bulan tersebut sudah closing');
				} else {
				#end update danu
					$no_arsip = $this->input->post('no_arsip');
					//die($no_arsip);exit();
					$voucher = $this->input->post('voucher');
					$nocek = $this->input->post('nocek');
					$cek_date = $this->input->post('cek_date');
					//$paid_date = $this->input->post('paid_date');
					$trans_date = $this->input->post('tgl');
					
					//$dtprv['voucher'] = $voucher;

					$query = $this->db->query("sp_EditBK '".$voucher."','".$nocek."','".inggris_date($cek_date)."','".inggris_date($trans_date)."','".$no_arsip."'");
					//$this->load->view('cb/print/print_rpayvoucher',$dtprv);
					die('sukses');
				}				              
			}		
			
			function Editheader2(){
				$month_now = date('m');
				$year_now = date('Y');
				$closing = $this->db->query("select top 1 * from db_closingfinance order by id_closf desc")->row();
				if ($month_now <= $closing->periode_bulan && $year_now <= $closing->periode_tahun) {
					die('Bulan tersebut sudah closing');
				} else {
				#end update danu
					$id_cash = $this->input->post('id_cash');
					$id_plan = $this->input->post('id_plan'); 
					//die($id_plan);
					$voucher = $this->input->post('voucher');
					$nocek = $this->input->post('nocek');
					$cek_date = $this->input->post('cek_date');
					$paid_date = $this->input->post('paid_date'); 
					$payment_date = $this->input->post('payment_date');
					$trans_date = $this->input->post('tgl');
					if($paid_date == ''){
					$no_arsip = '';
					}else{
					$new_no = $this->db->query("select count(*) as total from db_cashheader where voucher like 'Bk%'")->row()->total;
					if($new_no<=9){
						$doc_no = "BK-0000".$new_no;
						}elseif($new_no<=99){
						$doc_no = "BK-000".$new_no;
						}elseif($new_no<=999){
						$doc_no = "BK-00".$new_no;
						}elseif($new_no<=9999){
						$doc_no = "BK-0".$new_no;
						}elseif($new_no<=99999){
						$doc_no = "BK-".$new_no;
						}
					$no_arsip = $doc_no;
					}
					//die($voucher."','".$nocek."','".inggris_date($cek_date)."','".inggris_date($payment_date)."','".inggris_date($paid_date)."','".$no_arsip);
					/*$ap = $this->db->query("select a.* from db_apinvoice a join db_cashplan b on a.apinvoice_id = b.id_ap where b.id_plan = '$id_plan'")->row();
					$data = array(
					'project_cd'	=> $ap->project_no,
					'voucher'		=> $ap->doc_no,
					'trans_date'	=> $ap->doc_date,
					'[desc]'			=> $ap->doc_no." ".$ap->descs,
					'debit'			=> $ap->base_amt,
					'credit'		=> $ap->base_amt,
					'module'		=> 'AP',
					'[status]'		=> '0',
					'audit_user'	=> 'mgr.bsu',
					'audit_date'	=> date('Y-m-d h:i:s'),
					'entry_date'	=> date('Y-m-d h:i:s')
					);
					$this->db->insert('db_glheader',$data);*/
					
					//CEK DATA GL TERLEBIH DAHULU
					$glheader = $this->db->query("select count(*) as total from db_glheader where voucher = '$voucher'")->row()->total;
					$gldetail = $this->db->query("select count(*) as total from db_gldetail where voucher = '$voucher'")->row()->total;
					//die($gldetail." ".$glheader);
					if($glheader==0 && $gldetail==0){
					$cb = $this->db->query("select * from db_cashheader where id_cash = '$id_cash'")->row();
					$data = array(
					'project_cd'	=> $cb->project_cd,
					'voucher'		=> $cb->voucher,
					'trans_date'	=> $cb->trans_date,
					'[desc]'		=> $cb->voucher." ".$cb->descs,
					'debit'			=> $cb->amount,
					'credit'		=> $cb->amount,
					'module'		=> 'CB',
					'[status]'		=> '0',
					'audit_user'	=> 'mgr.bsu',
					'audit_date'	=> date('Y-m-d h:i:s'),
					'entry_date'	=> date('Y-m-d h:i:s')
					);
					$t = $this->db->insert('db_glheader',$data);
		
					/*$jurap = $this->db->query("select a.*,b.project_no from db_apinvoiceoth a
												join db_apinvoice b on b.doc_no = a.doc_no 
												join db_cashplan c on c.id_ap = b.apinvoice_id 
												where c.id_plan = '$id_plan'")->result();
					foreach($jurap as $rowa){
					$data = array(
					'voucher'		=> $rowa->doc_no,
					'acc_no'		=> $rowa->acc_no,
					'acc_name'		=> $rowa->acc_name,
					'line_desc'		=> $rowa->descs,
					'debit'			=> $rowa->debet,
					'credit'		=> $rowa->credit,
					'trans_date'	=> date('Y-m-d h:i:s'),
					'audit_user'	=> 'mgr.bsu',
					'audit_date'	=> date('Y-m-d h:i:s'),
					'project_no'	=> $rowa->project_no
					);
					$this->db->insert('db_gldetail',$data);
					}*/
					$jurcb = $this->db->query("select f.gl_id,c.project_no,b.bank_coa,b.bank_acc,b.bank_nm,d.*,a.voucher,a.amount,b.plan_amount  from db_cashheader a 
												join db_bank b on a.bankacc = b.bank_id
												join db_apinvoice c on c.apinvoice_id = a.apinvoice_id 
												join db_apinvoiceoth d on d.doc_no = c.doc_no 
												join db_cashplan e on e.id_ap = a.apinvoice_id 
												join db_glheader f on f.voucher = a.voucher
												where a.id_cash = '$id_cash' and d.acc_name like 'ap trade%'")->row();
					$data1 = array(
					'voucher'		=> $jurcb->voucher,
					'acc_no'		=> $jurcb->acc_no,
					'acc_curr'		=> 'IDR',
					'module'		=> 'CB',
					'dept'			=> 'Finance',
					'ref_no'		=> $jurcb->gl_id,
					'acc_name'		=> $jurcb->acc_name,
					'line_desc'		=> $jurcb->descs,
					'debit'			=> $jurcb->plan_amount,
					'credit'		=> '0',
					'trans_date'	=> date('Y-m-d h:i:s'),
					'audit_user'	=> 'mgr.bsu',
					'audit_date'	=> date('Y-m-d h:i:s'),
					'project_no'	=> $jurcb->project_no
					);
					$this->db->insert('db_gldetail',$data1);
					$data2 = array(
					'voucher'		=> $jurcb->voucher,
					'acc_no'		=> $jurcb->bank_coa,
					'acc_curr'		=> 'IDR',
					'module'		=> 'CB',
					'dept'			=> 'Finance',
					'ref_no'		=> $jurcb->gl_id,
					'acc_name'		=> $jurcb->bank_nm,
					'line_desc'		=> ' ',
					'debit'			=> '0',
					'credit'		=> $jurcb->plan_amount,
					'trans_date'	=> date('Y-m-d h:i:s'),
					'audit_user'	=> 'mgr.bsu',
					'audit_date'	=> date('Y-m-d h:i:s'),
					'project_no'	=> $jurcb->project_no
					);
					$this->db->insert('db_gldetail',$data2);
					//die($voucher."','".$nocek."','".inggris_date($cek_date)."','".inggris_date($payment_date)."','".inggris_date($paid_date));
					$query = $this->db->query("sp_EditBK2 '".$voucher."','".$nocek."','".inggris_date($cek_date)."','".inggris_date($payment_date)."','".inggris_date($paid_date)."','".$no_arsip."'");
					}else{
					$query = $this->db->query("sp_EditBK2 '".$voucher."','".$nocek."','".inggris_date($cek_date)."','".inggris_date($payment_date)."','".inggris_date($paid_date)."','".$no_arsip."'");
					}
					//$this->load->view('cb/print/print_rpayvoucher',$dtprv);
					die('sukses');
				}		              
			}		
			
			function print_slip($id){		

			#var_dump($id);exit;
			$id_cash = $id;
			$dtprv['nilai'] = $this->db->query("select amount from db_cashheader where id_cash = '$id_cash'")->row()->amount;
			$id = $this->db->query("select a.id_plan from db_cashplan a join db_cashheader b on a.id_ap = b.apinvoice_id where b.id_cash =  '$id'")->row()->id_plan;
			$dtprv['id'] = $id;
			
			$this->load->view('cb/print/print_rpayvoucherall',$dtprv);
			}
		
			function pyd($id){
				$id_cash = $id;
			$id = $this->db->query("select a.id_plan from db_cashplan a join db_cashheader b on a.id_ap = b.apinvoice_id where b.id_cash =  '$id'")->row()->id_plan;
			$cek = $this->db->query("select c.status as status from db_cashplan a
							join db_apinvoice b on a.id_ap = b.apinvoice_id 
							join db_cashheader c on a.id_cash = c.id_cash where a.id_plan = '$id'")->row()->status;
			/*if($cek=3){
			echo "<script>alert('Sudah Payment Plan');
				refreshTable();</script>";
			}else{*/
			$data['id_cash'] = $id_cash;
			$data['nilai'] = $this->db->query("select amount from db_cashheader where id_cash = '$id_cash'")->row()->amount;
			$data['row'] = $this->db->query("select c.slip_date,c.payment_date,c.paid_date,c.slipno,c.no_arsip,c.trans_date,c.voucher,c.bankacc,c.descs,c.amount,c.paidby,b.doc_no,c.id_cash,a.id_plan from db_cashplan a
							join db_apinvoice b on a.id_ap = b.apinvoice_id 
							join db_cashheader c on a.id_cash = c.id_cash where a.id_plan = '$id'")->row();
		
			$data['bank'] = $this->db->query("select bank_nm,bank_acc from db_bank where bank_id='".$data['row']->bankacc."'")->row();
			$this->load->view('cb/bankkeluar_payment',$data);
			//}
			}
			
			function delete(){
				$month_now = date('m');
				$year_now = date('Y');
				$closing = $this->db->query("select top 1 * from db_closingfinance order by id_closf desc")->row();
				if ($month_now <= $closing->periode_bulan && $year_now <= $closing->periode_tahun) {
					die('Bulan tersebut sudah closing');
				} else {
				#end update danu
					$trxtype = intval($_REQUEST['trx_type']);
				//die($trxtype);
		
					              
					//if($trxtype_id){
						$this->db->where('trx_type',$trxtype);
						$this->db->delete('db_trxtype');
						echo"Data berhasil didelete";
					//}else{	
						// $this->db->insert('db_trxtype',$data);								
						// echo"Data berhasil tersimpan";
					// }
					}
			}		
			
		function approve($id){
			$month_now = date('m');
		$year_now = date('Y');
		$closing = $this->db->query("select top 1 * from db_closingfinance order by id_closf desc")->row();
		if ($month_now <= $closing->periode_bulan && $year_now <= $closing->periode_tahun) {
			die('Bulan tersebut sudah closing');
		} else {
		#end update danu
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
			$month_now = date('m');
			$year_now = date('Y');
			$closing = $this->db->query("select top 1 * from db_closingfinance order by id_closf desc")->row();
			if ($month_now <= $closing->periode_bulan && $year_now <= $closing->periode_tahun) {
				die('Bulan tersebut sudah closing');
			} else {
			#end update danu
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
	}
?>
