<?php
Class printrequest_model extends Model{
	
	function __construct(){
		parent::Model();
	}
	
	function check_divisi($id){
		$this->db->where('divisi_id',$id);
		return $this->db->get('db_divisi')->row_array();
	}
	
	function get_data($bln,$id_divisi,$pt,$tglawal,$thn,$dt1){
		/*$sql = "SELECT a.code,a.descbgt, (SELECT SUM(amount) FROM db_trbgtdiv actual 
				WHERE actual.code_id = a.code and DATENAME(mm,tanggal) = '$bln' and 
				divthn='$thn' and id_pt = '$pt')
				AS act_month,a.bgt1,a.bgt2,a.bgt3, a.bgt4,a.bgt5,a.bgt6,
				a.bgt7,a.bgt8,a.bgt9,a.bgt9,a.bgt10, a.bgt11,a.bgt12,
				a.tot_mst,(SELECT SUM(amount) FROM db_trbgtdiv WHERE code_id = a.code 
				and convert(char(10),apptanggal,101) BETWEEN '01/01/$thn' AND '$dt1' 
				AND id_pt = '$pt') AS act_ytd,
				(SELECT SUM(amount) FROM db_trbgtdiv WHERE code_id = a.code AND 
				divthn = '$thn' and id_pt = '$pt') as act_annual FROM db_mstbgt a 
				where a.divisi_id= '$id_divisi' and a.id_pt = '$pt' and thn='$thn' 
				order by a.code ASC 
				";*/
		$query = $this->db->query("sp_request_budget '".$bln."',".$id_divisi.","
		.$pt.",'".$tglawal."','".$thn."','".$dt1."'");
		#$query = $this->db->query($sql);
		#dump($query);
		
		return $query->result();
	}
	
	function get_all($bln,$pt){
		$sql = "SELECT a.code,a.descbgt,
			    (SELECT SUM(amount) FROM db_trbgtdiv actual WHERE 
				actual.code_id = a.code and DATENAME(mm,tanggal) = 'June' and id_pt = '$pt') 
				AS  act_month,a.bgt1,a.bgt2,a.bgt3,
				a.bgt4,a.bgt5,a.bgt6,a.bgt7,a.bgt8,a.bgt9,a.bgt9,a.bgt10,
				a.bgt11,a.bgt12,a.tot_mst,(SELECT SUM(amount)
				FROM db_trbgtdiv  WHERE code_id = a.code AND DATENAME(yyyy,tanggal) = '2011'
				and DATENAME(mm,tanggal) between 'January' and 'June' and id_pt = '$pt') 
				AS act_ytd,(SELECT SUM(amount) FROM db_trbgtdiv  
				WHERE code_id = a.code AND DATENAME(yyyy,tanggal) = '2011' and id_pt = '$pt') as act_annual FROM db_mstbgt a 
				where  a.id_pt = '$pt' order by a.code ASC
				";
		$query = $this->db->query($sql);
		return $query->result();
	}



	function get_data_divisi($bln,$thn,$pt,$dt1){
		$session_id = $this->UserLogin->isLogin();
		#$pt = $session_id['id_pt'];	
		$parent = $session_id['id_parent'];	
		#DATENAME(MM,tanggal) BETWEEN 'January' AND '$bln' AND
		$sql = "SELECT b.divisi_nm,a.divisi_id, SUM(a.bgt1) AS bgt1,SUM(a.bgt2) AS bgt2,
				SUM(a.bgt3) AS bgt3,SUM(a.bgt4) AS bgt4,SUM(a.bgt5) AS bgt5,
				SUM(a.bgt6) AS bgt6,SUM(a.bgt7) AS bgt7,SUM(a.bgt8) AS bgt8,
				SUM(a.bgt9) AS bgt9,SUM(a.bgt10) AS bgt10,SUM(a.bgt11) AS bgt11,
				SUM(a.bgt12) AS bgt12,(SELECT SUM(amount) FROM db_trbgtdiv WHERE
				divisi_id = a.divisi_id AND DATENAME(mm,tanggal) = '$bln' AND 
				DATENAME(yyyy,tanggal) = '$thn' and id_pt = '$pt' and flag_id <> 10 ) AS actual_month,
				(SELECT SUM(amount) FROM db_trbgtdiv WHERE divisi_id=a.divisi_id 
				AND DATENAME(mm,tanggal) <= '$bln'
				AND divthn = '$thn' AND id_pt = '$pt' and flag_id <> 10 ) AS actual_ytd,
				SUM(a.tot_mst) AS annual_budget,(SELECT SUM(amount)
				FROM db_trbgtdiv  WHERE divisi_id = a.divisi_id AND 
				divthn = '$thn' AND id_pt = '$pt' and flag_id <> 10)
				AS annual_actual FROM db_mstbgt_update a LEFT JOIN 
				db_divisi b ON(a.divisi_id=b.divisi_id) where a.id_pt = '$pt'
				and a.thn = '$thn' and id_parent = $parent
				GROUP BY a.divisi_id,b.divisi_nm
				";
			#dump($sql);
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_nama_pt($pt){
		$this->db->where('id_pt',$pt);
		return $this->db->get('pt')->row_array();
	}
	
}
