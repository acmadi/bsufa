<?php
	class deduct extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('deduct_model');
			$this->set_page_title('Deduction Contract');
			$this->default_limit = 30;
			$this->template_dir = 'project/deduct';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->pt = $session_id['id_pt'];
		}
		
		protected function setup_form($data=false){
			$this->parameters['tender'] = $this->db->select('id_tendeva,no_tendeva')
													   ->where('isnull(id_flag,0)','1')
													   ->get('db_tendeva')->result();

			#$this->parameters['pph'] = $this->db->select('pph')->get('db_tax')->result();
			//var_dump($this->parameters['pph']);exit;

			$this->parameters['kontrak'] = $this->db->select('id_kontrak,no_spk,no_kontrak,pph')
													->where('id_kontrak',@$data->id_kontrak)
													->get('db_kontrak')->row();
													
			$this->parameters['tender'] = $this->db->select('id_detailjob,detail_job,qty,unit,price,total_price')
												   ->where('id_kontrak',@$data->id_kontrak)
												   ->get('db_detailjob')->result();
												   
			$this->parameters['prevalue'] = $this->db->select('sum(claim_amount) as nilai')
												   ->where('id_kontrak',@$data->id_kontrak)
												   ->get('db_cjc')->row();
												   
			$kontrak = @$data->id_kontrak;
			$this->parameters['progress'] = $this->db->query("sp_prevprog ".$kontrak."")->row();
												   
			#$this->parameters['prop'] = $this->db->select('sum(isnull(pph,0)) as prop_pph,
			#										sum(isnull(ppn,0)) as prop_ppn,
			#										sum(isnull(paynet,0)) as paynet,
			#										sum(isnull(claim_amount,0)) as prop_amount')
			#										 ->where('id_payspk',@$data->id_kontrak)
			#										 ->where('pemby_id',2)
			#										 ->get('db_cjc')->row();
			
			
			#$this->parameters['dp'] = $this->db->select('isnull(sum(claim_amount),0) as paiddp')
			#										 ->where('id_payspk',@$data->id_kontrak)
			#										 ->where('pemby_id',1)
			#										 ->get('db_cjc')->row();
			
			#$this->parameters['nildp'] = $this->db->select('dp')
			#										 ->where('id_kontrak',@$data->id_kontrak)
			#										 #->where('pemby_id',1)
			#										 ->get('db_kontrak')->row();
													
			$no = 1;
			$proj = 14101;										
			$this->parameters['cjc_no'] = $this->db->query("sp_cekcjcno ".$no.",".$proj."")->row();
			$this->parameters['payspk'] = $this->db->select('*')
												   ->where('nospk',@$data->no_spk)
												   ->order_by('id_payspk','asc')
												   ->get('db_payspk')->result();
												
		}	
		
		
		function get_json(){
			$this->set_custom_function('contract_amount','currency');
			$this->set_custom_function('adendum','currency');
			$this->set_custom_function('deduction','currency');
			$this->set_custom_function('prev','currency');
			$this->set_custom_function('start_date','indo_date');
			$this->set_custom_function('end_date','indo_date');
			parent::get_json();
		}						
		
		function index(){
			$this->set_grid_column('id_kontrak','id',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('lunas','lunas',array('hidden'=>true,'width'=>60,'formatter' => 'cellColumn'));
			$this->set_grid_column('no_spk','Reff SPK',array('hidden'=>true,'width'=>60,'formatter' => 'cellColumn'));
			//~ $this->set_grid_column('start_date','Start Date',array('width'=>15,'formatter' => 'cellColumn','align'=>'center'));
			$this->set_grid_column('no_kontrak','Contract.No',array('width'=>35,'formatter' => 'cellColumn'));
			//$this->set_grid_column('nm_subproject','Mainjob',array('width'=>30));
			#$this->set_grid_column('nm_supplier','Contractor',array('width'=>25,'formatter' => 'cellColumn'));
			$this->set_grid_column('mainjob_desc','Mainjob',array('width'=>80,'formatter' => 'cellColumn'));
			
			//~ $this->set_grid_column('end_date','End Date',array('hidden'=>true,'width'=>30,'formatter' => 'cellColumn'));
			$this->set_grid_column('prev','Previous',array('width'=>20,'align'=>'right','formatter' => 'cellColumn'));
			$this->set_grid_column('deduction','Deduct',array('width'=>20,'align'=>'right','formatter' => 'cellColumn'));
			$this->set_grid_column('contract_amount','Current',array('width'=>20,'align'=>'right','formatter' => 'cellColumn'));
			
			//$this->set_grid_column('adendum','Addendum',array('width'=>30,'formatter' => 'cellColumn'));
			//$this->set_grid_column('deduction','Deduction',array('width'=>30,'formatter' => 'cellColumn'));
			$this->set_grid_column('flag_deduct','Flag',array('width'=>50,'hidden'=>true,'formatter' => 'cellColumn'));				
			$this->set_jqgrid_options(array('width'=>1200,'height'=>350,'caption'=>'Deduction Contract','rownumbers'=>true));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
			
		}		
		
		function dropdown(){
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->pt = $session_id['id_pt'];
		
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				switch($data_type){
					case 'project':
						$sql = $this->db->select('subproject_id id,nm_subproject nama')
										->where('id_pt',$this->pt)
										->get('db_subproject')
										->result();
						break;
					case 'addbgt':
						$sql = $this->db->select('kode_bgtproj id,nm_bgtproj nama')
									  ->where('id_subproject',$parent_id)
									  ->group_by('nm_bgtproj')
									  ->group_by('kode_bgtproj')
									  ->get('db_bgtproj_update')->result();
						
		
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
		
		
		
		
		function kurang($id){
			#die($id);
			$row = $this->db->select('isnull(id_lunas,0) as id')->where('id_kontrak',$id)->get('db_kontrak')->row();
			
			if($row->id == 1 ){
				echo"
				<script type='text/javascript'>
					alert('Proses Deduct tidak bisa dilanjutkan, Kontrak Full Claim');
					refreshTable();
				</script>
			";
			
		}else{
			$data['sql'] = $this->db->query("SP_Deduct '".$id."'")->row();
			$data['query'] = $this->db->select('nm_bgtproj,kode_bgtproj')
									  ->group_by('nm_bgtproj')
									  ->group_by('kode_bgtproj')
									  ->get('db_bgtproj_update')->result();
			$this->load->view('project/deduct-input',$data);
			}
		}
		
		function approved_cek($id){
		//die($id);
			$row = $this->db->select('isnull(id_lunas,0) as id')->where('id_kontrak',$id)->get('db_kontrak')->row();
			$cek = $this->db->select('count(deduct_amt )as deduct')->where('id_contract',$id)->get('db_deduction')->row();
			
			if($row->id == 1 ){
				echo"
				<script type='text/javascript'>
					alert('Proses Deduct tidak bisa dilanjutkan, Kontrak Full Claim');
					refreshTable();
				</script>
			";
			
		}else if($cek->deduct == 0){

		echo"
				<script type='text/javascript'>
					alert('Lakukan Deduction terlebih dahulu');
					refreshTable();
				</script>
			";

		}else{
			$data['sql'] = $this->db->query("SP_Deductapproved '".$id."'")->row();
			$data['query'] = $this->db->select('nm_bgtproj,kode_bgtproj')
									  ->group_by('nm_bgtproj')
									  ->group_by('kode_bgtproj')
									  ->get('db_bgtproj_update')->result();
			$this->load->view('project/deduct-form',$data);
			}
		}
		
		function kurangkontrak(){
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->pt = $session_id['id_pt'];
			$pt = $this->pt;
			$user = $this->user;
			extract(PopulateForm());
			
			// $this->db->query("SP_DeductProcess '".$idkon."','".replace_numeric($claim)."','".replace_numeric($totdeduct)."','".$noiom."','".$reason."',
			// '".$addbgt."','".$project."','".$pt."'");
			$this->db->query("SP_InsertDeduct '".$idkon."','".replace_numeric($totkon)."','".replace_numeric($totdeduct)."','".$noiom."','".$reason."',
			'".$pt."','".$pt."','".$pt."','".$nokon."','".$job."',".replace_numeric($totkon).",'".$user."'");
			
			die("sukses");
		}
		
		function kurangkontrakapproved(){
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->pt = $session_id['id_pt'];
			$pt = $this->pt;
			$user = $this->user;
			extract(PopulateForm());
			
			$this->db->query("SP_DeductProcess '".$idkon."','".replace_numeric($totkon)."','".replace_numeric($totdeduct)."','".$noiom."','".$reason."',
			'".$pt."','".$pt."','".$pt."'");

			
			die("sukses");
		}
		
	
	}

