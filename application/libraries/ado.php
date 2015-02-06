<?
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Ado{
		var $query;
		var $db;
		
		function Ado(){
			$CI = &get_instance();
			$this->db = $CI->db;
			unset($CI);
		}
		
		function _get($sql,$where = array()){			
			if(count($where) > 1 || !ereg(' ',trim($sql))){
			 $this->query = $this->db->get_where($sql,$where) or die(mysql_error());
			}else{
			 $this->query = $this->db->query($sql) or die(mysql_error());
			} 
			
			return ($this->query->num_rows() > 0);	
		}
		
		function GetRow($sql,$where = array()){
			if($this->_get($sql,$where))
			  return $this->query->row();	
			else return false;			
		}
		
		function GetAll($sql,$where = array()){
			if($this->_get($sql,$where)){
			  $data = array();
			  foreach($this->query->result() as $row){
			  	$data[] = $row;
			  }
			  return $data;
			}else return false;			
		}
		
		function GetOne($sql,$where = array()){
			if($this->_get($sql,$where)){
			  $arr = $this->query->row_array();				  
			  $val = "";
			  foreach($arr as $a){
			  	$val = $a;
				break;
			  }
			  return $val;
			}else return false;			
		}		
	}
?>