<?
	
	class DBModel extends Model{
		private $joins = array();
		private $fields = array();
		public $table_name;
		public $primary_key;
		private $last_id=0;
		protected $join_on_count = false;
		
		function __construct($table_name,$primary_key){
			parent::Model();
			$this->table_name = $table_name;
			$this->primary_key = $primary_key;
			$this->fields = $this->db->list_fields($this->table_name);
		}	
		
		private function query_join(){
			if(count($this->joins) > 0){
				foreach($this->joins as $j){
					$this->db->join($j['table_name'],$j['relationship'],$j['type']);
				}
			}
		}
		
		protected function set_join($table_name,$relationship,$type='inner'){
			$this->joins[] = array(
				'table_name' => $table_name,
				'relationship' => $relationship,
				'type' => $type
			);
		}
		
		protected function filter_field($field){
			return $field;
		}
		
		function set_search($field,$type,$str){
			$field = $this->filter_field($field);
			switch($type){
			  case 'bw': $this->db->like($field,$str,'before'); break;
			  case 'cn': $this->db->like($field,$str,'both'); break;
			  case 'gt': $this->db->where($field.' >',$str); break;
			  case 'ge': $this->db->where($field.' >=',$str); break;
			  case 'lt': $this->db->where($field.' <',$str); break;
			  case 'le': $this->db->where($field.' <=',$str); break;
			  case 'eq': 
			  default  : $this->db->where($field,$str); break;
		    }
		}

		
		function save($data,$id=false){
			if(is_array($data) && count($data) > 0){
				foreach($data as $key=>$val){
					if(in_array($key,$this->fields) && $this->primary_key != $key)
						$this->db->set($key,$val?$val:'');
				}
				if($id){
					$this->db->where($this->primary_key,$id);
					$save = $this->db->update($this->table_name);
					$this->last_id = $id;
				}else{
					$save = $this->db->insert($this->table_name);					
					$this->last_id = $this->db->insert_id();
				}
				return $save;
			}else{
				return false;
			}
		}
		
		function count_rows(){
			if($this->join_on_count){
				$this->query_join();
			}
			$this->db->select('COUNT('.$this->primary_key.') as count_row',false);
			$count = @$this->db->get($this->table_name)->row()->count_row;
			return $count;
		}
		
		function last_id(){
			return $this->last_id;
		}
		
		protected function before_fetch(){
			$this->db->order_by($this->primary_key);
			$this->query_join();			
		}
		
		function get(){ 
			$this->before_fetch();
			return $this->db->get($this->table_name)->result();
		}
		
		function get_detail($id){ 
			$this->before_fetch();
			$this->db->where($this->primary_key,$id);
			return $this->db->get($this->table_name)->row();
		}

		function get_detail_print($id){ 
			$this->db->where($this->primary_key,$id);
			return $this->db->get($this->table_name)->row();
		}

		
		function delete($id){
			$this->db->where($this->primary_key,$id);
			$delete = $this->db->delete($this->table_name);
			return $delete;
		}
		
		function update($id,$dt){
			$this->db->where($this->primary_key,$id);
			$update = $this->db->update($this->table_name,$dt);
			return $update;
		}
		
		function sethistory($table,$data){
			$set = $this->db->insert($table,$data);
			return $set;
		}
		
		function table_name(){
			$table = $this->table_name;
			return $table;
		}
		
		function register_user(){
			$CI =& get_instance();
			$CI->load->model('userlogin','user');
			$session_id = $CI->user->isLogin();
			return $session_id;
		}
		
		function deletedata($id,$dt){
			$this->db->where($this->primary_key,$id);
			$deletedata = $this->db->update($this->table_name,$dt);
			return $deletedata;
		}		

	}
