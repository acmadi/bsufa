<?php
	class mstpettycash_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('master_pettycash','id_mptcash');
							
		}	
		function before_fetch(){
		//$project = array('41012','41011','1');
		$this->db->select("id_mptcash, nomor_mptcash, bln_mptcash, amount_mptcash, saldo_mptcash, deskripsi,status");
		$this->db->where('status',0 );
		$this->db->or_where('status',1 );
		parent::before_fetch();
	}
	}
?>
