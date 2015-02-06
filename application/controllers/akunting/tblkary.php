<?php
	class tblkary extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('tblkary_model');
			$this->set_page_title('List Of Employee');
			$this->default_limit = 10;
			#$this->template_dir = 'bsuportal/mis/budget';
		}
		
		/*protected function setup_form($data=false){
			$this->load->model('tblkary_model1','divisi');
			$this->parameters['divisi'] = $this->divisi->get();
		}*/
		
		
		function index(){
			#die("test");
			$this->set_grid_column('no_urut','ID',array('hidden'=>true));
			$this->set_grid_column('id_kary','NIP',array('width'=>100));
			$this->set_grid_column('nama','Nama',array('width'=>200));
			$this->set_grid_column('divisi_nm','Divisi',array('width'=>200));
			$this->set_grid_column('karyjab_nm','Jabatan',array('width'=>200));
			$this->set_grid_column('karylvl_nm','Level',array('width'=>150));
			$this->set_grid_column('tgl_join','Tgl. Join',array('width'=>100));
			$this->set_grid_column('pndd_nm','Strata',array('width'=>75));
			$this->set_grid_column('karystat_nm','Status',array('width'=>100));
			//$this->set_grid_column('agama_nm','Agama',array('width'=>100,'align'=>'center'));
			$this->set_grid_column('hp2','HP',array('width'=>150));
			//$this->set_grid_column('pnddjur_nm','Major',array('width'=>150));
			$this->set_jqgrid_options(array('width'=>1100,'height'=>200,'caption'=>'List Of Employee','rownumbers'=>true));
			parent::index();
		}
		
		function insert_cuti(){
			$session_id = $this->UserLogin->isLogin();
			$divisi_id = $session_id['divisi_id'];
			$user_id = $session_id['id'];
			$class = $session_id['class'];
			$pt = $session_id['id_pt'];
			$level = $session_id['level_id'];
			$flow = '1';
			$modul = '1';
			
			
			
			
			extract(PopulateForm());	
							$data = array
							 (							
									'tgl_aju'=>	$tgl_aju,
									'jns_cuti'=> $jns_cuti,
									'karycutials_id'=>$cuti_kat,
									'kary_id'=>$nip,
									'aju_cuti'=>$aju_cuti,
									'startdate_cuti'=>$tgl_mulai, 
									'enddate_cuti'=>$tgl_akhir,
									'tgl_msk'=>$tgl_msk,
									'pic_delegasi'=>$delegasi,
									'ket_cuti'=>$ket, 
									'jns_cuti'=>$jns_cuti,
									
									
									'id_pt'=>$pt,
									'user_id'=>$user_id,
									'divisi_id'=>$divisi_id,
									'level_id'=>$level,
									'flow_id'=>$flow,
									'modul_id'=>$modul
									
							 );
					
					$this->db->insert('db_karycuti',$data);
					 
					
		}			
	
	}
?>
