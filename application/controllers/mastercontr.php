<?php
	class mastercontr extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('mastercontr_model');
			$this->set_page_title('Master Contract');
			$this->default_limit = 30;
			$this->template_dir = 'project/mastercontr';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
		}
		
		protected function setup_form($data=false){
			#var_dump(@$data->vendor_id);exit;
			$this->parameters['view_dt'] = $this->db->select('vendor_nm,vendor_address,vendor_hp,vendor_tlp,vendor_npwp,vendor_akta,
			vendor_cont_name,vendor_fax,vendor_email,vendor_web,propinsi_nm,kota_nm,negara_nm,mstcontrtype_nm,mstcontrcat_nm')
													->where('vendor_id',@$data->vendor_id)
													->join('db_mstcontrtype','id_mstcontrtype = mstcontrtype_id')
													->join('db_mstcontrcat','id_mstcontrcat = mstcontrcat_id')
													->join('db_negara','id_negara = negara_id')
													->join('db_propinsi','id_propinsi = propinsi_id')
													->join('db_kota','id_kota = kota_id')
													->get('db_vendor')->row();
			$this->parameters['contrtype'] = $this->db->get('db_mstcontrtype')->result();
			$this->parameters['contrcat'] = $this->db->get('db_mstcontrcat')->result();
		}
		
		function index(){
			$this->set_grid_column('vendor_id','',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('vendor_nm','Contractor',array('width'=>60));
			$this->set_grid_column('mstcontrtype_nm','Type',array('width'=>40));
			$this->set_grid_column('vendor_cont_name','Contact',array('width'=>30));
			$this->set_grid_column('vendor_hp','Phone',array('width'=>30));
			$this->set_grid_column('vendor_email','E-Mail',array('width'=>30));
			$this->set_grid_column('vendor_fax','Fax',array('width'=>30));
			$this->set_grid_column('vendor_address','Address',array('width'=>30));
			$this->set_jqgrid_options(array('width'=>1000,'height'=>200,'caption'=>'Master Contract','rownumbers'=>true));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}		

		function loaddata(){
			#die($this->input->post('parent_id'));
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				
				switch($data_type){
					case 'negara':
						$sql = $this->db->select('negara_id id,negara_nm nama')
										->get('db_negara')
										->result();
						break;
					case 'propinsi':
						//die("propinsi");
						$sql = $this->db->select('propinsi_id id,propinsi_nm nama')
										->where('id_negara',$parent_id)
										->order_by('propinsi_nm','asc')
										->get('db_propinsi')
										->result();
										
										
										
						break;
					case 'kota':
						//die("kota");
						$sql = $this->db->select('kota_id id,kota_nm nama')
										->where('id_propinsi',$parent_id)
										->order_by('kota_nm','asc')
										->get('db_kota')
										->result();
						break;					
					}
				$response = array();
				if($sql){
					foreach($sql as $row){
						$response[] = $row;
					}
				}else{
					$response['error'] = 'Data kosong';
				}
				die(json_encode($response));exit;
			}
		}	
		

		function save(){
			extract(PopulateForm());
			$data = array
			(
				'vendor_nm' => $contrnm,
				'vendor_address' => $address,
				'vendor_hp' => $hp,
				'vendor_tlp' => $tlp,
				'vendor_npwp' => $npwp,
				'vendor_akta' => $akta,
				'vendor_cont_name' => $contact,
				'vendor_fax' => $fax,
				'vendor_email' => $email,
				'vendor_web' => $web,
				'id_mstcontrtype' => $contrtype,
				'id_mstcontrcat' => $contrcat,
				'id_negara' => $negara,
				'id_propinsi' => $propinsi,
				'id_kota' => $kota	
			);
		
		if($save){
			$this->db->insert('db_vendor',$data);
			die("sukses");
		}	
	
	}
}
