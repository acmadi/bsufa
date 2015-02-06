<?php
	defined('BASEPATH') or die('Access Denied');
	
	class trbudgetdiv extends AdminPage{

		function trbudget()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$this->load->Model('trbudgetdiv_model','trbudget');	
			$session_id = $this->UserLogin->isLogin();
			$id =  $session_id['id'];
			$lvl = $session_id['level_id'];
			$divisi = $session_id['divisi_id'];
			$pt = $session_id['id_pt'];
			$id_parent = $session_id['id_parent'];
			$data['kode_budget'] = $this->trbudget->get_kodebudget($divisi,$lvl,$pt,$id_parent);
			$this->parameters['data'] = $data;
			$this->loadTemplate('mis/trbudgetdiv_view');
		}		
		
		function data($id){
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];
			$data = $this->db->where('code',$id)
							 ->where('id_pt',$pt)
							 ->get('db_mstbgt')
							 ->row_array();
			echo json_encode($data);
		}
		
		function hitung(){
			$bil1 = $this->input->post('bil1');
			$bil2 = $this->input->post('bil2');
			echo $bil1 + $bil2;
		}
		
		function bgt_ytd($no){
			#$cek = intval($no);
			$path = substr($no,0,2);
			$thn = substr($no,2,4);
			$kode = substr($no,6);
			$akseslvl = substr($kode,0,3);
			$bln = array("","bgt1","bgt2","bgt3","bgt4","bgt5","bgt6","bgt7","bgt8","bgt9","bgt10","bgt11","bgt12");
			$total = 0;
			
			#jumlah budget divisi perbulan
			$id = str_replace("0","",$path);
			$jbln = $bln[$id];
			$session_id = $this->UserLogin->isLogin();
			$iduser =  $session_id['id'];
			$divisi = $session_id['divisi_id'];
			$level = $session_id['level_id'];
			$pt = $session_id['id_pt'];
			if($level==1){
				$sql = $this->db->select('sum('.$jbln.') as jml')
								->where('substring(code,1,3)',$akseslvl)
								->where('id_pt',$pt)
								->get('db_mstbgt')->row_array();
				$bgt_month = $sql['jml'];
			}else{
				$sql = $this->db->select('sum('.$jbln.') as jml')
							->where('id_divisi',$divisi)
							->where('id_pt',$pt)
							->get('db_mstbgt')->row_array();
				$bgt_month = $sql['jml'];
			}
			#end jumlah budget divisi perbulan
		
			for($i=1;$i<=$path;$i++){
				$n = $bln[$i];
				$jml = $this->db->select($n)
							->where('code',$kode,'date',$thn)
							->get('db_mstbgt')->row_array();
				$hsl = $jml[$n];
				$total = $total + $hsl;
			}
		 
		
			$tot_blc=$this->db->select_sum('amount') 
						->where('code',$kode)
						->where("substr(date,7,4)",$thn)
						->where("substr(date,4,2)",$path)
						->where('flag !=',1)
						->get('db_trbgtdiv')->row_array();
						
			$blc = $tot_blc['amount'];
			$totblc_ytd = $total - $blc;
			$data2 = array
			(
				'total'=>$total,
				'blc'=>$totblc_ytd,
				'bgt_month'=>$bgt_month
			);
			
			echo json_encode($data2);
		}

		function bgt_balance($no){
			$kode = substr($no,6);
			$thn = substr($no,2,4);
			$path = substr($no,0,2);
			$akseslvl = substr($kode,0,3);
			$bln = array("","bgt1","bgt2","bgt3","bgt4","bgt5","bgt6","bgt7","bgt8","bgt9","bgt10","bgt11","bgt12");


			#Jumlah month budget berdasarkan user
			$session_id = $this->UserLogin->isLogin();
			$user = $session_id['id'];
			$divisi = $session_id['divisi_id'];
			$level = $session_id['level_id'];
			$pt = $session_id['id_pt'];
			if($level==1){
				$sql_bgt1 = $this->db->select('sum(amount) as total')
								 ->from('db_trbgtdiv')
								 ->where('SUBSTRING(code,1,3)',$akseslvl)
								 ->where('SUBSTRING(date,4,2)',$path)
								 ->where('SUBSTRING(date,7,4)',$thn)
								 ->where('flag !=',1)
								 ->where('id_pt',$pt)
								 ->get()->row_array();
				$bgt_divmonth = $sql_bgt1['total'];
			}else{
				$sql_bgt1 = $this->db->select('sum(amount) as total')
								 ->from('db_trbgtdiv')
								 ->where('divisi_id',$divisi)
								 ->where('SUBSTRING(date,4,2)',$path)
								 ->where('SUBSTRING(date,7,4)',$thn)
								 ->where('flag !=',1)
								 ->where('id_pt',$pt)
								 ->get()->row_array();
				$bgt_divmonth = $sql_bgt1['total'];
		   }

			$id = str_replace("0","",$path);
			$jbln = $bln[$id];
			if($level==1){
				$sql = $this->db->select('sum('.$jbln.') as jml')
							->where('substring(code,1,3)',$akseslvl)
							->where('id_pt',$pt)
							->get('db_mstbgt')->row_array();
				$bgt_month = $sql['jml'];
			}else{
				$sql = $this->db->select('sum('.$jbln.') as jml')
							->where('id_divisi',$divisi)
							->where('id_pt',$pt)
							->get('db_mstbgt')->row_array();
				$bgt_month = $sql['jml'];
		    }								 
			#end Jumlah
			
			#Jumlah annual budget berdasarkan kode 
			$tot_blc=$this->db->select_sum('amount') 
						->where('code',$kode)
						->where('id_pt',$pt)
						->where('flag !=',1)
						->get('db_trbgtdiv')->row_array();
			$blc = $tot_blc['amount'];

			$tot=$this->db->select ('tot_mst') 
						->where('code',$kode)
						->where('id_pt',$pt)
						->get('db_mstbgt')->row_array();
			$totmst = $tot['tot_mst'];
			#end Jumlah

			#Balance  Budget
			$amount = $totmst - $blc;//balance annual budget
			$blc_month = $bgt_month  - $bgt_divmonth;
			
			$blcdata = array
			(
				'amount'=>$amount,
				'blc_month'=>$blc_month
			);
			
			echo json_encode($blcdata);
		}
		
		function respon_data(){
			#echo"responku";
		}
}


