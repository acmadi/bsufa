<?php
class dailycash_model extends DBModel{
	
	function __construct(){ 
		parent::__construct('view_daily','id_dailycash');
		//bikin view atau join
	}

	function before_fetch(){
		$this->db->where('flag_hapus','0');
		$this->db->where('id_pt', $this->session->userdata('sesspt'));
		$this->db->where('id_project', $this->session->userdata('sessproject'));
		$this->db->where('bank_id', $this->session->userdata('sessbank'));
		$this->db->select('*');
		parent::before_fetch();
	}

	function insertcash($data){
		$q = $this->db->insert('db_dailycashdet', $data);
		return $q;
	}

	function updatecash($id,$data){
		$this->db->where('id_dailycashdet', $id);
		$q = $this->db->update('db_dailycashdet', $data);
		return $q;
	}

	function deletemcash($id){
		$cekdet = $this->db->query("select id_dailycash,debet,credit from db_dailycashdet where id_dailycashdet = ".$id." ")->row();
		$this->db->query('update db_dailycashdet set flag_hapus = 1 where id_dailycashdet = '.$id.'');
		$this->db->query('update db_dailycash set end_amount = end_amount + '.$cekdet->credit.' - '.$cekdet->debet.' where id_dailycash = '.$cekdet->id_dailycash.'');
		
	}
	

}
