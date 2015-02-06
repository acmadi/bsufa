<?php
	class viewcjc_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('db_cjc a','id_cjc');
			//$this->set_join('db_kontrak b','a.id_kontrak = b.id_kontrak');

		}
		
		/*function before_fetch(){
			parent::before_fetch();
		}*/
		
	}


