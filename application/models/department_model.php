<?php
	class department_model extends Model{
		private $table_name = 'department';
		private $primary_key = 'id_department';
		
		function __construct(){
			parent::Model();
		}
		
		function get(){
			//$this->db->join('department','department_id = id_department');
			return $this->db->get($this->table_name)->result();
		}
		
		function get_detail($id){
			$this->db->where($this->primary_key,$id);
			//$this->db->join('department','department_id = id_department');
			return $this->db->get($this->table_name)->row();
		}
		
		/*function insert($data){
			$this->db->set('karyawan_nama',$data['nama']);
			$this->db->set('karyawan_tgllahir',$data['tgllahir']);
			$this->db->set('karyawan_jenkel',$data['jenkel']);
			$this->db->set('department_id',$data['department_id']);
		}*/
	}
?>
