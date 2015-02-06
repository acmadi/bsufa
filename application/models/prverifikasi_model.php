<?php
	class prverifikasi_model extends DBModel{
		
		function __construct(){ 
			//parent::__construct('PemasokMaster','kd_supplier');	
			parent::__construct('db_pr a','id_pr');
			$this->set_join('db_divisi b','a.div_pr = b.divisi_id','left');
			$this->set_join('db_trbgtdiv c','c.id_trbgt = a.trbgt_id','left');
		}
		
		function before_fetch(){
			$CI =&get_instance();
			$CI->load->model('userlogin','user');
			$session_id = $CI->user->isLogin();			
			$divisi = $session_id['divisi_id'];	
			$pt = $session_id['id_pt'];	
			
			//Query
			$this->db->select('status_pr,a.id_pt,c.amount,id_pr,no_pr,tgl_pr,divisi_nm,req_pr,ket_pr,alasan_pr, isnull(approval1,"-") as approval1,
			isnull(approval2,"-") as approval2,description');
			
			$xdata = array(1,2,3,4,5,6,7,8);
			$this->db->where_in('status_pr',$xdata);
			#$this->db->where('a.div_pr',$divisi);
			$this->db->where('a.id_pt',$pt );
			parent::before_fetch();
		}
		
	}
