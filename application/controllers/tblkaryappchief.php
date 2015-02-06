<?php
Class tblkaryappchief extends DBController{
	function __construct(){
		parent::__construct('tblkaryappchief_model');
		$this->set_page_title('Approval Karyawan');
		$this->default_limit = 10;
		$this->template_dir = 'hrd/tblkaryappchief';
	}	

	protected function setup_form($data=false){
			$this->load->model('tblkaryapp_model','cutikary');
			$session_id = $this->UserLogin->isLogin();
			$divisi = $session_id['divisi_id'];
			$id = @$data->no_link;
			//var_dump($id);exit;
			$this->parameters['karycuti'] = $this->cutikary->namadiv($divisi);
			$this->parameters['joinall'] = $this->cutikary->joinall_table($id);
			$this->parameters['flowapp'] = $this->cutikary->flowapp();
			$this->parameters['view'] = $this->cutikary->viewkary($id);
			// $this->parameters['view'] = $this->db->join('db_karycutijns','jns_cuti = karycutijns_id')
												// ->join('db_kary','db_kary.id_kary = db_karycuti.kary_id')
												// ->join('db_karycutipar','karyawan_id = id_kary')
												// ->join('db_divisi','db_divisi.divisi_id = db_kary.id_divisi')
												// ->join('db_karyjab','karyjab_id = id_karyjab')
												// ->where('modul_id',$id)
												// ->get('db_karycuti ')->row();
			
			
	}
	
	
	function index(){
		$this->set_grid_column('id_transaksi','ID',array('hidden'=>true));
		$this->set_grid_column('modul_nm','Sumber Modul',array('width'=>5));
		$this->set_grid_column('nama','Nama Pemohon',array('width'=>5));
		$this->set_grid_column('tgl_aju','Tgl. Permohonan',array('width'=>5));
		
		$this->set_jqgrid_options(array('width'=>1200,'height'=>350,'caption'=>'Persetujuan Permohonan','rownumbers'=>true));
		parent::index();

	}	

	function data($id){
		$data = $this->db->join('db_divisi','divisi_id = id_divisi')
					    ->join('db_karyjab','karyjab_id = id_karyjab')
						->join('db_karycutipar','pt_id = id_pt')
						->where('id_kary',$id)
						->get('db_kary')
						->row_array();					
		echo json_encode($data);
		}	
		
		
   function hitung($id){
	   $dt = $this->db->select('sum(aju_cuti) as jml')
					  ->where('kary_id',$id)
					  ->get('db_karycuti')
					  ->row_array();
	   if($dt['jml']==NULL)
		$jml = 0;
	   else
	    $jml = $dt['jml'];
	   
	   $data = array
	   (
			'jml' => $jml
	   );
	   
	   echo json_encode($data);
   }
   
	function approve(){
		extract(PopulateForm());
		if($this->input->post('ajuan')=="setuju"){
			$session_id = $this->UserLogin->isLogin();
			$level = $session_id['level_id'];
			
			
				$data = array
				(
					'id_approval' => 10,
					'catatan' => $cat
				);
			
					
			$data2 = array
			(
				'flowapp_id' => 10
			);		
		
			$this->db->where('no_link',$no_link);
			$this->db->update('db_approval',$data);
			$this->db->where('transaksi_id',$no_link);
			$this->db->update('db_karycuti',$data2);
		
		}
		
		else {
			
			
				$data = array
				(
					'id_approval' => 7,
					'catatan' => $cat
				);
			
				$data2 = array
				(
				'flowapp_id' => 7
				);		
		
			$this->db->where('no_link',$no_link);
			$this->db->update('db_approval',$data);
			$this->db->where('transaksi_id',$no_link);
			$this->db->update('db_karycuti',$data2);
			
			
		}
		die('Sukses');
		#redirect('tblkaryappchief');
	}
	
	function catatan(){
		$this->load->view('tblkaryapp-popup');
	}
	
}
