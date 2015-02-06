<?php
	class purchase_order_model extends DBModel{
		
		function __construct(){ 
			//parent::__construct('PemasokMaster','kd_supplier');	
			parent::__construct('db_pr a','id_pr');
			$this->set_join('db_divisi b','div_pr = divisi_id');
			
		}
		
		function before_fetch(){
			$this->db->select('
			
	a.id_pr,
	a.no_pr,
	a.tgl_pr,
	a.req_pr,
	a.div_pr,
	a.ket_pr,
	a.status_pr,
	a.alasan_pr,
	a.tgl_batal_pr,
	a.tgl_aproval,
	a.budgeted,
	a.userinput,
	a.approval1,
	a.tgl_aprv1,
	a.flagapp1,
	a.approval2,
	a.tgl_aprv2,
	a.flagapp2,
	a.approval3,
	a.tgl_aprv3,
	a.flagapp3,
	a.po_posting,
	a.tglpost_pr,
	a.id_pt,
	a.trbgt_id,
	a.id_flag,b.divisi_id,b.divisi_nm
			
			
			
			
			');
			$xdata = array(7,8);
			$this->db->where_in('status_pr',$xdata);
			
			$this->db->where('a.id_pt',44);		 	
			parent::before_fetch();
			
		}
		
}



