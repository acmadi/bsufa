<?php
	class pettycash extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('pettycash_model');
			$this->set_page_title('Petty Cash');
			$this->default_limit = 30;
			$this->template_dir = 'cb/pettycash';
		}	
		
		protected function setup_form($data=false){
																										
																											
			$no = 1;
			$proj = 44;														   
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
			$this->set_grid_column('claim_date','Date',array('width'=>200,'formatter' => 'cellColumn'));
			$this->set_grid_column('acc_no','Cash Out',array('width'=>160,'formatter' => 'cellColumn'));
			$this->set_grid_column('petty_desc','Description',array('width'=>160,'formatter' => 'cellColumn'));
			$this->set_grid_column('debet','Debet',array('width'=>100,'formatter' => 'cellColumn'));
			$this->set_grid_column('credit','Credit',array('width'=>100,'formatter' => 'cellColumn'));
			$this->set_grid_column('saldo','Saldo',array('width'=>100,'formatter' => 'cellColumn'));
			$this->set_jqgrid_options(array('width'=>1000,'height'=>400,'caption'=>'Petty Cash','rownumbers'=>true));
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
			                          $sql = "select kodecash,nama
                                                            from cashflow
                                                            where left(kodecash,1) in ('B','D')";
                                                            
                                    $data = $this->db->query($sql)->result();                    

				echo json_encode($data);

		}
		function getsaldo($id){
		
		//die($id);
			extract(PopulateForm());
		
		    $sql = $this->db->query("sp_viewsaldopettycash '".$id."'")->row();
							    
		    
		    die(json_encode($sql));

				
		}

		
		
				
				
			
			function input(){
				    //extract(PopulateForm());
					
			$type 		= $this->input->post('type');
			$pettycash_id 		= $this->input->post('pettycash_id');
			$claim_no 	= $this->input->post('claim_no');
			$claim_date 		= $this->input->post('claim_date');
			$petty_desc 		= $this->input->post('petty_desc');
			$acc_no 	= $this->input->post('acc_no');
			$amount 	= $this->input->post('amount');
			$saldo 	= $this->input->post('saldo');
			
			
				
				
			
		

					
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
						$query = $this->db->query("sp_pettycash '".$type."','".$claim_no."','".inggris_date($claim_date)."','".$petty_desc."','".$acc_no."',".replace_numeric($amount).",".replace_numeric($saldo)."");
						//$this->db->insert('db_pettyclaim',$data);								
						 //redirect('pettycash');
						 die("sukses");
						 }
	
			}
			
			function close(){		
	
			extract(PopulateForm());
	
			$cek_close = $this->db->select('type as id')
							   ->where('type',1)
							   ->where('status',1)
							   ->get('db_pettyclaim')->row();
							   
			if($cek_close->id == NULL ){
			echo"
				<script type='text/javascript'>
					alert('Blm Ada Opening Balance !!');
					refreshTable();
				</script>
			";
		}else{

                $q=$this->db->query("Update db_pettyclaim  set status=2 WHERE status='1' and type='1'");

					 echo"
                                                <script type='text/javascript'>
                                                            alert('Closing Petty Cash Sukses');
                                                            window.close();
															 refreshTable();
                                                </script>
                                     ";        
			}									 
                        }      
			
			
			
			
	
	}
?>
