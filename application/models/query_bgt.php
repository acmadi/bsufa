<?php
	
	Class query_bgt extends Model{
		private $tabelmst = 'mst_bgt';
		private $primary_key = 'id_bgt';
		
		function __construct(){
			parent::Model();
		}
		
		function get_data(){
			//return $this->load->db->get($this->tabelmst)->result();
			return $this->db->get($this->tabelmst)->result();
		}
		/*function get_detail($id){
			return $this->db->get($this->tabelmst)->row();
		}*/
	}
?>