<?php
	defined('BASEPATH') or die('Access Denied');
	class mstmodel extends Model{
		
		function mstmodel(){
			parent::Model();
		}
		

		//Dapatkan nama PT
		function get_nama_pt($pt){
			$this->db->where('id_pt',$pt);
			return $this->db->get('pt')->row_array();
		}

		function getdivisi($id){
			if($id!=""){
				$this->db->where('divisi_id',$id);
				$div = $this->db->get('db_divisi')->row(); 
			}else{
				$div = $this->db->get('db_divisi')->result();
			}
			return $div;
		}

		function get_id($field,$isifield,$table){
			$CI =& get_instance();
			$CI->load->model('userlogin','user');
			$session_id = $CI->user->isLogin();
			$level = $session_id['level_id'];
			$parent = $session_id['id_parent'];
			
			if($level==3) 
			$this->db->where('parent_id',$parent);
					 //->where($field,$isifield);
			else
			$this->db->where($field,$isifield);
			
			return $this->db->get($table)->result();
		}

		//cek form slip budget
		function cek_slip_budget($formid,$kdbgt,$noid){
			$tglnow = date('Y-m-d');
			$tgl_aju = date('d-m-Y');
			$monthnow = date("F");
			$yearnow = date("Y");
			//die($monthnow);
			$cekdata = $this->db->where('DATENAME(mm,tgl_print)',$monthnow)
								->where('DATENAME(yy,tgl_print)',$yearnow)
								->where('form_id',$formid)
								->get('history_form_print')->num_rows();
			if($cekdata > 0){
				$cekurut = $this->db->where('DATENAME(mm,tgl_print)',$monthnow)
								->where('DATENAME(yy,tgl_print)',$yearnow)
								->where('form_id',$formid)
								->order_by('no_urut','DESC')
								->get('history_form_print')->row();
				$no_urut = $cekurut->no_urut + 1;
				if($no_urut > 0 && $no_urut < 10) $nourut = "000".$no_urut;
				elseif($no_urut > 9)$nourut = "00".$no_urut;
				elseif($no_urut > 99)$nourut = "0".$no_urut;
				elseif($no_urut > 999)$nourut = $no_urut;
				//var_dump($formid);exit;
				if($formid==1) $kode_form = "P/".$tgl_aju."/".$nourut;
				elseif($formid==2) $kode_form = "A/".$tgl_aju."/".$nourut;
				$data = array
				(
					'tgl_print' => $tglnow,
					'kodebgt' => $kdbgt,
					'no_urut' => $no_urut,
					'form_id' => $formid,
					'id_field' => $noid,
					'kode_form' => $kode_form 
				);
				$this->db->insert('history_form_print',$data);
			}else{
				//die("test");
				$no_urut = 1;
				$nourut = "0001";
				if($formid==1) $kode_form = "P/".$tgl_aju."/".$nourut;
				elseif($formid==2) $kode_form = "A/".$tgl_aju."/".$nourut;
				$data = array
				(
					'tgl_print' => $tglnow,
					'kodebgt' => $kdbgt,
					'no_urut' => $nourut,
					'form_id' => $formid,
					'id_field' => $noid,
					'kode_form' => $kode_form
				);
				$this->db->insert('history_form_print',$data);
			}
			return $nourut;
		}

		function reclass_item($code,$tgl1,$thn){
			$sql = "select * from db_mstbgtadj
					where tanggal between '2011-01-01' and '$tgl1'
					and codeadj = '$code' and status = 'rec' and 
					datename(yyyy,tanggal)='$thn'
					order by tanggal ASC";
			$query = $this->db->query($sql);
			return $query->result();
		}
		
		function adjustment_item($code,$thn){
			$sql = "select * from db_mstbgtadj
					where codeadj = '$code' and status = 'adj' and 
					datename(yyyy,tanggal)='$thn'
					order by tanggal ASC";
			$query = $this->db->query($sql);
			return $query->result();
		}		
		
		#Master Budget
		function getmstbudget($id,$thn,$pt){
			$this->db->where('code',$id);
			$this->db->where('thn',$thn);
			$this->db->where('id_pt',$pt);
			return $this->db->get('db_mstbgt_update')->row();
		}
		
		function getbudget($id,$pt,$thn){
			if($id!="") $this->db->where('divisi_id',$id);
			$this->db->where('id_pt',$pt);
			$this->db->where('thn',$thn);
			$this->db->order_by('descbgt','ASC');
			return $this->db->get('db_mstbgt_update')->result();
		}

		function get_namabudget($id,$thn){
			$this->db->join('db_mstbgt','code = code_id');
			$this->db->where('id_trbgt',$id);
			$this->db->where('thn',$thn);
			$this->db->where('db_trbgtdiv.flag_id !=',10);
			//$this->db->where('flag_id !=',2);
			return $this->db->get('db_trbgtdiv')->row_array();
		}
		
		function getmstbudgetupdate($id,$thn,$pt){
			$this->db->where('code',$id);
			$this->db->where('thn',$thn);
			$this->db->where('id_pt',$pt);
			return $this->db->get('db_mstbgt_update')->row();
		}


		function getmstbudget2($id){
			$CI =& get_instance();
			$CI->load->model('userlogin','user');
			$session_id = $CI->user->isLogin();
			$level = $session_id['level_id'];
			$parent = $session_id['id_parent'];
			$pt = $session_id['id_pt'];
			$this->db->where('code',$id);
			//$this->db->where('thn',$thn);
			return $this->db->where('id_pt',$pt)
					// $this->db->where('thn',$thn)
							->get('db_mstbgt')->row_array();
		}
		
		
		function getbgtdetail($table,$id,$thn,$pt){
			$this->db->where('code',$id);
			$this->db->where('thn',$thn);
			$this->db->where('id_pt',$pt);
			return $this->db->get($table)->row_array();
		}
		
		//Penjumlahan Budget saldo Debet
		function sumbgtd($id){
			$this->db->select("sum(bgt1) as bgt1,sum(bgt2) as bgt2,sum(bgt3) as bgt3,
			sum(bgt4) as bgt4,sum(bgt5) as bgt5,sum(bgt6) as bgt6,sum(bgt7) as bgt7,
			sum(bgt8) as bgt8,sum(bgt9) as bgt9,sum(bgt10) as bgt10,sum(bgt11) as bgt11,sum(bgt12) as bgt12,sum(tot_mst)
			as tot_mst");
			$this->db->where("code",$id);
			return $this->db->get("db_mstbgt_update")->row_array();
		}	
		//Penjumlahan Budget saldo Kredit
		function sumbgtc($id){
			$this->db->select("sum(bgt1) as bgt1,sum(bgt2) as bgt2,sum(bgt3) as bgt3,
			sum(bgt4) as bgt4,sum(bgt5) as bgt5,sum(bgt6) as bgt6,sum(bgt7) as bgt7,
			sum(bgt8) as bgt8,sum(bgt9) as bgt9,sum(bgt10) as bgt10,sum(bgt11) as bgt11,sum(bgt12) as bgt12,sum(tot_mst)
			as tot_mst");
			$this->db->where("code",$id);
			return $this->db->get("db_mstbgt_update")->row_array();
		}		
		
		function get_list($table){
			return $this->db->get($table)->result();
		}
		
		
		function db_no(){
			$this->db->order_by('id_tagihan','DESC');
			return $this->db->get('db_tagihan')->row();
		}
		
		function vendor(){
			return $this->db->get('db_vendor')->result();
		}
		
		function matauang(){
			return $this->db->get('db_curr')->result();
		}
		
		function acc(){
			return $this->db->get('coa_tra')->result();
		}
		
		#Get Account 
		function get_account($id){
			$this->db->where('kodeacc',$id);
			return $this->db->get('coa_tra')->row();
		}
				
		#Total Budget Tahunan perkode
		function total_annual($code,$thn,$pt){
			$this->db->where('code',$code);
			$this->db->where('thn',$thn);
			$this->db->where('id_pt',$pt);
			$this->db->where('flag_id !=',1);
			$this->db->where('flag_id !=',2);
			return $this->db->get('db_mstbgt_update')->row_array();
		}
		
		#Proposed Actual Budget Tahunan perkode
		function act_annual($code,$divisi,$thn,$pt){			
			//Ambil Nilai appamount
			$row1 = $this->db->select_sum('amount')
							  ->where('code_id',$code)
							  ->where('divthn',$thn)
							  ->where('id_pt',$pt)
							  ->where('flag_id !=',10)
							  ->where('appamount',0)
							  ->get('db_trbgtdiv')->row();
			//Ambil Nilai amount
			$row2 = $this->db->select_sum('appamount')
							  ->where('code_id',$code)
							  ->where('divthn',$thn)
							  ->where('id_pt',$pt)
							  ->where('flag_id !=',10)
							  ->where('appamount >',0)
							  ->get('db_trbgtdiv')->row();
			$totamount = $row1->amount + $row2->appamount;	
			#var_dump($totamount);exit;			  			
			return $totamount;
		}
		#Approved Actual Budget Tahunan perkode
		function appact_annual($code,$divisi,$thn){
			$this->db->select('sum(amount) as jml');
			$this->db->where('code_id',$code);
			$this->db->where('flag_id !=',10);
			#$this->db->where('flag_id',1);
			$this->db->where('divthn',$thn);
			return $this->db->get('db_trbgtdiv')->row_array();
		}

		function trbgtdiv($id){
			$this->db->where('id_trbgt',$id);
			return $this->db->get('db_trbgtdiv')->row();
		}
		
		//Fungsi mengecek ID Secara Global
		function getglobal($table,$field,$id){
			$this->db->where($field,$id);
			return $this->db->get($table)->num_rows();
		}	
		
		//Fungsi Global keseluruhan
		//function global_all($table,$field,$id,	

		#Total Budget Tahunan perdivisi
		function total_annualdiv($divisi,$thn,$pt){
			$this->db->select('sum(tot_mst) as jml');
			$this->db->where('divisi_id',@$divisi);
			$this->db->where('id_pt',@$pt);			
			$this->db->where('thn',@$thn);
			
			return $this->db->get('db_mstbgt_update')->row();
		}
		
		#Proposed Actual Budget Tahunan perdivisi
		function act_annualdiv($divisi,$thn){
			$this->db->select('sum(amount) as jml');
			$this->db->where('divisi_id',$divisi);
			$this->db->where('flag_id !=',10);
			$this->db->where('divthn',$thn);
			return $this->db->get('db_trbgtdiv')->row();
		}
		
		#Proposed Actual Budget Tahunan perdivisi
		function appact_annualdiv($divisi,$thn){
			$this->db->select('sum(appamount) as jml');
			$this->db->where('divisi_id',$divisi);
			$this->db->where('divthn',$thn);
			#$this->db->where('flag_id',1);
			$this->db->where('flag_id !=',10);
			return $this->db->get('db_trbgtdiv')->row();
		}

		#Total Budget Tahunan alldivisi
		function total_annualalldiv($thn,$pt){
			$this->db->select('sum(tot_mst) as jml');
			$this->db->where('thn',$thn);
			$this->db->where('id_pt',$pt);
			return $this->db->get('db_mstbgt_update')->row();
		}
		
		#Proposed Actual Budget Tahunan alldivisi
		function act_annualalldiv($thn,$pt){
			$this->db->select('sum(amount) as jml');
			$this->db->where('divthn',$thn);
			$this->db->where('id_pt',$pt);
			#$this->db->where('flag_id',1);
			$this->db->where('flag_id !=',10);
			return $this->db->get('db_trbgtdiv')->row();
		}
		
		#Approved Actual Budget Tahunan alldivisi
		function appact_annualalldiv($thn,$pt){
			$this->db->select('sum(appamount) as jml');
			$this->db->where('divthn',$thn);
			$this->db->where('id_pt',$pt);
			#$this->db->where('flag_id',1);
			$this->db->where('flag_id !=',10);
			return $this->db->get('db_trbgtdiv')->row();
		}


		
		#Total Budget Bulanan perkode
		function total_month($kode,$jbln,$thn,$pt){
			$this->db->select('sum('.$jbln.') as jml');
			$this->db->where('code',$kode);
			$this->db->where('id_pt',$pt);
			$this->db->where('thn',$thn);
			$this->db->where('flag_id !=',1);
			$this->db->where('flag_id !=',2);
			return $this->db->get('db_mstbgt_update')->row_array();
		}
		
		#Proposed Actual Budget Bulanan perkode
		function act_month($kode,$bln,$thn,$pt){
			$xrow = $this->db->where('code_id',$kode)
							  ->where('divthn',$thn)
							  ->where('id_pt',$pt)
							  ->where('flag_id !=',10)
							  ->get('db_trbgtdiv')->row();
			if(@$xrow->appamount != '') $amount = "appamount";
			else $amount = "amount";
						
			$this->db->select('sum('.$amount.') as jml');
			$this->db->where('DATENAME(mm,tanggal)',$bln);
			$this->db->where('id_pt',$pt);
			$this->db->where('divthn',$thn);
			$this->db->where('code_id',$kode);
			$this->db->where('flag_id !=',10);
			return $this->db->get('db_trbgtdiv')->row_array();
		}
		
		#Approved Actual Budget Bulanan perkode
		function appact_month($kode,$bln,$thn){
			$this->db->select('sum(appamount) as jml');
			$this->db->where('DATENAME(mm,apptanggal)',$bln);
			$this->db->where('divthn',$thn);
			$this->db->where('code_id',$kode);
			#$this->db->where('flag_id',1);
			$this->db->where('flag_id !=',10);
			return $this->db->get('db_trbgtdiv')->row_array();
		}
		

		#Total Budget Bulanan perdivisi
		function total_monthdiv($divisi,$jbln,$thn){
			$this->db->select('sum('.$jbln.') as jml');
			$this->db->where('divisi_id',$divisi);
			$this->db->where('thn',$thn);
			
			return $this->db->get('db_mstbgt_update')->row_array();
		}
		
		#Proposed Actual Budget Bulanan perdivisi
		function act_monthdiv($divisi,$bln,$thn){
			$this->db->select('sum(amount) as jml');
			$this->db->where('divisi_id',$divisi);
			$this->db->where('DATENAME(mm,tanggal)',$bln);
			$this->db->where('divthn',$thn);
			$this->db->where('flag_id',10);
			#$this->db->where('flag_id',1);
			return $this->db->get('db_trbgtdiv')->row_array();
		}
		
		#Approved Actual Budget Bulanan perdivisi
		function appact_monthdiv($divisi,$bln,$thn){
			$this->db->select('sum(appamount) as jml');
			$this->db->where('divisi_id',$divisi);
			$this->db->where('DATENAME(mm,apptanggal)',$bln);
			$this->db->where('divthn',$thn);
			$this->db->where('flag_id !=',10);
			#$this->db->where('flag_id',1);
			return $this->db->get('db_trbgtdiv')->row_array();
		}

		#Total Budget Bulanan alldivisi
		function total_monthalldiv($jbln,$thn,$pt){
			$this->db->select('sum('.$jbln.') as jml');
			$this->db->where('thn',$thn);
			$this->db->where('id_pt',$pt);
			return $this->db->get('db_mstbgt_update')->row_array();
		}
		
		#Proposed Actual Budget Bulanan perdivisi
		function act_monthalldiv($bln,$thn,$pt){
			$this->db->select('sum(amount) as jml');
			$this->db->where('DATENAME(mm,tanggal)',$bln);
			$this->db->where('divthn',$thn);
			$this->db->where('id_pt',$pt);
			$this->db->where('flag_id !=',10);
			#$this->db->where('flag_id',1);
			return $this->db->get('db_trbgtdiv')->row_array();
		}
		
		#Approved Actual Budget Bulanan perdivisi
		function appact_monthalldiv($bln,$thn,$pt){
			$this->db->select('sum(appamount) as jml');
			$this->db->where('DATENAME(mm,apptanggal)',$bln);
			$this->db->where('divthn',$thn);
			$this->db->where('id_pt',$pt);
			$this->db->where('flag_id !=',10);
			#$this->db->where('flag_id',1);
			return $this->db->get('db_trbgtdiv')->row_array();
		}



		
		#Total Budget YTD perkode
		function total_ytd($x,$code,$thn,$pt){
			$this->db->select('sum('.$x.') as jml');
			$this->db->where('thn',$thn);
			$this->db->where('code',$code);
			$this->db->where('id_pt',$pt);
			$this->db->where('flag_id !=',1);
			$this->db->where('flag_id !=',2);
			return $this->db->get('db_mstbgt_update')->row_array();
		}	
		
		#Proposed Actual Budget YTD perkode
		function act_ytd($code,$thn,$pt){
			$xrow = $this->db->where('code_id',$code)
							  ->where('divthn',$thn)
							  ->where('id_pt',$pt)
							  ->where('flag_id !=',10)
							  ->get('db_trbgtdiv')->row();
			if(@$xrow->appamount != "") $amount = "appamount";
			else $amount = "amount";
									
			$this->db->select('sum('.$amount.') as jml');
			$this->db->where('id_pt',$pt);
			$this->db->where('code_id',$code);
			$this->db->where('divthn',$thn);
			$this->db->where('flag_id !=',10);
			#$this->db->where('flag_id',1);
			return $this->db->get('db_trbgtdiv')->row_array();
		}
		
		#Approved Actual Budget YTD perkode
		function appact_ytd($code,$thn){
			$this->db->select('sum(appamount) as jml');
			$this->db->where('code_id',$code);
			$this->db->where('divthn',$thn);
			$this->db->where('flag_id !=',10);
			#$this->db->where('flag_id',1);
			return $this->db->get('db_trbgtdiv')->row_array();
		}

		#Total Budget YTD perdivisi
		function total_ytddiv($x,$divisi,$thn,$pt){
			$this->db->select('sum('.$x.') as jml');
			$this->db->where('thn',$thn);
			$this->db->where('id_pt',$pt);
			$this->db->where('divisi_id',$divisi);
			$this->db->where('flag_id !=',1);
			$this->db->where('flag_id !=',2);
			return $this->db->get('db_mstbgt_update')->row_array();
		}	
		
		#Proposed Actual Budget YTD perdivisi
		function act_ytddiv($divisi,$thn){
			$this->db->select('sum(amount) as jml');
			$this->db->where('divisi_id',$divisi);
			$this->db->where('divthn',$thn);
			$this->db->where('flag_id !=',10);
			#$this->db->where('flag_id',1);
			return $this->db->get('db_trbgtdiv')->row_array();
		}
		
		#Approved Actual Budget YTD perdivisi
		function appact_ytddiv($divisi,$thn){
			$this->db->select('sum(appamount) as jml');
			$this->db->where('divisi_id',$divisi);
			$this->db->where('divthn',$thn);
			$this->db->where('flag_id !=',10);
			#$this->db->where('flag_id',1);
			return $this->db->get('db_trbgtdiv')->row_array();
		}
				
		#Total Budget YTD Alldivisi
		function total_ytdalldiv($x,$thn,$pt){
			$this->db->select('sum('.$x.') as jml');
			$this->db->where('thn',$thn);
			$this->db->where('flag_id !=',1);
			$this->db->where('flag_id !=',2);
			$this->db->where('id_pt',$pt);
			return $this->db->get('db_mstbgt_update')->row_array();
		}	
		
		#Proposed Actual Budget YTD Alldivisi
		function act_ytdalldiv($thn,$pt){
			$this->db->select('sum(amount) as jml');
			$this->db->where('divthn',$thn);
			$this->db->where('id_pt',$pt);
			$this->db->where('flag_id !=',10);
			#$this->db->where('flag_id',1);
			return $this->db->get('db_trbgtdiv')->row_array();
		}
		
		#Approved Actual Budget YTD Alldivisi
		function appact_ytdalldiv($thn,$pt){
			$this->db->select('sum(appamount) as jml');
			$this->db->where('divthn',$thn);
			$this->db->where('id_pt',$pt);
			$this->db->where('flag_id !=',10);
			#$this->db->where('flag_id',1);
			return $this->db->get('db_trbgtdiv')->row_array();
		}

		#Get All For Tagihan Table
		function get_all_tagihan($id){
			$this->db->select('db_vendor.nama as nm_vendor,db_vendor.alamat as alamat_vendor,
			db_mstbgt.descbgt as descbgt,db_mstbgt.acc as acc,db_pph.nama as nm_pph,db_mapping.coa_id as coa_pph');
			$this->db->join('db_mstbgt','code = code');
			$this->db->join('db_vendor','id_vendor = vendor_id');
			$this->db->join('db_pph','pph_id = id_pph');
			$this->db->join('db_mapping','db_mapping.pph_id = id_pph');
			$this->db->where('id_tagihan',$id);
			return $this->db->get('db_tagihan')->row();
		}
		
			
		#Master PPH
		function get_pph(){
			return $this->db->get('db_pph')->result();
		}	
		
		function get_pphid($id){
			$this->db->join('db_pph','id_pph = pph_id');
			$this->db->join('db_mapping','id_pph = pph_id');
			$this->db->where('id_tagihan',$id);
			$this->db->get('db_tagihan')->row();
		}
		 
		
		#Get Vendor
		function get_vendor($id){
			$this->db->join('db_vendor','vendor_id = id_vendor');
			$this->db->where('vendor_id',$id);
			return $this->db->get('db_tagihan')->row_array();
		}
		
		#Master Budget
		function get_budget($id){
			$this->db->join('db_mstbgt b','a.code = b.code');
			$this->db->join('coa_tra','kodeacc = acc');
			$this->db->where('a.code',$id);
			return $this->db->get('db_tagihan a')->row();
		}
		
		#Master Coa
		function get_coa($id){
			$this->db->where('kodeacc',$id);
			return $this->db->get('coa_tra')->row();			
		}		
		
		#Cuti Karyawan
		function viewkary($id){
			$this->db->join('db_kary','id_kary = kary_id');
			$this->db->join('db_karycutipar','karyawan_id = kary_id');
			$this->db->join('db_divisi','divisi_id = id_divisi');
			$this->db->join('db_karycutijns','karycutijns_id = jns_cuti');
			$this->db->join('db_karycutials','karycutials_id = id_karycutials');
			$this->db->join('db_karyjab','karyjab_id = id_karyjab');
			$this->db->join('db_approval','transaksi_id = no_link');
			$this->db->where('karycuti_id',$id);
			return $this->db->get('db_karycuti')->row_array();
		}
		
		#Data Karyawan
		function datakary($id){
			#$tgl = date(d-m-Y);
			#die($tgl);
			$this->db->join('db_karyjab','karyjab_id = id_karyjab');
			$this->db->join('db_divisi','divisi_id = id_divisi');
			$this->db->join('db_karycutipar','karyawan_id = id_kary');
			$this->db->where('id_kary',$id);
			#$this->db->where('year(thn)',2013);
			return $this->db->get('db_kary')->row();
		}

		function parameter1($table,$field,$field2,$variable){
			$this->db->where($field,$variable);
			$this->db->order_by($field2,'ASC');
			return $this->db->get($table)->result();
		}
		
		#Get Last ID
		function get_lastid($id,$table){
			$this->db->order_by($id,'DESC');
			return $this->db->get($table)->row();
		}	

		function get_firstid($id,$table){
			$this->db->order_by($id,'ASC');
			return $this->db->get($table)->result();
		}	

		
		function getmstvendor($nama,$proj){
			//$this->db->like('nm_supplier',$nama);
			$this->db->where('nm_supplier',$nama)
							->where ('kd_project',$proj);
				return $this->db->get('PemasokMaster')->num_rows();
		}		
		
		function getproject($nama,$proj){
			$this->db->like('nm_supplier',$nama)
					 ->where ('kd_project',$proj);
			return $this->db->get('pemasok')->num_rows();
		}
		

		function globalresult($table){
			return $this->db->get($table)->result();
		}
		
		
		//Hitung jumlah Cuti dipakai
		/*function hitung_cuti($id){
			$dt = $this->db->select('sum(aju_cuti) as jml')
					  ->where('kary_id',$id)
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
   }*/
   
   //Cek jumlah cuti
   function hitung_cuti($id)
   {
	   $this->db->select('sum(aju_cuti) as jml');
	   $this->db->where('kary_id',$id);
	   $this->db->where('jns_cuti',1);
	   $this->db->where('flowapp_id','10');
	   $this->db->where('cek_id !=',1);
	   return $this->db->get('db_karycuti')->row();
   }
 			
	function approv_id(){
		$this->db->order_by('id_transaksi','DESC');
		return $this->db->get('db_approval')->row_array();
	}
 			

		//Hitung realisasi peritem
		function realisasi_item($code,$thn,$pt){
			$sql = "select * from db_trbgtdiv
					where code_id = '$code' and flag_id = 1 and 
					datename(yyyy,tanggal)='$thn' and id_pt = '$pt'
					order by tanggal ASC";
			$query = $this->db->query($sql);
			return $query->result();
		}
		
		#Master Budget
		function cekmstbudget($id,$thn){
			$this->db->where('code',$id);
			$this->db->where('thn',$thn);
			return $this->db->get('db_mstbgt')->num_rows();
		}		
		
		
			
		function cek_byr($top,$denda_id,$tgl,$nilai){
			//$nextmonth = date('Y-m-d',strtotime("$tgl +12 month"));
			$rate = $nilai / $top;
			for($i = 1;$i <= $top;$i++){
				//$nil = $top + 1;
				$nextmonth = date('Y-m-d',strtotime("$tgl +$i month"));
				//var_dump($nextmonth."-".$denda_id."-".$rate."<br/>");*/
				$data = array 
				(
					'cicilan_tgl' => $nextmonth,
					'cicilan_byr' => $nextmonth,
					'cicilan_jml' => $rate,
					'cicilan_ceklist' => 1,
					'id_denda' => $denda_id
				);
				
				$this->db->insert('db_cicilan',$data);
			}
			//return $nextmonth;
		}
		

		function sumglobal($table,$field,$value,$amount,$divisi,$pt){
			$this->db->select_sum($amount);
			$this->db->where($field,$value);
			$this->db->where('divisi_id',$divisi);
			$this->db->where('id_pt',$pt);
			return $this->db->get($table)->row();
		}
		
			
		
}
