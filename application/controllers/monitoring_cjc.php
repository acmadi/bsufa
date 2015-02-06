<?php
	class monitoring_cjc extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('monitoring_cjc_model');
			$this->set_page_title('Monitoring Certified Job to Complish');
			$this->default_limit = 30;
			$this->template_dir = 'project/monitoring_cjc';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->pt = $session_id['id_pt'];
			$this->divisi = $session_id['divisi_id'];
		}
		
		protected function setup_form($data=false){
			$this->parameters['kontrak'] = $this->db->select('id_kontrak,no_spk,no_kontrak')
													->where('isnull(id_flag,0)',2)
													->get('db_kontrak')->result();
													
			$this->parameters['tender'] = $this->db->select('id_detailjob,detail_job,qty,unit,price,total_price')
												   ->where('id_kontrak',@$data->id_kontrak)
												   ->get('db_detailjob')->result();
												   
			$this->parameters['prop'] = $this->db->select('isnull(sum(proposed_progress),0) as prop_am,
													sum(isnull(proposed_amount,0)) as prop_amount,
													sum(isnull(balanced_dp,0))  as blc_dp')
													 ->where('id_kontrak',@$data->id_kontrak)
													 ->get('db_cjc')->row();
									   
		}

		function get_json(){
		$this->set_custom_function('date_cjc','indo_date');
			$this->set_custom_function('contract_amount','currency');
			$this->set_custom_function('claim_amount','currency');
			$this->set_custom_function('balanced_dp','currency');
			parent::get_json();		
		}		
		
		function index(){
			$this->set_grid_column('id_cjc','id',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('date_cjc','Date.',array('width'=>15,'formatter' => 'cellColumn','align'=>'center'));
			$this->set_grid_column('no_kontrak','Reff Contract.',array('hidden'=>true,'width'=>40,'formatter' => 'cellColumn'));
			$this->set_grid_column('no_cjc','CJC No.',array('width'=>40,'formatter' => 'cellColumn'));
		    $this->set_grid_column('mainjob_desc','Main Job',array('width'=>45,'formatter' => 'cellColumn'));
			$this->set_grid_column('claim_amount','Value',array('width'=>20,'align'=>'right','formatter' => 'cellColumn'));
			$this->set_grid_column('contract_amount','Contract',array('width'=>25,'align'=>'right','formatter' => 'cellColumn'));
			
			#$this->set_grid_column('balanced_dp','DP Paid',array('width'=>30,'align'=>'right','formatter' => 'cellColumn'));
			#$this->set_grid_column('flag_id','DP Paid',array('width'=>30,'hidden'=>true,'align'=>'right','formatter' => 'cellColumn'));
			$this->set_grid_column('flag_id','status',array('hidden'=>true,'width'=>30,'align'=>'right','formatter' => 'cellColumn'));
			$this->set_jqgrid_options(array('width'=>1200,'height'=>350,'caption'=>'Monitoring Certified Job to Complish','rownumbers'=>true,'sortname'=>'id_cjc','sortorder'=>'DESC'));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}		
		
		function getdata($id){
			$qdata = $this->db->select('a.contract_amount,a.dp_amount,a.pph_amount,a.nm_kontrak,b.job,a.progress_amount,d.nm_supplier')
							   ->join('db_tendeva b','a.id_tendeva = b.id_tendeva')
							   ->join('db_participant c','b.id_participant = c.participant_id')
							   ->join('pemasokmaster d','d.kd_supp_gb = c.id_vendor')
							   ->where('a.id_kontrak',$id)
							   ->get('db_kontrak a')->row();
			
			die(json_encode($qdata));exit;				   
							   
		}
		
		
	
	}




