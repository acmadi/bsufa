<?php
class Tblprttrbgt_model extends Model{
	function __construct(){
		parent::Model();
	}
		
	function get_data($group){
			$CI =& get_instance();
			$CI->load->model('userlogin','user');
			$session_id = $CI->user->isLogin();
			$id =  $session_id['id'];
			$lvl = $session_id['level_id'];
			$pt = $session_id['id_pt'];
			
			if($lvl==1){
				$this->db->select('b.code,b.date,a.group_name,b.remark,b.amount');
				$this->db->from('user_group a');
				$this->db->join('db_trbgtdiv b','a.id_group = b.divisi_id');
			}else{
				$this->db->select('b.code,b.date,a.group_name,b.remark,b.amount');
				$this->db->from('user_group a');
				$this->db->join('db_trbgtdiv b','a.id_group = b.divisi_id');
				$this->db->where('b.divisi_id',$group);
			}
			return $this->db->get()->result();
		}
	
	function get_divisi($id){
		$this->db->select('b.group_name AS nm_group');
		$this->db->from ('db_trbgtdiv a');
		$this->db->join('user_group b', 'b.id_group = a.divisi_id');
		$this->db->where('a.divisi_id',$id);
		return $this->db->get()->row_array();
	}
	
	function get_divisi1(){
		$this->db->select('a.group_name AS nm_group');
		$this->db->from ('user_group a');
		$this->db->join('db_trbgtdiv b', 'a.id_group = b.divisi_id');
		return $this->db->get()->result();
	}
	
	
  
}
?>
