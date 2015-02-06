<?php
	class deposit extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('deposit_model');
			$this->set_page_title('Deposit');
			$this->default_limit = 30;
			$this->template_dir = 'leasing/deposit';
		}	
		
		protected function setup_form($data=false){
																										
																											
			$no = 1;
			$proj = 44;														   
			$sql = $this->db->query("sp_cekpcno ".$no.",".$proj."")->row();
			//var_dump($sql);
			$this->parameters['nopc'] = $sql->no_pc;	
																											
            }	
			
		
		function get_json(){
		$this->set_custom_function('date','indo_date');
		$this->set_custom_function('base_amt','currency');

		parent::get_json();
	}
		
		
		function index(){
			#die("test");
			$this->set_grid_column('deposit_id','ID',array('hidden'=>true));
			$this->set_grid_column('no_deposit','Deposit No',array('width'=>100,'formatter' => 'cellColumn'));
			$this->set_grid_column('date','Date',array('width'=>100,'formatter' => 'cellColumn'));
			$this->set_grid_column('kd_tenant','Tenant',array('width'=>160,'formatter' => 'cellColumn'));
			$this->set_grid_column('description','Description',array('width'=>200,'formatter' => 'cellColumn'));
			$this->set_grid_column('base_amt','Amount',array('width'=>100,'formatter' => 'cellColumn'));
			// $this->set_grid_column('credit','Credit',array('width'=>100,'formatter' => 'cellColumn'));
			// $this->set_grid_column('saldo','Saldo',array('width'=>100,'formatter' => 'cellColumn'));
			$this->set_jqgrid_options(array('width'=>1000,'height'=>400,'caption'=>'Deposit Entry','rownumbers'=>true));
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
		
		function loaddata(){
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
					
					$session_id = $this->UserLogin->isLogin();
					$idpt = $session_id['id_pt'];
					$iduser =  $session_id['id'];
					
				switch($data_type){
					case 'subproject':
						$sql = $this->db->select('id_project id,nm_subproject nama')
										->where('pt_id',12)
										->get('db_subproject')
										->result();
						
						
						// $row = "SELECT a.id as id,no_loo as nama FROM db_loo_sewa a
								// JOIN db_unit_sewa b on a.nounit = b.id
								// JOIN db_subproject c on b.kd_project = c.id_project
								// WHERE c.id_pt =".$idpt." and a.status=0 and c.pt_id=12";
						// $sql = $this->db->query($row)->result();		

						break;
						
						
					//~ case 'sub':
						//~ $sql = $this->db->select('id_luas id,sub nama')
										//~ ->where('kd_project',$parent_id)
										//~ ->get('db_luas_sewa')
										//~ ->result();
						//~ break;
						
					case 'kd_tenant':
							$sql = $this->db->select('customer_id id,(customer_nama) nama')
										->where('category','rental')
										->get('db_customer')
										->result();
						break;
					case 'tax':
							$sql = $this->db->select('id_tax id,tax_cd nama')
										->where('id_pt',11)
										->get('db_tax')
										->result();
						break;
					
					
				
				}
				$response = array();
				if($sql){
					foreach($sql as $row){
						$response[] = $row;
					}
				}
				die(json_encode($response));
			}
		}

		
		
				
				
			
			function input(){
				    extract(PopulateForm());
					
			$no_deposit 		= $this->input->post('no_deposit');
			$subproject 		= $this->input->post('subproject');
			$date 	            = $this->input->post('date');
			$kd_tenant 		= $this->input->post('kd_tenant');
			$base_amt 		= $this->input->post('base_amt');
			$description 	    = $this->input->post('description');
	
			
			
				
				
			
		

					
					$data = array
					(
						'no_deposit'=>$no_deposit,
						'id_subproject'=>$subproject,
						'date'=>indo_date($date),
						'kd_tenant'=>$kd_tenant,
						'base_amt'=>$base_amt, 		
						'description'=>$description		
						
					);
					
					
							
							
							   
					
						$query = $this->db->query("sp_insertdeposit '".$no_deposit."',".$subproject.",'".inggris_date($date)."','".$kd_tenant."',".replace_numeric($base_amt).",'".$description."'");
			
						 die("sukses");
			
	
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
