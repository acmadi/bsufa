<?php
Class mstbudget_model Extends model{

	function __construct(){
		parent::model();
	}		

	function get_mstbudget(){
		$this->db->select('*');
		$this->db->from('db_mstbgt');
		$this->db->order_by('id_mst','ASC');
		$query = $this->db->get();
		return $query->result();
	}
	
    public function countAll(){
        $this->db->select("*");
        $this->db->from("db_mstbgt");
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	
    public function gridAll($sidx,$sord,$limit,$start){
        $data = "";
        $this->db->select("*");
        $this->db->from("db_mstbgt");
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this-> db-> get();
        if ($Q-> num_rows() > 0){
            $data=$Q-> result();
        }
        $Q-> free_result();
        return $data;
    }
		
		
}
