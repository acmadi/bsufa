<?php
	Class query_bgt extends model{
		private $tabelmst = 'mst_bgt';
		private $primary_key = 'id_bgt';
		
		function __construct(){
			parent::mode();
		}
		
		function get_data(){
			$this->load->db->get($this->$tabelmst)->result();
		}
	}