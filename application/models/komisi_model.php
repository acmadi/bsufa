<?php
defined('BASEPATH') or die('Access Denied');	
class komisi_model extends DBModel{		
	function __construct(){ 
		parent::__construct('db_proseskomisi','id_proses');
			 
	}
	
	 function before_fetch(){
		 $this->db->select('id_proses,tgl_proses, id_user');
							//->where('a.status',0)  ; 
							//$this->set_join('db_gldetail b','a.voucher = b.voucher');
							//->get('db_glheader a')->result();  
							
		 parent::before_fetch();	

	 }	

}

            

           

            
