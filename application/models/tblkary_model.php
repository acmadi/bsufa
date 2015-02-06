<?php
	class tblkary_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('db_kary','no_urut');
			
					
		}
		
			
		function divisi(){
			return $this->db->get('db_divisi')->result();
		}
		
		function jabatan(){
			$this->db->order_by('karyjab_nm','ASC');
			return $this->db->get('db_karyjab')->result();
		}
		
		function level(){
			return $this->db->get('db_karylvl')->result();
		}
		
		function strata(){
			return $this->db->get('db_pndd')->result();
		}
		
		function status(){
			return $this->db->get('db_karystat')->result();
		}
		function sek(){
			return $this->db->get('db_karysek')->result();
		}
		function agama(){
			return $this->db->get('db_agama')->result();
		}
		function jurus(){
			return $this->db->get('db_pnddjur')->result();
		}
		function gol_darah(){
			return $this->db->get('db_karydrh')->result();
			}
		function klrg(){
			return $this->db->get('db_karykk')->result();
			}
		function karyket(){
			return $this->db->get('db_karyket')->result();
			}
		function klg($id){
			$this->db->where('kary_id',$id);
			return $this->db->get('db_karyklrg')->result();
			}
		function joinall_table($id){
			$this->db->join('db_karyklrg','kary_id = id_kary');
			$this->db->join('db_karylvl','karylvl_id = id_karylvl');
			$this->db->join('db_karysek','karysek_id = id_karysek');
			$this->db->join('db_karyjab','karyjab_id = id_karyjab');
			$this->db->join('db_pndd','pndd_id = id_pndd');
			$this->db->join('db_pnddjur','pnddjur_id = id_pnddjur');
			$this->db->join('db_divisi','divisi_id = id_divisi');
			$this->db->join('db_karystat','karystat_id = id_karystat');
			$this->db->join('db_karydrh','karydrh_id = id_karydrh');
			$this->db->join('db_karykk','karykk_id = id_karykk');
			$this->db->join('db_agama','agama_id = id_agama');
			$this->db->join('db_karyket','karyket_id = id_karyket');
			$this->db->where('kary_id',$id);
			return $this->db->get('db_kary')->row_array();
		}
		
		protected function before_fetch(){
			$CI =& get_instance();
			$CI->load->model('userlogin','user');
			$session_id = $CI->user->isLogin();
			$id =  $session_id['id'];
			$lvl = $session_id['level_id'];
			$pt = $session_id['id_pt'];
			
			$this->db->select('db_kary.id_kary,db_kary.nama,db_karyjab.karyjab_nm,db_karylvl.karylvl_nm,db_kary.no_urut,db_divisi.divisi_nm');
			$this->db->join('db_karyklrg','db_karyklrg.kary_id = db_kary.id_kary','left');
			$this->db->join('db_karylvl','db_karylvl.karylvl_id = db_kary.id_karylvl','left');
			$this->db->join('db_karyjab','db_karyjab.karyjab_id = db_kary.id_karyjab','left');
			$this->db->join('db_pndd','db_pndd.pndd_id = db_kary.id_pndd','left');
			$this->db->join('db_divisi','db_divisi.divisi_id = db_kary.id_divisi','left');
			$this->db->join('db_karystat','db_karystat.karystat_id = db_kary.id_karystat','left');
			$this->db->group_by('db_kary.id_kary, db_kary.nama, db_karyjab.karyjab_nm, db_karylvl.karylvl_nm, db_kary.no_urut,db_divisi.divisi_nm');
			$this->db->join('db_agama','db_agama.agama_id = db_kary.id_agama','left');
			#$this->db->order_by('db_divisi.divisi_nm','asc');
			
			
			
					
			if($lvl==1){
				$this->db->where('isnull(db_kary.id_flag,0) !=','10');
						$this->db->where('db_kary.id_pt',$pt);
			}else{
				$this->db->where('isnull(db_kary.id_flag,0) !=','10');
							$this->db->where('db_kary.user_id',$id);
			}
			parent::before_fetch();
		}
		
		
			protected function filter_field($field){
		if($field == 'nama'){
			$this->join_on_count = true;
		}elseif($field == 'id_kary'){
			$this->join_on_count = true;
		}		return $field;
	}
		function graphkarypndd(){
			$this->db->select('pndd_nm,count(id_pndd) as total');
			$this->db->join('db_pndd','pndd_id = id_pndd');
			$this->db->group_by('pndd_id,pndd_nm');
			$this->db->where('isnull(db_kary.id_flag,0) !=','10');
			return $this->db->get('db_kary')->result();
		}
		function graphkarystat(){
			$this->db->select('karystat_nm,count(id_karystat) as jumlah');
			$this->db->join('db_karystat','karystat_id = id_karystat');
			$this->db->group_by('karystat_id,karystat_nm');
			$this->db->where('isnull(db_kary.id_flag,0) !=','10');
			return $this->db->get('db_kary')->result();
		}
		function graphdivisi(){
			$this->db->select('divisi_nm,count(id_divisi) as jml');
			$this->db->join('db_divisi','divisi_id = id_divisi');
			$this->db->group_by('divisi_id,divisi_nm');
			$this->db->where('isnull(db_kary.id_flag,0) !=','10'); 
			return $this->db->get('db_kary')->result();
		}
		
	}
?>
