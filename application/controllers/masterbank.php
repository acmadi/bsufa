<?php
	class masterbank extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('masterbank_model');
			$this->set_page_title('List Of Employee');
			$this->default_limit = 30;
			$this->template_dir = 'cb/masterbank';
		}	
		
		
		function index(){
			#die("test");
			$this->set_grid_column('bank_id','ID',array('hidden'=>true));
			$this->set_grid_column('bank_nm','Bank Name',array('width'=>200));
			$this->set_grid_column('bank_cabang','Bank Branch',array('width'=>200));
			$this->set_grid_column('bank_acc','Account',array('width'=>160));
			$this->set_grid_column('bank_coa','Acc No',array('width'=>130));
			$this->set_grid_column('remark','Remark',array('width'=>100));
			//$this->set_grid_column('tgl_join','Tgl. Join',array('width'=>100));
			//$this->set_grid_column('pndd_nm','Strata',array('width'=>50));
			//$this->set_grid_column('karystat_nm','Status',array('width'=>100));
			//$this->set_grid_column('agama_nm','Agama',array('width'=>100,'align'=>'center'));
			//$this->set_grid_column('hp2','HP',array('width'=>150));
			//$this->set_grid_column('pnddjur_nm','Major',array('width'=>150));
			$this->set_jqgrid_options(array('width'=>1000,'height'=>400,'caption'=>'Bank Master','rownumbers'=>true));
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

		
		
				
				
			
			function input(){
				    //extract(PopulateForm());
					
			$bank_id 		= $this->input->post('bank_id');
			$karysek 	= $this->input->post('bank_nm');
			$pt 		= $this->input->post('bank_cabang');
			$divisi 		= $this->input->post('bank_acc');
			$nama 	= $this->input->post('bank_coa');
			$agama 	= $this->input->post('remark');
					$session_id = $this->UserLogin->isLogin();
					//$divisi = $session_id['divisi_id'];
					//$class = $session_id['class'];
					$pt = $session_id['id_pt'];
					//$level = $session_id['level_id'];
					$user = $session_id['id'];
					
					$data = array
					(
						//'bank_id'=>$nip,
						'bank_nm'=>$karysek,
						'bank_cabang'=>$pt,
						'bank_acc'=>$divisi,
						'bank_coa'=>$nama, 		
						'remark'=>$agama		
						
					);
					
					// $this->db->insert('db_bank',$data);
					// echo"Input Data berhasil";
			
					              
					if($bank_id){
						$this->db->where('bank_id',$bank_id);
						$this->db->update('db_bank',$data);
						// $this->db->where('kary_id',$nip);
						// $this->db->update('db_karyklrg',$data2);
						//echo"Data berhasil terupdate";
					}else{	
						$this->db->insert('db_bank',$data);								
						//echo"Data berhasil tersimpan2";
						redirect('masterbank');
					}
					
			}
			
			
			
			
	
	}
?>
