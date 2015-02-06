<?php
	
	class belajar1_model extends Model{
		
		private $proyek = 'project'; 
		private $div ='divisi';
		private $acc = 'kper';
		private $primary_key = 'kodeacc';
		
		function __construct(){
			parent::model();
		}
		
		function get_proyek(){
			return $this->db->get($this->proyek)->result();
		}
		
		function get_divisi(){
			return $this->db->get($this->div)->result();
		}
		
		function get_kper(){
			return $this->db->get($this->acc)->result();
		}
		function get_kperdetail($id){
			$this->db->where($this->primary_key,$id);
			return $this->db->get($this->acc)->row();
		}
		
		/*function get_tt(){
			$DB2 = $this->load->database('local', TRUE);
			var_dump ($DB2);
			return $DB2->get("mst_bgt")->result();
		}*/


		function insertbudgetdiv($data){
			$db1=$this->load->database('local',TRUE);
			#var_dump($db1);
			$db1->set('proj',$data['prj']);
			$db1->set('acc',$data['kodeacc']);
			#$db1->set('descbgtdiv',$data['nama']);
			$db1->set('div',$data['div']);
			$db1->set('code',$data['code']);
			$db1->set('descacc',$data['nama']);
			$db1->set('thn',$data['thn']);
			$db1->set('jan',$data['jan']);
			$db1->set('feb',$data['feb']);
			$db1->set('mar',$data['mar']);
			$db1->set('apr',$data['apr']);
			$db1->set('mei',$data['mei']);
			$db1->set('jun',$data['jun']);
			$db1->set('jul',$data['jul']);
			$db1->set('ags',$data['ags']);
			$db1->set('sep',$data['sep']);
			$db1->set('okt',$data['okt']);
			$db1->set('nop',$data['nop']);
			$db1->set('des',$data['des']);
			$db1->set('tot_mst',$data['tot']);
			
			# sebelum insert setup semua data
			return $db1->insert('mst_bgt');
		}
			
			
	}
?>
