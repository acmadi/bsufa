<?php
Class tblkarycuti extends DBController{
	function __construct(){
		parent::__construct('tblkarycuti_model');
		$this->set_page_title('Cuti Karyawan');
		$this->default_limit = 30;
		$this->template_dir = 'hrd/tblkarycuti';
		$this->load->library('email');
		$session_id = $this->UserLogin->isLogin();
		$this->user_account = $session_id['username'];
	}

	protected function setup_form($data=false){
			$session_id = $this->UserLogin->isLogin();
			$divisi = $session_id['divisi_id'];
			$idkary = $session_id['kary_id'];
			$level = $session_id['level_id'];
			$row = $this->db->where('id_kary',$idkary)
							->get('db_kary')->row();
			//var_dump($divisi);exit;
			$id = @$data->karycuti_id;
			if($level==11 && $divisi==1){
				$this->parameters['karycuti'] = $this->mstmodel->get_firstid('nama','db_kary');
				$this->parameters['karycuti1'] = $this->mstmodel->get_firstid('nama','db_kary');
			}elseif(@$row->id_karylvl==1){
				$this->parameters['karycuti1'] = $this->db->where('id_up',$idkary)														 
																				->get('db_kary')->result();
				
			}else{
				$this->parameters['karycuti'] = $this->db->where('id_divisi',$divisi)
														 ->where('id_karylvl !=',1)
														 ->where('id_karylvl !=',2)
														 ->where('id_karylvl !=',3)
														 ->order_by('nama','asc')
														 ->get('db_kary')->result();
											 
				$this->parameters['karycuti1'] = $this->db->where('id_divisi',$divisi)
														  ->get('db_kary')->result();
														
			
			
			}
			$this->parameters['view'] = $this->mstmodel->viewkary($id);
	}

	function get_json(){
				$this->set_custom_function('tgl_aju','indo_date');
		parent::get_json();
		}
		
	function index(){
		$this->set_grid_column('karycuti_id','ID',array('hidden'=>true));
		$this->set_grid_column('nama','Nama',array('width'=>175));
		$this->set_grid_column('divisi_nm','Divisi',array('width'=>150));
		$this->set_grid_column('tgl_aju','Tanggal',array('width'=>100,'align'=>'center'));
		$this->set_grid_column('aju_cuti','Jumlah Cuti',array('width'=>100,'align'=>'center'));
		$this->set_grid_column('karycutijns_nm','Jenis Cuti',array('width'=>100,'align'=>'center'));
		$this->set_grid_column('flowapp_nm','Status Approval',array('width'=>200));
		$this->set_jqgrid_options(array('width'=>900,'height'=>400,'caption'=>'Cuti Karyawan','rownumbers'=>true));
		if($this->user_account!="")parent::index();
		else redirect("user/login");
	}


		function loaddata(){
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				switch($data_type){
					case 'karycutials':
						$sql = $this->db->select('karycutials_id id,karycutials_nm nama')
										->where('id_karycutijns',$parent_id)
										->order_by('karycutials_nm','asc')
										->get('db_karycutials')
										->result();
						break;
					case 'karycutijns':
					default:
					    $sql = $this->db->select('karycutijns_id id,karycutijns_nm nama')
										->get('db_karycutijns')->result();
							
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

	function istimewa($id){
		$data = $this->db->where('karycutials_id',$id)
						->get('db_karycutials')
						->row_array();	
	echo json_encode($data);
	}
	
   function hitung($id){
	   $dt = $this->db->select('sum(aju_cuti) as jml')
					  ->where('kary_id',$id)
					  ->where('jns_cuti',1)
					  ->where('cek_id !=',1)
					  ->where('flowapp_id','10')
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
	
	
	function insert_cuti(){
		extract(PopulateForm());
		list($d1,$m1,$y1) = split("-",$request_date);
		list($d2,$m2,$y2) = split("-",$tgl_mulai);
		list($d3,$m3,$y3) = split("-",$tgl_akhir);
		list($d4,$m4,$y4) = split("-",$tgl_msk);
		
		$tgl1 = $y1."-".$m1."-".$d1;
		$tgl2 = $y2."-".$m2."-".$d2;
		$tgl3 = $y3."-".$m3."-".$d3;
		$tgl4 = $y4."-".$m4."-".$d4;
		
		//Pengecekan Tanggal Cuti
		$ajuan = (strtotime($tgl2) - strtotime($tgl1))/86400;
		$akhir = (strtotime($tgl3) - strtotime($tgl2))/86400;
		$masuk = (strtotime($tgl4) - strtotime($tgl3))/86400;

		
		if($ajuan <= 7){
			echo"Pengajuan cuti anda harus lebih dari 7 hari";
		}else if($akhir < 0){
			echo"Harap cek kembali tanggal akhir cuti anda";
		}else if($masuk<=0){
			echo"Harap cek kembali tanggal masuk cuti anda";
		}else if($hide_balanced < 0){
			echo"Saldo anda tidak cukup tolong cek lagi";
		}else{
			$dtapprove = $this->mstmodel->approv_id();
			$idapprove = $dtapprove['no_link'] + 1;		

			//Pengiriman Email
			#Approval Atasan
			$row = $this->db->where('id_kary',$id_up)
							->get('db_kary')->row();
							
			#Pengajuan Bawahan
			$row2 = $this->db->where('id_kary',$kary_id)
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


			if($lama_cuti > 0) $jmlcuti = $lama_cuti;
			else $jmlcuti = $aju_cuti;
			
			$dt_kary = $this->db->where('id_kary',$id_up)
								->get('db_kary')->row();
			$flowapp = $dt_kary->id_karylvl;
			//die($flowapp);
			$modul = 1;
			
			//Proses cuti istimewa tidak diambil
			if($cuti_kat=="")$cuti_kat = 12;
			else $cuti_kat = $cuti_kat;
			
			//Proses penyimpanan data
			
			#Data untuk tabel db_karycuti
			$data = array 
			(
				'tgl_aju' => inggris_date($request_date),
				'jns_cuti' => $jns_cuti,
				'id_karycutials' => $cuti_kat,
				'kary_id'=>$kary_id,
				'aju_cuti'=>$jmlcuti,
				'startdate_cuti'=> inggris_date($tgl_mulai),
				'enddate_cuti'=> inggris_date($tgl_akhir),
				'tgl_msk'=> inggris_date($tgl_msk),
				'pic_delegasi'=>$delegasi,
				'ket_cuti'=>$ket,
				'jns_cuti'=>$jns_cuti,
				'flowapp_id'=>$flowapp,
				'modul_id'=>$modul,
				'transaksi_id'=> $idapprove,
				'cek_id' => 0
			);
			
			//~ $data2 = array 
			//~ (
				//~ 'modul_id' => $modul,
				//~ 'tgl_aju' => $request_date,
				//~ 'kary_id' => $kary_id,
				//~ 'id_approval' => $flowapp,
				//~ 'no_link' => $idapprove
			//~ );
			//~ //echo"simpan disini";
			//~ $this->db->insert('db_karycuti',$data);
			//~ $this->db->insert('db_approval',$data2);
			//~ $sukses = 4;
			//~ die(json_encode($sukses));
			//~ //redirect('tblkarycuti');	
		//~ }
		//~ 
			$itung = $this->db->query("sp_hitungcuti '".inggris_date($tgl_mulai)."','".inggris_date($tgl_akhir)."'")->row();
		
	if ($aju_cuti < $itung->aju){
	die('Pengajuan Cuti lebih kecil dari Jumlah Cuti yang di ambil');		
			
		#var_dump($itung->intDateDiff);
		
	}elseif($aju_cuti > $itung->aju){
		die('Pengajuan Cuti lebih besar dari Jumlah Cuti yang di ambil');
	}else{
		$data2 = array 
		(
			'modul_id' => $modul,
			'tgl_aju' => $request_date,
			'kary_id' => $nip,
			'id_approval' => $flowapp,
			'no_link' => $idapprove
		);
		//echo"simpan disini";
		$this->db->insert('db_karycuti',$data);
		$this->db->insert('db_approval',$data2);
		$sukses = 4;
		die(json_encode($sukses));
		//redirect('tblkarycuti');
	  }
  }
	}

	function insert_cuti_admin(){
		extract(PopulateForm());
		list($d1,$m1,$y1) = split("-",$request_date);
		list($d2,$m2,$y2) = split("-",$tgl_mulai);
		list($d3,$m3,$y3) = split("-",$tgl_akhir);
		list($d4,$m4,$y4) = split("-",$tgl_msk);
		$tgl1 = $y1."-".$m1."-".$d1;
		$tgl2 = $y2."-".$m2."-".$d2;
		$tgl3 = $y3."-".$m3."-".$d3;
		$tgl4 = $y4."-".$m4."-".$d4;

		//Pengecekan Tanggal Cuti
		$ajuan = (strtotime($tgl2) - strtotime($tgl1))/86400;
		$akhir = (strtotime($tgl3) - strtotime($tgl2))/86400;
		$masuk = (strtotime($tgl4) - strtotime($tgl3))/86400;
		
		#Cek session
		$session_id = $this->UserLogin->isLogin();
		$divisi = $session_id['divisi_id'];

		if($ajuan <= 7 && $divisi!=1){
			echo"Pengajuan cuti anda harus lebih dari 7 hari";
		}else if($akhir < 0 && $divisi!=1){
			echo"Harap cek kembali tanggal akhir cuti anda";
		}else if($masuk<=0 && $divisi!=1){
			echo"Harap cek kembali tanggal masuk cuti anda";
		}else if($balanced < 0 && $divisi!=1){
			echo"Saldo anda tidak cukup tolong cek lagi";
		}else{
			
		//Pengiriman Email
		#Approval Atasan
		$row = $this->db->where('id_kary',$id_up)
						->get('db_kary')->row();
						
		#Pengajuan Bawahan
		$row2 = $this->db->where('id_kary',$nip)
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

		//Pengecekan Tanggal Cuti
		$ajuan = (strtotime($tgl2) - strtotime($tgl1))/86400;
		$akhir = (strtotime($tgl3) - strtotime($tgl2))/86400;
		$masuk = (strtotime($tgl4) - strtotime($tgl3))/86400;
			
		$dtapprove = $this->mstmodel->approv_id();
		$idapprove = $dtapprove['no_link'] + 1;	
		//var_dump($aju_cuti);exit;
		if($lama_cuti > 0) $jmlcuti = $lama_cuti;
		else $jmlcuti = $aju_cuti;
			
		$dt_kary = $this->db->where('id_kary',$id_up)
							->get('db_kary')->row();
		$flowapp = $dt_kary->id_karylvl;
		$modul = 1;
		
		//die($kary_id);
			
		//Proses cuti istimewa tidak diambil
		if($cuti_kat=="")$cuti_kat = 12;
		else $cuti_kat = $cuti_kat;
		//Proses penyimpanan data
		#Data untuk tabel db_karycuti
		$data = array 
		(
			//~ 'tgl_aju' => $request_date,
			//~ 'jns_cuti' => $jns_cuti,
			//~ 'id_karycutials' => $cuti_kat,
			//~ 'kary_id'=>$nip,
			//~ 'aju_cuti'=>$jmlcuti,
			//~ 'startdate_cuti'=>$tgl_mulai,
			//~ 'enddate_cuti'=>$tgl_akhir,
			//~ 'tgl_msk'=>$tgl_msk,
			//~ 'pic_delegasi'=>$delegasi,
			//~ 'ket_cuti'=>$ket,
			//~ 'jns_cuti'=>$jns_cuti,
			//~ 'flowapp_id'=>$flowapp,
			//~ 'modul_id' =>$modul,
			//~ 'transaksi_id' => $idapprove,
			//~ 'cek_id' => 0
			'tgl_aju' => inggris_date($request_date),
				'jns_cuti' => $jns_cuti,
				'id_karycutials' => $cuti_kat,
				'kary_id'=>$nip,
				'aju_cuti'=>$jmlcuti,
				'startdate_cuti'=> inggris_date($tgl_mulai),
				'enddate_cuti'=> inggris_date($tgl_akhir),
				'tgl_msk'=> inggris_date($tgl_msk),
				'pic_delegasi'=>$delegasi,
				'ket_cuti'=>$ket,
				'jns_cuti'=>$jns_cuti,
				'flowapp_id'=>$flowapp,
				'modul_id'=>$modul,
				'transaksi_id'=> $idapprove,
				'cek_id' => 0
		);
		
		$itung = $this->db->query("sp_hitungcuti '".inggris_date($tgl_mulai)."','".inggris_date($tgl_akhir)."'")->row();
		
	if ($aju_cuti < $itung->aju){
	die('Pengajuan Cuti lebih kecil dari Jumlah Cuti yang di ambil');		
			
		#var_dump($itung->intDateDiff);
		
	}elseif($aju_cuti > $itung->aju){
		die('Pengajuan Cuti lebih besar dari Jumlah Cuti yang di ambil');
	}else{
		$data2 = array 
		(
			'modul_id' => $modul,
			'tgl_aju' => $request_date,
			'kary_id' => $nip,
			'id_approval' => $flowapp,
			'no_link' => $idapprove
		);
		//echo"simpan disini";
		$this->db->insert('db_karycuti',$data);
		$this->db->insert('db_approval',$data2);
		$sukses = 4;
		die(json_encode($sukses));
		//redirect('tblkarycuti');
	  }
  }
	}

 function cek_tanggal($tgl1,$tgl2,$tgl3,$tgl4)	{
	  list($d1,$m1,$y1) = split("-",$tgl1);
	  list($d2,$m2,$y2) = split("-",$tgl2);
	  list($d3,$m3,$y3) = split("-",$tgl3);
	  list($d4,$m4,$y4) = split("-",$tgl4);
	  $tgl1 = $y1."-".$m1."-".$d1;
	  $tgl2 = $y2."-".$m2."-".$d2;
	  $tgl3 = $y3."-".$m3."-".$d3;
	  $tgl4 = $y4."-".$m4."-".$d4;
	  $jml  = (strtotime($tgl2) - strtotime($tgl1))/86400;
	  $jml1 = (strtotime($tgl3) - strtotime($tgl2))/86400;
	  $jml2 = (strtotime($tgl4) - strtotime($tgl3))/86400;
	  //$jml3 = (strtotime($tgl4) - strtotime($tgl2))/86400;
	  $data = array
	  (
		'jml'=>$jml,
		'jml1'=>$jml1,
		'jml2'=>$jml2
		//'jml3'=>$jml3
	  );
	  echo json_encode($data);
	  
	}	
	function ajucuti($awal,$akhir){
		$data = $this->db->query("sp_hitungcuti '".inggris_date($awal)."','".inggris_date($akhir)."'")->row();
		
		
		echo json_encode($data);
	}
	
	function data($id){
		$data = $this->db->join('db_divisi','divisi_id = id_divisi')
					     ->join('db_karyjab','karyjab_id = id_karyjab')
						 ->join('db_karycutipar','karyawan_id = id_kary')
						 ->where('db_kary.id_kary',$id)
						 ->get('db_kary')
						 ->row_array();					
		echo json_encode($data);
		
	}					      
}
