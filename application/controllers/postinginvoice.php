<?php
class postinginvoice extends DBController{
	function __construct(){
		parent::__construct('postinginvoice_model');
		$this->set_page_title('Generate Invoice');
		$this->default_limit = 30;
		$this->template_dir = 'leasing/postinginvoice';
		$session_id = $this->UserLogin->isLogin();
		$this->user = $session_id['username'];

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
		// $this->set_custom_function('trans_date','indo_date');
		// // $this->set_custom_function('pay_date','indo_date');
		//$this->set_custom_function('debit','currency');
		//$this->set_custom_function('credit','currency');
		parent::get_json();
	 }
	
	function index(){
		$this->set_grid_column('id_ledger','ID',array('hidden'=>true,'key'=>true));
		$this->set_grid_column('kd_tenant','KD Tenant',array('width'=>30,'align'=>'Left', 'formatter' => 'cellColumn'));
		$this->set_grid_column('no_invoice','Invoice No',array('width'=>30,'align'=>'Left', 'formatter' => 'cellColumn'));
		$this->set_grid_column('customer_nama','Tenant',array('width'=>40,'align'=>'Left', 'formatter' => 'cellColumn'));
		$this->set_grid_column('tgl_invoice','Date',array('width'=>20,'align'=>'Left', 'formatter' => 'cellColumn'));
		$this->set_grid_column('description','Description',array('width'=>45,'align'=>'Left', 'formatter' => 'cellColumn'));
		//$this->set_grid_column('voucher','Voucher',array('width'=>100,'align'=>'left', 'formatter' => 'cellColumn'));
		//$this->set_grid_column('acc_no','Acc No',array('width'=>60,'align'=>'left', 'formatter' => 'cellColumn'));
		//$this->set_grid_column('desc','Description',array('width'=>150,'align'=>'left', 'formatter' => 'cellColumn'));
		$this->set_grid_column('base_amount','Amount',array('width'=>60,'align'=>'right', 'formatter' => 'cellColumn'));		
		$this->set_jqgrid_options_ceklist(array('width'=>1100,'height'=>250,'caption'=>'Posting Invoice','rownumbers'=>true,'sortname'=>'id_ledger','sortorder'=>'DESC'));
		parent::index();
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

	

		// $cek_trans = $this->db->select('left(convert(varchar(10), trans_date, 112),6) as period ')
							   // ->where('gl_id',$id)
							   // ->get('db_glheader')->row();
		// $cek_closing = $this->db->select('acc_period as closing ')
							 // //  ->where('id_cash',$id)
							   // ->get('db_endofyear')->row();
		// if($cek_trans->period < $cek_closing->closing ){
			// echo"
				// <script type='text/javascript'>
					// alert('Data Sudah Closing');
					// refreshTable();
				// </script>
			// ";
		// }else{	
			$jml=strlen($id);
            $a=explode(',',$id);
            $ja=count($a);
            for($i=0;$i<$ja;$i++){
               //$q=$this->db->query("update db_invoice set id_flag=1 WHERE no_kontrak='$a[$i]'");
			  $q=$this->db->query("sp_postinginvoice '".$a[$i]."'");
            }
					//$query = $this->db->query("sp_approveGL '".$id."'");
					 echo"
                                                <script type='text/javascript'>
                                                            alert('Posting Berhasil');
                                                            window.close();
															refreshTable();
                                                </script>
                                    ";
			//	}
                                              
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
		
		function print_invoice($id){		
		
			$q=$this->db->query("delete from db_invoice_print");
		
		
			$jml=strlen($id);			
            $a=explode(',',$id);
            $ja=count($a);
            for($i=0;$i<$ja;$i++){
             $q=$this->db->query("insert into db_invoice_print values($a[$i])");
//$dtprv['id'] =$a[$i];
			
			
			   
			   
	        }
			
			$this->load->view('leasing/print/print_rptinvoice');
		

			//die($id);
			// $dtprv['id'] = $id;
			
			// $this->load->view('leasing/print/print_rptinvoice',$dtprv);
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
		
		function view_invoice(){
		 // die("tes");
			$session_id = $this->UserLogin->isLogin();
			$user = $session_id['username'];
			$pt = $session_id['id_pt'];		
		    extract(PopulateForm());      
			
			// die("$tgl");

				$w=$this->db->query("update db_ledgerleasing set id_flag=1 WHERE tgl_invoice<='".inggris_date($tgl)."' and id_subproject<>'".$proj."' and id_flag=2");
				$z=$this->db->query("update db_ledgerleasing set id_flag=1 WHERE tgl_invoice>='".inggris_date($tgl)."' and id_subproject<>'".$proj."' and id_flag=2");
				$q=$this->db->query("update db_ledgerleasing set id_flag=2  WHERE tgl_invoice>='".inggris_date($tgl)."' and tgl_invoice<='".inggris_date($tgl2)."' and id_subproject='".$proj."' and id_flag=1");
           
                  
                  echo"
					<script type='text/javascript'>						
						document.location.href = 'postinginvoice'
					</script>
				  ";
        
        }


	
}

