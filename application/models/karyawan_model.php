<?
	class Karyawan_model extends Model{
		private $table_name = 'karyawan';
		private $primary_key = 'id_karyawan';
		
		function __construct(){ # kontruktor
			parent::Model();
		}
		
		function get_detail($id){ # mengambil detail karyawan
			# select * from karyawan where id_karyawan = $id			
			$this->db->where($this->primary_key,$id);
			$this->db->join('department','department_id = id_department');
			# sebelum get setup semua query, spt where, join, group
			return $this->db->get($this->table_name)->row();
		}
		
		function get(){ # seluruh daya karyawan
			# select `id_karyawan`,`nama_karyawan`,`group` from karyawan
			# $this->db->select('id_karyawan,nama_karyawan,(SELECT data FROM table_lain)',false);
			$this->db->order_by($this->primary_key);
			$this->db->join('department','department_id = id_department');
			return $this->db->get($this->table_name)->result();
		}
		
		function insert($data){
			$this->db->set('karyawan_nama',$data['nama']);
			$this->db->set('karyawan_tgllahir',$data['tgllahir']);
			$this->db->set('karyawan_jenkel',$data['jenkel']);
			$this->db->set('department_id',$data['department_id']);
			# sebelum insert setup semua data
			return $this->db->insert($this->table_name);
		}
		
		function update($data,$id){
			$this->db->set('karyawan_nama',$data['nama']);
			$this->db->set('karyawan_tgllahir',$data['tgllahir']);
			$this->db->set('karyawan_jenkel',$data['jenkel']);
			$this->db->set('department_id',$data['department_id']);
			$this->db->where($this->primary_key,$id);
			# sebelum insert setup semua data
			return $this->db->update($this->table_name);
		}
		
		function delete($id){
			$this->db->where($this->primary_key,$id);
			return $this->db->delete($this->table_name);
		}	
	}
