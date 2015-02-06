<?php
	class purchase_req_model extends DBModel{
		
		function __construct(){ 
			//parent::__construct('PemasokMaster','kd_supplier');	
			parent::__construct('db_pr a','id_pr');
			$this->set_join('db_divisi b','divisi_id = div_pr','left');
			$this->set_join('db_trbgtdiv c','trbgt_id = id_trbgt','left');
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->pt = $session_id['id_pt'];
			$this->divisi = $session_id['divisi_id'];
			$this->lvl = $session_id['level_id'];
		}
		function before_fetch(){
		if ($this->lvl == 1){
		$this->db->select("id_trbgt,form_kode,description,status_pr,budgeted,remark,id_pr,no_pr,isnull(convert(varchar(12), tgl_pr, 105),'-') as tgl_pr,isnull(tgl_aproval,'-') as tgl_aproval,div_pr,divisi_nm,req_pr,ket_pr,isnull(alasan_pr,'-') as alasan_pr,a.id_pt,convert(varchar,CONVERT(money, amount),1) as amount");
		$this->db->where('a.id_pt',44);
		$this->db->where('a.div_pr',$this->divisi);
	}elseif($this->lvl == 3){
		$this->db->select("id_trbgt,form_kode,description,status_pr,budgeted,remark,id_pr,no_pr,tgl_pr,tgl_aproval,div_pr,divisi_nm,req_pr,ket_pr,alasan_pr,a.id_pt,convert(varchar,CONVERT(money, amount),1) as amount");
		$this->db->where('a.id_pt',44);
		$this->db->where('a.div_pr',$this->divisi);
	}else{
	$this->db->select("id_trbgt,form_kode,description,status_pr,budgeted,remark,id_pr,no_pr,tgl_pr,tgl_aproval,div_pr,divisi_nm,req_pr,ket_pr,alasan_pr,a.id_pt,convert(varchar,CONVERT(money, amount),1) as amount");
		$this->db->where('a.id_pt',44);
	}	
		parent::before_fetch();
	}
		
}



