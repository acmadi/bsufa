<?php
	class pecahcuti extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('pecah_model');
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
			
		}	
			
		function pecah(){
			$ta = $this->db->select('karycuti_id,transaksi_id,tgl_aju,startdate_cuti,enddate_cuti,tgl_msk')->get('db_karycuti_lama')->result();
			$ts = $this->db->select('startdate_cuti')->get('db_karycuti_lama')->result();
			$te = $this->db->select('enddate_cuti')->get('db_karycuti_lama')->result();
			$tm = $this->db->select('tgl_msk')->get('db_karycuti_lama')->result();
			
			foreach ($ta as $row){
			
			$pecah1 = explode("-",$row->tgl_aju);
				$tahun1 = $pecah1[2];
				$bulan1 = $pecah1[1];
				$hari1 = $pecah1[0];
			
			$pecah2 = explode("-",$row->startdate_cuti);
				$tahun2 = $pecah2[2];
				$bulan2 = $pecah2[1];
				$hari2 = $pecah2[0];
			
			$pecah3 = explode("-",$row->enddate_cuti);
				$tahun3 = $pecah3[2];
				$bulan3 = $pecah3[1];
				$hari3 = $pecah3[0];
			
			$pecah4 = explode("-",$row->tgl_msk);
				$tahun4 = $pecah4[2];
				$bulan4 = $pecah4[1];
				$hari4 = $pecah4[0];
			
			$lengkap1 = $tahun1.'-'.$bulan1.'-'.$hari1;
			$lengkap2 = $tahun2.'-'.$bulan2.'-'.$hari2;
			$lengkap3 = $tahun3.'-'.$bulan3.'-'.$hari3;
			$lengkap4 = $tahun4.'-'.$bulan4.'-'.$hari4;
			#echo $row->karycuti_id.'  '.$lengkap1;
			#echo "<br />";
			echo "<table border=1>";
			#echo "<tr><th>karycuti_id</th><th>tgl_aju</th><th>startdate_cuti</th><th>enddate_cuti</th><th>tgl_msk</th></tr>";
			
			echo "<tr>";
			echo "<td>".$row->transaksi_id."</td>";
			echo "<td>".$lengkap1."</td>";
			echo "<td>".$lengkap2."</td>";
			echo "<td>".$lengkap3."</td>";
			echo "<td>".$lengkap4."</td>";
			echo "</tr>";
			
			
			
			}
			
			
			
			//~ $data = array (
				//~ 'tgl_aju' => $lengkap1
				//~ );
				//~ 
			//~ $this->db->insert('db_pecah',$data);
			//~ die('sukses');
			//~ 
			
		}
		
		
	
	}

