<?php
class listssp_model extends DBModel{
	
	function __construct(){ 
		parent::__construct('db_listssp c','listssp_id');
		$this->set_join('db_jenissetoran b','b.setor_id = c.id_setor','join');
		$this->set_join('db_akunpajak a','a.id_akunpajak = c.akunpajak_id','join');
		

		
	}
	
	function before_fetch(){
		$this->db->select('listssp_id,npwp,namawp,alamatwp,nop,db_akunpajak.kd_akunpajak,db_jenissetoran.kd_jenissetor,db_jenissetoran.jenissetoran,jml_byr,bln_masapajak,thn_masapajak,nm_ttdwp')
					->join('db_jenissetoran','id_setor = db_jenissetoran.setor_id','left')
					->join('db_akunpajak','db_akunpajak.id_akunpajak = db_jenissetoran.akunpajak_id','left')	
					->where('id_flag',1);
		
		
		
		#$this->db->where('isnull(id_flag,0) !=',10);
		parent::before_fetch();
		
	
	}
	
	
	
	/*
	
select * from db_listssp
left join db_jenissetoran on db_jenissetoran.setor_id = db_listssp.id_setor 
left join db_akunpajak on db_akunpajak.id_akunpajak = db_jenissetoran.akunpajak_id
*/

}
