<?php
Class tblkaryappdiv extends DBController{
	function __construct(){
		parent::__construct('tblkaryappdiv_model');
		$this->set_page_title('Approval Karyawan');
		$this->default_limit = 10;
		$this->template_dir = 'hrd/tblkaryappdiv';
		$this->load->library('email');
	}	

	protected function setup_form($data=false){
			$this->load->model('tblkaryapp_model','cutikary');
			$session_id = $this->UserLogin->isLogin();
			$divisi = $session_id['divisi_id'];
			$id = @$data->no_link;
			$this->parameters['karycuti'] = $this->cutikary->namadiv($divisi);
			$this->parameters['joinall'] = $this->cutikary->joinall_table($id);
			$this->parameters['flowapp'] = $this->cutikary->flowapp();
			$this->parameters['view'] = $this->cutikary->viewkary($id);
			//var_dump($data);exit;
			
	}
	
	
	function index(){
		$this->set_grid_column('id_transaksi','ID',array('hidden'=>true));
		$this->set_grid_column('modul_nm','Sumber Modul',array('width'=>5));
		$this->set_grid_column('nama','Nama Pemohon',array('width'=>5));
		$this->set_grid_column('tgl_aju','Tgl. Permohonan',array('width'=>5));
		$this->set_jqgrid_options(array('width'=>900,'height'=>200,'caption'=>'Persetujuan Permohonan','rownumbers'=>true));
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
		
		if ($id_approve > 3){
			$id_approve = 10;
			$mail = "mis@bsu.co.id";
			$nama = "Di tolak";
		}else{ 
			$id_approve = 1;
			#Approval Division Head
			
			$row = $this->db->where('id_chief',$chief_id)
							->get('user_admin')->row();
						
			$id_bod = $row->kary_id;
			$rowbod = $this->db->where('id_kary',$id_bod)
						       ->get('db_kary')->row();
		    $mail = @$rowbod->email;//$rowbod->email;		
			$nama = $rowbod->nama;
				
			

		}
	
		
		if($this->input->post('ajuan')=="setuju"){
			$session_id = $this->UserLogin->isLogin();
			$level = $session_id['level_id'];

			//Pengiriman Email

			//var_dump($mail);exit;			
			#Pengajuan Bawahan
			$row2 = $this->db->where('id_kary',$id_kary)
							 ->get('db_kary')->row();
						
			//$message = $row2->nama." Need Your Approval, Please click this link http://mis.bsu.co.id";
$message = 
"Kepada Yth. bpk/ibu
".@$rowbod->nama." \n
Dengan hormat,
".@$row2->nama.", mengajukan permohonan cuti
mohon untuk di berikan komentar/persetujuan bapak/ibu dengan mengakses
http://mis.bsu.co.id \n
Demikian Informasi permohonan cuti ini
Terimakasih
MIS System Application";
			$this->email->from($this->email_form, $this->person_form);
			$this->email->to($mail);
			$this->email->subject('Permohonan persetujuan cuti');
			$this->email->message($message);	
			$this->email->send();
			//Akhir pengiriman Email
			
			$data = array
				(
					'id_approval' => $id_approve,
					'catatan' => $cat
				);
			
		
			$data2 = array
			(
				'flowapp_id' => $id_approve
			);		
		
			$this->db->where('no_link',$no_link);
			$this->db->update('db_approval',$data);
			$this->db->where('transaksi_id',$no_link);
			$this->db->update('db_karycuti',$data2);
		}
		
		else {
			
			
				$data = array
				(
					'id_approval' => 6,
					'catatan' => $cat
				);
			
				$data2 = array
				(
				'flowapp_id' => 6
				);		
		
			$this->db->where('no_link',$no_link);
			$this->db->update('db_approval',$data);
			$this->db->where('transaksi_id',$no_link);
			$this->db->update('db_karycuti',$data2);
			
			
		}
		
		
		die('Approval Sukses');
		//redirect('tblkaryappdiv');
	}
	
	function catatan(){
		$this->load->view('tblkaryapp-popup');
	}
	
}
