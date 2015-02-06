<?php
	class trxtype_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('db_trxtype','trxtype_id');
			
					
		}
		
			
		// function divisi(){
			// return $this->db->get('db_divisi')->result();
		// }
		
		// function jabatan(){
			// $this->db->order_by('karyjab_nm','ASC');
			// return $this->db->get('db_karyjab')->result();
		// }
		
		// function level(){
			// return $this->db->get('db_karylvl')->result();
		// }
		
		// function strata(){
			// return $this->db->get('db_pndd')->result();
		// }
		
		// function status(){
			// return $this->db->get('db_karystat')->result();
		// }
		// function sek(){
			// return $this->db->get('db_karysek')->result();
		// }
		// function agama(){
			// return $this->db->get('db_agama')->result();
		// }
		// function jurus(){
			// return $this->db->get('db_pnddjur')->result();
		// }
		// function gol_darah(){
			// return $this->db->get('db_karydrh')->result();
			// }
		// function klrg(){
			// return $this->db->get('db_karykk')->result();
			// }
		// function karyket(){
			// return $this->db->get('db_karyket')->result();
			// }
		// function klg($id){
			// $this->db->where('kary_id',$id);
			// return $this->db->get('db_karyklrg')->result();
			// }
		// function joinall_table($id){
			// $this->db->join('db_karyklrg','kary_id = id_kary');
			// $this->db->join('db_karylvl','karylvl_id = id_karylvl');
			// $this->db->join('db_karysek','karysek_id = id_karysek');
			// $this->db->join('db_karyjab','karyjab_id = id_karyjab');
			// $this->db->join('db_pndd','pndd_id = id_pndd');
			// $this->db->join('db_pnddjur','pnddjur_id = id_pnddjur');
			// $this->db->join('db_divisi','divisi_id = id_divisi');
			// $this->db->join('db_karystat','karystat_id = id_karystat');
			// $this->db->join('db_karydrh','karydrh_id = id_karydrh');
			// $this->db->join('db_karykk','karykk_id = id_karykk');
			// $this->db->join('db_agama','agama_id = id_agama');
			// $this->db->join('db_karyket','karyket_id = id_karyket');
			// $this->db->where('kary_id',$id);
			// return $this->db->get('db_kary')->row_array();
		// }
		
		// protected function before_fetch(){
			// $CI =& get_instance();
			// $CI->load->model('userlogin','user');
			// $session_id = $CI->user->isLogin();
			// $id =  $session_id['id'];
			// $lvl = $session_id['level_id'];
			// $pt = $session_id['id_pt'];
			
			// $this->db->join('db_karyklrg','kary_id = id_kary');
			// $this->db->join('db_karylvl','karylvl_id = id_karylvl');
			// $this->db->join('db_karyjab','karyjab_id = id_karyjab');
			// $this->db->join('db_pndd','pndd_id = id_pndd');
			// $this->db->join('db_divisi','divisi_id = id_divisi');
			// $this->db->join('db_karystat','karystat_id = id_karystat');
			// $this->db->join('db_agama','agama_id = id_agama');
			// $this->db->order_by('divisi_nm','asc');
			
			
			
					
			// if($lvl==1){
				// $this->db->where('id_pt',$pt);
			// }else{
				// $this->db->where('user_id',$id);
			// }
			// parent::before_fetch();
		// }
		
		// function graphkarypndd(){
			// $this->db->select('pndd_nm,count(id_pndd) as total');
			// $this->db->join('db_pndd','pndd_id = id_pndd');
			// $this->db->group_by('pndd_id,pndd_nm');
			// return $this->db->get('db_kary')->result();
		// }
		// function graphkarystat(){
			// $this->db->select('karystat_nm,count(id_karystat) as jumlah');
			// $this->db->join('db_karystat','karystat_id = id_karystat');
			// $this->db->group_by('karystat_id,karystat_nm');
			// return $this->db->get('db_kary')->result();
		// }
		// function graphdivisi(){
			// $this->db->select('divisi_nm,count(id_divisi) as jml');
			// $this->db->join('db_divisi','divisi_id = id_divisi');
			// $this->db->group_by('divisi_id,divisi_nm');
			// return $this->db->get('db_kary')->result();
		// }
		
	}
?>
