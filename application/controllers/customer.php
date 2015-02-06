<?php
class customer extends DBController{
	function __construct(){
		parent::__construct('customer_model');
		$this->set_page_title('List Customer');
		$this->template_dir = 'marketing/customer';
		$this->default_limit = 30;
		$session_id = $this->UserLogin->isLogin();
		$this->user_account = $session_id['username'];
	}

	protected function setup_form($data=false){
			$this->load->model('customer_model','customer');
			$id = @$data->customer_id;
			$this->parameters['cust'] = $this->customer->joinall($id);
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
	
	
	function index(){
		$this->set_grid_column('customer_id','ID',array('hidden'=>true));
		$this->set_grid_column('customer_nama','Name',array('width'=>80,'align'=>'left','formatter' => 'cellColumn'));
		$this->set_grid_column('customer_alamat1','Alamat',array('width'=>80,'formatter' => 'cellColumn'));
		$this->set_grid_column('nm_project','Nm.Project',array('width'=>90));
		$this->set_grid_column('unit_no','Unit',array('width'=>25));
		$this->set_grid_column('customer_tlp2','HP',array('width'=>20));
		$this->set_jqgrid_options(array('width'=>880,'height'=>600,'caption'=>'List Customer','rownumbers'=>true,'sortname'=>'customer_id','sortorder'=>'desc'));
		parent::index();
	}
	
	function InsertCustomer(){
			extract(PopulateForm());
			$session_id = $this->UserLogin->isLogin();
			$idpt = $session_id['id_pt'];
			$iduser =  $session_id['id'];
			$idflag ='1';
			$idproject='1111';
			
			#$idpt =2;
			#$iduser = 1;
			$tgl=inggris_date($customertgllhr);
			
			
			$query = $this->db->query("InputCustomer ".$idfilter.",".$idgroup.",'".$customernama."','".$tgl."',
			".$customertmptlhr.",".$idagama.",".$idkarysek.",'".$customerstatus."',".$idprofesi.",'".$customerhp."',
			'".$customertlp."','".$customerfax."','".$idtipe."',".$idno.",'".$email."','".$npwp."',".$idtipemedia.",'".$idmedia."',
			".$idmotivie.",'".$customeralamat1."',".$idnegara.",".$idpropinsi.",".$idkota.",".$kdpos.",'".$customeralamat2."',
			".$idnegara1.",".$idpropinsi1.",".$idkota1.",".$kdpos1.",".$iduser.",".$idpt.",".$idflag.",
			".$idetnis.",'".$fb."','".$twiter."','".$custcompnm."',".$idbisnis.",'".$custcompalamat."','".$custcomphp."',
			'".$custcompfax."',".$custcompnpwp."");
			
		
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
			$idkarysek='1';
			$tgl=inggris_date($customertgllhr);
			
			//die($idkarysek);
			
			$query = $this->db->query("UpdateCustomer '".$idfilter."','".$idgroup."','".$customernama."','".$tgl."',
			'".$customertmptlhr."','".$idagama."','".$idkarysek."','".$customerstatus."','".$idprofesi."','".$customerhp."',
			'".$customertlp."','".$customerfax."','".$idtipe."','".$idno."','".$email."','".$npwp."','".$idtipemedia."','".$idmedia."',
			'".$idmotivie."','".$customeralamat1."','".$idnegara."','".$idpropinsi."','".$idkota."','".$kdpos."','".$customeralamat2."','".$idnegara1."','".$idpropinsi1."','".$idkota1."','".$kdpos1."','".$iduser."','".$idpt."','".$idflag."',
			'".$idetnis."','".$fb."','".$twiter."','".$custcompnm."','".$idbisnis."','".$custcompalamat."','".$custcomphp."',
			'".$custcompfax."','".$custcompnpwp."','".$id."'");
			
		
			$sukses = 4;
			die(json_encode($sukses));
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
					case 'agama':
						$sql = $this->db->select('agama_id id,agama_nm nama')
										->get('db_agama')
										->result();
						break;
					
					case 'motivie':
						$sql = $this->db->select('motivie_id id,motivie_nm nama')
										->order_by('motivie_nm','asc')
										->get('db_motivie')
										->result();
						break;
					case 'negara':
						$sql = $this->db->select('negara_id id,negara_nm nama')
										->get('db_negara')
										->result();
						break;
					case 'propinsi':
						$sql = $this->db->select('propinsi_id id,propinsi_nm nama')
										->where('id_negara',$parent_id)
										->order_by('propinsi_nm','asc')
										->get('db_propinsi')
										->result();
						break;
					case 'kota':
						$sql = $this->db->select('kota_id id,kota_nm nama')
										->where('id_propinsi',$parent_id)
										->order_by('kota_nm','asc')
										->get('db_kota')
										->result();
						break;
						
					case 'profesi':
						$sql = $this->db->select('profesi_id id,profesi_nm nama')
										->order_by('profesi_nm','asc')
										->get('db_profesi')
										->result();
						break;
					case 'tmplhr':
						$sql = $this->db->select('kota_id id,kota_nm nama')
										->order_by('kota_nm','asc')
										->get('db_kota')
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
					case 'bisnis':
						$sql = $this->db->select('bisnis_id id,bisnis_nm nama')
										->order_by('bisnis_nm','asc')
										->get('db_bisnis')
										->result();
						break;
					case 'hubungan':
						$sql = $this->db->select('hubungan_id id,hubungan_nm nama')
										->order_by('hubungan_nm','asc')
										->get('db_hubungan')
										->result();
						break;
					case 'etnis':
						$sql = $this->db->select('etnis_id id,etnis_nm nama')
										->order_by('etnis_nm','asc')
										->get('db_etnis')
										->result();
						break;
					case 'negara1':
						$sql = $this->db->select('negara_id id,negara_nm nama')
										->get('db_negara')
										->result();
						break;
					case 'propinsi1':
						$sql = $this->db->select('propinsi_id id,propinsi_nm nama')
										->where('id_negara',$parent_id)
										->order_by('propinsi_nm','asc')
										->get('db_propinsi')
										->result();
						break;
					case 'kota1':
						$sql = $this->db->select('kota_id id,kota_nm nama')
										->where('id_propinsi',$parent_id)
										->order_by('kota_nm','asc')
										->get('db_kota')
										->result();
						break;
					case 'individu':
						$sql = $this->db->select('group_id id,nm_group nama')
										->where('id_filter','2')
										->order_by('nm_group','asc')
										->get('db_group')
										->result();
						break;
					case 'corporate':
						$sql = $this->db->select('group_id id,nm_group nama')
										->where('id_filter','1')
										->order_by('nm_group','asc')
										->get('db_group')
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

