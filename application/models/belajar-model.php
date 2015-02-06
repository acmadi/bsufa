<?php

	Class belajar-model extends Model{
		private $master ='mst_bgt';
		private $primary_key ='id_mst';
		
		function __construct(){
			parent::Model();
		}
		
		function get_data(){
			return $this->db->get($this->master)->result();
		}
	}
?>
		