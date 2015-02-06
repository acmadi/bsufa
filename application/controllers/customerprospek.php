<?php
class customerprospek extends DBController{
	function __construct(){
		parent::__construct('customerprospek_model');
		$this->set_page_title('Prospective Customer');
		$this->template_dir = 'marketing/customerprospek';
		$this->default_limit = 30;
		$session_id = $this->UserLogin->isLogin();
		$this->user_account = $session_id['username'];
	}

	protected function setup_form($data=false){
			$this->load->model('customerprospek_model','customer');
			$id = @$data->customer_id;
			$this->parameters['cust'] = $this->customer->joinall($id);
			$this->parameters['followup'] = $this->customer->followup($id);
			$this->parameters['sales'] = $this->customer->sales();
			$this->parameters['mod'] = $this->customer->mod($id);
			$this->parameters['kota'] = $this->db->order_by('kota_nm','asc')->get('db_kota')->result();
			$this->parameters['agama'] = $this->db->get('db_agama')->result();
			$this->parameters['profesi'] = $this->db->order_by('profesi_nm','asc')->get('db_profesi')->result();
			$this->parameters['tipemedia'] = $this->db->order_by('tipemedia_nm','asc')->get('db_tipemedia')->result();
			$this->parameters['media'] = $this->db->order_by('media_nm','asc')->get('db_media')->result();
			$this->parameters['motivie'] = $this->db->order_by('motivie_nm','asc')->get('db_motivie')->result();
			$this->parameters['etnis'] = $this->db->order_by('etnis_nm','asc')->get('db_etnis')->result();
			$this->parameters['negara'] = $this->db->order_by('negara_nm','asc')->get('db_negara')->result();
			$this->parameters['propinsi'] = $this->db->order_by('propinsi_nm','asc')->get('db_propinsi')->result();
			#var_dump($this->parameters['negara']);
			$this->parameters['add'] = $this->customer->additional($id);
			#var_dump($this->parameters['add']);
			$this->parameters['bisnis'] = $this->db->order_by('bisnis_nm','asc')->get('db_bisnis')->result();
			$this->parameters['hubungan'] = $this->db->order_by('hubungan_nm','asc')->get('db_hubungan')->result();
			$this->parameters['individu'] = $this->db->where('id_filter','2')->order_by('nm_group','asc')->get('db_group')->result();
			$this->parameters['corporate'] = $this->db->where('id_filter','1')->order_by('nm_group','asc')->get('db_group')->result();
	}
	
	function get_json(){
		
		$this->set_custom_function('regdate','indo_date');
		
		parent::get_json();
		
		}
	
	
	function index(){
		$this->set_grid_column('customer_id','ID',array('hidden'=>true));
		$this->set_grid_column('regdate','Apply date',array('width'=>80,'formatter' => 'cellColumn'));
		$this->set_grid_column('venue','Venue',array('width'=>80,'formatter' => 'cellColumn'));
		$this->set_grid_column('customer_nama','Name',array('width'=>80,'align'=>'left','formatter' => 'cellColumn'));
		$this->set_grid_column('customer_hp','Handphone',array('width'=>80,'formatter' => 'cellColumn'));
		$this->set_grid_column('nm_subproject','Interest Product',array('width'=>80,'formatter' => 'cellColumn'));
		$this->set_grid_column('fu_stat','status',array('width'=>50,'hidden'=>true,'formatter' => 'cellColumn'));
		$this->set_grid_column('nama','Sales',array('width'=>80,'formatter' => 'cellColumn'));
		//$this->set_grid_column('unit_no','Unit',array('width'=>25));
		//$this->set_grid_column('customer_tlp2','HP',array('width'=>20));
		$this->set_jqgrid_options(array('width'=>980,'height'=>300,'caption'=>'Prospective Customer','rownumbers'=>true,'sortname'=>'customer_id','sortorder'=>'desc'));
		parent::index();
	}
	
	function InsertProspekCustomer(){
			extract(PopulateForm());
			$session_id = $this->UserLogin->isLogin();
			$idpt = $session_id['id_pt'];
			$iduser =  $session_id['id'];
			$idattr =  $session_id['id_attr'];
			$idflag ='2';
			$idproject='1111';
			
			$fustat = 0;
			#$iduser = 1;
			$tgl=inggris_date($regdate);
			
			
			$query = $this->db->query("InputProspekCustomer '".$idfilter."','".$idgroup."','".$idtipemedia."','".$idmedia."',
			'".$customerhp."','".$email."','".$customernama."','".$iduser."','".$idpt."','".$idflag."','".$sales."','".$tgl."',
			'".$mod."','".$project."','".$shift."','".$top."','".$venue."','".$fustat."','".$idattr."'");
		
			$sukses = 4;
			die(json_encode($sukses));
	}
	
	function UpdateCustomer(){
			extract(PopulateForm());
			$session_id = $this->UserLogin->isLogin();
			$idpt = $session_id['id_pt'];
			$iduser =  $session_id['id'];
			$idflag ='1';
			$idproject='1111';
			$tgl=inggris_date($customertgllhr);
			
			
			$query = $this->db->query("UpdateCustomer ".$idfilter.",".$idgroup.",'".$customernama."','".$tgl."',
			".$customertmptlhr.",".$idagama.",".$idkarysek.",'".$customerstatus."',".$idprofesi.",'".$customerhp."',
			'".$customertlp."','".$customerfax."','".$idtipe."',".$idno.",'".$email."','".$npwp."',".$idtipemedia.",".$idmedia.",
			".$idmotivie.",'".$customeralamat1."',".$idnegara.",".$idpropinsi.",".$idkota.",".$kdpos.",'".$customeralamat2."',			".$idnegara1.",".$idpropinsi1.",".$idkota1.",".$kdpos1.",".$iduser.",".$idpt.",".$idflag.",
			".$idetnis.",'".$fb."','".$twiter."','".$custcompnm."',".$idbisnis.",'".$custcompalamat."','".$custcomphp."',
			'".$custcompfax."',".$custcompnpwp.",".$id."");
			
		
			$sukses = 4;
			die(json_encode($sukses));
	}
	
	
	function InputProspekFollowup(){
			extract(PopulateForm());
			$session_id = $this->UserLogin->isLogin();
			$idpt = $session_id['id_pt'];
			$iduser =  $session_id['id'];
			$idflag ='1';
			$idproject='1111';
			
			
			
			$query = $this->db->query("InputProspekFollowup'".$customer."','".$prospekstatus."',
			'".$fudate."','".$note."','".$nextfudate."','".$fuby."'");
			
				
		
			$sukses = 4;
			die(json_encode($sukses));
	}
	
	function cekhp(){
			$field = $this->input->get('fieldId');
			$value = $this->input->get('fieldValue');
			$save = $this->db->where('customer_hp',$value)
							->where('id_flag','2')
						 ->get('db_customer')->num_rows();
			$call = $save > 0;
			$result = array($field,!$call);
			echo json_encode($result);
		}
	
	function cekprospek(){
			$field = $this->input->get('fieldId');
			$value = $this->input->get('fieldValue');
			$save = $this->db->where('customer_nama',$value)
							->where('id_flag','2')
						 ->get('db_customer')->num_rows();
			$call = $save > 0;
			$result = array($field,!$call);
			echo json_encode($result);
		}				
	
	
	
			function loaddata(){
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				
				
				switch($data_type){
					case 'group':
						$sql = $this->db->select('group_id id,nm_group nama')
										->where('id_filter','1')
										->get('db_group')
										->result();
						break;
					
					case 'tipeindividu':
						$sql = $this->db->select('group_id id,nm_group nama')
										->where('id_filter','2')
										->order_by('nm_group','asc')
										->get('db_group')
										->result();
						break;
					case 'tipemedia':
						$sql = $this->db->select('tipemedia_id id,tipemedia_nm nama')
										->order_by('tipemedia_nm','asc')
										->get('db_tipemedia')
										->result();
						break;
					case 'media':
						$sql = $this->db->select('media_id id,media_nm nama')
										->where('id_tipemedia',$parent_id)
										->order_by('media_nm','asc')
										->get('db_media')
										->result();
						break;
					
					case 'individu':
						$sql = $this->db->select('group_id id,nm_group nama')
										->where('id_filter','2')
										->order_by('nm_group','asc')
										->get('db_group')
										->result();
						break;
					case 'project':
						$sql = $this->db->select('subproject_id id,nm_subproject nama')
										->order_by('nm_subproject','asc')
										->get('db_subproject')
										->result();
						break;
					case 'corporate':
						$sql = $this->db->select('group_id id,nm_group nama')
										->where('id_filter','1')
										->order_by('nm_group','asc')
										->get('db_group')
										->result();
						break;
					#case 'sales':
					#	$sql = $this->db->select('id_kary id,nama nama')
					#					->where('attr_id',$idattr)
					#					->order_by('nama','asc')
					#					->get('db_kary')
					#					->result();
					#	break;
					case 'mod':
						$sql = $this->db->select('id_kary id,nama nama')
										->where('id_divisi','12')
										->where('id_karylvl','4')
										->order_by('nama','asc')
										->get('db_kary')
										->result();
							
						break;
						
					case 'fuby':
						$sql = $this->db->select('fumedia_id id,fumedia_nm nama')
										->order_by('nama','asc')
										->get('db_fumedia')
										->result();
							
						break;
					case 'prospekstatus':
						$sql = $this->db->select('prospectstat_id id,prospectstat_nm nama')
										->order_by('nama','asc')
										->get('db_prospectstat')
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

