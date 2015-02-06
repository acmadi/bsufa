<?php
	class pecah_model extends DBModel{
		
		function __construct(){ 
			
			parent::__construct('db_pecah','id_pecah');
		
			
		}
		
		function before_fetch(){
		
		
		parent::before_fetch();
	}


}
