<?php
defined('BASEPATH') or die('Access Denied');	
class closing_model extends DBModel{		
	function __construct(){ 
		parent::__construct('db_endofyear a','a.id_acct');
			 $this->set_join('pt b','a.id_pt = b.id_pt');
	}
	
	 function before_fetch(){
		 $this->db->select('b.nm_pt, a.acc_period');
							//->where('a.status',0)  ; 
							//$this->set_join('db_gldetail b','a.voucher = b.voucher');
							//->get('db_glheader a')->result();  
							
		 parent::before_fetch();	

	 }	

}

            

           

            
