<?php
	class mastercontr_model extends DBModel{
		
		function __construct(){ 
			//parent::__construct('PemasokMaster','kd_supplier');	
			parent::__construct('db_vendor','vendor_id');
			$this->set_join('db_mstcontrtype','id_mstcontrtype = mstcontrtype_id');
		}
		
		/*function before_fetch(){
			parent::before_fetch();
		}*/
		
	}



