<?
	
	Class trbudgetdiv_model Extends model{	
		
		function __construct(){
			parent::model();
		}
		
		function get_kodebudget($id,$lvl,$pt,$id_parent){
			if($lvl==1){
				$this->db->where('id_pt',$pt);
			}else{
				$this->db->where('id_divisi',$id);
				$this->db->where('id_pt',$pt);
				$this->db->where('id_project',$id_parent);
				$this->db->order_by('code', 'ASC'); 
			}
			return $this->db->get('db_mstbgt')->result();
		}
		
		
		function insert_trbgtdiv($data){
			#$db1=$this->load->database('local',TRUE);
			#var_dump($db1);
			#$db1->set('descbgtdiv',$data['nama']);
			$this->db->set('code',$data['code']);
			$this->db->set('flag',$data['flag']);
			$this->db->set('blcannbgt',$data['blcannbgt']);
			$this->db->set('usedbgt',$data['usedbgt']);
			$this->db->set('blcmnthbgt',$data['blcmnthbgt']);
			$this->db->set('amount',$data['amount']);
			$this->db->set('date',$data['date']);
			$this->db->set('remark',$data['remark']);
			$this->db->set('user_id',$data['id_user']);
			$this->db->set('divisi_id',$data['divisi_id']);
			$this->db->set('id_pt',$data['id_pt']);
			# sebelum insert setup semua data
			return $this->db->insert('db_trbgtdiv');
		}
		
		#SELECT * FROM db_mstbgt WHERE  user_id = 7 and thn = 2011
		function get_mstbudgetbln($bln,$user,$thn,$id_pt){
			$this->db->select('sum('.$bln.') as jmlh');
			$this->db->where('user_id',$user,'thn',$thn,'id_pt',$id_pt);
			return $this->db->get('db_mstbgt')->row_array();
		}
		
		function get_divbudgetbln($user,$thn){
			$this->db->select('sum(amount) as amtbln');
			$this->db->from('db_trbgtdiv');
			$this->db->where('user_id',$user,'SUBSTRING(date,7,4)',$thn);
			return $this->db->get()->row_array();
		}
		
		function get_divisi($code){
			$this->db->select('b.divisi_nm,a.id_divisi');
			$this->db->from('db_mstbgt a');
			$this->db->join('db_divisi b','a.id_divisi = b.divisi_id');
			$this->db->where('a.code',$code);
			return $this->db->get()->row_array();
		}
		
		function get_budgetcode($code,$thn,$pt){
			$this->db->select('sum(amount) as nil');
			$this->db->from('db_trbgtdiv');
			$this->db->where('code',$code);
			$this->db->where('id_pt',$pt);
			$this->db->where('flag !=',1);
			$this->db->where('substring(date,7,4)',$thn);
			return $this->db->get()->row_array();
		}
		
		function get_nama_pt($pt){
			$this->db->where('id_pt',$pt);
			return $this->db->get('pt')->row_array();
		}
		
			
		
	}
