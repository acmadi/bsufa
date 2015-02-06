<?php
	class karycuti_model extends Model{
		
		function __construct(){ 
			parent::__construct('db_karycuti','karycuti_id');
		}
		
		function namadiv($divisi){
			$this->db->where('id_divisi',$divisi);
			$this->db->order_by('nama','asc');
					 
			return $this->db->get('db_kary')->result();
		}
		
		
		function karycutijns(){
			
			return $this->db->get('db_karycutijns')->result();
		}
		
		
		
		
	}
			
?>
