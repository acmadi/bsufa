<?
	defined('BASEPATH') or die('Access Denied');
	
	class Base_model extends Model{
		var $tableName = NULL;
		var $fields = array();
		var $errorMessage = "";
		var $ignoreFields = array(); 
		var $primaryField = 'id';
		
		function Base_model(){
			parent::Model();
		}
		
		function isValid(){
			foreach($this->fields as $key=>$values){
				// Begin: core validation 
				if(in_array($key,$this->ignoreFields)) continue;
				$rules = 'trim';
				if(count($values) > 1){
				  if($values[1])
				   $rules .= '|required';
				  if(isset($values[2]))
				   $rules .= '|'.$values[2];
				}
				// End: core validation 
				$this->form_validation->set_rules($key, $values[0], $rules);
			}
			return $this->form_validation->run();
		}	
		
		function save($id = false){
			foreach($this->fields as $key=>$values){
			  if(in_array($key,$this->ignoreFields)) continue;	
			  $this->db->set($key,$this->input->post($key));				
			}
			if($id){
			  $this->db->where($this->primaryField,$id);
			  $this->db->update($this->tableName);
			}else{
			  $this->db->insert($this->tableName);			  
			}
			return ($this->db->affected_rows() == 1);
		}
		
		function get($id=false,$limit=0,$page=0){
			if($id){
				$this->db->where($this->primaryField,$id);
				return $this->ado->GetRow($this->tableName);
			}else{
			 if($limit) $this->db->limit($limit,$page);			
			 $this->db->order_by($this->primaryField,'desc');
			 return $this->ado->GetAll($this->tableName);
			}
		}	
		
		function countRow(){
			$this->db->select("COUNT(".$this->primaryField.") countRow");
			return $this->ado->GetOne($this->tableName);		
		}					
		
		function delete($id){
		  	$this->db->where($this->primaryField,$id);
		    $this->db->delete($this->tableName);
			return ($this->db->affected_rows() == 1);
		}	
		
		function getLabels(){
			$labels = array();
			foreach($this->fields as $key=>$value){
				$labels[$key] = $value[0];
			}
			return (object) $labels;
		}
		
		function getValue($field,$id){
		  	$this->db->where($this->primaryField,$id);
		  	$this->db->select($field);
			return $this->ado->GetOne($this->tableName);
		}	
		
		function dataNotRedudant($fieldName,$oldValue=false){
			$code = $this->input->post($fieldName);
			if(empty($code)){
				// ignore the empty data
				if(@$this->fields[$fieldName][1] === false || !isset($this->fields[$fieldName][1])) return true;
				else return false;
			}
			if($oldValue){ // edit
			  if($code != $oldValue){ // jika kode tidak sama dengan kode sebelumnya
			  	$where = "`$fieldName` = '$code' AND `$fieldName` <> '$oldValue'";
			    $this->db->where($where);
				if($this->ado->GetOne($this->tableName)) return false;
			  }
			}else{
				$this->db->where($fieldName,$code);
				if($this->ado->GetOne($this->tableName)) return false;
			}
			return true;
		}
		
		function errorMessage($error){
			$this->errorMessage .= $error.br();
		}
		
		function getDropdown($id,$label,$string='Please Select From List.....'){
			$values	= $this->ado->GetAll($this->tableName);
			//die($this->tableName.' '.$id.' '.$label);
			//Dump($values);
			foreach($values as $v):
				$dd[$v->$id] = $v->$label;
			endforeach;
			return $dd;
		}
	}
?>
