<?php
	class tenderevalapp extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('tendereval_model');
			$this->set_page_title('Approval Tender Project Budget');
			$this->default_limit = 30;
			$this->template_dir = 'project/tenderevalapp';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->divisi = $session_id['divisi_id'];
			$this->pt = $session_id['id_pt'];
			$this->id = $session_id['id'];
			$this->parent = $session_id['id_parent'];
		}
		
		protected function setup_form($data=false){
			$this->parameters['detailjob'] = $this->db->select('detail_job,qty,unit,price,total_price')
													  ->where('id_tendeva',$data->id_tendeva)
													  ->get('db_detailjob')->result();
			
			
		}
		
		
		function index(){
			$this->set_grid_column('id_tendeva','',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('no_trbgtproj','Budget Reff',array('width'=>60,'formatter' => 'cellColumn'));
			$this->set_grid_column('no_tendeva','Tendereval Reff',array('width'=>60,'formatter' => 'cellColumn'));
			$this->set_grid_column('job','Job',array('width'=>40,'formatter' => 'cellColumn'));
			$this->set_grid_column('nilai_tender','Tender Amount',array('width'=>30,'formatter' => 'cellColumn'));
			$this->set_grid_column('vendor_nm','Tender Winner',array('width'=>30,'formatter' => 'cellColumn'));
			$this->set_grid_column('id_flag','Flag',array('width'=>50,'hidden'=>true,'formatter' => 'cellColumn'));	
			$this->set_jqgrid_options(array('width'=>1000,'height'=>200,'caption'=>'Update Project','rownumbers'=>true));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}	
		
		
		function save(){
			extract(PopulateForm());
			if($app == "Approve"){
				$data = array 
				(
					'flag_id' => 1
				);
				$this->db->where('id_tendeva',$idtender);
				$this->db->update('db_tendeva',$data);		
			}else{
				$data = array 
				(
					'flag_id' => 3
				);
				$this->db->where('id_tendeva',$idtender);
				$this->db->update('db_tendeva',$data);
				
			}
			die("sukses");
		}
			
	}

