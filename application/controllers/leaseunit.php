<?php
class leaseunit extends DBController{
	function __construct(){
		parent::__construct('leaseunit_model');
		$this->set_page_title('List Leasing Unit');
		$this->template_dir = 'leasing/leaseunit';
		$this->default_limit = 17;
		$session_id = $this->UserLogin->isLogin();
		$this->user_account = $session_id['username'];
	}

	protected function setup_form($data=false){
			//~ $this->load->model('tenant_model','customer');
			//~ $id = @$data->customer_id;
			//~ $this->parameters['cust'] = $this->customer->joinall($id);
			//~ $this->parameters['kota'] = $this->db->order_by('kota_nm','asc')->get('db_kota')->result();
			//~ $this->parameters['agama'] = $this->db->get('db_agama')->result();
			//~ $this->parameters['profesi'] = $this->db->order_by('profesi_nm','asc')->get('db_profesi')->result();
			//~ $this->parameters['tipemedia'] = $this->db->order_by('tipemedia_nm','asc')->get('db_tipemedia')->result();
			//~ $this->parameters['media'] = $this->db->order_by('media_nm','asc')->get('db_media')->result();
			//~ $this->parameters['motivie'] = $this->db->order_by('motivie_nm','asc')->get('db_motivie')->result();
			//~ $this->parameters['etnis'] = $this->db->order_by('etnis_nm','asc')->get('db_etnis')->result();
			//~ $this->parameters['negara'] = $this->db->order_by('negara_nm','asc')->get('db_negara')->result();
			//~ $this->parameters['propinsi'] = $this->db->order_by('propinsi_nm','asc')->get('db_propinsi')->result();
			//~ #var_dump($this->parameters['negara']);
			//~ $this->parameters['add'] = $this->customer->additional($id);
			//~ #var_dump($this->parameters['add']);
			//~ $this->parameters['bisnis'] = $this->db->order_by('bisnis_nm','asc')->get('db_bisnis')->result();
			//~ $this->parameters['hubungan'] = $this->db->order_by('hubungan_nm','asc')->get('db_hubungan')->result();
			//~ $this->parameters['individu'] = $this->db->where('id_filter','2')->order_by('nm_group','asc')->get('db_group')->result();
			//~ $this->parameters['corporate'] = $this->db->where('id_filter','1')->order_by('nm_group','asc')->get('db_group')->result();
	}
	
	
	function index(){
		$this->set_grid_column('id','ID',array('hidden'=>true));
		$this->set_grid_column('nounit','No Unit',array('width'=>50,'align'=>'left','formatter' => 'cellColumn'));
		
		$this->set_grid_column('luas','Area(M2)',array('width'=>30,'formatter' => 'cellColumn'));
		$this->set_grid_column('harga_meter','Price/M2',array('width'=>30,'formatter' => 'cellColumn'));
		$this->set_grid_column('unitstatus_nm','Status',array('width'=>80,'formatter' => 'cellColumn'));
		$this->set_grid_column('lantai','Level',array('width'=>50,'align'=>'left','formatter' => 'cellColumn'));
		$this->set_grid_column('nm_subproject','Project',array('width'=>50,'align'=>'left','formatter' => 'cellColumn'));
		//~ $this->set_grid_column('nm_project','Nm.Project',array('width'=>90));
		//~ $this->set_grid_column('unit_no','Unit',array('width'=>25));
		//~ $this->set_grid_column('customer_tlp2','HP',array('width'=>20));
		$this->set_jqgrid_options(array('width'=>1100,'height'=>350,'caption'=>'List Unit Leasing','rownumbers'=>true,'sortname'=>'nounit','sortorder'=>'desc'));
		parent::index();
	}
	
	function InsertUnitSewa(){
			extract(PopulateForm());
			$session_id = $this->UserLogin->isLogin();
			$idpt = $session_id['id_pt'];
			$iduser =  $session_id['id'];
			
			if($luasunit > $ablearea ){
			die("Luas unit tidak mencukupi");
			}else{
			$query = $this->db->query("SP_InputUnitTenant '".$nounit."','".$proj."','".$sub."','".$floor."','".$arah."','".$luasunit."',
			'".replace_numeric($harga_meter)."','".$status."','".$iduser."'");
			
			$sukses = 4;
			die(json_encode($sukses));
		}
			
			//~ $tgl=inggris_date($customertgllhr);
			
			
	}
	
	function EditUnitSewa(){
			extract(PopulateForm());
			$session_id = $this->UserLogin->isLogin();
			$idpt = $session_id['id_pt'];
			$iduser =  $session_id['id'];
			
			// if($luasunit > $ablearea ){
			// die("Luas unit tidak mencukupi");
			// }else{
			$query = $this->db->query("SP_EditUnitTenant ".$idunit.",'".replace_numeric($luasunit)."','".replace_numeric($harga_meter)."','".$iduser."'");
			
			$sukses = 4;
			die(json_encode($sukses));
		//}
			
			//~ $tgl=inggris_date($customertgllhr);
			
			
	}
	
	function UpdateCustomer(){
			//~ extract(PopulateForm());
			//~ $session_id = $this->UserLogin->isLogin();
			//~ $idpt = $session_id['id_pt'];
			//~ $iduser =  $session_id['id'];
			//~ $idflag ='1';
			//~ $idproject='1111';
			//~ $tgl=inggris_date($customertgllhr);
			//~ 
			//~ die($idkarysek);
			//~ 
			//~ $query = $this->db->query("UpdateCustomer '".$idfilter."','".$idgroup."','".$customernama."','".$tgl."',
			//~ '".$customertmptlhr."','".$idagama."','".$idkarysek."','".$customerstatus."','".$idprofesi."','".$customerhp."',
			//~ '".$customertlp."','".$customerfax."','".$idtipe."','".$idno."','".$email."','".$npwp."','".$idtipemedia."','".$idmedia."',
			//~ '".$idmotivie."','".$customeralamat1."','".$idnegara."','".$idpropinsi."','".$idkota."','".$kdpos."','".$customeralamat2."','".$idnegara1."','".$idpropinsi1."','".$idkota1."','".$kdpos1."','".$iduser."','".$idpt."','".$idflag."',
			//~ '".$idetnis."','".$fb."','".$twiter."','".$custcompnm."','".$idbisnis."','".$custcompalamat."','".$custcomphp."',
			//~ '".$custcompfax."','".$custcompnpwp."','".$id."'");
			//~ 
		//~ 
			//~ $sukses = 4;
			//~ die(json_encode($sukses));
	}
	
			function tampil($id){
			
				$query = "select b.id_luas, tot_luas_sewa, isnull(sum(luas),0) as luas, (tot_luas_sewa-isnull(sum(luas),0)) as sisa_luas from db_unit_sewa a
							right outer join db_luas_sewa b on a.id_luas=b.id_luas
							where b.id_luas='".$id."'
							group by b.id_luas,tot_luas_sewa";
				$data = $this->db->query($query)->row_array();		
			
				// $data = $this->db->where('id_luas',$id)
							// ->get('db_luas_sewa')->row_array();
			
				echo json_encode($data);
		
				}
	
	
	
	
	
			function loaddata(){
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
					
					$session_id = $this->UserLogin->isLogin();
					$idpt = $session_id['id_pt'];
					$iduser =  $session_id['id'];
					
				switch($data_type){
					case 'proj':
						$sql = $this->db->select('subproject_id id,nm_subproject nama')
										->where('id_pt',$idpt)
										->where('pt_id',12)
										->get('db_subproject')
										->result();
						break;
					case 'sub':
						$sql = $this->db->select('id_luas id,sub_project nama')
										->where('kd_project',$parent_id)
										->get('db_luas_sewa')
										->result();
						break;
						
					case 'floor':
						$sql = $this->db->select('floor_nm id,floor_nm nama')
										#->where('kd_project',$parent_id)
										->get('db_floor')
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
	
}

