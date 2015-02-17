<?php
	class pettycash extends DBController{
		#upte Abas
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('pettycash_model');
			$this->set_page_title('Petty Cash');
			$this->default_limit = 30;
			$this->template_dir = 'cb/pettycash';
		}	
		
		protected function setup_form($data=false){
																										
																											
			$no = 1;
			$proj = 22;														   
			$sql = $this->db->query("sp_cekpcno ".$no.",".$proj."")->row();
			//var_dump($sql);
			$this->parameters['nopc'] = $sql->no_pc;	
																											
            }	
			
		
		function get_json(){
		$this->set_custom_function('claim_date','indo_date');
		$this->set_custom_function('debet','currency');
		$this->set_custom_function('credit','currency');
		$this->set_custom_function('saldo','currency');
		parent::get_json();
	}
		
		
		function index(){
			#die("test");
			$this->set_grid_column('pettycash_id','ID',array('hidden'=>true));
			$this->set_grid_column('claim_no','Claim No',array('width'=>200,'formatter' => 'cellColumn'));
			$this->set_grid_column('claim_date','Date',array('width'=>150,'formatter' => 'cellColumn'));
			//$this->set_grid_column('acc_no','Cash Out',array('width'=>160,'formatter' => 'cellColumn'));
			$this->set_grid_column('petty_desc','Description',array('width'=>370,'formatter' => 'cellColumn'));
			$this->set_grid_column('debet','Debet',array('width'=>100,'align'=>'right','formatter' => 'cellColumn'));
			$this->set_grid_column('credit','Credit',array('width'=>100,'align'=>'right','formatter' => 'cellColumn'));
			$this->set_grid_column('saldo','Saldo',array('width'=>100,'align'=>'right','formatter' => 'cellColumn'));
			$this->set_jqgrid_options(array('width'=>1200,'height'=>400,'caption'=>'Petty Cash','rownumbers'=>true));
			parent::index();
		
		}
		
		function loadcoa(){			

		 $data = array();
				$this->db->select('acc_no,acc_name')->from('db_coa')
																	->where('type',2)
																	->order_by('acc_no', 'Asc');
				$q = $this-> db-> get();
				if ($q-> num_rows() > 0){
				foreach ($q-> result_array() as $row){
				$data[] = $row;
				}
				}
				$q-> free_result();
				echo json_encode($data);
		}
		function cashflow(){			
		
					
			                          //$sql = "select kodecash,nama
                                      //                      from cashflow
                                       //                     where left(kodecash,1) in ('B','D')";
															
									 $sql = "select acc_no kodecash,acc_name nama
                                                            from db_coa
                                                            where left(acc_no,1) in ('5','6','7')";
                                                            
                                                            
                                    $data = $this->db->query($sql)->result();                    

				echo json_encode($data);

		}
		
		function getsaldo($id){
		
			extract(PopulateForm());
		
		    $sql = $this->db->query("sp_viewsaldopettycash '".$id."'")->row();
							    		    
		    die(json_encode($sql));
	
		}
		
		function getsaldo_last($type,$id){
		
			extract(PopulateForm());
		
		    $sql = $this->db->query("sp_viewsaldopettycash_lastinput '".$id."','".$type."'")->row();
							    		    
		    die(json_encode($sql));
	
		}
		
		
		function input(){
				    //extract(PopulateForm());
					extract(PopulateForm());
					#die($acc_no);


					$rata['type'] 				= $this->input->post('type');
					$rata['pettycash_id'] 		= $this->input->post('pettycash_id');
					$rata['claim_no'] 			= $this->input->post('claim_no');
					$rata['claim_date'] 		= $this->input->post('claim_date');
					$rata['petty_desc'] 		= $this->input->post('petty_desc');
					$rata['acc_no'] 			= $this->input->post('acc_no');
					$rata['amount'] 			= $this->input->post('amount');
					$rata['saldo'] 				= $this->input->post('saldo');
			
					//var_dump(sizeof($rata));exit();

					if(empty($claim_date)){
						die('Date Tidak Boleh Kosong');
								
					}
					else if(empty($type)){
						die('Type Tidak Boleh Kosong');
					}
					else if(empty($acc_no) && $type == 2){
						die('Cash Out Tidak Boleh Kosong');
					}
					else if(empty($amount)){
						die('Amount Tidak Boleh Kosong');
					}		
/*					else if(!isset($acc_no)){
						echo"
								<script type='text/javascript'>
									alert('Blm Ada Opening Balance !!');
									refreshTable();
								</script>
							";			

					}
*/
					else{
					extract(PopulateForm());
					/*
					$data = array
					(
						//'pettycash_id'=>$pettycash_id,
						'Type'=>$type,
						'claim_no'=>$claim_no,
						'claim_date'=>indo_date($claim_date),
						'petty_desc'=>$petty_desc,
						'acc_no'=>$acc_no, 		
						'saldo'=>$amount		
						
					);
					*/
						$cek_opening = $this->db->select('count(status) as status')
							   ->where('status',1)
							   ->get('db_pettyclaim')->row();
					   $cek_status = $this->db->select('count(status) as status')
							   ->where('status',1)
							   ->get('db_pettyclaim')->row();
							   
						if  ($saldo == ""){
							$saldo=0;
							}
							
							
							   
						/*if($cek_status->status == 0 and $type==2 ){
						die("Cash Out Tidak Boleh Kosong");
						}else
						*/
						if($cek_opening->status == 1 and $type==1 ){
						die("Petty Cash Belum Closing");
						}else{
						if($type == 1){
							$acc_no = 0;

						}		

						$query = $this->db->query("sp_pettycash_input '".$type."','".$claim_no."','".inggris_date($claim_date)."','".$petty_desc."','".$acc_no."',".replace_numeric($amount).",".replace_numeric($saldo)."");
						//$this->db->insert('db_pettyclaim',$data);								
						 //redirect('pettycash');
						 die("sukses");
						 }
						 }
	
		}
		
		function edit(){
				    //extract(PopulateForm());
					
				
					
					$type 		= $this->input->post('type');
					$pettycash_id 		= $this->input->post('pettycash_id');
					$claim_no 	= $this->input->post('claim_no');
					$claim_date 		= $this->input->post('claim_date');
					$petty_desc 		= $this->input->post('petty_desc');
					$acc_no 	= $this->input->post('acc_no');
					$amount 	= $this->input->post('amount');
					$amount2 	= $this->input->post('amount2');
					$saldo 	= $this->input->post('saldo');
					
					if($acc_no == ''){
						die("Account hrus di isi");
					}
			
			
					// if(empty($acc_no)){
						// die("Kode Cashflow harus di isi");
					
					// }
				
			
		

					
					$data = array
					(
						//'pettycash_id'=>$pettycash_id,
						'Type'=>$type,
						'claim_no'=>$claim_no,
						'claim_date'=>indo_date($claim_date),
						'petty_desc'=>$petty_desc,
						'acc_no'=>$acc_no, 		
						'saldo'=>$amount		
						
					);
					
						$cek_opening = $this->db->select('count(status) as status')
							   ->where('status',1)
							   ->get('db_pettyclaim')->row();
					   $cek_status = $this->db->select('count(status) as status')
							   ->where('status',1)
							   ->get('db_pettyclaim')->row();
							   
						if  ($saldo == ""){
							$saldo=0;
							}
							
							
							   
						if($cek_status->status == 0 and $type==2 ){
						die("Data Opening Belum Ada");
						}else
						if($cek_opening->status == 1 and $type==1 ){
						die("Petty Cash Belum Closing");
						}else{
						$query = $this->db->query("sp_pettycash '".$type."','".$claim_no."','".inggris_date($claim_date)."','".$petty_desc."','".$acc_no."',".replace_numeric($amount).",".replace_numeric($amount2).",".replace_numeric($saldo)."");
						//$this->db->insert('db_pettyclaim',$data);								
						 //redirect('pettycash');
						 die("sukses");
						 }
	
			}
			
		function close($id){		
		
			#die($id);
				extract(PopulateForm());
		
				
		
				$cek_close = $this->db->select('status as id')
								   ->where('pettycash_id',$id)
								   ->get('db_pettyclaim')->row();
								   
				#var_dump($cek_close);exit();

				if($cek_close->id == 2 ){
				echo"
					<script type='text/javascript'>
						alert('Sudah di Closing');
						refreshTable();
					</script>
				";
				}else{
				
						$cek_id = $this->db->select('pettycash_id as id')
								   ->where('type',1)
								   ->where('status',1)
								   ->get('db_pettyclaim')->row();
								   
								   
				
						$petty_id= $cek_id->id;
				
						$query = $this->db->query("sp_closingpettycash ".$petty_id."");
		

						$q=$this->db->query("Update db_pettyclaim  set status=2, status_reimburse = 1  WHERE status='1' and type='1'");
						
						$q=$this->db->query("Update db_pettyclaim  set  status_reimburse = 1 WHERE status_reimburse='0' ");

							 echo"
														<script type='text/javascript'>
																	alert('Closing Petty Cash Sukses');
																	window.close();
																	 refreshTable();
														</script>
											 ";        
				}									 
        

		}       
		
		function update($id){
				$cek_close = $this->db->where('pettycash_id <', $id)->where_not_in('status',array(0,2))
									->get('db_pettyclaim')->num_rows();
									
				
								   
					if($cek_close == 0 ){
						echo"
							<script type='text/javascript'>
								alert('Maaf, Data yang sudah di Closing Tidak Boleh Di Edit');
								refreshTable();
							</script>
						";
					}
				parent::update($id);
		}
			
		
		function print_slip($id){		

			$data_petty = $this->db->where('pettycash_id',$id)->where('status',2)->get('db_pettyclaim')->row();
			
			if(empty($data_petty)){
			
									echo"
														<script type='text/javascript'>
																	alert('Untuk mengeluarkan voucher, Pilih data opening yg sudah di closing ');
																	window.close();
																	 refreshTable();
														</script>
											 "; 
						
			}else{
			
				
				$data['pettycash']  =	$this->db->select('acc_no, SUM(credit) AS credit, SUM(debet) AS debet')->where('sub_claim_no', $data_petty->claim_no)
												->where('Type ',2)
												->group_by('acc_no')
												->get('db_pettyclaim')
												->result();
												
				$data['pettycash_row']  =	$this->db->select('acc_no, SUM(credit) AS credit, SUM(debet) AS debet, sub_claim_no')->where('sub_claim_no', $data_petty->claim_no)
												->where('Type ',2)
												->group_by('acc_no, sub_claim_no')
												->get('db_pettyclaim')
												->row();
				/**
				$data['pettycash']  =	$this->db->where('sub_claim_no', $data_petty->claim_no)
												->where('Type ',2)
												->order_by('claim_no', 'ASC')
												->get('db_pettyclaim')
												->result();
				**/

			}
			
			$this->load->view('cb/print/print_vocherpc',$data);
		}
		
		function print_slip_transaksi($id){		

			$data_petty = $this->db->where('pettycash_id',$id)->where('status',2)->get('db_pettyclaim')->row();
			
			if(empty($data_petty)){
			
									echo"
														<script type='text/javascript'>
																	alert('Untuk mengeluarkan voucher, Pilih data opening yg sudah di closing ');
																	window.close();
																	 refreshTable();
														</script>
											 "; 
						
			}else{
			
				
				$data['pettycash']  =	$this->db->where('sub_claim_no', $data_petty->claim_no)
												->where('Type ',2)
												->order_by('claim_no', 'ASC')
												->get('db_pettyclaim')
												->result();
												
				$data['pettycash_row']  =	$this->db->where('sub_claim_no', $data_petty->claim_no)
												->where('Type ',2)
												->order_by('claim_no', 'ASC')
												->get('db_pettyclaim')
												->row();
				

			}
			
			$this->load->view('cb/print/print_transpc',$data);
		}
	
	}
?>
