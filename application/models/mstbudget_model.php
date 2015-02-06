<?php
	class mstbudget_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('db_mstbgt','id_mst');
		}
	}
?>
