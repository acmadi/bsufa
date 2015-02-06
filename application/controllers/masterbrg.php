<?php
	class masterbrg extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('masterbrg_model');
			$this->set_page_title('Master Barang');
			$this->default_limit = 30;
			$this->template_dir = 'procurement/masterbrg';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
		}
		
		protected function setup_form($data=false){
			$this->parameters['jnsbrg'] = $this->db->order_by('jnsbrg_id','ASC')
												   ->get('db_jnsbrg')->result();
			$this->parameters['satuan'] = $this->db->order_by('satuan','ASC')
												   ->get('satuan')->result();
			
			
			$id = 1;
			$sql = $this->db->query("sp_cek_brg_no ".$id."")->row();
			$this->parameters['no_brg'] = $sql->no_brg;
		}
		
		function index(){
			$this->set_grid_column('id_brg','ID',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('kd_brg','Kode',array('width'=>60));
			$this->set_grid_column('nm_brg','Nama Barang',array('width'=>40));
			$this->set_grid_column('','Fixed Asset',array('width'=>30));
			$this->set_grid_column('satuan','Satuan',array('width'=>30));
			$this->set_grid_column('jnsbrg_nama','Jenis',array('width'=>30));
			$this->set_grid_column('','User Input',array('width'=>30));
			$this->set_grid_column('','Tgl.Input',array('width'=>30));
			$this->set_jqgrid_options(array('width'=>1000,'height'=>200,'caption'=>'Master Barang','rownumbers'=>true));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}	
		
		
		function save(){
			extract(PopulateForm());
			$data = array 
			(
				'kd_brg' => $kode,
				'nm_brg' => $brg,
				'satuan' => $satuan,
				'kd_jenis' => $jnsbrg
				
			);
			
			$this->db->insert('barang',$data);
			redirect("masterbrg");
		}
			
		
	
	}

