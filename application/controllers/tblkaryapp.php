<?php
Class tblkaryapp extends DBController{
	function __construct(){
		parent::__construct('tblkaryapp_model');
		$this->set_page_title('Approval Karyawan');
		$this->default_limit = 10;
		$this->template_dir = 'hrd/tblkaryapp';
		$this->load->library('email');
		$session_id = $this->UserLogin->isLogin();
		$this->user_account = $session_id['username'];		
	}	

	protected function setup_form($data=false){
			$this->load->model('tblkaryapp_model','cutikary');
			$session_id = $this->UserLogin->isLogin();
			$divisi = $session_id['divisi_id'];
			$id = @$data->no_link;
			$idkary = $data->kary_id;
			$this->parameters['view'] = $this->cutikary->viewkary($id);
			$this->parameters['jmlcuti'] = $this->cutikary->jumlah_cuti($idkary);			
	}
	
	
	function index(){
		$this->set_grid_column('id_transaksi','ID',array('hidden'=>true));
		$this->set_grid_column('no_link','No Link',array('hidden'=>true));
		$this->set_grid_column('modul_nm','Sumber Modul',array('width'=>5));
		$this->set_grid_column('nama','Nama Pemohon',array('width'=>5));
		$this->set_grid_column('tgl_aju','Tgl. Permohonan',array('width'=>5));
		$this->set_jqgrid_options(array('width'=>900,'height'=>200,'caption'=>'Persetujuan Permohonan','rownumbers'=>true));
		if($this->user_account!="")parent::index();
		else redirect("user/login");
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

			//Pengiriman Email
			#Approval Division Head
			
			$row = $this->db->where('id_karylvl',2)
							->where('id_divisi',$divisi_id)
							->get('db_kary')->row();			
			#Pengajuan Bawahan
			$row2 = $this->db->where('id_kary',$id_kary)
						->get('db_kary')->row();
						
			//$message = $row2->nama." Need Your Approval, Please click this link http://mis.bsu.co.id";
$message = 
"Kepada Yth. bpk/ibu
".$row->nama." \n
Dengan hormat,
".$row2->nama.", mengajukan permohonan cuti
mohon untuk di berikan komentar/persetujuan bapak/ibu dengan mengakses
http://mis.bsu.co.id \n
Demikian Informasi permohonan cuti ini
Terimakasih
MIS System Application";

			$this->email->from($this->email_form, $this->person_form);
			$this->email->to($row->email);
			$this->email->subject('Permohonan persetujuan cuti');
			$this->email->message($message);	
			$this->email->send();
			//Akhir pengiriman Email
			//die("test");			
			
			$session_id = $this->UserLogin->isLogin();
			$level = $session_id['level_id'];
			
				$data = array
				(
					'id_approval' => 2,
					'catatan' => $cat
				);
			
				$data2 = array
				(
				'flowapp_id' => 2
				);		
				
			$this->db->where('no_link',$id_transaksi);
			$this->db->update('db_approval',$data);
			$this->db->where('transaksi_id',$id_transaksi);
			$this->db->update('db_karycuti',$data2);
		}
		else {
			
			
				$data = array
				(
					'id_approval' => 5,
					'catatan' => $cat
				);
			
				$data2 = array
				(
				'flowapp_id' => 5
				);		
		
			$this->db->where('id_transaksi',$id_transaksi);
			$this->db->update('db_approval',$data);
			$this->db->where('transaksi_id',$id_transaksi);
			$this->db->update('db_karycuti',$data2);
			
			
		}
		die('Approval Sukses');
		//redirect('tblkaryapp');
	}
	
	function catatan(){
		$this->load->view('tblkaryapp-popup');
	}
	
}
