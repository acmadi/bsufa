<?php
	class pengalihan_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('db_pengalihancustomer  a','id_pengalihancustomer');
				}
	
	/*
		function before_fetch(){
			$this->db->join('db_customer b','b.customer_id = a.customer_id','left')
					->join('db_sp c','c.id_customer= b.customer_id','left')
					->join('db_unit_yogya d','d.unit_id = c.id_unit','left')
	
					 ->get('db_pengalihancustomer a')->result();	
					
			;
			
			
		
			parent::before_fetch();
			
	
	}
	
	*/
	}
	          

	
	
	
	
	


	
	
