<?php
defined('BASEPATH') or die('Access Denied');	
class closingfinance_model extends DBModel{		
	function __construct(){ 
		parent::__construct('db_closingfinance a','a.id_closf');
			$this->set_join('pt b','a.id_pt = b.id_pt');
	}
	
	 function before_fetch(){
	 	$session = $this->UserLogin->isLogin();
		$pt = $session['id_pt'];
		 $this->db->select('a.id_closf,a.periode_tahun,a.periode_bulan,b.nm_pt,b.id_pt'); 
		// $this->db->limit(1);
		 $this->db->where('a.id_pt',$pt );
		 $this->db->order_by('a.id_closf', 'desc');
		 parent::before_fetch();	

	 }	

}

            

           

            
