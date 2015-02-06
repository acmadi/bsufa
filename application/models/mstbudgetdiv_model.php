<?php
	
	class mstbudgetdiv_model extends Model{
		
		private $proyek = 'project'; 
		private $div ='divisi';
		private $acc = 'kper';
		private $primary_key = 'kodeacc';
		
		function __construct(){
			parent::model();
		}
		
		function get_proyek(){
			$db1=$this->load->database('local',TRUE);
			return $db1->get($this->proyek)->result();
		}
		
		function get_divisi(){
			$db1=$this->load->database('local',TRUE);
			return $db1->get($this->div)->result();
		}
		
		function get_kper(){
			$db1=$this->load->database('local',TRUE);
			return $db1->get($this->acc)->result();
		}
		function get_kperdetail($id){
			$db1=$this->load->database('local',TRUE);
			$db1->where($this->primary_key,$id);
			return $db1->get($this->acc)->row();
		}
		
		function graphdivisi(){
			$this->db->select('divisi_nm,sum(tot_mst) as jumlah');
			$this->db->join('db_divisi','divisi_id = id_divisi');
			$this->db->group_by('a.id_divisi,divisi_nm');
			return $this->db->get('db_mstbgt a')->result();
		}
		
		function insertbudgetdiv($data){
			#$db1=$this->load->database('local',TRUE);
			#var_dump($db1);
			$this->db->set('proj',$data['prj']);
			$this->db->set('acc',$data['kodeacc']);
			#$db1->set('descbgtdiv',$data['nama']);
			$this->db->set('div',$data['div']);
			$this->db->set('code',$data['code']);
			$this->db->set('descacc',$data['nama']);
			$this->db->set('thn',$data['thn']);
			$this->db->set('bgt1',$data['jan']);
			$this->db->set('bgt2',$data['feb']);
			$this->db->set('bgt3',$data['mar']);
			$this->db->set('bgt4',$data['apr']);
			$this->db->set('bgt5',$data['mei']);
			$this->db->set('bgt6',$data['jun']);
			$this->db->set('bgt7',$data['jul']);
			$this->db->set('bgt8',$data['ags']);
			$this->db->set('bgt9',$data['sep']);
			$this->db->set('bgt10',$data['okt']);
			$this->db->set('bgt11',$data['nop']);
			$this->db->set('bgt12',$data['des']);
			$this->db->set('tot_mst',$data['tot']);
			$this->db->set('descbgt',$data['codedesc']);
			$this->db->set('user_id',$data['id_user']);
			
			# sebelum insert setup semua data
			return $this->db->insert('db_mstbgt');
		}
			
			
	}
?>
