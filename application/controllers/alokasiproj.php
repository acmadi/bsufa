<?php
	class alokasiproj extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('alokasiproj_model');
			$this->set_page_title('Alokasi Per Project');
			$this->default_limit = 30;
			$this->template_dir = 'project/alokasiproj';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->id_pt = $session_id['id_pt'];
			
		}
		
		protected function setup_form($data=false){
			$this->parameters['proj'] = $this->db->where('id_pt', $this->id_pt)->get('db_subproject')->result();
			
		}
		
		function index(){
			$this->set_grid_column('id_alokasiproj','id',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('nm_subproject','Project Name',array('width'=>80));
			$this->set_grid_column('alokasi','% Alokasi',array('width'=>30,'align'=>'center'));
			$this->set_grid_column('remark','Remark',array('width'=>100));
			
			$this->set_jqgrid_options(array('width'=>1200,'height'=>400,'caption'=>'Alokasi per Project','rownumbers'=>true,'sortname'=>'id_alokasiproj','sortorder'=>'desc'));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}	
			
		function save(){
			extract(PopulateForm());
			$fl = 1;
			
			$data = array 
			(
				'project_id' => $project,
				'alokasi' => $alokasi,
				'remark' => $rem,
				'tgl_input' => inggris_date($date),
				'id_flag' => $fl
			);
			
			$this->db->insert('db_alokasiproj',$data);
			
			
			die("sukses");
		}
			
		function del($id){
			$a = 10;
			$data = array (
				'id_flag' => $a 
				);
				
			$this->db->where('id_alokasiproj', $id);
			$this->db->update('db_alokasiproj',$data);
			echo"
				<script type='text/javascript'>
					alert('Delete Alokasi Sukses');
					refreshTable();
				</script>
			";
		}
		
		function ubah($id){
			$data['proj'] = $this->db->where('id_pt', $this->id_pt)->get('db_subproject')->result();
			//die($id);
		$data['isi'] = $this->db->where('id_alokasiproj',$id)->get('db_alokasiproj')->row();	
		
		$this->load->view('project/alokasiproj-form',$data);
		}
			
		function ubah_alokasi(){
		extract(PopulateForm());
		$data = array (
			'project_id' => $project,
			'alokasi' => $alokasi,
			'remark' => $rem,
			'tgl_input' => inggris_date($date),
			'id_flag' => 2
		
		);
		
		$this->db->where('id_alokasiproj',$idup);
		$this->db->update('db_alokasiproj',$data);
		die('Update Data Sukses');
		
		}
				
	
	}

