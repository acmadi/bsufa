<?php
	class trxtype extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('trxtype_model');
			$this->set_page_title('List Of Employee');
			$this->default_limit = 30;
			$this->template_dir = 'cb/trxtype';
		}
		
		protected function setup_form($data=false){
                        
                        $this->parameters['coa'] = $this->db->select('acc_no,acc_name')
                                                                                                            ->order_by('acc_no','ASC')
                                                                                                            ->get('db_coa')
                                                                                                            ->result();                       
            }	
		
		function index(){
			#die("test");
			$this->set_grid_column('trxtype_id','ID',array('hidden'=>true));
			$this->set_grid_column('trx_type','Trx Type',array('width'=>200));
			$this->set_grid_column('descs','Description',array('width'=>200));
			$this->set_grid_column('trx_mode','Mode',array('width'=>160));			
			$this->set_jqgrid_options(array('width'=>1000,'height'=>400,'caption'=>'Transaction Type','rownumbers'=>true));
			parent::index();		
		}		
						
		function cekdata(){			
				$data = array();
				$this->db->select('*')->from('db_trxtype')
				->order_by('trxtype_id', 'desc');
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

		 $data = array();
				$this->db->select('*')->from('db_coa')
				->order_by('acc_no', 'desc');
				$Q = $this-> db-> get();
				if ($Q-> num_rows() > 0){
				foreach ($Q-> result_array() as $row){
				$data[] = $row;
				}
				}
				$Q-> free_result();
				echo json_encode($data);
		}
		
		function save(){
					$bankname = $this->input->post('bank_nm');
			
					$trxtype_id = $_REQUEST['trxtype_id'];
					$trxtype = $_REQUEST['trx_type'];
					$descs = $_REQUEST['descs'];
					$trxmode = $_REQUEST['trx_mode'];
					// $session_id = $this->UserLogin->isLogin();
		
					// $pt = $session_id['id_pt'];
	
					// $user = $session_id['id'];
				
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
